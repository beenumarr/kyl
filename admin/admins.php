<?php
session_start();
require_once('../config/database.php');

if (!isset($_SESSION['admin_id'])) {
    header('Location: index.php');
    exit();
}

// Handle admin operations
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action'])) {
        switch ($_POST['action']) {
            case 'create':
                $password_hash = password_hash($_POST['password'], PASSWORD_DEFAULT);
                $address = trim($_POST['address'] ?? '');
                $phone = trim($_POST['phone'] ?? '');
                $about = trim($_POST['about'] ?? '');
                $profile_pic_path = '';
                if (isset($_FILES['profile_pic']) && $_FILES['profile_pic']['tmp_name']) {
                    $ext = strtolower(pathinfo($_FILES['profile_pic']['name'], PATHINFO_EXTENSION));
                    if (in_array($ext, ['jpg', 'jpeg', 'png', 'gif'])) {
                        $pic_name = 'admin_' . time() . rand(1000, 9999) . '.' . $ext;
                        $dest = __DIR__ . '/profile_pics/' . $pic_name;
                        if (move_uploaded_file($_FILES['profile_pic']['tmp_name'], $dest)) {
                            $profile_pic_path = 'profile_pics/' . $pic_name;
                        }
                    }
                }
                $stmt = $pdo->prepare("INSERT INTO admins (name, email, password, address, phone, about, profile_pic_path) VALUES (?, ?, ?, ?, ?, ?, ?)");
                $stmt->execute([
                    $_POST['name'],
                    $_POST['email'],
                    $password_hash,
                    $address,
                    $phone,
                    $about,
                    $profile_pic_path
                ]);
                break;

            case 'update':
                $address = trim($_POST['address'] ?? '');
                $phone = trim($_POST['phone'] ?? '');
                $about = trim($_POST['about'] ?? '');
                $profile_pic_path = $_POST['existing_profile_pic'] ?? '';
                // Only update profile_pic_path if a new file is uploaded
                if (isset($_FILES['profile_pic']) && $_FILES['profile_pic']['tmp_name']) {
                    $ext = strtolower(pathinfo($_FILES['profile_pic']['name'], PATHINFO_EXTENSION));
                    if (in_array($ext, ['jpg', 'jpeg', 'png', 'gif'])) {
                        $pic_name = 'admin_' . $_POST['admin_id'] . '_' . time() . '.' . $ext;
                        $dest = __DIR__ . '/profile_pics/' . $pic_name;
                        if (move_uploaded_file($_FILES['profile_pic']['tmp_name'], $dest)) {
                            $profile_pic_path = 'profile_pics/' . $pic_name;
                        }
                    }
                }
                // Always update all fields, but only update password if set
                if (!empty($_POST['password'])) {
                    $password_hash = password_hash($_POST['password'], PASSWORD_DEFAULT);
                    $stmt = $pdo->prepare("UPDATE admins SET name = ?, email = ?, password = ?, address = ?, phone = ?, about = ?, profile_pic_path = ? WHERE id = ?");
                    $stmt->execute([
                        trim($_POST['name']),
                        trim($_POST['email']),
                        $password_hash,
                        $address,
                        $phone,
                        $about,
                        $profile_pic_path,
                        $_POST['admin_id']
                    ]);
                } else {
                    $stmt = $pdo->prepare("UPDATE admins SET name = ?, email = ?, address = ?, phone = ?, about = ?, profile_pic_path = ? WHERE id = ?");
                    $stmt->execute([
                        trim($_POST['name']),
                        trim($_POST['email']),
                        $address,
                        $phone,
                        $about,
                        $profile_pic_path,
                        $_POST['admin_id']
                    ]);
                }
                break;

            case 'delete':
                if ($_POST['admin_id'] != $_SESSION['admin_id']) {
                    $stmt = $pdo->prepare("DELETE FROM admins WHERE id = ?");
                    $stmt->execute([$_POST['admin_id']]);
                }
                break;
        }
        header('Location: admins.php');
        exit();
    }
}

