<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PublicController extends Controller
{
    /**
     * Show the public landing page
     */
    public function landing(Request $request)
    {
        if (Auth::check()) {
            return redirect()->route('dashboard');
        }
        return view('public.landing');
    }

    /**
     * Show about page
     */
    public function about()
    {
        return view('public.about');
    }

    /**
     * Show features page
     */
    public function features()
    {
        return view('public.features');
    }

    /**
     * Show FAQ page
     */
    public function faq()
    {
        return view('public.faq');
    }

    /**
     * Show blog page
     */
    public function blog()
    {
        return view('public.blog');
    }

    /**
     * Show contact page
     */
    public function contact()
    {
        return view('public.contact');
    }
}
