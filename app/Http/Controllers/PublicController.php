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
     * Show institutional blog post
     */
    public function blogPost($slug)
    {
        $articles = [
            'crisis-of-his-africa' => [
                'title' => 'The Crisis of HIS in Africa: A Systemic Analysis',
                'category' => 'Infrastructure',
                'date' => 'May 12, 2026',
                'summary' => 'Why 80% of legacy HMS deployments fail in Sub-Saharan Africa, and how localized engineering solves the infrastructure gap.'
            ],
            'reducing-diagnostic-error' => [
                'title' => 'Reducing Diagnostic Error: The Role of CDSS',
                'category' => 'Clinical Support',
                'date' => 'May 08, 2026',
                'summary' => 'How Clinical Decision Support Systems bridge the specialist gap in regional medical centers across Cameroon.'
            ]
        ];

        if (!isset($articles[$slug])) {
            abort(404);
        }

        return view('public.article', $articles[$slug]);
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

        return redirect()->route('public.contact')->with('success', 'Your message has been received. Our team will respond within one business day.');
    }
}
