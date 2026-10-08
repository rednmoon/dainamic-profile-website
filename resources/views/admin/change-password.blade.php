@extends('layouts.admin')

@section('header')
    <h2 class="font-bold text-2xl text-gray-800 leading-tight">
        Change Password
    </h2>
@endsection

@section('content')
    <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
        
        @if(session('success'))
            <div class="p-4 mb-6 text-sm text-green-800 rounded-lg bg-green-50 border border-green-200 shadow-sm" role="alert">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white overflow-hidden shadow border border-gray-200 sm:rounded-lg p-6 sm:p-8">
            <h3 class="text-lg font-bold text-slate-800 mb-1">Update Admin Password</h3>
            <p class="text-sm text-gray-500 mb-6 border-b pb-4">Ensure your account is using a long, random password to stay secure.</p>

            <form method="POST" action="{{ route('admin.password.update') }}" class="space-y-5">
                @csrf

                <!-- Current Password -->
                <div>
                    <label for="current_password" class="block text-sm font-medium text-gray-700 mb-1">Current Password</label>
                    <input type="password" name="current_password" id="current_password" required 
                           class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-amber-500 focus:border-amber-500 @error('current_password') border-red-500 @enderror">
                    @error('current_password')
                        <span class="text-xs text-red-600 mt-1 block">{{ $message }}</span>
                    @enderror
                </div>

                <!-- New Password -->
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-1">New Password</label>
                    <input type="password" name="password" id="password" required 
                           class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-amber-500 focus:border-amber-500 @error('password') border-red-500 @enderror">
                    @error('password')
                        <span class="text-xs text-red-600 mt-1 block">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Confirm New Password -->
                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">Confirm New Password</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" required 
                           class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-amber-500 focus:border-amber-500">
                </div>

                <!-- Submit Button -->
                <div class="flex justify-end pt-4">
                    <button type="submit" class="px-5 py-2.5 bg-amber-500 hover:bg-amber-600 text-slate-950 font-bold text-sm rounded-lg shadow transition">
                        Update Password
                    </button>
                </div>
            </form>
        </div>

    </div>
@endsection