<?php

namespace App\Http\Controllers;

use PDF;
use App\Models\User; // Add this line
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Helpers\UserHelper;
use Illuminate\Support\Facades\DB;

class ManageController extends Controller
{
    public function index()
    {
        $totalUsers = User::count();
        $users = User::orderBy('created_at', 'asc')->get();
        $newUsers = User::where('created_at', '>=', now()->subDay())->count();

        return view('admin.manage', [
            'users' => $users,
            'newUsers' => $newUsers,
            'totalUsers' => $totalUsers,
        ]);
    }
    

    public function create(Request $request)
    {
        if (User::where('name', $request->input('name'))->exists()) {
            return redirect()->back()->with('error', 'Failed creation of a user account due to duplicate');
        }
      
        $request->validate([
            'name' => 'required|string|regex:/^\S*$/u|max:255', 
            'password' => 'required',
            'phone' => 'required|numeric|digits_between:10,10',
            'email' => 'required|string|email|max:255|unique:users',
        ]);

        $name = $request->input('name');
        $email = $request->input('email');
        $phone = $request->input('phone');
        $password = $request->input('password');
        
        $user = new User();
        $user->name = $name;
        $user->phone = $phone;
        $user->password = bcrypt($password);
        $user->email = $email;
        $user->role = 'user';
        $user->save();

        return redirect()->route('manage')->with('success', 'User added successfully!!');
    }

    public function delete($id)
    {
        $user = User::find($id);

        if ($user) {
            $user->delete();
            return redirect()->route('manage')->with('success', 'User deleted successfully.');
        } else {
            return redirect()->route('manage')->with('error', 'User not found.');
        }
    }

    public function update(Request $request)
    {
         $request->validate([
            'name' => 'required|regex:/^\S*$/u|max:255', 
            'editUserId'=>'required',
            'email' => 'required',
            'role'=>'required',
        ]);

        $name = $request->input('name');
        $email = $request->input('email');
        $role = $request->input('role');
        $editUserId = $request->input('editUserId');
        
        $user = User::findOrFail($editUserId);
        
        if ($user) {
            $user->name = $name;
            $user->role = $role; 
            $user->email = $email; 
            $user->save();
            
            return redirect()->route('manage')->with('success', 'User added successfully!!');
        } else {
            return response()->json(['message' => 'User not found'], 404);
        }
    }

    public function search(Request $request)
    {   
        $searchTerm = $request->input('search');

        if (empty($searchTerm)) {
            $users = [];
        } else {
            $users = User::whereIn('role', ['user', 'moderator'])->where('name', 'like', '%' . $searchTerm . '%')->get();
        }

       return redirect()->back()->with('users', $users);
    }

    
    public function getUser($id)
    {
        $user = User::find($id);
    
        if ($user) {
            return response()->json($user);
        } else {
            return response()->json(['error' => 'User not found'], 404);
        }
    }
    
    public function getRegistrationData()
    {
        $registrationData = User::select(DB::raw('DATE(created_at) as date'), DB::raw('count(*) as registrations'))
            ->groupBy('date')
            ->get();
    
        return response()->json($registrationData);
    }

    public function export()
    {
        $users = User::all();

        $pdf = PDF::loadView('pdf.users', compact('users'));

        return $pdf->download('users.pdf');
    }
}