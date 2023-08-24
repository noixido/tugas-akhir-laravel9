<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>SI Sidang TEDC</title>
    <link rel="stylesheet" href="{{ asset('/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/fonts.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/style-login.css') }}">
    <script type="text/javascript" src="{{ asset('/js/bootstrap.min.js') }}"></script>
</head>

<body>
    <div class="container">
        <div class="row content">
            <div class="col-md-6 mb-3">
                <img class="image-fluid" src="{{ asset('/images/logo-tedc.png') }}" alt="logo poltek tedc">
            </div>
            <div class="col-md-6 signin-form">
                <h3 class="signin-text mb-3">Selamat Datang!</h3>
                <form action="/login" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" name="username" id="username" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" name="password" id="password" class="form-control">
                    </div>
                    <div class="button-container" style="gap: 10px">
                        <button class="btn btn-class">Login</button>
                        <a href="/daftar" class="btn btn-secondary">Daftar</a>
                    </div>
                    @if ($message = Session::get('login-error'))
                    <br>
                    <br>
                    <br>
                    <h6>{{ $message }}</h6>
                    @endif
                </form>
            </div>
        </div>
    </div>
</body>

</html>