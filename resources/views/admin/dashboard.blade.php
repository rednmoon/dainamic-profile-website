@extends('layouts.admin')

@section('header')
    <h2 class="font-bold text-2xl text-gray-800 leading-tight">
        Admin Dashboard
    </h2>
@endsection

@section('content')
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
        
        <!-- Welcome Card -->
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 border border-gray-100">
            <h3 class="text-2xl font-bold text-slate-800 mb-1">Welcome Back, {{ Auth::user()->name }}! 👋</h3>
            <p class="text-gray-600 text-sm">You are logged in to the Administrator Control Center.</p>
        </div>

        <!-- STATS SUMMARY CARDS -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
            
            <!-- Total Users -->
            <div class="bg-white p-5 rounded-xl shadow-sm border border-gray-200 flex items-center justify-between">
                <div>
                    <p class="text-xs font-semibold uppercase tracking-wider text-gray-500">Total Users</p>
                    <h4 class="text-3xl font-extrabold text-slate-800 mt-1">{{ $totalUsers ?? 0 }}</h4>
                </div>
                <div class="p-3 bg-blue-100 text-blue-600 rounded-lg">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                    </svg>
                </div>
            </div>

            <!-- Pending Approvals -->
            <div class="bg-white p-5 rounded-xl shadow-sm border border-gray-200 flex items-center justify-between">
                <div>
                    <p class="text-xs font-semibold uppercase tracking-wider text-amber-600">Pending Requests</p>
                    <h4 class="text-3xl font-extrabold text-amber-600 mt-1">{{ $pendingUsers ?? 0 }}</h4>
                </div>
                <div class="p-3 bg-amber-100 text-amber-600 rounded-lg">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
            </div>

            <!-- Total Approved -->
            <div class="bg-white p-5 rounded-xl shadow-sm border border-gray-200 flex items-center justify-between">
                <div>
                    <p class="text-xs font-semibold uppercase tracking-wider text-emerald-600">Total Approved</p>
                    <h4 class="text-3xl font-extrabold text-emerald-600 mt-1">{{ $approvedUsers ?? 0 }}</h4>
                </div>
                <div class="p-3 bg-emerald-100 text-emerald-600 rounded-lg">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
            </div>

            <!-- Total Rejected -->
            <div class="bg-white p-5 rounded-xl shadow-sm border border-gray-200 flex items-center justify-between">
                <div>
                    <p class="text-xs font-semibold uppercase tracking-wider text-rose-600">Total Rejected</p>
                    <h4 class="text-3xl font-extrabold text-rose-600 mt-1">{{ $rejectedUsers ?? 0 }}</h4>
                </div>
                <div class="p-3 bg-rose-100 text-rose-600 rounded-lg">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
            </div>

        </div>

        <!-- Quick Action Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
            <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-200">
                <h4 class="font-bold text-lg text-slate-800 mb-2">User Approvals Management</h4>
                <p class="text-sm text-gray-600 mb-4">Manage, approve, or reject partner registration requests from one central place.</p>
                <a href="{{ route('admin.users') }}" class="inline-flex items-center bg-slate-900 text-white font-bold text-sm px-4 py-2.5 rounded-lg hover:bg-slate-800 transition">
                    Manage Users
                    <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                    </svg>
                </a>
            </div>

            <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-200">
                <h4 class="font-bold text-lg text-slate-800 mb-2">System Health</h4>
                <p class="text-sm text-gray-600 mb-4">All authentication systems and partner management services are functioning properly.</p>
                <span class="inline-flex items-center bg-emerald-100 text-emerald-800 text-xs font-bold px-3 py-1 rounded-full">
                    <span class="w-2 h-2 mr-1.5 bg-emerald-500 rounded-full animate-pulse"></span>
                    System Operational
                </span>
            </div>
        </div>

    </div>
@endsection