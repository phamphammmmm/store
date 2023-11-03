<?php

namespace App\Http\Controllers;

use PDF;
use App\Models\Contact;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;

class ContactController extends Controller
{ 
    public function show(){
        $contacts  = Contact::orderBy('created_at','asc')->get();
        return view('admin.contact', ['contacts' => $contacts]);
    }

    public function create(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'message' => 'required',
        ]);

        $contact = new Contact();
        $contact->name = auth()->user()->name; // Gán tên tài khoản đang đăng nhập
        $contact->email = $request->input('email');
        $contact->content = $request->input('message');
        $contact->save();

        return redirect()->back()->with('success', 'Contact created successfully');
    }

    public function delete($id)
    {
        $contact = Contact::find($id);
        
        if (!$contact) {
            return redirect()->back()->with('error', 'contact not found.');
        }

        $contact->delete();

        return redirect()->route('contact-admin')->with('success', 'contact deleted successfully.');
    }
}