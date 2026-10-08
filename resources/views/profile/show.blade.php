<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $user->name }} - Profile</title>

    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Dynamic Favicon -->
    @if($user->favicon)
        <link rel="icon" href="{{ asset('storage/' . $user->favicon) }}">
    @endif

    <!-- Dynamic Google Fonts -->
    @php
        $siteFont   = $user->site_font ?? 'inherit';
        $navbarFont = $user->navbar_font ?? 'inherit';
        $footerFont = $user->footer_font ?? 'inherit';

        $googleFonts = collect([$siteFont, $navbarFont, $footerFont])
            ->filter(fn($f) => $f && $f !== 'inherit' && $f !== 'Georgia')
            ->unique()
            ->values();

        $fontQuery = $googleFonts
            ->map(fn($f) => 'family=' . str_replace(' ', '+', $f) . ':wght@300;400;600;700')
            ->implode('&');
    @endphp

    @if($fontQuery)
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?{{ $fontQuery }}&display=swap" rel="stylesheet">
    @endif

    <style>
        :root {
            --primary-color: {{ $user->theme_color ?? '#2563eb' }};
            --navbar-bg: {{ $user->navbar_bg ?? '#ffffff' }};
            --navbar-text-color: {{ $user->navbar_text_color ?? '#334155' }};
            --footer-bg: {{ $user->footer_bg ?? '#0f172a' }};
            --footer-text-color: {{ $user->footer_text_color ?? '#ffffff' }};
            --site-font: {!! $siteFont !== 'inherit' ? "'{$siteFont}', sans-serif" : "'Segoe UI', Tahoma, Geneva, Verdana, sans-serif" !!};
            --navbar-font: {!! $navbarFont !== 'inherit' ? "'{$navbarFont}', sans-serif" : "var(--site-font)" !!};
            --footer-font: {!! $footerFont !== 'inherit' ? "'{$footerFont}', sans-serif" : "var(--site-font)" !!};
            --primary-hover: opacity(0.9);
        }

        * { box-sizing: border-box; margin: 0; padding: 0; }
        html { scroll-behavior: smooth; }
        body {
            font-family: var(--site-font);
            background: #f8fafc;
            color: #1e293b;
            line-height: 1.6;
        }
        .container { max-width: 1100px; margin: 0 auto; padding: 0 20px; }

        /* ============ NAVBAR ============ */
        .navbar {
            background: var(--navbar-bg);
            color: var(--navbar-text-color);
            font-family: var(--navbar-font);
            position: sticky;
            top: 0;
            z-index: 1000;
            box-shadow: 0 2px 10px rgba(0,0,0,0.08);
        }
        .nav-container { display: flex; justify-content: space-between; align-items: center; height: 70px; }
        .logo img { max-height: 45px; }
        .logo h2 {
            font-size: 22px;
            color: var(--primary-color);
            font-family: var(--navbar-font);
        }

        .nav-links { display: flex; gap: 25px; list-style: none; }
        .nav-links a {
            text-decoration: none;
            color: var(--navbar-text-color);
            font-weight: 600;
            font-size: 15px;
            font-family: var(--navbar-font);
            transition: color 0.3s;
        }
        .nav-links a:hover { color: var(--primary-color); }

        .mobile-menu-btn {
            display: none;
            font-size: 24px;
            background: none;
            border: none;
            cursor: pointer;
            color: var(--navbar-text-color);
        }

        /* ============ HERO ============ */
        .hero-section {
            position: relative;
            background: linear-gradient(rgba(0, 0, 0, 0.65), rgba(0, 0, 0, 0.65)),
                        url("{{ $user->hero_bg ? asset('storage/' . $user->hero_bg) : 'https://images.unsplash.com/photo-1507525428034-b723cf961d3e?w=1200' }}") no-repeat center center/cover;
            color: #fff;
            text-align: center;
            padding: 110px 20px;
            border-radius: 0 0 16px 16px;
        }
        .hero-title { font-size: 42px; font-weight: 700; margin-bottom: 10px; }
        .hero-slogan { font-size: 20px; font-weight: 300; font-style: italic; opacity: 0.9; margin-bottom: 15px; }
        .hero-bio { max-width: 650px; margin: 0 auto 25px auto; font-size: 16px; color: #e2e8f0; }
        .btn-book {
            display: inline-block;
            background: var(--primary-color);
            color: #fff;
            padding: 12px 30px;
            border-radius: 30px;
            text-decoration: none;
            font-weight: 600;
            font-size: 16px;
            transition: transform 0.2s, opacity 0.3s;
        }
        .btn-book:hover { transform: translateY(-2px); filter: var(--primary-hover); }

        /* ============ SECTION TITLES ============ */
        .section-title {
            font-family: serif;
            font-size: 32px;
            text-align: center;
            margin: 60px 0 30px 0;
            position: relative;
        }
        .section-title::after {
            content: '';
            display: block;
            width: 50px;
            height: 3px;
            background: var(--primary-color);
            margin: 8px auto 0;
            border-radius: 2px;
        }

        /* ============ SERVICES ============ */
        .services-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 20px; }
        .service-card { background: #fff; border-radius: 10px; overflow: hidden; box-shadow: 0 4px 6px rgba(0,0,0,0.05); transition: transform 0.3s; }
        .service-card:hover { transform: translateY(-5px); }
        .service-card img { width: 100%; height: 450px; object-fit: cover; }
        .service-content { padding: 20px; }
        .service-title { font-size: 18px; font-weight: 700; margin-bottom: 8px; color: #0f172a; }
        .service-desc { font-size: 14px; color: #64748b; margin-bottom: 15px; }
        .service-btn {
            display: inline-block;
            padding: 8px 16px;
            background: var(--primary-color);
            color: #fff;
            border-radius: 5px;
            text-decoration: none;
            font-size: 13px;
            font-weight: 600;
        }

        /* ============ ABOUT & FAVOURITES ============ */
        .about-fav-container {
            margin: 0 auto;
            background: #ffffff;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.03);
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 50px;
            align-items: start;
        }
        .about-side {
            border-right: 1px solid #f1f5f9;
            padding-right: 30px;
        }
        .about-title {
            font-family: serif;
            font-size: 32px;
            color: #2a2a2a;
            margin-bottom: 20px;
            font-weight: 300;
            letter-spacing: 0.5px;
            text-transform: lowercase;
        }
        .about-text {
            font-size: 15px;
            color: #475569;
            line-height: 1.8;
            margin-bottom: 15px;
        }
        .about-quote {
            font-style: italic;
            color: var(--primary-color, #2563eb);
            border-left: 3px solid var(--primary-color, #2563eb);
            padding-left: 12px;
            margin-top: 15px;
            font-size: 14px;
        }

        .fav-side { width: 100%; }
        .favourites-title {
            font-family: serif;
            font-size: 32px;
            color: #2a2a2a;
            margin-bottom: 20px;
            font-weight: 300;
            letter-spacing: 0.5px;
            text-transform: lowercase;
        }
        .favourite-row {
            display: flex;
            align-items: baseline;
            padding: 14px 0;
            border-bottom: 1px solid #eeeeee;
        }
        .favourite-row:last-child { border-bottom: none; }
        .favourite-category-title {
            width: 140px;
            font-family: serif;
            font-size: 18px;
            color: #2d2d2d;
            font-weight: 400;
            flex-shrink: 0;
        }
        .favourite-items-list {
            font-size: 15px;
            color: #4a4a4a;
            font-weight: 300;
            line-height: 1.6;
        }

        /* ============ TOURS ============ */
        .tour-card {
            display: flex;
            gap: 30px;
            background: #fff;
            padding: 25px;
            border-radius: 12px;
            margin-bottom: 30px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.05);
            align-items: center;
        }
        .tour-card:nth-child(odd) { flex-direction: row; }
        .tour-card:nth-child(even) { flex-direction: row-reverse; }
        .tour-info { flex: 1; }
        .tour-img { flex: 1; width: 100%; }
        .tour-img img { width: 100%; height: 280px; object-fit: cover; border-radius: 10px; }
        .sub-header { color: #94a3b8; font-size: 12px; letter-spacing: 1px; text-transform: uppercase; font-weight: 600; }
        .tour-title { font-family: serif; font-size: 26px; margin: 5px 0 10px; text-transform: uppercase; }
        .badge {
            background: #f1f5f9;
            padding: 6px 14px;
            border-radius: 15px;
            font-size: 13px;
            margin-right: 10px;
            font-weight: 600;
            display: inline-block;
            margin-bottom: 8px;
        }
        .highlight-box {
            background: #fafafa;
            padding: 12px;
            border-radius: 6px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 10px;
            border-left: 3px solid var(--primary-color);
        }

        /* ============ GALLERY ============ */
        .gallery-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(250px, 1fr)); gap: 15px; }
        .gallery-grid img { width: 100%; height: 220px; object-fit: cover; border-radius: 8px; transition: transform 0.3s; }
        .gallery-grid img:hover { transform: scale(1.02); }
        .btn-load {
            background: var(--primary-color);
            color: #fff;
            border: none;
            padding: 12px 30px;
            border-radius: 6px;
            cursor: pointer;
            display: block;
            margin: 30px auto 0;
            font-weight: 600;
        }

        /* ============ CONTACT ============ */
        .contact-section {
            background: #ffffff;
            border-radius: 12px;
            padding: 40px;
            margin-top: 60px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.04);
        }
        .contact-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 40px;
            align-items: start;
        }
        .contact-about h3, .contact-details h3 {
            font-size: 22px;
            color: #0f172a;
            margin-bottom: 15px;
            font-family: serif;
        }
        .contact-list { list-style: none; padding: 0; }
        .contact-list li {
            font-size: 15px;
            color: #334155;
            margin-bottom: 15px;
            display: flex;
            align-items: center;
        }
        .contact-list li i {
            width: 35px;
            height: 35px;
            background: #f1f5f9;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 12px;
            font-size: 15px;
            color: var(--primary-color);
        }
        .contact-list a {
            color: #334155;
            text-decoration: none;
            font-weight: 500;
            transition: color 0.2s;
        }
        .contact-list a:hover { color: var(--primary-color); }

        /* ============ FOOTER ============ */
        .site-footer {
            background: var(--footer-bg);
            color: var(--footer-text-color);
            font-family: var(--footer-font);
            margin-top: 60px;
            padding: 40px 0 20px;
            text-align: center;
        }
        .footer-content {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 20px;
        }
        .footer-text {
            font-size: 14px;
            color: var(--footer-text-color);
            opacity: 0.75;
            max-width: 500px;
        }
        .social-icons { display: flex; gap: 12px; }
        .social-icon-btn {
            width: 40px;
            height: 40px;
            background: rgba(255, 255, 255, 0.08);
            color: var(--footer-text-color);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            font-size: 16px;
            transition: background 0.3s, transform 0.2s;
        }
        .social-icon-btn:hover {
            transform: translateY(-3px);
            background: var(--primary-color);
        }
        .footer-bottom {
            margin-top: 25px;
            padding-top: 20px;
            border-top: 1px solid rgba(255, 255, 255, 0.08);
            font-size: 13px;
            color: var(--footer-text-color);
            opacity: 0.6;
            width: 100%;
        }

        /* ============ MOBILE RESPONSIVE ============ */
        @media (max-width: 768px) {
            .mobile-menu-btn { display: block; }
            .nav-links {
                display: none;
                flex-direction: column;
                position: absolute;
                top: 70px;
                left: 0;
                width: 100%;
                background: var(--navbar-bg);
                padding: 20px;
                box-shadow: 0 5px 10px rgba(0,0,0,0.1);
            }
            .nav-links.active { display: flex; }
            .nav-links a { color: var(--navbar-text-color); }

            .about-fav-container {
                grid-template-columns: 1fr;
                gap: 30px;
                padding: 25px;
            }
            .about-side {
                border-right: none;
                border-bottom: 1px solid #f1f5f9;
                padding-right: 0;
                padding-bottom: 25px;
            }
            .favourite-row {
                flex-direction: column;
                gap: 4px;
            }
            .favourite-category-title {
                width: 100%;
                font-weight: 600;
            }

            .tour-card,
            .tour-card:nth-child(odd),
            .tour-card:nth-child(even) {
                flex-direction: column !important;
            }
            .tour-img { order: 1; }
            .tour-info { order: 2; }
            .tour-img img { width: 100%; height: 220px; }

            .hero-title { font-size: 30px; }

            .contact-grid { grid-template-columns: 1fr; gap: 25px; }
            .contact-section { padding: 25px; }
        }
    </style>
</head>
<body>

    <!-- ============ NAVBAR ============ -->
    <nav class="navbar">
        <div class="container nav-container">
            <div class="logo">
                @if(!empty($user->logo))
                    <img src="{{ asset('storage/' . $user->logo) }}" alt="{{ $user->name }}">
                @else
                    <h2>{{ $user->name }}</h2>
                @endif
            </div>

            <button class="mobile-menu-btn" onclick="toggleMenu()">
                <i class="fa-solid fa-bars"></i>
            </button>

            <ul class="nav-links" id="navLinks">
                @if(isset($user->services) && $user->services->count() > 0)
                    <li><a href="#services" onclick="closeMenu()">Services</a></li>
                @endif
                @if(isset($user->favourites) && $user->favourites->count() > 0)
                    <li><a href="#favourites" onclick="closeMenu()">Favourites</a></li>
                @endif
                @if(isset($user->tours) && $user->tours->count() > 0)
                    <li><a href="#tours" onclick="closeMenu()">Tours</a></li>
                @endif
                @if(isset($user->galleries) && $user->galleries->count() > 0)
                    <li><a href="#gallery" onclick="closeMenu()">Gallery</a></li>
                @endif
                <li><a href="#contact" onclick="closeMenu()">Contact</a></li>
            </ul>
        </div>
    </nav>

    <!-- ============ HERO ============ -->
    <section class="hero-section">
        <div class="container">
            <h1 class="hero-title">
                {{ $user->hero_title ?? "Welcome to " . $user->name . "'s World" }}
            </h1>

            @if(!empty($user->hero_subtitle))
                <p class="hero-slogan">"{{ $user->hero_subtitle }}"</p>
            @elseif(!empty($user->slogan))
                <p class="hero-slogan">"{{ $user->slogan }}"</p>
            @endif

            <a href="{{ $user->hero_button_url ?? '#contact' }}" class="btn-book">
                {{ $user->hero_button_text ?? 'Book Me' }}
            </a>
        </div>
    </section>

    <div class="container">

        <!-- ============ SERVICES ============ -->
        @if(isset($user->services) && $user->services->count() > 0)
            <section id="services">
                <h2 class="section-title">Services</h2>
                <div class="services-grid">
                    @foreach($user->services->take(10) as $service)
                        <div class="service-card">
                            <img src="{{ $service->image ? asset('storage/' . $service->image) : 'https://placehold.co/400x250?text=Service' }}" alt="{{ $service->title }}">
                            <div class="service-content">
                                <h3 class="service-title">{{ $service->title }}</h3>
                                <p class="service-desc">{{ $service->description }}</p>

                                @if($service->button_url)
                                    @php
                                        $url = $service->button_url;
                                        if($url === '/contact' || $url === 'contact') {
                                            $url = '#contact';
                                        } elseif (!str_starts_with($url, 'http://') && !str_starts_with($url, 'https://') && !str_starts_with($url, '#')) {
                                            $url = 'https://' . $url;
                                        }
                                    @endphp
                                    <a href="{{ $url }}" class="service-btn">
                                        {{ $service->button_text ?? 'Learn More' }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            </section>
        @endif

        <!-- ============ ABOUT & FAVOURITES ============ -->
        <section id="favourites" style="margin-top: 60px;">
            <div class="about-fav-container">
                <div class="about-side">
                    <h2 class="about-title">About {{ strtolower($user->name) }}</h2>
                    <p class="about-text">
                        {{ $user->about_me ?? 'Welcome to my official profile! Here you can find my preferred lifestyle items, services, and featured tour packages. Feel free to explore and connect with me.' }}
                    </p>
                    @if(!empty($user->slogan))
                        <blockquote class="about-quote">
                            "{{ $user->slogan }}"
                        </blockquote>
                    @endif
                </div>

                @if(isset($user->favourites) && $user->favourites->count() > 0)
                    <div class="fav-side">
                        <h2 class="favourites-title">My Details</h2>

                        @foreach($user->favourites as $fav)
                            <div class="favourite-row">
                                <div class="favourite-category-title">{{ $fav->category }}</div>
                                <div class="favourite-items-list">
                                    @php
                                        $itemList = array_map('trim', preg_split('/[·,•|]+/', $fav->items));
                                        $itemList = array_filter($itemList);
                                    @endphp
                                    {{ implode(' · ', $itemList) }}
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </section>

        <!-- ============ TOURS ============ -->
        @if(isset($user->tours) && $user->tours->count() > 0)
            <section id="tours">
                <h2 class="section-title">Tour</h2>
                @foreach($user->tours as $tour)
                    <div class="tour-card">
                        <div class="tour-img">
                            <img src="{{ $tour->image ? asset('storage/' . $tour->image) : 'https://placehold.co/600x400?text=Tour+Image' }}" alt="{{ $tour->title }}">
                        </div>

                        <div class="tour-info">
                            <div class="sub-header">{{ $tour->sub_title }}</div>
                            <div class="tour-title">{{ $tour->title }}</div>

                            <div style="margin: 15px 0;">
                                @if($tour->start_date)
                                    <span class="badge"><i class="fa-regular fa-calendar"></i> {{ \Carbon\Carbon::parse($tour->start_date)->format('M d, Y') }}</span>
                                @endif
                                <span class="badge"><i class="fa-regular fa-clock"></i> {{ $tour->duration }}</span>
                                <span class="badge"><i class="fa-solid fa-tag"></i> ${{ $tour->price }}</span>
                            </div>

                            <p style="color: #64748b; font-size: 14px;">{{ $tour->description }}</p>

                            @if($tour->highlights)
                                <h4 style="margin-top: 20px; font-family: serif; font-size: 16px;">TOUR HIGHLIGHTS</h4>
                                @foreach($tour->highlights as $hl)
                                    <div class="highlight-box">
                                        <div>
                                            <strong>{{ is_array($hl) ? ($hl['title'] ?? '') : ($hl->title ?? '') }}</strong>
                                            <div style="color: #64748b; font-size: 13px;">${{ is_array($hl) ? ($hl['price'] ?? '') : ($hl->price ?? '') }}</div>
                                        </div>
                                        <span class="badge">{{ is_array($hl) ? ($hl['duration'] ?? '') : ($hl->duration ?? '') }}</span>
                                    </div>
                                @endforeach
                            @endif

                            <a href="#contact" class="btn-book" style="margin-top: 20px; padding: 8px 20px; font-size: 14px;">Book Now</a>
                        </div>
                    </div>
                @endforeach
            </section>
        @endif

        <!-- ============ GALLERY ============ -->
        <section id="gallery">
            <h2 class="section-title">Gallery</h2>
            <div class="gallery-grid" id="gallery-wrapper">
                @include('profile.partials.gallery_items', ['galleries' => $galleries])
            </div>

            @if(method_exists($galleries, 'hasMorePages') && $galleries->hasMorePages())
                <button id="load-more-btn" data-page="2" class="btn-load">Load More</button>
            @endif
        </section>

        <!-- ============ CONTACT ============ -->
        <section id="contact" class="contact-section">
            <h2 class="section-title" style="margin-top: 0;">Get In Touch</h2>
            <div class="contact-grid">
                <div class="contact-image-wrapper">
                    @php
                        $allGalleries = isset($galleries) ? $galleries : ($user->galleries ?? collect());

                        if (method_exists($allGalleries, 'getCollection')) {
                            $galleryItems = $allGalleries->getCollection();
                        } elseif (method_exists($allGalleries, 'items')) {
                            $galleryItems = collect($allGalleries->items());
                        } else {
                            $galleryItems = collect($allGalleries);
                        }

                        $randomItem = $galleryItems->count() > 0 ? $galleryItems->random() : null;

                        $imageSrc = null;
                        if ($randomItem) {
                            $path = $randomItem->image_path ?? $randomItem->image ?? null;
                            if ($path) {
                                $imageSrc = filter_var($path, FILTER_VALIDATE_URL)
                                            ? $path
                                            : asset('storage/' . $path);
                            }
                        }
                    @endphp

                    @if($imageSrc)
                        <img src="{{ $imageSrc }}"
                             alt="Gallery Image"
                             class="contact-vector-img"
                             style="border-radius: 12px; object-fit: cover; max-height: 320px; width: 100%;">
                    @else
                        <img src="https://img.magnific.com/free-vector/flat-design-illustration-customer-support_23-2148887720.jpg?semt=ais_hybrid&w=740&q=80"
                             alt="Contact Us Vector"
                             class="contact-vector-img"
                             style="border-radius: 12px; object-fit: cover; max-height: 320px; width: 100%;">
                    @endif
                </div>

                <div class="contact-details">
                    <h3>Contact Info</h3>
                    <ul class="contact-list">
                        @if(!empty($user->phone))
                            <li>
                                <i class="fa-solid fa-phone"></i>
                                <a href="tel:{{ $user->phone }}">{{ $user->phone }}</a>
                            </li>
                        @endif
                        @if(!empty($user->email_address))
                            <li>
                                <i class="fa-solid fa-envelope"></i>
                                <a href="mailto:{{ $user->email_address }}">{{ $user->email_address }}</a>
                            </li>
                        @endif
                        @if(!empty($user->whatsapp))
                            <li>
                                <i class="fa-brands fa-whatsapp"></i>
                                <a href="{{ $user->whatsapp }}" target="_blank">Chat on WhatsApp</a>
                            </li>
                        @endif
                        @if(!empty($user->telegram))
                            <li>
                                <i class="fa-brands fa-telegram"></i>
                                <a href="{{ $user->telegram }}" target="_blank">Message on Telegram</a>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </section>

    </div>

    <!-- ============ FOOTER ============ -->
    <footer class="site-footer">
        <div class="container footer-content">
            <p class="footer-text">
                Thank you for visiting! Connect with me on social media to stay updated with my latest tours and updates.
            </p>

            <div class="social-icons">
                @if(!empty($user->facebook))
                    <a href="{{ $user->facebook }}" target="_blank" class="social-icon-btn"><i class="fa-brands fa-facebook-f"></i></a>
                @endif
                @if(!empty($user->instagram))
                    <a href="{{ $user->instagram }}" target="_blank" class="social-icon-btn"><i class="fa-brands fa-instagram"></i></a>
                @endif
                @if(!empty($user->linkedin))
                    <a href="{{ $user->linkedin }}" target="_blank" class="social-icon-btn"><i class="fa-brands fa-linkedin-in"></i></a>
                @endif
                @if(!empty($user->youtube))
                    <a href="{{ $user->youtube }}" target="_blank" class="social-icon-btn"><i class="fa-brands fa-youtube"></i></a>
                @endif
            </div>

            <div class="footer-bottom">
                &copy; {{ date('Y') }} {{ $user->name }}. All rights reserved.
            </div>
        </div>
    </footer>

    <!-- ============ SCRIPTS ============ -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        function toggleMenu() {
            document.getElementById('navLinks').classList.toggle('active');
        }
        function closeMenu() {
            document.getElementById('navLinks').classList.remove('active');
        }

        $(document).on('click', '#load-more-btn', function() {
            let button = $(this);
            let page = button.data('page');
            let url = "{{ route('user.profile', $user->username) }}/gallery/load-more?page=" + page;

            $.ajax({
                url: url,
                type: "GET",
                beforeSend: function() {
                    button.text('Loading...');
                },
                success: function(data) {
                    if (data.trim() == "") {
                        button.remove();
                    } else {
                        $('#gallery-wrapper').append(data);
                        button.data('page', page + 1);
                        button.text('Load More');
                    }
                }
            });
        });
    </script>
</body>
</html>