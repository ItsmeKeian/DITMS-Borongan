<?php

require "../dbconnect.php";

$id = $_POST["id"];


/* delete findings */

$stmt1 = $conn->prepare(
"DELETE FROM findings WHERE inspection_id=?"
);

$stmt1->execute([$id]);


/* delete registration */

$stmt2 = $conn->prepare(
"DELETE FROM registration_status WHERE inspection_id=?"
);

$stmt2->execute([$id]);


/* delete inspections */

$stmt3 = $conn->prepare(
"DELETE FROM inspections WHERE id=?"
);

$stmt3->execute([$id]);


echo "ok";