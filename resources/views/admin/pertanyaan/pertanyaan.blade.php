@extends('layouts.template')

@section('style')
    <style>
        /* Styling tambahan jika diperlukan agar tombol DataTables sejajar */
        .dt-buttons .btn {
            margin-right: 5px;
        }
    </style>
@endsection

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
                                    cols="30" rows="5">{{ old('pertanyaan') }}</textarea> {{-- Added old('pertanyaan') --}}
                                @error('pertanyaan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Pilih jawaban</label> {{-- Removed 'for' as it's a general label for the group --}}

                                {{-- Check All Checkbox Start --}}
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="checkbox" id="checkAllPilihan">
                                    <label class="form-check-label" for="checkAllPilihan">
                                        Pilih Semua Jawaban
                                    </label>
                                </div>
                                {{-- Check All Checkbox End --}}

                                <div class="d-flex gap-2 justify-content-around flex-wrap mt-3">
                                    @php
                                        $pilihanData = App\Models\pilihan::get(); // Ambil data sekali saja
                                    @endphp
                                    @foreach ($pilihanData as $item)
                                        <div class="form-check"> {{-- Menggunakan div.form-check untuk alignment yang lebih baik --}}
                                            <input class="form-check-input pilihan-checkbox" type="checkbox"
                                                name="pilihan[]" value="{{ $item->id_pilihan }}"
                                                id="pilihan_{{ $item->id_pilihan }}"
                                                {{ is_array(old('pilihan')) && in_array($item->id_pilihan, old('pilihan')) ? 'checked' : '' }}>
                                            {{-- Added old('pilihan[]') check --}}
                                            <label class="form-check-label" for="pilihan_{{ $item->id_pilihan }}">
                                                {{ $item->pilihan }}
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                                @error('pilihan')
                                    {{-- Menampilkan error validasi untuk pilihan --}}
                                    <div class="text-danger mt-1 d-block">{{ $message }}</div>
                                @enderror
                                @error('pilihan.*')
                                    {{-- Menampilkan error validasi untuk setiap item pilihan jika ada --}}
                                    <div class="text-danger mt-1 d-block">{{ $message }}</div>
                                @enderror
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
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">List pertanyaan</h5>
                    {{-- Contoh jika Anda ingin menambahkan tombol "Tambah" di sini --}}
                    {{-- <a href="{{ route('pertanyaan.create') }}" class="btn btn-success">Tambah Pertanyaan</a> --}}
                </div>
                <div class="card-body">
                    {{-- Alert success jika ada --}}
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>Berhasil!</strong> {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    {{-- ... Bagian atas file ... --}}

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
                            {{-- Pastikan $no sudah diinisialisasi di controller atau sebelum loop --}}
                            {{-- Contoh: @php $no = isset($no) ? $no : (($pertanyaan instanceof \Illuminate\Pagination\LengthAwarePaginator) ? ($pertanyaan->currentPage() - 1) * $pertanyaan->perPage() + 1 : 1); @endphp --}}
                            @foreach ($pertanyaan as $key => $value)
                                @php
                                    $pilihanArray = [];
                                    // Gunakan nama relasi 'pilihan' (singular) sesuai nama method Anda
                                    if ($value->pilihan && $value->pilihan->count() > 0) {
                                        // Kolom 'pilihan' dari tabel 'pilihans' untuk teksnya
                                        $pilihanArray = $value->pilihan->pluck('pilihan')->toArray();
                                    }
                                    $pilihanJson = htmlspecialchars(json_encode($pilihanArray), ENT_QUOTES, 'UTF-8');
                                @endphp
                                <tr data-pilihan-json="{{ $pilihanJson }}"> {{-- Tambahkan atribut data di sini --}}
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $value->pertanyaan }}</td>
                                    <td>
                                        <a href="{{ route('pertanyaan.edit', ['pertanyaan' => $value->token_pertanyaan]) }}"
                                            class="btn btn-primary btn-sm">
                                            Edit
                                        </a>
                                        <button class="btn btn-danger btn-sm" type="button" data-bs-toggle="modal"
                                            data-bs-target="#hapus{{ $value->token_pertanyaan }}">
                                            Hapus
                                        </button>
                                    </td>
                                </tr>

                                {{-- Modal Hapus --}}
                                <div id="hapus{{ $value->token_pertanyaan }}" class="modal fade" tabindex="-1"
                                    aria-labelledby="myModalLabel{{ $value->token_pertanyaan }}" aria-hidden="true"
                                    style="display: none;">
                                    {{-- ... konten modal ... --}}
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="myModalLabel{{ $value->token_pertanyaan }}">
                                                    Peringatan!</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"> </button>
                                            </div>
                                            <div class="modal-body">
                                                <p class="text-muted mb-2">Apakah Anda yakin ingin menghapus data pertanyaan
                                                    ini?</p>
                                                <h6 class="fs-15">
                                                    "{{ Str::limit($value->pertanyaan, 100) }}"
                                                </h6>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-light"
                                                    data-bs-dismiss="modal">Batal</button>
                                                <a href="{{ route('pertanyaan.destroy', ['pertanyaan' => $value->token_pertanyaan]) }}"
                                                    class="btn btn-danger">Hapus!</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </tbody>
                    </table>

                    {{-- ... Bagian bawah file ... --}}
                </div>
            </div>
        </div>
        <!--end col-->
    </div>
    <!--end row-->
