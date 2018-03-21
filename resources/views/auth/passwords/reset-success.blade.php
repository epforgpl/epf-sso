<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<!-- TODO: Style it better. -->
<head>
</head>
<body>
    <div>
        Your password has been reset. You are now logged in.
        Click <a href="{{ \App\Util\OAuthUtil::getAuthorizationCodeRedirect() }}">here</a> to continue.
    </div>
</body>
</html>
