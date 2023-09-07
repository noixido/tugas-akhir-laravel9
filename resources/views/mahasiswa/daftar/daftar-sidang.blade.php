@extends('layouts.master-mahasiswa')
@section('title', 'Pendaftaran Sidang Tugas Akhir')
@section('content')
<div class="container">
    <div class="row" style="height: 100%">
        @if (session()->has('message'))
        <div class="alert alert-danger" style="text-align: center; width:100%">
            {{ session()->get('message') }}
        </div>
        @endif
        <form action="{{ route('proses-daftar-sidang') }}" class="row" style="margin-bottom: 130px" method="POST"
            enctype="multipart/form-data">
            @csrf
            <div class="col-md-6">
                <label for="nim" class="form-label">Nomor Induk Mahasiswa</label>
                <input type="text" class="form-control @error('nim') is-invalid @enderror" id="nim" name="nim"
                    value="{{ old('nim', $mhs->nim ?? '-') }}" disabled>
                @error('nim')
                <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            <div class="col-md-6">
                <label for="nama" class="form-label">Nama Mahasiswa</label>
                <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama"
                    value="{{ old('nama', $mhs->nama_mahasiswa ?? '-') }}" disabled>
                @error('nim')
                <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            <div class="col-md-6">
                <label for="jenjang" class="form-label">Jenjang</label>
                <input type="text" class="form-control @error('jenjang') is-invalid @enderror" id="jenjang"
                    name="jenjang" value="{{ old('jenjang', $mhs->program_studi->jenjang ?? '-') }}" disabled>
                @error('jenjang')
                <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            <div class="col-md-6">
                <label for="jurusan" class="form-label">Program Studi</label>
                <input type="text" class="form-control @error('jurusan') is-invalid @enderror" id="jurusan"
                    name="jurusan" value="{{ old('jurusan', $mhs->program_studi->nama_prodi ?? '-') }}" disabled>
                @error('jurusan')
                <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            <div class="col-md-6">
                <label for="konsentrasi" class="form-label">Konsentrasi Program Studi</label>
                <input type="text" class="form-control @error('konsentrasi') is-invalid @enderror" id="konsentrasi"
                    name="konsentrasi" value="{{ old('konsentrasi', $mhs->program_studi->konsentrasi ?? '-') }}"
                    disabled>
                @error('konsentrasi')
                <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            <div class="col-md-6">
                <label for="telepon_mahasiswa" class="form-label">Telepon Mahasiswa</label>
                <input type="number" class="form-control @error('telepon_mahasiswa') is-invalid @enderror"
                    id="telepon_mahasiswa" name="telepon_mahasiswa"
                    value="{{ old('telepon_mahasiswa', $mhs->telepon ?? '-') }}" disabled>
                @error('telepon_mahasiswa')
                <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            <div class="col-md-6">
                <label for="email_mahasiswa" class="form-label">Email Mahasiswa</label>
                <input type="email" class="form-control @error('email_mahasiswa') is-invalid @enderror"
                    id="email_mahasiswa" name="email_mahasiswa" value="{{ old('email_mahasiswa', $mhs->email ?? '-') }}"
                    disabled>
                @error('email_mahasiswa')
                <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            <div class="col-md-6">
                <label for="kelas" class="form-label">Kelas</label>
                <select id="kelas" class="form-select form-control @error('kelas') is-invalid @enderror" name="kelas">
                    <option value="" selected disabled>=== Pilih ===</option>
                    <option value="Reguler">Reguler</option>
                    <option value="Karyawan">Karyawan</option>
                    <option value="Beasiswa">Beasiswa</option>
                </select>
                @error('kelas')
                <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            <div class="col-md-6">
                <label for="tempat_lahir" class="form-label">Tempat Lahir</label>
                <input type="text" class="form-control @error('tempat_lahir') is-invalid @enderror" id="tempat_lahir"
                    name="tempat_lahir" value="{{ old('tempat_lahir') }}">
                @error('tempat_lahir')
                <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            <div class="col-md-6">
                <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                <input type="date" class="form-control @error('tanggal_lahir') is-invalid @enderror" id="tanggal_lahir"
                    name="tanggal_lahir" value="{{ old('tanggal_lahir') }}">
                @error('tanggal_lahir')
                <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            <div class="col-md-6">
                <label for="alamat_mahasiswa" class="form-label">Alamat Mahasiswa</label>
                <textarea style="height: 38px" name="alamat_mahasiswa" id="alamat_mahasiswa" cols="30" rows="10"
                    class="form-control @error('alamat_mahasiswa') is-invalid @enderror">{{ old('alamat_mahasiswa') }}</textarea>
                @error('alamat_mahasiswa')
                <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            <div class="col-md-6">
                <label for="ipk" class="form-label">IPK Saat Ini</label>
                <input type="number" step="any" class="form-control @error('ipk') is-invalid @enderror" id="ipk"
                    name="ipk" value="{{ old('ipk') }}">
                @error('ipk')
                <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            <div class="col-md-6">
                <label for="pembimbing" class="form-label">Dosen Pembimbing</label>
                <input type="text" class="form-control @error('pembimbing') is-invalid @enderror" id="pembimbing"
                    name="pembimbing" value="{{ old('pembimbing', $ta->nama_dosen ?? '-') }}" disabled>
                @error('pembimbing')
                <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            <div class="col-md-6">
                <label for="judul" class="form-label">Judul Tugas Akhir</label>
                <textarea style="height: 38px" name="judul" id="judul" cols="30" rows="10"
                    class="form-control @error('judul') is-invalid @enderror"
                    disabled>{{ old('judul', $ta->judul_tugas_akhir ?? '-') }}</textarea>
                @error('judul')
                <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            <div class="col-md-6">
                <label for="bimbingan" class="form-label">Bimbingan</label><br>
                <div style="display: flex; gap:30px">
                    <span>Total Bimbingan Diterima : <b>{{ $bimbinganCount }}</b></span>
                    <a href="{{ route('bimbingan') }}" target="_blank">lihat di sini ></a>
                </div>
            </div>
            <div class="col-md-6">
                <label for="pas_foto" class="form-label">Pas Foto</label>
                <div style="height: 200px; display: flex; justify-content:center">
                    <img class="pasFotoPreview img-fluid" style="max-height: 100%; width: auto; margin: 10px">
                </div>
                <input type="file" class="form-control @error('pas_foto') is-invalid @enderror" id="pas_foto"
                    name="pas_foto" onchange="previewPasFotoImage()">
                @error('pas_foto')
                <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            <div class="col-md-6">
                <label for="spp" class="form-label">Bukti Pembayaran SPP</label>
                <div style="height: 200px; display: flex; justify-content:center">
                    <img class="sppPreview img-fluid" style="max-height: 100%; width: auto; margin: 10px">
                </div>
                <input type="file" class="form-control @error('spp') is-invalid @enderror" id="spp" name="spp"
                    onchange="previewSppImage()">
                @error('spp')
                <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            <div class="col-md-6">
                <label for="ijazah" class="form-label">Ijazah Terakhir</label>
                <div style="height: 200px; display: flex; justify-content:center">
                    <img class="ijazahPreview img-fluid" style="max-height: 100%; width: auto; margin: 10px">
                </div>
                <input type="file" class="form-control @error('ijazah') is-invalid @enderror" id="ijazah" name="ijazah"
                    onchange="previewIjazahImage()">
                @error('ijazah')
                <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            <div class="col-md-6">
                <label for="akte" class="form-label">Akta Kelahiran</label>
                <div style="height: 200px; display: flex; justify-content:center">
                    <img class="aktePreview img-fluid" style="max-height: 100%; width: auto; margin: 10px">
                </div>
                <input type="file" class="form-control @error('akte') is-invalid @enderror" id="akte" name="akte"
                    onchange="previewAkteImage()">
                @error('akte')
                <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            <div class="col-md-6">
                <label for="kk" class="form-label">Kartu Keluarga</label>
                <div style="height: 200px; display: flex; justify-content:center">
                    <img class="kkPreview img-fluid" style="max-height: 100%; width: auto; margin: 10px">
                </div>
                <input type="file" class="form-control @error('kk') is-invalid @enderror" id="kk" name="kk"
                    onchange="previewKKImage()">
                @error('kk')
                <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            <div class="col-md-6">
                <label for="peka" class="form-label">Sertifikat PEKA</label>
                <div style="height: 200px; display: flex; justify-content:center">
                    <img class="pekaPreview img-fluid" style="max-height: 100%; width: auto; margin: 10px">
                </div>
                <input type="file" class="form-control @error('peka') is-invalid @enderror" id="peka" name="peka"
                    onchange="previewPekaImage()">
                @error('peka')
                <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            <div class="col-md-6">
                <label for="toefl" class="form-label">Sertifikat TOEFL</label>
                <div style="height: 200px; display: flex; justify-content:center">
                    <img class="toeflPreview img-fluid" style="max-height: 100%; width: auto; margin: 10px">
                </div>
                <input type="file" class="form-control @error('toefl') is-invalid @enderror" id="toefl" name="toefl"
                    onchange="previewToeflImage()">
                @error('toefl')
                <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            <div class="col-md-6">
                <label for="ujikom_1" class="form-label">Sertifikat Ujikom 1</label>
                <div style="height: 200px; display: flex; justify-content:center">
                    <img class="ujikom1Preview img-fluid" style="max-height: 100%; width: auto; margin: 10px">
                </div>
                <input type="file" class="form-control @error('ujikom_1') is-invalid @enderror" id="ujikom_1"
                    name="ujikom_1" onchange="previewUjikom1Image()">
                @error('ujikom_1')
                <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            <div class="col-md-6">
                <label for="ujikom_2" class="form-label">Sertifikat Ujikom 2</label>
                <div style="height: 200px; display: flex; justify-content:center">
                    <img class="ujikom2Preview img-fluid" style="max-height: 100%; width: auto; margin: 10px">
                </div>
                <input type="file" class="form-control @error('ujikom_2') is-invalid @enderror" id="ujikom_2"
                    name="ujikom_2" onchange="previewUjikom2Image()">
                @error('ujikom_2')
                <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            <div class="col-md-6">
                <label for="ujikom_3" class="form-label">Sertifikat Ujikom 3 <b style="color: red">*</b></label>
                <div style="height: 200px; display: flex; justify-content:center">
                    <img class="ujikom3Preview img-fluid" style="max-height: 100%; width: auto; margin: 10px">
                </div>
                <input type="file" class="form-control @error('ujikom_3') is-invalid @enderror" id="ujikom_3"
                    name="ujikom_3" onchange="previewUjikom3Image()">
                @error('ujikom_3')
                <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            <div class="col-md-6">
                <label for="ujikom_4" class="form-label">Sertifikat Ujikom 4 <b style="color: red">*</b></label>
                <div style="height: 200px; display: flex; justify-content:center">
                    <img class="ujikom4Preview img-fluid" style="max-height: 100%; width: auto; margin: 10px">
                </div>
                <input type="file" class="form-control @error('ujikom_4') is-invalid @enderror" id="ujikom_4"
                    name="ujikom_4" onchange="previewUjikom4Image()">
                @error('ujikom_4')
                <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            <p style="color: red; font-size: 12px; margin-top: 50px; margin-left: 20px">
                *jika anda hanya memiliki 2-3 sertifikat uji kompetisi saja, cukup masukan data sampai scan sertifikat
                ujikom 2 atau 3.
            </p>
            <div class="col-12" style="margin-top: 20px; text-align:center">
                <button type="submit" class="btn btn-primary">Daftar Sidang</button>
            </div>
        </form>
    </div>
