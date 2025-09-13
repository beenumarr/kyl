<?php
session_start();
require_once('../config/database.php');

if (!isset($_SESSION['admin_id'])) {
    header('Location: index.php');
    exit();
}

$profileMsg = '';
$message = '';

// Fetch current admin info
$stmt = $pdo->prepare('SELECT * FROM admins WHERE id = ?');
$stmt->execute([$_SESSION['admin_id']]);
$admin = $stmt->fetch();

// Handle profile update
if (isset($_POST['profile_update'])) {
    $new_name = trim($_POST['admin_name'] ?? '');
    $new_email = trim($_POST['admin_email'] ?? '');
    $new_phone = trim($_POST['admin_phone'] ?? '');
    $new_address = trim($_POST['admin_address'] ?? '');
    $new_about = trim($_POST['admin_about'] ?? '');
    $current_password = $_POST['current_password'] ?? '';
    $new_password = $_POST['new_password'] ?? '';
    $profile_pic = $_FILES['profile_pic'] ?? null;

    // Validate required fields
    if ($new_name === '' || $new_email === '' || $new_phone === '' || $new_address === '') {
        $profileMsg = 'Name, email, phone and address are required.';
    } elseif (!filter_var($new_email, FILTER_VALIDATE_EMAIL)) {
        $profileMsg = 'Invalid email address.';
    } else {
        // Handle password change if requested
        $updatePassword = false;
        if ($new_password !== '') {
            if (!password_verify($current_password, $admin['password'])) {
                $profileMsg = 'Current password is incorrect.';
            } else {
                $updatePassword = true;
            }
        }

        // Handle profile picture upload
        $profile_pic_path = $admin['profile_pic_path'] ?? '';
        if ($profile_pic && $profile_pic['tmp_name']) {
            $ext = strtolower(pathinfo($profile_pic['name'], PATHINFO_EXTENSION));
            if (in_array($ext, ['jpg', 'jpeg', 'png', 'gif'])) {
                $pic_name = 'admin_' . $_SESSION['admin_id'] . '_' . time() . '.' . $ext;
                $dest = __DIR__ . '/profile_pics/' . $pic_name;
                if (move_uploaded_file($profile_pic['tmp_name'], $dest)) {
                    $profile_pic_path = 'profile_pics/' . $pic_name;
                } else {
                    $profileMsg = 'Failed to upload profile picture.';
                }
            } else {
                $profileMsg = 'Invalid image format.';
            }
        }

        if ($profileMsg === '') {
            if ($updatePassword) {
                $new_hash = password_hash($new_password, PASSWORD_DEFAULT);
                $stmt = $pdo->prepare('UPDATE admins SET name=?, email=?, phone=?, address=?, about=?, password=?, profile_pic_path=? WHERE id=?');
                $stmt->execute([$new_name, $new_email, $new_phone, $new_address, $new_about, $new_hash, $profile_pic_path, $_SESSION['admin_id']]);
            } else {
                $stmt = $pdo->prepare('UPDATE admins SET name=?, email=?, phone=?, address=?, about=?, profile_pic_path=? WHERE id=?');
                $stmt->execute([$new_name, $new_email, $new_phone, $new_address, $new_about, $profile_pic_path, $_SESSION['admin_id']]);
            }
            $_SESSION['admin_name'] = $new_name;
            $profileMsg = 'Profile updated successfully.';
            // Refresh admin info
            $stmt = $pdo->prepare('SELECT * FROM admins WHERE id = ?');
            $stmt->execute([$_SESSION['admin_id']]);
            $admin = $stmt->fetch();
        }
    }
}

// Removed site settings handling - personal info is managed via profile update above.

// Simple page using the admin layout style
// Render page using same layout/colors as dashboard.php so settings matches
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Settings - KYL Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="assets/css/admin.css">
</head>

<body>
    <div class="container-fluid">
       <div class="sidebar glass-effect">
        <div class="sidebar-brand">
            <img src="../img/logo.png" alt="KYL Logo">
            <span>Admin Panel</span>
        </div>
        
        <div class="d-flex flex-column flex-grow-1 pt-3">
            <div class="nav flex-column">
                <a href="dashboard.php" class="nav-link">
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
                <a href="settings.php" class="nav-link active">
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
        <div class="main-content px-4 py-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2>Settings</h2>
                <div class="text-muted">Welcome, <?php echo htmlspecialchars($_SESSION['admin_name']); ?></div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="recent-section">
                        <h5>My Profile</h5>
                        <?php if ($profileMsg): ?>
                            <div class="alert alert-info"><?= htmlspecialchars($profileMsg) ?></div>
                        <?php endif; ?>
                        <form method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="profile_update" value="1">
                            <div class="mb-3 text-center">
                                <?php if (!empty($admin['profile_pic_path']) && file_exists(__DIR__ . '/' . $admin['profile_pic_path'])): ?>
                                    <img src="<?= htmlspecialchars($admin['profile_pic_path']) ?>" alt="Profile Picture" class="rounded-circle mb-2 admin-profile-pic">
                                <?php else: ?>
                                    <img src="../img/placeholder.jpg" alt="Profile Picture" class="rounded-circle mb-2 admin-profile-pic">
                                <?php endif; ?>
                                <div>
                                    <input type="file" name="profile_pic" accept="image/*" class="form-control mt-2">
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Name</label>
                                <input type="text" name="admin_name" class="form-control" required value="<?= htmlspecialchars($admin['name'] ?? '') ?>">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Email</label>
                                <input type="email" name="admin_email" class="form-control" required value="<?= htmlspecialchars($admin['email'] ?? '') ?>">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Phone</label>
                                <input type="text" name="admin_phone" class="form-control" required value="<?= htmlspecialchars($admin['phone'] ?? '') ?>">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Address</label>
                                <input type="text" name="admin_address" class="form-control" required value="<?= htmlspecialchars($admin['address'] ?? '') ?>">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">About</label>
                                <textarea name="admin_about" class="form-control" rows="3"><?= htmlspecialchars($admin['about'] ?? '') ?></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Current Password <span class="text-muted" style="font-size: 0.9em;">(required to change password)</span></label>
                                <input type="password" name="current_password" class="form-control" autocomplete="off">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">New Password</label>
                                <input type="password" name="new_password" class="form-control" autocomplete="off">
                            </div>
                            <button class="btn-new">Update Profile</button>
                        </form>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="recent-section">
                        <h5>Admin Management</h5>
                        <p>Manage admins and add new administrators.</p>
                        <a href="admins.php" class="btn-new"><i class="fas fa-user-plus me-2"></i>Go to Admin Management</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>