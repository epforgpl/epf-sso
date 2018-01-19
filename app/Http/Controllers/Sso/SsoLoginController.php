<?php

namespace App\Http\Controllers\Sso;

use App\Models\SocialUser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class SsoLoginController extends BaseController
{

    public function authenticate(Request $request)
    {
        $client_id = session('epf_client_id');
        $nonce = session('epf_nonce');
        $client_redirect_uri = session('epf_redirect_uri');
        $scope = session('epf_scope');
        $state = session('epf_state');
        $email = $request->input('email');
        $password = $request->input('password');

        if (($client_id !== null) && ($state !== null)
            && Auth::attempt(['email' => $email, 'password' => $password])) {
            $server_redirect_uri = 'oauth/authorization';
            $server_redirect_uri .= '?state=' .  $state;
            $server_redirect_uri .= '&client_id=' . $client_id;
            $server_redirect_uri .= '&nonce=' . $nonce;
            $server_redirect_uri .= '&redirect_uri=' . $client_redirect_uri;
            $server_redirect_uri .= '&scope=' . urlencode($scope);
            $server_redirect_uri .= '&response_type=code';
            return redirect()->intended($server_redirect_uri);
        }
    }

    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function handleGoogleCallback() : \Illuminate\Http\RedirectResponse
    {
        // Note that 'state' must be retrieved before we do Auth::login().
        $client_id = session('epf_client_id');
        $nonce = session('epf_nonce');
        $client_redirect_uri = session('epf_redirect_uri');
        $scope = session('epf_scope');
        $state = session('epf_state');

        $google_user = Socialite::driver('google')->user();
        $user = $this->createOrGetUser($google_user, 'google');
        Auth::login($user);

        $server_redirect_uri = 'oauth/authorization';
        $server_redirect_uri .= '?state=' .  $state;
        $server_redirect_uri .= '&client_id=' . $client_id;
        $server_redirect_uri .= '&nonce=' . $nonce;
        $server_redirect_uri .= '&redirect_uri=' . $client_redirect_uri;
        $server_redirect_uri .= '&scope=' . urlencode($scope);
        $server_redirect_uri .= '&response_type=code';
        return redirect()->intended($server_redirect_uri);
    }

    private function createOrGetUser(\Laravel\Socialite\Two\User $external_social_user, string $provider)
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
                'name' => $external_social_user->getName(),
                'password' => 'none',
            ]);
        }
        $social_user->user()->associate($user);
        $social_user->save();
        return $user;
    }
}
