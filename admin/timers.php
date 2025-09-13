<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
require_once('../config/database.php');

if (!isset($_SESSION['admin_id'])) {
    header('Location: index.php');
    exit();
}

// Handle timer operations
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action'])) {
        switch ($_POST['action']) {
            case 'create':
                // Deactivate all existing timers first
                $stmt = $pdo->query("UPDATE timers SET status = 'inactive'");

                // Create new timer
                $stmt = $pdo->prepare("INSERT INTO timers (title, event_datetime, status) VALUES (?, ?, 'active')");
                $stmt->execute([$_POST['title'], $_POST['event_datetime']]);
                break;

            case 'update':
                if ($_POST['status'] === 'active') {
                    // Deactivate all other timers first
                    $stmt = $pdo->query("UPDATE timers SET status = 'inactive'");
                }
                $stmt = $pdo->prepare("UPDATE timers SET title = ?, event_datetime = ?, status = ? WHERE id = ?");
                $stmt->execute([
                    $_POST['title'],
                    $_POST['event_datetime'],
                    $_POST['status'],
                    $_POST['timer_id']
                ]);
                break;

            case 'delete':
                $stmt = $pdo->prepare("DELETE FROM timers WHERE id = ?");
                $stmt->execute([$_POST['timer_id']]);
                break;
        }
        header('Location: timers.php');
        exit();
    }
}

// Get all timers
$stmt = $pdo->query("SELECT * FROM timers ORDER BY created_at DESC");
$timers = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Timer Management - KYL Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="assets/css/admin.css">
</head>

<body>
    <div class="container-fluid">
        <div class="row">
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
                <a href="events.php" class="nav-link active">
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
            <div class="col-md-9 col-lg-10 px-4 py-4">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2>Timer Management</h2>
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addTimerModal">
                        <i class="fas fa-plus me-2"></i> Add New Timer
                    </button>
                </div>

                <!-- Active Timer Card -->
                <?php
                $stmt = $pdo->query("SELECT * FROM timers WHERE status = 'active' LIMIT 1");
                $activeTimer = $stmt->fetch();
                if ($activeTimer):
                ?>
                    <div class="card mb-4">
                        <div class="card-header bg-success text-white">
                            <h5 class="mb-0">Active Timer</h5>
                        </div>
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-md-6">
                                    <h4><?php echo htmlspecialchars($activeTimer['title']); ?></h4>
                                    <p class="mb-0">Countdown to: <?php echo date('M d, Y H:i', strtotime($activeTimer['event_datetime'])); ?></p>
                                </div>
                                <div class="col-md-6 text-md-end">
                                    <button class="btn btn-primary btn-sm edit-timer" data-bs-toggle="modal"
                                        data-bs-target="#editTimerModal" data-timer='<?php echo json_encode($activeTimer); ?>'>
                                        <i class="fas fa-edit"></i> Edit
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>

                <!-- Timers Table -->
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Title</th>
                                        <th>Event Date & Time</th>
                                        <th>Status</th>
                                        <th>Created</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($timers as $timer): ?>
                                        <tr>
                                            <td><?php echo htmlspecialchars($timer['title']); ?></td>
                                            <td><?php echo date('M d, Y H:i', strtotime($timer['event_datetime'])); ?></td>
                                            <td>
                                                <span class="badge bg-<?php echo $timer['status'] === 'active' ? 'success' : 'secondary'; ?>">
                                                    <?php echo ucfirst($timer['status']); ?>
                                                </span>
                                            </td>
                                            <td><?php echo date('M d, Y', strtotime($timer['created_at'])); ?></td>
                                            <td>
                                                <button class="btn btn-sm btn-primary edit-timer" data-bs-toggle="modal"
                                                    data-bs-target="#editTimerModal" data-timer='<?php echo json_encode($timer); ?>'>
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                                <button class="btn btn-sm btn-danger delete-timer" data-id="<?php echo $timer['id']; ?>">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Timer Modal -->
    <div class="modal fade" id="addTimerModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content glass-effect">
                <div class="modal-header">
                    <h5 class="modal-title">Add New Timer</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form method="POST">
                    <div class="modal-body">
                        <input type="hidden" name="action" value="create">
                        <div class="mb-3">
                            <label class="form-label">Title</label>
                            <input type="text" class="form-control" name="title" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Event Date & Time</label>
                            <input type="datetime-local" class="form-control" name="event_datetime" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn-new">Add Timer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit Timer Modal -->
    <div class="modal fade" id="editTimerModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content glass-effect">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Timer</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form method="POST">
                    <div class="modal-body">
                        <input type="hidden" name="action" value="update">
                        <input type="hidden" name="timer_id" id="edit_timer_id">
                        <div class="mb-3">
                            <label class="form-label">Title</label>
                            <input type="text" class="form-control" name="title" id="edit_title" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Event Date & Time</label>
                            <input type="datetime-local" class="form-control" name="event_datetime" id="edit_event_datetime" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Status</label>
                            <select class="form-select" name="status" id="edit_status" required>
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn-new">Update Timer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Handle Edit Timer
        document.querySelectorAll('.edit-timer').forEach(button => {
            button.addEventListener('click', function() {
                const timer = JSON.parse(this.dataset.timer);
                document.getElementById('edit_timer_id').value = timer.id;
                document.getElementById('edit_title').value = timer.title;
                document.getElementById('edit_event_datetime').value = timer.event_datetime.slice(0, 16);
                document.getElementById('edit_status').value = timer.status;
            });
        });

        // Handle Delete Timer
        document.querySelectorAll('.delete-timer').forEach(button => {
            button.addEventListener('click', function() {
                if (confirm('Are you sure you want to delete this timer?')) {
                    const form = document.createElement('form');
                    form.method = 'POST';
                    form.innerHTML = `
                        <input type="hidden" name="action" value="delete">
                        <input type="hidden" name="timer_id" value="${this.dataset.id}">
                    `;
                    document.body.append(form);
                    form.submit();
                }
            });
        });
    </script>
</body>

</html>