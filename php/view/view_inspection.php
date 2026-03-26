<?php

require "../dbconnect.php";

$id = $_GET["id"];

/* inspections */
$stmt = $conn->prepare("SELECT * FROM inspections WHERE id=?");
$stmt->execute([$id]);
$ins = $stmt->fetch(PDO::FETCH_ASSOC);

/* registration */
$stmt2 = $conn->prepare("SELECT * FROM registration_status WHERE inspection_id=?");
$stmt2->execute([$id]);
$reg = $stmt2->fetch(PDO::FETCH_ASSOC);

/* findings */
$stmt3 = $conn->prepare("SELECT * FROM findings WHERE inspection_id=?");
$stmt3->execute([$id]);
$find = $stmt3->fetch(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html>
<head>

<title>Inspection Form</title>

<style>
.header-top{
display:grid;
grid-template-columns: 180px 1fr 220px;
align-items:center;
}

.header-left{
display:flex;
gap:10px;
align-items:center;
}

.header-left img{
height:70px;
}

.header-center{
text-align:center;
font-weight:bold;
line-height:1.2;
}

.header-right{
border:1px solid black;
text-align:center;
font-weight:bold;
font-size:11px;
padding:5px;
}

.title{
text-align:center;
font-weight:bold;
font-size:18px;
margin-top:5px;
}

.title-line{
border-top:2px solid black;
margin-top:5px;
margin-bottom:5px;
}



body{
font-family: Arial;
font-size:12px;
}

.print-btn{
margin:10px;
}

.paper{

width:794px;
margin:auto;
padding:20px;
border:1px solid black;

}

.header{
text-align:center;
font-weight:bold;
}

.row{
display:flex;
gap:20px;
}

.col{
width:50%;
}

.line{
border-bottom:1px solid black;
height:16px;
margin-bottom:4px;
}

.section{
font-weight:bold;
margin-top:10px;
border-top:1px solid black;
padding-top:5px;
}

.box{
display:inline-block;
width:12px;
height:12px;
border:1px solid black;
margin-right:4px;
}

.small{
font-size:11px;
}

@media print{

.print-btn{
display:none;
}

.paper{
border:none;
}

}

</style>

</head>
<body>


<button class="print-btn" onclick="window.print()">PRINT</button>


<div class="paper">


<div class="header-top">

<div class="header-left">

<img src="../../assets/img/bagongph.webp">
<img src="../../assets/img/borlogo.png">

</div>


<div class="header-center">

Republic of the Philippines<br>
Province of Eastern Samar<br>
CITY OF BORONGAN

</div>


<div class="header-right">

OFFICE OF THE CITY BUSINESS<br>
PERMITS AND LICENSING

</div>

</div>


<div class="title">

BUSINESS PERMIT<br>
TAX MAPPING

</div>

<div class="title-line"></div>







<div class="row">


<!-- LEFT COLUMN -->

<div class="col">


<div class="section">GENERAL INFORMATION</div>

Date:
<div class="line"><?= $ins["date_of_inspection"] ?></div>

Time:
<div class="line"><?= $ins["time_of_inspection"] ?></div>

Barangay:
<div class="line"><?= $ins["barangay"] ?></div>



<div class="section">BUSINESS INFORMATION</div>

Business Name:
<div class="line"><?= $ins["business_name"] ?></div>

Trade Name:
<div class="line"><?= $ins["trade_name"] ?></div>

Owner:
<div class="line"><?= $ins["owner_name"] ?></div>

Contact:
<div class="line"><?= $ins["contact_number"] ?></div>



<div class="section">REGISTRATION STATUS</div>

Mayor Permit
<div>
<span class="box"></span> Yes
<span class="box"></span> No
</div>

Barangay Clearance
<div>
<span class="box"></span> Yes
<span class="box"></span> No
</div>

DTI / SEC / CDA
<div>
<span class="box"></span> Yes
<span class="box"></span> No
</div>

BIR Registration
<div>
<span class="box"></span> Yes
<span class="box"></span> No
</div>

Permit Number
<div class="line"><?= $reg["permit_number"] ?></div>

Year Last Registered
<div class="line"><?= $reg["year_last_registered"] ?></div>



<div class="section">BUSINESS DETAILS</div>

Declared Nature
<div class="line"><?= $ins["declared_nature"] ?></div>

Actual Nature
<div class="line"><?= $ins["actual_nature"] ?></div>

PSIC Code
<div class="line"><?= $ins["psic_code"] ?></div>



Type of Business

<div>
<span class="box"></span> Single
<span class="box"></span> Partnership
<span class="box"></span> Corporation
<span class="box"></span> Cooperative
</div>



Business Operation Status

<div>
<span class="box"></span> New
<span class="box"></span> Existing
<span class="box"></span> Unregistered
<span class="box"></span> Closed
</div>



Floor Area
<div class="line"><?= $ins["floor_area"] ?></div>

Male
<div class="line"><?= $ins["male_employees"] ?></div>

Female
<div class="line"><?= $ins["female_employees"] ?></div>


</div>



<!-- RIGHT COLUMN -->

<div class="col">


<div class="section">Additional Support Doc</div>

<div>
<span class="box"></span> YES
<span class="box"></span> NO
</div>

Remarks
<div class="line"><?= $ins["remarks"] ?></div>



<div class="section">TAX MAPPING FINDINGS</div>

<div>
<span class="box"></span> Operating without permit
</div>

<div>
<span class="box"></span> Expired permit
</div>

<div>
<span class="box"></span> Change in nature
</div>

<div>
<span class="box"></span> Change address
</div>

<div>
<span class="box"></span> Additional line
</div>

Others
<div class="line"><?= $find["others"] ?></div>



<div class="section">ACTION TAKEN</div>

<div>
<span class="box"></span> Notice to register
</div>

<div>
<span class="box"></span> Notice violation
</div>

<div>
<span class="box"></span> Reassessment
</div>

Compliance days
<div class="line"><?= $find["compliance_days"] ?></div>

Referred to
<div class="line"><?= $find["referred_to"] ?></div>

Remarks
<div class="line"><?= $find["action_remarks"] ?></div>



<div class="section">INSPECTOR / AUDITOR</div>

Name
<div class="line"><?= $ins["inspector_name"] ?></div>

Date
<div class="line"><?= $ins["date_signed"] ?></div>


</div>


</div>


</div>


</body>
</html>