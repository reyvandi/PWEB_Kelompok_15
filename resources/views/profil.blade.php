@extends('layouts.app')

@section('title', 'Profil')

@section('styles')
<style>
    body {
        background-color: #f8f9fa;
        font-family: 'Segoe UI', sans-serif;
    }
    .profile-section {
        background: white;
        border-radius: 1rem;
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        padding: 2rem;
        margin-top: 2rem;
    }
</style>
@endsection

@section('content')
<div class="container">
    <div class="profile-section">
        <h2 class="mb-4">Profil Saya</h2>
        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label">Nama</label>
                    <p class="form-control">{{ Auth::user()->name }}</p>
                </div>
                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <p class="form-control">{{ Auth::user()->email }}</p>
                </div>
                <div class="mb-3">
                    <label class="form-label">Role</label>
                    <p class="form-control">{{ Auth::user()->role }}</p>
                </div>
                <div class="d-flex gap-2">
                    <a href="{{ route('dashboard') }}" class="btn btn-success">Kembali ke Dashboard</a>
                    <form method="POST" action="{{ route('logout') }}" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-danger">
                            <i class="fas fa-sign-out-alt me-1"></i>Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
