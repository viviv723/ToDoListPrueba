<?php
require 'db_conn.php';
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$id = $_POST['id'] ?? '';

if ($id) {
    $stmt = $conn->prepare("UPDATE todos SET checked = NOT checked WHERE id = :id");
    $stmt->execute(['id' => $id]);

    $stmt = $conn->prepare("SELECT checked FROM todos WHERE id = :id");
    $stmt->execute(['id' => $id]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    echo $result['checked'] ? 'checked' : 'unchecked';
}
?>