@endsection

@section('script')
    {{-- JavaScript untuk fungsionalitas "Check All" --}}
    {{-- Tempatkan ini di akhir file blade Anda, atau di dalam section @push('scripts') jika menggunakan layout --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const checkAllPilihan = document.getElementById('checkAllPilihan');
            const pilihanCheckboxes = document.querySelectorAll('.pilihan-checkbox');

            if (checkAllPilihan && pilihanCheckboxes.length > 0) {
                // Event listener untuk checkbox "Pilih Semua"
                checkAllPilihan.addEventListener('change', function() {
                    pilihanCheckboxes.forEach(function(checkbox) {
                        checkbox.checked = checkAllPilihan.checked;
                    });
                });

                // Event listener untuk setiap checkbox pilihan individu
                pilihanCheckboxes.forEach(function(checkbox) {
                    checkbox.addEventListener('change', function() {
                        // Jika ada satu checkbox individu yang tidak tercentang, maka "Pilih Semua" juga tidak tercentang
                        if (!this.checked) {
                            checkAllPilihan.checked = false;
                        } else {
                            // Cek apakah semua checkbox individu tercentang
                            let allChecked = true;
                            pilihanCheckboxes.forEach(function(cb) {
                                if (!cb.checked) {
                                    allChecked = false;
                                }
                            });
                            checkAllPilihan.checked = allChecked;
                        }
                    });
                });

                // Inisialisasi status "Pilih Semua" saat halaman dimuat (jika semua sudah terpilih via old())
                let allInitiallyChecked = true;
                if (pilihanCheckboxes.length === 0) { // Jika tidak ada pilihan sama sekali
                    allInitiallyChecked = false;
                    checkAllPilihan.disabled = true; // Nonaktifkan tombol "Pilih Semua" jika tidak ada opsi
                } else {
                    pilihanCheckboxes.forEach(function(cb) {
                        if (!cb.checked) {
                            allInitiallyChecked = false;
                        }
                    });
                }
                if (pilihanCheckboxes.length > 0) {
                    checkAllPilihan.checked = allInitiallyChecked;
                }

            } else {
                if (checkAllPilihan && pilihanCheckboxes.length === 0) {
                    checkAllPilihan.disabled = true; // Nonaktifkan jika tidak ada opsi
                    const checkAllLabel = document.querySelector('label[for="checkAllPilihan"]');
                    if (checkAllLabel) checkAllLabel.textContent = "Tidak ada jawaban tersedia";
                }
            }
        });
    </script>

    <script>
        $(document).ready(function() {
            $('#example').DataTable({
                responsive: true,
                dom: "<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>" +
                    "<'row dt-buttons'<'col-sm-12'B>>" + // Tombol Ekspor (B)
                    "<'row'<'col-sm-12'tr>>" + // tabel (tr)
                    "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>", // info dan pagination
                buttons: [{
                        extend: 'pdfHtml5',
                        text: '<i class="fas fa-file-pdf"></i> PDF',
                        titleAttr: 'Export to PDF',
                        className: 'btn btn-danger btn-sm',
                        // PENYESUAIAN DI SINI: Tambahkan "Judul: "
                        title: 'Judul: Daftar Pertanyaan dan Pilihan', // Judul dokumen PDF
                        exportOptions: {
                            // Tidak perlu 'columns' jika customize mengganti semua konten tabel
                        },
                        customize: function(doc) {
                            // Mengatur style default dokumen
                            doc.defaultStyle.fontSize = 10;
                            doc.styles.tableHeader = { // Untuk "No: ..."
                                bold: true,
                                fontSize: 11, // Sedikit lebih besar atau sama dengan default
                                alignment: 'left'
                            };
                            doc.styles
                                .header = { // Untuk judul utama "Judul: Daftar Pertanyaan dan Pilihan"
                                    bold: true,
                                    fontSize: 14,
                                    alignment: 'center',
                                    margin: [0, 0, 0,
                                        20
                                    ] // Beri margin bawah lebih banyak untuk judul utama
                                };
                            doc.styles.pertanyaanText = { // Untuk "Pertanyaan: ..."
                                bold: false, // Teks pertanyaan tidak perlu bold kecuali diinginkan
                                margin: [0, 2, 0, 5] // Atas, Kanan, Bawah, Kiri
                            };
                            doc.styles.pilihanHeader = { // Untuk "Pilihan Jawaban:"
                                bold: true,
                                margin: [0, 5, 0, 2]
                            };
                            doc.styles.pilihanList = { // Untuk daftar ul pilihan
                                margin: [10, 0, 0,
                                    5
                                ] // Indentasi untuk daftar pilihan (dari kiri)
                            };

                            var newContent = [];

                            // Tambahkan judul utama ke dokumen
                            newContent.push({
                                text: doc.title, // Mengambil dari properti title tombol
                                style: 'header'
                            });

                            // Iterasi setiap baris data dari tabel HTML ASLI
                            $('#example tbody tr').each(function(index) {
                                var no = $(this).find('td:eq(0)').text().trim();
                                var pertanyaanText = $(this).find('td:eq(1)').text().trim();
                                var pilihanJsonString = $(this).attr('data-pilihan-json');
                                var pilihanArray = [];
                                try {
                                    if (pilihanJsonString) {
                                        pilihanArray = JSON.parse(pilihanJsonString);
                                    }
                                } catch (e) {
                                    console.error("Error parsing pilihan JSON:", e,
                                        pilihanJsonString);
                                }

                                // Membuat blok untuk setiap item pertanyaan
                                var itemBlock = [{
                                        text: 'No: ' + no,
                                        style: 'tableHeader' // Menggunakan style yang sudah didefinisikan
                                    },
                                    {
                                        text: 'Pertanyaan: ' + pertanyaanText,
                                        style: 'pertanyaanText'
                                    }
                                ];

                                if (pilihanArray && pilihanArray.length > 0) {
                                    itemBlock.push({
                                        text: 'Pilihan Jawaban:',
                                        style: 'pilihanHeader'
                                    });
                                    var listPilihan = {
                                        ul: [], // pdfmake akan membuat bullet points dari array ini
                                        style: 'pilihanList'
                                    };
                                    pilihanArray.forEach(function(p) {
                                        listPilihan.ul.push(
                                            p); // Setiap item menjadi satu poin
                                    });
                                    itemBlock.push(listPilihan);
                                } else {
                                    itemBlock.push({
                                        text: 'Pilihan Jawaban: Tidak ada',
                                        italics: true,
                                        margin: [0, 5, 0, 5]
                                    });
                                }

                                newContent.push({
                                    stack: itemBlock, // 'stack' menempatkan elemen secara vertikal
                                    margin: [0, 0, 0,
                                        15
                                    ] // Margin bawah antar item pertanyaan
                                });
                            });

                            doc.content = newContent; // Ganti konten dokumen PDF dengan yang baru
                        }
                    },
                    {
                        extend: 'print',
                        text: '<i class="fas fa-print"></i> Print',
                        titleAttr: 'Print table',
                        className: 'btn btn-info btn-sm',
                        // PENYESUAIAN DI SINI: Tambahkan "Judul: "
                        title: 'Judul: Daftar Pertanyaan dan Pilihan', // Judul untuk halaman print
                        exportOptions: {
                            // Tidak perlu 'columns' jika customize mengganti semua konten tabel
                        },
                        customize: function(win) {
                            $(win.document.body).css('font-size', '10pt');
                            // Hapus konten default DataTables (judul h1 dan tabel)
                            $(win.document.body).find('h1').remove();
                            $(win.document.body).find('table').remove();

                            // Buat konten baru untuk print
                            var printContent = $('<div></div>');
                            // Tambahkan judul utama, this.title() mengambil dari properti title tombol
                            printContent.append(
                                '<h1 style="text-align:center; margin-bottom:20px;">' + this
                                .title() + '</h1>');

                            $('#example tbody tr').each(function() {
                                var no = $(this).find('td:eq(0)').text().trim();
                                var pertanyaanText = $(this).find('td:eq(1)').text().trim();
                                var pilihanJsonString = $(this).attr('data-pilihan-json');
                                var pilihanArray = [];
                                try {
                                    if (pilihanJsonString) {
                                        pilihanArray = JSON.parse(pilihanJsonString);
                                    }
                                } catch (e) {
                                    console.error("Error parsing pilihan JSON:", e,
                                        pilihanJsonString);
                                }

                                // Struktur HTML untuk setiap item
                                var itemHtml = $(
                                    '<div style="margin-bottom: 15px; padding-bottom: 10px; border-bottom: 1px solid #eee;"></div>'
                                );
                                itemHtml.append(
                                    '<p style="margin:2px 0;"><strong>No:</strong> ' +
                                    no + '</p>');
                                itemHtml.append(
                                    '<p style="margin:2px 0;"><strong>Pertanyaan:</strong> ' +
                                    pertanyaanText + '</p>');

                                if (pilihanArray && pilihanArray.length > 0) {
                                    itemHtml.append(
                                        '<p style="margin:5px 0 2px 0;"><strong>Pilihan Jawaban:</strong></p>'
                                    );
                                    // Menggunakan ul untuk daftar berpoin
                                    var ul = $(
                                        '<ul style="margin:0 0 5px 20px; padding-left:0; list-style-type: disc;"></ul>'
                                    ); // 'disc' untuk bullet standar
                                    pilihanArray.forEach(function(p) {
                                        ul.append('<li>' + p + '</li>');
                                    });
                                    itemHtml.append(ul);
                                } else {
                                    itemHtml.append(
                                        '<p style="margin:5px 0;"><strong>Pilihan Jawaban:</strong> Tidak ada</p>'
                                    );
                                }
                                printContent.append(itemHtml);
                            });
                            // Hapus semua isi body dulu, lalu tambahkan konten baru
                            $(win.document.body).empty().append(printContent);

                            // Aturan CSS tambahan untuk print (opsional, sesuaikan)
                            $(win.document.head).append(
                                '<style>' +
                                'body { font-family: Arial, sans-serif; margin: 20px; } ' +
                                'h1 { font-size: 16pt; } ' +
                                'div > p { margin: 4px 0; } ' +
                                'ul { margin-top: 2px; margin-bottom: 8px; } ' +
                                'li { margin-bottom: 2px; }' +
                                '</style>'
                            );
                        }
                    }
                    // ... tombol lainnya jika ada ...
                ],
                columnDefs: [{
                    "orderable": false,
                    "targets": 2 // Kolom Action (indeks 2) tidak bisa diurutkan
                }],
                language: {
                    "sEmptyTable": "Tidak ada data yang tersedia pada tabel ini",
                    "sProcessing": "Sedang memproses...",
                    "sLengthMenu": "Tampilkan _MENU_ entri",
                    "sZeroRecords": "Tidak ditemukan data yang sesuai",
                    "sInfo": "Menampilkan _START_ sampai _END_ dari _TOTAL_ entri",
                    "sInfoEmpty": "Menampilkan 0 sampai 0 dari 0 entri",
                    "sInfoFiltered": "(disaring dari _MAX_ entri keseluruhan)",
                    "sInfoPostFix": "",
                    "sSearch": "Cari:",
                    "sUrl": "",
                    "oPaginate": {
                        "sFirst": "Pertama",
                        "sPrevious": "Sebelumnya",
                        "sNext": "Selanjutnya",
                        "sLast": "Terakhir"
                    }
                }
            });
        });
    </script>
@endsection
