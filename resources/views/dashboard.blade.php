@extends('layouts.app')

@section('header')
    Profile Customization Center
@endsection
<style>

/* ============ FORM INPUT STYLING ============ */
input[type="text"],
input[type="email"],
input[type="url"],
input[type="number"],
input[type="password"],
input[type="tel"],
input[type="search"],
input[type="color"],
select,
textarea {
    width: 100%;
    border: 1px solid silver;
    padding: 5px;
    border-radius: 6px;
    font-size: 14px;
    color: #1e293b;
    background: #ffffff;
    outline: none;
    transition: border-color 0.2s, box-shadow 0.2s;
    font-family: inherit;
}

/* Focus state */
input[type="text"]:focus,
input[type="email"]:focus,
input[type="url"]:focus,
input[type="number"]:focus,
input[type="password"]:focus,
input[type="tel"]:focus,
input[type="search"]:focus,
select:focus,
textarea:focus {
    border-color: #2563eb;
    box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.15);
}

/* File input আলাদা styling (কারণ file input-এ padding ঠিকভাবে কাজ করে না) */
input[type="file"] {
    width: 100%;
    border: 1px solid silver;
    padding: 6px 8px;
    border-radius: 6px;
    background: #ffffff;
    font-size: 12px;
    cursor: pointer;
}

/* Color picker একটু আলাদা — ছোট বর্গাকার */
input[type="color"] {
    width: 60px;
    height: 40px;
    padding: 2px;
    cursor: pointer;
}

/* Textarea একটু বেশি padding */
textarea {
    padding: 10px;
    resize: vertical;
    min-height: 80px;
}

/* Select dropdown */
select {
    cursor: pointer;
    appearance: none;
     padding: 12px;
    background-image: url("data:image/svg+xml;utf8,<svg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 24 24' fill='none' stroke='%2364748b' stroke-width='2'><polyline points='6 9 12 15 18 9'/></svg>");
    background-repeat: no-repeat;
    background-position: right 10px center;
    padding-right: 30px;
}
</style>
@section('content')
    <div class="max-w-6xl mx-auto space-y-8">

        <!-- Flash Alerts -->
        @if(session('success'))
            <div class="p-4 bg-emerald-50 border-l-4 border-emerald-500 text-emerald-800 rounded-r-lg shadow-sm flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <i class="fa-solid fa-circle-check text-emerald-500 text-xl"></i>
                    <span class="font-medium">{{ session('success') }}</span>
                </div>
                <button onclick="this.parentElement.remove()" class="text-emerald-600 hover:text-emerald-800">&times;</button>
            </div>
        @endif

        @if(session('error'))
            <div class="p-4 bg-rose-50 border-l-4 border-rose-500 text-rose-800 rounded-r-lg shadow-sm flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <i class="fa-solid fa-circle-exclamation text-rose-500 text-xl"></i>
                    <span class="font-medium">{{ session('error') }}</span>
                </div>
                <button onclick="this.parentElement.remove()" class="text-rose-600 hover:text-rose-800">&times;</button>
            </div>
        @endif

        @if ($errors->any())
            <div class="p-4 bg-rose-50 border-l-4 border-rose-500 text-rose-800 rounded-r-lg shadow-sm">
                <div class="flex items-center gap-2 mb-2 font-bold">
                    <i class="fa-solid fa-triangle-exclamation"></i>
                    <span>Please fix the following errors:</span>
                </div>
                <ul class="list-disc list-inside text-xs space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- MAIN BRANDING & HERO FORM -->
        <form action="{{ route('dashboard.settings') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
            @csrf
            @method('PUT')

            <!-- SECTION 1: HERO SECTION SETTINGS -->
            <section id="hero-section" class="bg-white rounded-xl p-2 shadow-sm border border-gray-200 overflow-hidden">
                <div class="px-6 py-4 bg-slate-50 border-b border-gray-200 flex items-center gap-3">
                    <i class="fa-solid fa-star text-amber-500 text-lg"></i>
                    <h2 class="text-lg font-bold text-gray-800">1. Hero Section Setup</h2>
                </div>
                <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-xs font-semibold text-gray-700 mb-1">Hero Main Title / Slogan</label>
                        <input type="text" name="hero_title" value="{{ old('hero_title', $user->hero_title ?? '') }}" placeholder="Welcome to My Portfolio" class="w-full border-gray-300 rounded-lg shadow-sm text-sm">
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-gray-700 mb-1">Hero Subtitle / Tagline</label>
                        <input type="text" name="hero_subtitle" value="{{ old('hero_subtitle', $user->hero_subtitle ?? '') }}" placeholder="Professional Web Developer & Designer" class="w-full border-gray-300 rounded-lg shadow-sm text-sm">
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-gray-700 mb-1">Button Text</label>
                        <input type="text" name="hero_button_text" value="{{ old('hero_button_text', $user->hero_button_text ?? '') }}" placeholder="Explore Services" class="w-full border-gray-300 rounded-lg shadow-sm text-sm">
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-gray-700 mb-1">Button Action URL</label>
                        <input type="url" name="hero_button_url" value="{{ old('hero_button_url', $user->hero_button_url ?? '') }}" placeholder="https://example.com/contact" class="w-full border-gray-300 rounded-lg shadow-sm text-sm">
                    </div>

                    <div class="md:col-span-2 bg-gray-50 p-4 rounded-lg border border-dashed border-gray-300">
                        <label class="block text-xs font-semibold text-gray-700 mb-2">Hero Background Image</label>
                        <input type="file" name="hero_bg" accept="image/*" onchange="previewImage(event, 'hero-bg-preview')" class="block w-full text-xs text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-xs file:font-semibold file:bg-amber-50 file:text-amber-700 hover:file:bg-amber-100">
                        <div class="mt-3 flex items-center gap-3">
                            <span class="text-xs text-gray-400">Current / Preview:</span>
                            <img id="hero-bg-preview" src="{{ (!empty($user->hero_bg)) ? asset('storage/' . $user->hero_bg) : 'https://placehold.co/600x200?text=Hero+Background' }}" class="h-20 w-full max-w-xs object-cover border bg-white p-1 rounded">
                        </div>
                    </div>
                </div>
            </section>

            <!-- SECTION 2: BRANDING & NAVIGATION DISPLAY -->
