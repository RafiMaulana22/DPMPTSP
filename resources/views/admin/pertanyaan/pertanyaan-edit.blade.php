@extends('layouts.template')

@section('breadcrumb')
    <ol class="breadcrumb m-0">
        <li class="breadcrumb-item">
            <a href="{{ route('dashboard') }}">Dashboard</a>
        </li>
        <li class="breadcrumb-item">
            <a href="{{ route('pertanyaan.index') }}">Pertanyaan</a>
        </li>
        <li class="breadcrumb-item active">{{ $title }}</li>
    </ol>
@endsection

@section('content')
    <div class="row">
        <div class="col-xxl-4">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Form Pertanyaan</h4>
                </div>
                <!-- end card header -->
                <div class="card-body">
                    <div class="live-preview">
                        <form action="{{ route('pertanyaan.update', $pertanyaan->token_pertanyaan) }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="pertanyaan" class="form-label">Pertanyaan</label>
                                <textarea class="form-control @error('pertanyaan') is-invalid @enderror" name="pertanyaan" id="pertanyaan" cols="30" rows="5">
                                    {{ $pertanyaan->pertanyaan }}
                                </textarea>
                                @error('pertanyaan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="text-end">
                                <button type="submit" class="btn btn-primary">Update</button>
                                <a href="{{ route('pertanyaan.index') }}" class="btn btn-danger">Kembali</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--end row-->
@endsection
