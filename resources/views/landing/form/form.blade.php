@extends('landing.landing')

@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-12 col-sm-10">
            <div class="card mt-3">
                <div class="card-header">
                    <div class="card-title">
                        <h3>Form Kepuasan Pelayanan</h3>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('landing.store') }}" method="post">
                        @csrf

                        {{-- Nama Lengkap --}}
                        <div class="mb-3">
                            <label for="nama_alternatif" class="form-label">
                                1. Nama Lengkap <span class="text-danger">*</span>
                                <small class="text-secondary">Beserta gelar jika ada.</small>
                            </label>
                            <input type="text" class="form-control @error('nama_alternatif') is-invalid @enderror"
                                name="nama_alternatif" id="nama_alternatif" placeholder="Masukkan Nama Lengkap..."
                                value="{{ old('nama_alternatif') }}">
                            @error('nama_alternatif')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Profesi --}}
                        <div class="mb-3">
                            <label for="profesi" class="form-label">2. Profesi <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('profesi') is-invalid @enderror" name="profesi"
                                id="profesi" placeholder="Masukkan Profesi..." value="{{ old('profesi') }}">
                            @error('profesi')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Pertanyaan Pilihan --}}
                        @foreach ($pertanyaan as $item)
                            <div class="mb-3">
                                <label class="form-label">
                                    {{ $no++ }}. {{ $item->pertanyaan }}
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="hidden" name="id_pertanyaan[]" value="{{ $item->id_pertanyaan }}">
                                @foreach ($item->pilihan as $get)
                                    <div class="form-check">
                                        <input type="radio"
                                            class="form-check-input @error('pilihan.' . $item->id_pertanyaan) is-invalid @enderror"
                                            name="pilihan[{{ $item->id_pertanyaan }}]"
                                            id="pilihan_{{ $item->id_pertanyaan }}_{{ $get->id_pilihan }}"
                                            value="{{ $get->id_pilihan }}"
                                            {{ old('pilihan.' . $item->id_pertanyaan) == $get->id_pilihan ? 'checked' : '' }}>
                                        <label class="form-check-label"
                                            for="pilihan_{{ $item->id_pertanyaan }}_{{ $get->id_pilihan }}">
                                            {{ $get->pilihan }}
                                        </label>
                                    </div>
                                @endforeach
                                @error('pilihan.' . $item->id_pertanyaan)
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        @endforeach

                        <button type="submit" class="btn btn-primary">Submit</button>
                        <small class="text-muted d-block mt-2">
                            *Jumlah pengisi form: {{ $jumlahPengisi }}
                        </small>
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection
