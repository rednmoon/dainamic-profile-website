<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ProfileViewController extends Controller
{
    public function show($username)
    {
        $user = User::where('username', $username)
            ->with(['services' => function ($q) {
                $q->take(10); // Max 10 services limit
            }, 'favourites', 'tours'])
            ->firstOrFail();

        // Load first 6 images for gallery
        $galleries = $user->galleries()->latest()->paginate(6);

        return view('profile.show', compact('user', 'galleries'));
    }

    public function loadMoreGallery(Request $request, $username)
    {
        $user = User::where('username', $username)->firstOrFail();
        $galleries = $user->galleries()->latest()->paginate(6);

        if ($request->ajax()) {
            return view('profile.partials.gallery_items', compact('galleries'))->render();
        }

        return response()->json(['error' => 'Invalid Request'], 400);
    }
}