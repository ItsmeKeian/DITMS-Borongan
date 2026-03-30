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
                    <a class="nav-link active" href="business.php">
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
                Business Overview
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
                        id="searchBusiness"
                        class="form-control"
                        placeholder="Search business / owner"
                        style="width:250px;"
                    >

                <button class="btn btn-outline-warning">
                    <i class="fas fa-download me-2"></i>Export
                </button>
                <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#addBusinessModal">
                    <i class="fas fa-plus me-2""></i>New Business
                </button>
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
                                <tbody id="businessTableBody">
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>



    <!-- ADD BUSINESS MODAL -->
<div class="modal fade" id="addBusinessModal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title">Add Business</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <form method="POST" action="php/create/create_business.php">

        <div class="modal-body">

          <div class="mb-2">
            <label>Business Name</label>
            <input type="text" name="business_name" class="form-control" required>
          </div>

          <div class="mb-2">
            <label>Owner Name</label>
            <input type="text" name="owner_name" class="form-control">
          </div>

          <div class="mb-2">
            <label>Barangay</label>
            <select name="barangay" class="form-control">
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

          <div class="mb-2">
            <label>Contact Number</label>
            <input type="text" name="contact_number" class="form-control">
          </div>

          <div class="row">
            <div class="col-md-6">
              <label>Latitude</label>
              <input type="text" name="latitude" id="lat_business" class="form-control">
            </div>
            <div class="col-md-6">
              <label>Longitude</label>
              <input type="text" name="longitude" id="lng_business" class="form-control">
            </div>
          </div>
          <div class="col-md-12 mt-2">
            <button 
                type="button"
                class="btn btn-primary w-100"
                onclick="openMapModal('business')"
            >
                Pick Location
            </button>
        </div>

        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-primary">Save Business</button>
        </div>

      </form>

    </div>
  </div>
</div>



  <!-- MAP MODAL -->
  <div class="modal fade" id="mapModal" tabindex="-1">

    <div class="modal-dialog modal-xl">

        <div class="modal-content">

            <div class="modal-header">
                <h5>Select Location</h5>
                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal">
                </button>
            </div>

            <div class="modal-body">

                <div id="mapPicker"
                    style="height:500px;">
                </div>

            </div>

            <div class="modal-footer">

                <button
                    class="btn btn-secondary"
                    data-bs-dismiss="modal">
                    Done
                </button>

            </div>

        </div>

    </div>

    </div>



    <!-- EDIT BUSINESS MODAL -->
<div class="modal fade" id="editModal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-header">
        <h5>Edit Business</h5>
        <button class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <div class="modal-body">

        <input type="hidden" id="edit_id">

        <div class="mb-2">
          <label>Business Name</label>
          <input type="text" id="edit_business_name" class="form-control">
        </div>

        <div class="mb-2">
          <label>Owner Name</label>
          <input type="text" id="edit_owner_name" class="form-control">
        </div>

        <div class="mb-2">
          <label>Barangay</label>
          <input type="text" id="edit_barangay" class="form-control">
        </div>

        <div class="mb-2">
          <label>Contact</label>
          <input type="text" id="edit_contact" class="form-control">
        </div>

      </div>

      <div class="modal-footer">
        <button class="btn btn-primary" onclick="updateBusiness()">Update</button>
      </div>

    </div>
  </div>
</div>

    <!-- Bootstrap 5 JS -->
    <script src="assets/js/jquery-4.0.0.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="js/business.js"></script>
    <script src="js/mapPicker.js"></script>
    
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