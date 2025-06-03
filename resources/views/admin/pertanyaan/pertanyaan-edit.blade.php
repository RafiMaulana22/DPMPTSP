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
                    <div class="card-body">
                        <div class="live-preview">
                            {{-- Pastikan $pertanyaan->id_pertanyaan adalah ID yang benar --}}
                            <form action="{{ route('pertanyaan.update', $pertanyaan->token_pertanyaan) }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label for="pertanyaan_edit" class="form-label">Pertanyaan</label>
                                    <textarea class="form-control @error('pertanyaan') is-invalid @enderror" name="pertanyaan" id="pertanyaan_edit"
                                        cols="30" rows="5">{{ old('pertanyaan', $pertanyaan->pertanyaan) }}</textarea>
                                    @error('pertanyaan')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Pilih jawaban</label>

                                    {{-- Check All Checkbox Start --}}
                                    <div class="form-check mb-2">
                                        <input class="form-check-input" type="checkbox" id="checkAllPilihan">
                                        <label class="form-check-label" for="checkAllPilihan">
                                            Pilih Semua Jawaban
                                        </label>
                                    </div>
                                    {{-- Check All Checkbox End --}}

                                    <div class="d-flex gap-2 justify-content-around flex-wrap">
                                        {{-- Loop semua pilihan yang tersedia --}}
                                        @foreach ($allPilihans as $item)
                                            @php
                                                // Logika untuk menentukan apakah checkbox ini harus dicentang:
                                                // 1. Prioritaskan old input (jika ada error validasi).
                                                // 2. Jika tidak ada old input, gunakan data dari $selectedPilihanIds.
                                                $isChecked = false;
                                                if (old('pilihan')) {
                                                    if (
                                                        is_array(old('pilihan')) &&
                                                        in_array($item->id_pilihan, old('pilihan'))
                                                    ) {
                                                        $isChecked = true;
                                                    }
                                                } elseif (
                                                    isset($selectedPilihanIds) &&
                                                    in_array($item->id_pilihan, $selectedPilihanIds)
                                                ) {
                                                    $isChecked = true;
                                                }
                                            @endphp
                                            <div class="form-check">
                                                <input class="form-check-input pilihan-checkbox" type="checkbox"
                                                    name="pilihan[]" value="{{ $item->id_pilihan }}"
                                                    id="pilihan_edit_{{ $item->id_pilihan }}"
                                                    {{ $isChecked ? 'checked' : '' }}>
                                                <label class="form-check-label" for="pilihan_edit_{{ $item->id_pilihan }}">
                                                    {{ $item->pilihan }}
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>
                                    @error('pilihan')
                                        {{-- Menampilkan error validasi untuk grup pilihan --}}
                                        <div class="text-danger mt-1 d-block">{{ $message }}</div>
                                    @enderror
                                    @error('pilihan.*')
                                        {{-- Menampilkan error validasi untuk setiap item pilihan jika ada --}}
                                        <div class="text-danger mt-1 d-block">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="text-end">
                                    <button type="submit" class="btn btn-primary">Update Pertanyaan</button>
                                    <a href="{{ route('pertanyaan.index') }}" class="btn btn-danger">Batal</a>
                                    {{-- Asumsi route index pertanyaan --}}
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--end row-->
@endsection

@section('script')
    {{-- JavaScript untuk fungsionalitas "Check All" --}}
    {{-- Kode JavaScript ini SAMA dengan yang digunakan pada form create. --}}
    {{-- Tempatkan ini di akhir file blade Anda, atau di dalam section @push('scripts') jika menggunakan layout --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const checkAllPilihan = document.getElementById('checkAllPilihan');
            const pilihanCheckboxes = document.querySelectorAll('.pilihan-checkbox');

            if (checkAllPilihan && pilihanCheckboxes.length > 0) {
                // Fungsi untuk mengupdate status checkbox "Pilih Semua"
                function updateCheckAllStatus() {
                    let allChecked = true;
                    pilihanCheckboxes.forEach(function(cb) {
                        if (!cb.checked) {
                            allChecked = false;
                        }
                    });
                    checkAllPilihan.checked = allChecked;
                }

                // Event listener untuk checkbox "Pilih Semua"
                checkAllPilihan.addEventListener('change', function() {
                    pilihanCheckboxes.forEach(function(checkbox) {
                        checkbox.checked = checkAllPilihan.checked;
                    });
                });

                // Event listener untuk setiap checkbox pilihan individu
                pilihanCheckboxes.forEach(function(checkbox) {
                    checkbox.addEventListener('change', function() {
                        updateCheckAllStatus(); // Panggil fungsi untuk update status "Pilih Semua"
                    });
                });

                // Inisialisasi status "Pilih Semua" saat halaman dimuat
                updateCheckAllStatus();

            } else {
                // Jika tidak ada pilihan sama sekali, nonaktifkan "Pilih Semua"
                if (checkAllPilihan) {
                    checkAllPilihan.disabled = true;
                    const checkAllLabel = document.querySelector('label[for="checkAllPilihan"]');
                    if (checkAllLabel && pilihanCheckboxes.length ===
                        0) { // Hanya ubah label jika memang tidak ada opsi
                        checkAllLabel.textContent = "Tidak ada jawaban tersedia";
                    }
                }
            }
        });
    </script>
@endsection
