
<?php

require_once "db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $id = $_POST["id"];
    
    $status = $_POST["status"];

    $allowedStatuses = [
        "Pending",
        "Confirmed",
        "Completed",
        "Cancelled"
    ];

    if (in_array($status, $allowedStatuses)) {

        $sql = "UPDATE appointments
                SET status = :status
                WHERE id = :id";

        $stmt = $conn->prepare($sql);

        $stmt->execute([
            ':status' => $status,
            ':id' => $id
        ]);
    }

    header("Location: index.php");
    exit;
}

?>
