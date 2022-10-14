<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Inertia\Inertia;

class AuthenticateController extends Controller
{
    // Method Login
    public function login()
    {
        return Inertia::render('Auth/Login', ['title' => 'Login']);
    }

    public function authenticate(Request $request)
    {
        $rules = [
            'email' => 'required',
            'password' => 'required',
        ];

        $rulesMessage = [
            'email.required' => 'Kolom email wajib diisi.',
            'email.email' => 'Email tidak valid.',
            'password.required' => 'Kolom password wajib diisi.',
        ];

        $credentials = $request->validate($rules);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            if (Auth::user()->role_id === 1) return redirect()->intended('dashboard');

            return redirect()->intended('/dashboard');
        }

        return back()->with('error', 'Email atau password Anda salah.')->withInput();
    }

    public function logout()
    {
        (Auth::user()->role_id === 1) ?
            $redirect = redirect('/login') : $redirect = redirect('/login');

        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();

        return $redirect;
    }


    // Method Register
    public function register()
    {
        return Inertia::render('Auth/Register', [
            'title' => 'Register',
            'roles' => Role::where('id', '!=', 1)->get(),
        ]);
    }

    public function registerStore(Request $request)
    {
        // dd($request->all());
        $rules = [
            'name' => 'required',
            'username' => 'required',
            'email' => 'required|email:dns|unique:users',
            'password' => 'required|min:6',
            'role_id' => 'required',
            'terms' => 'required',
        ];

        $rulesMessage = [
            'name.required' => 'Kolom nama wajib diisi.',
            'username' => 'Kolom username wajib diisi',
            'email.required' => 'Kolom email wajib diisi.',
            'email.email' => 'Email tidak valid.',
            'email.unique' => 'Email sudah digunakan.',
            'role_id.required' => 'Jenis user wajib dipilih.',
            'password.required' => 'Kolom password wajib diisi.',
            'password.min' => 'Password minimal 6 karakter.',
        ];

        $validatedData = $request->validate($rules, $rulesMessage);
        User::create([
            'name' => Str::title($request->name),
            'username' => Str::lower($request->username),
            'email' => $request->email,
            'role_id' => $request->role_id,
            'username' => Str::slug($request->name),
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('login')->with('success', 'Akun berhasil dibuat — silahkan login.');
    }

    public function forgetPassword(Request $request)
    {
        return view('authentication.forget-password', ['title' => 'Forget Password']);
    }

    public function forgot()
    {
        return Inertia::render('Auth/Forgot', ['title' => 'Forget Password']);
    }
}
