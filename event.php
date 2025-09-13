<?php
require_once(__DIR__ . '/config/database.php');

// support demo ids (string like demo-1) or numeric DB ids
if (!isset($_GET['id'])) {
    header('Location: events.php');
    exit();
}

$rawId = $_GET['id'];
if (strpos($rawId, 'demo-') === 0) {
    $demoMap = [
        'demo-1' => [
            'id' => 'demo-1',
            'title' => 'Katagum Colloquium 3.0',
            'event_date' => '2025-11-10 09:00:00',
            'end_date' => '2025-11-10 17:00:00',
            'location' => 'Main Hall, Katagum',
            'description' => 'Annual youth forum bringing together young leaders, policymakers, and experts to discuss opportunities and challenges facing youth.',
            'theme' => 'Empowering Youth for Sustainable Development',
            'max_participants' => 200,
            'current_participants' => 145,
            'ticket_price' => 0, // Free event
            'ticket_url' => '#register',
            'image' => 'img/events/colloquium.jpg',
            'speakers' => [
                ['name' => 'Hon. Jamilu Aliyu Mato', 'role' => 'Keynote Speaker'],
                ['name' => 'Dr. Ibrahim Hassan', 'role' => 'Guest Speaker'],
                ['name' => 'Aisha Mohammed', 'role' => 'Youth Advocate']
            ],
            'schedule' => [
                ['time' => '09:00 AM', 'title' => 'Registration & Networking'],
                ['time' => '10:00 AM', 'title' => 'Opening Ceremony'],
                ['time' => '11:00 AM', 'title' => 'Keynote Address'],
                ['time' => '12:30 PM', 'title' => 'Panel Discussion'],
                ['time' => '02:00 PM', 'title' => 'Lunch Break'],
                ['time' => '03:00 PM', 'title' => 'Workshop Sessions'],
                ['time' => '04:30 PM', 'title' => 'Closing Remarks']
            ]
        ],
        'demo-2' => [
            'id' => 'demo-2',
            'title' => 'Mallam Zaki Fellowship Launch',
            'event_date' => '2025-09-25 10:00:00',
            'end_date' => '2025-09-25 15:00:00',
            'location' => 'Conference Center',
            'description' => 'Launch of the next Mallam Zaki Fellowship cohort with workshops and networking sessions.',
            'theme' => 'Building Tomorrow\'s Leaders',
            'max_participants' => 100,
            'current_participants' => 82,
            'ticket_price' => 0,
            'ticket_url' => '#apply',
            'image' => 'img/events/fellowship.jpg',
            'speakers' => [
                ['name' => 'Mallam Zaki Ibrahim', 'role' => 'Program Director'],
                ['name' => 'Prof. Abdullahi Sule', 'role' => 'Academic Director']
            ],
            'schedule' => [
                ['time' => '10:00 AM', 'title' => 'Welcome Address'],
                ['time' => '10:30 AM', 'title' => 'Program Overview'],
                ['time' => '11:30 AM', 'title' => 'Alumni Testimonials'],
                ['time' => '12:30 PM', 'title' => 'Application Process'],
                ['time' => '02:00 PM', 'title' => 'Networking Session']
            ]
        ],
        'demo-3' => [
            'id' => 'demo-3',
            'title' => 'Youth Climate Action Day',
            'event_date' => '2025-10-05 08:00:00',
            'end_date' => '2025-10-05 14:00:00',
            'location' => 'City Park',
            'description' => 'Community clean-up and tree-planting to raise environmental awareness among youth.',
            'theme' => 'Green Future, Clean Katagum',
            'max_participants' => 150,
            'current_participants' => 98,
            'ticket_price' => 0,
            'ticket_url' => '#volunteer',
            'image' => 'img/events/climate.jpg',
            'speakers' => [
                ['name' => 'Dr. Amina Yusuf', 'role' => 'Environmental Scientist'],
                ['name' => 'Ibrahim Suleiman', 'role' => 'Community Leader']
            ],
            'schedule' => [
                ['time' => '08:00 AM', 'title' => 'Assembly and Equipment Distribution'],
                ['time' => '08:30 AM', 'title' => 'Environmental Briefing'],
                ['time' => '09:00 AM', 'title' => 'Clean-up Activity'],
                ['time' => '11:00 AM', 'title' => 'Tree Planting'],
                ['time' => '12:30 PM', 'title' => 'Community Lunch'],
                ['time' => '01:30 PM', 'title' => 'Impact Assessment']
            ]
        ]
    ];
    if (!isset($demoMap[$rawId])) {
        header('Location: events.php');
        exit();
    }
    $ev = $demoMap[$rawId];
} else {
    $id = (int)$rawId;
    if ($id <= 0) { header('Location: events.php'); exit(); }
    $stmt = $pdo->prepare("SELECT * FROM events WHERE id = ? LIMIT 1");
    $stmt->execute([$id]);
    $ev = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$ev) { header('Location: events.php'); exit(); }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="icon" type="image/x-icon" href="img/logo.png">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="description" content="<?php echo htmlspecialchars(substr($ev['description'], 0, 160)); ?>">
    <title><?php echo htmlspecialchars($ev['title']); ?> - Katagum Youth League Event</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="style.css">
    <script src="js/main.js" defer></script>
