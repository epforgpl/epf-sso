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
   - SIGN_IN_W_GOOGLE_CLIENT_ID
   - SIGN_IN_W_GOOGLE_CLIENT_SECRET
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

- To have a user to log in as, with password equal '`password`' insert into the `users` table:

`INSERT INTO users VALUES ('Joe Doe', 'joe@doe.com', 0, '$2y$10$i1jY612ZotJtn6xj6/GaB.2zGCponTcqAyyW3Mh3JJHcyb6dVjqgq',
NULL, NOW(), NOW());`

- Navigate to the domain chosen slash `page.php` - e.g. `http://sso-client.local/page.php`.