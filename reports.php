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
                    <a class="nav-link" href="taxmapping.php">
                    <i class="fas fa-map-marked-alt"></i> Tax Mapping
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="reports.php">
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
                Reports Overview
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

            
            <div class="d-flex gap-2">

                <input
                        type="text"
                        id="searchReports"
                        class="form-control"
                        placeholder="Search business / owner"
                        style="width:250px;"
                    >

                <button class="btn btn-outline-warning" onclick="exportReports()">
                    <i class="fas fa-download me-2"></i>Export
                </button>
                
            </div>

            


        </div>


        <div class="card shadow-sm p-3 mb-4">
    <div class="row g-2 align-items-end">

        <div class="col-md-3">
            <label>Barangay</label>
            <select id="filterBarangay" class="form-select">
                <option value="">All</option>
                <option value="Alang-alang">Alang-alang</option>
                                <option value="Amantacop">Amantacop</option>
                                <option value="Ando">Ando</option>
                                <option value="Balacdas">Balacdas</option>
                                <option value="Balud">Balud</option>
                                <option value="Banuyo">Banuyo</option>
                                <option value="Baras">Baras</option>
                                <option value="Bato">Bato</option>
                                <option value="Bayobay">Bayobay</option>
                                <option value="Benowangan">Benowangan</option>
                                <option value="Bugas">Bugas</option>
                                <option value="Cabalagnan">Cabalagnan</option>
                                <option value="Cabong">Cabong</option>
                                <option value="Cagbonga">Cagbonga</option>
                                <option value="Calico-an">Calico-an</option>
                                <option value="Calingatngan">Calingatngan</option>
                                <option value="Campesao">Campesao</option>
                                <option value="Can-abong">Can-abong</option>
                                <option value="Can-aga">Can-aga</option>
                                <option value="Camada">Camada</option>
                                <option value="Canjaway">Canjaway</option>
                                <option value="Canlaray">Canlaray</option>
                                <option value="Canyopay">Canyopay</option>
                                <option value="Divinubo">Divinubo</option>
                                <option value="Hebacong">Hebacong</option>
                                <option value="Hindang">Hindang</option>
                                <option value="Lalawigan">Lalawigan</option>
                                <option value="Libuton">Libuton</option>
                                <option value="Locso-on">Locso-on</option>
                                <option value="Maybacong">Maybacong</option>
                                <option value="Maypangdan">Maypangdan</option>
                                <option value="Pepelitan">Pepelitan</option>
                                <option value="Pinanag-an">Pinanag-an</option>
                                <option value="Purok A (Poblacion)">Purok A (Poblacion)</option>
                                <option value="Purok B (Pob.)">Purok B (Pob.)</option>
                                <option value="Purok C (Pob.)">Purok C (Pob.)</option>
                                <option value="Purok D1 (Pob.)">Purok D1 (Pob.)</option>
                                <option value="Purok D2 (Pob.)">Purok D2 (Pob.)</option>
                                <option value="Purok E (Pob.)">Purok E (Pob.)</option>
                                <option value="Purok F (Pob.)">Purok F (Pob.)</option>
                                <option value="Purok G (Pob.)">Purok G (Pob.)</option>
                                <option value="Purok H (Pob.)">Purok H (Pob.)</option>
                                <option value="Punta Maria">Punta Maria</option>
                                <option value="Sabang North">Sabang North</option>
                                <option value="Sabang South">Sabang South</option>
                                <option value="San Andres">San Andres</option>
                                <option value="San Gabriel">San Gabriel</option>
                                <option value="San Gregorio">San Gregorio</option>
                                <option value="San Jose">San Jose</option>
                                <option value="San Mateo">San Mateo</option>
                                <option value="San Pablo">San Pablo</option>
                                <option value="San Saturnino">San Saturnino</option>
                                <option value="Santa Fe">Santa Fe</option>
                                <option value="Siha">Siha</option>
                                <option value="Songco">Songco</option>
                                <option value="Sohutan">Sohutan</option>
                                <option value="Suribao">Suribao</option>
                                <option value="Surok">Surok</option>
                                <option value="Taboc">Taboc</option>
                                <option value="Tabunan">Tabunan</option>
                                <option value="Tamoso">Tamoso</option>
            </select>
        </div>

        <div class="col-md-3">
            <label>Status</label>
            <select id="filterStatus" class="form-select">
                <option value="">All</option>
                <option value="inspected">Inspected</option>
                <option value="pending">Pending</option>
                <option value="violation">Violation</option>
            </select>
        </div>

        <div class="col-md-2">
            <label>From</label>
            <input type="date" id="fromDate" class="form-control">
        </div>

        <div class="col-md-2">
            <label>To</label>
            <input type="date" id="toDate" class="form-control">
        </div>

        <div class="col-md-2">
            <button class="btn btn-warning w-100" onclick="loadReports()">
                <i class="fas fa-filter me-1"></i> Apply
            </button>
        </div>

    </div>
</div>
<div class="row mb-4">

    <div class="col-md-6">
        <div class="card shadow-sm p-3">
            <h6 class="fw-bold mb-3">Monthly Inspections</h6>
            <div style="height:280px;">
            <canvas id="reportLineChart"></canvas>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card shadow-sm p-3">
            <h6 class="fw-bold mb-3">Inspection Status</h6>
            <div style="height:280px;">
                    <canvas id="reportPieChart"></canvas>
                </div>
        </div>
    </div>

</div>


<div class="card shadow-sm p-3">

    <div class="d-flex justify-content-between mb-3">
        <h6 class="fw-bold mb-0">Inspection Records</h6>
        <small class="text-muted">Filtered results</small>
    </div>

    <div class="table-responsive">
        <table class="table table-hover align-middle">

            <thead class="table-light">
                <tr>
                    <th>Business</th>
                    <th>Owner</th>
                    <th>Barangay</th>
                    <th>Date</th>
                    <th>Status</th>
                </tr>
            </thead>

            <tbody id="reportTableBody">
                <tr>
                    <td colspan="5" class="text-center text-muted">
                        No data available
                    </td>
                </tr>
            </tbody>

        </table>
    </div>

</div>
        
<style>
    .card {
    border-radius: 10px;
}

.card h6 {
    font-size: 14px;
}

label {
    font-size: 13px;
    font-weight: 600;
}

.table th {
    font-size: 13px;
}


</style>
    
    </main>



    

    <!-- Bootstrap 5 JS -->
    <script src="assets/js/jquery-4.0.0.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  
    <script src="js/reports.js"></script>
    
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