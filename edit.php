
<?php

require_once "db.php";

$id = $_GET['id'];

$sql = "SELECT * FROM appointments WHERE id = :id";
$stmt = $conn->prepare($sql);
$stmt->execute([':id' => $id]);

$appointment = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$appointment) {
    die("Appointment not found");
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Appointment</title>
</head>
<body>

    <h2>Edit Appointment</h2>

    <form method="POST" action="update_appointment.php">

        <input type="hidden" name="id"
               value="<?php echo $appointment['id']; ?>">

        <label>Customer Name:</label>
        <input type="text" name="customer_name"
               value="<?php echo htmlspecialchars($appointment['customer_name']); ?>">
        <br><br>

        <label>Phone:</label>
        <input type="text" name="phone"
               value="<?php echo htmlspecialchars($appointment['phone']); ?>">
        <br><br>

        <label>Service:</label>
        <input type="text" name="service"
               value="<?php echo htmlspecialchars($appointment['service']); ?>">
        <br><br>

        <label>Appointment Date:</label>
        <input type="date" name="appointment_date"
               value="<?php echo $appointment['appointment_date']; ?>">
        <br><br>

        <label>Appointment Time:</label>
        <input type="time" name="appointment_time"
               value="<?php echo $appointment['appointment_time']; ?>">
        <br><br>

        <button type="submit">Save Changes</button>

    </form>

</body>
</html>
