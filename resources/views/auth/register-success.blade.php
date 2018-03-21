<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<!-- TODO: Style it better. -->
<head>
</head>
<body>
    <div>
        You are now registered. You are now logged in.
        Click <a href="{{ \App\Util\OAuthUtil::getAuthorizationCodeRedirect() }}">here</a> to continue.
    </div>
</body>
</html>
