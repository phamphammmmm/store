<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('client.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|regex:/^\S*$/u',
            'password' => 'required',
            'phone' => 'required|numeric|digits_between:10,10',
            'email' => 'required',
            'path' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $phone = Str::startsWith($request->phone, '+84') ? $request->phone : '+84' . $request->phone;
        
        $path = $request->file('path');
        if ($request->hasFile('path')) {
            $avatarPath = $path->store('public/avatar');
            $avatarFileURL = '/storage/avatar/' . basename($avatarPath);
        } else {
            $avatarFileURL = '/storage/avatar/avatar.jpg';
        }
        $user = new User();
        $user->name = $request->name;
        $user->password = bcrypt($request->password);
        $user->phone = $request->phone;
        $user->email = $request->email;
        $user->path=$avatarFileURL;
        $user->role='user';
        $user->save();

        return redirect('/login');
    }
}