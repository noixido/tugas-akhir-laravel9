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
        <div class="row content">
            <div class="col-md-6 mb-3">
                <img class="image-fluid" src="{{ asset('/images/logo-tedc.png') }}" alt="logo poltek tedc">
            </div>
            <div class="col-md-6 signin-form">
                <h3 class="signin-text mb-3">Selamat Datang!</h3>
                {{-- {{ print_r($errors->all()) }} --}}
                <form action="/registrasi" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="nama">Nama Lengkap</label>
                        <input type="text" name="nama" id="nama"
                            class="form-control @error('nama') is-invalid @enderror">
                        @error('nama')
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
                    <div class="form-group">
                        <label for="nim">NIM</label>
                        <input type="text" name="nim" id="nim" class="form-control @error('nim') is-invalid @enderror">
                        @error('nim')
                        <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="angkatan">Angkatan</label>
                        <input type="text" name="angkatan" id="angkatan"
                            class="form-control @error('angkatan') is-invalid @enderror">
                        @error('angkatan')
                        <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="program_studi">Program Studi</label>
                        <select class="form-control @error('program_studi_id') is-invalid @enderror"
                            name="program_studi" id="program_studi">
                            <option selected disabled>---Pilih Program Studi---</option>
                            @foreach ($data as $row)
                            <option value="{{ $row->id }}">{{ $row->jenjang }} {{ $row->nama_prodi }} {{
                                $row->konsentrasi }}</option>
                            @endforeach
                        </select>
                        @error('program_studi_id')
                        <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email"
                            class="form-control @error('email') is-invalid @enderror">
                        @error('email')
                        <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="tempat_lahir">Tempat Lahir</label>
                        <input type="text" name="tempat_lahir" id="tempat_lahir"
                            class="form-control @error('tempat_lahir') is-invalid @enderror">
                        @error('tempat_lahir')
                        <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="tanggal_lahir">Tanggal Lahir</label>
                        <input type="date" name="tanggal_lahir" id="tanggal_lahir"
                            class="form-control @error('tanggal_lahir') is-invalid @enderror">
                        @error('tanggal_lahir')
                        <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="no_telepon">Nomor Telepon</label>
                        <input type="number" name="no_telepon" id="no_telepon"
                            class="form-control @error('no_telepon') is-invalid @enderror">
                        @error('no_telepon')
                        <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="judul_ta">Judul Tugas Akhir</label>
                        <input type="text" name="judul_tugas_akhir" id="judul_tugas_akhir"
                            class="form-control @error('judul_tugas_akhir') is-invalid @enderror">
                        @error('judul_tugas_akhir')
                        <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="pembimbing">Pembimbing</label>
                        <input type="text" name="pembimbing" id="pembimbing"
                            class="form-control @error('pembimbing') is-invalid @enderror">
                        @error('pembimbing')
                        <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="button-container">
                        <button class="btn btn-class">Daftar</button>
                        <a href="/" class="signup">kembali</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>