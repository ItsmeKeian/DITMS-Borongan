<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Digital Inspection and Tax Mapping System</title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- FontAwesome 6 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        :root {
            --gold-primary: #D4AF37;
            --gold-dark: #B8942F;
            --gold-darker: #8B5A2B;
            --bg-light: #F8F9FA;
            --card-bg: #FFFFFF;
            --text-dark: #2C3E50;
            --text-muted: #6C757D;
            --border-light: #E9ECEF;
            --shadow: 0 4px 20px rgba(0,0,0,0.08);
            --shadow-hover: 0 8px 30px rgba(0,0,0,0.12);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: var(--bg-light);
            color: var(--text-dark);
        }

        /* Sidebar */
        .sidebar {
            position: fixed;
            left: 0;
            top: 0;
            width: 280px;
            height: 100vh;
            background: linear-gradient(180deg, var(--gold-darker) 0%, var(--gold-dark) 100%);
            z-index: 1035;
            box-shadow: 4px 0 20px rgba(139, 90, 43, 0.3);
        }

        .sidebar-header {
            padding: 2.5rem 2rem 2rem;
            border-bottom: 1px solid rgba(255,255,255,0.1);
            text-align: center;
        }

        .logo-container {
            width: 80px;
            height: 80px;
            background: rgba(255,255,255,0.95);
            border-radius: 16px;
            margin: 0 auto 1.25rem;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 6px 20px rgba(0,0,0,0.2);
        }

        .logo-icon {
            font-size: 2.5rem;
            color: var(--gold-primary);
        }

        .sidebar-title {
            font-size: 1.25rem;
            font-weight: 700;
            color: white;
            margin-bottom: 0.25rem;
            letter-spacing: -0.5px;
        }

        .sidebar-subtitle {
            color: rgba(255,255,255,0.85);
            font-size: 0.9rem;
            font-weight: 500;
        }

        .sidebar-menu {
            padding: 1.5rem 0;
        }

        .nav-item {
            display: flex;
            align-items: center;
            padding: 1rem 2rem;
            color: rgba(255,255,255,0.85);
            text-decoration: none;
            transition: all 0.3s ease;
            border-left: 4px solid transparent;
            margin-bottom: 0.25rem;
        }

        .nav-item:hover,
        .nav-item.active {
            background: rgba(255,255,255,0.15);
            color: white;
            border-left-color: var(--gold-primary);
        }

        .nav-icon {
            width: 24px;
            margin-right: 1.25rem;
            font-size: 1.2rem;
            text-align: center;
        }

        /* Main Layout */
        .main-wrapper {
            margin-left: 280px;
            min-height: 100vh;
        }

        /* Top Header */
        .header {
            background: var(--card-bg);
            border-bottom: 1px solid var(--border-light);
            padding: 1.5rem 2.5rem;
            box-shadow: var(--shadow);
        }

        .header-title {
            font-size: 1.75rem;
            font-weight: 700;
            color: var(--text-dark);
            margin-bottom: 0.25rem;
        }

        .header-subtitle {
            color: var(--text-muted);
            font-weight: 500;
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .user-avatar {
            width: 45px;
            height: 45px;
            background: linear-gradient(135deg, var(--gold-primary), var(--gold-dark));
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 700;
            font-size: 1.1rem;
        }

        /* Content Area */
        .content {
            padding: 2.5rem;
        }

        /* Stat Cards */
        .stats-grid {
            margin-bottom: 3rem;
        }

        .stat-card {
            background: var(--card-bg);
            border-radius: 16px;
            padding: 2.25rem 2rem;
            box-shadow: var(--shadow);
            transition: all 0.3s ease;
            border: 1px solid var(--border-light);
            position: relative;
            overflow: hidden;
        }

        .stat-card:hover {
            transform: translateY(-8px);
            box-shadow: var(--shadow-hover);
        }

        .stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, var(--gold-primary), var(--gold-dark));
        }

        .stat-number {
            font-size: 2.75rem;
            font-weight: 800;
            color: var(--text-dark);
            line-height: 1;
            margin-bottom: 0.5rem;
        }

        .stat-label {
            font-size: 1rem;
            font-weight: 600;
            color: var(--text-muted);
            margin: 0;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .stat-icon-large {
            position: absolute;
            right: 1.75rem;
            top: 1.75rem;
            font-size: 3.5rem;
            opacity: 0.08;
            color: var(--gold-primary);
        }

        /* Data Table */
        .data-section {
            background: var(--card-bg);
            border-radius: 16px;
            box-shadow: var(--shadow);
            border: 1px solid var(--border-light);
            overflow: hidden;
        }

        .section-header {
            padding: 1.75rem 2.25rem;
            background: #F8F9FA;
            border-bottom: 1px solid var(--border-light);
        }

        .section-title {
            font-size: 1.25rem;
            font-weight: 700;
            color: var(--text-dark);
            margin: 0;
        }

        .table-custom {
            margin: 0;
        }

        .table-custom thead th {
            background: #F8F9FA;
            border: none;
            font-weight: 700;
            color: var(--text-dark);
            padding: 1.5rem 2rem;
            border-bottom: 2px solid var(--border-light);
            text-transform: uppercase;
            font-size: 0.85rem;
            letter-spacing: 0.5px;
        }

        .table-custom td {
            padding: 1.5rem 2rem;
            vertical-align: middle;
            border-color: #F8F9FA;
        }

        .table-custom tbody tr:hover {
            background: #F8FAFC;
        }

        .status-badge {
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-weight: 600;
            font-size: 0.85rem;
        }

        .status-active { background: #D4EDDA; color: #155724; }
        .status-pending { background: #FFF3CD; color: #856404; }
        .status-completed { background: #D1ECF1; color: #0C5460; }

        .business-avatar {
            width: 45px;
            height: 45px;
            background: linear-gradient(135deg, var(--gold-primary), var(--gold-dark));
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 700;
            font-size: 0.9rem;
            margin-right: 1rem;
        }

        /* Responsive */
        @media (max-width: 1200px) {
            .sidebar {
                width: 260px;
            }
            .main-wrapper {
                margin-left: 260px;
            }
        }

        @media (max-width: 992px) {
            .sidebar {
                transform: translateX(-100%);
            }
            .main-wrapper {
                margin-left: 0;
            }
            .sidebar.show {
                transform: translateX(0);
            }
            .content {
                padding: 1.75rem;
            }
        }

        @media (max-width: 768px) {
            .stat-number {
                font-size: 2.25rem;
            }
            .header {
                padding: 1.25rem 1.5rem;
            }
            .content {
                padding: 1.5rem 1rem;
            }
        }

        /* Utilities */
        .text-gold { color: var(--gold-primary) !important; }
        .bg-gold-light { background-color: rgba(212, 175, 55, 0.1) !important; }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <nav class="sidebar">
        <div class="sidebar-header">
            <div class="logo-container">
                <i class="fas fa-building-columns logo-icon"></i>
            </div>
            <h3 class="sidebar-title">Digital Inspection</h3>
            <h3 class="sidebar-title">Tax Mapping System</h3>
            <p class="sidebar-subtitle">BPLO Borongan City</p>
        </div>
        
        <div class="sidebar-menu">
            <a href="#" class="nav-item active">
                <i class="fas fa-tachometer-alt nav-icon"></i>
                <span>Dashboard</span>
            </a>
            <a href="#" class="nav-item">
                <i class="fas fa-store nav-icon"></i>
                <span>Businesses</span>
            </a>
            <a href="#" class="nav-item">
                <i class="fas fa-search-location nav-icon"></i>
                <span>Inspections</span>
            </a>
            <a href="#" class="nav-item">
                <i class="fas fa-map-marked-alt nav-icon"></i>
                <span>Tax Mapping</span>
            </a>
            <a href="#" class="nav-item">
                <i class="fas fa-file-invoice nav-icon"></i>
                <span>Reports</span>
            </a>
            <a href="#" class="nav-item">
                <i class="fas fa-users-cog nav-icon"></i>
                <span>Users</span>
            </a>
            <a href="#" class="nav-item">
                <i class="fas fa-sign-out-alt nav-icon"></i>
                <span>Logout</span>
            </a>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="main-wrapper">
        <!-- Header -->
        <header class="header">
            <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
                <div>
                    <h1 class="header-title mb-1">Dashboard Overview</h1>
                    <p class="header-subtitle mb-0">Business Permits and Licensing Office - Borongan City</p>
                </div>
                <div class="user-info">
                    <div class="user-avatar">JS</div>
                    <div>
                        <div class="fw-semibold">Juan Santos</div>
                        <small class="text-muted">Administrator</small>
                    </div>
                </div>
            </div>
        </header>

        <!-- Content -->
        <main class="content">
            <!-- Statistics Cards -->
            <div class="row stats-grid g-4">
                <div class="col-xl-3 col-lg-6 col-md-6">
                    <div class="stat-card">
                        <i class="fas fa-building stat-icon-large"></i>
                        <div class="stat-number">1,247</div>
                        <p class="stat-label">Total Businesses</p>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6 col-md-6">
                    <div class="stat-card">
                        <i class="fas fa-check-circle stat-icon-large"></i>
                        <div class="stat-number text-success">1,156</div>
                        <p class="stat-label">Inspected</p>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6 col-md-6">
                    <div class="stat-card">
                        <i class="fas fa-clock stat-icon-large text-warning"></i>
                        <div class="stat-number text-warning">56</div>
                        <p class="stat-label">Pending Inspection</p>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6 col-md-6">
                    <div class="stat-card">
                        <i class="fas fa-exclamation-triangle stat-icon-large text-danger"></i>
                        <div class="stat-number text-danger">35</div>
                        <p class="stat-label">Violations</p>
                    </div>
                </div>
            </div>

            <!-- Recent Inspections Table -->
            <div class="row g-4">
                <div class="col-12">
                    <div class="data-section">
                        <div class="section-header d-flex justify-content-between align-items-center">
                            <h2 class="section-title">
                                <i class="fas fa-list me-2 text-gold"></i>
                                Recent Inspection Records
                            </h2>
                            <a href="#" class="btn btn-outline-primary btn-sm fw-semibold">
                                View All <i class="fas fa-arrow-right ms-1"></i>
                            </a>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-custom mb-0">
                                <thead>
                                    <tr>
                                        <th>Business</th>
                                        <th>Owner</th>
                                        <th>Status</th>
                                        <th>Date</th>
                                        <th>Location</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="business-avatar">BS</div>
                                                Borongan Supermarket
                                            </div>
                                        </td>
                                        <td>Juan Dela Cruz</td>
                                        <td><span class="status-badge status-completed">Completed</span></td>
                                        <td>Jan 15, 2024</td>
                                        <td>Poblacion Norte</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="business-avatar">SR</div>
                                                Seaside Restaurant
                                            </div>
                                        </td>
                                        <td>Maria Santos</td>
                                        <td><span class="status-badge status-pending">Pending</span></td>
                                        <td>Jan 14, 2024</td>
                                        <td>South Baybayin</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="business-avatar">GH</div>
                                                Golden Hardware
                                            </div>
                                        </td>
                                        <td>Pedro Garcia</td>
                                        <td><span class="status-badge status-active">Active</span></td>
                                        <td>Jan 12, 2024</td>
                                        <td>Balud</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="business-avatar">PC</div>
                                                Pacifica Clinic
                                            </div>
                                        </td>
                                        <td>Ana Lopez</td>
                                        <td><span class="status-badge status-completed">Completed</span></td>
                                        <td>Jan 10, 2024</td>
                                        <td>Poblacion Sur</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="business-avatar">ES</div>
                                                Eastern Star Hotel
                                            </div>
                                        </td>
                                        <td>Ramon Torres</td>
                                        <td><span class="status-badge status-active">Active</span></td>
                                        <td>Jan 8, 2024</td>
                                        <td>Real Street</td>
                                        </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        // Add hover animations
        document.querySelectorAll('.stat-card').forEach((card, index) => {
            card.style.animationDelay = `${index * 0.1}s`;
        });

        // Mobile menu toggle (if needed)
        function toggleSidebar() {
            document.querySelector('.sidebar').classList.toggle('show');
        }
    </script>
</body>
</html>