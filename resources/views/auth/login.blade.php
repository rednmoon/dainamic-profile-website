<x-guest-layout>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- CSS to hide default Laravel logo and customize card layout -->
    <style>
        /* Hide logo from guest layout header */
        .min-h-screen > div:first-child a, 
        .min-h-screen > div:first-child svg { 
            display: none !important; 
        }
        /* Make guest card wider and clean */
        .min-h-screen > div.w-full {
            max-width: 480px !important;
            padding: 35px 30px !important;
            border-radius: 16px !important;
            box-shadow: 0 10px 30px rgba(0,0,0,0.08) !important;
            background-color: #ffffff !important;
        }
    </style>


    @if (session('error'))
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: "{{ session('error') }}",
            confirmButtonColor: '#3085d6',
        });
    </script>
@endif

@if ($errors->any())
    <script>
        Swal.fire({
            icon: 'warning',
            title: 'Attention!',
            text: "{{ $errors->first() }}",
            confirmButtonColor: '#f59e0b',
        });
    </script>
@endif

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <!-- Header Section -->
    <div style="text-align: center; margin-bottom: 25px;">
        <span style="background: #eff6ff; color: #1e40af; border: 1px solid #bfdbfe; font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px; padding: 4px 12px; border-radius: 20px; display: inline-block;">
            Partner Portal
        </span>
        <h2 style="font-size: 22px; font-weight: 800; color: #0f172a; margin-top: 10px; margin-bottom: 4px;">Welcome Back</h2>
        <p style="font-size: 13px; color: #64748b; margin: 0;">Log in to access your partner dashboard</p>
    </div>

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div style="margin-bottom: 16px;">
            <label for="email" style="display: block; font-size: 13px; font-weight: 600; color: #334155; margin-bottom: 6px;">Email Address</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus placeholder="e.g. partner@example.com"
                style="width: 100%; padding: 10px 14px; font-size: 14px; border: 1px solid #cbd5e1; border-radius: 8px; outline: none; box-sizing: border-box;">
           
        </div>

        <!-- Password -->
        <div style="margin-bottom: 16px;">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 6px;">
                <label for="password" style="font-size: 13px; font-weight: 600; color: #334155;">Password</label>
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" style="font-size: 12px; font-weight: 600; color: #1e40af; text-decoration: none;">
                        Forgot password?
                    </a>
                @endif
            </div>
            <input id="password" type="password" name="password" required placeholder="••••••••"
                style="width: 100%; padding: 10px 14px; font-size: 14px; border: 1px solid #cbd5e1; border-radius: 8px; outline: none; box-sizing: border-box;">
            
        </div>

        <!-- Remember Me -->
        <div style="display: flex; align-items: center; margin-bottom: 20px;">
            <input id="remember_me" type="checkbox" name="remember" style="width: 16px; height: 16px; border-radius: 4px; border: 1px solid #cbd5e1; cursor: pointer;">
            <label for="remember_me" style="margin-left: 8px; font-size: 13px; color: #475569; cursor: pointer;">
                Remember me
            </label>
        </div>

        <!-- Submit Button -->
        <button type="submit" style="width: 100%; background: #1e40af; color: #ffffff; font-weight: 700; font-size: 15px; padding: 12px; border: none; border-radius: 8px; cursor: pointer; transition: background 0.2s;">
            Log In
        </button>

        <!-- Register Link -->
        @if (Route::has('register'))
            <div style="text-align: center; margin-top: 18px;">
                <span style="font-size: 13px; color: #64748b;">Don't have an account? </span>
                <a href="{{ route('register') }}" style="font-size: 13px; font-weight: 700; color: #1e40af; text-decoration: none;">Become a Partner</a>
            </div>
        @endif
    </form>
</x-guest-layout>