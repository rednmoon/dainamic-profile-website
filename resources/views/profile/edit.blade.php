@extends('layouts.app')

@section('header')
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Profile Customization Center
    </h2>
@endsection

@section('content')
    <div class="max-w-4xl mx-auto py-6 sm:px-6 lg:px-8 space-y-6">

        <!-- 1. PROFILE INFORMATION CARD (Name & Username) -->
        <div class="p-6 sm:p-8 bg-white shadow sm:rounded-lg border border-gray-100">
            <div class="max-w-xl">
                <section>
                    <header class="mb-6">
                        <h2 class="text-lg font-bold text-gray-900">
                            Profile Information
                        </h2>
                        <p class="mt-1 text-sm text-gray-600">
                            Update your account's profile name and unique username.
                        </p>

                        <span  style="padding-top:12px; initial-letter: 1px; " class="pt-2">{{(Auth::user()->email) }}</span>
                    </header>

                    <!-- Success Alert for Info Update -->
                    @if (session('status') === 'profile-updated')
                        <div class="mb-4 text-sm font-medium text-emerald-600 bg-emerald-50 border border-emerald-200 p-3 rounded-lg">
                            Profile information updated successfully.
                        </div>
                    @endif

                    <form method="post" action="{{ route('profile.info.update') }}" class="space-y-5">
                        @csrf

                        <!-- Name Field -->
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700 mb-1">
                                Full Name
                            </label>
                            <input id="name" name="name" type="text" value="{{ old('name', Auth::user()->name) }}" required 
                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 @error('name') border-red-500 @enderror">
                            @error('name')
                                <span class="text-xs text-red-600 mt-1 block">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Username Field (Unique Validation) -->
                        <div>
                            <label for="username" class="block text-sm font-medium text-gray-700 mb-1">
                                Username
                            </label>
                            <div class="relative rounded-md shadow-sm">
                                <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400 text-sm">@</span>
                                <input id="username" name="username" type="text" value="{{ old('username', Auth::user()->username) }}" required 
                                       class="w-full pl-8 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 @error('username') border-red-500 @enderror">
                            </div>
                            @error('username')
                                <span class="text-xs text-red-600 mt-1 block">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Save Info Button -->
                        <div class="flex items-center gap-4 pt-2">
                            <button type="submit" class="px-5 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold text-sm rounded-lg shadow-sm transition">
                                Save Profile Info
                            </button>
                        </div>
                    </form>
                </section>
            </div>
        </div>

        <!-- 2. PASSWORD CHANGE CARD -->
        <div class="p-6 sm:p-8 bg-white shadow sm:rounded-lg border border-gray-100">
            <div class="max-w-xl">
                <section>
                    <header class="mb-6">
                        <h2 class="text-lg font-bold text-gray-900">
                            Update Password
                        </h2>
                        <p class="mt-1 text-sm text-gray-600">
                            Ensure your account is using a long, random password to stay secure.
                        </p>
                    </header>

                    <!-- Success Alert for Password Update -->
                    @if (session('status') === 'password-updated')
                        <div class="mb-4 text-sm font-medium text-emerald-600 bg-emerald-50 border border-emerald-200 p-3 rounded-lg">
                            Your password has been successfully updated.
                        </div>
                    @endif

                    <form method="post" action="{{ route('profile.password.update') }}" class="space-y-5">
                        @csrf

                        <!-- Current Password -->
                        <div>
                            <label for="current_password" class="block text-sm font-medium text-gray-700 mb-1">
                                Current Password
                            </label>
                            <input id="current_password" name="current_password" type="password" required 
                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 @error('current_password') border-red-500 @enderror">
                            @error('current_password')
                                <span class="text-xs text-red-600 mt-1 block">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- New Password -->
                        <div>
                            <label for="password" class="block text-sm font-medium text-gray-700 mb-1">
                                New Password
                            </label>
                            <input id="password" name="password" type="password" required 
                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 @error('password') border-red-500 @enderror">
                            @error('password')
                                <span class="text-xs text-red-600 mt-1 block">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Confirm Password -->
                        <div>
                            <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">
                                Confirm New Password
                            </label>
                            <input id="password_confirmation" name="password_confirmation" type="password" required 
                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                        </div>

                        <!-- Save Password Button -->
                        <div class="flex items-center gap-4 pt-2">
                            <button type="submit" class="px-5 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold text-sm rounded-lg shadow-sm transition">
                                Save Password
                            </button>
                        </div>
                    </form>
                </section>
            </div>
        </div>

    </div>
@endsection