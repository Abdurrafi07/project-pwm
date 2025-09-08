@extends('layouts.app')

@section('title', 'Dashboard Admin')

@section('content')
<h1>Dashboard Admin</h1>
<div>
    <p>Total UMKM: {{ $totalUmkm }}</p>
    <p>Total Berita: {{ $totalNews }}</p>
    <p>Total Pengurus: {{ $totalPengurus }}</p>
</div>
@endsection
