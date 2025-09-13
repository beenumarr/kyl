<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modern Agriculture Program - Katagum Youth League</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        :root {
            /* Dark Theme */
            --bg-primary: #0a0a0a;
            --bg-secondary: #151515;
            --bg-glass: rgba(255, 255, 255, 0.05);
            --bg-glass-hover: rgba(255, 255, 255, 0.1);
            --text-primary: #ffffff;
            --text-secondary: #b3b3b3;
            --text-muted: #666666;
            
            /* Light Theme Variables */
            --light-bg-primary: #fafafa;
            --light-bg-secondary: #ffffff;
            --light-bg-glass: rgba(0, 0, 0, 0.02);
            --light-bg-glass-hover: rgba(0, 0, 0, 0.05);
            --light-text-primary: #1a1a1a;
            --light-text-secondary: #4a4a4a;
            --light-text-muted: #888888;
            
            /* Brand Colors */
            --primary-gradient: linear-gradient(135deg, #f59e0b, #d97706);
            --secondary-gradient: linear-gradient(135deg, #3b82f6, #1d4ed8);
            --accent-gradient: linear-gradient(135deg, #22c55e, #16a34a);
            --agriculture-gradient: linear-gradient(135deg, #22c55e, #15803d);
            
            /* Glassmorphism */
            --glass-border: rgba(255, 255, 255, 0.18);
            --glass-shadow: 0 8px 32px rgba(31, 38, 135, 0.37);
            --glass-blur: blur(8px);
            
            /* Animations */
            --transition-smooth: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            --transition-bounce: all 0.6s cubic-bezier(0.68, -0.55, 0.265, 1.55);
        }

        /* Light Theme Override */
        [data-theme="light"] {
            --bg-primary: var(--light-bg-primary);
            --bg-secondary: var(--light-bg-secondary);
            --bg-glass: var(--light-bg-glass);
            --bg-glass-hover: var(--light-bg-glass-hover);
            --text-primary: var(--light-text-primary);
            --text-secondary: var(--light-text-secondary);
            --text-muted: var(--light-text-muted);
            --glass-border: rgba(0, 0, 0, 0.1);
            --glass-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
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

        /* Header Styles */
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
            color: #22c55e;
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
            background: var(--agriculture-gradient);
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

        /* Program Hero Section */
        .program-hero {
            height: 80vh;
            min-height: 600px;
            background: 
                linear-gradient(45deg, rgba(0, 0, 0, 0.7), rgba(34, 197, 94, 0.3)),
                url('../Agricultural/1.jpeg') center/cover no-repeat;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .program-hero::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: radial-gradient(circle at 30% 70%, rgba(34, 197, 94, 0.4) 0%, transparent 50%),
                        radial-gradient(circle at 70% 30%, rgba(245, 158, 11, 0.3) 0%, transparent 50%);
            animation: gradientShift 8s ease-in-out infinite;
        }

        .program-hero::after {
            content: '';
            position: absolute;
            width: 200px;
            height: 200px;
            background: rgba(34, 197, 94, 0.1);
            border-radius: 50%;
            top: 20%;
            right: 10%;
            animation: float 8s ease-in-out infinite;
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
            background: linear-gradient(45deg, #ffffff, #22c55e);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            animation: textGlow 3s ease-in-out infinite alternate;
        }

        .program-hero p {
            font-size: clamp(1.2rem, 2.5vw, 1.6rem);
            color: rgba(255, 255, 255, 0.9);
            margin-bottom: 0;
            animation: slideInUp 1s ease-out 0.3s both;
        }

        /* Program Content */
        .program-content {
            padding: 120px 0;
            background: var(--bg-secondary);
            position: relative;
        }

        .program-content::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: radial-gradient(circle at 50% 50%, rgba(34, 197, 94, 0.05) 0%, transparent 50%);
            pointer-events: none;
        }

        .program-section {
            margin-bottom: 80px;
            animation: fadeInUp 0.8s ease-out;
        }

        .program-section h2 {
            font-size: clamp(2rem, 4vw, 3rem);
            margin-bottom: 30px;
            background: var(--agriculture-gradient);
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
            background: var(--agriculture-gradient);
            border-radius: 2px;
            animation: scaleIn 1s ease-out 0.5s both;
        }

        .program-section p {
            font-size: 1.1rem;
            color: var(--text-secondary);
            line-height: 1.8;
            margin-bottom: 20px;
        }

        .program-section ul {
            list-style: none;
            padding: 0;
        }

        .program-section ul li {
            position: relative;
            padding: 15px 0 15px 40px;
            font-size: 1.1rem;
            color: var(--text-secondary);
            animation: slideInLeft 0.6s ease-out;
        }

        .program-section ul li:nth-child(even) {
            animation-delay: 0.1s;
        }

        .program-section ul li::before {
            content: '';
            position: absolute;
            left: 0;
            top: 50%;
            transform: translateY(-50%);
            width: 20px;
            height: 20px;
            background: var(--agriculture-gradient);
            border-radius: 50%;
            animation: pulse 2s infinite;
        }

        /* Program Features */
        .program-features {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
            gap: 40px;
            margin: 80px 0;
        }

        .feature-card {
            background: var(--bg-glass);
            backdrop-filter: var(--glass-blur);
            border: 1px solid var(--glass-border);
            padding: 40px;
            border-radius: 24px;
            text-align: center;
            transition: var(--transition-bounce);
            position: relative;
            overflow: hidden;
            animation: fadeInUp 0.8s ease-out;
        }

        .feature-card:nth-child(2) { animation-delay: 0.2s; }
        .feature-card:nth-child(3) { animation-delay: 0.4s; }

        .feature-card::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(34, 197, 94, 0.05) 0%, transparent 70%);
            opacity: 0;
            transition: var(--transition-smooth);
            pointer-events: none;
        }

        .feature-card:hover {
            transform: translateY(-15px) rotateY(5deg);
            box-shadow: 0 25px 60px rgba(0, 0, 0, 0.3);
        }

        .feature-card:hover::before {
            opacity: 1;
        }

        .feature-icon {
            font-size: 4rem;
            background: var(--agriculture-gradient);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 24px;
            animation: bounce 2s infinite;
        }

        .feature-card h3 {
            font-size: 1.4rem;
            margin-bottom: 16px;
            color: var(--text-primary);
        }

        .feature-card p {
            color: var(--text-secondary);
            line-height: 1.6;
        }

        /* Impact Stats */
        .impact-stats {
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
            border-radius: 20px;
            text-align: center;
            transition: var(--transition-smooth);
            position: relative;
            overflow: hidden;
            animation: fadeInUp 0.6s ease-out;
        }

        .stat-card:nth-child(2) { animation-delay: 0.2s; }
        .stat-card:nth-child(3) { animation-delay: 0.4s; }

        .stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(34, 197, 94, 0.1), transparent);
            transition: var(--transition-smooth);
        }

        .stat-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2);
        }

        .stat-card:hover::before {
            left: 100%;
            transition: left 0.8s ease-out;
        }

        .stat-number {
            font-size: 3.5rem;
            font-weight: 800;
            background: var(--agriculture-gradient);
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

        /* Join Section */
        .join-section {
            background: var(--bg-primary);
            padding: 120px 0;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .join-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: 
                radial-gradient(circle at 20% 80%, rgba(34, 197, 94, 0.3) 0%, transparent 50%),
                radial-gradient(circle at 80% 20%, rgba(245, 158, 11, 0.3) 0%, transparent 50%);
            animation: gradientShift 10s ease-in-out infinite;
        }

        .join-section h2 {
            font-size: clamp(2.5rem, 4vw, 3.5rem);
            margin-bottom: 20px;
            background: var(--agriculture-gradient);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            position: relative;
            z-index: 2;
            animation: slideInUp 1s ease-out;
        }

        .join-section p {
            font-size: 1.2rem;
            color: var(--text-secondary);
            margin-bottom: 40px;
            position: relative;
            z-index: 2;
            animation: slideInUp 1s ease-out 0.2s both;
        }

        .join-button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 18px 40px;
            background: var(--agriculture-gradient);
            color: #ffffff;
            text-decoration: none;
            border-radius: 50px;
            font-weight: 600;
            font-size: 16px;
            transition: var(--transition-bounce);
            position: relative;
            z-index: 2;
            box-shadow: 0 8px 25px rgba(34, 197, 94, 0.3);
            animation: slideInUp 1s ease-out 0.4s both;
        }

        .join-button:hover {
            transform: translateY(-8px) scale(1.05);
            box-shadow: 0 20px 40px rgba(34, 197, 94, 0.4);
        }

        /* Footer */
        footer {
            background: linear-gradient(135deg, #0a0a0a 0%, #151515 100%);
            border-top: 1px solid var(--glass-border);
            padding: 60px 0 30px;
            text-align: center;
        }

        footer::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 1px;
            background: var(--agriculture-gradient);
        }

        .footer-logo {
            margin-bottom: 30px;
            animation: float 6s ease-in-out infinite;
        }

        .footer-logo img {
            height: 60px;
            filter: drop-shadow(0 4px 12px rgba(0, 0, 0, 0.5));
        }

        .copyright {
            color: var(--text-muted);
            font-size: 0.9rem;
            margin: 0;
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

        @keyframes bounce {
            0%, 20%, 53%, 80%, 100% { transform: translateY(0); }
            40%, 43% { transform: translateY(-20px); }
            70% { transform: translateY(-10px); }
            90% { transform: translateY(-4px); }
        }

        @keyframes slideInUp {
            from {
                opacity: 0;
                transform: translateY(50px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes slideInLeft {
            from {
                opacity: 0;
                transform: translateX(-30px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes scaleIn {
            from {
                opacity: 0;
                transform: scale(0);
            }
            to {
                opacity: 1;
                transform: scale(1);
            }
        }

        @keyframes textGlow {
            0%, 100% {
                text-shadow: 0 0 20px rgba(34, 197, 94, 0.5);
            }
            50% {
                text-shadow: 0 0 30px rgba(34, 197, 94, 0.8);
            }
        }

        @keyframes gradientShift {
            0%, 100% {
                background-position: 0% 50%;
            }
            50% {
                background-position: 100% 50%;
            }
        }

        @keyframes countUp {
            from {
                opacity: 0;
                transform: scale(0.5);
            }
            to {
                opacity: 1;
                transform: scale(1);
            }
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

            .program-features,
            .impact-stats,
            .image-gallery {
                grid-template-columns: 1fr;
            }

            .container {
                padding: 0 20px;
            }
        }

        /* Accessibility */
        @media (prefers-reduced-motion: reduce) {
            *,
            *::before,
            *::after {
                animation-duration: 0.01ms !important;
                animation-iteration-count: 1 !important;
                transition-duration: 0.01ms !important;
            }
        }
    </style>
</head>
<body>
    <!-- Theme Toggle Button -->
    <button class="theme-toggle" aria-label="Toggle theme">
        <i class="fas fa-sun"></i>
    </button>

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
                    <li><a href="../index.php">Home</a></li>
                    <li><a href="../index.php#about">About</a></li>
                    <li><a href="../index.php#programs">Programs</a></li>
                    <li><a href="../index.php#contact">Contact</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="program-hero">
        <div class="container">
            <div class="hero-content">
                <h1>Modern Agriculture Program</h1>
                <p>Transforming Agriculture Through Innovation and Technology</p>
            </div>
        </div>
    </section>

    <!-- Program Content -->
    <section class="program-content">
        <div class="container">
            <div class="program-section">
                <h2>About the Program</h2>
                <p>Our Modern Agriculture Program is designed to revolutionize farming practices in Katagum through the introduction of innovative techniques, sustainable methods, and modern technology. We aim to empower young farmers with the knowledge and tools they need to succeed in modern agriculture.</p>
            </div>

            <div class="program-features">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-seedling"></i>
                    </div>
                    <h3>Sustainable Farming</h3>
                    <p>Learn eco-friendly farming practices that protect the environment while maximizing yield</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-tractor"></i>
                    </div>
                    <h3>Modern Technology</h3>
                    <p>Experience the latest agricultural technologies and mechanized farming techniques</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-hand-holding-water"></i>
                    </div>
                    <h3>Water Management</h3>
                    <p>Master efficient irrigation systems and water conservation methods</p>
                </div>
            </div>

            <div class="program-section">
                <h2>Program Components</h2>
                <ul>
                    <li>Hands-on Training in Modern Farming Techniques</li>
                    <li>Agricultural Technology Workshops</li>
                    <li>Sustainable Farming Practices</li>
                    <li>Market Access and Business Skills</li>
                    <li>Expert Mentorship from Experienced Farmers</li>
                </ul>
            </div>

            <div class="impact-stats">
                <div class="stat-card">
                    <div class="stat-number">100+</div>
                    <p>Young Farmers Trained</p>
                </div>
                <div class="stat-card">
                    <div class="stat-number">50</div>
                    <p>Hectares Cultivated</p>
                </div>
                <div class="stat-card">
                    <div class="stat-number">30%</div>
                    <p>Yield Increase</p>
                </div>
            </div>

            <div class="program-section">
                <h2>Success Stories</h2>
                <div class="image-gallery">
                    <img src="../Agricultural/2.jpeg" alt="Training Session" class="gallery-image">
                    <img src="../Agricultural/3.jpeg" alt="Modern Farming" class="gallery-image">
                    <img src="../Agricultural/4.jpeg" alt="Harvest Time" class="gallery-image">
                </div>
            </div>
        </div>
    </section>

    <!-- Join Section -->
    <section class="join-section">
        <div class="container">
            <h2>Join Our Agricultural Revolution</h2>
            <p>Be part of the transformation in Katagum's agricultural sector</p>
            <a href="../index.php#get-involved" class="join-button">Get Started</a>
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

    <!-- Particles Container -->
    <div class="particles-container"></div>

    <script>
        // Theme Toggle
        const themeToggle = document.querySelector('.theme-toggle');
        const currentTheme = localStorage.getItem('theme') || 'dark';
        document.documentElement.setAttribute('data-theme', currentTheme);

        function updateThemeIcon() {
            const theme = document.documentElement.getAttribute('data-theme');
            const icon = themeToggle.querySelector('i');
            icon.className = theme === 'dark' ? 'fas fa-sun' : 'fas fa-moon';
        }

        updateThemeIcon();

        themeToggle.addEventListener('click', () => {
            const currentTheme = document.documentElement.getAttribute('data-theme');
            const newTheme = currentTheme === 'dark' ? 'light' : 'dark';
            
            document.documentElement.setAttribute('data-theme', newTheme);
            localStorage.setItem('theme', newTheme);
            updateThemeIcon();
        });

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

        // Intersection Observer for animations
        const observerOptions = {
            root: null,
            rootMargin: