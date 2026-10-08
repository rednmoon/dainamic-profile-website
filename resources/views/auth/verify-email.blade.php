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
            Verify Email
        </span>
        <h2 style="font-size: 22px; font-weight: 800; color: #0f172a; margin-top: 10px; margin-bottom: 6px;">Check Your Email</h2>
        <p style="font-size: 13px; color: #64748b; margin: 0; line-height: 1.5;">
            Thanks for signing up! Before getting started, please verify your email address by clicking on the link we just emailed to you.
        </p>
    </div>

    <!-- Success Message Status -->
    @if (session('status') == 'verification-link-sent')
        <div style="background: #f0fdf4; color: #15803d; border: 1px solid #bbf7d0; padding: 12px; border-radius: 8px; font-size: 13px; font-weight: 600; margin-bottom: 20px; text-align: center;">
            A new verification link has been sent to the email address you provided during registration.
        </div>
    @endif

    <!-- Actions Section -->
    <div style="margin-top: 25px; display: flex; flex-direction: column; gap: 12px; align-items: center;">
        <!-- Resend Link Form -->
        <form method="POST" action="{{ route('verification.send') }}" style="width: 100%;">
            @csrf
            <button type="submit" style="width: 100%; background: #1e40af; color: #ffffff; font-weight: 700; font-size: 15px; padding: 12px; border: none; border-radius: 8px; cursor: pointer; transition: background 0.2s;">
                Resend Verification Email
            </button>
        </form>

        <!-- Logout Form -->
        <form method="POST" action="{{ route('logout') }}" style="margin-top: 6px;">
            @csrf
            <button type="submit" style="background: none; border: none; font-size: 13px; font-weight: 600; color: #64748b; cursor: pointer; text-decoration: underline;">
                Log Out
            </button>
        </form>
    </div>
</x-guest-layout>