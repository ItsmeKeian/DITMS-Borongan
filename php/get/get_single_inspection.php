<?php

require "../dbconnect.php";

$id = $_GET["id"];

$stmt = $conn->prepare("

SELECT

    inspections.id,
    inspections.date_of_inspection,
    inspections.time_of_inspection,
    inspections.barangay,
    inspections.business_name,
    inspections.trade_name,
    inspections.owner_name,
    inspections.contact_number,
    inspections.declared_nature,
    inspections.actual_nature,
    inspections.activity_matches,
    inspections.activity_not_match,
    inspections.psic_code,
    inspections.type_of_business,
    inspections.operation_status,
    inspections.floor_area,
    inspections.male_employees,
    inspections.female_employees,
    inspections.additional_support,
    inspections.remarks,
    inspections.inspector_name,
    inspections.date_signed,

    registration_status.mayor_permit,
    registration_status.barangay_clearance,
    registration_status.dti_sec_cda,
    registration_status.bir_registration,
    registration_status.permit_number,
    registration_status.year_last_registered,

    findings.no_mayor_permit,
    findings.expired_permit,
    findings.change_nature,
    findings.change_address,
    findings.additional_line,
    findings.others,
    findings.notice_register,
    findings.notice_violation,
    findings.reassessment,
    findings.compliance_days,
    findings.referred_to,
    findings.action_remarks,
    findings.sanitary_permit,
    findings.fire_cert,
    findings.permit_displayed

FROM inspections

LEFT JOIN registration_status
ON inspections.id = registration_status.inspection_id

LEFT JOIN findings
ON inspections.id = findings.inspection_id

WHERE inspections.id = ?

");

$stmt->execute([$id]);

echo json_encode(
    $stmt->fetch(PDO::FETCH_ASSOC)
);