<!DOCTYPE html>
<html>

<head>
    <title>403 Forbidden</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            padding-top: 50px;
        }

        .error-box {
            max-width: 500px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        .btn {
            display: inline-block;
            padding: 10px 20px;
            background: #dc3545;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <div class="error-box">
        <a href="/logout" data-method="POST"
            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <i class="uil uil-sign-out-alt"></i>
            <span class="link-name">Logout</span>
        </a>
        <form id="logout-form" action="/logout" method="POST" style="display: none;">
            @csrf
            @method('POST')
        </form>
    </div>
</body>

</html>
