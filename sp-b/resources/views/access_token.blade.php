<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Access Token</title>
</head>
<body>
    <code id="access_token">{!! json_encode($access_token) !!}</code>
    <script>
        document.domain="saml.sp-b"

        var token = @json($access_token);

        (function(){
            window.parent.app.remoteAccessToken(token);
        })();
    </script>
</body>
</html>