<section id="branding-section" class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
    <div class="px-6 py-4 bg-slate-50 border-b border-gray-200 flex items-center gap-3">
        <i class="fa-solid fa-sliders text-blue-600 text-lg"></i>
        <h2 class="text-lg font-bold text-gray-800">2. Branding & Site Styling</h2>
    </div>

    <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-6">

        <!-- Theme Accent Color -->
        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-1">Theme Accent Color</label>
            <div class="flex items-center gap-3">
                <input type="color" name="theme_color"
                    value="{{ old('theme_color', $user->theme_color ?? '#2563eb') }}"
                    class="h-10 w-20 p-1 border-gray-300 rounded-lg cursor-pointer">
                <span class="text-xs text-gray-500">Buttons & header accent</span>
            </div>
        </div>

        <!-- Global Font -->
        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-1">Global Website Font</label>
            <select name="site_font" class="w-full border-gray-300 p-2 rounded-lg shadow-sm text-sm">
                @php
                    $fonts = [
                        'inherit'          => 'Default (Inherit)',
                        'Poppins'          => 'Poppins',
                        'Inter'            => 'Inter',
                        'Roboto'           => 'Roboto',
                        'Open Sans'        => 'Open Sans',
                        'Lato'             => 'Lato',
                        'Montserrat'       => 'Montserrat',
                        'Nunito'           => 'Nunito',
                        'Raleway'          => 'Raleway',
                        'Playfair Display' => 'Playfair Display (Serif)',
                        'Merriweather'     => 'Merriweather (Serif)',
                        'Georgia'          => 'Georgia (System Serif)',
                    ];
                @endphp
                @foreach($fonts as $value => $label)
                    <option value="{{ $value }}" {{ old('site_font', $user->site_font ?? 'inherit') == $value ? 'selected' : '' }}>
                        {{ $label }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Navbar Background -->
        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-1">Navbar Background</label>
            <div class="flex gap-2 items-center">
                <input type="color"
                    value="{{ old('navbar_bg', $user->navbar_bg ?? '#ffffff') }}"
                    onchange="document.getElementById('navbar_bg_text').value = this.value"
                    class="h-10 w-16 p-1 border-gray-300 rounded-lg cursor-pointer">
                <input type="text" id="navbar_bg_text" name="navbar_bg"
                    value="{{ old('navbar_bg', $user->navbar_bg ?? '#ffffff') }}"
                    placeholder="#ffffff or linear-gradient(...)"
                    class="flex-1 border-gray-300 rounded-lg shadow-sm text-sm">
            </div>
            <span class="text-xs text-gray-400">Color picker অথবা CSS value (gradient/image)</span>
        </div>

        <!-- Navbar Text Color -->
        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-1">Navbar Text Color</label>
            <div class="flex gap-2 items-center">
                <input type="color"
                    value="{{ old('navbar_text_color', $user->navbar_text_color ?? '#334155') }}"
                    onchange="document.getElementById('navbar_text_color').value = this.value"
                    class="h-10 w-16 p-1 border-gray-300 rounded-lg cursor-pointer">
                <input type="text" id="navbar_text_color" name="navbar_text_color"
                    value="{{ old('navbar_text_color', $user->navbar_text_color ?? '#334155') }}"
                    class="flex-1 border-gray-300 rounded-lg shadow-sm text-sm">
            </div>
        </div>

        <!-- Navbar Font -->
        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-1">Navbar Font</label>
            <select name="navbar_font" class="w-full border-gray-300 p-2 rounded-lg shadow-sm text-sm">
                <option value="inherit" {{ old('navbar_font', $user->navbar_font ?? 'inherit') == 'inherit' ? 'selected' : '' }}>Default (Inherit)</option>
                @foreach(['Poppins','Inter','Roboto','Lato','Montserrat','Nunito'] as $f)
                    <option value="{{ $f }}" {{ old('navbar_font', $user->navbar_font ?? '') == $f ? 'selected' : '' }}>{{ $f }}</option>
                @endforeach
            </select>
        </div>

        <!-- Footer Background -->
        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-1">Footer Background</label>
            <div class="flex gap-2 items-center">
                <input type="color"
                    value="{{ old('footer_bg', $user->footer_bg ?? '#0f172a') }}"
                    onchange="document.getElementById('footer_bg_text').value = this.value"
                    class="h-10 w-16 p-1 border-gray-300 rounded-lg cursor-pointer">
                <input type="text" id="footer_bg_text" name="footer_bg"
                    value="{{ old('footer_bg', $user->footer_bg ?? '#0f172a') }}"
                    placeholder="#0f172a or linear-gradient(...)"
                    class="flex-1 border-gray-300 rounded-lg shadow-sm text-sm">
            </div>
            <span class="text-xs text-gray-400">Color picker or CSS value</span>
        </div>

        <!-- Footer Text Color -->
        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-1">Footer Text Color</label>
            <div class="flex gap-2 items-center">
                <input type="color"
                    value="{{ old('footer_text_color', $user->footer_text_color ?? '#ffffff') }}"
                    onchange="document.getElementById('footer_text_color').value = this.value"
                    class="h-10 w-16 p-1 border-gray-300 rounded-lg cursor-pointer">
                <input type="text" id="footer_text_color" name="footer_text_color"
                    value="{{ old('footer_text_color', $user->footer_text_color ?? '#ffffff') }}"
                    class="flex-1 border-gray-300 rounded-lg shadow-sm text-sm">
            </div>
        </div>

        <!-- Footer Font -->
        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-1">Footer Font</label>
            <select name="footer_font" class="w-full border-gray-300 p-2 rounded-lg shadow-sm text-sm">
                <option value="inherit" {{ old('footer_font', $user->footer_font ?? 'inherit') == 'inherit' ? 'selected' : '' }}>Default (Inherit)</option>
                @foreach(['Poppins','Inter','Roboto','Lato','Montserrat','Nunito'] as $f)
                    <option value="{{ $f }}" {{ old('footer_font', $user->footer_font ?? '') == $f ? 'selected' : '' }}>{{ $f }}</option>
                @endforeach
            </select>
        </div>

        <!-- Logo Upload -->
        <div class="bg-gray-50 p-4 rounded-lg border border-dashed border-gray-300">
            <label class="block text-sm font-semibold text-gray-700 mb-2">Upload Site Logo</label>
            <input type="file" name="logo" accept="image/*" onchange="previewImage(event, 'logo-preview')" class="block w-full text-xs text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-xs file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
            <div class="mt-3 flex items-center gap-3">
                <span class="text-xs text-gray-400">Current / Preview:</span>
                <img id="logo-preview" src="{{ (!empty($user->logo)) ? asset('storage/' . $user->logo) : 'https://placehold.co/150x50?text=No+Logo' }}" class="h-10 object-contain border bg-white p-1 rounded">
            </div>
        </div>

        <!-- Favicon Upload -->
        <div class="bg-gray-50 p-4 rounded-lg border border-dashed border-gray-300">
            <label class="block text-sm font-semibold text-gray-700 mb-2">Upload Favicon (.png, .ico)</label>
            <input type="file" name="favicon" accept=".png,.ico,.jpg,.jpeg" onchange="previewImage(event, 'favicon-preview')" class="block w-full text-xs text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-xs file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
            <div class="mt-3 flex items-center gap-3">
                <span class="text-xs text-gray-400">Current / Preview:</span>
                <img id="favicon-preview" src="{{ (!empty($user->favicon)) ? asset('storage/' . $user->favicon) : 'https://placehold.co/32x32?text=Fav' }}" class="h-8 w-8 object-contain border bg-white p-1 rounded">
            </div>
        </div>

        <!-- About Me -->
        <div class="md:col-span-2">
            <label class="block text-sm font-semibold text-gray-700 mb-1">About Me Description</label>
            <textarea name="about_me" rows="3" class="w-full p-2 border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm">{{ old('about_me', $user->about_me ?? '') }}</textarea>
        </div>
    </div>
</section>

            <!-- SECTION 3: CONTACT & SOCIAL MEDIA SETTINGS -->
            <section id="social-section" class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                <div class="px-6 py-4 bg-slate-50 border-b border-gray-200 flex items-center gap-3">
                    <i class="fa-solid fa-share-nodes text-purple-600 text-lg"></i>
                    <h2 class="text-lg font-bold text-gray-800">3. Contact & Social Media Information</h2>
                </div>
                <div class="p-6 grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <label class="block text-xs font-semibold text-gray-700 mb-1"><i class="fa-solid fa-phone text-blue-500 mr-1"></i> Phone Number</label>
                        <input type="text" name="phone" value="{{ old('phone', $user->phone ?? '') }}" placeholder="+8801700000000" class="w-full border-gray-300 rounded-lg shadow-sm text-sm">
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-gray-700 mb-1"><i class="fa-solid fa-envelope text-red-500 mr-1"></i> Email Address</label>
                        <input type="email" name="email_address" value="{{ old('email_address', $user->email_address ?? '') }}" placeholder="info@example.com" class="w-full border-gray-300 rounded-lg shadow-sm text-sm">
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-gray-700 mb-1"><i class="fa-brands fa-whatsapp text-emerald-500 mr-1"></i> WhatsApp Link/Number</label>
                        <input type="text" name="whatsapp" value="{{ old('whatsapp', $user->whatsapp ?? '') }}" placeholder="https://wa.me/8801700000000" class="w-full border-gray-300 rounded-lg shadow-sm text-sm">
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-gray-700 mb-1"><i class="fa-brands fa-telegram text-sky-500 mr-1"></i> Telegram Link/Username</label>
                        <input type="text" name="telegram" value="{{ old('telegram', $user->telegram ?? '') }}" placeholder="https://t.me/username" class="w-full border-gray-300 rounded-lg shadow-sm text-sm">
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-gray-700 mb-1"><i class="fa-brands fa-facebook text-blue-600 mr-1"></i> Facebook URL</label>
                        <input type="url" name="facebook" value="{{ old('facebook', $user->facebook ?? '') }}" placeholder="https://facebook.com/profile" class="w-full border-gray-300 rounded-lg shadow-sm text-sm">
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-gray-700 mb-1"><i class="fa-brands fa-instagram text-pink-500 mr-1"></i> Instagram URL</label>
                        <input type="url" name="instagram" value="{{ old('instagram', $user->instagram ?? '') }}" placeholder="https://instagram.com/profile" class="w-full border-gray-300 rounded-lg shadow-sm text-sm">
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-gray-700 mb-1"><i class="fa-brands fa-linkedin text-blue-700 mr-1"></i> LinkedIn URL</label>
                        <input type="url" name="linkedin" value="{{ old('linkedin', $user->linkedin ?? '') }}" placeholder="https://linkedin.com/in/profile" class="w-full border-gray-300 rounded-lg shadow-sm text-sm">
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-gray-700 mb-1"><i class="fa-brands fa-youtube text-red-600 mr-1"></i> YouTube Channel URL</label>
                        <input type="url" name="youtube" value="{{ old('youtube', $user->youtube ?? '') }}" placeholder="https://youtube.com/@channel" class="w-full border-gray-300 rounded-lg shadow-sm text-sm">
                    </div>
                </div>

                <div class="px-6 py-4 bg-gray-50 border-t border-gray-200 text-right">
                    <button type="submit" class="px-6 py-2.5 bg-blue-600 text-white rounded-lg font-semibold text-sm hover:bg-blue-700 shadow transition inline-flex items-center gap-2">
                        <i class="fa-solid fa-floppy-disk"></i> Save Branding, Hero & Contact Settings
                    </button>
                </div>
            </section>
        </form>

        <!-- SECTION 4: SERVICES MANAGEMENT -->
        <section id="services-section" class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
            <div class="px-6 py-4 bg-slate-50 border-b border-gray-200 flex justify-between items-center">
                <div class="flex items-center gap-3">
                    <i class="fa-solid fa-briefcase text-blue-600 text-lg"></i>
                    <h2 class="text-lg font-bold text-gray-800">4. Services (Max 10)</h2>
                </div>
                <span class="text-xs font-bold px-3 py-1 bg-blue-100 text-blue-800 rounded-full">
                    {{ isset($user->services) ? $user->services->count() : 0 }} / 10 Added
                </span>
            </div>

            <div class="p-6 space-y-6">
                @if(!isset($user->services) || $user->services->count() < 10)
                    <form action="{{ route('dashboard.services.store') }}" method="POST" enctype="multipart/form-data" class="bg-slate-50 p-5 rounded-xl border border-gray-200 grid grid-cols-1 md:grid-cols-2 gap-4">
                        @csrf
                        <div>
                            <label class="block text-xs font-semibold text-gray-700 mb-1">Service Title *</label>
                            <input type="text" name="title" required class="w-full border-gray-300 rounded-lg shadow-sm text-sm">
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-gray-700 mb-1">Button Text</label>
                            <input type="text" name="button_text" placeholder="e.g. Book Service" class="w-full border-gray-300 rounded-lg shadow-sm text-sm">
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-gray-700 mb-1">Button Redirect URL</label>
                            <input type="url" name="button_url" placeholder="https://..." class="w-full border-gray-300 rounded-lg shadow-sm text-sm">
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-gray-700 mb-1">Service Image</label>
                            <input type="file" name="image" accept="image/*" onchange="previewImage(event, 'service-preview')" class="block w-full text-xs text-gray-500 file:mr-2 file:py-1.5 file:px-3 file:rounded-md file:border-0 file:bg-blue-50 file:text-blue-700">
                            <img id="service-preview" class="h-12 mt-2 hidden rounded border">
                        </div>
                        <div class="md:col-span-2">
                            <label class="block text-xs font-semibold text-gray-700 mb-1">Service Description *</label>
                            <textarea name="description" rows="2" required class="w-full p-2 border-gray-300 rounded-lg shadow-sm text-sm"></textarea>
                        </div>
                        <div class="md:col-span-2 text-right">
                            <button type="submit" class="px-5 py-2 bg-blue-600 text-white rounded-lg text-sm font-semibold hover:bg-blue-700">
                                <i class="fa-solid fa-plus mr-1"></i> Add Service
                            </button>
                        </div>
                    </form>
                @else
                    <div class="p-3 bg-amber-50 text-amber-800 text-xs rounded-lg border border-amber-200 flex items-center gap-2">
                        <i class="fa-solid fa-triangle-exclamation text-amber-600"></i>
                        <span>You have reached the maximum limit of 10 services. Delete existing ones to add new services.</span>
                    </div>
                @endif

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    @forelse(($user->services ?? []) as $service)
                        <div class="border rounded-lg overflow-hidden bg-white shadow-xs flex flex-col justify-between">
                            <div>
                                <img src="{{ (!empty($service->image)) ? asset('storage/' . $service->image) : 'https://placehold.co/400x200?text=Service' }}" class="h-32 w-full object-cover">
                                <div class="p-3">
                                    <h4 class="font-bold text-gray-800 text-sm mb-1">{{ $service->title }}</h4>
                                    <p class="text-xs text-gray-600 leading-snug">{{ Str::limit($service->description, 70) }}</p>
                                </div>
                            </div>
                            <div class="p-3 bg-slate-50 border-t flex justify-end gap-2">
                                <a href="{{ route('dashboard.services.edit', $service->id) }}" class="px-2 py-1 bg-amber-500 text-white rounded text-xs font-semibold hover:bg-amber-600">
                                    <i class="fa-solid fa-pen-to-square"></i> Edit
                                </a>
                                <form action="{{ route('dashboard.services.destroy', $service->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this service?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="px-2 py-1 bg-rose-600 text-white rounded text-xs font-semibold hover:bg-rose-700">
                                        <i class="fa-solid fa-trash"></i> Delete
                                    </button>
                                </form>
                            </div>
                        </div>
                    @empty
                        <p class="text-xs text-gray-500 col-span-3 text-center py-4">No services added yet.</p>
                    @endforelse
                </div>
            </div>
        </section>

        <!-- SECTION 5: FAVOURITES -->
        <section id="favourites-section" class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
            <div class="px-6 py-4 bg-slate-50 border-b border-gray-200 flex items-center gap-3">
                <i class="fa-solid fa-heart text-rose-500 text-lg"></i>
                <h2 class="text-lg font-bold text-gray-800">5. Favourite Categories & Items</h2>
            </div>
            
            <div class="p-6 space-y-6">
                <form action="{{ route('dashboard.favourites.store') }}" method="POST" class="bg-slate-50 p-5 rounded-xl border border-gray-200 grid grid-cols-1 md:grid-cols-2 gap-4">
                    @csrf
                    <div>
                        <label class="block text-xs font-semibold text-gray-700 mb-1">Category Title</label>
                        <input type="text" name="category" placeholder="e.g. Favorite Colors" required class="w-full border-gray-300 rounded-lg shadow-sm text-sm">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-gray-700 mb-1">Items List</label>
                        <input type="text" name="items" placeholder="e.g. Navy Blue · Black · Emerald" required class="w-full border-gray-300 rounded-lg shadow-sm text-sm">
                    </div>
                    <div class="md:col-span-2 text-right">
                        <button type="submit" class="px-5 py-2 bg-rose-600 text-white rounded-lg text-sm font-semibold hover:bg-rose-700">
                            <i class="fa-solid fa-plus mr-1"></i> Add Category
                        </button>
                    </div>
                </form>

                <div class="divide-y border rounded-lg overflow-hidden">
                    @forelse(($user->favourites ?? []) as $fav)
                        <div class="p-3 bg-white flex justify-between items-center text-sm">
                            <div class="flex items-center gap-3">
                                <span class="font-bold text-gray-800">{{ $fav->category }}</span>
                                <span class="text-gray-600 bg-gray-100 px-3 py-1 rounded-full text-xs">{{ $fav->items }}</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <form action="{{ route('dashboard.favourites.destroy', $fav->id) }}" method="POST" onsubmit="return confirm('Delete this category?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-rose-600 hover:text-rose-800 text-xs px-2 py-1 rounded">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    @empty
                        <p class="text-xs text-gray-500 text-center py-4">No favourite categories added yet.</p>
                    @endforelse
                </div>
            </div>
        </section>

        <!-- SECTION 6: TOURS & EVENTS -->
        <section id="tours-section" class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
            <div class="px-6 py-4 bg-slate-50 border-b border-gray-200 flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <i class="fa-solid fa-plane-departure text-emerald-600 text-lg"></i>
                    <h2 class="text-lg font-bold text-gray-800">6. Tours & Package Manager</h2>
                </div>
                <span class="text-xs font-bold px-3 py-1 bg-emerald-100 text-emerald-800 rounded-full">
                    {{ isset($user->tours) ? $user->tours->count() : 0 }} Packages
                </span>
            </div>

            <div class="p-6 space-y-6">
                <!-- Tour Creation Form -->
                <form action="{{ route('dashboard.tours.store') }}" method="POST" enctype="multipart/form-data" class="bg-slate-50 p-5 rounded-xl border border-gray-200 grid grid-cols-1 md:grid-cols-2 gap-4">
                    @csrf
                    <div>
                        <label class="block text-xs font-semibold text-gray-700 mb-1">Tour Title *</label>
                        <input type="text" name="title" required class="w-full border-gray-300 rounded-lg shadow-sm text-sm">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-gray-700 mb-1">Subtitle / Tagline</label>
                        <input type="text" name="sub_title" class="w-full border-gray-300 rounded-lg shadow-sm text-sm">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-gray-700 mb-1">Duration *</label>
                        <input type="text" name="duration" placeholder="e.g. 5 Days / 4 Nights" required class="w-full border-gray-300 rounded-lg shadow-sm text-sm">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-gray-700 mb-1">Price ($) *</label>
                        <input type="number" name="price" step="0.01" required class="w-full border-gray-300 rounded-lg shadow-sm text-sm">
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-xs font-semibold text-gray-700 mb-1">Cover Image</label>
                        <input type="file" name="image" accept="image/*" onchange="previewImage(event, 'tour-preview')" class="block w-full text-xs text-gray-500 file:mr-2 file:py-1.5 file:px-3 file:rounded-md file:border-0 file:bg-emerald-50 file:text-emerald-700">
                        <img id="tour-preview" class="h-16 mt-2 hidden rounded border">
                    </div>

                    <!-- Dynamic Sub Highlights Row Builder -->
                    <div class="md:col-span-2 bg-white p-4 rounded-lg border border-gray-200">
                        <div class="flex justify-between items-center mb-3">
                            <label class="block text-xs font-bold text-gray-700">Tour Highlights (Sub Items)</label>
                            <button type="button" onclick="addHighlightRow()" class="text-xs text-blue-600 font-semibold hover:underline flex items-center gap-1">
                                <i class="fa-solid fa-plus"></i> Add More Row
                            </button>
                        </div>
                        
                        <div id="highlights-container" class="space-y-2">
                            <div class="grid grid-cols-12 gap-2 highlight-row">
                                <input type="text" name="hl_title[]" placeholder="Title" class="col-span-5 text-xs border-gray-300 rounded-md">
                                <input type="text" name="hl_duration[]" placeholder="Duration" class="col-span-3 text-xs border-gray-300 rounded-md">
                                <input type="number" name="hl_price[]" placeholder="Price ($)" step="0.01" class="col-span-3 text-xs border-gray-300 rounded-md">
                                <button type="button" onclick="removeHighlightRow(this)" class="col-span-1 text-red-500 hover:text-red-700 text-xs text-center flex items-center justify-center">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="md:col-span-2 text-right">
                        <button type="submit" class="px-5 py-2 bg-emerald-600 text-white rounded-lg text-sm font-semibold hover:bg-emerald-700">
                            <i class="fa-solid fa-floppy-disk mr-1"></i> Save Tour Package
                        </button>
                    </div>
                </form>

                <!-- Tour List Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 pt-4 border-t border-gray-200">
                    @forelse(($user->tours ?? []) as $tour)
                        <div class="border rounded-xl overflow-hidden bg-white shadow-xs flex flex-col justify-between border-gray-200">
                            <div>
                                <div class="relative">
                                    <img src="{{ (!empty($tour->image)) ? asset('storage/' . $tour->image) : 'https://placehold.co/500x250?text=Tour+Package' }}" class="h-40 w-full object-cover">
                                    <span class="absolute top-2 right-2 bg-emerald-600 text-white text-xs font-bold px-2.5 py-1 rounded-md shadow">
                                        ${{ number_format($tour->price, 2) }}
                                    </span>
                                </div>
                                <div class="p-4">
                                    <h4 class="font-bold text-gray-800 text-base mb-1">{{ $tour->title }}</h4>
                                    @if(!empty($tour->sub_title))
                                        <p class="text-xs text-gray-500 mb-2">{{ $tour->sub_title }}</p>
                                    @endif
                                    <div class="flex items-center gap-2 text-xs text-emerald-700 font-medium mb-3">
                                        <i class="fa-regular fa-clock"></i>
                                        <span>{{ $tour->duration }}</span>
                                    </div>

                                    @if(!empty($tour->highlights))
                                        <div class="mt-3 pt-3 border-t border-gray-100">
                                            <p class="text-xs font-semibold text-gray-700 mb-2">Highlights:</p>
                                            <ul class="space-y-1">
                                                @forelse($tour->highlights as $hl)
                                                    <li class="text-xs text-gray-600 flex justify-between">
                                                        <span>• {{ is_array($hl) ? ($hl['title'] ?? '') : ($hl->title ?? '') }} ({{ is_array($hl) ? ($hl['duration'] ?? '') : ($hl->duration ?? '') }})</span>
                                                        <span class="font-semibold text-gray-800">${{ is_array($hl) ? number_format($hl['price'] ?? 0, 2) : number_format($hl->price ?? 0, 2) }}</span>
                                                    </li>
                                                @empty
                                                    <li class="text-xs text-gray-400">No highlights added</li>
                                                @endforelse
                                            </ul>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="px-4 py-3 bg-slate-50 border-t border-gray-100 flex justify-end gap-2">
                                <a href="{{ route('dashboard.tours.edit', $tour->id) }}" class="px-3 py-1.5 bg-amber-500 text-white rounded-lg text-xs font-semibold hover:bg-amber-600 transition flex items-center gap-1">
                                    <i class="fa-solid fa-pen-to-square"></i> Edit
                                </a>
                                <form action="{{ route('dashboard.tours.destroy', $tour->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this tour?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="px-3 py-1.5 bg-rose-600 text-white rounded-lg text-xs font-semibold hover:bg-rose-700 transition flex items-center gap-1">
                                        <i class="fa-solid fa-trash"></i> Delete
                                    </button>
                                </form>
                            </div>
                        </div>
                    @empty
                        <p class="text-xs text-gray-500 col-span-2 text-center py-6">No tour packages added yet.</p>
                    @endforelse
                </div>
            </div>
        </section>

        <!-- SECTION 7: GALLERY BULK UPLOAD + PREVIEW -->
        <section id="gallery-section" class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
            <div class="px-6 py-4 bg-slate-50 border-b border-gray-200 flex items-center gap-3">
                <i class="fa-solid fa-images text-indigo-600 text-lg"></i>
                <h2 class="text-lg font-bold text-gray-800">7. Multi-Image Photo Gallery</h2>
            </div>

            <div class="p-6 space-y-6">
                <form action="{{ route('dashboard.gallery.store') }}" method="POST" enctype="multipart/form-data" class="bg-slate-50 p-5 rounded-xl border border-gray-200">
                    @csrf
                    <label class="block text-xs font-semibold text-gray-700 mb-2">Select Images (Multiple allowed)</label>
                    <input type="file" name="images[]" multiple accept="image/*" required onchange="previewMultipleImages(event)" class="block w-full text-xs text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:bg-indigo-50 file:text-indigo-700">

                    <!-- Live Instant Preview Container -->
                    <div id="gallery-multi-preview" class="grid grid-cols-2 md:grid-cols-6 gap-2 mt-4"></div>

                    <div class="text-right mt-4">
                        <button type="submit" class="px-5 py-2 bg-indigo-600 text-white rounded-lg text-sm font-semibold hover:bg-indigo-700">
                            <i class="fa-solid fa-upload mr-1"></i> Upload Gallery Images
                        </button>
                    </div>
                </form>

                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-6 gap-3">
                    @forelse(($user->galleries ?? []) as $gallery)
                        <div class="relative group rounded-lg overflow-hidden border bg-gray-100 shadow-xs">
                            <img src="{{ asset('storage/' . $gallery->image_path) }}" class="h-24 w-full object-cover">
                            <form action="{{ route('dashboard.gallery.destroy', $gallery->id) }}" method="POST" onsubmit="return confirm('Delete image?');" class="absolute top-1 right-1 opacity-0 group-hover:opacity-100 transition">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-rose-600 text-white p-1 rounded-full text-xs hover:bg-rose-700 shadow">
                                    <i class="fa-solid fa-xmark px-1"></i>
                                </button>
                            </form>
                        </div>
                    @empty
                        <p class="text-xs text-gray-500 col-span-6 text-center py-4">No gallery images uploaded yet.</p>
                    @endforelse
                </div>
            </div>
        </section>

    </div>

    <!-- JavaScript Controls -->
    <script>
        function previewImage(event, previewId) {
            const input = event.target;
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const img = document.getElementById(previewId);
                    img.src = e.target.result;
                    img.classList.remove('hidden');
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        function previewMultipleImages(event) {
            const previewContainer = document.getElementById('gallery-multi-preview');
            previewContainer.innerHTML = '';
            const files = event.target.files;

            if (files) {
                Array.from(files).forEach(file => {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        const img = document.createElement('img');
                        img.src = e.target.result;
                        img.className = 'h-20 w-full object-cover rounded border border-indigo-200 shadow-xs';
                        previewContainer.appendChild(img);
                    }
                    reader.readAsDataURL(file);
                });
            }
        }

        function addHighlightRow() {
            const container = document.getElementById('highlights-container');
            const row = document.createElement('div');
            row.className = 'grid grid-cols-12 gap-2 highlight-row';
            row.innerHTML = `
                <input type="text" name="hl_title[]" placeholder="Title" class="col-span-5 text-xs border-gray-300 rounded-md">
                <input type="text" name="hl_duration[]" placeholder="Duration" class="col-span-3 text-xs border-gray-300 rounded-md">
                <input type="number" name="hl_price[]" placeholder="Price ($)" step="0.01" class="col-span-3 text-xs border-gray-300 rounded-md">
                <button type="button" onclick="removeHighlightRow(this)" class="col-span-1 text-red-500 hover:text-red-700 text-xs text-center flex items-center justify-center">
                    <i class="fa-solid fa-trash"></i>
                </button>
            `;
            container.appendChild(row);
        }

        function removeHighlightRow(btn) {
            const rows = document.querySelectorAll('.highlight-row');
            if(rows.length > 1) {
                btn.closest('.highlight-row').remove();
            } else {
                alert('At least one highlight row should remain!');
            }
        }
    </script>
@endsection