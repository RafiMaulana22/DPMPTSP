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
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0">List pertanyaan</h5>
                <a href="{{ route('user.create') }}" class="btn btn-primary">Tambah {{ $title }}</a>
            </div>
            <div class="card-body">
                {{-- Alert Success Start --}}
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Berhasil!</strong> {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                {{-- Alert Success End --}}
                <table id="example" class="table table-bordered dt-responsive nowrap table-striped align-middle"
                    style="width:100%">
                    <thead>
                        <tr>
                            <th data-ordering="false">No</th>
                            <th data-ordering="false">Nama</th>
                            <th data-ordering="false">Email</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($user as $key => $value)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $value->name }}</td>
                                <td>{{ $value->email }}</td>
                                <td>
                                    <div class="dropdown d-inline-block">
                                        <a class="btn btn-primary" href="{{ route('user.edit', ['id' => $value->id]) }}">
                                            Edit
                                        </a>
                                    </div>
                                    <div class="dropdown d-inline-block">
                                        <button class="btn btn-danger" type="button" data-bs-toggle="modal"
                                            data-bs-target="#hapus{{ $value->id }}">
                                            Hapus
                                        </button>
                                    </div>
                                </td>
                            </tr>

                            {{-- Modal hapus --}}
                            <div id="hapus{{ $value->id }}" class="modal fade" tabindex="-1"
                                aria-labelledby="myModalLabel{{ $value->id }}" aria-hidden="true" style="display: none;">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="myModalLabel{{ $value->id }}">Peringatan!</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"> </button>
                                        </div>
                                        <div class="modal-body">
                                            <p class="text-muted">Apakah Anda yakin ingin menghapus data pengguna dengan
                                                nama:</p>
                                            <h5 class="fs-15">
                                                "{{ $value->name }}"
                                            </h5>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-light"
                                                data-bs-dismiss="modal">
                                                Batal
                                            </button>
                                            <a href="{{ route('user.destroy', ['id' => $value->id]) }}"
                                                class="btn btn-danger">
                                                Hapus!
                                            </a>
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
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $('#example').DataTable({
                responsive: true,
                autoWidth: false,
                columnDefs: [
                    // Kolom 'No' (indeks 0) tidak bisa di-sort.
                    // Sesuaikan 'targets' jika kolom 'No' Anda bukan di indeks 0.
                    {
                        targets: 0,
                        orderable: false
                    },
                ],
                dom: "<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>" +
                    "<'row'<'col-sm-12'tr>>" +
                    "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>" +
                    "<'row'<'col-sm-12 mt-2'B>>",
                buttons: [{
                        text: 'PDF',
                        orientation: 'portrait', // 'portrait' atau 'landscape'
                        pageSize: 'A4', // Ukuran kertas
                        exportOptions: {
                            // Pastikan ini memilih 3 kolom seperti pada gambar: No, Nama, Email
                            // Jika urutan atau jumlah kolom berbeda, sesuaikan ini dan 'widths' di customize.
                            columns: [0, 1, 2], // Contoh: Mengekspor kolom dengan indeks 0, 1, dan 2
                            // Atau gunakan ':visible:not(:last-child)' jika lebih sesuai
                            // dan pastikan 'widths' cocok.
                            format: {
                                header: function(data, columnIdx) {
                                    return data; // Bisa kustomisasi teks header jika perlu
                                },
                                body: function(data, rowIdx, columnIdx, node) {
                                    return data; // Mengembalikan data sel apa adanya
                                }
                            }
                        },
                        customize: function(doc, config, dt) {
                            // 1. Tambahkan Judul Dokumen (Opsional, tapi baik untuk konteks)
                            doc.content.splice(0, 0, {
                                margin: [0, 0, 0, 12], // Margin [kiri, atas, kanan, bawah]
                                alignment: 'center',
                                text: 'Daftar Pengguna', // Ganti judul jika perlu
                                fontSize: 16,
                                bold: true
                            });

                            // Cari node tabel dalam doc.content
                            let tableNode = null;
                            for (let i = 0; i < doc.content.length; i++) {
                                // Pastikan doc.content[i] ada sebelum mengakses properti 'table'
                                if (doc.content[i] && doc.content[i].table) {
                                    tableNode = doc.content[i];
                                    break;
                                }
                            }

                            // 2. Atur Lebar Kolom
                            if (tableNode) {
                                // Berdasarkan gambar: No (kecil), Nama (sedang), Email (besar/sisa)
                                // Pastikan jumlah elemen di 'widths' sama dengan jumlah kolom di 'exportOptions.columns'
                                tableNode.table.widths = ['10%', '35%', '*'];
                            }

                            // 3. Definisikan Styles untuk Tabel
                            doc.styles = doc.styles || {}; // Inisialisasi jika belum ada
                            doc.styles.tableHeader = {
                                bold: false, // Sesuai gambar, teks header tidak tampak bold
                                fontSize: 10,
                                fillColor: '#EFEFEF', // Latar header abu-abu muda (mirip gambar)
                                color: '#000000', // Teks header hitam
                                alignment: 'left', // Penjajaran teks di header
                                margin: [5, 5, 5, 5] // Padding sel: [kiri, atas, kanan, bawah]
                            };
                            // Untuk baris data ganjil (indeks 0, 2, ... di array data body) -> Abu-abu muda
                            doc.styles.tableBodyOdd = {
                                fontSize: 9,
                                fillColor: '#F9F9F9', // Warna abu-abu sangat muda untuk baris ganjil
                                alignment: 'left',
                                margin: [5, 4, 5, 4] // Padding sel
                            };
                            // Untuk baris data genap (indeks 1, 3, ... di array data body) -> Putih
                            doc.styles.tableBodyEven = {
                                fontSize: 9,
                                fillColor: '#FFFFFF', // Putih untuk baris genap
                                alignment: 'left',
                                margin: [5, 4, 5, 4] // Padding sel
                            };

                            // 4. Atur Layout Tabel (garis-garis)
                            if (tableNode) {
                                tableNode.layout = {
                                    // Fungsi untuk ketebalan garis horizontal
                                    hLineWidth: function(rowIndex, node) {
                                        // rowIndex adalah indeks baris di `node.table.body` (termasuk header)
                                        // node.table.body[0] adalah baris header kita
                                        // node.table.body[1] adalah baris data pertama, dst.
                                        if (rowIndex === 0)
                                            return 0; // Tidak ada garis di atas header
                                        if (rowIndex === 1)
                                            return 0.8; // Garis tebal di bawah header
                                        if (rowIndex > 0 && rowIndex < node.table.body
                                            .length) {
                                            return 0.5; // Garis tipis di bawah setiap baris data
                                        }
                                        if (rowIndex === node.table.body.length)
                                            return 0.8; // Garis tebal di paling bawah tabel
                                        return 0;
                                    },
                                    // Fungsi untuk ketebalan garis vertikal
                                    vLineWidth: function(colIndex, node) {
                                        return 0; // Tidak ada garis vertikal
                                    },
                                    // Fungsi untuk warna garis horizontal
                                    hLineColor: function(rowIndex, node) {
                                        if (rowIndex === 1 || rowIndex === node.table.body
                                            .length) {
                                            return '#AAAAAA'; // Warna abu-abu untuk garis bawah header & bawah tabel
                                        }
                                        return '#DDDDDD'; // Warna abu-abu lebih muda untuk garis antar baris data
                                    },
                                    // Padding bisa juga diatur di sini, tapi kita sudah pakai 'margin' di styles
                                    // paddingLeft: function(rowIndex, node) { return 5; },
                                    // paddingRight: function(rowIndex, node) { return 5; },
                                    // paddingTop: function(rowIndex, node) { return 3; },
                                    // paddingBottom: function(rowIndex, node) { return 3; }
                                };
                            }
                        },
                        action: function(e, dt, node, config) {
                            // Ambil data dari DataTable sesuai exportOptions
                            var exportData = dt.buttons.exportData(config.exportOptions);

                            // Siapkan body tabel untuk pdfMake dengan menerapkan style
                            var pdfTableBody = [];

                            // Baris Header
                            var headerCells = exportData.header.map(function(cellContent) {
                                return {
                                    text: cellContent.toString(),
                                    style: 'tableHeader'
                                };
                            });
                            pdfTableBody.push(headerCells);

                            // Baris Data
                            exportData.body.forEach(function(dataRow, rowIndex) {
                                // Tentukan style berdasarkan indeks baris (0-indexed untuk data)
                                var rowStyle = (rowIndex % 2 === 0) ? 'tableBodyOdd' :
                                    'tableBodyEven';
                                var styledDataCells = dataRow.map(function(cellContent) {
                                    return {
                                        text: cellContent !== null &&
                                            cellContent !== undefined ? cellContent
                                            .toString() : '',
                                        style: rowStyle
                                    };
                                });
                                pdfTableBody.push(styledDataCells);
                            });

                            // Definisi dokumen untuk pdfMake
                            var docDefinition = {
                                pageSize: config.pageSize,
                                orientation: config.orientation,
                                content: [
                                    // Judul akan ditambahkan oleh fungsi 'customize'
                                    {
                                        table: {
                                            // headerRows: 1 penting agar pdfMake tahu baris pertama adalah header
                                            // dan akan mengulanginya jika tabel melintasi halaman.
                                            headerRows: 1,
                                            body: pdfTableBody
                                            // Lebar ('widths') dan tata letak garis ('layout') akan diatur oleh 'customize'
                                        }
                                    }
                                ],
                                styles: {
                                    // Definisi styles akan diisi/diperbarui oleh fungsi 'customize'
                                }
                                // defaultStyle: { fontSize: 10 } // Bisa diatur di customize jika perlu
                            };

                            // Panggil fungsi customize untuk memodifikasi docDefinition
                            if (config.customize) {
                                config.customize(docDefinition, config, dt);
                            }

                            // Buat dan buka PDF
                            if (window.pdfMake) {
                                pdfMake.createPdf(docDefinition).getBlob(function(blob) {
                                    var url = URL.createObjectURL(blob);
                                    var newWindow = window.open(url, '_blank');
                                    if (!newWindow || newWindow.closed || typeof newWindow
                                        .closed == 'undefined') {
                                        alert(
                                            'Gagal membuka PDF di tab baru. Mohon nonaktifkan popup blocker untuk situs ini dan coba lagi.'
                                        );
                                    }
                                    // Bersihkan URL objek setelah beberapa saat
                                    setTimeout(function() {
                                        URL.revokeObjectURL(url);
                                    }, 100);
                                });
                            } else {
                                console.error(
                                    "pdfMake is not defined. Pastikan library pdfmake.min.js dan vfs_fonts.js sudah dimuat."
                                );
                                alert("Tidak dapat membuat PDF: library pdfMake tidak ditemukan.");
                            }
                        }
                    },
                    'print' // Tombol cetak jika Anda menggunakannya
                ]
            });
        });
    </script>
@endsection
