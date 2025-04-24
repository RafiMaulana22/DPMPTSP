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
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">List Pengunjung</h5>
            </div>
            <div class="card-body">
                <table id="example" class="table table-bordered dt-responsive nowrap table-striped align-middle"
                    style="width:100%">
                    <thead>
                        <tr>
                            <th data-ordering="false">No</th>
                            <th data-ordering="false">Nama Pengunjung</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($alternatif as $key => $value)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $value->nama_alternatif }}</td>
                                <td>
                                    <div class="dropdown d-inline-block">
                                        <a href="{{ route('alternatif.show', ['alternatif' => $value->token_alternatif]) }}" class="btn btn-primary">Detail</a>
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
@endsection
