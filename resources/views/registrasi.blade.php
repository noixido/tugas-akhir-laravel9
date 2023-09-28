<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>SI Sidang TEDC</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/fonts.css">
    <link rel="stylesheet" href="/css/style-login.css">
    <script type="text/javascript" src="/js/bootstrap.min.js"></script>
</head>

<body>
    <div class="container">
        <div class="row content" style="margin: 50px">
            {{-- <div class="col-md-6 mb-3">
                <img class="image-fluid" src="{{ asset('/images/logo-tedc.png') }}" alt="logo poltek tedc">
            </div> --}}
            <div class="col-md-6 signin-form" style="margin: auto">
                <h3 class="signin-text mb-3" style="text-align: center">Selamat Datang!</h3>
                {{-- {{ print_r($errors->all()) }} --}}
                <form action="/registrasi" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="nama">Nama Mahasiswa</label>
                        <input type="text" name="nama" id="nama"
                            class="form-control @error('nama') is-invalid @enderror">
                        @error('nama')
                        <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="nim">Nomor Induk Mahasiswa</label>
                        <input type="text" name="nim" id="nim" class="form-control @error('nim') is-invalid @enderror">
                        @error('nim')
                        <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" name="username" id="username"
                            class="form-control @error('username') is-invalid @enderror">
                        @error('username')
                        <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" name="password" id="password"
                            class="form-control @error('password') is-invalid @enderror">
                        @error('password')
                        <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="button-container" style="gap: 10px">
                        <button class="btn btn-class">Daftar</button>
                        <a href="/" class="btn btn-light">kembali</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>