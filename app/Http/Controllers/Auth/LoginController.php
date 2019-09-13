<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\SocialUser;
use App\Models\User;
use App\Util\Constants;
use App\Util\OAuthUtil;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\RedirectResponse;
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
    protected function sendFailedLoginResponse(/* @noinspection PhpUnusedParameterInspection */  Request $request)
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
     * @return RedirectResponse
     * @throws \Exception
     */
    public function handleFacebookCallback() : RedirectResponse
    {
        $this->redirectTo = OAuthUtil::getAuthorizationCodeRedirect();
        try {
            /** @var \Laravel\Socialite\Two\User $fb_user */
            $fb_user = Socialite::driver('facebook')->user();
        } catch (\Exception $e) {
            // This will happen if user clicks 'Cancel' on Facebook when presented with a screen asking to give
            // permission to our FB app.
            $expected_msg1 = 'Client error: `POST https://graph.facebook.com/';
            $expected_msg2 = 'resulted in a `400 Bad Request`';
            $expected_msg3 = 'response:' . "\n"
                . '{"error":{"message":"Missing authorization code","type":"OAuthException"';
            if (($e->getCode() === 400)
                && (strpos($e->getMessage(), $expected_msg1) !== false)
                && (strpos($e->getMessage(), $expected_msg2) !== false)
                && (strpos($e->getMessage(), $expected_msg3) !== false)) {
                return redirect()->route('register-fb-failure')
                    ->with('reason', Constants::REGISTER_FB_FAILURE_NOT_ALLOWED);
            }
            throw $e;
        }
        if (!$fb_user->getEmail()) {
            // This will happen if user gives permission to our FB app, but unchecks the box regarding whether to
            // provide email address.
            return redirect()->route('register-fb-failure')
                ->with('reason', Constants::REGISTER_FB_FAILURE_EMAIL_NOT_PROVIDED);
        }
        $user = $this->createOrGetUser($fb_user, 'facebook');
        Auth::login($user);
        return redirect()->intended($this->redirectTo);
    }

    /**
     * Obtain the user information from Google.
     *
     * @return RedirectResponse
     */
    public function handleGoogleCallback() : RedirectResponse
    {
        $this->redirectTo = OAuthUtil::getAuthorizationCodeRedirect();
        $google_user = Socialite::driver('google')->user();
        $user = $this->createOrGetUser($google_user, 'google');
        Auth::login($user);
        return redirect()->intended($this->redirectTo);
    }

    private function createOrGetUser(\Laravel\Socialite\Two\User $external_social_user, string $provider) : User
    {
        /** @noinspection PhpUndefinedMethodInspection */
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
        /** @noinspection PhpUndefinedMethodInspection */
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
