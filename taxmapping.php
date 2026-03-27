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
    
    

    <link href="assets/css/dashboard.css" rel="stylesheet">
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/all.min.css">

    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css"/>
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    
  
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
                    <a class="nav-link active" href="taxmapping.php">
                    <i class="fas fa-map-marked-alt"></i> Tax Mapping
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">
                    <i class="fas fa-chart-bar"></i> Reports
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
                Tax Mapping Overview
            </h5>
        </div>
        <div class="d-flex align-items-center">
            <div class="dropdown">
                <a class="d-flex align-items-center text-decoration-none dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                    <img src="assets/img/borlogo.png" class="rounded-circle" width="40" height="40" alt="User">
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

        <!-- Stats Cards -->
        <div class="row g-4 mb-5">
            <div class="col-lg-3 col-md-6">
                <div class="card stat-card h-100">
                    <div class="card-body position-relative p-0">
                        <div class="stat-card-header">
                            <div class="stat-number">1,247</div>
                            <div class="stat-label">Total Businesses</div>
                            <i class="fas fa-users stat-icon"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="card stat-card h-100">
                    <div class="card-body position-relative p-0">
                        <div class="stat-card-header">
                            <div class="stat-number">892</div>
                            <div class="stat-label">Inspected</div>
                            <i class="fas fa-boxes stat-icon"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="card stat-card h-100">
                    <div class="card-body position-relative p-0">
                        <div class="stat-card-header">
                            <div class="stat-number">56</div>
                            <div class="stat-label">Pending Inspection</div>
                            <i class="fas fa-coins stat-icon"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="card stat-card h-100">
                    <div class="card-body position-relative p-0">
                        <div class="stat-card-header">
                            <div class="stat-number">35</div>
                            <div class="stat-label">Violations</div>
                            <i class="fas fa-chart-line stat-icon"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

      
        <!-- Map -->
        <div class="row">

            <!-- FILTERS -->
            <div class="col-md-3">

                <div class="card">

                    <div class="card-header fw-bold">
                        Filters
                    </div>

                    <div class="card-body">

                        <div class="mb-2">
                            <label>Barangay</label>
                            <select class="form-control" id="filterBarangay">
                                <option value="">All</option>
                            </select>
                        </div>

                        <div class="mb-2">
                            <label>Status</label>
                            <select class="form-control" id="filterStatus">
                                <option value="">All</option>
                                <option value="Inspected">Inspected</option>
                                <option value="Pending">Pending</option>
                            </select>
                        </div>

                        <div class="mb-2">
                            <label>Search</label>
                            <input type="text" id="filterSearch" class="form-control">
                        </div>

                    </div>

                </div>

            </div>


                    <!-- MAP -->
                    <div class="col-md-9">

                        <div class="card">

                            <div class="card-header fw-bold">
                                Tax Map
                            </div>

                            <div class="card-body">

                                <div id="map" style="height:500px;"></div>

                            </div>

                        </div>

                    </div>

                    </div>
    </main>

     <script src="assets/js/jquery-4.0.0.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    
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


            // map
        var map = L.map('map').setView([11.6087, 125.4319], 13); // Borongan

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: 'Map data'
            }).addTo(map);


            // test marker
            L.marker([11.6087, 125.4319])
                .addTo(map)
                .bindPopup("Borongan City Hall")
                .openPopup();

    </script>
</body>
</html>