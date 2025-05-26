<x-template-auth-layout>
    <div>
        <h5 class="text-primary">Welcome Back !</h5>
        <p class="text-muted">Sign in to continue to DPMPTSP.</p>
    </div>

    <div class="mt-4">
        <form action="{{ route('login') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="text" class="form-control" id="email" name="email" :value="old('email')"
                    placeholder="Masukkan email...">
            </div>
            <div class="mb-3">
                <label class="form-label" for="password-input">Password</label>
                <div class="position-relative auth-pass-inputgroup mb-3">
                    <input type="password" class="form-control pe-5 password-input" name="password" autofocus
                        autocomplete="name" placeholder="Masukkan password..." id="password-input">
                    <button
                        class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted password-addon material-shadow-none"
                        type="button" id="password-addon">
                        <i class="ri-eye-fill align-middle"></i>
                    </button>
                </div>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="" id="auth-remember-check" name="remember">
                <label class="form-check-label" for="auth-remember-check">Remember me</label>
            </div>
            <div class="mt-4">
                <button class="btn btn-success" type="submit">Sign In</button>
                <button class="btn btn-warning" type="reset">Reset</button>
            </div>
        </form>
    </div>

    <div class="mt-5 text-center">
        <p class="mb-0">
            Dont have an account ?
            <a href="{{ route('register') }}" class="fw-semibold text-primary text-decoration-underline"> Signup</a>
        </p>
    </div>
</x-template-auth-layout>
