<x-template-auth-layout>
    <div>
        <h5 class="text-primary">Register Account</h5>
        <p class="text-muted">Get your Free DPMPTSP account now.</p>
    </div>

    <div class="mt-4">
        <form class="needs-validation" novalidate action="{{ route('register') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="useremail" class="form-label">
                    Email
                    <span class="text-danger">*</span>
                </label>
                <input type="email" class="form-control" id="useremail" name="email" placeholder="Masukkan email..."
                    required>
                <div class="invalid-feedback">
                    Please masukkan email
                </div>
                <div class="valid-feedback">
                    Looks good!
                </div>
            </div>
            <div class="mb-3">
                <label for="username" class="form-label">
                    Username
                    <span class="text-danger">*</span>
                </label>
                <input type="text" class="form-control" id="username" name="name"
                    placeholder="Masukkan username..." required>
                <div class="invalid-feedback">
                    Please masukkan username
                </div>
                <div class="valid-feedback">
                    Looks good!
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label" for="password-input">Password</label>
                <div class="position-relative auth-pass-inputgroup">
                    <input type="password" class="form-control pe-5 password-input" onpaste="return false"
                        name="password" placeholder="Enter password" id="password-input"
                        aria-describedby="passwordInput" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" required>
                    <button
                        class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted password-addon material-shadow-none"
                        type="button" id="password-addon">
                        <i class="ri-eye-fill align-middle"></i>
                    </button>
                    <div class="invalid-feedback">
                        Please masukkan password
                    </div>
                    <div class="valid-feedback">
                        Looks good!
                    </div>
                </div>
            </div>

            <div id="password-contain" class="p-3 bg-light mb-2 rounded">
                <h5 class="fs-13">Password must contain:</h5>
                <p id="pass-length" class="invalid fs-12 mb-2">Minimum <b>8 characters</b></p>
                <p id="pass-lower" class="invalid fs-12 mb-2">At <b>lowercase</b> letter (a-z)</p>
                <p id="pass-upper" class="invalid fs-12 mb-2">At least <b>uppercase</b> letter (A-Z)</p>
                <p id="pass-number" class="invalid fs-12 mb-0">A least <b>number</b> (0-9)</p>
            </div>

            <div class="mt-4">
                <button class="btn btn-success w-100" type="submit">Sign Up</button>
            </div>
        </form>
    </div>

    <div class="mt-5 text-center">
        <p class="mb-0">
            Already have an account ?
            <a href="{{ route('login') }}" class="fw-semibold text-primary text-decoration-underline"> Signin</a>
        </p>
    </div>
</x-template-auth-layout>
