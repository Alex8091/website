<!doctype html>
<html lang="en">
<head>
    <style>
        .footer {
            font-size: .75em;
            color: #999;
        }
        a {
            text-decoration: none;
            color: #3b8bba;
        }
        a:focus, a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
@yield('content')
<p class="footer">
    Don't want to receive these emails anymore? <a href="{{{ $unsubscribe_url }}}">Unsubscribe</a>.
</p>
</body>
</html>
