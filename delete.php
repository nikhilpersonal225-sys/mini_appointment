
<?php

require_once "db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $id = $_POST["id"];

    $sql = "DELETE FROM appointments WHERE id = :id";

    $stmt = $conn->prepare($sql);

    $stmt->execute([
        ':id' => $id
    ]);

    header("Location: index.php");
    exit;
}

?>
