<?php
session_start();
require_once('../config/database.php');

if (!isset($_SESSION['admin_id'])) {
    header('Location: index.php');
    exit();
}

// Handle event operations
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action'])) {
        switch ($_POST['action']) {
            case 'create':
                // insert event
                $stmt = $pdo->prepare("INSERT INTO events (title, description, event_date, location, status) VALUES (?, ?, ?, ?, ?)");
                $stmt->execute([
                    $_POST['title'],
                    $_POST['description'],
                    $_POST['event_date'],
                    $_POST['location'],
                    $_POST['status']
                ]);
                // optional timer
                if (!empty($_POST['enable_timer']) && !empty($_POST['timer_datetime'])) {
                    // deactivate all timers first to keep only one active
                    $pdo->query("UPDATE timers SET status = 'inactive'");
                    $tstmt = $pdo->prepare("INSERT INTO timers (title, event_datetime, status) VALUES (?, ?, 'active')");
                    // combine date and time (timer_datetime expected as datetime-local)
                    $tstmt->execute([$_POST['title'], $_POST['timer_datetime']]);
                }
                break;

            case 'update':
                $stmt = $pdo->prepare("UPDATE events SET title = ?, description = ?, event_date = ?, location = ?, status = ? WHERE id = ?");
                $stmt->execute([
                    $_POST['title'],
                    $_POST['description'],
                    $_POST['event_date'],
                    $_POST['location'],
                    $_POST['status'],
                    $_POST['event_id']
                ]);

                // Handle timer for this event: match by event id via title+date
                $eventTitle = $_POST['title'];
                $eventDate = $_POST['event_date'];
                if (!empty($_POST['enable_timer']) && !empty($_POST['timer_datetime'])) {
                    // if active requested, deactivate others
                    if (!empty($_POST['timer_status']) && $_POST['timer_status'] === 'active') {
                        $pdo->query("UPDATE timers SET status = 'inactive'");
                        $tstatus = 'active';
                    } else {
                        $tstatus = 'inactive';
                    }

                    // try find existing timer for this title+date
                    $find = $pdo->prepare("SELECT * FROM timers WHERE title = ? AND DATE(event_datetime) = ? LIMIT 1");
                    $find->execute([$eventTitle, $eventDate]);
                    $existing = $find->fetch(PDO::FETCH_ASSOC);
                    if ($existing) {
                        $up = $pdo->prepare("UPDATE timers SET title = ?, event_datetime = ?, status = ? WHERE id = ?");
                        $up->execute([$eventTitle, $_POST['timer_datetime'], $tstatus, $existing['id']]);
                    } else {
                        $ins = $pdo->prepare("INSERT INTO timers (title, event_datetime, status) VALUES (?, ?, ?)");
                        $ins->execute([$eventTitle, $_POST['timer_datetime'], $tstatus]);
                    }
                } else {
                    // disable any matching timer when timer not enabled
                    $dis = $pdo->prepare("UPDATE timers SET status = 'inactive' WHERE title = ? AND DATE(event_datetime) = ?");
                    $dis->execute([$eventTitle, $eventDate]);
                }
                break;

            case 'delete':
                // delete event and any timers matching by title+date
                // fetch event first to know its title/date
                $fe = $pdo->prepare("SELECT * FROM events WHERE id = ? LIMIT 1");
                $fe->execute([$_POST['event_id']]);
                $ev = $fe->fetch(PDO::FETCH_ASSOC);
                $stmt = $pdo->prepare("DELETE FROM events WHERE id = ?");
                $stmt->execute([$_POST['event_id']]);
                if ($ev) {
                    $delT = $pdo->prepare("DELETE FROM timers WHERE title = ? AND DATE(event_datetime) = ?");
                    $delT->execute([$ev['title'], $ev['event_date']]);
                }
                break;
        }
        header('Location: events.php');
        exit();
    }
}

// Get all events and try to attach any matching timer (by title + date)
$stmt = $pdo->query("SELECT * FROM events ORDER BY event_date DESC");
$events = $stmt->fetchAll(PDO::FETCH_ASSOC);
// Attach timer info if exists (match timers by title and same date)
$timerStmt = $pdo->prepare("SELECT * FROM timers WHERE title = ? AND DATE(event_datetime) = ? ORDER BY created_at DESC LIMIT 1");
foreach ($events as &$ev) {
    $timerStmt->execute([$ev['title'], $ev['event_date']]);
    $timer = $timerStmt->fetch(PDO::FETCH_ASSOC);
    $ev['timer'] = $timer ?: null;
}
unset($ev);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Events Management - KYL Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="assets/css/admin.css">
</head>

