@extends('layouts.template')

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
        <div class="col-lg-6 mx-auto"> {{-- Card dibuat lebih ramping --}}
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Form Ubah Password</h6>
                </div>
                <div class="card-body">
                    {{-- Menampilkan pesan sukses jika redirect kembali ke halaman ini --}}
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    {{-- Menampilkan pesan error umum dari validasi password saat ini (jika ada) --}}
                    @if ($errors->has('current_password_custom_error'))
                        {{-- Nama error kustom jika diperlukan --}}
                        <div class="alert alert-danger">
                            {{ $errors->first('current_password_custom_error') }}
                        </div>
                    @endif


                    <form method="POST" action="{{ route('password.update') }}">
                        @csrf

                        {{-- Input Password Saat Ini --}}
                        <div class="mb-3">
                            <label for="current_password" class="form-label">Password Saat Ini</label>
                            <input type="password" class="form-control @error('current_password') is-invalid @enderror"
                                id="current_password" name="current_password" required>
                            @error('current_password')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        {{-- Input Password Baru --}}
                        <div class="mb-3">
                            <label for="password" class="form-label">Password Baru</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror"
                                id="password" name="password" required>
                            @error('password')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                            <div id="passwordHelpBlock" class="form-text">
                                Password baru minimal 8 karakter, mengandung huruf besar, huruf kecil, angka, dan simbol.
                            </div>
                        </div>

                        {{-- Input Konfirmasi Password Baru --}}
                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label">Konfirmasi Password Baru</label>
                            <input type="password" class="form-control" id="password_confirmation"
                                name="password_confirmation" required>
                            {{-- Error untuk password_confirmation biasanya ditampilkan di bawah field 'password' oleh aturan 'confirmed' --}}
                        </div>

                        {{-- Tombol Submit --}}
                        <div class="mt-4">
                            <button type="submit" class="btn btn-primary btn-sm">
                                <i class="mdi mdi-lock-reset me-1"></i>
                                Ubah Password
                            </button>
                            <a href="{{ route('profile.show') }}" class="btn btn-secondary btn-sm ms-2">
                                <i class="mdi mdi-cancel me-1"></i> Batal
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
