# epf-sso
Centralized login for external users to various EPF services.

## Installation

- Clone the repository.
- Set up a domain on which the server runs. Let's assume it's `http://epf-sso.local.org`
- Set up a "Sign in with Google" app according to https://developers.google.com/identity/sign-in/web/sign-in
- Copy `.env.example` into `.env` and change the following settings:
   - APP_URL
   - DB_DATABASE
   - DB_USERNAME
   - DB_PASSWORD
   - MAIL_DRIVER
   - MAIL_HOST
   - MAIL_PORT
   - MAIL_USERNAME
   - MAIL_PASSWORD
   - SIGN_IN_W_GOOGLE_CLIENT_ID
   - SIGN_IN_W_GOOGLE_CLIENT_SECRET
- The 'MAIL*' settings are needed to send reset password emails.
- Run the DB migration: `php artisan migrate`
- Generate and insert a public-private key pair into `oauth_public_keys` table.

## Setting up example client

- Clone the repo https://github.com/jumbojett/OpenID-Connect-PHP
- Add to it a directory called `example`.
- Expose the `example` directory as webroot of some domain. Let's assume it's `http://sso-client.local`.
- Create the following two files in `example` directory:

`page.php`

    <?php
        session_start();
    
        $name = null;
        if (isset($_SESSION['name'])) {
            $name = $_SESSION['name'];
        }
    ?>
    
    <html>
        <head>
            <title>Example OpenID Connect Client Use</title>
        </head>
        <body>
            <?php if ($name) { ?>
                Hello <?php echo $name; ?>
            <?php } else { ?>
                <button onclick="location.href = '/client.php';">Login</button>
            <?php } ?>
        </body>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script>
            function setCookie(cname, cvalue, exdays) {
                var d = new Date();
                d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
                var expires = "expires="+d.toUTCString();
                document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
            }
    
            function getCookie(cname) {
                var name = cname + "=";
                var ca = document.cookie.split(';');
                for(var i = 0; i < ca.length; i++) {
                var c = ca[i];
                    while (c.charAt(0) == ' ') {
                        c = c.substring(1);
                    }
                    if (c.indexOf(name) == 0) {
                        return c.substring(name.length, c.length);
                    }
                }
                return "";
            }
    
            if (getCookie('is_sso_login_checked') === '') {
                $.ajax({url: 'http://epf-sso.local.org/oauth/amiloggedin', success: function(result) {
                    document.cookie = 'is_sso_login_checked=IRRELEVANT';
                    if (result == 'true') {
                        location.href = '/client.php';
                    }
                }});
            }
        </script>
    </html>
    
    
`client.php`

    <?php
    
    require "../vendor/autoload.php";
    
    $oidc = new Jumbojett\OpenIDConnectClient('http://epf-sso.local.org', 'myclient', 'mypassword');
    
    $oidc->providerConfigParam([
        'authorization_endpoint' => 'http://epf-sso.local.org/oauth/authorization',
        'token_endpoint' => 'http://epf-sso.local.org/oauth/token',
        'userinfo_endpoint' => 'http://epf-sso.local.org/oauth/userinfo',
        'jwks_uri' => 'http://epf-sso.local.org/oauth/jwks'    
        ]);
    $oidc->setRedirectURL('http://openidconnect-client.local/client.php');
    $oidc->addScope(['openid', 'profile']); // Needed to get 'name' out in user info below.
    
    $oidc->authenticate();
    $_SESSION['name'] = $oidc->requestUserInfo('name');
    header('Location: '. 'http://openidconnect-client.local/page.php');
    
- Replace `http://epf-sso.local.org` with the domain on which the SSO server runs.
- Replace `http://openidconnect-client.local` with the domain chosen for the client (e.g. `http://sso-client.local`).
- Insert into the `oauth_clients` table (replace URL with the domain you chose):

`INSERT INTO oauth_clients VALUES ('myclient', 'mypassword', 'http://sso-client.local/client.php', 
'authorization_code', 'openid profile email', NULL);`