<body>
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


    <div class="main-content">
        <div class="dashboard-header">
            <div class="header-left">
                <h3>Events Management</h3>
            </div>
            <div class="header-right">
                <button class="btn-new" data-bs-toggle="modal" data-bs-target="#addEventModal"><i class="fas fa-plus"></i> Add New Event</button>
            </div>
        </div>

        <div class="recent-section">
            <h5>Events</h5>
            <div class="table-responsive">
                <table class="custom-table">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Date</th>
                            <th>Location</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($events as $event): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($event['title']); ?></td>
                                <td><?php echo date('M d, Y', strtotime($event['event_date'])); ?></td>
                                <td><?php echo htmlspecialchars($event['location']); ?></td>
                                <?php $eStatus = $event['status'] ?? 'inactive'; $eBadge = $eStatus === 'active' ? 'badge bg-light text-success' : ($eStatus === 'cancelled' ? 'badge bg-light text-danger' : 'badge bg-light text-warning'); ?>
                                <td><span class="<?php echo $eBadge; ?>"><?php echo ucfirst($eStatus); ?></span></td>
                                <td>
                                    <button class="btn btn-sm btn-primary edit-event" data-bs-toggle="modal" data-bs-target="#editEventModal" data-event='<?php echo json_encode($event); ?>'><i class="fas fa-edit"></i></button>
                                    <button class="btn btn-sm btn-danger delete-event" data-id="<?php echo $event['id']; ?>"><i class="fas fa-trash"></i></button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Add Event Modal -->
    <div class="modal fade" id="addEventModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content glass-effect">
                <div class="modal-header">
                    <h5 class="modal-title">Add New Event</h5>
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
                            <label class="form-label">Description</label>
                            <textarea class="form-control" name="description" rows="3" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Date</label>
                            <input type="date" class="form-control" name="event_date" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Location</label>
                            <input type="text" class="form-control" name="location" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Status</label>
                            <select class="form-select" name="status" required>
                                <option value="active">Active</option>
                                <option value="cancelled">Cancelled</option>
                                <option value="completed">Completed</option>
                            </select>
                        </div>
                        <hr>
                        <h6>Optional Timer</h6>
                        <div class="form-check mb-2">
                            <input class="form-check-input" type="checkbox" value="1" id="add_enable_timer" name="enable_timer">
                            <label class="form-check-label" for="add_enable_timer">Enable timer for this event</label>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Timer Date & Time</label>
                            <input type="datetime-local" class="form-control" name="timer_datetime" id="add_timer_datetime">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary btn-new">Add Event</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit Event Modal -->
    <div class="modal fade" id="editEventModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content glass-effect">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Event</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form method="POST">
                    <div class="modal-body">
                        <input type="hidden" name="action" value="update">
                        <input type="hidden" name="event_id" id="edit_event_id">
                        <div class="mb-3">
                            <label class="form-label">Title</label>
                            <input type="text" class="form-control" name="title" id="edit_title" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Description</label>
                            <textarea class="form-control" name="description" id="edit_description" rows="3" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Date</label>
                            <input type="date" class="form-control" name="event_date" id="edit_event_date" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Location</label>
                            <input type="text" class="form-control" name="location" id="edit_location" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Status</label>
                            <select class="form-select" name="status" id="edit_status" required>
                                <option value="active">Active</option>
                                <option value="cancelled">Cancelled</option>
                                <option value="completed">Completed</option>
                            </select>
                        </div>
                        <hr>
                        <h6>Optional Timer</h6>
                        <div class="form-check mb-2">
                            <input class="form-check-input" type="checkbox" value="1" id="edit_enable_timer" name="enable_timer">
                            <label class="form-check-label" for="edit_enable_timer">Enable timer for this event</label>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Timer Date & Time</label>
                            <input type="datetime-local" class="form-control" name="timer_datetime" id="edit_timer_datetime">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Timer Status</label>
                            <select class="form-select" name="timer_status" id="edit_timer_status">
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary btn-new">Update Event</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Handle Edit Event
        document.querySelectorAll('.edit-event').forEach(button => {
            button.addEventListener('click', function() {
                const event = JSON.parse(this.dataset.event);
                document.getElementById('edit_event_id').value = event.id;
                document.getElementById('edit_title').value = event.title;
                document.getElementById('edit_description').value = event.description;
                document.getElementById('edit_event_date').value = event.event_date;
                document.getElementById('edit_location').value = event.location;
                document.getElementById('edit_status').value = event.status;
                // populate timer fields if available
                if (event.timer) {
                    document.getElementById('edit_enable_timer').checked = true;
                    // datetime-local expects YYYY-MM-DDThh:mm
                    document.getElementById('edit_timer_datetime').value = event.timer.event_datetime.slice(0, 16);
                    document.getElementById('edit_timer_status').value = event.timer.status || 'inactive';
                } else {
                    document.getElementById('edit_enable_timer').checked = false;
                    document.getElementById('edit_timer_datetime').value = '';
                    document.getElementById('edit_timer_status').value = 'inactive';
                }
            });
        });

        // Clear add modal timer fields when opened
        var addEventModal = document.getElementById('addEventModal');
        if (addEventModal) {
            addEventModal.addEventListener('show.bs.modal', function() {
                document.getElementById('add_enable_timer').checked = false;
                document.getElementById('add_timer_datetime').value = '';
            });
        }

        // Handle Delete Event
        document.querySelectorAll('.delete-event').forEach(button => {
            button.addEventListener('click', function() {
                if (confirm('Are you sure you want to delete this event?')) {
                    const form = document.createElement('form');
                    form.method = 'POST';
                    form.innerHTML = `
                        <input type="hidden" name="action" value="delete">
                        <input type="hidden" name="event_id" value="${this.dataset.id}">
                    `;
                    document.body.append(form);
                    form.submit();
                }
            });
        });
    </script>
</body>

</html>