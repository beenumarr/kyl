<?php

// Show errors for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
require_once('../config/database.php');

if (!isset($_SESSION['admin_id'])) {
    header('Location: index.php');
    exit();
}

// Handle status updates
if (isset($_POST['action']) && $_POST['action'] === 'update_status') {
    $id = $_POST['application_id'];
    $status = $_POST['status'];

    $stmt = $pdo->prepare("UPDATE fellowship_applications SET status = ? WHERE id = ?");
    $stmt->execute([$status, $id]);
}

// Pagination
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$limit = 10;
$offset = ($page - 1) * $limit;

// Get current batch if specified
$currentBatchId = $_GET['batch_id'] ?? null;
$stmt = $pdo->query("SELECT * FROM batches ORDER BY application_start DESC");
$batches = $stmt->fetchAll();

// Get total records
$countQuery = "SELECT COUNT(*) FROM fellowship_applications";
$countParams = [];

if ($currentBatchId) {
    $countQuery .= " WHERE batch_id = ?";
    $countParams[] = $currentBatchId;
}

$stmt = $pdo->prepare($countQuery);
$stmt->execute($countParams);
$total_records = $stmt->fetchColumn();
$total_pages = ceil($total_records / $limit);

// Build the query with filters
$conditions = [];
$params = [];

if ($currentBatchId) {
    $conditions[] = "batch_id = ?";
    $params[] = $currentBatchId;
}

if (!empty($_GET['status'])) {
    $conditions[] = "status = ?";
    $params[] = $_GET['status'];
}

if (!empty($_GET['search'])) {
    $search = "%{$_GET['search']}%";
    $conditions[] = "(full_name LIKE ? OR email LIKE ?)";
    $params[] = $search;
    $params[] = $search;
}

$query = "SELECT * FROM fellowship_applications";
if (!empty($conditions)) {
    $query .= " WHERE " . implode(" AND ", $conditions);
}
$query .= " ORDER BY created_at DESC LIMIT $limit OFFSET $offset";

