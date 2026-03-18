<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Digital Inspection & Tax Mapping System | BPLO Borongan City</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <div class="sidebar-header">
            <div class="logo-placeholder mb-3">
                <i class="fas fa-building-columns"></i>
            </div>
            <h4>BPLO System</h4>
            <p>Digital Inspection & Tax Mapping</p>
        </div>
        <nav class="sidebar-nav">
            <a href="dashboard.php" class="nav-item active">
                <i class="fas fa-tachometer-alt"></i> Dashboard
            </a>
            <a href="#" class="nav-item">
                <i class="fas fa-building"></i> Business Records
            </a>
            <a href="#" class="nav-item">
                <i class="fas fa-search"></i> Inspections
            </a>
            <a href="#" class="nav-item">
                <i class="fas fa-map-marked-alt"></i> Tax Mapping
            </a>
            <a href="#" class="nav-item">
                <i class="fas fa-file-alt"></i> Reports
            </a>
            <a href="#" class="nav-item">
                <i class="fas fa-users"></i> Users
            </a>
            <a href="#" class="nav-item">
                <i class="fas fa-cog"></i> Settings
            </a>
            <a href="logout.php" class="nav-item">
                <i class="fas fa-sign-out-alt"></i> Logout
            </a>
        </nav>
    </div>

    <!-- Main Content -->
    <div class="main-wrapper">
        <!-- Top Navbar -->
        <header class="top-navbar">
            <div class="d-flex align-items-center justify-content-between">
                <h2 class="mb-0"><i class="fas fa-tachometer-alt me-2 text-gold"></i>Dashboard</h2>
                <div class="user-menu dropdown">
                    <a href="#" class="d-flex align-items-center text-decoration-none dropdown-toggle" data-bs-toggle="dropdown">
                        <img src="https://via.placeholder.com/40x40/1E3A8A/FFFFFF?text=" class="rounded-circle me-2">
                        <span></span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" href="#"><i class="fas fa-user me-2"></i>Profile</a></li>
                        <li><a class="dropdown-item" href="logout.php"><i class="fas fa-sign-out-alt me-2"></i>Logout</a></li>
                    </ul>
                </div>
            </div>
        </header>

        <!-- Content -->
        <main class="content">
            <div class="container-fluid">
                <!-- Stats Cards -->
                <div class="row g-4 mb-5">
                    <div class="col-xl-3 col-md-6">
                        <div class="stat-card blue">
                            <div class="stat-icon"><i class="fas fa-building"></i></div>
                            <div>
                                <h3></h3>
                                <p>Total Businesses</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6">
                        <div class="stat-card gold">
                            <div class="stat-icon"><i class="fas fa-search"></i></div>
                            <div>
                                <h3></h3>
                                <p>Total Inspections</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6">
                        <div class="stat-card orange">
                            <div class="stat-icon"><i class="fas fa-clock"></i></div>
                            <div>
                                <h3></h3>
                                <p>Pending Inspections</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6">
                        <div class="stat-card green">
                            <div class="stat-icon"><i class="fas fa-check-circle"></i></div>
                            <div>
                                <h3></h3>
                                <p>Completed Inspections</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row g-4">
                    <!-- Recent Inspections -->
                    <div class="col-lg-8">
                        <div class="card">
                            <div class="card-header">
                                <h5><i class="fas fa-list me-2 text-gold"></i>Recent Inspections</h5>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>Business</th>
                                                <th>Inspector</th>
                                                <th>Date</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            
                                            <tr>
                                                <td>what the</td>
                                                <td>what teh</td>
                                                <td>what the</td>
                                                <td>
                                                   
                                                        <span class="badge bg-warning text-dark">Pending</span>
                                                   
                                                        <span class="badge bg-success">Completed</span>
                                                  
                                                        <span class="badge bg-secondary">Draft</span>
                                                   
                                                </td>
                                                <td>
                                                    <button class="btn btn-sm btn-outline-primary">View</button>
                                                </td>
                                            </tr>
                                            
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Map Placeholder -->
                    <div class="col-lg-4">
                        <div class="card h-100">
                            <div class="card-header">
                                <h5><i class="fas fa-map me-2 text-gold"></i>Tax Mapping</h5>
                            </div>
                            <div class="card-body text-center p-4">
                                <div class="map-placeholder">
                                    <i class="fas fa-map-marked-alt fa-4x text-muted mb-3"></i>
                                    <h6>Google Maps Integration</h6>
                                    <p class="text-muted small">Business locations & tax zones</p>
                                    <button class="btn btn-outline-gold btn-sm">Configure Map</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>