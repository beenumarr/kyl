<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="../img/logo.png">
    <title>Mallam Zaki Fellowship - Katagum Youth League</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../style.css">
    <style>
        :root {
            /* Dark Theme */
            --bg-primary: #0c1f0c;
            --bg-secondary: #132713;
            --bg-glass: rgba(255, 255, 255, 0.03);
            --bg-glass-hover: rgba(255, 255, 255, 0.08);
            --text-primary: #ffffff;
            --text-secondary: #d1e7d1;
            --text-muted: #a3bfa3;
            

            
            /* Brand Colors */
            --primary-gradient: linear-gradient(135deg, #2e7d32, #1b5e20);
            --secondary-gradient: linear-gradient(135deg, #388e3c, #2e7d32);
            --fellowship-gradient: linear-gradient(135deg, #43a047, #388e3c);
            
            /* Glassmorphism */
            --glass-border: rgba(255, 255, 255, 0.18);
            --glass-shadow: 0 8px 32px rgba(31, 38, 135, 0.37);
            --glass-blur: blur(8px);
            
            /* Animations */
            --transition-smooth: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            --transition-bounce: all 0.6s cubic-bezier(0.68, -0.55, 0.265, 1.55);
        }



        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', 'Poppins', sans-serif;
            background: var(--bg-primary);
            color: var(--text-primary);
            line-height: 1.6;
            scroll-behavior: smooth;
            transition: var(--transition-smooth);
            overflow-x: hidden;
        }

        .container {
            width: 100%;
            max-width: 1400px;
            margin: 0 auto;
            padding: 0 20px;
        }



        /* Header */
        header {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            padding: 20px 0;
            z-index: 1000;
            background: var(--bg-glass);
            backdrop-filter: var(--glass-blur);
            border-bottom: 1px solid var(--glass-border);
            transition: var(--transition-smooth);
        }

        header.scrolled {
            padding: 15px 0;
            background: rgba(0, 0, 0, 0.9);
            backdrop-filter: blur(20px);
        }

        .header-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo img {
            height: 60px;
            filter: drop-shadow(0 4px 8px rgba(0, 0, 0, 0.3));
            transition: var(--transition-smooth);
            animation: float 6s ease-in-out infinite;
        }

        header.scrolled .logo img {
            height: 50px;
        }

        nav ul {
            display: flex;
            list-style: none;
            gap: 40px;
        }

        nav ul li a {
            color: var(--text-primary);
            text-decoration: none;
            font-weight: 500;
            font-size: 16px;
            position: relative;
            padding: 10px 0;
            transition: var(--transition-smooth);
        }

        nav ul li a:hover {
            color: #8b5cf6;
            transform: translateY(-2px);
        }

        nav ul li a::before {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 0;
            height: 3px;
            background: var(--fellowship-gradient);
            border-radius: 2px;
            transition: var(--transition-smooth);
        }

        nav ul li a:hover::before {
            width: 100%;
        }

        .mobile-menu-btn {
            display: none;
            background: var(--bg-glass);
            backdrop-filter: var(--glass-blur);
            border: 1px solid var(--glass-border);
            border-radius: 12px;
            color: var(--text-primary);
            font-size: 24px;
            padding: 12px;
            cursor: pointer;
            transition: var(--transition-smooth);
        }

        /* Hero Section */
        .program-hero {
            height: 90vh;
            min-height: 700px;
            background: 
                linear-gradient(45deg, rgba(12, 31, 12, 0.9), rgba(67, 160, 71, 0.7)),
                url('../fellowship/1.jpeg') center/cover no-repeat fixed;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            position: relative;
            overflow: hidden;
            margin-bottom: -1px;
        }

        .program-hero::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: radial-gradient(circle at 30% 70%, rgba(67, 160, 71, 0.4) 0%, transparent 50%),
                        radial-gradient(circle at 70% 30%, rgba(46, 125, 50, 0.3) 0%, transparent 50%);
            animation: gradientShift 8s ease-in-out infinite;
        }

        .hero-content {
            position: relative;
            z-index: 2;
            max-width: 800px;
            animation: slideInUp 1s ease-out;
        }

        .program-hero h1 {
            font-size: clamp(3rem, 6vw, 5rem);
            margin-bottom: 30px;
            background: linear-gradient(45deg, #ffffff, #43a047);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            animation: textGlow 3s ease-in-out infinite alternate;
        }

        .program-hero p {
            font-size: clamp(1.2rem, 2.5vw, 1.6rem);
            color: rgba(255, 255, 255, 0.9);
            margin-bottom: 30px;
            animation: slideInUp 1s ease-out 0.3s both;
        }

        .hero-btns {
            display: flex;
            gap: 20px;
            justify-content: center;
            animation: slideInUp 1s ease-out 0.6s both;
        }

        .btn {
            display: inline-block;
            padding: 15px 40px;
            border-radius: 50px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
            background: var(--fellowship-gradient);
            color: #ffffff;
        }

        .btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 20px rgba(67, 160, 71, 0.3);
        }

        .btn-outline {
            background: transparent;
            border: 2px solid #43a047;
            color: #ffffff;
        }

        .btn-outline:hover {
            background: var(--fellowship-gradient);
            border-color: transparent;
        }

        /* Program Content */
        .program-content {
            padding: 120px 0;
            background: var(--bg-secondary);
        }

        .program-section {
            margin-bottom: 80px;
            animation: fadeInUp 0.8s ease-out;
        }

        .program-section h2 {
            font-size: clamp(2rem, 4vw, 3rem);
            margin-bottom: 30px;
            background: var(--fellowship-gradient);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            position: relative;
        }

        .program-section h2::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 0;
            width: 60px;
            height: 4px;
            background: var(--fellowship-gradient);
            border-radius: 2px;
            animation: scaleIn 1s ease-out 0.5s both;
        }

        /* Program Stats */
        .program-stats {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 30px;
            margin: 80px 0;
        }

        .stat-card {
            background: var(--bg-glass);
            backdrop-filter: var(--glass-blur);
            border: 1px solid var(--glass-border);
            padding: 40px 30px;
            border-radius: 24px;
            text-align: center;
            transition: var(--transition-smooth);
            animation: fadeInUp 0.6s ease-out;
            position: relative;
            overflow: hidden;
        }

        .stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, rgba(139, 92, 246, 0.1), transparent);
            opacity: 0;
            transition: var(--transition-smooth);
        }

        .stat-card:hover::before {
            opacity: 1;
        }

        .stat-card:nth-child(2) { animation-delay: 0.2s; }
        .stat-card:nth-child(3) { animation-delay: 0.4s; }

        .stat-card:hover {
            transform: translateY(-10px) rotateY(5deg);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2);
        }

        .stat-number {
            font-size: 3.5rem;
            font-weight: 800;
            background: var(--fellowship-gradient);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 16px;
            animation: countUp 2s ease-out;
        }

        .stat-card p {
            color: var(--text-secondary);
            font-weight: 500;
            font-size: 1.1rem;
        }

        /* Timeline */
        .timeline {
            position: relative;
            max-width: 900px;
            margin: 60px auto;
            padding: 40px 0;
        }

        .timeline::before {
            content: '';
            position: absolute;
            top: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 4px;
            height: 100%;
            background: var(--fellowship-gradient);
            border-radius: 2px;
            animation: growLine 2s ease-out;
        }

        .timeline-item {
            background: var(--bg-glass);
            backdrop-filter: var(--glass-blur);
            border: 1px solid var(--glass-border);
            padding: 40px;
            border-radius: 24px;
            margin-bottom: 40px;
            position: relative;
            width: 45%;
            transition: var(--transition-smooth);
            animation: slideInUp 0.8s ease-out;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }
        
        .timeline-item::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: var(--fellowship-gradient);
            opacity: 0;
            transition: var(--transition-smooth);
        }

        .timeline-item:nth-child(odd) {
            left: 0;
            animation: slideInLeft 0.8s ease-out;
        }

        .timeline-item:nth-child(even) {
            left: 55%;
            animation: slideInRight 0.8s ease-out;
        }

        .timeline-item::before {
            content: '';
            position: absolute;
            top: 40px;
            width: 20px;
            height: 20px;
            border-radius: 50%;
            background: var(--fellowship-gradient);
            box-shadow: 0 0 20px rgba(139, 92, 246, 0.5);
            animation: pulse 2s infinite;
        }

        .timeline-item:nth-child(odd)::before {
            right: -10px;
        }

        .timeline-item:nth-child(even)::before {
            left: -10px;
        }

        .timeline-item:hover {
            transform: scale(1.02);
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.2);
        }

        .timeline-item h3 {
            color: var(--text-primary);
            margin-bottom: 12px;
            font-size: 1.3rem;
        }

        .timeline-item p {
            color: var(--text-secondary);
            line-height: 1.6;
        }

        /* Image Gallery */
        .image-gallery {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 30px;
            margin: 60px 0;
        }

        .gallery-image {
            width: 100%;
            height: 250px;
            object-fit: cover;
            border-radius: 20px;
            transition: var(--transition-smooth);
            animation: fadeInUp 0.6s ease-out;
        }

        .gallery-image:nth-child(2) { animation-delay: 0.2s; }
        .gallery-image:nth-child(3) { animation-delay: 0.4s; }

        .gallery-image:hover {
            transform: scale(1.05) rotateY(5deg);
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.3);
            filter: brightness(1.1);
        }

        /* Benefits Grid */
        .benefits-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 30px;
            margin: 40px 0;
        }

        .benefit-card {
            background: var(--bg-glass);
            backdrop-filter: var(--glass-blur);
            border: 1px solid var(--glass-border);
            border-radius: 20px;
            padding: 40px 30px;
            text-align: center;
            transition: var(--transition-smooth);
        }

        .benefit-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(46, 125, 50, 0.2);
        }

        .benefit-card i {
            font-size: 2.5rem;
            color: #43a047;
            margin-bottom: 20px;
        }

        .benefit-card h3 {
            color: var(--text-primary);
            margin-bottom: 15px;
            font-size: 1.3rem;
        }

        .benefit-card p {
            color: var(--text-secondary);
            line-height: 1.6;
        }

        /* Eligibility Section */
        .eligibility-content {
            background: var(--bg-glass);
            backdrop-filter: var(--glass-blur);
            border: 1px solid var(--glass-border);
            border-radius: 20px;
            padding: 40px;
            margin: 40px 0;
        }

        .eligibility-list {
            list-style: none;
            padding: 0;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
        }

        .eligibility-list li {
            padding-left: 30px;
            position: relative;
            color: var(--text-secondary);
            font-size: 1.1rem;
        }

        .eligibility-list li::before {
            content: '✓';
            position: absolute;
            left: 0;
            color: #43a047;
            font-weight: bold;
        }



        /* Apply Section */
        .apply-section {
            background: var(--bg-primary);
            padding: 120px 0;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .apply-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: 
                radial-gradient(circle at 20% 80%, rgba(139, 92, 246, 0.3) 0%, transparent 50%),
                radial-gradient(circle at 80% 20%, rgba(245, 158, 11, 0.3) 0%, transparent 50%);
            animation: gradientShift 10s ease-in-out infinite;
        }

        .apply-section h2 {
            font-size: clamp(2.5rem, 4vw, 3.5rem);
            margin-bottom: 20px;
            background: var(--fellowship-gradient);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            position: relative;
            z-index: 2;
            animation: slideInUp 1s ease-out;
        }

        .apply-section p {
            font-size: 1.2rem;
            color: var(--text-secondary);
            margin-bottom: 40px;
            position: relative;
            z-index: 2;
            animation: slideInUp 1s ease-out 0.2s both;
        }

        .apply-button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 18px 40px;
            background: var(--fellowship-gradient);
            color: #ffffff;
            text-decoration: none;
            border-radius: 50px;
            font-weight: 600;
            font-size: 16px;
            transition: var(--transition-bounce);
            position: relative;
            z-index: 2;
            box-shadow: 0 8px 25px rgba(139, 92, 246, 0.3);
            animation: slideInUp 1s ease-out 0.4s both;
        }

        .apply-button:hover {
            transform: translateY(-8px) scale(1.05);
            box-shadow: 0 20px 40px rgba(139, 92, 246, 0.4);
        }

        /* Footer */
        footer {
            background: linear-gradient(135deg, #0a0a0a 0%, #151515 100%);
            border-top: 1px solid var(--glass-border);
            padding: 60px 0 30px;
            text-align: center;
        }

        .footer-logo {
            margin-bottom: 30px;
            animation: float 6s ease-in-out infinite;
        }

        .footer-logo img {
            height: 60px;
            filter: drop-shadow(0 4px 12px rgba(0, 0, 0, 0.5));
        }

        /* Animations */
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
        }

        @keyframes pulse {
            0%, 100% { opacity: 1; transform: scale(1); }
            50% { opacity: 0.7; transform: scale(1.05); }
        }

        @keyframes slideInUp {
            from { opacity: 0; transform: translateY(50px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @keyframes slideInLeft {
            from { opacity: 0; transform: translateX(-30px); }
            to { opacity: 1; transform: translateX(0); }
        }

        @keyframes slideInRight {
            from { opacity: 0; transform: translateX(30px); }
            to { opacity: 1; transform: translateX(0); }
        }

        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @keyframes scaleIn {
            from { opacity: 0; transform: scale(0); }
            to { opacity: 1; transform: scale(1); }
        }

        @keyframes textGlow {
            0%, 100% { text-shadow: 0 0 20px rgba(139, 92, 246, 0.5); }
            50% { text-shadow: 0 0 30px rgba(139, 92, 246, 0.8); }
        }

        @keyframes gradientShift {
            0%, 100% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
        }

        @keyframes countUp {
            from { opacity: 0; transform: scale(0.5); }
            to { opacity: 1; transform: scale(1); }
        }

        @keyframes growLine {
            from { height: 0; }
            to { height: 100%; }
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .mobile-menu-btn {
                display: flex;
                align-items: center;
                justify-content: center;
            }

            nav {
                position: fixed;
                top: 90px;
                left: -100%;
                width: 90%;
                max-width: 400px;
                height: calc(100vh - 90px);
                background: var(--bg-glass);
                backdrop-filter: blur(20px);
                border: 1px solid var(--glass-border);
                border-radius: 0 20px 20px 0;
                transition: var(--transition-smooth);
                z-index: 999;
            }

            nav.active {
                left: 0;
            }

            nav ul {
                flex-direction: column;
                gap: 0;
                padding: 40px 30px;
            }

            nav ul li a {
                display: block;
                padding: 16px 0;
                border-bottom: 1px solid var(--glass-border);
                text-align: center;
            }

            .timeline::before {
                left: 30px;
            }

            .timeline-item {
                width: 100%;
                left: 0 !important;
                padding-left: 80px;
                padding-right: 20px;
            }

            .timeline-item::before {
                left: 18px !important;
            }

            .program-stats,
            .image-gallery {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <!-- Header -->
    <header id="header">
        <div class="container header-container">
            <div class="logo">
                <a href="../index.php">
                    <img src="../img/logo.png" alt="Katagum Youth League Logo">
                </a>
            </div>
            <button class="mobile-menu-btn" id="mobileMenuBtn">
                <i class="fas fa-bars"></i>
            </button>
            <nav id="mainNav">
                <ul>
                    <li><a href="../index.php#about">About Us</a></li>
                    <li><a href="../index.php#aims">Aims & Objectives</a></li>
                    <li><a href="../index.php#achievements">Programs</a></li>
                    <li><a href="../index.php#timeline">Events</a></li>
                    <li><a href="../index.php#team">Our Team</a></li>
                    <li><a href="../index.php#contact">Contact</a></li>
                    <li><a href="../gallery.html">Gallery</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="program-hero">
        <div class="container">
            <div class="hero-content">
                <h1>Mallam Zaki Fellowship Program</h1>
                <p>Empowering the Next Generation of Leaders</p>
                <div class="hero-btns">
                    <a href="#apply" class="btn">Apply Now</a>
                    <a href="#benefits" class="btn btn-outline">Learn More</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Program Content -->
    <section class="program-content">
        <div class="container">
            <div class="program-section">
                <h2>About the Fellowship</h2>
                <p>The Mallam Zaki Fellowship is KYL's flagship leadership development program, designed to nurture and empower emerging young leaders from Katagum. Through intensive training, mentorship, and hands-on experience, fellows develop the skills and knowledge needed to drive positive change in their communities.</p>
            </div>

            <div class="program-stats">
                <div class="stat-card">
                    <div class="stat-number">30+</div>
                    <p>Fellows Graduated</p>
                </div>
                <div class="stat-card">
                    <div class="stat-number">6</div>
                    <p>Months Duration</p>
                </div>
                <div class="stat-card">
                    <div class="stat-number">12</div>
                    <p>Expert Mentors</p>
                </div>
            </div>

            <div class="program-section">
                <h2>Program Components</h2>
                <ul style="list-style: none; padding: 0;">
                    <li style="position: relative; padding: 15px 0 15px 40px; font-size: 1.1rem; color: var(--text-secondary); animation: slideInLeft 0.6s ease-out;">Leadership Development Workshops</li>
                    <li style="position: relative; padding: 15px 0 15px 40px; font-size: 1.1rem; color: var(--text-secondary); animation: slideInLeft 0.6s ease-out; animation-delay: 0.1s;">Community Project Implementation</li>
                    <li style="position: relative; padding: 15px 0 15px 40px; font-size: 1.1rem; color: var(--text-secondary); animation: slideInLeft 0.6s ease-out; animation-delay: 0.2s;">One-on-One Mentorship</li>
                    <li style="position: relative; padding: 15px 0 15px 40px; font-size: 1.1rem; color: var(--text-secondary); animation: slideInLeft 0.6s ease-out; animation-delay: 0.3s;">Networking Opportunities</li>
                    <li style="position: relative; padding: 15px 0 15px 40px; font-size: 1.1rem; color: var(--text-secondary); animation: slideInLeft 0.6s ease-out; animation-delay: 0.4s;">Skills Development Training</li>
                </ul>
            </div>

            <div class="program-section">
                <h2>Fellowship Timeline</h2>
                <div class="timeline">
                    <div class="timeline-item">
                        <h3>Month 1-2: Foundation Phase</h3>
                        <p>Core leadership principles, self-discovery, and team building</p>
                    </div>
                    <div class="timeline-item">
                        <h3>Month 3-4: Development Phase</h3>
                        <p>Skill-building workshops and project planning</p>
                    </div>
                    <div class="timeline-item">
                        <h3>Month 5-6: Implementation Phase</h3>
                        <p>Community project execution and leadership practice</p>
                    </div>
                </div>
            </div>

            <div class="program-section">
                <h2>Program Benefits</h2>
                <div class="benefits-grid">
                    <div class="benefit-card">
                        <i class="fas fa-graduation-cap"></i>
                        <h3>Professional Development</h3>
                        <p>Access to specialized training, workshops, and certifications in leadership and management.</p>
                    </div>
                    <div class="benefit-card">
                        <i class="fas fa-users"></i>
                        <h3>Network Building</h3>
                        <p>Connect with industry leaders, mentors, and fellow changemakers from across the region.</p>
                    </div>
                    <div class="benefit-card">
                        <i class="fas fa-project-diagram"></i>
                        <h3>Project Funding</h3>
                        <p>Opportunity to receive seed funding for community development projects.</p>
                    </div>
                    <div class="benefit-card">
                        <i class="fas fa-hands-helping"></i>
                        <h3>Mentorship</h3>
                        <p>One-on-one guidance from experienced leaders and professionals.</p>
                    </div>
                </div>
            </div>

            <div class="program-section">
                <h2>Eligibility Criteria</h2>
                <div class="eligibility-content">
                    <ul class="eligibility-list">
                        <li>Age between 21-35 years</li>
                        <li>Native or resident of Katagum</li>
                        <li>Demonstrated leadership potential</li>
                        <li>Strong commitment to community development</li>
                        <li>Minimum of Bachelor's degree or equivalent experience</li>
                        <li>Fluent in English and Hausa</li>
                    </ul>
                </div>
            </div>

        </div>
    </section>

    <!-- Apply Section -->
    <section class="apply-section">
        <div class="container">
            <h2>Join the Next Cohort</h2>
            <p>Applications are now open for the 2025 Mallam Zaki Fellowship Program</p>
            <a href="apply-fellowship.php" class="apply-button">Apply Now</a>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="footer-logo">
                <img src="../img/logo.png" alt="Katagum Youth League Logo">
            </div>
            <p class="copyright">© 2024 Katagum Youth League. All Rights Reserved.</p>
        </div>
    </footer>

    <script>

        // Mobile Menu Toggle
        const mobileMenuBtn = document.getElementById('mobileMenuBtn');
        const mainNav = document.getElementById('mainNav');

        mobileMenuBtn.addEventListener('click', () => {
            mainNav.classList.toggle('active');
            mobileMenuBtn.innerHTML = mainNav.classList.contains('active') ?
                '<i class="fas fa-times"></i>' : '<i class="fas fa-bars"></i>';
        });

        // Scroll Header Effect
        const header = document.getElementById('header');

        window.addEventListener('scroll', () => {
            if (window.scrollY > 100) {
                header.classList.add('scrolled');
            } else {
                header.classList.remove('scrolled');
            }
        });

        // Add bullet points to list items
        document.querySelectorAll('ul li').forEach(li => {
            li.style.cssText += `
                &::before {
                    content: '';
                    position: absolute;
                    left: 0;
                    top: 50%;
                    transform: translateY(-50%);
                    width: 20px;
                    height: 20px;
                    background: var(--fellowship-gradient);
                    border-radius: 50%;
                    animation: pulse 2s infinite;
                }
            `;
        });
    </script>
</body>
</html>