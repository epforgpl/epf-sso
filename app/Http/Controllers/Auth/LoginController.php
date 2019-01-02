<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\SocialUser;
use App\Models\User;
use App\Util\OAuthUtil;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Laravel\Socialite\Facades\Socialite;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers {
        login as public parentLogin;
    }

    /**
     * Override of a method from AuthenticatesUsers to have a Polish error message.
     *
     * @param Request $request
     * @throws ValidationException
     */
    protected function sendFailedLoginResponse(Request $request)
    {
        throw ValidationException::withMessages([
            $this->username() => ['Niewłaściwy email lub hasło.'],
        ]);
    }

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/change-this-url';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request)
    {
        $this->redirectTo = OAuthUtil::getAuthorizationCodeRedirect();
        return $this->parentLogin($request);
    }

    public function redirectToFacebook()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Obtain the user information from Facebook.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function handleFacebookCallback() : \Illuminate\Http\RedirectResponse
    {
        $this->redirectTo = OAuthUtil::getAuthorizationCodeRedirect();
        $fb_user = Socialite::driver('facebook')->user();
        $user = $this->createOrGetUser($fb_user, 'facebook');
        Auth::login($user);
        return redirect()->intended($this->redirectTo);
    }

    /**
     * Obtain the user information from Google.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function handleGoogleCallback() : \Illuminate\Http\RedirectResponse
    {
        $this->redirectTo = OAuthUtil::getAuthorizationCodeRedirect();
        $google_user = Socialite::driver('google')->user();
        $user = $this->createOrGetUser($google_user, 'google');
        Auth::login($user);
        return redirect()->intended($this->redirectTo);
    }

    private function createOrGetUser(\Laravel\Socialite\Two\User $external_social_user, string $provider) : User
    {
        $social_user = SocialUser::whereProvider($provider)
            ->whereProviderUserId($external_social_user->getId())
            ->first();

        if ($social_user) {
            return $social_user->user;
        }

        $social_user = new SocialUser([
            'provider_user_id' => $external_social_user->getId(),
            'provider' => $provider
        ]);
        $user = User::whereEmail($external_social_user->getEmail())->first();
        if (!$user) {
            $user = User::create([
                'email' => $external_social_user->getEmail(),
                'password' => 'none',
                'hash_type' => 'NONE'
            ]);
        }
        $social_user->user()->associate($user);
        $social_user->save();
        return $user;
    }
}
