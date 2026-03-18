<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Digital Inspection and Tax Mapping System - Admin Dashboard</title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    <style>
        :root {
            --primary-gold: #D4AF37;
            --dark-gold: #B8860B;
            --sidebar-bg: #8B4513;
            --header-gold: #DAA520;
            --card-bg: #FFFFFF;
            --bg-light: #F8F9FA;
            --text-dark: #2C3E50;
            --text-muted: #6C757D;
            --border-light: #E9ECEF;
        }

        * {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background-color: var(--bg-light);
            color: var(--text-dark);
        }

        /* Sidebar */
        .sidebar {
            background: linear-gradient(180deg, var(--sidebar-bg) 0%, #A0522D 100%);
            min-height: 100vh;
            width: 260px;
            position: fixed;
            left: 0;
            top: 0;
            z-index: 1000;
            box-shadow: 4px 0 15px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
        }

        .sidebar-logo {
            background: rgba(255,255,255,0.1);
            padding: 25px 20px;
            border-bottom: 1px solid rgba(255,255,255,0.1);
            text-align: center;
        }

        .sidebar-logo i {
            font-size: 2.5rem;
            color: var(--primary-gold);
            margin-bottom: 10px;
        }

        .sidebar-title {
            color: white;
            font-size: 1.1rem;
            font-weight: 600;
            margin: 0;
            line-height: 1.2;
        }

        .sidebar-subtitle {
            color: rgba(255,255,255,0.8);
            font-size: 0.85rem;
            margin: 0;
        }

        .nav-link {
            color: rgba(255,255,255,0.85);
            padding: 12px 20px;
            border-radius: 0;
            margin: 2px 10px;
            transition: all 0.3s ease;
            font-weight: 500;
        }

        .nav-link:hover, .nav-link.active {
            background: rgba(212, 175, 55, 0.2);
            color: var(--primary-gold);
            border-left: 4px solid var(--primary-gold);
            margin-left: 6px;
        }

        .nav-link i {
            width: 20px;
            margin-right: 12px;
        }

        /* Main Content */
        .main-content {
            margin-left: 260px;
            min-height: 100vh;
            padding: 20px;
        }

        /* Header */
        .header {
            background: var(--card-bg);
            border-radius: 12px;
            padding: 20px 25px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.08);
            margin-bottom: 25px;
            border: 1px solid var(--border-light);
        }

        .header-title {
            color: var(--text-dark);
            font-size: 1.6rem;
            font-weight: 600;
            margin: 0;
        }

        .header-subtitle {
            color: var(--text-muted);
            font-size: 0.95rem;
            margin: 0;
        }

        /* Stats Cards */
        .stats-card {
            background: var(--card-bg);
            border-radius: 12px;
            padding: 25px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.08);
            border: 1px solid var(--border-light);
            transition: all 0.3s ease;
            height: 100%;
            position: relative;
            overflow: hidden;
        }

        .stats-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.12);
        }

        .stats-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, var(--primary-gold), var(--dark-gold));
        }

        .stats-icon {
            width: 60px;
            height: 60px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            margin-bottom: 15px;
            color: white;
        }

        .stats-number {
            font-size: 2.2rem;
            font-weight: 700;
            color: var(--text-dark);
            margin-bottom: 5px;
            line-height: 1;
        }

        .stats-label {
            color: var(--text-muted);
            font-weight: 500;
            font-size: 0.95rem;
            margin: 0;
        }

        /* Table */
        .table-container {
            background: var(--card-bg);
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0,0,0,0.08);
            border: 1px solid var(--border-light);
        }

        .table thead th {
            background: linear-gradient(135deg, var(--primary-gold), var(--dark-gold));
            color: white;
            font-weight: 600;
            border: none;
            padding: 18px 15px;
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .table tbody td {
            padding: 16px 15px;
            vertical-align: middle;
            border-color: var(--border-light);
        }

        .table tbody tr:hover {
            background-color: rgba(212, 175, 55, 0.05);
        }

        .badge {
            font-size: 0.8rem;
            padding: 6px 12px;
            border-radius: 20px;
            font-weight: 600;
        }

        .badge-success { background: #D4EDDA; color: #155724; }
        .badge-warning { background: #FFF3CD; color: #856404; }
        .badge-danger { background: #F8D7DA; color: #721C24; }

        /* Responsive */
        @media (max-width: 992px) {
            .sidebar {
                transform: translateX(-100%);
            }
            
            .main-content {
                margin-left: 0;
            }
        }

        @media (max-width: 768px) {
            .stats-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <div class="sidebar-logo">
            <i class="fas fa-building-columns"></i>
            <h3 class="sidebar-title">DITMS</h3>
            <p class="sidebar-subtitle">Borongan City</p>
        </div>
        
        <nav class="mt-4">
            <a href="#" class="nav-link active">
                <i class="fas fa-tachometer-alt"></i> Dashboard
            </a>
            <a href="#" class="nav-link">
                <i class="fas fa-store"></i> Businesses
            </a>
            <a href="#" class="nav-link">
                <i class="fas fa-search"></i> Inspections
            </a>
            <a href="#" class="nav-link">
                <i class="fas fa-map-marked-alt"></i> Tax Mapping
            </a>
            <a href="#" class="nav-link">
                <i class="fas fa-chart-bar"></i> Reports
            </a>
            <a href="#" class="nav-link">
                <i class="fas fa-users"></i> Users
            </a>
            <a href="#" class="nav-link">
                <i class="fas fa-sign-out-alt"></i> Logout
            </a>
        </nav>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <!-- Header -->
        <div class="header">
            <h1 class="header-title">Dashboard</h1>
            <p class="header-subtitle">Digital Inspection and Tax Mapping System - Business Permits and Licensing Office</p>
        </div>

        <!-- Stats Cards -->
        <div class="row mb-5 g-4 stats-grid" style="grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));">
            <div class="col-lg-3 col-md-6">
                <div class="stats-card">
                    <div class="stats-icon" style="background: linear-gradient(135deg, var(--primary-gold), var(--dark-gold));">
                        <i class="fas fa-store"></i>
                    </div>
                    <h2 class="stats-number">1,247</h2>
                    <p class="stats-label">Total Businesses</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="stats-card">
                    <div class="stats-icon" style="background: linear-gradient(135deg, #28A745, #20C997);">
                        <i class="fas fa-check-circle"></i>
                    </div>
                    <h2 class="stats-number">1,156</h2>
                    <p class="stats-label">Inspected</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="stats-card">
                    <div class="stats-icon" style="background: linear-gradient(135deg, #FFC107, #FDAF17);">
                        <i class="fas fa-clock"></i>
                    </div>
                    <h2 class="stats-number">91</h2>
                    <p class="stats-label">Pending Inspection</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="stats-card">
                    <div class="stats-icon" style="background: linear-gradient(135deg, #DC3545, #C82333);">
                        <i class="fas fa-exclamation-triangle"></i>
                    </div>
                    <h2 class="stats-number">23</h2>
                    <p class="stats-label">Violations</p>
                </div>
            </div>
        </div>

        <!-- Recent Inspections Table -->
        <div class="table-container">
            <div class="p-4 border-bottom" style="background: rgba(212, 175, 55, 0.05);">
                <h5 class="mb-0 fw-bold" style="color: var(--dark-gold);">
                    <i class="fas fa-table me-2"></i>Recent Inspection Records
                </h5>
            </div>
            <div class="table-responsive">
                <table class="table mb-0">
                    <thead>
                        <tr>
                            <th>Business Name</th>
                            <th>Owner</th>
                            <th>Status</th>
                            <th>Date</th>
                            <th>Location</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <strong>Golden Rice Retail Store</strong>
                            </td>
                            <td>Juan Dela Cruz</td>
                            <td><span class="badge badge-success">Cleared</span></td>
                            <td>2024-01-15</td>
                            <td>Barangay A</td>
                            <td>
                                <button class="btn btn-sm btn-outline-primary">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <strong>Seaside Hardware</strong>
                            </td>
                            <td>Maria Santos</td>
                            <td><span class="badge badge-warning">Pending</span></td>
                            <td>2024-01-16</td>
                            <td>Barangay B</td>
                            <td>
                                <button class="btn btn-sm btn-outline-primary">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <strong>Borongan Pharmacy</strong>
                            </td>
                            <td>Pedro Reyes</td>
                            <td><span class="badge badge-danger">Violation</span></td>
                            <td>2024-01-14</td>
                            <td>Barangay C</td>
                            <td>
                                <button class="btn btn-sm btn-outline-primary">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <strong>City Coffee Shop</strong>
                            </td>
                            <td>Ana Lopez</td>
                            <td><span class="badge badge-success">Cleared</span></td>
                            <td>2024-01-13</td>
                            <td>Barangay D</td>
                            <td>
                                <button class="btn btn-sm btn-outline-primary">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <strong>Surfside Eatery</strong>
                            </td>
                            <td>Carlos Garcia</td>
                            <td><span class="badge badge-success">Cleared</span></td>
                            <td>2024-01-12</td>
                            <td>Barangay E</td>
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

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>