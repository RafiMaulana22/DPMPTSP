<x-template-auth-layout>
    <h5 class="text-primary">Create new password</h5>
    <p class="text-muted">Your new password must be different from previous used password.</p>

    {{-- Menampilkan pesan error umum atau status dari session jika ada --}}
    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif
    {{-- Error untuk token atau email (jika tidak valid) biasanya ditampilkan oleh Laravel di bawah field terkait --}}

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Oops! Ada beberapa masalah dengan input Anda:</strong>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


    <div class="p-2">
        <form method="POST" action="{{ route('passwordUpdate', $token) }}"> {{-- Action ke route password.update --}}
            @csrf

            {{-- Input token (tersembunyi) dari URL --}}
            <input type="hidden" name="token" value="{{ $token }}">

            {{-- Input Email (bisa visible atau hidden, sebaiknya visible dan pre-filled) --}}
            <div class="mb-3">
                <label for="email" class="form-label">Alamat Email</label>
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                    name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus
                    placeholder="Enter your email" readonly>
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            {{-- Input Password Baru --}}
            <div class="mb-3">
                <label class="form-label" for="password">Password Baru</label>
                <div class="position-relative auth-pass-inputgroup">
                    <input type="password"
                        class="form-control pe-5 password-input @error('password') is-invalid @enderror"
                        onpaste="return false" name="password" autocomplete="new-password" placeholder="Enter password"
                        id="password" aria-describedby="passwordInput" required> {{-- Hapus pattern jika validasi server-side lebih diutamakan --}}
                    <button
                        class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted password-addon material-shadow-none"
                        type="button" id="password-addon">
                        <i class="ri-eye-fill align-middle"></i>
                    </button>
                </div>
                @error('password')
                    <div class="invalid-feedback d-block"> {{-- d-block agar tampil --}}
                        <strong>{{ $message }}</strong>
                    </div>
                @else
                    <div id="passwordInput" class="form-text">Minimal 8 karakter, kombinasi huruf besar-kecil, angka, dan
                        simbol.</div>
                @enderror
            </div>

            {{-- Input Konfirmasi Password Baru --}}
            <div class="mb-3">
                <label class="form-label" for="password_confirmation">Konfirmasi Password Baru</label>
                <div class="position-relative auth-pass-inputgroup mb-3">
                    <input type="password" class="form-control pe-5 password-input" onpaste="return false"
                        name="password_confirmation" autocomplete="new-password" placeholder="Confirm password"
                        id="password_confirmation" required>
                    <button
                        class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted password-addon material-shadow-none"
                        type="button" id="confirm-password-input"> {{-- Pastikan ID ini unik atau dikelola oleh JS Anda --}}
                        <i class="ri-eye-fill align-middle"></i>
                    </button>
                </div>
                {{-- Error untuk password_confirmation biasanya ditampilkan di bawah field password jika aturan 'confirmed' gagal --}}
            </div>

            {{-- Indikator kekuatan password (UI Anda, pastikan JS-nya bekerja) --}}
            <div id="password-contain" class="p-3 bg-light mb-2 rounded" style="display: none;"> {{-- Sembunyikan awal, tampilkan dengan JS --}}
                <h5 class="fs-13">Password must contain:</h5>
                <p id="pass-length" class="invalid fs-12 mb-2">Minimum <b>8 characters</b></p>
                <p id="pass-lower" class="invalid fs-12 mb-2">At <b>lowercase</b> letter (a-z)</p>
                <p id="pass-upper" class="invalid fs-12 mb-2">At least <b>uppercase</b> letter (A-Z)</p>
                <p id="pass-number" class="invalid fs-12 mb-0">A least <b>number</b> (0-9)</p>
                <p id="pass-symbol" class="invalid fs-12 mb-0">A least <b>symbol</b></p> {{-- Tambahkan jika validasi simbol juga ada --}}
            </div>

            <div class="mt-4">
                <button class="btn btn-success w-100" type="submit">Reset Coba</button>
            </div>
        </form>
    </div>

    <div class="mt-5 text-center">
        <p class="mb-0">Wait, I remember my password... <a href="auth-signin-cover.html"
                class="fw-semibold text-primary text-decoration-underline"> Click here </a> </p>
    </div>
</x-template-auth-layout>

@section('script')
    <script>
        // Contoh sederhana untuk toggle password visibility
        document.querySelectorAll('.password-addon').forEach(item => {
            item.addEventListener('click', event => {
                let icon = item.querySelector('i');
                let input = item.previousElementSibling; // Asumsi input adalah sibling sebelumnya
                if (input.type === "password") {
                    input.type = "text";
                    icon.classList.remove('ri-eye-fill');
                    icon.classList.add('ri-eye-off-fill');
                } else {
                    input.type = "password";
                    icon.classList.remove('ri-eye-off-fill');
                    icon.classList.add('ri-eye-fill');
                }
            });
        });
        // Tambahkan JS untuk indikator kekuatan password di sini
    </script>
@endsection