$stmt = $pdo->prepare($query);
$stmt->execute($params);
$applications = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Applications Management - KYL Admin</title>
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
                <h3>Applications Management</h3>
            </div>
            <div class="header-right">
                <a href="batches.php" class="btn btn-secondary"><i class="fas fa-layer-group me-2"></i> Manage Batches</a>
                <button class="btn-new" data-bs-toggle="modal" data-bs-target="#exportModal"><i class="fas fa-download"></i> Export</button>
            </div>
        </div>

        <div class="recent-section mb-4">
            <form class="row g-3 align-items-end">
                <div class="col-md-3">
                    <label class="form-label">Status</label>
                    <select class="form-select" name="status">
                        <option value="">All</option>
                        <option value="pending" <?php echo isset($_GET['status']) && $_GET['status'] === 'pending' ? 'selected' : ''; ?>>Pending</option>
                        <option value="approved" <?php echo isset($_GET['status']) && $_GET['status'] === 'approved' ? 'selected' : ''; ?>>Approved</option>
                        <option value="rejected" <?php echo isset($_GET['status']) && $_GET['status'] === 'rejected' ? 'selected' : ''; ?>>Rejected</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Batch</label>
                    <select class="form-select" name="batch_id">
                        <option value="">All Batches</option>
                        <?php foreach ($batches as $batch): ?>
                            <option value="<?php echo $batch['id']; ?>" <?php echo $currentBatchId == $batch['id'] ? 'selected' : ''; ?>><?php echo htmlspecialchars($batch['name']); ?> (<?php echo ucfirst($batch['status']); ?>)</option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Search</label>
                    <input type="text" class="form-control" name="search" value="<?php echo htmlspecialchars($_GET['search'] ?? ''); ?>" placeholder="Search by name or email">
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary w-100">Apply</button>
                    <button type="button" class="btn btn-secondary w-100 mt-2" onclick="window.location.href='applications.php'">Reset</button>
                </div>
            </form>
        </div>

        <div class="recent-section">
            <h5>Recent Applications</h5>
            <div class="table-responsive">
                <table class="custom-table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Age</th>
                            <th>Location</th>
                            <th>Education</th>
                            <th>Status</th>
                            <th>Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($applications as $app): ?>
                            <?php
                            $birth_date = new DateTime($app['birth_date']);
                            $today = new DateTime();
                            $age = $birth_date->diff($today)->y;
                            $status = $app['status'] ?? 'pending';
                            $badgeClass = $status === 'approved' ? 'badge bg-light text-success' : ($status === 'rejected' ? 'badge bg-light text-danger' : 'badge bg-light text-warning');
                            ?>
                            <tr>
                                <td><?php echo htmlspecialchars($app['full_name']); ?></td>
                                <td><?php echo htmlspecialchars($app['email']); ?></td>
                                <td><?php echo htmlspecialchars($app['phone']); ?></td>
                                <td><?php echo $age; ?> years</td>
                                <td><?php echo htmlspecialchars($app['local_government'] . ', ' . $app['ward']); ?></td>
                                <td><?php echo htmlspecialchars($app['education_level']); ?></td>
                                <td><span class="<?php echo $badgeClass; ?>"><?php echo ucfirst($status); ?></span></td>
                                <td><?php echo date('M d, Y', strtotime($app['created_at'])); ?></td>
                                <td>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-sm btn-primary dropdown-toggle" data-bs-toggle="dropdown">Action</button>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item" href="view_application.php?id=<?php echo $app['id']; ?>"><i class="fas fa-eye me-2"></i> View</a></li>
                                            <li><a class="dropdown-item update-status" href="#" data-id="<?php echo $app['id']; ?>" data-status="approved"><i class="fas fa-check me-2"></i> Approve</a></li>
                                            <li><a class="dropdown-item update-status" href="#" data-id="<?php echo $app['id']; ?>" data-status="rejected"><i class="fas fa-times me-2"></i> Reject</a></li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <?php if ($total_pages > 1): ?>
                <?php
                $query_params = $_GET;
                unset($query_params['page']);
                $query_string = http_build_query($query_params);
                $query_string = $query_string ? '&' . $query_string : '';
                ?>
                <nav class="mt-4">
                    <ul class="pagination justify-content-center">
                        <li class="page-item <?php echo $page <= 1 ? 'disabled' : ''; ?>">
                            <a class="page-link" href="?page=<?php echo $page - 1 . $query_string; ?>">Previous</a>
                        </li>
                        <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                            <li class="page-item <?php echo $page == $i ? 'active' : ''; ?>">
                                <a class="page-link" href="?page=<?php echo $i . $query_string; ?>"><?php echo $i; ?></a>
                            </li>
                        <?php endfor; ?>
                        <li class="page-item <?php echo $page >= $total_pages ? 'disabled' : ''; ?>">
                            <a class="page-link" href="?page=<?php echo $page + 1 . $query_string; ?>">Next</a>
                        </li>
                    </ul>
                </nav>
            <?php endif; ?>
        </div>
    </div>

    <!-- Export Modal -->
    <div class="modal fade" id="exportModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content glass-effect">
                <div class="modal-header">
                    <h5 class="modal-title">Export Applications</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Batch</label>
                        <select class="form-select" id="exportBatchId">
                            <option value="">All Batches</option>
                            <?php foreach ($batches as $batch): ?>
                                <option value="<?php echo $batch['id']; ?>">
                                    <?php echo htmlspecialchars($batch['name']); ?>
                                    (<?php echo ucfirst($batch['status']); ?>)
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Status</label>
                        <select class="form-select" id="exportStatus">
                            <option value="">All Status</option>
                            <option value="pending">Pending</option>
                            <option value="approved">Approved</option>
                            <option value="rejected">Rejected</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Export Format</label>
                        <select class="form-select" id="exportFormat">
                            <option value="csv">CSV</option>
                            <option value="excel">Excel</option>
                            <option value="pdf">PDF</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary btn-new" onclick="exportApplications()">Export to CSV</button>
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
                if (confirm('Are you sure you want to update the status?')) {
                    const form = document.createElement('form');
                    form.method = 'POST';
                    form.innerHTML = `
                        <input type="hidden" name="action" value="update_status">
                        <input type="hidden" name="application_id" value="${this.dataset.id}">
                        <input type="hidden" name="status" value="${this.dataset.status}">
                    `;
                    document.body.append(form);
                    form.submit();
                }
            });
        });

        // Export functionality
        async function exportApplications() {
            const batchId = document.getElementById('exportBatchId').value;
            const status = document.getElementById('exportStatus').value;
            const format = document.getElementById('exportFormat').value;

            try {
                // Show loading state
                const exportBtn = document.querySelector('#exportModal .btn-primary');
                const originalText = exportBtn.textContent;
                exportBtn.textContent = 'Exporting...';
                exportBtn.disabled = true;

                if (format === 'excel' || format === 'pdf') {
                    // For Excel and PDF, redirect to the server-side export
                    window.location.href = `export_applications.php?format=${format}&batch_id=${batchId}&status=${status}`;
                    return;
                }

                // For CSV, handle client-side export
                const response = await fetch(`get_applications_data.php?batch_id=${batchId}&status=${status}`);
                const data = await response.json();

                if (!data || data.length === 0) {
                    alert('No data to export');
                    return;
                }

                // Convert to CSV
                const headers = [
                    'Full Name', 'Email', 'Phone', 'Birth Date', 'Gender',
                    'Local Government', 'Ward', 'Current Address',
                    'Education Level', 'Field of Study', 'Institution',
                    'Graduation Year', 'Current Occupation', 'Organization',
                    'Previous Volunteer', 'Volunteer Experience',
                    'Leadership Experience', 'Community Service',
                    'Why Fellowship', 'Project Idea', 'Expectations',
                    'Reference Name', 'Reference Phone', 'Reference Relationship',
                    'Status', 'Batch', 'Application Date'
                ];

                const csvRows = [headers];

                for (const row of data) {
                    csvRows.push([
                        row.full_name, row.email, row.phone,
                        row.birth_date, row.gender,
                        row.local_government, row.ward,
                        row.current_address, row.education_level,
                        row.field_of_study, row.institution_name,
                        row.graduation_year, row.current_occupation,
                        row.organization, row.previous_volunteer ? 'Yes' : 'No',
                        row.volunteer_experience, row.leadership_experience,
                        row.community_service, row.why_fellowship,
                        row.project_idea, row.expectations,
                        row.reference_name, row.reference_phone,
                        row.reference_relationship,
                        row.status.charAt(0).toUpperCase() + row.status.slice(1),
                        row.batch_name,
                        new Date(row.created_at).toLocaleString()
                    ]);
                }

                // Convert to CSV string
                const csvContent = csvRows.map(row =>
                    row.map(cell =>
                        typeof cell === 'string' ? `"${cell.replace(/"/g, '""')}"` : cell
                    ).join(',')
                ).join('\\n');

                // Create and download file
                const blob = new Blob([csvContent], {
                    type: 'text/csv;charset=utf-8;'
                });
                const link = document.createElement('a');
                if (navigator.msSaveBlob) {
                    navigator.msSaveBlob(blob, 'applications_export.csv');
                } else {
                    link.href = URL.createObjectURL(blob);
                    link.setAttribute('download', 'applications_export.csv');
                    document.body.appendChild(link);
                    link.click();
                    document.body.removeChild(link);
                }

                // Hide modal
                const modal = bootstrap.Modal.getInstance(document.getElementById('exportModal'));
                modal.hide();
            } catch (error) {
                console.error('Export error:', error);
                alert('Error exporting data. Please try again.');
            } finally {
                // Reset button state
                const exportBtn = document.querySelector('#exportModal .btn-primary');
                exportBtn.textContent = 'Export to CSV';
                exportBtn.disabled = false;
            }
        }
    </script>
</body>

</html>