<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @livewireStyles()
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title', 'Rat Quotes')</title>

    <link rel="icon" href="/favicon.ico" sizes="any">
    <link rel="icon" href="/favicon.svg" type="image/svg+xml">
    <link rel="apple-touch-icon" href="/apple-touch-icon.png">

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

    @vite('resources/css/app.css')
</head>

<body
    class="bg-background dark:bg-background text-text flex p-6 lg:p-8 items-center lg:justify-center min-h-screen flex-col pt-16">
    <header class="w-full lg:max-w-4xl max-w-[335px] text-sm mb-6 not-has-[nav]:hidden">
        <nav
            class="fixed top-0 left-0 w-full z-50 bg-nav-bg text-nav-text h-16 shadow-sm flex items-center justify-between px-6">
            <div class="flex items-center">
                <a href="{{ url('/') }}" class=" text-x1 font-semibold no-underline">
                    Rat Quotes
                </a>
            </div>
            <livewire:login />
        </nav>
    </header>

    @if (Route::has('login'))
        <div class="h-14.5 hidden lg:block"></div>
    @endif


    <footer style="text-align:center; padding: 20px; margin-top: 40px; font-size: 14px; color: #666;">
        © 2025 arstdhneio. All Rights Reserved.
        <a href="{{ route('privacy') }}" style="color: #666; text-decoration: underline;">Privacy Policy</a>
    </footer>

    @livewireScripts()
    @stack('scripts')
</body>

</html>