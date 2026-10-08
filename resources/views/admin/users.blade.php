@extends('layouts.admin')

@section('header')
    <h2 class="font-bold text-2xl text-gray-800 leading-tight">
        User Approval Management
    </h2>
@endsection

@section('content')
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
        
        @if(session('success'))
            <div class="p-4 text-sm text-green-800 rounded-lg bg-green-50 border border-green-200 shadow-sm" role="alert">
                {{ session('success') }}
            </div>
        @endif

        <!-- Pending Users Section -->
        <div class="bg-white overflow-hidden shadow border border-gray-200 sm:rounded-lg p-6">
            <h3 class="text-lg font-bold text-amber-600 mb-4 border-b pb-2">Pending User Requests</h3>
            
            @if($pendingUsers->isEmpty())
                <p class="text-gray-500 py-4">No pending user requests found.</p>
            @else
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="border-b bg-gray-50 text-gray-700 uppercase text-xs">
                                <th class="p-3">Name</th>
                                <th class="p-3">Username</th>
                                <th class="p-3">Email</th>
                                <th class="p-3 text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @foreach($pendingUsers as $user)
                                <tr class="hover:bg-gray-50">
                                    <td class="p-3 font-medium text-gray-900">{{ $user->name }}</td>
                                    <td class="p-3 text-gray-600">{{ $user->username }}</td>
                                    <td class="p-3 text-gray-600">{{ $user->email }}</td>
                                    <td class="p-3">
                                        <div class="flex items-center justify-end space-x-2">
                                            <form method="POST" action="{{ route('admin.users.approve', $user->id) }}">
                                                @csrf
                                                <button type="submit" class="px-3 py-1.5 bg-emerald-600 hover:bg-emerald-700 text-white rounded text-xs font-bold transition">
                                                    Approve
                                                </button>
                                            </form>
                                            <form method="POST" action="{{ route('admin.users.reject', $user->id) }}">
                                                @csrf
                                                <button type="submit" class="px-3 py-1.5 bg-rose-600 hover:bg-rose-700 text-white rounded text-xs font-bold transition">
                                                    Reject
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>

        <!-- Approved Users Section -->
        <div class="bg-white overflow-hidden shadow border border-gray-200 sm:rounded-lg p-6">
            <h3 class="text-lg font-bold text-slate-800 mb-4 border-b pb-2">Approved Active Partners</h3>
            
            @if($approvedUsers->isEmpty())
                <p class="text-gray-500 py-4">No approved users found.</p>
            @else
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="border-b bg-gray-50 text-gray-700 uppercase text-xs">
                                <th class="p-3">Name</th>
                                <th class="p-3">Username</th>
                                <th class="p-3">Email</th>
                                <th class="p-3">Status</th>
                                <th class="p-3 text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @foreach($approvedUsers as $user)
                                <tr class="hover:bg-gray-50">
                                    <td class="p-3 font-medium text-gray-900">{{ $user->name }}</td>
                                    <td class="p-3 text-gray-600">{{ $user->username }}</td>
                                    <td class="p-3 text-gray-600">{{ $user->email }}</td>
                                    <td class="p-3">
                                        <span class="inline-block px-2.5 py-1 bg-green-100 text-green-800 text-xs font-bold rounded-full">
                                            Active
                                        </span>
                                    </td>
                                    <td class="p-3">
                                        <div class="flex items-center justify-end space-x-2">
                                            <!-- Move Approved User back to Reject/Pending state -->
                                            <form method="POST" action="{{ route('admin.users.reject', $user->id) }}">
                                                @csrf
                                                <button type="submit" class="px-3 py-1.5 bg-amber-600 hover:bg-amber-700 text-white rounded text-xs font-bold transition" onclick="return confirm('Are you sure you want to revoke/reject this user?')">
                                                    Reject
                                                </button>
                                            </form>

                                            <!-- Permanently Delete User -->
                                            <form method="POST" action="{{ route('admin.users.destroy', $user->id) }}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="px-3 py-1.5 bg-red-600 hover:bg-red-700 text-white rounded text-xs font-bold transition" onclick="return confirm('Are you sure you want to permanently delete this user?')">
                                                    Delete
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>

    </div>
@endsection