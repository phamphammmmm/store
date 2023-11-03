<?php

namespace App\Http\Controllers;

class HomeController extends Controller
{
    public function home()
    {
        return view('client.home');
    }

    public function about()
    {
        return view('client.about');
    }

    public function header()
    {
        return view('partials.header');
    }

    public function footer()
    {
        return view('partials.footer');
    }
}