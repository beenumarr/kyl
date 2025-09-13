<?php
session_start();
require_once('../config/database.php');

if (!isset($_SESSION['admin_id'])) {
    header('Location: index.php');
    exit();
}

// Get application ID from URL
$id = $_GET['id'] ?? null;
if (!$id) {
    header('Location: applications.php');
    exit();
}

// Get application details
$stmt = $pdo->prepare("
    SELECT a.*, b.name as batch_name
    FROM fellowship_applications a 
    LEFT JOIN batches b ON a.batch_id = b.id 
    WHERE a.id = ?
");
$stmt->execute([$id]);
$app = $stmt->fetch();

if (!$app) {
    header('Location: applications.php');
    exit();
}

// Calculate age
$birth_date = new DateTime($app['birth_date']);
$today = new DateTime();
$age = $birth_date->diff($today)->y;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Application - KYL Admin</title>
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
                <h3>Application Details</h3>
            </div>
            <div class="header-right">
                <a href="applications.php" class="btn btn-secondary"><i class="fas fa-arrow-left me-2"></i> Back to Applications</a>
                <?php if ($app['status'] !== 'approved'): ?>
                    <a href="#" class="btn btn-success update-status" data-id="<?php echo $app['id']; ?>" data-status="approved"><i class="fas fa-check me-2"></i> Approve</a>
                <?php endif; ?>
                <?php if ($app['status'] !== 'rejected'): ?>
                    <a href="#" class="btn btn-danger update-status" data-id="<?php echo $app['id']; ?>" data-status="rejected"><i class="fas fa-times me-2"></i> Reject</a>
                <?php endif; ?>
            </div>
        </div>

        <div class="recent-section">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 class="mb-0"><i class="fas fa-user-circle me-2"></i><?php echo htmlspecialchars($app['full_name']); ?></h5>
                <span class="badge bg-light <?php echo $app['status'] === 'approved' ? 'text-success' : ($app['status'] === 'rejected' ? 'text-danger' : 'text-warning'); ?> fs-6">
                    <?php echo ucfirst($app['status'] ?? 'pending'); ?>
                </span>
            </div>

            <div class="row g-3 mb-4 text-white">
                <div class="col-md-3">
                    <div class="stat-card text-white">
                        <h6 class="mb-1">Application ID</h6>
                        <p class="mb-0 fw-bold text-white">#<?php echo $app['id']; ?></p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stat-card text-white">
                        <h6 class="mb-1">Batch</h6>
                        <p class="mb-0 fw-bold text-white"><?php echo htmlspecialchars($app['batch_name'] ?? 'N/A'); ?></p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stat-card text-white">
                        <h6 class="mb-1">Submitted On</h6>
                        <p class="mb-0 fw-bold text-white"><?php echo date('M d, Y H:i', strtotime($app['created_at'])); ?></p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stat-card text-white">
                        <h6 class="mb-1">Age</h6>
                        <p class="mb-0 fw-bold text-white"><?php echo $age; ?> years</p>
                    </div>
                </div>
            </div>

            <ul class="nav nav-tabs" id="applicationTabs" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="personal-tab" data-bs-toggle="tab" href="#personal" role="tab"><i class="fas fa-user me-2"></i>Personal Info</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="education-tab" data-bs-toggle="tab" href="#education" role="tab"><i class="fas fa-graduation-cap me-2"></i>Education</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="experience-tab" data-bs-toggle="tab" href="#experience" role="tab"><i class="fas fa-briefcase me-2"></i>Experience</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="motivation-tab" data-bs-toggle="tab" href="#motivation" role="tab"><i class="fas fa-star me-2"></i>Motivation</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="documents-tab" data-bs-toggle="tab" href="#documents" role="tab"><i class="fas fa-file-alt me-2"></i>Documents</a>
                </li>
            </ul>

            <div class="tab-content pt-4" id="applicationTabContent">
                <!-- Personal Information Tab -->
                <div class="tab-pane fade show active" id="personal" role="tabpanel">
                    <div class="row g-4">
                        <div class="col-md-6">
                            <div class="stat-card h-100">
                                <h6 class="card-title text-primary mb-4">Contact Information</h6>
                                <div class="mb-3">
                                    <label style="color:var(--text-secondary);">Email Address</label>
                                    <p class="mb-2" style="color:var(--text-primary);"><?php echo htmlspecialchars($app['email']); ?></p>
                                </div>
                                <div class="mb-3">
                                    <label style="color:var(--text-secondary);">Phone Number</label>
                                    <p class="mb-2" style="color:var(--text-primary);"><?php echo htmlspecialchars($app['phone']); ?></p>
                                </div>
                                <div class="mb-0">
                                    <label style="color:var(--text-secondary);">Residential Address</label>
                                    <p class="mb-0" style="color:var(--text-primary);"><?php echo nl2br(htmlspecialchars($app['residential_address'])); ?></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="stat-card h-100">
                                <h6 class="card-title text-primary mb-4">Location Information</h6>
                                                <div class="mb-3">
                                                    <label style="color:var(--text-secondary);">State of Origin</label>
                                                    <p class="mb-2" style="color:var(--text-primary);"><?php echo htmlspecialchars($app['state']); ?></p>
                                                </div>
                                                <div class="mb-3">
                                                    <label style="color:var(--text-secondary);">Local Government Area</label>
                                                    <p class="mb-2" style="color:var(--text-primary);"><?php echo htmlspecialchars($app['local_government']); ?></p>
                                                </div>
                                                <div class="mb-0">
                                                    <label style="color:var(--text-secondary);">Ward</label>
                                                    <p class="mb-0" style="color:var(--text-primary);"><?php echo htmlspecialchars($app['ward']); ?></p>
                                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Education Tab -->
                <div class="tab-pane fade" id="education" role="tabpanel">
                    <div class="stat-card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                                <div class="mb-4">
                                                    <label style="color:var(--text-secondary);">Highest Level of Education</label>
                                                    <p class="mb-0 fw-bold" style="color:var(--text-primary);"><?php echo htmlspecialchars($app['education_level']); ?></p>
                                                </div>
                                                <div class="mb-4">
                                                    <label style="color:var(--text-secondary);">Course of Study</label>
                                                    <p class="mb-0" style="color:var(--text-primary);"><?php echo htmlspecialchars($app['course_of_study']); ?></p>
                                                </div>
                                </div>
                                <div class="col-md-6">
                                                <div class="mb-4">
                                                    <label style="color:var(--text-secondary);">Institution</label>
                                                    <p class="mb-0" style="color:var(--text-primary);"><?php echo htmlspecialchars($app['institution_name']); ?></p>
                                                </div>
                                                <div class="mb-4">
                                                    <label style="color:var(--text-secondary);">Graduation Year</label>
                                                    <p class="mb-0" style="color:var(--text-primary);"><?php echo htmlspecialchars($app['graduation_year'] ?? 'N/A'); ?></p>
                                                </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Experience Tab -->
                <div class="tab-pane fade" id="experience" role="tabpanel">
                    <div class="row g-4">
                        <div class="col-md-12">
                            <div class="stat-card">
                                <div class="card-body">
                                    <h6 class="card-title text-primary mb-4">Current Employment</h6>
                                    <div class="row">
                                        <div class="col-md-6">
                                                        <div class="mb-4">
                                                            <label style="color:var(--text-secondary);">Current Occupation</label>
                                                            <p class="mb-0" style="color:var(--text-primary);"><?php echo htmlspecialchars($app['current_occupation'] ?? 'N/A'); ?></p>
                                                        </div>
                                        </div>
                                        <div class="col-md-6">
                                                        <div class="mb-4">
                                                            <label style="color:var(--text-secondary);">Employer/Organization</label>
                                                            <p class="mb-0" style="color:var(--text-primary);"><?php echo htmlspecialchars($app['employer_name'] ?? 'N/A'); ?></p>
                                                        </div>
                                        </div>
                                    </div>
                                                    <div class="mb-0">
                                                        <label style="color:var(--text-secondary);">Work Experience</label>
                                                        <p class="mb-0" style="color:var(--text-primary);"><?php echo nl2br(htmlspecialchars($app['work_experience'] ?? 'None provided')); ?></p>
                                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="stat-card">
                                <div class="card-body">
                                    <h6 class="card-title text-primary mb-4">Skills & Experience</h6>
                                                <div class="mb-4">
                                                    <label style="color:var(--text-secondary);">Volunteer Experience</label>
                                                    <p class="mb-4" style="color:var(--text-primary);"><?php echo nl2br(htmlspecialchars($app['volunteer_experience'])); ?></p>
                                                </div>
                                                <div class="mb-4">
                                                    <label style="color:var(--text-secondary);">Skills & Competencies</label>
                                                    <p class="mb-4" style="color:var(--text-primary);"><?php echo nl2br(htmlspecialchars($app['skills_competencies'])); ?></p>
                                                </div>
                                                <div class="mb-0">
                                                    <label style="color:var(--text-secondary);">Leadership Roles</label>
                                                    <p class="mb-0" style="color:var(--text-primary);"><?php echo nl2br(htmlspecialchars($app['leadership_roles'])); ?></p>
                                                </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Motivation Tab -->
                <div class="tab-pane fade" id="motivation" role="tabpanel">
                    <div class="row g-4">
                        <div class="col-12">
                            <div class="stat-card">
                                <div class="card-body">
                                    <h6 class="card-title text-primary mb-4">Fellowship Interest</h6>
                                                <div class="mb-4">
                                                    <label style="color:var(--text-secondary);">Why do you want to join The Mallam Zaki Fellowship?</label>
                                                    <p class="mb-0" style="color:var(--text-primary);"><?php echo nl2br(htmlspecialchars($app['why_fellowship'])); ?></p>
                                                </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="stat-card h-100">
                                <div class="card-body">
                                                    <div class="mb-4">
                                                        <label style="color:var(--text-secondary);">Challenge Description</label>
                                                        <p class="mb-0" style="color:var(--text-primary);"><?php echo nl2br(htmlspecialchars($app['challenge_description'])); ?></p>
                                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="stat-card h-100">
                                <div class="card-body">
                                                    <div class="mb-4">
                                                        <label style="color:var(--text-secondary);">Goals & Expectations</label>
                                                        <p class="mb-0" style="color:var(--text-primary);"><?php echo nl2br(htmlspecialchars($app['fellowship_goals'])); ?></p>
                                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="stat-card">
                                <div class="card-body">
                                    <div class="mb-4">
                                        <label style="color:var(--text-secondary);">Skills Application in Community</label>
                                        <p class="mb-4" style="color:var(--text-primary);"><?php echo nl2br(htmlspecialchars($app['skills_application'])); ?></p>
                                    </div>
                                    <div class="mb-0">
                                        <label style="color:var(--text-secondary);">Accommodation in Azare</label>
                                        <p class="mb-0">
                                            <span class="badge bg-light <?php echo $app['can_accommodate'] === 'Yes' ? 'text-success' : ($app['can_accommodate'] === 'No' ? 'text-danger' : 'text-warning'); ?>">
                                                <?php echo htmlspecialchars($app['can_accommodate']); ?>
                                            </span>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Documents Tab -->
                <div class="tab-pane fade" id="documents" role="tabpanel">
                    <div class="row g-4">
                        <div class="col-md-6">
                            <div class="stat-card">
                                <div class="card-body">
                                    <h6 class="card-title text-primary mb-4">Passport Photograph</h6>
                                        <?php if (!empty($app['passport_photo_path'])): ?>
                                            <img src="../uploads/<?php echo htmlspecialchars($app['passport_photo_path']); ?>" alt="Passport Photo" class="img-fluid rounded mb-3" style="max-height: 300px;">
                                            <a href="../uploads/<?php echo htmlspecialchars($app['passport_photo_path']); ?>" class="btn btn-sm btn-primary btn-new" target="_blank"><i class="fas fa-external-link-alt me-2"></i>View Full Size</a>
                                        <?php else: ?>
                                            <p style="color:var(--text-secondary);" class="mb-0">No passport photo uploaded</p>
                                        <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="stat-card">
                                <div class="card-body">
                                    <h6 class="card-title text-primary mb-4">Video Submission</h6>
                                        <?php if (!empty($app['video_path'])): ?>
                                            <video controls class="w-100 rounded mb-3" style="max-height: 300px;">
                                                <source src="../uploads/<?php echo htmlspecialchars($app['video_path']); ?>" type="video/mp4">
                                                Your browser does not support the video tag.
                                            </video>
                                            <a href="../uploads/<?php echo htmlspecialchars($app['video_path']); ?>" class="btn btn-sm btn-primary btn-new" target="_blank"><i class="fas fa-download me-2"></i>Download Video</a>
                                        <?php else: ?>
                                            <p style="color:var(--text-secondary);" class="mb-0">No video uploaded</p>
                                        <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
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
                    form.action = 'applications.php';
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
    </script>
</body>

</html>