- Add the client domain to authorized CORS origins in property CORS_ALLOWED_ORIGINS in `.env` in the server code
  (comma separated).
- To have a user to log in as, with password equal '`password`' insert into the `users` table:

`INSERT INTO users VALUES ('Joe Doe', 'joe@doe.com', 0, '$2y$10$i1jY612ZotJtn6xj6/GaB.2zGCponTcqAyyW3Mh3JJHcyb6dVjqgq',
NULL, NOW(), NOW());`

- Navigate to the domain chosen slash `page.php` - e.g. `http://sso-client.local/page.php`.

## How it works

#### Components

1. Laravel, including its authentication mechanisms (https://laravel.com/docs/5.6/authentication).
2. Socialite plugin for Laravel, for "Login with Google", etc, functionality (https://laravel.com/docs/5.6/socialite).
3. Brent Shaffer's PHP OAuth2 server (http://bshaffer.github.io/oauth2-server-php-docs/).
4. OpenID Connect extension to it (http://bshaffer.github.io/oauth2-server-php-docs/overview/openid-connect/).

#### User types

1. Regular users, who register through the server. We store their credentials ourselves.
2. Social users, e.g. Google or FB users, who click "Login with Google" / "Login with Facebook".

#### The server can

1. Log regular users in, using authorization code flow of OpenID Connect protocol.
2. Log social users in.
3. Register new regular users.
4. Reset regular users' passwords.

#### Request flow for regular user login

In the following discussion, we assume that the SSO server's address is `https://epf-sso.local.org`. 

1. Client website redirects browser to `https://epf-sso.local.org/oauth/authorization`
2. This is handled by `AuthorizationCodeController@handleRequest`.
3. If the user is already logged in, skip to point 11.
4. If the user is NOT logged in, save various OAuth2 params on the session, and let the request be handled 
by `LoginController@showLoginForm`.
5. `LoginController@showLoginForm` renders a login form.
6. User enters credentials & submits.
7. This sends a POST request to `LoginController@login`.
8. This remembers various OAuth2 params on the session, and the redirect URL back to 
`AuthorizationCodeController@handleRequest` (`/oauth/authorization`) in `$redirectTo`.
9. This eventually uses `AuthenticatesUsers@login`.
10. If credentials are checked OK, this sets user as logged in, and redirects to 
`AuthorizationCodeController@handleRequest` via `LoginController->$redirectTo`.
11. `AuthorizationCodeController@handleRequest` checks various OAuth2 params from the original
request from point 1. (Reminder: they were saved on the session in point 2.) If everything is OK,
it issues an authorization code and redirects back to the client, to the URL passed via `redirect_uri`
query param.
12. Client browser now follows the redirect URL returned in 11. The URL should cause a request
to the client server such that the client server calls in the backend `https://epf-sso.local.org/oauth/token`, 
including the authorization code, and client secret in the request.
13. `/oauth/token` is handled by `AccessTokenController@handleRequest`, which checks the params, and if valid,
returns an OAuth2 access token & OpenID Connect id token to the client server.
14. Access token can now be used by the client server to get user info via the endpoint 
`https://epf-sso.local.org/oauth/userinfo`.

#### Request flow for social user login

1. Steps 1-5 as above.
2. User clicks "Login with Google", etc, which redirects to `https://epf-sso.local.org/oauth/google`.
3. This is handled by `LoginController@redirectToGoogle`, which in turn invokes `Socialite::driver('google')->redirect()`.
4. After Google authenticates the user, it redirects the user's browser to 
`https://epf-sso.local.org/oauth/google/callback` (configured in `config/services.php`).
5. This endpoint invokes `LoginController@handleGoogleCallback`, which gets the user from `social_users` table based on
id given by Google. It then sets the user on the session as authenticated and passes control to
`AuthorizationCodeController@handleRequest`.
6. Steps 11-14 as above.
