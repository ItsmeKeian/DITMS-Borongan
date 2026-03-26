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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <link href="assets/css/dashboard.css" rel="stylesheet">
    
    <!-- FontAwesome 6 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    
  
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
                <li class="nav-item ">
                    <a class="nav-link active" href="inspections.php">
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
                Inspections Overview
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
                    id="searchInspection"
                    class="form-control"
                    placeholder="Search business / owner"
                    style="width:250px;"
                >
                
                <button class="btn btn-outline-primary"
                   onclick="exportExcel()">

                   <i class="fas fa-download me-2"></i>
                   Export

               </button>
               <button class="btn btn-primary"
               onclick="openAddModal()">

               <i class="fas fa-plus me-2"></i>
               New Inspection

               </button>
           </div>
        </div>

     

        <!-- Recent Records Table -->
        <div class="row">
            <div class="col-12">
                <div class="table-container">
                   
                    <div class="card-body p-0">
                        <div class="table-responsive">
                         <table class="table">
                            <thead>
                                <tr>
                                    <th>Business</th>
                                    <th>Owner</th>
                                    <th>Barangay</th>
                                    <th>Date</th>
                                    <th>Type</th>
                                    <th>Status</th>
                                    <th>Findings</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                        <tbody id="inspectionTable"></tbody>

                        </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>



            <!-- ADD INSPECTION MODAL -->
        <div class="modal fade" id="addInspectionModal" tabindex="-1">
        <div class="modal-dialog modal-xl modal-dialog-scrollable modal-fullscreen-lg-down">
            <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">
                    Add Inspection Record
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <form method="POST" id="inspectionForm" action="php/create/create_inspection.php">
            <input type="hidden" name="inspection_id" id="inspection_id">

            <div class="modal-body">

        <!-- ================= GENERAL ================= -->

                    <h6 class="fw-bold">General Information</h6>

                        <div class="row">

                            <div class="col-md-4">
                                <label>Date of inspection:</label>
                                <input type="date" name="date_of_inspection" class="form-control">
                            </div>

                            <div class="col-md-4">
                                <label>Time:</label>
                                <input type="time" name="time_of_inspection" class="form-control">
                            </div>

                            <div class="col-md-4">
                                <label>Barangay:</label>
                                <input type="text" name="barangay" class="form-control">
                            </div>

                        </div>

                    <hr>


        <!-- ================= BUSINESS ================= -->

                        <h6 class="fw-bold">Business Information</h6>

                        <div class="row">

                            <div class="col-md-6">
                                <label>Business Name:</label>
                                <input type="text" name="business_name" class="form-control">
                            </div>

                            <div class="col-md-6">
                                <label>Trade Name (if any):</label>
                                <input type="text" name="trade_name" class="form-control">
                            </div>

                            <div class="col-md-6">
                                <label>Owner's Name:</label>
                                <input type="text" name="owner_name" class="form-control">
                            </div>

                            <div class="col-md-6">
                                <label>Contact Number:</label>
                                <input type="text" name="contact_number" class="form-control">
                            </div>

                        </div>

                    <hr>


        <!-- ================= REGISTRATION ================= -->

                        <h6 class="fw-bold">Registration Status</h6>

                            <div class="row">

                                <div class="col-md-3">
                                    <label>Mayor Permit</label>
                                        <select name="mayor_permit" class="form-control">
                                            <option value="">Select</option>
                                            <option>Yes</option>
                                            <option>No</option>
                                        </select>
                                </div>

                                <div class="col-md-3">
                                    <label>Barangay Clearance</label>
                                        <select name="barangay_clearance" class="form-control">
                                            <option value="">Select</option>
                                            <option>Yes</option>
                                            <option>No</option>
                                        </select>
                                </div>

                                <div class="col-md-3">
                                    <label>DTI / SEC / CDA</label>
                                        <select name="dti_sec_cda" class="form-control">
                                            <option value="">Select</option>
                                            <option>Yes</option>
                                            <option>No</option>
                                        </select>
                                </div>

                                <div class="col-md-3">
                                    <label>BIR Registration</label>
                                        <select name="bir_registration" class="form-control">
                                            <option value="">Select</option>
                                            <option>Yes</option>
                                            <option>No</option>
                                        </select>
                                </div>

                            </div>

                            <div class="row mt-2">

                                <div class="col-md-6">
                                    <label>Permit Number (if available):</label>
                                    <input type="text" name="permit_number" class="form-control">
                                </div>

                                <div class="col-md-6">
                                    <label>Year Last Registered:</label>
                                    <input type="text" name="year_last_registered" class="form-control">
                                </div>

                            </div>

        <hr>


                    <!-- ================= BUSINESS DETAILS ================= -->

                    <h6 class="fw-bold">Business Details</h6>

                        <label>Declared Nature of Business:</label>
                            <textarea name="declared_nature" class="form-control"></textarea>

                        <label class="mt-2">Actual Nature of Business:</label>
                            <textarea name="actual_nature" class="form-control"></textarea>

                    <br>

                        <div class="form-check">
                            <input type="checkbox" name="activity_matches" value="1">
                            <label>Declared activity matches actual operation</label>
                        </div>

                        <div class="form-check">
                            <input type="checkbox" name="activity_not_match" value="1">
                            <label>Declared activity does NOT match actual operation</label>
                        </div>

                        <label>PSIC Code (if know):</label>
                        <input type="text" name="psic_code" class="form-control">


        <br>

                        <div class="row">

                            <div class="col-md-4">
                                <h6>Type of Business:</h6>

                                <select name="type_of_business" class="form-control">
                                    <option value="">Select</option>
                                    <option>Single Proprietorship</option>
                                    <option>Partnership</option>
                                    <option>Corporation</option>
                                    <option>Cooperative</option>
                                </select>
                            </div>

                        <div class="col-md-4">
                            <h6>Business Operation Status:</h6>

                            <select name="operation_status" class="form-control">
                                <option value="">Select</option>
                                <option>New</option>
                                <option>Existing</option>
                                <option>Unregistered</option>
                                <option>Closed</option>
                                <option>Transferred</option>
                            </select>
                        </div>

                        <div class="col-md-4">
                            <h6>Physical & Operation Data</h6>

                            <input type="text" name="floor_area" class="form-control" placeholder="Floor Area (sqm):">
                        </div>


                        </div>
        <br>

                        <h6 class="fw-bold">Number of Employees</h6>

                        <div class="row mt-2">
                            <div class="col-md-6">
                                <label>Male Employees</label>
                                <input type="number" name="male_employees" class="form-control">
                            </div>

                            <div class="col-md-6">
                                <label>Female Employees</label>
                                <input type="number" name="female_employees" class="form-control">
                            </div>
                        </div>

        <br>


                        <div class="row">
                            <h6>Compliance with other requirements</h6>

                            <div class="col-md-4">
                                <h6>Sanitary Permit:</h6>

                                <select name="sanitary_permit" class="form-control">
                                    <option value="">Select</option>
                                    <option>Yes</option>
                                    <option>No</option>

                                </select>
                            </div>

                            <div class="col-md-4">
                                <h6>Fire Safety Inspection Cert:</h6>

                                <select name="fire_cert" class="form-control">
                                    <option value="">Select</option>
                                    <option>Yes</option>
                                    <option>No</option>

                                </select>
                            </div>

                            <div class="col-md-4">
                                <h6>Mayor's Permit Displayed:</h6>

                                <select name="permit_displayed" class="form-control">
                                    <option value="">Select</option>
                                    <option>Yes</option>
                                    <option>No</option>
                                </select>
                            </div>


                        </div>

        <br>


                        <div class="row">
                            <div class="col-md-12">
                            <h6>Additional Support Doc:</h6>

                            <select name="additional_support" class="form-control">
                                <option value="">Select</option>
                                <option>Yes</option>
                                <option>No</option>
                            </select>

                            </div>

                        </div>

        <br>

                        <div class="row">

                        <div class="col-md-12">
                            <h6>Remarks:</h6>

                            <textarea name="remarks" class="form-control"></textarea>

                        </div>

                        </div>








        <hr>


                <!-- ================= FINDINGS ================= -->

                <h6 class="fw-bold">Tax Mapping Findings</h6>

                    <label>(check all that apply)</label>

                        <div class="form-check">
                            <input type="checkbox" name="no_mayor_permit" value="1">
                            <label>Operating without Mayor Permit</label>
                        </div>

                        <div class="form-check">
                            <input type="checkbox" name="expired_permit" value="1">
                            <label>Expired Permit</label>
                        </div>

                        <div class="form-check">
                            <input type="checkbox" name="change_nature" value="1">
                            <label>Change in nature</label>
                        </div>

                        <div class="form-check">
                            <input type="checkbox" name="change_address" value="1">
                            <label>Change address</label>
                        </div>

                        <div class="form-check">
                            <input type="checkbox" name="additional_line" value="1">
                            <label>Additional line</label>
                        </div>

                        <label>Others</label>
                        <input type="text" name="others" class="form-control">


        <hr>


            <!-- ================= ACTION ================= -->

                    <h6 class="fw-bold">Action Taken</h6>

                    <div class="form-check">
                        <input type="checkbox" name="notice_register" value="1">
                        <label>Notice to register</label>
                    </div>

                    <div class="form-check">
                        <input type="checkbox" name="notice_violation" value="1">
                        <label>Notice violation</label>
                    </div>

                    <div class="form-check">
                        <input type="checkbox" name="reassessment" value="1">
                        <label>Reassessment</label>
                    </div>

                    <label>Compliance days</label>
                        <input type="text" name="compliance_days" class="form-control">

                    <label>Referred to</label>
                        <input type="text" name="referred_to" class="form-control">

                    <label>Remarks</label>
                        <textarea name="action_remarks" class="form-control"></textarea>


        <hr>


        <!-- ================= INSPECTOR ================= -->

        <h6 class="fw-bold">Inspector</h6>

        <label>Inspector / Auditor Name:</label>
        <input type="text" name="inspector_name" class="form-control">

        <label>Date</label>
        <input type="date" name="date_signed" class="form-control">


        </div>

            <div class="modal-footer">

            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    Cancel
                </button>

                <button type="submit" class="btn btn-primary">
                    Save Inspection
                </button>

            </div>

            </form>

            </div>
        </div>
        </div>


<style>
.modal-body {
    max-height: 70vh;
    overflow-y: auto;
}
</style>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/inspections.js"></script>
    
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