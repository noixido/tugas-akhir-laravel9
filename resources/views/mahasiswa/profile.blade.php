@extends('layouts.master-mahasiswa')
@section('title', 'Profile')
@section('content')
<div class="container">
    <h1>Halo Dari Profile Mahasiswa</h1>
    <h3>{{ $data->nama }}</h3>
    <h3>{{ $data->nim }}</h3>
    <h3>{{ $data->jenjang }} {{ $data->nama_prodi }}</h3>
    <p><strong>{{ $data->pembimbing }}</strong> {{ $data->judul_tugas_akhir }}</p>
</div>
@endsection