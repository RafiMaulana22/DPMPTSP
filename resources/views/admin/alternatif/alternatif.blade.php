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
    {{-- ALERT DESKRIPSI HALAMAN --}}
    <div class="alert alert-info" role="alert">
        <h5 class="alert-heading">Selamat Datang di Halaman Pengunjung!</h5>
        <p>
            Halaman ini menampilkan daftar seluruh pengunjung yang terdaftar dalam sistem.
            Anda dapat melihat detail masing-masing pengunjung dengan menekan tombol "Detail".
        </p>
        <hr>
        <p class="mb-0">
            Di samping daftar pengunjung, Anda juga akan menemukan chart yang menyajikan ringkasan jawaban survei dari semua
            pengunjung secara agregat.
        </p>
    </div>
    {{-- AKHIR ALERT DESKRIPSI HALAMAN --}}
    
    <div class="row">
        <div class="col-lg-7">
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
                                            <a href="{{ route('alternatif.show', ['alternatif' => $value->token_alternatif]) }}"
                                                class="btn btn-primary btn-sm">Detail</a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        {{-- Kolom untuk Chart Jawaban Pengunjung --}}
        <div class="col-lg-5"> {{-- Anda bisa menyesuaikan lebar, misal col-md-12 col-lg-5 --}}
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Chart Jawaban Pengunjung (Agregat)</h5>
                </div>
                <div class="card-body">
                    @if (!empty($labelsChart) && count($labelsChart) > 0)
                        <canvas id="jawabanPengunjungChart"></canvas>
                    @else
                        <p class="text-center">Data jawaban tidak tersedia untuk ditampilkan dalam chart.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        // Pastikan script ini dijalankan setelah Chart.js dimuat dan elemen canvas ada
        document.addEventListener('DOMContentLoaded', function() {
            @if (!empty($labelsChart) && count($labelsChart) > 0)
                const labels = @json($labelsChart);
                const dataValues = @json($nilaiChart);

                const data = {
                    labels: labels,
                    datasets: [{
                        label: 'Jumlah Jawaban per Pilihan',
                        backgroundColor: 'rgba(54, 162, 235, 0.5)', // Warna biru
                        borderColor: 'rgb(54, 162, 235)',
                        borderWidth: 1,
                        data: dataValues,
                    }]
                };

                const config = {
                    type: 'bar',
                    data: data,
                    options: {
                        responsive: true,
                        maintainAspectRatio: false, // Agar chart menyesuaikan tinggi card body
                        scales: {
                            y: {
                                beginAtZero: true,
                                ticks: {
                                    // Memastikan hanya angka bulat (integer) yang ditampilkan di sumbu Y
                                    stepSize: 1,
                                    precision: 0
                                }
                            }
                        },
                        plugins: {
                            legend: {
                                display: true,
                                position: 'top',
                            },
                            title: {
                                display: false, // Judul sudah ada di card header
                                text: 'Chart Jawaban Pengunjung'
                            }
                        }
                    }
                };

                const jawabanChart = new Chart(
                    document.getElementById('jawabanPengunjungChart'),
                    config
                );
            @endif
        });
    </script>

    <script>
        $(document).ready(function() {
            $('#example').DataTable({
                responsive: true, // Mengaktifkan fitur responsif karena Anda menggunakan kelas 'dt-responsive'
                // Anda bisa menambahkan opsi konfigurasi DataTables lainnya di sini jika perlu
                // Misalnya, untuk mengatur bahasa:
                // language: {
                //     url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/id.json', // Untuk Bahasa Indonesia
                // },
            });
        });
    </script>
@endsection
