<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rules\Password as RulesPassword;
use Illuminate\View\View;

class ProfileController extends Controller
{
    public function show()
    {
        $data = [
            'title' => 'Profile',
            'user' => Auth::user(),
        ];

        return view('admin.profile.show', $data);
    }
    /**
     * Display the user's profile form.
     */
    public function edit()
    {
        $data = [
            'title' => 'Edit Profile',
            'user' => Auth::user(),
        ];

        return view('admin.profile.update', $data);
    }

    /**
     * Update the user's profile information.
     */
    public function update(Request $request)
    {
        // Aturan validasi
        $validatedData = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
            ],
            // Anda bisa menambahkan validasi untuk field lain di sini
            // 'username' => ['nullable', 'string', 'max:255', Rule::unique('users')->ignore($user->id)],
        ]);

        $user = Auth::user();
        $userModel = User::findOrFail($user->id);

        // Update data pengguna
        // Cara 1: Langsung assign dan save
        $userModel->name = $validatedData['name'];
        $userModel->email = $validatedData['email'];
        $userModel->save();

        return redirect()->route('profile.show')->with('success', 'profile-updated');
    }

    public function editPassword()
    {
        $data = [
            'title' => 'Ubah Password',
        ];

        return view('admin.profile.password', $data);
    }

    public function updatePassword(Request $request)
    {
        $user = Auth::user();

        // Validasi input
        $request->validate([
            'current_password' => ['required', 'string', function ($attribute, $value, $fail) use ($user) {
                if (!Hash::check($value, $user->password)) {
                    $fail('Password Anda saat ini tidak cocok.');
                }
            }],
            'password' => [
                'required',
                'string',
                RulesPassword::min(8) // Minimal 8 karakter
                    ->mixedCase() // Wajib huruf besar dan kecil
                    ->numbers()   // Wajib angka
                    ->symbols(),  // Wajib simbol (misal: !@#$%^)
                'confirmed' // Wajib ada field 'password_confirmation' yang cocok
            ],
            // Field 'password_confirmation' akan divalidasi oleh aturan 'confirmed' pada 'password'
        ]);

        $userModel = User::findOrFail($user->id);

        // Update password pengguna
        $userModel->password = bcrypt($request->password);
        $userModel->save();

        return redirect()->route('profile.show')->with('success', 'Password berhasil diperbarui!');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
