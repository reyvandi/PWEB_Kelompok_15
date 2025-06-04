@extends('layouts.app')

@section('title', 'Dashboard')

@section('styles')
    <style>
        body {
            background:url('{{ asset('images/dashboard.jpg') }}') no-repeat center center fixed;
            font-family: 'Segoe UI', sans-serif;
        }
        .card {
            border: none;
            border-radius: 1rem;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        .hero {
            background: linear-gradient(to right, #a8e6cf, #dcedc1);
            padding: 40px;
            border-radius: 1rem;
        }
    </style>
@endsection

@section('content')
<div class="container mt-4">
    <div class="hero text-center">
        <h1>Selamat Datang di Dashboard 🌱</h1>
        <p class="lead">Bersama SahabatLadang, wujudkan pertanian milenial berbasis teknologi!</p>
    </div>

    <div class="row mt-5">
        <div class="col-md-4 mb-4">
            <div class="card p-3">
                <h5 class="card-title">Monitoring Lahan</h5>
                <p class="card-text">Lihat data historis Anda.</p>
                <a href="{{ route('monitoring.lahan') }}" class="btn btn-success">Lihat Detail</a>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card p-3">
                <h5 class="card-title">Modul Belajar Visual & Interaktif</h5>
                <p class="card-text">Cek estimasi panen berikutnya dan jadwal distribusi.</p>
                <a href="{{ route('modul-education') }}" class="btn btn-success">Belajar</a>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card p-3">
                <h5 class="card-title">Komunitas Petani</h5>
                <p class="card-text">Terhubung dengan petani lain, berbagi ilmu & solusi.</p>
                <a href="{{ route('forum.index') }}" class="btn btn-success">Gabung Komunitas</a>
            </div>
        </div>
    </div>
</div>
@endsection
