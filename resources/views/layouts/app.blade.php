<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} - Admin Dashboard</title>

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- SweetAlert2 CDN -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- FontAwesome Icons CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- Custom CSS for smooth scrolling -->
    <style>
        html { scroll-behavior: smooth; }
    </style>
</head>
<body class="bg-gray-100 text-gray-800 font-sans antialiased min-h-screen">

    <div class="flex flex-col md:flex-row min-h-screen">
        
        <!-- SIDEBAR -->
        <aside class="w-full md:w-64 bg-slate-900 text-slate-100 flex-shrink-0 flex flex-col justify-between min-h-screen">
            <div>
                <!-- Brand / Logo -->
                <div class="h-16 flex items-center justify-between px-6 bg-slate-950 border-b border-slate-800">
                    <a href="{{ route('dashboard') }}" class="flex items-center gap-3 font-bold text-lg text-white">
                        <i class="fa-solid fa-gauge-high text-blue-500"></i>
                        <span>Control Panel</span>
                    </a>
                </div>

                <!-- Navigation Links -->
                <nav class="p-4 space-y-1 text-sm font-medium">
                    <a href="{{ route('dashboard') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg transition {{ request()->routeIs('dashboard') ? 'bg-blue-600 text-white font-semibold' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
                        <i class="fa-solid fa-chart-line w-5"></i>
                        <span>Dashboard</span>
                    </a>
                    <a href="#branding-section" class="flex items-center gap-3 px-4 py-3 rounded-lg text-slate-300 hover:bg-slate-800 hover:text-white transition">
                        <i class="fa-solid fa-sliders w-5"></i>
                        <span>Branding & Bio</span>
                    </a>
                    <a href="#services-section" class="flex items-center gap-3 px-4 py-3 rounded-lg text-slate-300 hover:bg-slate-800 hover:text-white transition">
                        <i class="fa-solid fa-briefcase w-5"></i>
                        <span>Services</span>
                    </a>
                    <a href="#favourites-section" class="flex items-center gap-3 px-4 py-3 rounded-lg text-slate-300 hover:bg-slate-800 hover:text-white transition">
                        <i class="fa-solid fa-heart w-5"></i>
                        <span>Favourites</span>
                    </a>
                    <a href="#tours-section" class="flex items-center gap-3 px-4 py-3 rounded-lg text-slate-300 hover:bg-slate-800 hover:text-white transition">
                        <i class="fa-solid fa-plane-departure w-5"></i>
                        <span>Tours & Events</span>
                    </a>
                    <a href="#gallery-section" class="flex items-center gap-3 px-4 py-3 rounded-lg text-slate-300 hover:bg-slate-800 hover:text-white transition">
                        <i class="fa-solid fa-images w-5"></i>
                        <span>Gallery</span>
                    </a>

                     <a href="{{route('profile.edit')}}" class="flex items-center gap-3 px-4 py-3 rounded-lg text-slate-300 hover:bg-slate-800 hover:text-white transition">
                        <i class="fa-solid fa-user w-5"></i>
                        <span>Change Profile</span>
                    </a>


                </nav>
            </div>

            <!-- Footer info in Sidebar -->
            <div class="p-4 border-t border-slate-800 text-xs text-slate-400 text-center">
                &copy; {{ date('Y') }} Admin Dashboard
            </div>
        </aside>

        <!-- MAIN CONTENT AREA -->
        <div class="flex-1 flex flex-col min-w-0">
            <!-- Top Header Navbar -->
            <header class="h-16 bg-white border-b border-gray-200 px-6 flex items-center justify-between shadow-xs sticky top-0 z-20">
                <h1 class="text-xl font-bold text-gray-800">
                    @yield('header', 'Dashboard Overview')
                </h1>

                <div class="flex items-center gap-4">
                    <span class="text-sm font-medium text-gray-700 bg-gray-100 px-3 py-1.5 rounded-md flex items-center gap-2">
                        <i class="fa-regular fa-circle-user text-blue-600"></i> {{ auth()->user()->name ?? 'User' }}
                    </span>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="text-sm px-3 py-1.5 bg-red-50 hover:bg-red-100 text-red-600 rounded-md transition font-semibold flex items-center gap-1.5">
                            <i class="fa-solid fa-right-from-bracket"></i> Logout
                        </button>
                    </form>
                </div>
            </header>

            <!-- Main Dynamic Content Body -->
            <main class="p-6 md:p-8 flex-1 overflow-y-auto">
                @yield('content')
            </main>
        </div>

    </div>

    @stack('scripts')
</body>
</html>