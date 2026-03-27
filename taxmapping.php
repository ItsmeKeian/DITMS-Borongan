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
    <link rel="stylesheet" href="assets/css/taxmapping.css">

    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css"/>
    
    
  
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
                                <option value="">Songco</option>
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


                        <hr>

                        <h6>Legend</h6>

                        <div class="legend">

                            <div><span class="box green"></span> Existing</div>
                            <div><span class="box red"></span> Unregistered</div>
                            <div><span class="box blue"></span> New</div>
                            <div><span class="box gray"></span> Closed</div>
                            <div><span class="box orange"></span> Transferred</div>

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

                                <div id="map" style="height:640px;"></div>

                            </div>

                        </div>

                    </div>

                    </div>
    </main>

     <script src="assets/js/jquery-4.0.0.min.js"></script>
     <script src="assets/js/bootstrap.bundle.min.js"></script>
     <script src="js/taxmapping.js"></script>
     <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
 
    
    
</body>
</html>