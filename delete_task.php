<?php
require 'db_conn.php';
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$id = $_POST['id'] ?? '';

if ($id) {
    $stmt = $conn->prepare("DELETE FROM todos WHERE id = :id");
    if ($stmt->execute(['id' => $id])) {
        echo "Success";
    } else {
        echo "Error";
    }
} else {
    echo "No ID";
}
?>