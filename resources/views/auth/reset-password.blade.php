<x-guest-layout>
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

    <!-- Header Section -->
    <div style="text-align: center; margin-bottom: 25px;">
        <span style="background: #fef3c7; color: #b45309; border: 1px solid #fde68a; font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px; padding: 4px 12px; border-radius: 20px; display: inline-block;">
            Account Security
        </span>
        <h2 style="font-size: 22px; font-weight: 800; color: #0f172a; margin-top: 10px; margin-bottom: 4px;">Set New Password</h2>
        <p style="font-size: 13px; color: #64748b; margin: 0;">Enter your email and choose a strong new password</p>
    </div>

    <form method="POST" action="{{ route('password.store') }}">
        @csrf

        <!-- Password Reset Token -->
        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <!-- Email Address -->
        <div style="margin-bottom: 16px;">
            <label for="email" style="display: block; font-size: 13px; font-weight: 600; color: #334155; margin-bottom: 6px;">Email Address</label>
            <input id="email" type="email" name="email" value="{{ old('email', $request->email) }}" required autofocus placeholder="e.g. partner@example.com"
                style="width: 100%; padding: 10px 14px; font-size: 14px; border: 1px solid #cbd5e1; border-radius: 8px; outline: none; box-sizing: border-box;">
            <x-input-error :messages="$errors->get('email')" class="mt-1" />
        </div>

        <!-- Password -->
        <div style="margin-bottom: 16px;">
            <label for="password" style="display: block; font-size: 13px; font-weight: 600; color: #334155; margin-bottom: 6px;">New Password</label>
            <input id="password" type="password" name="password" required placeholder="••••••••"
                style="width: 100%; padding: 10px 14px; font-size: 14px; border: 1px solid #cbd5e1; border-radius: 8px; outline: none; box-sizing: border-box;">
            <x-input-error :messages="$errors->get('password')" class="mt-1" />
        </div>

        <!-- Confirm Password -->
        <div style="margin-bottom: 20px;">
            <label for="password_confirmation" style="display: block; font-size: 13px; font-weight: 600; color: #334155; margin-bottom: 6px;">Confirm New Password</label>
            <input id="password_confirmation" type="password" name="password_confirmation" required placeholder="••••••••"
                style="width: 100%; padding: 10px 14px; font-size: 14px; border: 1px solid #cbd5e1; border-radius: 8px; outline: none; box-sizing: border-box;">
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1" />
        </div>

        <!-- Submit Button -->
        <button type="submit" style="width: 100%; background: #1e40af; color: #ffffff; font-weight: 700; font-size: 15px; padding: 12px; border: none; border-radius: 8px; cursor: pointer; transition: background 0.2s;">
            Reset Password
        </button>

        <!-- Back to Login -->
        <div style="text-align: center; margin-top: 18px;">
            <a href="{{ route('login') }}" style="font-size: 13px; font-weight: 700; color: #1e40af; text-decoration: none;">
                ← Back to Login
            </a>
        </div>
    </form>
</x-guest-layout>