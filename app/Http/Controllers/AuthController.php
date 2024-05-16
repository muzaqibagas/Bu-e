<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Spatie\Permission\Models\Role;

class AuthController extends Controller
{
    public function showAdminLoginForm()
    {
        return view('admin-login');
    }

    public function adminLogin(Request $request)
{
    $credentials = $request->only('email', 'password');

    if (Auth::guard('admin')->attempt($credentials)) {
        // Ambil data admin yang berhasil login
        $admin = Auth::guard('admin')->user();
        // Simpan data admin ke dalam sesi
        $request->session()->put('admin', $admin);

        return redirect()->route('dashboard');
    }

    return back()->withErrors([
        'email' => 'The provided credentials do not match our records.',
    ]);
}


    public function showAdminSignupForm()
    {
        return view('signup-admin');
    }

    public function adminSignup(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:admins',
            'password' => 'required|string|min:8',
            // Add other validation rules if needed
        ]);

        $admin = new Admin();
        $admin->username = $request->username;
        $admin->email = $request->email;
        $admin->password = Hash::make($request->password);
        $admin->save();

        return redirect()->route('admin-login')->with('success', 'Admin signup successful! Please login.');
    }

    public function showUserLoginForm()
    {
        return view('user-login');
    }

    public function userLogin(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            return redirect()->route('user.dashboard');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    public function showUserSignupForm()
    {
        return view('signup-user');
    }

    public function userSignup(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users|unique:admins',
            'phone' => 'required|string|max:20',
            'password' => 'required|string|min:8',
            // Add other validation rules if needed
        ]);

        $user = new User();
        $user->username = $request->username;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->password = Hash::make($request->password);
        // Add other fields if needed
        $user->save();

        return redirect()->route('user-login')->with('success', 'User signup successful! Please login.');
    }
        public function profile()
    {
        $user = Auth::user();
        return view('user-profile', compact('user'));
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/admin-login');
    }
        public function userlogout()
    {
        Auth::logout();
        return redirect()->route('user-login')->with('success', 'You have been logged out.');
    }
    public function editProfileForm()
    {
        // Ambil data pengguna yang sedang login
        $user = auth()->user();

        // Tampilkan halaman form edit profil dengan data pengguna
        return view('edit-profile', compact('user'));
    }

    public function updateProfile(Request $request)
    {
        // Validasi input
        $request->validate([
            'username' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            // Tambahkan validasi lain jika diperlukan
        ]);

        // Ambil data pengguna yang sedang login
        $user = auth()->user();

        // Update data profil pengguna
        $user->username = $request->username;
        $user->phone = $request->phone;
        // Update field lainnya jika diperlukan

        // Simpan perubahan
        $user->save();

        // Redirect kembali ke halaman profil dengan pesan sukses
        return redirect()->route('user.profile')->with('success', 'Profile updated successfully!');
    }
}


