<?php

require "../dbconnect.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    /* =========================
       INSPECTIONS
    ========================= */

    $date = $_POST["date_of_inspection"];
    $time = $_POST["time_of_inspection"];
    $barangay = $_POST["barangay"];

    $business_name = $_POST["business_name"];
    $trade_name = $_POST["trade_name"];
    $owner_name = $_POST["owner_name"];
    $contact = $_POST["contact_number"];

    $declared = $_POST["declared_nature"];
    $actual = $_POST["actual_nature"];

    $floor_area = $_POST["floor_area"];
    $male = $_POST["male_employees"];
    $female = $_POST["female_employees"];


    $stmt = $conn->prepare("
        INSERT INTO inspections (

            date_of_inspection,
            time_of_inspection,
            barangay,

            business_name,
            trade_name,
            owner_name,
            contact_number,

            declared_nature,
            actual_nature,

            floor_area,
            male_employees,
            female_employees

        )

        VALUES (?,?,?,?,?,?,?,?,?,?,?,?)
    ");

    $stmt->execute([

        $date,
        $time,
        $barangay,

        $business_name,
        $trade_name,
        $owner_name,
        $contact,

        $declared,
        $actual,

        $floor_area,
        $male,
        $female

    ]);



    /* =========================
       GET LAST ID
    ========================= */

    $inspection_id = $conn->lastInsertId();



    /* =========================
       REGISTRATION STATUS
    ========================= */

    $mayor = $_POST["mayor_permit"] ?? "";
    $brgy = $_POST["barangay_clearance"] ?? "";
    $dti = $_POST["dti_sec_cda"] ?? "";
    $bir = $_POST["bir_registration"] ?? "";

    $permit = $_POST["permit_number"];
    $year = $_POST["year_last_registered"];


    $stmt2 = $conn->prepare("
        INSERT INTO registration_status (

            inspection_id,
            mayor_permit,
            barangay_clearance,
            dti_sec_cda,
            bir_registration,
            permit_number,
            year_last_registered

        )

        VALUES (?,?,?,?,?,?,?)
    ");

    $stmt2->execute([

        $inspection_id,
        $mayor,
        $brgy,
        $dti,
        $bir,
        $permit,
        $year

    ]);



    /* =========================
       FINDINGS
    ========================= */

    $no_mayor = $_POST["no_mayor_permit"] ?? 0;
    $expired = $_POST["expired_permit"] ?? 0;
    $change_nature = $_POST["change_nature"] ?? 0;
    $change_address = $_POST["change_address"] ?? 0;
    $additional = $_POST["additional_line"] ?? 0;
    $others = $_POST["others"] ?? "";


    $stmt3 = $conn->prepare("
        INSERT INTO findings (

            inspection_id,
            no_mayor_permit,
            expired_permit,
            change_nature,
            change_address,
            additional_line,
            others

        )

        VALUES (?,?,?,?,?,?,?)
    ");

    $stmt3->execute([

        $inspection_id,
        $no_mayor,
        $expired,
        $change_nature,
        $change_address,
        $additional,
        $others

    ]);


    header("Location: ../../inspections.php");
    exit();
}