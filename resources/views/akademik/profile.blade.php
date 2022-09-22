@extends('layouts.master-admin')
@section('title', 'Profile')
@section('content')
<div class="container">
    <h1>Halo Dari Profile Akademik</h1>
    <h3>{{ $data->nama }}</h3>
    <h4>{{ $data->username }}</h4>
</div>
@endsection