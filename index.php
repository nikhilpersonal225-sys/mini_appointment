
<?php

require_once "db.php";
$search = "";

if (isset($_GET['search'])) {
    $search = trim($_GET['search']);
}

$sql = "SELECT * FROM appointments
        WHERE customer_name LIKE :search
        ORDER BY id DESC";

$stmt = $conn->prepare($sql);

$stmt->execute([
    ':search' => "%" . $search . "%"
]);

$appointments = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html>
<head>
    <title>Mini Appointment Management</title>
</head>
<body>

    <h1>Mini Appointment Management System</h1>

    <h2>Create New Appointment</h2>

    <form method="POST" action="create.php">

        <label>Customer Name:</label><br>
        <input type="text" name="customer_name" required>
        <br><br>

        <label>Phone Number:</label><br>
        <input type="text" name="phone" required>
        <br><br>

        <label>Service:</label><br>
        <input type="text" name="service" required>
        <br><br>

        <label>Appointment Date:</label><br>
        <input type="date" name="appointment_date" required>
        <br><br>

        <label>Appointment Time:</label><br>
        <input type="time" name="appointment_time" required>
        <br><br>

        <button type="submit">Book Appointment</button>

    </form>

    <hr>

    <h2>All Appointments</h2>
<form method="GET" action="index.php">

    <input type="text"
           name="search"
           placeholder="Search customer name..."
           value="<?php echo htmlspecialchars($search); ?>">

    <button type="submit">Search</button>

    <a href="index.php">Clear</a>

</form>

    <?php foreach ($appointments as $appointment) { ?>
     <a href="edit.php?id=<?php echo $appointment['id']; ?>">
      Edit
     </a>

     <form method="POST" action="delete.php"
      onsubmit="return confirm('Are you sure you want to delete this appointment?');">

    <input type="hidden" name="id"
           value="<?php echo $appointment['id']; ?>">

    <button type="submit">Delete</button>

</form>
        <div>

            <h3>
                <?php echo htmlspecialchars($appointment['customer_name']); ?>
            </h3>

            <p>Phone:
                <?php echo htmlspecialchars($appointment['phone']); ?>
            </p>

            <p>Service:
                <?php echo htmlspecialchars($appointment['service']); ?>
            </p>

            <p>Date:
                <?php echo htmlspecialchars($appointment['appointment_date']); ?>
            </p>

            <p>Time:
                <?php echo htmlspecialchars($appointment['appointment_time']); ?>
            </p>

            <p>Status:
                <?php echo htmlspecialchars($appointment['status']); ?>
            </p>

            
<form method="POST" action="update.php">

    <input type="hidden" name="id"
           value="<?php echo $appointment['id']; ?>">

    <select name="status">

        <option value="Pending"
            <?php if ($appointment['status'] == 'Pending') echo 'selected'; ?>>
            Pending
        </option>

        <option value="Confirmed"
            <?php if ($appointment['status'] == 'Confirmed') echo 'selected'; ?>>
            Confirmed
        </option>

        <option value="Completed"
            <?php if ($appointment['status'] == 'Completed') echo 'selected'; ?>>
            Completed
        </option>

        <option value="Cancelled"
            <?php if ($appointment['status'] == 'Cancelled') echo 'selected'; ?>>
            Cancelled
        </option>

    </select>

    <button type="submit">Update Status</button>

</form>


            <hr>

        </div>

    <?php } ?>

</body>
</html>
