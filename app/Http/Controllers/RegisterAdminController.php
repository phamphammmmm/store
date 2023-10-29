<?php
namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class RegisterAdminController extends Controller
{
    public function showRegistrationForm()
    {
        return view('register-admin');
    }

    public function registerAdmin(Request $request)
    {
        $request->validate([
            'name' => 'required|regex:/^\S*$/u',
            'password' => 'required',
        ]);

        $admin = new Admin();
        $admin->name = $request->name;
        $admin->password = bcrypt($request->password);
        $admin->save();

        return redirect('/login-admin');
    }
}