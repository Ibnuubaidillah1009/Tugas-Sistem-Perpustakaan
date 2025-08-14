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
            /* Paksa semua teks menjadi hitam di halaman guest */
            html, body, body * { color: #000 !important; }
            a { color: #000 !important; }
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
            /* Autofill chrome */
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
    <body class="font-sans text-gray-800 antialiased">
        <div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-amber-50 to-emerald-50 px-4">
            
            <div class="w-full max-w-lg mt-0 p-8 bg-white shadow-xl overflow-hidden rounded-2xl border border-gray-200">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>
