<?php
session_start();
require_once('../config/database.php');

if (!isset($_SESSION['admin_id'])) {
    header('Location: index.php');
    exit();
}

// Fetch statistics
$stmt = $pdo->query("SELECT COUNT(*) FROM fellowship_applications");
$applicationsCount = $stmt->fetchColumn();

$stmt = $pdo->query("SELECT COUNT(*) FROM events WHERE event_date > CURRENT_DATE");
$upcomingEventsCount = $stmt->fetchColumn();

$stmt = $pdo->query("SELECT COUNT(*) FROM admins");
$adminsCount = $stmt->fetchColumn();

// Fetch pending applications count for the new card
$stmt = $pdo->query("SELECT COUNT(*) FROM fellowship_applications WHERE status = 'pending'");
$pendingApplicationsCount = $stmt->fetchColumn();

// Fetch recent applications
$recentApplications = $pdo->query("SELECT * FROM fellowship_applications ORDER BY created_at DESC LIMIT 5")->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KYL Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="assets/css/admin.css">
</head>

<body>
    <!-- Sidebar -->
    <div class="sidebar glass-effect">
        <div class="sidebar-brand">
            <img src="../img/logo.png" alt="KYL Logo">
            <span>Admin Panel</span>
        </div>

        <div class="d-flex flex-column flex-grow-1 pt-3">
            <div class="nav flex-column">
                <a href="dashboard.php" class="nav-link active">
                    <i class="fas fa-tachometer-alt"></i>
                    <span>Dashboard</span>
                </a>
                <a href="applications.php" class="nav-link">
                    <i class="fas fa-file-alt"></i>
                    <span>Applications</span>
                </a>
                <a href="events.php" class="nav-link">
                    <i class="fas fa-calendar"></i>
                    <span>Events</span>
                </a>
                <a href="admins.php" class="nav-link">
                    <i class="fas fa-users-cog"></i>
                    <span>Admins</span>
                </a>
                <a href="settings.php" class="nav-link">
                    <i class="fas fa-cog"></i>
                    <span>Settings</span>
                </a>
            </div>
        </div>

        <div class="sidebar-footer">
            <div class="admin-profile">
                <img src="https://ui-avatars.com/api/?name=Admin+User&background=795548&color=fff" alt="Admin">
                <div class="admin-info">
                    <div class="admin-name"><?php echo htmlspecialchars($_SESSION['admin_name']); ?></div>
                    <div class="admin-email">Administrator</div>
                </div>
            </div>
            <div style="margin-top:12px;">
                <a href="logout.php" class="btn btn-outline-light" style="width:100%;">Logout</a>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <!-- Header -->
        <header class="dashboard-header glass-effect">
            <div class="header-left">
                <button class="menu-toggle" id="menuToggle">
                    <i class="fas fa-bars"></i>
                </button>
                <div style="font-size:1.25rem; font-weight:600; color:var(--text-primary);">Dashboard</div>
            </div>

            <div class="header-right">
                <a style="text-decoration:none;" href="events.php"><button class="btn-new">
                        <i class="fas fa-calendar-plus"></i>
                        New Event</button></a>
                <button class="header-action">
                    <i class="fas fa-bell"></i>
                    <span class="notification-badge">3</span>
                </button>
            </div>
        </header>

        <!-- Statistics Cards -->
        <div class="row mb-4">
            <div class="col-md-3 col-sm-6 mb-4">
                <div class="stat-card card-primary animate-fade-in">
                    <h3><?php echo $applicationsCount; ?></h3>
                    <p>Total Applications</p>
                    <i class="fas fa-file-alt icon"></i>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 mb-4">
                <div class="stat-card card-success animate-fade-in">
                    <h3><?php echo $upcomingEventsCount; ?></h3>
                    <p>Upcoming Events</p>
                    <i class="fas fa-calendar icon"></i>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 mb-4">
                <div class="stat-card card-info animate-fade-in">
                    <h3><?php echo $adminsCount; ?></h3>
                    <p>System Admins</p>
                    <i class="fas fa-users-cog icon"></i>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 mb-4">
                <div class="stat-card card-warning animate-fade-in">
                    <h3><?php echo $pendingApplicationsCount; ?></h3>
                    <p>Pending Applications</p>
                    <i class="fas fa-clock icon"></i>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Recent Applications -->
            <div class="col-lg-8 mb-4">
                <div class="recent-section glass-effect">
                    <h5><i class="fas fa-file-alt"></i>Recent Applications</h5>
                    <div class="table-responsive">
                        <table class="table custom-table">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Interest</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($recentApplications as $row): ?>
                                    <tr>
                                        <td><strong><?php echo htmlspecialchars($row['name']); ?></strong></td>
                                        <td><?php echo htmlspecialchars($row['email']); ?></td>
                                        <td><span class="badge bg-light"><?php echo htmlspecialchars($row['interest']); ?></span></td>
                                        <td><?php echo date('M d, Y', strtotime($row['created_at'])); ?></td>
                                        <td>
                                            <a href="view_application.php?id=<?php echo $row['id']; ?>" class="btn btn-action">
                                                <i class="fas fa-eye"></i> View
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="text-center mt-3">
                        <a href="applications.php" class="btn btn-outline-primary">View All Applications</a>
                    </div>
                </div>
            </div>

            <!-- Quick Actions (right column) -->
            <div class="col-lg-4 mb-4">
                <div class="recent-section glass-effect">
                    <h5><i class="fas fa-bolt"></i>Quick Actions</h5>
                    <div class="quick-actions">
                        <a href="applications.php?filter=pending" class="action-btn">
                            <i class="fas fa-tasks"></i>
                            <span>Review Pending</span>
                        </a>
                        <a href="events.php?action=create" class="action-btn">
                            <i class="fas fa-calendar-plus"></i>
                            <span>Create Event</span>
                        </a>
                        <a href="applications.php?export=1" class="action-btn">
                            <i class="fas fa-download"></i>
                            <span>Export Data</span>
                        </a>
                        <a href="settings.php" class="action-btn">
                            <i class="fas fa-cog"></i>
                            <span>System Settings</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Toggle sidebar on mobile
        document.getElementById('menuToggle').addEventListener('click', function() {
            document.querySelector('.sidebar').classList.toggle('open');
        });

        // Simple animation for cards on page load
        document.addEventListener('DOMContentLoaded', function() {
            const cards = document.querySelectorAll('.stat-card');
            cards.forEach((card, index) => {
                card.style.opacity = '0';
                card.style.transform = 'translateY(20px)';

                setTimeout(() => {
                    card.style.transition = 'opacity 0.5s, transform 0.5s';
                    card.style.opacity = '1';
                    card.style.transform = 'translateY(0)';
                }, 100 * index);
            });
        });
    </script>
</body>

</html>