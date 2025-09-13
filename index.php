<?php
header("Content-Security-Policy: default-src 'self'; script-src 'self' https://cdnjs.cloudflare.com; style-src 'self' https://fonts.googleapis.com 'unsafe-inline' https://cdnjs.cloudflare.com; font-src 'self' https://fonts.gstatic.com; img-src 'self' https://images.unsplash.com data:; connect-src 'self' https://script.google.com; frame-src 'none'");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="icon" type="image/x-icon" href="img/logo.png">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Katagum Youth League | Empowering Youths for National Development</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Font Awesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="style.css">
    <script src="js/timer.js" defer></script>
    <script src="js/main.js" defer></script>
</head>

<body>
    <!-- Header -->
    <header id="header">
        <div class="container header-container">
            <div class="logo">
                <img src="img/logo.png" alt="Katagum Youth League Logo">
            </div>
            <button class="mobile-menu-btn" id="mobileMenuBtn">
                <i class="fas fa-bars"></i>
            </button>
            <nav id="mainNav">
                <ul>
                    <li><a href="#about">About Us</a></li>
                    <li><a href="#aims">Aims & Objectives</a></li>
                    <li><a href="#achievements">Programs</a></li>
                    <li><a href="#timeline">Events</a></li>
                    <li><a href="#team">Our Team</a></li>
                    <li><a href="#contact">Contact</a></li>
                    <li><a href="gallery.html">Gallery</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="hero" id="home">
        <div class="container">
            <div class="hero-content">
                <h1>Katagum Youth League</h1>
                <p>Empowering Youths for National Development</p>
                <div class="hero-btns">
                    <a href="events.php" class="btn">Events</a>
                    <a href="gallery.html" class="btn btn-outline">View Our Work</a>
                </div>
                <div class="countdown-card" id="countdown-card" style="display: none;">
                    <h3 id="countdown-title"></h3>
                    <div class="countdown">
                        <div class="time-block">
                            <span id="days">00</span>
                            <span class="label">Days</span>
                        </div>
                        <div class="time-block">
                            <span id="hours">00</span>
                            <span class="label">Hours</span>
                        </div>
                        <div class="time-block">
                            <span id="minutes">00</span>
                            <span class="label">Minutes</span>
                        </div>
                        <div class="time-block">
                            <span id="seconds">00</span>
                            <span class="label">Seconds</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section class="about" id="about">
        <div class="container">
            <h2 class="fade-in">About Us</h2>
            <div class="about-content fade-in" style="animation-delay: 0.2s;">
                <div class="about-text">
                    <p>The Katagum Youth League (KYL) is a non-profit organization dedicated to empowering young people
                        in Katagum, Bauchi State, Nigeria through leadership development, education support, climate
                        action, and anti-trafficking advocacy.</p>
                    <p>Founded in 2022 by Comrade Jamilu Alhaji Mato, KYL works to uplift youth across Katagum by
                        providing opportunities for personal growth, community engagement, and social impact.</p>
                    <div class="founder-quote">
                        <p>"Our youth are not just the leaders of tomorrow, but the change-makers of today. At KYL, we
                            believe in harnessing their potential to build a better Katagum for all."</p>
                        <p class="author">- Comrade Jamilu Alhaji Mato, Founder & CEO</p>
                    </div>
                </div>
                <div class="about-image">
                    <img src="https://images.unsplash.com/photo-1521791136064-7986c2920216?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1469&q=80"
                        alt="KYL Youth Group Photo">
                </div>
            </div>
        </div>
    </section>

    <!-- Aims & Objectives Section -->
    <section class="aims" id="aims">
        <div class="container">
            <h2 class="fade-in">Aims & Objectives</h2>
            <div class="aims-container fade-in" style="animation-delay: 0.2s;">
                <div class="aims-toggle">
                    <button class="active" data-lang="english">English</button>
                    <button data-lang="hausa">Hausa</button>
                </div>
                <div class="aims-content active" id="english-aims">
                    <ul class="aims-list">
                        <li>Promote youth leadership and community development initiatives</li>
                        <li>Encourage education and peace-building among young people</li>
                        <li>Organize civic engagement programs and leadership fellowships</li>
                        <li>Support sustainable agriculture and environmental awareness</li>
                        <li>Collaborate with NGOs and local authorities on youth development</li>
                        <li>Combat human trafficking through awareness campaigns</li>
                        <li>Provide mentorship and career guidance for youth</li>
                        <li>Foster intergenerational dialogue and knowledge transfer</li>
                        <!-- Additions for better clarity and engagement -->
                        <li>Empower girls and young women through targeted initiatives</li>
                        <li>Promote digital literacy and technology skills among youth</li>
                        <li>Encourage youth entrepreneurship and innovation</li>
                        <li>Facilitate access to mental health resources and support</li>
                    </ul>
                </div>
                <div class="aims-content" id="hausa-aims">
                    <ul class="aims-list">
                        <li>Inganta shugabanci matasa da ci gaban al'umma</li>
                        <li>Karfafa ilimi da zaman lafiya tsakanin matasa</li>
                        <li>Shirya shirye-shiryen shiga cikin al'umma da kuma gudanar da shugabanni</li>
                        <li>Taimaka wa noma mai dorewa da wayar da kan muhalli</li>
                        <li>Haɗin kai tare da ƙungiyoyi da hukumomin gida don ci gaban matasa</li>
                        <li>Yaƙi da fataucin mutane ta hanyar yaƙin neman wayar da kan jama'a</li>
                        <li>Ba da jagoranci da jagorancin aiki ga matasa</li>
                        <li>Haɓaka tattaunawa tsakanin tsararraki da canja wurin ilimi</li>
                        <!-- Hausa translations for new aims -->
                        <li>Karfafa mata da 'yan mata ta hanyar shirye-shiryen na musamman</li>
                        <li>Inganta ilimin zamani da fasaha tsakanin matasa</li>
                        <li>Karfafa kasuwanci da kirkire-kirkire a tsakanin matasa</li>
                        <li>Samar da hanyoyin tallafi da wayar da kai kan lafiyar kwakwalwa</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- Achievements & Programs Section -->
    <section class="achievements" id="achievements">
        <div class="container">
            <h2 class="fade-in">Our Impact</h2>
            <div class="achievements-grid fade-in" style="animation-delay: 0.2s;">
                <div class="achievement-card">
                    <div class="achievement-icon">🎓</div>
                    <div class="achievement-number">30</div>
                    <p>Fellows graduated from our Fellowship Program</p>
                </div>
                <div class="achievement-card">
                    <div class="achievement-icon">🌱</div>
                    <div class="achievement-number">100+</div>
                    <p>Trees planted in our climate action initiative</p>
                </div>
                <div class="achievement-card">
                    <div class="achievement-icon">📚</div>
                    <div class="achievement-number">500+</div>
                    <p>Youths engaged in our educational programs</p>
                </div>
                <div class="achievement-card">
                    <div class="achievement-icon">🧠</div>
                    <div class="achievement-number">7+</div>
                    <p>Programs Held So far</p>
                </div>
            </div>

            <div class="programs fade-in" style="animation-delay: 0.4s;">
                <h3>Our Core Programs</h3>
                <div class="programs-grid">
                    <div class="program-card">
                        <div class="program-image">
                            <img src="fellowship/1.jpeg" alt="Mallam Zaki Fellowship">
                        </div>
                        <div class="program-content">
                            <h3>Mallam Zaki Fellowship</h3>
                            <p>Our flagship leadership development program for emerging young leaders.</p>
                            <a href="programs/fellowship.php" class="btn">Learn More</a>
                        </div>
                    </div>
                    <div class="program-card">
                        <div class="program-image">
                            <img src="Agricultural/1.jpeg" alt="Modern Agriculture">
                        </div>
                        <div class="program-content">
                            <h3>Modern Agriculture</h3>
                            <p>Transforming agriculture through innovation and sustainable practices.</p>
                            <a href="programs/agriculture.php" class="btn">Learn More</a>
                        </div>
                    </div>
                    <div class="program-card">
                        <div class="program-image">
                            <img src="img/school.jpg" alt="Youth Development">
                        </div>
                        <div class="program-content">
                            <h3>Youth Development</h3>
                            <p>Comprehensive programs for personal and professional growth.</p>
                            <a href="programs/youth.php" class="btn">Learn More</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Upcoming Programs Section -->
    <section class="timeline-section" id="timeline">
        <div class="container">
            <h2 class="fade-in">Upcoming Programs</h2>
            <div class="timeline fade-in" style="animation-delay: 0.2s;">
                <div class="timeline-item">
                    <div class="timeline-content">
                        <div class="timeline-date">2025</div>
                        <h3>Katagum Colloquium 3.0</h3>
                        <p>Annual youth forum bringing together young leaders, policymakers, and experts to discuss
                            pressing issues affecting Katagum youth.</p>
                    </div>
                </div>
                <div class="timeline-item">
                    <div class="timeline-content">
                        <div class="timeline-date">2025</div>
                        <h3>Mallam Zaki Fellowship</h3>
                        <p>Next cohort of our flagship leadership development program for emerging young leaders.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Past Events Section -->
    <section class="timeline-section">
        <div class="container">
            <h2 class="fade-in">Past Events</h2>
            <div class="timeline fade-in" style="animation-delay: 0.2s;">
                <div class="timeline-item">
                    <div class="timeline-content">
                        <div class="timeline-date">May 2025</div>
                        <h3>Youth Leadership Retreat (Kano)</h3>
                        <p>3-day intensive leadership training for 40 selected youth leaders from across Katagum.</p>
                    </div>
                </div>
                <div class="timeline-item">
                    <div class="timeline-content">
                        <div class="timeline-date">January 2025</div>
                        <h3>2-Day Seminar on Modern Agricultural Practices</h3>
                        <p>Hands-on training for youth on sustainable agriculture practices and modern farming
                            techniques.</p>
                    </div>
                </div>
                <div class="timeline-item">
                    <div class="timeline-content">
                        <div class="timeline-date">June 2024</div>
                        <h3>Late Alh. Ahmadu Muhammadu Wabi III Debate, Quiz and Spelling Competition</h3>
                        <p>Academic competition held in Jama'are to promote education and healthy academic rivalry among
                            secondary schools.</p>
                    </div>
                </div>
                <div class="timeline-item">
                    <div class="timeline-content">
                        <div class="timeline-date">December 2024</div>
                        <h3>Mallam Zaki Fellowship Graduation</h3>
                        <p>Graduation ceremony for the inaugural cohort of the Mallam Zaki Fellowship program.</p>
                    </div>
                </div>
                <div class="timeline-item">
                    <div class="timeline-content">
                        <div class="timeline-date">April 2024</div>
                        <h3>Katagum Colloquium 2.0</h3>
                        <p>Second edition of our annual youth forum with over 200 participants from across Bauchi State.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Team Section -->
    <section class="team" id="team">
        <div class="container">
            <h2 class="fade-in">Meet the Team</h2>
            <div class="team-grid fade-in" style="animation-delay: 0.2s; display: flex; flex-wrap: wrap; gap: 32px; justify-content: center;">
                <!-- Executive Leadership -->
                <div class="team-member" style="background: #212121; border-radius: 12px; box-shadow: 0 2px 12px rgb(226 132 8); padding: 24px 18px; max-width: 260px; text-align: center; flex: 1 1 220px;">
                    <div class="member-image" style="width: 110px; height: 110px; margin: 0 auto 16px; border-radius: 50%; overflow: hidden; border: 3px solid #eaeaea;">
                        <img src="img/jamilu.jpeg" alt="Comrade Jamilu Alhaji Mato" style="width: 100%; height: 100%; object-fit: cover;">
                    </div>
                    <div class="member-info">
                        <h3 style="margin-bottom: 6px; font-size: 1.15rem;">Jamilu Alhaji Mato</h3>
                        <p style="color: #666; font-size: 0.98rem; margin-bottom: 10px;">Executive Chairman</p>
                    </div>
                </div>

                <div class="team-member" style="background: #212121; border-radius: 12px; box-shadow: 0 2px 12px rgb(226 132 8); padding: 24px 18px; max-width: 260px; text-align: center; flex: 1 1 220px;">
                    <div class="member-image" style="width: 110px; height: 110px; margin: 0 auto 16px; border-radius: 50%; overflow: hidden; border: 3px solid #eaeaea;">
                        <img src="img/char.jpeg" alt="Aminu Abubakar Wali" style="width: 100%; height: 100%; object-fit: cover;">
                    </div>
                    <div class="member-info">
                        <h3 style="margin-bottom: 6px; font-size: 1.15rem;">Aminu Abubakar Wali</h3>
                        <p style="color: #666; font-size: 0.98rem; margin-bottom: 10px;">Deputy Chairman</p>
                    </div>
                </div>

                <div class="team-member" style="background: #212121; border-radius: 12px; box-shadow: 0 2px 12px rgb(226 132 8); padding: 24px 18px; max-width: 260px; text-align: center; flex: 1 1 220px;">
                    <div class="member-image" style="width: 110px; height: 110px; margin: 0 auto 16px; border-radius: 50%; overflow: hidden; border: 3px solid #eaeaea;">
                        <img src="img/3.jpeg" alt="Muhammad Muhammad" style="width: 100%; height: 100%; object-fit: cover;">
                    </div>
                    <div class="member-info">
                        <h3 style="margin-bottom: 6px; font-size: 1.15rem;">Muhammad Muhammad</h3>
                        <p style="color: #666; font-size: 0.98rem; margin-bottom: 10px;">Secretary General</p>
                    </div>
                </div>
                <div class="team-member" style="background: #212121; border-radius: 12px; box-shadow: 0 2px 12px rgb(226 132 8); padding: 24px 18px; max-width: 260px; text-align: center; flex: 1 1 220px;">
                    <div class="member-image" style="width: 110px; height: 110px; margin: 0 auto 16px; border-radius: 50%; overflow: hidden; border: 3px solid #eaeaea;">
                        <img src="img/4.jpeg" alt="Ibrahim Bappah Aliyu" style="width: 100%; height: 100%; object-fit: cover;">
                    </div>
                    <div class="member-info">
                        <h3 style="margin-bottom: 6px; font-size: 1.15rem;">Ibrahim Bappah Aliyu</h3>
                        <p style="color: #666; font-size: 0.98rem; margin-bottom: 10px;">Assistant Secretary General</p>
                    </div>
                </div>
                <!-- Directors -->
                <div class="team-member" style="background: #212121; border-radius: 12px; box-shadow: 0 2px 12px rgb(226 132 8); padding: 24px 18px; max-width: 260px; text-align: center; flex: 1 1 220px;">
                    <div class="member-image" style="width: 110px; height: 110px; margin: 0 auto 16px; border-radius: 50%; overflow: hidden; border: 3px solid #eaeaea;">
                        <img src="img/WhatsApp Image 2025-07-03 at 10.12.52 PM.jpeg" alt="Aliyu Musa Dada" style="width: 100%; height: 100%; object-fit: cover;">
                    </div>
                    <div class="member-info">
                        <h3 style="margin-bottom: 6px; font-size: 1.15rem;">Aliyu Musa Dada</h3>
                        <p style="color: #666; font-size: 0.98rem; margin-bottom: 10px;">Program and Innovation Director</p>
                    </div>
                </div>

                <div class="team-member" style="background: #212121; border-radius: 12px; box-shadow: 0 2px 12px rgb(226 132 8); padding: 24px 18px; max-width: 260px; text-align: center; flex: 1 1 220px;">
                    <div class="member-image" style="width: 110px; height: 110px; margin: 0 auto 16px; border-radius: 50%; overflow: hidden; border: 3px solid #eaeaea;">
                        <img src="img/mm.jpeg" alt="Musbahu Muhammad" style="width: 100%; height: 100%; object-fit: cover;">
                    </div>
                    <div class="member-info">
                        <h3 style="margin-bottom: 6px; font-size: 1.15rem;">Musbahu Muhammad</h3>
                        <p style="color: #666; font-size: 0.98rem; margin-bottom: 10px;">Strategy and Partnership Director</p>
                    </div>
                </div>

                <div class="team-member" style="background: #212121; border-radius: 12px; box-shadow: 0 2px 12px rgb(226 132 8); padding: 24px 18px; max-width: 260px; text-align: center; flex: 1 1 220px;">
                    <div class="member-image" style="width: 110px; height: 110px; margin: 0 auto 16px; border-radius: 50%; overflow: hidden; border: 3px solid #eaeaea;">
                        <img src="img/placeholder.jpg" alt="Muhammad Isah Dogo" style="width: 100%; height: 100%; object-fit: cover;">
                    </div>
                    <div class="member-info">
                        <h3 style="margin-bottom: 6px; font-size: 1.15rem;">Muhammad Isah Dogo</h3>
                        <p style="color: #666; font-size: 0.98rem; margin-bottom: 10px;">Finance Director</p>
                    </div>
                </div>

                <div class="team-member" style="background: #212121; border-radius: 12px; box-shadow: 0 2px 12px rgb(226 132 8); padding: 24px 18px; max-width: 260px; text-align: center; flex: 1 1 220px;">
                    <div class="member-image" style="width: 110px; height: 110px; margin: 0 auto 16px; border-radius: 50%; overflow: hidden; border: 3px solid #eaeaea;">
                        <img src="img/com.jpeg" alt="Ibrahim MaiBulangu" style="width: 100%; height: 100%; object-fit: cover;">
                    </div>
                    <div class="member-info">
                        <h3 style="margin-bottom: 6px; font-size: 1.15rem;">Ibrahim MaiBulangu</h3>
                        <p style="color: #666; font-size: 0.98rem; margin-bottom: 10px;">Communication and Public Engagement Director</p>
                    </div>
                </div>

                <!-- Additional Team Members -->
                <div class="team-member" style="background: #212121; border-radius: 12px; box-shadow: 0 2px 12px rgb(226 132 8); padding: 24px 18px; max-width: 260px; text-align: center; flex: 1 1 220px;">
                    <div class="member-image" style="width: 110px; height: 110px; margin: 0 auto 16px; border-radius: 50%; overflow: hidden; border: 3px solid #eaeaea;">
                        <img src="img/placeholder.jpg" alt="Muhammad Shehu" style="width: 100%; height: 100%; object-fit: cover;">
                    </div>
                    <div class="member-info">
                        <h3 style="margin-bottom: 6px; font-size: 1.15rem;">Muhammad Shehu</h3>
                        <p style="color: #666; font-size: 0.98rem; margin-bottom: 10px;">Community Engagement and Mobilization Director</p>
                    </div>
                </div>

                <div class="team-member" style="background: #212121; border-radius: 12px; box-shadow: 0 2px 12px rgb(226 132 8); padding: 24px 18px; max-width: 260px; text-align: center; flex: 1 1 220px;">
                    <div class="member-image" style="width: 110px; height: 110px; margin: 0 auto 16px; border-radius: 50%; overflow: hidden; border: 3px solid #eaeaea;">
                        <img src="img/placeholder.jpg" alt="Mahmud Abdullahi" style="width: 100%; height: 100%; object-fit: cover;">
                    </div>
                    <div class="member-info">
                        <h3 style="margin-bottom: 6px; font-size: 1.15rem;">Mahmud Abdullahi</h3>
                        <p style="color: #666; font-size: 0.98rem; margin-bottom: 10px;">Inclusion and Special Need Director</p>
                    </div>
                </div>

                <div class="team-member" style="background: #212121; border-radius: 12px; box-shadow: 0 2px 12px rgb(226 132 8); padding: 24px 18px; max-width: 260px; text-align: center; flex: 1 1 220px;">
                    <div class="member-image" style="width: 110px; height: 110px; margin: 0 auto 16px; border-radius: 50%; overflow: hidden; border: 3px solid #eaeaea;">
                        <img src="img/placeholder.jpg" alt="Amina Abdulkadir" style="width: 100%; height: 100%; object-fit: cover;">
                    </div>
                    <div class="member-info">
                        <h3 style="margin-bottom: 6px; font-size: 1.15rem;">Amina Abdulkadir</h3>
                        <p style="color: #666; font-size: 0.98rem; margin-bottom: 10px;">Women and Gender Director</p>
                    </div>
                </div>

                <div class="team-member" style="background: #212121; border-radius: 12px; box-shadow: 0 2px 12px rgb(226 132 8); padding: 24px 18px; max-width: 260px; text-align: center; flex: 1 1 220px;">
                    <div class="member-image" style="width: 110px; height: 110px; margin: 0 auto 16px; border-radius: 50%; overflow: hidden; border: 3px solid #eaeaea;">
                        <img src="img/12.jpeg" alt="Umar Muhammad" style="width: 100%; height: 100%; object-fit: cover;">
                    </div>
                    <div class="member-info">
                        <h3 style="margin-bottom: 6px; font-size: 1.15rem;">Umar Muhammad</h3>
                        <p style="color: #666; font-size: 0.98rem; margin-bottom: 10px;">Technical Director</p>
                    </div>
                </div>

                <div class="team-member" style="background: #212121; border-radius: 12px; box-shadow: 0 2px 12px rgb(226 132 8); padding: 24px 18px; max-width: 260px; text-align: center; flex: 1 1 220px;">
                    <div class="member-image" style="width: 110px; height: 110px; margin: 0 auto 16px; border-radius: 50%; overflow: hidden; border: 3px solid #eaeaea;">
                        <img src="img/13.jpeg" alt="Amadu Abdu" style="width: 100%; height: 100%; object-fit: cover;">
                    </div>
                    <div class="member-info">
                        <h3 style="margin-bottom: 6px; font-size: 1.15rem;">Amadu Abdu</h3>
                        <p style="color: #666; font-size: 0.98rem; margin-bottom: 10px;">Transport & Logistics Director</p>
                    </div>
                </div>

                <div class="team-member" style="background: #212121; border-radius: 12px; box-shadow: 0 2px 12px rgb(226 132 8); padding: 24px 18px; max-width: 260px; text-align: center; flex: 1 1 220px;">
                    <div class="member-image" style="width: 110px; height: 110px; margin: 0 auto 16px; border-radius: 50%; overflow: hidden; border: 3px solid #eaeaea;">
                        <img src="img/14.jpeg" alt="Sulaiman Ahmad Faggo" style="width: 100%; height: 100%; object-fit: cover;">
                    </div>
                    <div class="member-info">
                        <h3 style="margin-bottom: 6px; font-size: 1.15rem;">Sulaiman Ahmad Faggo</h3>
                        <p style="color: #666; font-size: 0.98rem; margin-bottom: 10px;">Welfare Director</p>
                    </div>
                </div>

                <div class="team-member" style="background: #212121; border-radius: 12px; box-shadow: 0 2px 12px rgb(226 132 8); padding: 24px 18px; max-width: 260px; text-align: center; flex: 1 1 220px;">
                    <div class="member-image" style="width: 110px; height: 110px; margin: 0 auto 16px; border-radius: 50%; overflow: hidden; border: 3px solid #eaeaea;">
                        <img src="img/15.jpeg" alt="Usman Rufa'i Jama'are" style="width: 100%; height: 100%; object-fit: cover;">
                    </div>
                    <div class="member-info">
                        <h3 style="margin-bottom: 6px; font-size: 1.15rem;">Usman Rufa'i Jama'are</h3>
                        <p style="color: #666; font-size: 0.98rem; margin-bottom: 10px;">Special Duties Officer</p>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- Get Involved Section -->
    <!-- <section class="get-involved" id="get-involved">
        <div class="container">
            <h2 class="fade-in">Get Involved</h2>
            <div class="involved-container fade-in" style="animation-delay: 0.2s;">
                <div class="involved-options">
                    <div class="involved-card">
                        <h3>Become a Volunteer</h3>
                        <p>Join our team of dedicated volunteers working to make a difference in Katagum communities.
                        </p>
                    </div>
                    <div class="involved-card">
                        <h3>Apply for Fellowship</h3>
                        <p>Applications open for the next cohort of our Mallam Zaki Leadership Fellowship.</p>
                    </div>
                    <div class="involved-card">
                        <h3>Partner With Us</h3>
                        <p>Organizations and businesses can collaborate with us on youth programs.</p>
                    </div>
                </div>
                <div class="involved-form">
                    <form id="volunteerForm">
                        <div class="form-group">
                            <label for="name">Full Name</label>
                            <input type="text" id="name" name="name" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email Address</label>
                            <input type="email" id="email" name="email" required>
                        </div>
                        <div class="form-group">
                            <label for="phone">Phone Number</label>
                            <input type="tel" id="phone" name="phone" required>
                        </div>
                        <div class="form-group">
                            <label for="interest">Area of Interest</label>
                            <select id="interest" name="interest" required>
                                <option value="">Select an option</option>
                                <option value="volunteer">General Volunteer</option>
                                <option value="fellowship">Leadership Fellowship</option>
                                <option value="climate">Climate Action</option>
                                <option value="education">Education Support</option>
                                <option value="other">Other</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="message">Why do you want to join KYL?</label>
                            <textarea id="message" name="message" required></textarea>
                        </div>
                        <button type="submit" class="btn">Submit Application</button>
                    </form>
                </div>
            </div>
        </div>
    </section> -->

    <!-- Partners Section -->
    <section class="partners">
        <div class="container">
            <h2 class="fade-in">Our Partners</h2>

            <!-- Horizontal auto scroller -->
            <div class="partners-scroller fade-in" style="animation-delay: 0.2s;">
                <div class="partners-track">
                    <img src="img/wunti.png" alt="Wunti Al-Khair Foundation" class="partner-logo">
                    <img src="img/ideas.png" alt="Ideas & Data Academy" class="partner-logo">
                    <img src="img/logo.png" alt="KYL" class="partner-logo">
                    <img src="img/jamilu.jpeg" alt="Partner 4" class="partner-logo">
                    <img src="img/malamzaki.jpeg" alt="Partner 5" class="partner-logo">
                    <img src="img/nyff.jpeg" alt="Partner 6" class="partner-logo">
                    <img src="img/first-lady-Hajiya-Aisha-Bala-Mohammed.jpg" alt="Partner 7" class="partner-logo">
                    <img src="img/placeholder.jpg" alt="Partner 8" class="partner-logo">

                    <!-- duplicate set for seamless looping -->
                    <img src="img/wunti.png" alt="Wunti Al-Khair Foundation" class="partner-logo">
                    <img src="img/ideas.png" alt="Ideas & Data Academy" class="partner-logo">
                    <img src="img/logo.png" alt="KYL" class="partner-logo">
                    <img src="img/jamilu.jpeg" alt="Partner 4" class="partner-logo">
                    <img src="img/malamzaki.jpeg" alt="Partner 5" class="partner-logo">
                    <img src="img/nyff.jpeg" alt="Partner 6" class="partner-logo">
                    <img src="img/first-lady-Hajiya-Aisha-Bala-Mohammed.jpg" alt="Partner 7" class="partner-logo">
                    <img src="img/placeholder.jpg" alt="Partner 8" class="partner-logo">
                </div>
            </div>

            <p class="fade-in" style="text-align: center; margin-top: 30px; animation-delay: 0.4s;">We're grateful for
                the support of our partners who share our vision for youth empowerment in Katagum.</p>
        </div>
    </section>

    <!-- Contact Section -->
    <section class="contact" id="contact">
        <div class="container">
            <h2 class="fade-in">Contact Us</h2>
            <div class="contact-container fade-in" style="animation-delay: 0.2s;">
                <div class="contact-info">
                    <div class="contact-details">
                        <div class="contact-item">
                            <div class="contact-icon">
                                <i class="fas fa-map-marker-alt"></i>
                            </div>
                            <div>
                                <h4>Our Office</h4>
                                <p>No. 12 Zaki Road, Azare<br>Katagum Zone, Bauchi State</p>
                            </div>
                        </div>
                        <div class="contact-item">
                            <div class="contact-icon">
                                <i class="fas fa-phone-alt"></i>
                            </div>
                            <div>
                                <h4>Call Us</h4>
                                <p>+234 814 395 3391</p>
                            </div>
                        </div>
                        <div class="contact-item">
                            <div class="contact-icon">
                                <i class="fas fa-envelope"></i>
                            </div>
                            <div>
                                <h4>Email Us</h4>
                                <p>katagumyouthleague@gmail.com</p>
                            </div>
                        </div>
                    </div>
                    <div class="social-links">
                        <a href="https://instagram.com/katagumyouthleague" target="_blank"><i
                                class="fab fa-instagram"></i></a>
                        <a href="https://twitter.com/KTGyouthleague" target="_blank"><i class="fab fa-twitter"></i></a>
                        <a href="https://web.facebook.com/p/Katagum-Youth-League-100079845590316/?_rdc=1&_rdr#"
                            target="_blank"><i class="fab fa-facebook-f"></i></a>
                        <a href="https://www.linkedin.com/company/katagum-youth-league?trk=public_post_feed-actor-image"
                            target="_blank"><i class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>
                <div class="contact-form">
                    <form id="contactForm">
                        <div class="form-group">
                            <label for="contact-name">Name</label>
                            <input type="text" id="contact-name" name="name" required>
                        </div>
                        <div class="form-group">
                            <label for="contact-email">Email</label>
                            <input type="email" id="contact-email" name="email" required>
                        </div>
                        <div class="form-group">
                            <label for="contact-subject">Subject</label>
                            <input type="text" id="contact-subject" name="subject" required>
                        </div>
                        <div class="form-group">
                            <label for="contact-message">Message</label>
                            <textarea id="contact-message" name="message" required></textarea>
                        </div>
                        <button type="submit" class="btn">Send Message</button>
                    </form>
                </div>
            </div>
        </div>
    </section>


    <!-- Footer -->
    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="footer-logo">
                <img src="img/logo.png" alt="Katagum Youth League Logo">
            </div>
            <div class="footer-links">
                <a href="#about">About</a>
                <a href="#aims">Aims</a>
                <a href="#achievements">Programs</a>
                <a href="#timeline">Events</a>
                <a href="#team">Team</a>
                <a href="#get-involved">Get Involved</a>
                <a href="#contact">Contact</a>
                <a href="gallery.html">Gallery</a>
            </div>
            <p class="copyright">© 2024 Katagum Youth League. All Rights Reserved.</p>
            <!-- <p class="copyright">© Innovation Company</p> -->
        </div>
    </footer>
