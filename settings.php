<?php
session_start();

if(!isset($_SESSION["user"])){
    header("Location: index.html");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Digital Inspection and Tax Mapping System</title>
    <link href="assets/img/borlogo.png" rel="icon">
    
    <!-- Bootstrap 5 CSS -->
 

    <link href="assets/css/dashboard.css" rel="stylesheet">
    
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/all.min.css">
    <link rel="stylesheet" href="assets/css/settings.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    
    
  
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <div class="sidebar-logo">
            <h3><i class="fas fa-shield-alt me-2"></i>DITMS</h3>
            <p>Digital Inspection and Tax Mapping System</p>
        </div>
        <nav class="sidebar-nav mt-3">
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link" href="dashboard.php">
                        <i class="fas fa-tachometer-alt"></i>
                        Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="business.php">
                    <i class="fas fa-store"></i> Businesses
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="inspections.php">
                    <i class="fas fa-search"></i> Inspections
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="taxmapping.php">
                    <i class="fas fa-map-marked-alt"></i> Tax Mapping
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="reports.php">
                    <i class="fas fa-chart-bar"></i> Reports
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link active" href="settings.php">
                    <i class="fas fa-gear"></i> Settings
                    </a>
                </li>
                <li class="nav-item border-top mt-2 pt-2">
                    <a class="nav-link" href="php/logout.php">
                        <i class="fas fa-sign-out-alt"></i>
                        Logout
                    </a>
                </li>
            </ul>
        </nav>
    </div>

    <!-- Top Header -->
    <header class="top-header">
        <div class="d-flex align-items-center">
            <button class="sidebar-toggle btn btn-link text-decoration-none d-lg-none me-3">
                <i class="fas fa-bars fs-4"></i>
            </button>
            <h5 class="mb-0 fw-bold text-dark">
                <i class="fas fa-home me-2"></i>
                Settings Overview
            </h5>
        </div>
        <div class="d-flex align-items-center">
            <div class="dropdown">
                <a class="d-flex align-items-center text-decoration-none dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                <img src="uploads/<?= $settings['logo'] ?? 'default.png' ?>"  class="rounded-circle" width="40" height="40" alt="User">
                    <span class="ms-2 d-none d-md-inline fw-semibold">Administrator</span>
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li><a class="dropdown-item" href="#"><i class="fas fa-user me-2"></i>Profile</a></li>
                    <li><a class="dropdown-item" href="#"><i class="fas fa-cog me-2"></i>Settings</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item" href="#"><i class="fas fa-sign-out-alt me-2"></i>Logout</a></li>
                </ul>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="main-content">
        <!-- Page Title -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2 class="mb-1 fw-bold text-dark">Digital Inspection and Tax Mapping System</h2>
                <p class="mb-0 text-muted">Borongan City, Eastern Samar</p>
            </div>
         
        </div>

        <div class="container-fluid px-lg-4 px-md-3">
       

        <!-- Main Settings Panels -->
        <div class="row g-4 mb-5">
            <!-- System Information -->
            <div class="col-lg-7">
                <div class="settings-card h-100">
                    <div class="section-header">
                        <div class="section-icon">
                            <i class="bi bi-info-circle-fill"></i>
                        </div>
                        <div>
                            <h3 class="h4 mb-1 fw-bold">System Information</h3>
                            <p class="text-muted mb-0">Configure municipality details</p>
                        </div>
                    </div>

                    <div class="row g-4">
                        <div class="col-md-6">
                            <label class="form-label">Municipality Name</label>
                            <input type="text" id="municipality" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Province</label>
                            <input type="text" id="province" class="form-control">
                        </div>
                    </div>

                    <div class="mt-4">
                        <label class="form-label">Municipality Logo</label>

                        <div class="logo-upload-area text-center p-4 border rounded"
                            style="cursor:pointer;"
                            onclick="document.getElementById('logoInput').click()">

                            <!-- PREVIEW IMAGE -->
                            <img id="logoPreview"
                                src=""
                                style="max-width:150px; display:none; margin-bottom:10px; border-radius:10px;" />

                            <!-- PLACEHOLDER -->
                            <div id="uploadPlaceholder">
                                <i class="bi bi-cloud-upload display-4 text-muted mb-3 d-block"></i>
                                <p class="fw-semibold text-muted mb-2">Click to upload logo</p>
                                <p class="text-muted small mb-0">PNG, JPG, SVG up to 2MB</p>
                            </div>

                            <input type="file" id="logoInput" class="d-none" accept="image/*">
                        </div>
                    </div>
                    

                    <div class="mt-5 pt-4 border-top">
                    <button class="btn btn-primary-gold w-100" onclick="saveSystem()">
                            <i class="bi bi-save me-2"></i>
                            Save System Information
                        </button>
                    </div>
                </div>
            </div>

            <!-- Account Settings -->
            <div class="col-lg-5">
                <div class="settings-card h-100">
                    <div class="section-header">
                        <div class="section-icon">
                            <i class="bi bi-person-fill"></i>
                        </div>
                        <div>
                            <h3 class="h4 mb-1 fw-bold">Account Settings</h3>
                            <p class="text-muted mb-0">Update your account security</p>
                        </div>
                    </div>

                    <form onsubmit="event.preventDefault(); updatePassword();">

                        <div class="mb-3">
                            <label class="form-label">Current Password</label>
                            <input type="password" id="current_password" class="form-control" placeholder="Enter current password">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">New Password</label>
                            <input type="password" id="new_password" class="form-control" placeholder="Enter new password">
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Confirm Password</label>
                            <input type="password" id="confirm_password" class="form-control" placeholder="Confirm new password">
                        </div>

                        <button type="submit" class="btn btn-primary-gold w-100">
                            <i class="bi bi-lock-fill me-2"></i>
                            Update Password
                        </button>

                    </form>
                </div>
            </div>
        </div>

        <!-- Map Settings -->
        <div class="row g-4">
            <div class="col-12">
                <div class="settings-card">
                    <div class="section-header">
                        <div class="section-icon">
                            <i class="bi bi-geo-alt-fill"></i>
                        </div>
                        <div>
                            <h3 class="h4 mb-1 fw-bold">Map Settings</h3>
                            <p class="text-muted mb-0">Configure default map view</p>
                        </div>
                    </div>

                    <div class="row g-4">
                        <div class="col-lg-4 col-md-6">
                            <label class="form-label">Default Latitude</label>
                            <input type="number" step="any" class="form-control" value="14.5995" placeholder="0.0000">
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <label class="form-label">Default Longitude</label>
                            <input type="number" step="any" class="form-control" value="120.9842" placeholder="0.0000">
                        </div>
                        <div class="col-lg-4 col-md-12">
                            <label class="form-label">Zoom Level</label>
                            <input type="range" class="form-range" min="1" max="20" value="13" id="zoomRange">
                            <input type="number" class="form-control mt-2" value="13" min="1" max="20" id="zoomInput">
                        </div>
                    </div>

                    <div class="mt-5 pt-4 border-top">
                        <button class="btn btn-primary-gold btn-lg w-100">
                            <i class="bi bi-map-fill me-2"></i>
                            Save Map Settings
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
        
      
    </main>


 
    <script src="assets/js/jquery-4.0.0.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="js/settings.js"></script>
    
    <script>
        // Sidebar toggle for mobile
        document.querySelector('.sidebar-toggle').addEventListener('click', function() {
            document.querySelector('.sidebar').style.transform = 
                document.querySelector('.sidebar').style.transform === 'translateX(-100%)' ? 
                'translateX(0)' : 'translateX(-100%)';
        });

        // Close sidebar when clicking outside on mobile
        document.addEventListener('click', function(event) {
            const sidebar = document.querySelector('.sidebar');
            const toggle = document.querySelector('.sidebar-toggle');
            
            if (window.innerWidth <= 992 && 
                !sidebar.contains(event.target) && 
                !toggle.contains(event.target)) {
                sidebar.style.transform = 'translateX(-100%)';
            }
        });



    </script>
</body>
</html>