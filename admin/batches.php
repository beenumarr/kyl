<?php
session_start();
require_once('../config/database.php');

if (!isset($_SESSION['admin_id'])) {
    header('Location: index.php');
    exit();
}

// Handle batch operations
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action'])) {
        switch ($_POST['action']) {
            case 'create':
                $stmt = $pdo->prepare("INSERT INTO batches (name, description, application_start, application_end, status) VALUES (?, ?, ?, ?, ?)");
                $stmt->execute([
                    $_POST['name'],
                    $_POST['description'],
                    $_POST['application_start'],
                    $_POST['application_end'],
                    'pending'
                ]);
                break;

            case 'update_status':
                if ($_POST['status'] === 'open') {
                    // First close all open batches
                    $stmt = $pdo->prepare("UPDATE batches SET status = 'closed' WHERE status = 'open'");
                    $stmt->execute();
                }
                // Then update the status of the selected batch
                $stmt = $pdo->prepare("UPDATE batches SET status = ? WHERE id = ?");
                $stmt->execute([$_POST['status'], $_POST['batch_id']]);
                break;

            case 'delete':
                $stmt = $pdo->prepare("DELETE FROM batches WHERE id = ?");
                $stmt->execute([$_POST['batch_id']]);
                break;
        }
        header('Location: batches.php');
        exit();
    }
}

// Get all batches
$stmt = $pdo->query("SELECT * FROM batches ORDER BY application_start DESC");
$batches = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Batch Management - KYL Admin</title>
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
                <a href="applications.php" class="nav-link active">
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


    <div class="main-content">
        <div class="dashboard-header">
            <div class="header-left">
                <h3>Batch Management</h3>
            </div>
            <div class="header-right">
                <button class="btn-new" data-bs-toggle="modal" data-bs-target="#addBatchModal"><i class="fas fa-plus"></i> Add New Batch</button>
            </div>
        </div>

        <div class="recent-section">
            <h5>Batches</h5>
            <div class="table-responsive">
                <table class="custom-table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th>Status</th>
                            <th>Applications</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($batches as $batch): ?>
                            <?php
                            // Get application count for this batch
                            $stmt = $pdo->prepare("SELECT COUNT(*) FROM fellowship_applications WHERE batch_id = ?");
                            $stmt->execute([$batch['id']]);
                            $applicationCount = $stmt->fetchColumn();
                            $badgeClass = $batch['status'] === 'open' ? 'badge bg-light text-success' : ($batch['status'] === 'closed' ? 'badge bg-light text-danger' : 'badge bg-light text-warning');
                            ?>
                            <tr>
                                <td><?php echo htmlspecialchars($batch['name']); ?></td>
                                <td><?php echo htmlspecialchars($batch['description']); ?></td>
                                <td><?php echo date('M d, Y', strtotime($batch['application_start'])); ?></td>
                                <td><?php echo date('M d, Y', strtotime($batch['application_end'])); ?></td>
                                <td><span class="<?php echo $badgeClass; ?>"><?php echo ucfirst($batch['status']); ?></span></td>
                                <td><a href="applications.php?batch_id=<?php echo $batch['id']; ?>"><?php echo $applicationCount; ?> applications</a></td>
                                <td>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-sm btn-primary dropdown-toggle" data-bs-toggle="dropdown">Action</button>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item update-status" href="#" data-id="<?php echo $batch['id']; ?>" data-status="open"><i class="fas fa-play me-2"></i> Open Applications</a></li>
                                            <li><a class="dropdown-item update-status" href="#" data-id="<?php echo $batch['id']; ?>" data-status="closed"><i class="fas fa-stop me-2"></i> Close Applications</a></li>
                                            <li><hr class="dropdown-divider"></li>
                                            <li><a class="dropdown-item text-danger delete-batch" href="#" data-id="<?php echo $batch['id']; ?>"><i class="fas fa-trash me-2"></i> Delete</a></li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Add Batch Modal -->
    <div class="modal fade" id="addBatchModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content glass-effect">
                <div class="modal-header">
                    <h5 class="modal-title">Add New Batch</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form id="addBatchForm" method="POST">
                        <input type="hidden" name="action" value="create">
                        <div class="mb-3">
                            <label class="form-label">Batch Name</label>
                            <input type="text" class="form-control" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Description</label>
                            <textarea class="form-control" name="description" rows="3"></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Application Start Date</label>
                            <input type="datetime-local" class="form-control" name="application_start" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Application End Date</label>
                            <input type="datetime-local" class="form-control" name="application_end" required>
                        </div>
                        <button type="submit" class="btn btn-primary btn-new">Create Batch</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Handle status updates
        document.querySelectorAll('.update-status').forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                const status = this.dataset.status;
                let confirmMessage = 'Are you sure you want to update the batch status?';

                if (status === 'open') {
                    // Check if there are any open batches
                    const openBatches = document.querySelectorAll('.badge.bg-success');
                    if (openBatches.length > 0) {
                        confirmMessage = 'Opening this batch will automatically close all other open batches. Do you want to continue?';
                    }
                }

                if (confirm(confirmMessage)) {
                    const form = document.createElement('form');
                    form.method = 'POST';
                    form.innerHTML = `
                        <input type="hidden" name="action" value="update_status">
                        <input type="hidden" name="batch_id" value="${this.dataset.id}">
                        <input type="hidden" name="status" value="${status}">
                    `;
                    document.body.append(form);
                    form.submit();
                }
            });
        });

        // Handle batch deletion
        document.querySelectorAll('.delete-batch').forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                if (confirm('Are you sure you want to delete this batch? This action cannot be undone.')) {
                    const form = document.createElement('form');
                    form.method = 'POST';
                    form.innerHTML = `
                        <input type="hidden" name="action" value="delete">
                        <input type="hidden" name="batch_id" value="${this.dataset.id}">
                    `;
                    document.body.append(form);
                    form.submit();
                }
            });
        });
    </script>
</body>

</html>