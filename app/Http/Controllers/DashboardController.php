<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\Favourite;
use App\Models\Tour;
use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user()->load(['services', 'favourites', 'tours', 'galleries']);
        return view('dashboard', compact('user'));
    }

    // 1. Profile, Logo, Favicon & Branding Setup
   public function updateSettings(Request $request)
{
    $user = auth()->user();

    $data = $request->validate([
        // Contact & Social
        'phone'         => 'nullable|string|max:30',
        'email_address' => 'nullable|email|max:255',
        'whatsapp'      => 'nullable|string|max:255',
        'telegram'      => 'nullable|string|max:255',
        'facebook'      => 'nullable|url|max:255',
        'instagram'     => 'nullable|url|max:255',
        'linkedin'      => 'nullable|url|max:255',
        'youtube'       => 'nullable|url|max:255',

        // Theme & Branding
        'theme_color'        => 'nullable|string|max:20',
        'navbar_bg'          => 'nullable|string|max:255',
        'footer_bg'          => 'nullable|string|max:255',
        'navbar_text_color'  => 'nullable|string|max:20',
        'footer_text_color'  => 'nullable|string|max:20',
        'navbar_font'        => 'nullable|string|max:100',
        'footer_font'        => 'nullable|string|max:100',
        'site_font'          => 'nullable|string|max:100',

        // Hero
        'hero_title'       => 'nullable|string|max:255',
        'hero_subtitle'    => 'nullable|string|max:255',
        'hero_button_text' => 'nullable|string|max:100',
        'hero_button_url'  => 'nullable|string|max:255', // #contact allowed
        'about_me'         => 'nullable|string',

        // Files
        'hero_bg' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        'logo'    => 'nullable|image|mimes:jpeg,png,jpg,webp,svg|max:2048',
        'favicon' => 'nullable|mimes:jpeg,png,jpg,ico,webp|max:1024',
    ]);

    // Handle file uploads + delete old files
    $fileFields = [
        'hero_bg' => 'hero',
        'logo'    => 'branding',
        'favicon' => 'branding',
    ];

    foreach ($fileFields as $field => $folder) {
        if ($request->hasFile($field)) {
            // delete old
            if (!empty($user->$field) && Storage::disk('public')->exists($user->$field)) {
                Storage::disk('public')->delete($user->$field);
            }
            $data[$field] = $request->file($field)->store($folder, 'public');
        }
    }

    $user->update($data);

    return redirect()->back()->with('success', 'Profile and site customisation updated successfully!');
}

    // 2. Services Management
    public function storeService(Request $request)
    {
        $user = auth()->user();

        if ($user->services()->count() >= 10) {
            return back()->with('error', 'Maximum limit of 10 services reached!');
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|max:2048',
            'button_text' => 'nullable|string|max:50',
            'button_url' => 'nullable|string',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('uploads/services', 'public');
        }

        $user->services()->create([
            'title' => $request->title,
            'description' => $request->description,
            'button_text' => $request->button_text ?? 'Book Now',
            'button_url' => $request->button_url,
            'image' => $imagePath,
        ]);

        return back()->with('success', 'Service added successfully!');
    }

  public function editService($id)
    {
        $service = Service::where('user_id', auth()->id())->findOrFail($id);
        
        // যদি ফাইলটি resources/views/dashboard/services/edit.blade.php হয়:
        return view('services.edit', compact('service')); 
    }

    public function updateService(Request $request, $id)
    {
        $service = Service::where('user_id', auth()->id())->findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|max:2048',
            'button_text' => 'nullable|string|max:50',
            'button_url' => 'nullable|string',
        ]);

        if ($request->hasFile('image')) {
            if ($service->image) {
                Storage::disk('public')->delete($service->image);
            }
            $service->image = $request->file('image')->store('uploads/services', 'public');
        }

        $service->update([
            'title' => $request->title,
            'description' => $request->description,
            'button_text' => $request->button_text ?? 'Book Now',
            'button_url' => $request->button_url,
            'image' => $service->image,
        ]);

        return redirect()->route('dashboard')->with('success', 'Service updated successfully!');
    }

    public function destroyService($id)
    {
        $service = Service::where('user_id', auth()->id())->findOrFail($id);

        if ($service->image) {
            Storage::disk('public')->delete($service->image);
        }

        $service->delete();
        return back()->with('success', 'Service deleted successfully!');
    }

    // 3. Favourite Items Management
    public function storeFavourite(Request $request)
    {
        $request->validate([
            'category' => 'required|string|max:255',
            'items' => 'required|string',
        ]);

        auth()->user()->favourites()->create([
            'category' => $request->category,
            'items' => $request->items,
        ]);

        return back()->with('success', 'Favourite item added!');
    }

    public function destroyFavourite($id)
    {
        $favourite = Favourite::where('user_id', auth()->id())->findOrFail($id);
        $favourite->delete();

        return back()->with('success', 'Favourite item deleted!');
    }

    // 4. Tour Packages Management
