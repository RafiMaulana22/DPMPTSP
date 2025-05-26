@extends('layouts.template')

@section('breadcrumb')
    <ol class="breadcrumb m-0">
        <li class="breadcrumb-item">
            <a href="{{ route('dashboard') }}">Dashboard</a>
        </li>
        <li class="breadcrumb-item">
            <a href="{{ route('alternatif.index') }}">Pengunjung</a>
        </li>
        <li class="breadcrumb-item active">{{ $title }}</li>
    </ol>
@endsection

@section('content')
    <div class="col-lg-12 col-sm-10">
        <div class="card mt-3">
            <div class="card-header">
                <div class="card-title">
                    <h3>Detail Jawaban Pengunjung</h3>
                </div>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <label for="nama_alternatif" class="form-label">Nama Lengkap</label>
                    <input type="text" class="form-control" value="{{ $alternatif->nama_alternatif }}" disabled>
                </div>
                <div class="mb-3">
                    <label for="profesi" class="form-label">Profesi</label>
                    <input type="text" class="form-control" value="{{ $alternatif->profesi }}" disabled>
                </div>
                @foreach ($jawaban as $item)
                    <div class="mb-3">
                        <label class="form-label">{{ $item->pertanyaan->pertanyaan }}</label>
                        <div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" checked>
                                <label class="form-check-label">
                                    {{ $item->pilihan->pilihan }}
                                </label>
                            </div>
                        </div>
                    </div>
                @endforeach
                {{--  @foreach ($jawaban as $item)
                    <div class="mb-3">
                        <label class="form-label">{{ $item->pertanyaan->pertanyaan }}</label>
                        <div>
                            <div class="form-check">
                                    <input class="form-check-input" type="radio" checked>
                                    <label class="form-check-label">
                                        {{ $item->pilihan->pilihan }}
                                    </label>
                                </div>
                            @foreach ($item->pilihan as $get)
                                <div class="form-check">
                                    <input class="form-check-input" type="radio"
                                        name="pilihan[{{ $item->id_pertanyaan }}]"
                                        id="pilihan_{{ $item->id_pertanyaan }}_{{ $get->id_pilihan }}"
                                        value="{{ $get->id_pilihan }}" @if ($item->selected_pilihan == $get->id_pilihan) checked @endif
                                        disabled>
                                    <label class="form-check-label"
                                        for="pilihan_{{ $item->id_pertanyaan }}_{{ $get->id_pilihan }}">
                                        {{ $get->pilihan }}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach  --}}
            </div>
        </div>
    </div>
@endsection
