<?php
require 'db_conn.php';
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$title = $_POST['title'] ?? '';

if ($title) {
    $stmt = $conn->prepare("INSERT INTO todos (title) VALUES (:title)");
    if ($stmt->execute(['title' => $title])) {
        echo "Success";
    } else {
        echo "Error";
    }
} else {
    echo "No title";
}
?>
