<?php

namespace App\Http\Controllers\Backoffice;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    function index() {
        return view('backoffice.pages.auth.auth', [
            'page_title' => 'Login'
        ]);
    }
    function forgot() {
        return view('backoffice.pages.auth.forgot', [
            'page_title' => 'Login'
        ]);
    }
    function login(Request $request) {
        $formdata = $request->only(['email', 'password']);

        if(Auth::guard('web')->attempt($formdata)){
            return redirect()->route('backoffice.dashboard.index')->with('success', 'Login Sukses');
        }
        return redirect()->back()->with('error', 'Username atau Password Salah !');
    }
    function forgotPassword(Request $request) {
        
        return redirect()->route('auth.index')->with('success', 'Check email anda, dan masukkan sandi sesuai email');
    }
    function logout(Request $request) {
        Auth::guard('auth:web')->logout();
        return redirect()->route('auth.index')->with('success', 'Logout Sukses');
    }
}
