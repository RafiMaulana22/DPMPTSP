<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Facade;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password as FacadesPassword;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Str;
use Inertia\Inertia;
use Inertia\Response;

class AuthController extends Controller
{
    public function login(LoginRequest $request)
    {
        $request->authenticate();

        $request->session()->regenerate();

        return redirect()->intended(route('pertanyaan.index'));
    }

    public function register(Request $request)
    {
        // dd($request->all());

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required'],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $user->assignRole('admin');

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('pertanyaan.index'));
    }

    public function forgotPassword(Request $request)
    {
        // Langkah 1: Validasi input email
        $request->validate([
            'email' => 'required|email|exists:users,email', // Memastikan email ada di tabel users
        ], [
            'email.required' => 'Alamat email wajib diisi.',
            'email.email' => 'Format alamat email tidak valid.',
            'email.exists' => 'Email tidak ditemukan dalam sistem kami.', // Pesan error jika email tidak ada
        ]);

        // Langkah 2: Mencoba mengirim link reset password menggunakan PasswordBroker Laravel
        // Ini akan menangani pembuatan token, penyimpanan token, dan pengiriman email notifikasi
        $status = FacadesPassword::sendResetLink($request->only('email'));

        // Langkah 3: Memberikan respons berdasarkan status pengiriman link
        if ($status == FacadesPassword::RESET_LINK_SENT) {
            // Jika link berhasil dikirim
            return redirect()->back()->with('status', __('Link reset password telah berhasil kami kirim ke alamat email Anda!'));
            // __($status) juga bisa digunakan untuk pesan default Laravel yang sudah dilokalisasi
            // return redirect()->back()->with('status', __($status));
        }

        // Jika pengiriman link gagal (misalnya, email tidak ditemukan, meskipun validasi di atas sudah menangani ini)
        // atau terjadi masalah lain seperti throttling.
        // Pesan error default dari Laravel: __($status)
        return redirect()->back()->withErrors(['email' => __($status)]);
    }

    public function create(Request $request): Response
    {
        return Inertia::render('Auth/ResetPassword', [
            'email' => $request->email,
            'token' => $request->route('token'),
        ]);
    }

    public function showResetPassword(Request $request, $token)
    {
        $data = [
            'title' => 'Buat Password Baru',
            'email' => $request->query('email'), // Mengambil email dari query string
            'token' => $token,
        ];

        // dd($data);

        // Menampilkan form reset password
        return view('auth.reset-password', $data);
    }

    public function resetPassword(Request $request, $token)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => [
                'required',
                'confirmed',
                Password::min(8)->mixedCase()->numbers()->symbols()
            ],
        ]);

        $user = User::where('email', $request->email)->first();
        $user->dummy_password = $request->password; // Simpan password dummy
        $user->password = bcrypt($request->password); // Hash password baru
        $user->setRememberToken(Str::random(60));
        $user->save(); // Simpan perubahan pada user


        return redirect()->route('login')
            ->with('status', __('Password Anda telah berhasil direset! Silakan login dengan password baru Anda.'));
    }

    public function destroy()
    {
        Auth::logout();

        return redirect('/');
    }
}
