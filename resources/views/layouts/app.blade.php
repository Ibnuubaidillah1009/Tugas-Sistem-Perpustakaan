<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <style>
            /* Paksa semua teks menjadi hitam agar kontras di tema terang */
            html, body, body * { color: #000 !important; }
            a { color: #000 !important; }
            /* Ikon berbasis currentColor ikut menjadi hitam */
            .fill-current, svg { color: #000 !important; }

            /* Field input agar jelas terlihat di tema terang */
            input[type="text"], input[type="email"], input[type="password"], input[type="date"], input[type="number"], select, textarea {
                background-color: #fff !important;
                color: #000 !important;
            }
            input::placeholder, textarea::placeholder {
                color: #6b7280 !important; /* gray-500 */
                opacity: 1;
            }
            input:-webkit-autofill,
            input:-webkit-autofill:hover,
            input:-webkit-autofill:focus,
            textarea:-webkit-autofill,
            textarea:-webkit-autofill:hover,
            textarea:-webkit-autofill:focus,
            select:-webkit-autofill,
            select:-webkit-autofill:hover,
            select:-webkit-autofill:focus {
                -webkit-box-shadow: 0 0 0px 1000px #fff inset;
                box-shadow: 0 0 0px 1000px #fff inset;
                -webkit-text-fill-color: #000;
            }
        </style>
    </head>
    <body class="font-sans antialiased text-gray-800">
        <div class="min-h-screen bg-white">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main class="text-gray-800">
                {{ $slot }}
            </main>
        </div>
    </body>
</html>
