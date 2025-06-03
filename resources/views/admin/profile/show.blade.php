@extends('layouts.template')

@section('style')
    <style>
        /* CSS kustom bisa ditambahkan di sini jika perlu */
        .card-body dt {
            font-weight: 600;
        }
    </style>
@endsection

@section('breadcrumb')
    <ol class="breadcrumb m-0">
        <li class="breadcrumb-item">
            <a href="{{ route('dashboard') }}">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">{{ $title }}</li>
    </ol>
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-8 mx-auto"> {{-- Menggunakan mx-auto untuk menengahankan card di layar besar --}}
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Informasi Profil</h6>
                </div>
                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    <div class="row">
                        {{-- Kolom untuk Foto Profil (Opsional) --}}
                        <div class="col-md-4 text-center mb-3 mb-md-0">
                            @if (Auth::user()->profile_photo_path)
                                {{-- Ganti dengan field foto profil Anda jika ada --}}
                                <img src="{{ Storage::url(Auth::user()->profile_photo_path) }}"
                                    alt="Foto Profil {{ $user->name }}" class="img-fluid rounded-circle"
                                    style="width: 150px; height: 150px; object-fit: cover;">
                            @else
                                {{-- Atau Anda bisa menggunakan inisial nama: --}}
                                <div class="d-flex justify-content-center align-items-center rounded-circle bg-primary mx-auto text-white"
                                    style="width: 150px; height: 150px; font-size: 3rem;">
                                    {{ strtoupper(substr($user->name, 0, 1)) }}
                                </div>
                            @endif
                            <h5 class="mt-3">{{ $user->name }}</h5>
                            <p class="text-muted">{{ $user->email }}</p>
                        </div>

                        {{-- Kolom untuk Detail Informasi --}}
                        <div class="col-md-8">
                            <dl class="row">
                                <dt class="col-sm-4">Nama Lengkap:</dt>
                                <dd class="col-sm-8">{{ $user->name }}</dd>

                                <dt class="col-sm-4">Alamat Email:</dt>
                                <dd class="col-sm-8">{{ $user->email }}</dd>

                                <dt class="col-sm-4">Role:</dt>
                                <dd class="col-sm-8">Admin</dd>

                                {{-- Contoh jika ada field username --}}
                                {{-- @if ($user->username)
                                <dt class="col-sm-4">Username:</dt>
                                <dd class="col-sm-8">{{ $user->username }}</dd>
                                @endif --}}

                                {{-- Contoh jika ada field nomor telepon --}}
                                {{-- @if ($user->phone_number)
                                <dt class="col-sm-4">Nomor Telepon:</dt>
                                <dd class="col-sm-8">{{ $user->phone_number }}</dd>
                                @endif --}}

                                <dt class="col-sm-4">Tanggal Bergabung:</dt>
                                <dd class="col-sm-8">
                                    {{ $user->created_at ? $user->created_at->format('d F Y, H:i') : '-' }}
                                </dd>

                                <dt class="col-sm-4">Terakhir Diperbarui:</dt>
                                <dd class="col-sm-8">{{ $user->updated_at ? $user->updated_at->diffForHumans() : '-' }}
                                </dd>
                            </dl>

                            <hr>

                            {{-- Tombol Aksi --}}
                            <div class="mt-3">
                                <a href="{{ route('profile.edit') }}" class="btn btn-primary btn-sm me-2">
                                    <i class="mdi mdi-account-edit-outline me-1"></i>
                                    Ubah Profile
                                </a>
                                <a href="{{ route('password.edit') }}" class="btn btn-warning btn-sm">
                                    <i class="mdi mdi-lock-outline me-1"></i>
                                    Ubah Password
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
