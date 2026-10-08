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
    <div style="text-align: center; margin-bottom: 20px;">
        <span style="background: #fef3c7; color: #b45309; border: 1px solid #fde68a; font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px; padding: 4px 12px; border-radius: 20px; display: inline-block;">
            Security Check
        </span>
        <h2 style="font-size: 22px; font-weight: 800; color: #0f172a; margin-top: 10px; margin-bottom: 6px;">Confirm Password</h2>
        <p style="font-size: 13px; color: #64748b; margin: 0; line-height: 1.5;">
            This is a secure area of the application. Please confirm your password before continuing.
        </p>
    </div>

    <form method="POST" action="{{ route('password.confirm') }}">
        @csrf

        <!-- Password -->
        <div style="margin-bottom: 20px;">
            <label for="password" style="display: block; font-size: 13px; font-weight: 600; color: #334155; margin-bottom: 6px;">Password</label>
            <input id="password" type="password" name="password" required autocomplete="current-password" placeholder="••••••••"
                style="width: 100%; padding: 10px 14px; font-size: 14px; border: 1px solid #cbd5e1; border-radius: 8px; outline: none; box-sizing: border-box;">
            <x-input-error :messages="$errors->get('password')" class="mt-1" />
        </div>

        <!-- Submit Button -->
        <button type="submit" style="width: 100%; background: #1e40af; color: #ffffff; font-weight: 700; font-size: 15px; padding: 12px; border: none; border-radius: 8px; cursor: pointer; transition: background 0.2s;">
            Confirm Password
        </button>
    </form>
</x-guest-layout>