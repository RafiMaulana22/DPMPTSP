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
        <div class="col-xxl-4">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Form Kriteria</h4>
                </div>
                <!-- end card header -->
                <div class="card-body">
                    <div class="live-preview">
                        <form action="{{ route('kriteria.store') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="nama_kriteria" class="form-label">Nama Kriteria</label>
                                <input type="text" name="nama_kriteria" value="{{ old('nama_kriteria') }}"
                                    class="form-control @error('nama_kriteria') is-invalid @enderror" id="nama_kriteria"
                                    placeholder="Masukkan nama kriteria...">
                                @error('nama_kriteria')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="bobot" class="form-label">Bobot</label>
                                <input type="number" name="bobot" value="{{ old('bobot') }}"
                                    class="form-control @error('bobot') is-invalid @enderror" id="bobot"
                                    placeholder="Masukkan bobot...">
                                @error('bobot')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="jenis" class="form-label">Jenis</label>
                                <select name="jenis" id="jenis" class="form-select @error('jenis') is-invalid @enderror">
                                    <option value="" selected disabled>-- Pilih --</option>
                                    <option value="benefit" {{ old('jenis') == 'benefit' ? 'selected' : '' }}>Benefit</option>
                                    <option value="const" {{ old('jenis') == 'const' ? 'selected' : '' }}>Const</option>
                                </select>
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
                    <h5 class="card-title mb-0">List Kriteria</h5>
                </div>
                <div class="card-body">
                    <table id="example" class="table table-bordered dt-responsive nowrap table-striped align-middle"
                        style="width:100%">
                        <thead>
                            <tr>
                                <th data-ordering="false">No</th>
                                <th data-ordering="false">Nama Kriteria</th>
                                <th data-ordering="false">Bobot</th>
                                <th data-ordering="false">Jenis</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($kriteria as $key => $value)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $value->nama_kriteria }}</td>
                                    <td>{{ $value->bobot }}</td>
                                    <td>
                                        @if ($value->jenis == 'benefit')
                                            <span class="badge bg-info-subtle text-info">Benefit</span>
                                        @else
                                            <span class="badge bg-danger-subtle text-danger">Const</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="dropdown d-inline-block">
                                            <button class="btn btn-soft-secondary btn-sm dropdown" type="button"
                                                data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="ri-more-fill align-middle"></i>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-end">
                                                <li><a class="dropdown-item edit-item-btn"><i
                                                            class="ri-pencil-fill align-bottom me-2 text-muted"></i>
                                                        Edit</a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item remove-item-btn">
                                                        <i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i>
                                                        Delete
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
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