</body>

</html>

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

    // Aims Toggle
    const aimsToggleBtns = document.querySelectorAll('.aims-toggle button');

    aimsToggleBtns.forEach(btn => {
        btn.addEventListener('click', () => {
            // Remove active class from all buttons and content
            document.querySelector('.aims-toggle button.active').classList.remove('active');
            document.querySelector('.aims-content.active').classList.remove('active');

            // Add active class to clicked button and corresponding content
            btn.classList.add('active');
            const lang = btn.getAttribute('data-lang');
            document.getElementById(`${lang}-aims`).classList.add('active');
        });
    });

    // Scroll Animation
    const fadeElements = document.querySelectorAll('.fade-in');

    const fadeInOnScroll = () => {
        fadeElements.forEach(element => {
            const elementTop = element.getBoundingClientRect().top;
            const windowHeight = window.innerHeight;

            if (elementTop < windowHeight - 100) {
                element.style.opacity = '1';
            }
        });
    };

    window.addEventListener('scroll', fadeInOnScroll);
    window.addEventListener('load', fadeInOnScroll);

    // Form Submission
    const volunteerForm = document.getElementById('volunteerForm');
    const contactForm = document.getElementById('contactForm');

    // Google Apps Script Web App URL
    const GOOGLE_SHEET_URL = 'https://script.google.com/macros/s/AKfycbwOjUiss76xxbYIIDOe8yaRNBgkfJYyTxR2es1yH7BT702HDXLrjCaS1GobxIrZCvt-0Q/exec';
    // New endpoint for contact form (replace with your Apps Script URL for sending email)
    const CONTACT_FORM_URL = 'https://script.google.com/macros/s/AKfycbw3ackhF2ltd7cJ_E9SV3WTGyHdBc7A6am48dNImsmJRVxa1eP9dYtvXvcnmoGs-54Y/exec';

    volunteerForm.addEventListener('submit', async (e) => {
        e.preventDefault();
        const submitBtn = volunteerForm.querySelector('button[type="submit"]');
        const originalText = submitBtn.textContent;
        submitBtn.textContent = 'Loading...';
        submitBtn.disabled = true;
        const formData = new FormData(volunteerForm);
        try {
            const response = await fetch(GOOGLE_SHEET_URL, {
                method: 'POST',
                body: formData
            });
            let result;
            try {
                result = await response.json();
            } catch {
                result = await response.text();
            }
            if (response.ok && (result.result === "success" || (typeof result === "string" && result.indexOf("success") !== -1))) {
                alert('Thank you for your interest in KYL! We will contact you soon.');
                volunteerForm.reset();
            } else if (response.status === 200 && typeof result === "string" && result.trim() === "") {
                alert('Your application was received, but there was a technical issue with the confirmation. Please check your email for updates.');
                volunteerForm.reset();
            } else {
                alert('There was an error submitting your application. Please try again later.');
            }
        } catch (error) {
            alert('Your application was received, but there was a technical issue with the confirmation. Please check your email for updates.');
            volunteerForm.reset();
        } finally {
            submitBtn.textContent = originalText;
            submitBtn.disabled = false;
        }
    });

    // start
    // Modern Katagum Youth League JavaScript
    class ModernKYLWebsite {
        constructor() {
            this.init();
            this.setupEventListeners();
            this.createParticles();
            this.setupIntersectionObserver();
            this.setupScrollEffects();
            this.setupThemeToggle();
        }

        init() {
            // Theme initialization
            const savedTheme = localStorage.getItem('theme') || 'dark';
            document.documentElement.setAttribute('data-theme', savedTheme);

            // Create theme toggle button
            this.createThemeToggle();

            // Initialize smooth scrolling
            this.initSmoothScroll();

            // Initialize mobile menu
            this.initMobileMenu();

            // Initialize countdown
            this.initCountdown();

            // Initialize form handlers
            this.initForms();

            // Add loading animation
            this.addLoadingAnimation();

            // Initialize cursor effects
            this.initCursorEffects();
        }

        createThemeToggle() {
            const themeToggle = document.createElement('button');
            themeToggle.className = 'theme-toggle';
            themeToggle.innerHTML = '<i class="fas fa-sun"></i>';
            themeToggle.setAttribute('aria-label', 'Toggle theme');
            document.body.appendChild(themeToggle);

            // Update icon based on current theme
            this.updateThemeIcon(themeToggle);
        }

        setupThemeToggle() {
            const themeToggle = document.querySelector('.theme-toggle');
            if (!themeToggle) return;

            themeToggle.addEventListener('click', () => {
                const currentTheme = document.documentElement.getAttribute('data-theme');
                const newTheme = currentTheme === 'dark' ? 'light' : 'dark';

                // Smooth theme transition
                document.body.style.transition = 'all 0.3s ease';

                document.documentElement.setAttribute('data-theme', newTheme);
                localStorage.setItem('theme', newTheme);

                this.updateThemeIcon(themeToggle);

                // Add ripple effect
                this.createRipple(themeToggle, event);

                setTimeout(() => {
                    document.body.style.transition = '';
                }, 300);
            });
        }

        updateThemeIcon(toggle) {
            const currentTheme = document.documentElement.getAttribute('data-theme');
            const icon = toggle.querySelector('i');

            if (currentTheme === 'dark') {
                icon.className = 'fas fa-sun';
            } else {
                icon.className = 'fas fa-moon';
            }
        }

        createRipple(element, event) {
            const ripple = document.createElement('span');
            const rect = element.getBoundingClientRect();
            const size = Math.max(rect.width, rect.height);
            const x = event.clientX - rect.left - size / 2;
            const y = event.clientY - rect.top - size / 2;

            ripple.style.cssText = `
            position: absolute;
            width: ${size}px;
            height: ${size}px;
            left: ${x}px;
            top: ${y}px;
            background: radial-gradient(circle, rgba(255,255,255,0.3) 0%, transparent 70%);
            border-radius: 50%;
            transform: scale(0);
            animation: ripple 0.6s linear;
            pointer-events: none;
        `;

            element.style.position = 'relative';
            element.style.overflow = 'hidden';
            element.appendChild(ripple);

            setTimeout(() => {
                ripple.remove();
            }, 600);
        }

        createParticles() {
            const particleContainer = document.createElement('div');
            particleContainer.className = 'particles-container';
            particleContainer.style.cssText = `
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            z-index: -1;
            overflow: hidden;
        `;
            document.body.appendChild(particleContainer);

            // Create floating particles
            for (let i = 0; i < 50; i++) {
                this.createParticle(particleContainer);
            }

            // Create mouse follower particles
            this.setupMouseParticles();
        }

        createParticle(container) {
            const particle = document.createElement('div');
            const size = Math.random() * 4 + 1;
            const left = Math.random() * window.innerWidth;
            const animationDuration = Math.random() * 20 + 10;
            const opacity = Math.random() * 0.5 + 0.1;

            particle.style.cssText = `
            position: absolute;
            width: ${size}px;
            height: ${size}px;
            background: linear-gradient(45deg, #f59e0b, #3b82f6);
            border-radius: 50%;
            left: ${left}px;
            top: 100vh;
            opacity: ${opacity};
            animation: floatUp ${animationDuration}s linear infinite;
            box-shadow: 0 0 ${size * 2}px rgba(245, 158, 11, 0.3);
        `;

            container.appendChild(particle);

            // Remove particle when animation completes
            setTimeout(() => {
                if (particle.parentNode) {
                    particle.remove();
                    this.createParticle(container); // Create new particle
                }
            }, animationDuration * 1000);
        }

        setupMouseParticles() {
            let mouseX = 0,
                mouseY = 0;

            document.addEventListener('mousemove', (e) => {
                mouseX = e.clientX;
                mouseY = e.clientY;

                // Throttle particle creation
                if (Math.random() > 0.9) {
                    this.createMouseParticle(mouseX, mouseY);
                }
            });
        }

        createMouseParticle(x, y) {
            const particle = document.createElement('div');
            const size = Math.random() * 3 + 1;

            particle.style.cssText = `
            position: fixed;
            width: ${size}px;
            height: ${size}px;
            background: radial-gradient(circle, #f59e0b, transparent);
            border-radius: 50%;
            left: ${x}px;
            top: ${y}px;
            pointer-events: none;
            z-index: 1000;
            animation: mouseParticle 1s ease-out forwards;
        `;

            document.body.appendChild(particle);

            setTimeout(() => {
                if (particle.parentNode) {
                    particle.remove();
                }
            }, 1000);
        }

        setupIntersectionObserver() {
            const observerOptions = {
                root: null,
                rootMargin: '0px',
                threshold: 0.1
            };

            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('animate-in');

                        // Special animations for specific elements
                        if (entry.target.classList.contains('achievement-number')) {
                            this.animateNumber(entry.target);
                        }

                        if (entry.target.classList.contains('progress-bar')) {
                            this.animateProgressBar(entry.target);
                        }
                    }
                });
            }, observerOptions);

            // Observe elements with animation classes
            const animatedElements = document.querySelectorAll(
                '.fade-in, .glass-card, .achievement-card, .program-card, .team-member, .timeline-item, .involved-card'
            );

            animatedElements.forEach(el => observer.observe(el));
        }

        animateNumber(element) {
            const finalNumber = parseInt(element.textContent);
            let currentNumber = 0;
            const increment = finalNumber / 50;

            const updateNumber = () => {
                currentNumber += increment;
                if (currentNumber < finalNumber) {
                    element.textContent = Math.ceil(currentNumber);
                    requestAnimationFrame(updateNumber);
                } else {
                    element.textContent = finalNumber + (element.textContent.includes('+') ? '+' : '');
                }
            };

            updateNumber();
        }

        animateProgressBar(element) {
            const progress = element.dataset.progress || '100';
            element.style.width = '0%';

            setTimeout(() => {
                element.style.width = progress + '%';
            }, 500);
        }

        setupScrollEffects() {
            let ticking = false;

            const updateScrollEffects = () => {
                const scrollY = window.pageYOffset;
                const windowHeight = window.innerHeight;

                // Parallax effect for hero background
                const hero = document.querySelector('.hero');
                if (hero) {
                    const speed = scrollY * 0.5;
                    hero.style.transform = `translateY(${speed}px)`;
                }

                // Update header on scroll
                const header = document.getElementById('header');
                if (header) {
                    if (scrollY > 100) {
                        header.classList.add('scrolled');
                    } else {
                        header.classList.remove('scrolled');
                    }
                }

                // Floating elements
                document.querySelectorAll('[data-float]').forEach(element => {
                    const speed = element.dataset.float || 0.1;
                    const yPos = -(scrollY * speed);
                    element.style.transform = `translateY(${yPos}px)`;
                });

                ticking = false;
            };

            const requestTick = () => {
                if (!ticking) {
                    requestAnimationFrame(updateScrollEffects);
                    ticking = true;
                }
            };

            window.addEventListener('scroll', requestTick, {
                passive: true
            });
        }

        initSmoothScroll() {
            // Smooth scroll for anchor links
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', (e) => {
                    e.preventDefault();
                    const target = document.querySelector(anchor.getAttribute('href'));

                    if (target) {
                        const headerHeight = document.getElementById('header')?.offsetHeight || 0;
                        const targetPosition = target.offsetTop - headerHeight - 20;

                        window.scrollTo({
                            top: targetPosition,
                            behavior: 'smooth'
                        });
                    }
                });
            });
        }

        initMobileMenu() {
            const mobileMenuBtn = document.getElementById('mobileMenuBtn');
            const mainNav = document.getElementById('mainNav');

            if (mobileMenuBtn && mainNav) {
                mobileMenuBtn.addEventListener('click', () => {
                    mainNav.classList.toggle('active');

                    const isActive = mainNav.classList.contains('active');
                    mobileMenuBtn.innerHTML = isActive ?
                        '<i class="fas fa-times"></i>' :
                        '<i class="fas fa-bars"></i>';

                    // Animate menu items
                    if (isActive) {
                        this.animateMenuItems();
                    }

                    // Prevent body scroll when menu is open
                    document.body.style.overflow = isActive ? 'hidden' : '';
                });

                // Close menu when clicking nav links
                const navLinks = document.querySelectorAll('nav ul li a');
                navLinks.forEach(link => {
                    link.addEventListener('click', () => {
                        mainNav.classList.remove('active');
                        mobileMenuBtn.innerHTML = '<i class="fas fa-bars"></i>';
                        document.body.style.overflow = '';
                    });
                });

                // Close menu when clicking outside
                document.addEventListener('click', (e) => {
                    if (!mainNav.contains(e.target) && !mobileMenuBtn.contains(e.target)) {
                        mainNav.classList.remove('active');
                        mobileMenuBtn.innerHTML = '<i class="fas fa-bars"></i>';
                        document.body.style.overflow = '';
                    }
                });
            }
        }

        animateMenuItems() {
            const menuItems = document.querySelectorAll('nav ul li');
            menuItems.forEach((item, index) => {
                item.style.animation = `slideInRight 0.3s ease-out ${index * 0.1}s both`;
            });
        }

        initCountdown() {
            const countdownCard = document.getElementById('countdown-card');
            if (!countdownCard) return;

            // You can replace this with dynamic data from your PHP
            const targetDate = new Date('2025-08-03T09:00:00').getTime();

            const updateCountdown = () => {
                const now = new Date().getTime();
                const distance = targetDate - now;

                if (distance > 0) {
                    const days = Math.floor(distance / (1000 * 60 * 60 * 24));
                    const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                    const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                    const seconds = Math.floor((distance % (1000 * 60)) / 1000);

                    this.updateCountdownDisplay('days', days);
                    this.updateCountdownDisplay('hours', hours);
                    this.updateCountdownDisplay('minutes', minutes);
                    this.updateCountdownDisplay('seconds', seconds);

                    countdownCard.style.display = 'block';
                } else {
                    countdownCard.style.display = 'none';
                }
            };

            updateCountdown();
            setInterval(updateCountdown, 1000);
        }

        updateCountdownDisplay(unit, value) {
            const element = document.getElementById(unit);
            if (!element) return;
            element.textContent = String(value).padStart(2, '0');
        }
    } // end of class ModernKYLWebsite

    // Initialize the site
    document.addEventListener('DOMContentLoaded', () => {
        new ModernKYLWebsite();
    });

    // end

    // contactForm.addEventListener('submit', async (e) => {
    //     e.preventDefault();
    //     const submitBtn = contactForm.querySelector('button[type="submit"]');
    //     const originalText = submitBtn.textContent;
    //     submitBtn.textContent = 'Loading...';
    //     submitBtn.disabled = true;
    //     const formData = new FormData(contactForm);
    //     try {
    //         const response = await fetch(CONTACT_FORM_URL, {
    //             method: 'POST',
    //             body: formData
    //         });
    //         if (response.ok) {
    //             alert('Your message has been sent. We will get back to you shortly.');
    //             contactForm.reset();
    //         } else {
    //             alert('There was an error sending your message. Please try again later.');
    //         }
    //     } catch (error) {
    //         alert('There was an error sending your message. Please try again later.');
    //     } finally {
    //         submitBtn.textContent = originalText;
    //         submitBtn.disabled = false;
    //     }
    // });

    // // Close mobile menu when clicking a link
    // const navLinks = document.querySelectorAll('nav ul li a');

    // navLinks.forEach(link => {
    //     link.addEventListener('click', () => {
    //         if (mainNav.classList.contains('active')) {
    //             mainNav.classList.remove('active');
    //             mobileMenuBtn.innerHTML = '<i class="fas fa-bars"></i>';
    //         }
    //     });
    // });

    // // Countdown Timer
    // const countdownDate = new Date('2025-08-03T09:00:00').getTime();

    // function updateCountdown() {
    //     const now = new Date().getTime();
    //     const distance = countdownDate - now;

    //     const days = Math.floor(distance / (1000 * 60 * 60 * 24));
    //     const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    //     const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
    //     const seconds = Math.floor((distance % (1000 * 60)) / 1000);

    //     document.getElementById('days').textContent = String(days).padStart(2, '0');
    //     document.getElementById('hours').textContent = String(hours).padStart(2, '0');
    //     document.getElementById('minutes').textContent = String(minutes).padStart(2, '0');
    //     document.getElementById('seconds').textContent = String(seconds).padStart(2, '0');

    //     if (distance < 0) {
    //         clearInterval(countdownInterval);
    //         document.querySelector('.countdown-card').style.display = 'none';
    //     }
    // }

    // const countdownInterval = setInterval(updateCountdown, 1000);
    // updateCountdown();
</script>
</body>

</html>