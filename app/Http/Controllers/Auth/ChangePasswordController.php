<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

/**
 * Controller for changing user password.
 *
 * @package App\Http\Controllers\Auth
 */
class ChangePasswordController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function changePassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'current-password' => 'required|matches_current_password',
            // Regex below: password must have at least one letter (either case) and one digit.
            'new-password' => 'required|string|min:8|regex:/^(?=.*[a-zA-Z])(?=.*\d).+$/'
                .'|different:current-password|confirmed',
        ], [
            'confirmed' => 'Hasło i powtórzone hasło nie są identyczne.',
            'min' => [
                'string'  => 'Pole nie może być krótsze niż :min znaków.',
            ],
            'regex' => 'Hasło musi zawierać co najmniej jedną literę i jedną cyfrę.',
            'required' => 'Pole jest wymagane.',
        ]);

        $validator->validate();

        $user = Auth::user();
        $user->password = Hash::make($request->get('new-password'));
        $user->hash_type = 'BCRYPT'; // In case they used to have SHA1.
        $user->save();

        return redirect()->to('/password/change-success');
    }
}
