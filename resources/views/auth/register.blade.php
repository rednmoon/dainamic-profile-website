<x-guest-layout>
    <!-- CSS to hide default Laravel logo from guest layout -->
    <style>
        /* Hide logo from guest layout header */
        .min-h-screen > div:first-child a, 
        .min-h-screen > div:first-child svg { 
            display: none !important; 
        }
        /* Make guest card wider and clean */
        .min-h-screen > div.w-full {
            max-width: 520px !important;
            padding: 35px 30px !important;
            border-radius: 16px !important;
            box-shadow: 0 10px 30px rgba(0,0,0,0.08) !important;
            background-color: #ffffff !important;
        }
    </style>

    <!-- Header Section -->
    <div style="text-align: center; margin-bottom: 25px;">
        <span style="background: #fef3c7; color: #b45309; border: 1px solid #fde68a; font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px; padding: 4px 12px; border-radius: 20px; display: inline-block;">
            Partnership Registration
        </span>
        <h2 style="font-size: 22px; font-weight: 800; color: #0f172a; margin-top: 10px; margin-bottom: 4px;">Join as an Official Partner</h2>
        <p style="font-size: 13px; color: #64748b; margin: 0;">Create your account to launch your service platform</p>
    </div>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div style="margin-bottom: 16px;">
            <label for="name" style="display: block; font-size: 13px; font-weight: 600; color: #334155; margin-bottom: 6px;">Full Name</label>
            <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus placeholder="e.g. Jeanne H"
                style="width: 100%; padding: 10px 14px; font-size: 14px; border: 1px solid #cbd5e1; border-radius: 8px; outline: none; box-sizing: border-box;">
            <x-input-error :messages="$errors->get('name')" class="mt-1" />
        </div>

        <!-- Username -->
        <div style="margin-bottom: 16px;">
            <label for="username" style="display: block; font-size: 13px; font-weight: 600; color: #334155; margin-bottom: 6px;">Username (Domain URL Keyword)</label>
            <input id="username" type="text" name="username" value="{{ old('username') }}" required placeholder="e.g. jeanne"
                style="width: 100%; padding: 10px 14px; font-size: 14px; border: 1px solid #cbd5e1; border-radius: 8px; outline: none; box-sizing: border-box;">
            <x-input-error :messages="$errors->get('username')" class="mt-1" />
        </div>

        <!-- Email Address -->
        <div style="margin-bottom: 16px;">
            <label for="email" style="display: block; font-size: 13px; font-weight: 600; color: #334155; margin-bottom: 6px;">Email Address</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required placeholder="e.g. jeanne@email.com"
                style="width: 100%; padding: 10px 14px; font-size: 14px; border: 1px solid #cbd5e1; border-radius: 8px; outline: none; box-sizing: border-box;">
            <x-input-error :messages="$errors->get('email')" class="mt-1" />
        </div>

        <!-- Password -->
        <div style="margin-bottom: 16px;">
            <label for="password" style="display: block; font-size: 13px; font-weight: 600; color: #334155; margin-bottom: 6px;">Password</label>
            <input id="password" type="password" name="password" required placeholder="••••••••"
                style="width: 100%; padding: 10px 14px; font-size: 14px; border: 1px solid #cbd5e1; border-radius: 8px; outline: none; box-sizing: border-box;">
            <x-input-error :messages="$errors->get('password')" class="mt-1" />
        </div>

        <!-- Confirm Password -->
        <div style="margin-bottom: 18px;">
            <label for="password_confirmation" style="display: block; font-size: 13px; font-weight: 600; color: #334155; margin-bottom: 6px;">Confirm Password</label>
            <input id="password_confirmation" type="password" name="password_confirmation" required placeholder="••••••••"
                style="width: 100%; padding: 10px 14px; font-size: 14px; border: 1px solid #cbd5e1; border-radius: 8px; outline: none; box-sizing: border-box;">
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1" />
        </div>

        <!-- Fee Card -->
        <div style="background: #0f172a; color: #ffffff; padding: 14px 18px; border-radius: 10px; display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
            <div>
                <span style="font-size: 10px; color: #94a3b8; text-transform: uppercase; font-weight: 600; display: block;">Partner Fee</span>
                <span style="font-size: 18px; font-weight: 800; color: #f59e0b;">$500 <small style="font-size: 11px; font-weight: 400; color: #cbd5e1;">/ One-time</small></span>
            </div>
            <span style="font-size: 11px; background: #1e293b; color: #e2e8f0; padding: 4px 10px; border-radius: 6px; border: 1px solid #334155;">Instant Access</span>
        </div>

        <!-- Submit Button -->
        <button type="submit" style="width: 100%; background: #1e40af; color: #ffffff; font-weight: 700; font-size: 15px; padding: 12px; border: none; border-radius: 8px; cursor: pointer; transition: background 0.2s;">
            Complete Registration
        </button>

        <!-- Login Link -->
        <div style="text-align: center; margin-top: 16px;">
            <span style="font-size: 13px; color: #64748b;">Already registered? </span>
            <a href="{{ route('login') }}" style="font-size: 13px; font-weight: 700; color: #1e40af; text-decoration: none;">Log in</a>
        </div>
    </form>
</x-guest-layout>