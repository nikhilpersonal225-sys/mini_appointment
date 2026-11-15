
<?php

require_once "db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $id = $_POST["id"];
    $customer_name = $_POST["customer_name"];
    $phone = $_POST["phone"];
    $service = $_POST["service"];
    $appointment_date = $_POST["appointment_date"];
    $appointment_time = $_POST["appointment_time"];

    $sql = "UPDATE appointments
            SET customer_name = :customer_name,
                phone = :phone,
                service = :service,
                appointment_date = :appointment_date,
                appointment_time = :appointment_time
            WHERE id = :id";

    $stmt = $conn->prepare($sql);

    $stmt->execute([
        ':customer_name' => $customer_name,
        ':phone' => $phone,
        ':service' => $service,
        ':appointment_date' => $appointment_date,
        ':appointment_time' => $appointment_time,
        ':id' => $id
    ]);

    header("Location: index.php");
    exit;
}

?>
