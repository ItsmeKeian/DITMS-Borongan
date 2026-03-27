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

    <style>


.legend div {
    font-size:12px;
    margin-bottom:4px;
}

.box {
    display:inline-block;
    width:12px;
    height:12px;
    margin-right:5px;
}

.green { background:#28a745; }
.red { background:#dc3545; }
.blue { background:#007bff; }
.gray { background:#6c757d; }
.orange { background:#fd7e14; }



.leaflet-tooltip.custom-label {
    padding: 3px 6px;
    font-size: 11px;
    font-weight: bold;
    border-radius: 4px;
    border: 2px solid black;
}


/* COLORS */

.leaflet-tooltip.label-green {
    background: #28a745;
    border-color: #1e7e34;
    color: white;
}

.leaflet-tooltip.label-blue {
    background: #007bff;
    border-color: #0056b3;
    color: white;
}

.leaflet-tooltip.label-red {
    background: #dc3545;
    border-color: #a71d2a;
    color: white;
}

.leaflet-tooltip.label-orange {
    background: #fd7e14;
    border-color: #c05600;
    color: white;
}

.leaflet-tooltip.label-gray {
    background: #6c757d;
    border-color: #343a40;
    color: white;
}


/* building icon */

.business-icon {

    width:35px;
    height:35px;
    display:flex;
    align-items:center;
    justify-content:center;

    font-size:18px;

}

</style>
    
<script>

// ================= SIDEBAR =================

const sidebar = document.querySelector('.sidebar');
const toggleBtn = document.querySelector('.sidebar-toggle');

if (toggleBtn) {

    toggleBtn.addEventListener('click', function () {

        sidebar.style.transform =
            sidebar.style.transform === 'translateX(-100%)'
            ? 'translateX(0)'
            : 'translateX(-100%)';

    });

}


document.addEventListener('click', function (event) {

    if (!sidebar || !toggleBtn) return;

    if (
        window.innerWidth <= 992 &&
        !sidebar.contains(event.target) &&
        !toggleBtn.contains(event.target)
    ) {
        sidebar.style.transform = 'translateX(-100%)';
    }

});



// ================= MAP =================

let map;
let markerLayer;



$(document).ready(function () {

    map = L.map('map').setView(
        [11.6087, 125.4319],
        13
    );


    L.tileLayer(
        'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png'
    ).addTo(map);


    markerLayer = L.layerGroup().addTo(map);


    loadMarkers();


    // FILTER EVENTS

    $("#filterBarangay").on("change", loadMarkers);
    $("#filterStatus").on("change", loadMarkers);
    $("#filterSearch").on("keyup", loadMarkers);

});


// ================= LOAD MARKERS =================

function loadMarkers() {

let barangay = $("#filterBarangay").val();
let status = $("#filterStatus").val();
let search = $("#filterSearch").val();

markerLayer.clearLayers();

$.get(
    "php/get/get_map_locations.php",
    {
        barangay: barangay,
        status: status,
        search: search
    },
    function (data) {

        let rows = JSON.parse(data);

        rows.forEach(r => {

            if (!r.latitude || !r.longitude)
                return;


            // ===== COLOR CLASS =====

            let className = "custom-label label-blue";

            if (r.operation_status === "Existing")
                className = "custom-label label-green";

            if (r.operation_status === "Unregistered")
                className = "custom-label label-red";

            if (r.operation_status === "Closed")
                className = "custom-label label-gray";

            if (r.operation_status === "Transferred")
                className = "custom-label label-orange";

            if (r.operation_status === "New")
                className = "custom-label label-blue";


            // ===== ICON =====

            let icon = L.divIcon({
                className: "",
                html: "<div class='business-icon'>🏢</div>",
                iconSize: [26,26]
            });


            let marker = L.marker(
                [r.latitude, r.longitude],
                { icon: icon }
            ).addTo(markerLayer);


            // ===== TOOLTIP =====

            marker.bindTooltip(
                r.business_name,
                {
                    permanent: true,
                    direction: "top",
                    offset: [0, -15],
                    className: className
                }
            );


            // ===== POPUP =====

            marker.bindPopup(

                "<b>" + r.business_name + "</b><br>" +
                r.owner_name + "<br>" +
                r.barangay + "<br>" +
                r.operation_status

            );

        });

    }
);

}

</script>
    
</body>
</html>