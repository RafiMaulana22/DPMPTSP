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
    <div class="row g-3">
        @if (session('success'))
            <div class="col-xxl-12">
                <div class="alert alert-success alert-border-left alert-dismissible fade show material-shadow" role="alert">
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
                    <h4 class="card-title mb-0 flex-grow-1">Form Pertanyaan</h4>
                </div>
                <!-- end card header -->
                <div class="card-body">
                    <div class="live-preview">
                        <form action="{{ route('pertanyaan.store') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="pertanyaan" class="form-label">Pertanyaan</label>
                                <textarea class="form-control @error('pertanyaan') is-invalid @enderror" name="pertanyaan" id="pertanyaan"
                                    cols="30" rows="5"></textarea>
                                @error('pertanyaan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Pilih jawaban</label>
                                <div class="d-flex gap-2 justify-content-around flex-wrap ">
                                    @foreach (App\Models\pilihan::get() as $item)
                                        <label for="">
                                            <input type="checkbox" name="pilihan[]" value="{{ $item->id_pilihan }}">
                                            {{ $item->pilihan }}
                                        </label>
                                    @endforeach
                                </div>
                            </div>
                            <div class="text-end">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">List pertanyaan</h5>
                </div>
                <div class="card-body">
                    <table id="example" class="table table-bordered dt-responsive nowrap table-striped align-middle"
                        style="width:100%">
                        <thead>
                            <tr>
                                <th data-ordering="false">No</th>
                                <th data-ordering="false">Pertanyaan</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pertanyaan as $key => $value)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $value->pertanyaan }}</td>
                                    <td>
                                        <div class="dropdown d-inline-block">
                                            <button class="btn btn-soft-secondary btn-sm dropdown" type="button"
                                                data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="ri-more-fill align-middle"></i>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-end">
                                                <li>
                                                    <button class="dropdown-item remove-item-btn" type="button"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#delete{{ $value->token_pertanyaan }}">
                                                        <i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i>
                                                        Delete
                                                    </button>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>

                                <!-- Delete Modal -->
                                <div class="modal fade" id="delete{{ $value->token_pertanyaan }}" aria-hidden="true"
                                    aria-labelledby="..." tabindex="-1">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-body text-center p-5">
                                                <lord-icon src="https://cdn.lordicon.com/nhqwlgwt.json" trigger="morph"
                                                    stroke="light" state="morph-trash-in"
                                                    colors="primary:#121331,secondary:#16a9c7,tertiary:#646e78,quaternary:#ebe6ef"
                                                    style="width:200px;height:200px">
                                                </lord-icon>
                                                <div class="mt-4 pt-4">
                                                    <h4>Peringatan, Delete {{ $value->pertanyaan }}!</h4>
                                                    <p class="text-muted"> Data yang dihapus tidak bisa dikembalikan.</p>
                                                    <a class="btn btn-danger"
                                                        href="{{ route('pertanyaan.destroy', $value->token_pertanyaan) }}">
                                                        Hapus
                                                    </a>
                                                    <button type="button" class="btn btn-primary"
                                                        data-bs-dismiss="modal">
                                                        Kembali
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!--end col-->
    </div>
    <!--end row-->
@endsection
