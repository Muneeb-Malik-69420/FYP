<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'EcoBite')</title>
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <script src="https://cdn.tailwindcss.com"></script>
    
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;800&display=swap" rel="stylesheet">

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Montserrat', 'sans-serif'],
                    },
                    colors: {
                        'forest-dark': '#0f711c',
                        'forest-light': '#52c234',
                    },
                    keyframes: {
                        show: {
                            '0%, 49.99%': { opacity: '0', zIndex: '10' },
                            '50%, 100%': { opacity: '1', zIndex: '50' },
                        }
                    },
                    animation: {
                        show: 'show 0.9s',
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-gray-50 m-0 p-0 font-sans antialiased text-gray-900">

    <div class="sticky top-0 z-[60]">
        @include('partials.nav')
    </div>

    <main>
        @yield('content')
    </main>

    @yield('scripts')
</body>
</html>