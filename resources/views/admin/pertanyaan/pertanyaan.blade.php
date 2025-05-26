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
                                            <button class="btn btn-danger" type="button" data-bs-toggle="modal"
                                                data-bs-target="#hapus{{ $value->token_pertanyaan }}">
                                                Hapus
                                            </button>
                                        </div>
                                    </td>
                                </tr>

                                <!-- Delete Modal -->
                                <div id="hapus{{ $value->token_pertanyaan }}" class="modal fade" tabindex="-1"
                                    aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="myModalLabel">Peringatan!</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"> </button>
                                            </div>
                                            <div class="modal-body">
                                                <p class="text-muted">Apakah anda yakin ingin menghapus data dibawah ini?
                                                </p>
                                                <h5 class="fs-15">
                                                    "{{ $value->pertanyaan }}"
                                                </h5>
                                            </div>
                                            <div class="modal-footer">
                                                <a href="{{ route('pertanyaan.destroy', ['pertanyaan' => $value->token_pertanyaan]) }}"
                                                    class="btn btn-danger">
                                                    Hapus!
                                                </a>
                                            </div>

                                        </div><!-- /.modal-content -->
                                    </div><!-- /.modal-dialog -->
                                </div><!-- /.modal -->
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
