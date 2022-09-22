<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/fonts.css">
    <link rel="stylesheet" href="/css/style-sidebar.css">
    <link rel="stylesheet" href="/css/style-main.css">
</head>

<body>

    <div class="container-menu">
        {{-- niatnya sidebar --}}
        <div class="sidebar">
            <div class="header-sidebar">
                <div class="illustration">
                    <img src="/images/logo-tedc.png" alt="logo tedc">
                    <span class="desc-header">{{ Auth::user()->nama }}</span>
                </div>
            </div>
            <div class="main-sidebar">
                {{-- dashboard aja --}}
                <div class="list-item">
                    <a href="/dosen">
                        <img class="icon" src="/images/gauge.svg" alt="icon">
                        <span class="desc-main">Dashboard</span>
                    </a>
                </div>

                {{-- buat bimbingan, sebagai pembimbing --}}
                <div class="spacer">
                    <span class="desc-spacer">Pembimbing</span>
                </div>
                <div class="list-item">
                    <a href="#">
                        <img class="icon" src="/images/gauge.svg" alt="icon">
                        <span class="desc-main">Bimbingan</span>
                    </a>
                </div>

                {{-- buat kasih nilai, sebagai penguji --}}
                <div class="spacer">
                    <span class="desc-spacer">Penguji</span>
                </div>
                <div class="list-item">
                    <a href="#">
                        <img class="icon" src="/images/gauge.svg" alt="icon">
                        <span class="desc-main">Nilai</span>
                    </a>
                </div>

                {{-- buat logout,, ini paling terakhir ya!!! --}}
                <div class="list-item logout">
                    <a href="/logout">
                        <img class="icon" src="/images/gauge.svg" alt="icon">
                        <span class="desc-main">Logout</span>
                    </a>
                </div>
            </div>
        </div>

        {{-- niatnya menu utama --}}
        <div class="main-content">
            @yield('content')
        </div>
    </div>

    <script type="text/javascript" src="/js/bootstrap.min.js"></script>
    {{-- <script type="text/javascript" src="/js/style-layout.js"></script> --}}
</body>

</html>