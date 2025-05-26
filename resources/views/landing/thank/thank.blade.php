@extends('landing.landing')

@section('styles')
    <style>
        .icon-success {
            font-size: 4rem;
            color: #28a745;
            margin-bottom: 1.5rem;
        }
        
    </style>
@endsection

@section('content')
    <div class="col-12">
        <div class="card">
            <div class="icon-success">✔</div>
            <h1>Terima Kasih Atas Masukan Anda!</h1>
            <p>
                Kami sangat menghargai waktu dan masukan Anda dalam mengisi form kepuasan pelayanan. Tanggapan Anda sangat
                berarti untuk membantu kami meningkatkan kualitas layanan.
            </p>
            <p>
                Jika Anda memiliki pertanyaan atau membutuhkan bantuan lebih lanjut, jangan ragu untuk menghubungi tim kami.
            </p>
        </div>
    </div>
@endsection
