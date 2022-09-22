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
                    <a href="{{ route('akademik_profile', Auth::user()->username) }}" class="desc-header">{{
                        Auth::user()->nama
                        }}</a>
                </div>
            </div>
            <div class="main-sidebar">
                {{-- dashboard aja --}}
                <div class="list-item">
                    <a href="/akademik">
                        <img class="icon" src="/images/gauge.svg" alt="icon">
                        <span class="desc-main">Dashboard</span>
                    </a>
                </div>

                {{-- buat pendaftaran --}}
                <div class="spacer">
                    <span class="desc-spacer">Pendaftaran Sidang</span>
                </div>
                <div class="list-item">
                    <a href="#">
                        <img class="icon" src="/images/gauge.svg" alt="icon">
                        <span class="desc-main">Data Pendaftaran</span>
                    </a>
                </div>

                {{-- buat bikin jadwal --}}
                <div class="spacer">
                    <span class="desc-spacer">Penjadwalan Sidang</span>
                </div>
                <div class="list-item">
                    <a href="#">
                        <img class="icon" src="/images/gauge.svg" alt="icon">
                        <span class="desc-main">Draft Jadwal</span>
                    </a>
                </div>
                <div class="list-item">
                    <a href="#">
                        <img class="icon" src="/images/gauge.svg" alt="icon">
                        <span class="desc-main">Jadwal Jadi</span>
                    </a>
                </div>

                {{-- buat review nilai sidang mahasiswa --}}
                <div class="spacer">
                    <span class="desc-spacer">Nilai-Nilai</span>
                </div>
                <div class="list-item">
                    <a href="#">
                        <img class="icon" src="/images/gauge.svg" alt="icon">
                        <span class="desc-main">Data Nilai</span>
                    </a>
                </div>

                {{-- buat data data pengguna --}}
                <div class="spacer">
                    <span class="desc-spacer">Pengguna</span>
                </div>
                <div class="list-item">
                    <a href="{{ route('data-mahasiswa') }}">
                        <img class="icon" src="/images/gauge.svg" alt="icon">
                        <span class="desc-main">Data Mahasiswa</span>
                    </a>
                </div>
                <div class="list-item">
                    <a href="#">
                        <img class="icon" src="/images/gauge.svg" alt="icon">
                        <span class="desc-main">Data Dosen</span>
                    </a>
                </div>
                <div class="list-item">
                    <a href="#">
                        <img class="icon" src="/images/gauge.svg" alt="icon">
                        <span class="desc-main">Data Staff Prodi</span>
                    </a>
                </div>
                <div class="list-item">
                    <a href="#">
                        <img class="icon" src="/images/gauge.svg" alt="icon">
                        <span class="desc-main">Data Admin</span>
                    </a>
                </div>

                {{-- buat data data pelengkap --}}
                <div class="spacer">
                    <span class="desc-spacer">Lain-Lain</span>
                </div>
                <div class="list-item">
                    <a href="#">
                        <img class="icon" src="/images/gauge.svg" alt="icon">
                        <span class="desc-main">Data Ruangan</span>
                    </a>
                </div>
                <div class="list-item">
                    <a href="#">
                        <img class="icon" src="/images/gauge.svg" alt="icon">
                        <span class="desc-main">Data Prodi</span>
                    </a>
                </div>
                <div class="list-item">
                    <a href="#">
                        <img class="icon" src="/images/gauge.svg" alt="icon">
                        <span class="desc-main">Data Periode Sidang</span>
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