public function storeTour(Request $request)
{
    $request->validate([
        'title' => 'required|string|max:255',
        'duration' => 'required|string|max:100',
        'price' => 'required|numeric',
        'start_date' => 'nullable|date',
        'image' => 'nullable|image|max:2048',
    ]);

    $imagePath = null;
    if ($request->hasFile('image')) {
        $imagePath = $request->file('image')->store('uploads/tours', 'public');
    }

    // Process highlights from Blade Form Array format: highlights[index][title]
    $highlights = [];
    if ($request->has('highlights') && is_array($request->highlights)) {
        foreach ($request->highlights as $hl) {
            if (!empty($hl['title'])) {
                $highlights[] = [
                    'title' => $hl['title'],
                    'duration' => $hl['duration'] ?? '',
                    'price' => $hl['price'] ?? 0,
                ];
            }
        }
    }

    auth()->user()->tours()->create([
        'title' => $request->title,
        'sub_title' => $request->sub_title,
        'start_date' => $request->start_date,
        'duration' => $request->duration,
        'price' => $request->price,
        'description' => $request->description,
        'image' => $imagePath,
        'highlights' => $highlights,
    ]);

    return back()->with('success', 'Tour added successfully!');
}

public function editTour($id)
{
    $tour = Tour::where('user_id', auth()->id())->findOrFail($id);
    return view('tours.edit', compact('tour'));
}

public function updateTour(Request $request, $id)
{
    $tour = Tour::where('user_id', auth()->id())->findOrFail($id);

    $request->validate([
        'title' => 'required|string|max:255',
        'duration' => 'required|string|max:100',
        'price' => 'required|numeric',
        'start_date' => 'nullable|date',
        'image' => 'nullable|image|max:2048',
    ]);

    if ($request->hasFile('image')) {
        if ($tour->image) {
            Storage::disk('public')->delete($tour->image);
        }
        $tour->image = $request->file('image')->store('uploads/tours', 'public');
    }

    // Process highlights from Blade Form Array format: highlights[index][title]
    $highlights = [];
    if ($request->has('highlights') && is_array($request->highlights)) {
        foreach ($request->highlights as $hl) {
            if (!empty($hl['title'])) {
                $highlights[] = [
                    'title' => $hl['title'],
                    'duration' => $hl['duration'] ?? '',
                    'price' => $hl['price'] ?? 0,
                ];
            }
        }
    }

    $tour->update([
        'title' => $request->title,
        'sub_title' => $request->sub_title,
        'start_date' => $request->start_date,
        'duration' => $request->duration,
        'price' => $request->price,
        'description' => $request->description,
        'highlights' => $highlights,
        'image' => $tour->image,
    ]);

    return redirect()->route('dashboard')->with('success', 'Tour updated successfully!');
}

    public function destroyTour($id)
    {
        $tour = Tour::where('user_id', auth()->id())->findOrFail($id);

        if ($tour->image) {
            Storage::disk('public')->delete($tour->image);
        }

        $tour->delete();
        return back()->with('success', 'Tour deleted successfully!');
    }

    // 5. Gallery Management
    public function storeGallery(Request $request)
    {
        $request->validate([
            'images.*' => 'required|image|mimes:jpg,jpeg,png,webp|max:3072'
        ]);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {
                $path = $file->store('uploads/gallery', 'public');
                auth()->user()->galleries()->create(['image_path' => $path]);
            }
        }

        return back()->with('success', 'Gallery images uploaded successfully!');
    }

    public function destroyGallery($id)
    {
        $gallery = Gallery::where('user_id', auth()->id())->findOrFail($id);

        if ($gallery->image_path) {
            Storage::disk('public')->delete($gallery->image_path);
        }

        $gallery->delete();
        return back()->with('success', 'Gallery image deleted successfully!');
    }
}