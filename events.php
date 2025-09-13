<?php
require_once(__DIR__ . '/config/database.php');

// Fetch upcoming events (today and future) ordered by date
$stmt = $pdo->prepare("SELECT * FROM events WHERE event_date >= CURDATE() AND status = 'active' ORDER BY event_date ASC");
$stmt->execute();
$events = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="icon" type="image/x-icon" href="img/logo.png">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="description" content="Browse upcoming events and programs at Katagum Youth League. Join our community activities and development initiatives.">
    <title>Upcoming Events - Katagum Youth League (KYL)</title>
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
                    <li><a href="#achievements">Programs</a></li>
                    <li><a href="gallery.html">Gallery</a></li>
                    <li><a href="#contact">Contact</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <section class="events-hero" style="background:linear-gradient(rgba(0,0,0,0.7),rgba(0,0,0,0.7)),url('img/kyl.jpg') center/cover;min-height:40vh;display:flex;align-items:center;justify-content:center;margin-top:70px;text-align:center;">
        <div class="container">
            <h1 style="font-size:clamp(2.5rem,5vw,4rem);margin-bottom:1rem;color:#fff;-webkit-text-fill-color:white;">Upcoming Events</h1>
            <p style="font-size:1.2rem;color:rgba(255,255,255,0.9);max-width:800px;margin:0 auto;">Join us at our upcoming programs and community activities. Be part of the change in Katagum.</p>
        </div>
    </section>

    <main class="container events-page" style="padding:60px 20px;">
        <div class="events-grid" style="margin-top:20px;">
            <?php
            // If DB returned no events, show demo static events
            if (empty($events)) {
                $demo = [
                    ['id' => 'demo-1', 'title' => 'Katagum Colloquium 3.0', 'event_date' => '2025-11-10', 'location' => 'Main Hall, Katagum', 'description' => 'Annual youth forum bringing together young leaders, policymakers, and experts to discuss opportunities and challenges facing youth.'],
                    ['id' => 'demo-2', 'title' => 'Mallam Zaki Fellowship Launch', 'event_date' => '2025-09-25', 'location' => 'Conference Center', 'description' => 'Launch of the next Mallam Zaki Fellowship cohort with workshops and networking sessions.'],
                    ['id' => 'demo-3', 'title' => 'Youth Climate Action Day', 'event_date' => '2025-10-05', 'location' => 'City Park', 'description' => 'Community clean-up and tree-planting to raise environmental awareness among youth.'],
                ];
                foreach ($demo as $ev):
            ?>
                <article class="event-card demo">
                    <div class="event-card-body">
                        <div class="event-date"><?php echo date('M j, Y', strtotime($ev['event_date'])); ?></div>
                        <h3><?php echo htmlspecialchars($ev['title']); ?></h3>
                        <p class="muted"><?php echo htmlspecialchars($ev['location']); ?></p>
                        <p><?php echo nl2br(htmlspecialchars($ev['description'])); ?></p>
                        <a class="btn" href="event.php?id=<?php echo urlencode($ev['id']); ?>">View Details</a>
                    </div>
                </article>
            <?php
                endforeach;
            } else {
                foreach ($events as $ev):
            ?>
                <article class="event-card">
                    <div class="event-card-body">
                        <div class="event-date"><?php echo date('M j, Y', strtotime($ev['event_date'])); ?></div>
                        <h3><?php echo htmlspecialchars($ev['title']); ?></h3>
                        <p class="muted"><?php echo htmlspecialchars($ev['location']); ?></p>
                        <p><?php echo nl2br(htmlspecialchars(substr($ev['description'], 0, 240))); ?><?php echo strlen($ev['description'])>240? '...':''; ?></p>
                        <a class="btn" href="event.php?id=<?php echo $ev['id']; ?>">View Details</a>
                    </div>
                </article>
            <?php
                endforeach;
            }
            ?>
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
    </script>
</body>
</html>
