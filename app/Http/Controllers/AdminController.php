<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;


class AdminController extends Controller
{

    public function showChangePasswordForm()
    {
        return view('admin.change-password');
    }

    /**
     * Update Admin Password
     */
    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required', 'current_password'],
            'password' => ['required', 'confirmed', Password::defaults()],
        ], [
            'current_password.current_password' => 'The provided current password does not match our records.',
        ]);

        $user = auth()->user();
        $user->password = Hash::make($request->password);
        $user->save();

        return redirect()->back()->with('success', 'Password updated successfully!');
    }



    public function dashboard()
    {
        // Total Users (Admin chara baki sob user)
        $totalUsers = User::where('usertype', '!=', 'admin')->count();

        // Pending Users (is_approved = 0 ebong status 'rejected' noy ba conditional count)
        // Apnar DB design onusare condition check korun
        $pendingUsers = User::where('usertype', '!=', 'admin')
                            ->where('is_approved', 0)
                            ->count();

        // Approved Users (is_approved = 1)
        $approvedUsers = User::where('usertype', '!=', 'admin')
                             ->where('is_approved', 1)
                             ->count();

        // Rejected Users (Jodi rejected state 'is_approved = 2' ba status column ache)
        // Jodi is_approved = 0 kei pending dhora hoy, tabe status/condition customize korte paren.
        // Niche standard example dewa holo:
        $rejectedUsers = User::where('usertype', '!=', 'admin')
                             ->where('is_approved', 2) // ba $user->status == 'rejected'
                             ->count();

        return view('admin.dashboard', compact(
            'totalUsers',
            'pendingUsers',
            'approvedUsers',
            'rejectedUsers'
        ));
    }
    
    /**
     * Display all pending and approved users.
     */
    public function index()
    {
        $pendingUsers = User::where('is_approved', 0)->where('usertype', '!=', 'admin')->get();
        $approvedUsers = User::where('is_approved', 1)->where('usertype', '!=', 'admin')->get();

        return view('admin.users', compact('pendingUsers', 'approvedUsers'));
    }

    /**
     * Approve a user (Set is_approved = 1).
     */
    public function approve($id)
    {
        $user = User::findOrFail($id);
        $user->is_approved = 1;
        $user->save();

        return redirect()->back()->with('success', 'User has been approved successfully.');
    }

    /**
     * Reject/Revoke a user (Set is_approved = 0).
     */
    public function reject($id)
    {
        $user = User::findOrFail($id);
        $user->is_approved = 0;
        $user->save();

        return redirect()->back()->with('success', 'User status set to rejected/pending.');
    }

    /**
     * Delete user permanently.
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->back()->with('success', 'User deleted successfully.');
    }
}