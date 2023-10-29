<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('client.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'name' => 'required',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            return redirect('/home');
        } else {
            return redirect()->back()->withErrors(['login' => 'Invalid credentials']);
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }
}