</div>
<script>
    function previewPasFotoImage(){
        const pasFoto = document.querySelector('#pas_foto');
        const pasFotoImgPreview = document.querySelector('.pasFotoPreview');

        pasFotoImgPreview.style.display = 'block';

        const oFReader = new FileReader();
        oFReader.readAsDataURL(pasFoto.files[0]);

        oFReader.onload = function(oFREvent){
            pasFotoImgPreview.src = oFREvent.target.result;
        }
    }
    function previewSppImage(){
        const sppImg = document.querySelector('#spp');
        const sppImgPreview = document.querySelector('.sppPreview');
    
        sppImgPreview.style.display = 'block';
    
        const oFReader = new FileReader();
        oFReader.readAsDataURL(sppImg.files[0]);
    
        oFReader.onload = function(oFREvent){
            sppImgPreview.src = oFREvent.target.result;
        }
    }
    function previewIjazahImage(){
        const ijazahImg = document.querySelector('#ijazah');
        const ijazahImgPreview = document.querySelector('.ijazahPreview');
        
        ijazahImgPreview.style.display = 'block';
        
        const oFReader = new FileReader();
        oFReader.readAsDataURL(ijazahImg.files[0]);
        
        oFReader.onload = function(oFREvent){
            ijazahImgPreview.src = oFREvent.target.result;
        }
    }
    function previewAkteImage(){
        const akteImg = document.querySelector('#akte');
        const akteImgPreview = document.querySelector('.aktePreview');
        
        akteImgPreview.style.display = 'block';
        
        const oFReader = new FileReader();
        oFReader.readAsDataURL(akteImg.files[0]);
        
        oFReader.onload = function(oFREvent){
            akteImgPreview.src = oFREvent.target.result;
        }
    }
    function previewKKImage(){
        const kkImg = document.querySelector('#kk');
        const kkImgPreview = document.querySelector('.kkPreview');
        
        kkImgPreview.style.display = 'block';
        
        const oFReader = new FileReader();
        oFReader.readAsDataURL(kkImg.files[0]);
        
        oFReader.onload = function(oFREvent){
            kkImgPreview.src = oFREvent.target.result;
        }
    }
    function previewPekaImage(){
        const pekaImg = document.querySelector('#peka');
        const pekaImgPreview = document.querySelector('.pekaPreview');
        
        pekaImgPreview.style.display = 'block';
        
        const oFReader = new FileReader();
        oFReader.readAsDataURL(pekaImg.files[0]);
        
        oFReader.onload = function(oFREvent){
            pekaImgPreview.src = oFREvent.target.result;
        }
    }
    function previewToeflImage(){
        const toeflImg = document.querySelector('#toefl');
        const toeflImgPreview = document.querySelector('.toeflPreview');
        
        toeflImgPreview.style.display = 'block';
        
        const oFReader = new FileReader();
        oFReader.readAsDataURL(toeflImg.files[0]);
        
        oFReader.onload = function(oFREvent){
            toeflImgPreview.src = oFREvent.target.result;
        }
    }
    function previewUjikom1Image(){
        const ujikom1Img = document.querySelector('#ujikom_1');
        const ujikom1ImgPreview = document.querySelector('.ujikom1Preview');
        
        ujikom1ImgPreview.style.display = 'block';
        
        const oFReader = new FileReader();
        oFReader.readAsDataURL(ujikom1Img.files[0]);
        
        oFReader.onload = function(oFREvent){
            ujikom1ImgPreview.src = oFREvent.target.result;
        }
    }
    function previewUjikom2Image(){
        const ujikom2Img = document.querySelector('#ujikom_2');
        const ujikom2ImgPreview = document.querySelector('.ujikom2Preview');
        
        ujikom2ImgPreview.style.display = 'block';
        
        const oFReader = new FileReader();
        oFReader.readAsDataURL(ujikom2Img.files[0]);
        
        oFReader.onload = function(oFREvent){
        ujikom2ImgPreview.src = oFREvent.target.result;
        }
    }
    function previewUjikom3Image(){
        const ujikom3Img = document.querySelector('#ujikom_3');
        const ujikom3ImgPreview = document.querySelector('.ujikom3Preview');
        
        ujikom3ImgPreview.style.display = 'block';
        
        const oFReader = new FileReader();
        oFReader.readAsDataURL(ujikom3Img.files[0]);
        
        oFReader.onload = function(oFREvent){
            ujikom3ImgPreview.src = oFREvent.target.result;
        }
    }
    function previewUjikom4Image(){
        const ujikom4Img = document.querySelector('#ujikom_4');
        const ujikom4ImgPreview = document.querySelector('.ujikom4Preview');
        
        ujikom4ImgPreview.style.display = 'block';
        
        const oFReader = new FileReader();
        oFReader.readAsDataURL(ujikom4Img.files[0]);
        
        oFReader.onload = function(oFREvent){
            ujikom4ImgPreview.src = oFREvent.target.result;
        }
    }
</script>
@endsection