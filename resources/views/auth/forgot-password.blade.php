<x-template-auth-layout>
    <h5 class="text-primary">Forgot Password?</h5>
    <p class="text-muted">Reset password with DPMPTSP</p>

    <div class="mt-2 text-center">
        <lord-icon src="https://cdn.lordicon.com/rhvddzym.json" trigger="loop" colors="primary:#0ab39c" class="avatar-xl">
        </lord-icon>
    </div>

    <div class="alert border-0 alert-warning text-center mb-2 mx-2" role="alert">
        Masukkan email Anda untuk mengubah password Anda!
    </div>
    @if (session('status'))
        <div class="alert alert-success border-0 mb-2 mx-2" role="alert">
            {{ session('status') }}
        </div>
    @endif
    @if ($errors->has('email'))
        <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first('email') }}</strong>
        </span>
    @endif
    <div class="p-2">
        <form action="{{ route('forgotPassword') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email"
                    placeholder="Enter email address">
            </div>

            <div class="text-center mt-4">
                <button class="btn btn-success w-100" type="submit">Send Reset Link</button>
            </div>
        </form><!-- end form -->
    </div>

    <div class="mt-5 text-center">
        <p class="mb-0">
            Tunggu, saya ingat kata sandi saya...
            <a href="{{ route('login') }}" class="fw-semibold text-primary text-decoration-underline"> Klik di sini </a>
        </p>
    </div>
</x-template-auth-layout>
