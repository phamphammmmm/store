<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginAdminController extends Controller
{
    public function showLoginForm()
    {
        return view('login-admin');
    }

    public function loginAdmin(Request $request)
    {
        $credentials = $request->validate([
            'name' => 'required',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            return redirect('/dashboard');
        } else {
            return redirect()->back()->withErrors(['login' => 'Invalid credentials']);
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/login-admin');
    }
}