<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Digital Inspection and Tax Mapping System</title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- FontAwesome 6 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    
    <style>
        :root {
            --primary-gold: #D4AF37;
            --secondary-gold: #F4E4BC;
            --light-gold: #FFF8DC;
            --white: #FFFFFF;
            --whitesmoke: #F8F9FA;
            --text-dark: #2C3E50;
            --text-muted: #6C757D;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: var(--whitesmoke);
            color: var(--text-dark);
        }

        /* Sidebar Styles */
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            width: 260px;
            height: 100vh;
            background: var(--white);
            box-shadow: 2px 0 10px rgba(0,0,0,0.1);
            z-index: 1030;
            transition: all 0.3s ease;
        }

        .sidebar-logo {
            padding: 2rem 1.5rem;
            background: linear-gradient(135deg, var(--primary-gold), var(--secondary-gold));
            text-align: center;
            border-bottom: 1px solid rgba(255,255,255,0.3);
        }

        .sidebar-logo h3 {
            color: var(--white);
            font-weight: 700;
            margin: 0;
            font-size: 1.4rem;
            text-shadow: 1px 1px 2px rgba(0,0,0,0.2);
        }

        .sidebar-logo p {
            color: rgba(255,255,255,0.9);
            margin: 0.25rem 0 0 0;
            font-size: 0.9rem;
        }

        .sidebar-nav .nav-link {
            color: var(--text-dark);
            padding: 0.85rem 1.5rem;
            border-left: 4px solid transparent;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .sidebar-nav .nav-link:hover,
        .sidebar-nav .nav-link.active {
            background-color: var(--light-gold);
            color: var(--primary-gold);
            border-left-color: var(--primary-gold);
        }

        .sidebar-nav .nav-link i {
            width: 20px;
            margin-right: 10px;
        }

        /* Top Header */
        .top-header {
            position: fixed;
            top: 0;
            right: 0;
            left: 260px;
            height: 70px;
            background: var(--white);
            border-bottom: 1px solid #dee2e6;
            z-index: 1020;
            padding: 0 1.5rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .main-content {
            margin-left: 260px;
            margin-top: 70px;
            padding: 2rem;
            min-height: calc(100vh - 70px);
        }

        /* Stats Cards */
        .stat-card {
            background: var(--white);
            border: none;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.08);
            transition: all 0.3s ease;
            overflow: hidden;
        }

        .stat-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.15);
        }

        .stat-card-header {
            background: linear-gradient(135deg, var(--primary-gold), var(--secondary-gold));
            color: white;
            padding: 1.25rem 1.5rem;
        }

        .stat-number {
            font-size: 2.25rem;
            font-weight: 700;
            line-height: 1;
        }

        .stat-label {
            font-size: 0.9rem;
            opacity: 0.95;
            font-weight: 500;
        }

        .stat-icon {
            position: absolute;
            right: 1.5rem;
            top: 50%;
            transform: translateY(-50%);
            font-size: 2.5rem;
            opacity: 0.15;
        }

        /* Table Styles */
        .table-container {
            background: var(--white);
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.08);
            overflow: hidden;
        }

        .table thead th {
            background: var(--light-gold);
            border: none;
            font-weight: 600;
            color: var(--text-dark);
            padding: 1.25rem 1rem;
            border-bottom: 2px solid #e9ecef;
        }

        .table tbody td {
            padding: 1.25rem 1rem;
            vertical-align: middle;
            border-color: #f8f9fa;
        }

        .table tbody tr:hover {
            background-color: var(--light-gold);
        }

        /* Badge Styles */
        .badge-gold {
            background-color: var(--primary-gold);
            color: white;
        }

        /* Responsive */
        @media (max-width: 992px) {
            .sidebar {
                transform: translateX(-100%);
            }
            
            .top-header {
                left: 0;
            }
            
            .main-content {
                margin-left: 0;
            }
        }

        /* Mobile Toggle */
        .sidebar-toggle {
            display: none;
        }

        @media (max-width: 992px) {
            .sidebar-toggle {
                display: block;
            }
        }
    </style>
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
                    <a class="nav-link active" href="#">
                        <i class="fas fa-tachometer-alt"></i>
                        Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">
                    <i class="fas fa-store"></i> Businesses
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">
                    <i class="fas fa-search"></i> Inspections
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">
                    <i class="fas fa-map-marked-alt"></i> Tax Mapping
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">
                    <i class="fas fa-chart-bar"></i> Reports
                    </a>
                </li>
                <li class="nav-item border-top mt-2 pt-2">
                    <a class="nav-link" href="#">
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
                Dashboard Overview
            </h5>
        </div>
        <div class="d-flex align-items-center">
            <div class="dropdown">
                <a class="d-flex align-items-center text-decoration-none dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                    <img src="https://via.placeholder.com/40x40/2C3E50/FFFFFF?text=JD" class="rounded-circle" width="40" height="40" alt="User">
                    <span class="ms-2 d-none d-md-inline fw-semibold">John Dela Cruz</span>
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
            <div class="d-flex gap-2">
                <button class="btn btn-outline-primary">
                    <i class="fas fa-download me-2"></i>Export Report
                </button>
                <button class="btn btn-primary">
                    <i class="fas fa-plus me-2"></i>New Record
                </button>
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

        <!-- Recent Records Table -->
        <div class="row">
            <div class="col-12">
                <div class="table-container">
                   
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table mb-0">
                                <thead>
                                    <tr>
                                        <th>Business</th>
                                        <th>Owner</th>                                                         
                                        <th>Status</th>
                                        <th>Date</th>      
                                        <th>Location</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Borongan Supermarket</td>
                                        <td>Maria Santos</td>
                                        <td><span class="badge bg-success">Completed</span></td>
                                        <td>Jan 15, 2024</td>
                                        <td>Songco</td>
                                       
                                        <td>
                                            <button class="btn btn-sm btn-outline-primary">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Borongan Supermarket</td>
                                        <td>Maria Santos</td>
                                        <td><span class="badge bg-success">Completed</span></td>
                                        <td>Jan 15, 2024</td>
                                        <td>Songco</td>
                                       
                                        <td>
                                            <button class="btn btn-sm btn-outline-primary">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Borongan Supermarket</td>
                                        <td>Maria Santos</td>
                                        <td><span class="badge bg-success">Completed</span></td>
                                        <td>Jan 15, 2024</td>
                                        <td>Songco</td>
                                       
                                        <td>
                                            <button class="btn btn-sm btn-outline-primary">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Borongan Supermarket</td>
                                        <td>Maria Santos</td>
                                        <td><span class="badge bg-success">Completed</span></td>
                                        <td>Jan 15, 2024</td>
                                        <td>Songco</td>
                                       
                                        <td>
                                            <button class="btn btn-sm btn-outline-primary">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Borongan Supermarket</td>
                                        <td>Maria Santos</td>
                                        <td><span class="badge bg-success">Completed</span></td>
                                        <td>Jan 15, 2024</td>
                                        <td>Songco</td>
                                       
                                        <td>
                                            <button class="btn btn-sm btn-outline-primary">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    
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