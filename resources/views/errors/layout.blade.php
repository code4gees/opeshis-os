<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') | Opeshis OS</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg-color: #0a0b0d;
            --card-bg: #14161a;
            --text-primary: #e2e8f0;
            --text-secondary: #94a3b8;
            --accent-color: #3b82f6;
            --error-color: #ef4444;
        }
        body {
            margin: 0;
            padding: 0;
            background-color: var(--bg-color);
            color: var(--text-primary);
            font-family: 'Inter', sans-serif;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            overflow: hidden;
        }
        .container {
            text-align: center;
            max-width: 600px;
            padding: 2rem;
            background: var(--card-bg);
            border: 1px solid #2d3139;
            border-radius: 16px;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
            animation: fadeIn 0.8s ease-out;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .error-code {
            font-size: 8rem;
            font-weight: 800;
            margin: 0;
            line-height: 1;
            background: linear-gradient(to bottom right, #3b82f6, #1d4ed8);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            opacity: 0.8;
        }
        h1 {
            font-size: 2rem;
            margin-top: 1rem;
            color: var(--text-primary);
        }
        p {
            color: var(--text-secondary);
            font-size: 1.1rem;
            margin-bottom: 2rem;
            line-height: 1.6;
        }
        .btn {
            display: inline-block;
            padding: 0.75rem 1.5rem;
            background-color: var(--accent-color);
            color: white;
            text-decoration: none;
            border-radius: 8px;
            font-weight: 600;
            transition: all 0.3s ease;
            box-shadow: 0 4px 6px -1px rgba(59, 130, 246, 0.4);
        }
        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 15px -3px rgba(59, 130, 246, 0.5);
            background-color: #2563eb;
        }
        .institution-logo {
            margin-bottom: 2rem;
            opacity: 0.7;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="institution-logo">
            <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="color: #3b82f6;">
                <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path>
            </svg>
        </div>
        <h2 class="error-code">@yield('code')</h2>
        <h1>@yield('message')</h1>
        <p>@yield('description')</p>
        <a href="{{ Auth::check() ? route('dashboard') : route('landing') }}" class="btn">
            Return to Command Center
        </a>
    </div>
</body>
</html>
