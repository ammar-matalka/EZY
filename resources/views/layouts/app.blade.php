<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'EZY Skills - Empower Your Skills')</title>

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('images/logo-icon.png') }}">

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Swiper CSS (for sliders) -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

    <!-- Custom Tailwind Config -->
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: {
                            DEFAULT: '#003B73',
                            dark: '#002A52',
                        },
                        secondary: {
                            DEFAULT: '#FF8C42',
                            light: '#FFA766',
                        },
                        orange: {
                            DEFAULT: '#FF8C42',
                            light: '#FFA766',
                        }
                    },
                    fontFamily: {
                        sans: ['Inter', 'system-ui', 'sans-serif'],
                    }
                }
            }
        }
    </script>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Custom Styles -->
    <style>
        * {
            font-family: 'Inter', sans-serif;
        }

        /* Smooth scroll */
        html {
            scroll-behavior: smooth;
        }

        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 10px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        ::-webkit-scrollbar-thumb {
            background: #003B73;
            border-radius: 5px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #002A52;
        }
    </style>

    @stack('styles')
</head>
<body class="bg-white">

    <!-- Navbar Component -->
    @include('components.navbar')

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer Component -->
    @include('components.footer')

    <!-- Swiper JS -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

    <!-- Alpine.js for interactive components -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Flash Messages (Success / Error) -->
    @if(session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: "{{ session('success') }}",
                confirmButtonColor: '#f97316'
            });
        </script>
    @endif

    @if(session('error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: "{{ session('error') }}",
                confirmButtonColor: '#ef4444'
            });
        </script>
    @endif

    @stack('scripts')
</body>
</html>
