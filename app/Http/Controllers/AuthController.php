<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Middleware\CheckAuthenticated;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // صفحه ثبت‌نام
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    // ثبت‌نام کاربر
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        Auth::login($user); // وارد کردن کاربر پس از ثبت‌نام

        return redirect()->route('dashboard');
    }

    // صفحه ورود
    public function showLoginForm()
    {
        // dd("hi");
        return view('auth.login');
    }

    // ورود کاربر
    public function login(Request $request)
    {
        // اعتبارسنجی و ورود کاربر
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            // پس از ورود موفق، به صفحه داشبورد یا صفحه اصلی هدایت می‌شود
            return redirect()->route('dashboard');
        }

        return back()->withErrors(['email' => 'Invalid credentials']);
    }

    // خروج کاربر
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
