@extends('layouts.template')

@section('breadcrumb')
    <ol class="breadcrumb m-0">
        <li class="breadcrumb-item">
            <a href="{{ route('dashboard') }}">Dashboard</a>
        </li>
        <li class="breadcrumb-item">
            <a href="{{ route('pilihan.index') }}">Pilihan</a>
        </li>
        <li class="breadcrumb-item active">{{ $title }}</li>
    </ol>
@endsection

@section('content')
    <div class="row g-3">
        @if (session('success'))
            <div class="col-xxl-12">
                <div class="alert alert-success alert-border-left alert-dismissible fade show material-shadow"
                    role="alert">
                    <i class="ri-check-double-line me-3 align-middle fs-16"></i>
                    <strong>Success</strong>
                    - {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
        @endif

        @if (session('error'))
            <div class="col-xxl-12">
                <div class="alert alert-danger alert-border-left alert-dismissible fade show mb-xl-0 material-shadow"
                    role="alert">
                    <i class="ri-error-warning-line me-3 align-middle fs-16"></i>
                    <strong>Error</strong>
                    - {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
        @endif

        <div class="col-xxl-4">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Form Pilihan</h4>
                </div>
                <!-- end card header -->
                <div class="card-body">
                    <div class="live-preview">
                        <form action="{{ route('pilihan.update', ['pilihan' => $pilihan]) }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="pilihan" class="form-label">Pilihan</label>
                                <input type="text" class="form-control @error('pilihan') is-invalid @enderror"
                                    name="pilihan" id="pilihan" value="{{ $pilihan->pilihan }}">
                                @error('pilihan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="nilai" class="form-label">Nilai</label>
                                <input type="number" class="form-control @error('nilai') is-invalid @enderror"
                                    name="nilai" id="nilai" value="{{ $pilihan->nilai }}">
                                @error('nilai')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="text-end">
                                <button type="submit" class="btn btn-primary">Update</button>
                                <a href="{{ route('pilihan.index' ) }}" class="btn btn-danger">Kembali</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--end row-->
@endsection
