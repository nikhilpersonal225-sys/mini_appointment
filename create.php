
<?php

require_once "db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $customer_name = $_POST["customer_name"];
    $phone = $_POST["phone"];
    $email = $_POST["email"];
    $service = $_POST["service"];
    $appointment_date = $_POST["appointment_date"];
    $appointment_time = $_POST["appointment_time"];

    $sql = "INSERT INTO appointments
            (customer_name, phone, email, service, appointment_date, appointment_time)
            VALUES
            (:customer_name, :phone, :email, :service, :appointment_date, :appointment_time)";

    $stmt = $conn->prepare($sql);

    $stmt->execute([
        ':customer_name' => $customer_name,
        ':phone' => $phone,
        ':email' => $email,
        ':service' => $service,
        ':appointment_date' => $appointment_date,
        ':appointment_time' => $appointment_time
    ]);

    header("Location: index.php");
    exit;
}

?>