// Get all admins
$stmt = $pdo->query("SELECT * FROM admins ORDER BY created_at DESC");
$admins = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Management - KYL Admin</title>
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
                <a href="admins.php" class="nav-link active">
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
        <div class="main-content px-4 py-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2>Admin Management</h2>
                <button class="btn-new" data-bs-toggle="modal" data-bs-target="#addAdminModal">
                    <i class="fas fa-plus me-2"></i> Add New Admin
                </button>
            </div>

            <!-- Admins Table -->
            <div class="recent-section">
                <div class="table-responsive">
                    <table class="custom-table">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Created Date</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($admins as $admin): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($admin['name']); ?></td>
                                    <td><?php echo htmlspecialchars($admin['email']); ?></td>
                                    <td><?php echo date('M d, Y', strtotime($admin['created_at'])); ?></td>
                                    <td>
                                        <button class="btn btn-sm btn-primary edit-admin" data-bs-toggle="modal"
                                            data-bs-target="#editAdminModal" data-admin='<?php echo json_encode($admin); ?>'>
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <?php if ($admin['id'] != $_SESSION['admin_id']): ?>
                                            <button class="btn btn-sm btn-outline-primary delete-admin" data-id="<?php echo $admin['id']; ?>">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Admin Modal -->
    <div class="modal fade" id="addAdminModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content glass-effect">
                <div class="modal-header">
                    <h5 class="modal-title">Add New Admin</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form method="POST" enctype="multipart/form-data">
                    <div class="modal-body">
                        <input type="hidden" name="action" value="create">
                        <div class="mb-3">
                            <label class="form-label">Name</label>
                            <input type="text" class="form-control" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-control" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Phone</label>
                            <input type="text" class="form-control" name="phone" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Address</label>
                            <input type="text" class="form-control" name="address" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">About</label>
                            <textarea class="form-control" name="about" rows="2" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Profile Picture</label>
                            <input type="file" class="form-control" name="profile_pic" accept="image/*">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <input type="password" class="form-control" name="password" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn-new">Add Admin</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit Admin Modal -->
    <div class="modal fade" id="editAdminModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content glass-effect">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Admin</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form method="POST" enctype="multipart/form-data">
                    <div class="modal-body">
                        <input type="hidden" name="action" value="update">
                        <input type="hidden" name="admin_id" id="edit_admin_id">
                        <input type="hidden" name="existing_profile_pic" id="edit_profile_pic_path">
                        <div class="mb-3 text-center">
                            <img id="edit_profile_pic_preview" src="../img/placeholder.jpg" alt="Profile Picture" class="rounded-circle mb-2" style="width: 80px; height: 80px; object-fit: cover;">
                            <input type="file" class="form-control mt-2" name="profile_pic" accept="image/*">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Name</label>
                            <input type="text" class="form-control" name="name" id="edit_name" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-control" name="email" id="edit_email" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Phone</label>
                            <input type="text" class="form-control" name="phone" id="edit_phone" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Address</label>
                            <input type="text" class="form-control" name="address" id="edit_address" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">About</label>
                            <textarea class="form-control" name="about" id="edit_about" rows="2" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Password (leave blank to keep current)</label>
                            <input type="password" class="form-control" name="password">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn-new">Update Admin</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Handle Edit Admin
        document.querySelectorAll('.edit-admin').forEach(button => {
            button.addEventListener('click', function() {
                const admin = JSON.parse(this.dataset.admin);
                document.getElementById('edit_admin_id').value = admin.id;
                document.getElementById('edit_name').value = admin.name;
                document.getElementById('edit_email').value = admin.email;
                document.getElementById('edit_phone').value = admin.phone || '';
                document.getElementById('edit_address').value = admin.address || '';
                document.getElementById('edit_about').value = admin.about || '';
                document.getElementById('edit_profile_pic_path').value = admin.profile_pic_path || '';
                const pic = admin.profile_pic_path ? admin.profile_pic_path : '../img/placeholder.jpg';
                document.getElementById('edit_profile_pic_preview').src = pic;
            });
        });

        // Handle Delete Admin
        document.querySelectorAll('.delete-admin').forEach(button => {
            button.addEventListener('click', function() {
                if (confirm('Are you sure you want to delete this admin?')) {
                    const form = document.createElement('form');
                    form.method = 'POST';
                    form.innerHTML = `
                        <input type="hidden" name="action" value="delete">
                        <input type="hidden" name="admin_id" value="${this.dataset.id}">
                    `;
                    document.body.append(form);
                    form.submit();
                }
            });
        });
    </script>
</body>

</html>