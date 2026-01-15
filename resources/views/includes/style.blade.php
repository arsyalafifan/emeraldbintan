<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        :root {
            --primary-color: #4e73df;
            --secondary-color: #224abe;
            --accent-yellow: #f6c23e;
            --text-dark: #2c3e50;
            --bg-light: #f8f9fc;
        }

        body { font-family: 'Poppins', sans-serif; color: var(--text-dark); overflow-x: hidden; }

        /* --- Utilities & Buttons --- */
        .text-primary-custom { color: var(--primary-color) !important; }
        .bg-primary-custom { background-color: var(--primary-color) !important; }
        
        .btn-primary-custom {
            background-color: var(--primary-color);
            border: 2px solid var(--primary-color);
            color: white;
            padding: 10px 30px;
            border-radius: 50px;
            font-weight: 600;
            transition: all 0.3s;
        }
        
        .btn-primary-custom:hover {
            background-color: transparent;
            color: var(--primary-color);
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(78, 115, 223, 0.3);
        }

        .section-padding { padding: 80px 0; }
        .section-title { margin-bottom: 50px; position: relative; }
        .section-title h2 { font-weight: 800; color: var(--text-dark); }
        .section-title-line::after {
            content: ''; display: block; width: 60px; height: 4px;
            background: var(--primary-color); margin: 15px auto 0; border-radius: 2px;
        }

        /* --- Navbar --- */
        .navbar { background: white; box-shadow: 0 2px 15px rgba(0,0,0,0.05); padding: 15px 0; }
        .navbar-brand { font-weight: 800; color: #D2BF70 !important; font-size: 1.5rem; }
        .nav-link { font-weight: 500; margin-left: 15px; color: var(--text-dark); transition: 0.3s; }
        .nav-link:hover, .nav-link.active { color: var(--primary-color); }

        .language-switcher {
            gap: 8px;
        }

        .lang-item {
            display: flex;
            align-items: center;
            gap: 6px;
            padding: 6px 12px;
            border-radius: 20px;
            font-weight: 600;
            font-size: 0.85rem;
            color: #555;
            background: #f8f9fc;
            border: 1px solid #ddd;
            text-decoration: none;
            transition: all 0.2s ease;
        }

        .lang-item img {
            width: 18px;
            height: auto;
        }

        .lang-item.active,
        .lang-item:hover {
            background-color: #4e73df;
            color: #fff;
            border-color: #4e73df;
        }

        /* --- Hero Section --- */
        .hero-section {
            background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.3)), url('https://images.unsplash.com/photo-1589394815804-964ed0be2eb5?ixlib=rb-1.2.1&auto=format&fit=crop&w=1950&q=80');
            background-size: cover;
            background-position: center;
            height: 85vh;
            display: flex;
            align-items: center;
            color: white;
            position: relative;
        }
        .hero-content h1 { font-size: 3.5rem; font-weight: 800; margin-bottom: 20px; }
        .scroll-down {
            position: absolute; bottom: 30px; left: 50%; transform: translateX(-50%);
            animation: bounce 2s infinite; color: white; opacity: 0.8;
        }
        @keyframes bounce { 0%, 20%, 50%, 80%, 100% {transform: translateX(-50%) translateY(0);} 40% {transform: translateX(-50%) translateY(-20px);} 60% {transform: translateX(-50%) translateY(-10px);} }

        .bg-image-overlay-paket {
            position: relative;
            background-image: url('https://kabarsdgs.com/wp-content/uploads/2025/04/pantai-trikora-profile1695024664.jpg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }

        /* overlay agar teks tetap terbaca */
        .bg-image-overlay-paket::before {
            content: "";
            position: absolute;
            inset: 0;
            background: rgba(255, 255, 255, 0.70); /* PUTIH transparan */
            z-index: 0;
        }

        /* pastikan konten di atas overlay */
        .bg-image-overlay-paket > .container {
            position: relative;
            z-index: 1;
        }

        .bg-image-overlay-whyus {
            position: relative;
            background-image: url('https://rentalmobilbatam212.com/wp-content/uploads/2025/01/desa-wisata-pegudang-bintan.jpg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }

        /* overlay agar teks tetap terbaca */
        .bg-image-overlay-whyus::before {
            content: "";
            position: absolute;
            inset: 0;
            background: rgba(255, 255, 255, 0.85); /* PUTIH transparan */
            z-index: 0;
        } 
        /* pastikan konten di atas overlay */
        .bg-image-overlay-whyus > .container {
            position: relative;
            z-index: 1;
        }
        /* --- PACKAGES STYLING (THE HIGHLIGHT) --- */
        .nav-pills .nav-link {
            color: #555; background: white; border: 1px solid #eee; margin: 0 5px;
            border-radius: 50px; padding: 10px 25px; font-weight: 600;
        }
        .nav-pills .nav-link.active {
            background-color: var(--primary-color); color: white; border-color: var(--primary-color);
            box-shadow: 0 5px 15px rgba(78, 115, 223, 0.3);
        }

        /* Featured Deal Card (Horizontal) */
        .featured-deal {
            background: white; border-radius: 20px; overflow: hidden;
            box-shadow: 0 15px 40px rgba(78, 115, 223, 0.1); margin-bottom: 60px;
            border: 2px solid var(--primary-color);
        }
        .featured-img { width: 100%; height: 100%; min-height: 350px; object-fit: cover; }
        
        /* Standard Package Card */
        .package-card {
            border: none; border-radius: 15px; background: white;
            box-shadow: 0 5px 20px rgba(0,0,0,0.05); transition: all 0.3s;
            height: 100%; display: flex; flex-direction: column; overflow: hidden;
        }
        .package-card:hover { transform: translateY(-10px); box-shadow: 0 15px 30px rgba(0,0,0,0.1); }
        
        .package-thumb { position: relative; height: 220px; overflow: hidden; }
        .package-thumb img { width: 100%; height: 100%; object-fit: cover; transition: transform 0.5s; }
        .package-card:hover .package-thumb img { transform: scale(1.1); }
        
        .ribbon {
            position: absolute; top: 15px; right: -30px; width: 120px;
            background: var(--accent-yellow); color: #333; text-align: center;
            font-size: 0.75rem; font-weight: 800; padding: 5px 0;
            transform: rotate(45deg); z-index: 2; box-shadow: 0 2px 5px rgba(0,0,0,0.2);
        }
        .ribbon.blue { background: var(--primary-color); color: white; }

        .package-body { padding: 25px; flex-grow: 1; display: flex; flex-direction: column; }
        .detail-content { padding: 20px; background: #f8f9fc; border-top: 1px solid #eee; }
        .facility-icons { color: #888; margin-bottom: 20px; font-size: 0.9rem; display: flex; gap: 10px; }
        .facility-icons i { color: var(--primary-color); }
        
        .price-final { font-size: 1.3rem; font-weight: 800; color: var(--primary-color); }

        /* --- Other Sections Styling --- */
        .feature-box {
            padding: 30px; background: white; border-radius: 12px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.05); transition: 0.3s; height: 100%;
        }
        .feature-box:hover { transform: translateY(-5px); border-bottom: 3px solid var(--primary-color); }
        .feature-icon { font-size: 2.5rem; color: var(--primary-color); margin-bottom: 20px; }

        .gallery-item { border-radius: 12px; overflow: hidden; height: 250px; position: relative; }
        .gallery-item img { width: 100%; height: 100%; object-fit: cover; transition: 0.5s; }
        .gallery-item:hover img { transform: scale(1.1); }

        /* --- Footer --- */
        footer { background: #1a2530; color: #adb5bd; padding: 70px 0 30px; }
        .footer-title { color: white; font-weight: 700; margin-bottom: 25px; }
        .footer-links a { color: #adb5bd; text-decoration: none; transition: 0.3s; }
        .footer-links a:hover { color: var(--primary-color); padding-left: 5px; }

    </style>