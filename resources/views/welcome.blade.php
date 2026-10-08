<!DOCTYPE html>
<html lang="bn">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ServicePortfolio - Elite Partner Platform</title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background: #f8fafc; color: #1e293b; line-height: 1.6; }

        /* Navigation Header */
        .navbar {
            background: #ffffff;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 18px 8%;
            box-shadow: 0 4px 20px rgba(0,0,0,0.03);
            position: sticky;
            top: 0;
            z-index: 1000;
        }
        .navbar .logo { font-size: 24px; font-weight: 800; color: #1e40af; text-decoration: none; letter-spacing: -0.5px; }
        .navbar .logo span { color: #f59e0b; }

        .nav-links { display: flex; align-items: center; gap: 15px; }
        .nav-links a { text-decoration: none; font-size: 15px; font-weight: 600; padding: 10px 22px; border-radius: 8px; transition: all 0.3s ease; }

        .btn-login { color: #1e40af; border: 1.5px solid #1e40af; }
        .btn-login:hover { background: #eff6ff; }

        .btn-register { background: #1e40af; color: #ffffff; box-shadow: 0 4px 12px rgba(30, 64, 175, 0.25); }
        .btn-register:hover { background: #1e3a8a; transform: translateY(-1px); }

        .btn-dashboard { background: #0f172a; color: #ffffff; }
        .btn-profile { background: #10b981; color: #ffffff; }

        /* Hero Section */
        .hero {
            text-align: center;
            padding: 100px 20px 80px;
            background: radial-gradient(circle at top, #eff6ff 0%, #f8fafc 100%);
        }
        .badge {
            background: #fef3c7;
            color: #d97706;
            font-size: 13px;
            font-weight: 700;
            padding: 6px 16px;
            border-radius: 20px;
            text-transform: uppercase;
            letter-spacing: 1px;
            display: inline-block;
            margin-bottom: 20px;
            border: 1px solid #fde68a;
        }
        .hero h1 { font-size: 48px; margin-bottom: 20px; color: #0f172a; font-weight: 800; line-height: 1.2; }
        .hero p { font-size: 19px; color: #64748b; max-width: 680px; margin: 0 auto 35px; }

        /* Trust & Live Stats Bar */
        .stats-section {
            background: #ffffff;
            margin: -40px auto 60px;
            max-width: 1100px;
            border-radius: 16px;
            padding: 30px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.05);
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            text-align: center;
            border: 1px solid #e2e8f0;
        }
        .stat-item h3 { font-size: 32px; color: #1e40af; font-weight: 800; margin-bottom: 5px; }
        .stat-item p { font-size: 14px; color: #64748b; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px; }

        /* Partnership / Pricing Section */
        .partnership {
            max-width: 1100px;
            margin: 80px auto;
            padding: 0 20px;
        }
        .section-header { text-align: center; margin-bottom: 50px; }
        .section-header h2 { font-size: 36px; color: #0f172a; font-weight: 800; }
        .section-header p { color: #64748b; font-size: 17px; margin-top: 100px; }

        .partner-card {
            background: linear-gradient(145deg, #0f172a 0%, #1e293b 100%);
            color: #ffffff;
            border-radius: 24px;
            padding: 50px;
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 20px 40px rgba(15, 23, 42, 0.15);
            position: relative;
            overflow: hidden;
        }
        .partner-card::before {
            content: "EXCLUSIVE";
            position: absolute;
            top: 30px;
            right: -35px;
            background: #f59e0b;
            color: #000;
            font-size: 11px;
            font-weight: 800;
            padding: 6px 40px;
            transform: rotate(45deg);
        }
        .partner-info { flex: 1; min-width: 300px; padding-right: 40px; }
        .partner-info h3 { font-size: 28px; margin-bottom: 15px; color: #f8fafc; }
        .partner-info p { color: #94a3b8; font-size: 16px; margin-bottom: 25px; }
        
        .partner-features { list-style: none; margin-bottom: 20px; }
        .partner-features li { margin-bottom: 12px; color: #cbd5e1; display: flex; align-items: center; gap: 10px; }
        .partner-features li::before { content: "✓"; color: #10b981; font-weight: bold; }

        .partner-price {
            background: rgba(255, 255, 255, 0.05);
            padding: 40px;
            border-radius: 16px;
            border: 1px solid rgba(255, 255, 255, 0.1);
            text-align: center;
            min-width: 280px;
        }
        .price-amount { font-size: 54px; font-weight: 800; color: #ffffff; margin-bottom: 5px; }
        .price-type { font-size: 14px; color: #94a3b8; margin-bottom: 25px; text-transform: uppercase; }
        
        .btn-partner {
            background: #f59e0b;
            color: #0f172a;
            font-weight: 700;
            font-size: 16px;
            padding: 14px 30px;
            border-radius: 8px;
            text-decoration: none;
            display: inline-block;
            width: 100%;
            transition: all 0.3s;
        }
        .btn-partner:hover { background: #d97706; color: #ffffff; }

        /* Features Grid */
        .features-grid {
            max-width: 1100px;
            margin: 80px auto;
            padding: 0 20px;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 30px;
        }
        .feature-box {
            background: #ffffff;
            padding: 30px;
            border-radius: 16px;
            border: 1px solid #e2e8f0;
            transition: transform 0.3s;
        }
        .feature-box:hover { transform: translateY(-5px); }
        .feature-box h4 { font-size: 20px; margin-bottom: 10px; color: #0f172a; }
        .feature-box p { color: #64748b; font-size: 15px; }

        @media (max-width: 768px) {
            .hero h1 { font-size: 34px; }
            .partner-card { padding: 30px; }
            .partner-info { padding-right: 0; margin-bottom: 30px; }
        }
    </style>
</head>
<body>

    <!-- Header / Navbar Section -->
    <nav class="navbar">
        <a href="{{ url('/') }}" class="logo">Service<span>Portfolio</span></a>

        <div class="nav-links">
            @if (Route::has('login'))
                @auth
                    <a href="{{ url('/dashboard') }}" class="btn-dashboard">Dashboard</a>
                    <a href="{{ route('user.profile', auth()->user()->username) }}" class="btn-profile" target="_blank">My Profile Page</a>
                @else
                    <a href="{{ route('login') }}" class="btn-login">Login</a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="btn-register">Register</a>
                    @endif
                @endauth
            @endif
        </div>
    </nav>

    <!-- Hero / Main Landing Area -->
    <section class="hero">
        <span class="badge">Official Partnership Program</span>
        <h1>Scale Your Service Business<br>With Our Premium Platform</h1>
        <p>Build your dynamic profile page with custom branding, gallery, tour packages, and favorites backed by our global infrastructure.</p>
        
        @guest
            <a href="{{ route('register') }}" class="btn-register" style="padding: 14px 36px; font-size: 17px; text-decoration: none; display: inline-block;">Become a Partner</a>
        @endguest
    </section>

    <!-- Trust & Live Stats Section -->
    <section class="stats-section">
        <div class="stat-item">
            <h3>1,200+</h3>
            <p>Active Partners</p>
        </div>
        <div class="stat-item">
            <h3>50,000+</h3>
            <p>Daily Active Users</p>
        </div>
        <div class="stat-item">
            <h3>99.9%</h3>
            <p>Platform Uptime</p>
        </div>
        <div class="stat-item">
            <h3>$2.5M+</h3>
            <p>Partner Earnings</p>
        </div>
    </section>

    <!-- Partnership & Pricing Section -->
    <section class="partnership">
        <div class="section-header">
            <h2>Verified Partner Program</h2>
            <p style="margin-top: 10px;">Get full access to build, manage, and scale your service platform with complete authority.</p>
        </div>

        <div class="partner-card">
            <div class="partner-info">
                <h3>Official Service Partner</h3>
                <p>Join our elite network to get custom web integration, priority server resources, and direct customer management tools.</p>
                
                <ul class="partner-features">
                    <li>Full Custom Service Website Construction</li>
                    <li>Integrated Booking & Tour Package Manager</li>
                    <li>Dynamic Favorites & Gallery Showcase</li>
                    <li>24/7 Dedicated Technical & Business Support</li>
                    <li>Verified Business Partner Badge</li>
                </ul>
            </div>

            <div class="partner-price">
                <div class="price-amount">$500</div>
                <div class="price-type">One-Time Partnership Fee</div>
                
                @guest
                    <a href="{{ route('register') }}" class="btn-partner">Join Partnership</a>
                @else
                    <a href="{{ url('/dashboard') }}" class="btn-partner">Upgrade Account</a>
                @endguest
            </div>
        </div>
    </section>

    <!-- Core Features Grid -->
    <section class="features-grid">
        <div class="feature-box">
            <h4>Dynamic Portfolios</h4>
            <p>Showcase your services with modern layouts, media galleries, and interactive features.</p>
        </div>
        <div class="feature-box">
            <h4>High Daily Traffic</h4>
            <p>Tap into our 50,000+ daily visitors actively looking for verified service providers.</p>
        </div>
        <div class="feature-box">
            <h4>Custom Domain & Branding</h4>
            <p>Maintain your unique identity while leveraging our secure and trusted backend.</p>
        </div>
    </section>

</body>
</html>