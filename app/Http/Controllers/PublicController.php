<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

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

    /**
     * Handle contact form submission
     */
    public function contactSubmit(Request $request)
    {
        $validated = $request->validate([
            'name'        => 'required|string|max:120',
            'email'       => 'required|email|max:200',
            'institution' => 'nullable|string|max:200',
            'subject'     => 'nullable|string|max:120',
            'message'     => 'required|string|min:10|max:3000',
        ]);

        // Log the inquiry institutionally (replace with Mail::send when SMTP is configured)
        Log::info('Opeshis Contact Inquiry', $validated);

        return redirect()->route('contact')->with('success', 'Your message has been received. Our team will respond within one business day.');
    }
}
