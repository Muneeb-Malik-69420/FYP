<!DOCTYPE html>
<html lang="en" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'EcoBite')</title>
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    @livewireStyles

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;800&display=swap" rel="stylesheet">
    {{-- <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;800&display=swap" rel="stylesheet"> --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="bg-gray-50 m-0 p-0 font-sans antialiased text-gray-900 min-h-screen flex flex-col">

    <div class="sticky top-0 z-[60]">
        @include('partials.main-nav')
    </div>

    <main class="flex-1">
        @yield('content')
        {{ $slot ?? '' }} {{-- This allows it to work with both Layouts and Components --}}
    </main>
 @livewire('favourites-panel')
 @livewire('cart-drawer')
 @livewire('review-prompt')
@livewire('notifications-panel')  {{-- ADD --}}

    @livewireScripts
    @yield('scripts')
    

</body>
</html>