</head>
<body>
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
                    <li><a href="index.php">Home</a></li>
                    <li><a href="events.php" class="active">Events</a></li>
                    <li><a href="gallery.html">Gallery</a></li>
                    <li><a href="#contact">Contact</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <!-- Event Hero Banner -->
    <section class="event-hero" style="margin-top:70px;min-height:50vh;background:linear-gradient(rgba(0,0,0,0.7),rgba(0,0,0,0.7)),url('<?php echo htmlspecialchars($ev['image'] ?? 'img/kyl.jpg'); ?>') center/cover;display:flex;align-items:center;">
        <div class="container" style="padding:40px 20px;">
            <div class="event-theme" style="color:#d4af37;font-size:1.1rem;font-weight:500;margin-bottom:16px;">
                <?php echo htmlspecialchars($ev['theme'] ?? 'Community Event'); ?>
            </div>
            <h1 style="font-size:clamp(2rem,5vw,3.5rem);margin-bottom:24px;color:#fff;-webkit-text-fill-color:white;">
                <?php echo htmlspecialchars($ev['title']); ?>
            </h1>
            <div class="event-meta" style="display:flex;flex-wrap:wrap;gap:24px;margin-bottom:32px;">
                <div class="meta-item" style="display:flex;align-items:center;gap:8px;color:rgba(255,255,255,0.9);">
                    <i class="fas fa-calendar"></i>
                    <?php echo date('F j, Y', strtotime($ev['event_date'])); ?>
                </div>
                <div class="meta-item" style="display:flex;align-items:center;gap:8px;color:rgba(255,255,255,0.9);">
                    <i class="fas fa-clock"></i>
                    <?php echo date('g:i A', strtotime($ev['event_date'])); ?> - 
                    <?php echo date('g:i A', strtotime($ev['end_date'] ?? $ev['event_date'])); ?>
                </div>
                <div class="meta-item" style="display:flex;align-items:center;gap:8px;color:rgba(255,255,255,0.9);">
                    <i class="fas fa-map-marker-alt"></i>
                    <?php echo htmlspecialchars($ev['location']); ?>
                </div>
            </div>
            <?php if (isset($ev['ticket_url'])): ?>
            <a href="<?php echo htmlspecialchars($ev['ticket_url']); ?>" class="btn" style="font-size:1.1rem;padding:16px 32px;">
                <?php echo $ev['ticket_price'] > 0 ? 'Get Tickets' : 'Register Now'; ?>
            </a>
            <?php endif; ?>
        </div>
    </section>

    <main class="container" style="padding:60px 20px;">
        <div class="event-content" style="display:grid;grid-template-columns:2fr 1fr;gap:40px;max-width:1200px;margin:0 auto;">
            <!-- Main Content -->
            <div class="event-main">
                <!-- Event Description -->
                <div class="glass-card" style="margin-bottom:40px;padding:32px;">
                    <h2 style="font-size:1.5rem;margin-bottom:20px;">About This Event</h2>
                    <div class="event-description" style="line-height:1.8;color:rgba(255,255,255,0.9);">
                        <?php echo nl2br(htmlspecialchars($ev['description'])); ?>
                    </div>
                </div>

                <!-- Event Schedule -->
                <?php if (!empty($ev['schedule'])): ?>
                <div class="glass-card" style="margin-bottom:40px;padding:32px;">
                    <h2 style="font-size:1.5rem;margin-bottom:20px;">Event Schedule</h2>
                    <div class="schedule-list" style="display:flex;flex-direction:column;gap:16px;">
                        <?php foreach ($ev['schedule'] as $item): ?>
                        <div class="schedule-item" style="display:flex;gap:24px;padding:16px;background:rgba(255,255,255,0.03);border-radius:8px;">
                            <div class="time" style="color:#d4af37;font-weight:500;min-width:100px;">
                                <?php echo htmlspecialchars($item['time']); ?>
                            </div>
                            <div class="title" style="color:rgba(255,255,255,0.9);">
                                <?php echo htmlspecialchars($item['title']); ?>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <?php endif; ?>

                <!-- Speakers Section -->
                <?php if (!empty($ev['speakers'])): ?>
                <div class="glass-card" style="padding:32px;">
                    <h2 style="font-size:1.5rem;margin-bottom:20px;">Featured Speakers</h2>
                    <div class="speakers-grid" style="display:grid;grid-template-columns:repeat(auto-fit,minmax(250px,1fr));gap:24px;">
                        <?php foreach ($ev['speakers'] as $speaker): ?>
                        <div class="speaker-card" style="background:rgba(255,255,255,0.03);padding:24px;border-radius:12px;text-align:center;">
                            <div class="speaker-avatar" style="width:80px;height:80px;background:#d4af37;border-radius:50%;margin:0 auto 16px;display:flex;align-items:center;justify-content:center;">
                                <i class="fas fa-user" style="font-size:32px;color:#000;"></i>
                            </div>
                            <h3 style="font-size:1.1rem;margin-bottom:8px;color:#fff;">
                                <?php echo htmlspecialchars($speaker['name']); ?>
                            </h3>
                            <p style="color:rgba(255,255,255,0.7);font-size:0.9rem;">
                                <?php echo htmlspecialchars($speaker['role']); ?>
                            </p>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <?php endif; ?>
            </div>

            <!-- Sidebar -->
            <aside class="event-sidebar">
                <!-- Event Countdown -->
                <div class="glass-card" style="margin-bottom:30px;padding:24px;text-align:center;" id="countdown-container">
                    <h3 style="font-size:1.2rem;margin-bottom:16px;">Event Starts In</h3>
                    <div class="countdown-grid" style="display:grid;grid-template-columns:repeat(4,1fr);gap:8px;">
                        <div class="time-block" style="background:rgba(255,255,255,0.03);padding:12px;border-radius:8px;">
                            <span class="number" id="days" style="font-size:1.5rem;font-weight:700;color:#d4af37;display:block;">-</span>
                            <span class="label" style="font-size:0.8rem;color:rgba(255,255,255,0.7);">Days</span>
                        </div>
                        <div class="time-block" style="background:rgba(255,255,255,0.03);padding:12px;border-radius:8px;">
                            <span class="number" id="hours" style="font-size:1.5rem;font-weight:700;color:#d4af37;display:block;">-</span>
                            <span class="label" style="font-size:0.8rem;color:rgba(255,255,255,0.7);">Hours</span>
                        </div>
                        <div class="time-block" style="background:rgba(255,255,255,0.03);padding:12px;border-radius:8px;">
                            <span class="number" id="minutes" style="font-size:1.5rem;font-weight:700;color:#d4af37;display:block;">-</span>
                            <span class="label" style="font-size:0.8rem;color:rgba(255,255,255,0.7);">Minutes</span>
                        </div>
                        <div class="time-block" style="background:rgba(255,255,255,0.03);padding:12px;border-radius:8px;">
                            <span class="number" id="seconds" style="font-size:1.5rem;font-weight:700;color:#d4af37;display:block;">-</span>
                            <span class="label" style="font-size:0.8rem;color:rgba(255,255,255,0.7);">Seconds</span>
                        </div>
                    </div>
                </div>

                <!-- Registration Status -->
                <div class="glass-card" style="margin-bottom:30px;padding:24px;">
                    <h3 style="font-size:1.2rem;margin-bottom:16px;">Registration Status</h3>
                    <?php if (isset($ev['max_participants'], $ev['current_participants'])): ?>
                    <div class="progress" style="height:8px;background:rgba(255,255,255,0.1);border-radius:4px;margin-bottom:12px;overflow:hidden;">
                        <?php $percentage = min(100, ($ev['current_participants'] / $ev['max_participants']) * 100); ?>
                        <div class="progress-bar" style="width:<?php echo $percentage; ?>%;height:100%;background:linear-gradient(90deg,#d4af37,#b4941f);"></div>
                    </div>
                    <p style="color:rgba(255,255,255,0.9);font-size:0.9rem;margin-bottom:20px;">
                        <?php echo $ev['current_participants']; ?> of <?php echo $ev['max_participants']; ?> spots filled
                    </p>
                    <?php endif; ?>

                    <?php if (isset($ev['ticket_url'])): ?>
                    <a href="<?php echo htmlspecialchars($ev['ticket_url']); ?>" class="btn" style="width:100%;text-align:center;">
                        <?php echo $ev['ticket_price'] > 0 ? 'Get Tickets - ₦'.number_format($ev['ticket_price']) : 'Register Now - Free'; ?>
                    </a>
                    <?php endif; ?>
                </div>

                <!-- Share Event -->
                <div class="glass-card" style="padding:24px;">
                    <h3 style="font-size:1.2rem;margin-bottom:16px;">Share Event</h3>
                    <div class="share-buttons" style="display:flex;gap:12px;">
                        <a href="https://twitter.com/intent/tweet?text=<?php echo urlencode($ev['title']); ?>" target="_blank" class="btn" style="flex:1;padding:12px;display:flex;align-items:center;justify-content:center;gap:8px;">
                            <i class="fab fa-twitter"></i>
                            Tweet
                        </a>
                        <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode('https://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']); ?>" target="_blank" class="btn" style="flex:1;padding:12px;display:flex;align-items:center;justify-content:center;gap:8px;">
                            <i class="fab fa-facebook"></i>
                            Share
                        </a>
                    </div>
                </div>
            </aside>
        </div>

        <div style="text-align:center;margin-top:40px;">
            <a class="btn" href="events.php" style="display:inline-flex;align-items:center;gap:8px;">
                <i class="fas fa-arrow-left"></i>
                Back to Events
            </a>
        </div>
    </main>

    <footer style="margin-top:60px;background:linear-gradient(rgba(0,0,0,0.9),rgba(0,0,0,0.9)),url('img/kyl.jpg') center/cover;border-top:1px solid rgba(255,255,255,0.1);">
        <div class="container" style="padding:40px 20px;">
            <div class="footer-logo">
                <img src="img/logo.png" alt="KYL" style="height:60px;margin-bottom:24px;">
            </div>
            <div class="footer-links" style="margin-bottom:24px;">
                <a href="index.php" style="color:#fff;text-decoration:none;font-weight:500;transition:color 0.3s ease;">Home</a>
                <a href="events.php" style="color:#fff;text-decoration:none;font-weight:500;transition:color 0.3s ease;">Events</a>
                <a href="gallery.html" style="color:#fff;text-decoration:none;font-weight:500;transition:color 0.3s ease;">Gallery</a>
                <a href="#contact" style="color:#fff;text-decoration:none;font-weight:500;transition:color 0.3s ease;">Contact</a>
            </div>
            <p class="copyright" style="color:rgba(255,255,255,0.7);font-size:0.9rem;">© 2024 Katagum Youth League. All rights reserved.</p>
        </div>
    </footer>

    <script>
        // Enable mobile menu toggle
        document.getElementById('mobileMenuBtn').addEventListener('click', function() {
            document.getElementById('mainNav').classList.toggle('active');
            this.classList.toggle('active');
        });

        // Event countdown timer
        function updateCountdown() {
            const eventDate = new Date('<?php echo date('c', strtotime($ev['event_date'])); ?>').getTime();
            const now = new Date().getTime();
            const distance = eventDate - now;

            if (distance < 0) {
                document.getElementById('countdown-container').innerHTML = '<h3 style="font-size:1.2rem;">Event In Progress</h3>';
                return;
            }

            const days = Math.floor(distance / (1000 * 60 * 60 * 24));
            const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            const seconds = Math.floor((distance % (1000 * 60)) / 1000);

            document.getElementById('days').textContent = days;
            document.getElementById('hours').textContent = hours;
            document.getElementById('minutes').textContent = minutes;
            document.getElementById('seconds').textContent = seconds;
        }

        // Update countdown every second
        updateCountdown();
        setInterval(updateCountdown, 1000);
    </script>
</body>
</html>
