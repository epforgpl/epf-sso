<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Overridden to provide a message in Polish.
     *
     * @param $response
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function sendResetLinkResponse($response)
    {
        return back()->with('status', 'Wysłaliśmy email z linkiem do resetowania hasła.');
    }

    /**
     * Overridden to add 'is_registered_user' to validation list.
     *
     * @param Request $request
     */
    protected function validateEmail(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email|is_registered_user'
        ]);
    }
}
