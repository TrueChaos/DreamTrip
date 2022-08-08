<?php
require_once "conn.php";
$errors = [];
session_start();

if (($_SESSION["user"]["role"] == "admin")) {
    $order = $_GET["order"];
    $status = $_GET["status"];
    changeStatus($conn, $order, $status);
    header("location: admin.php");
}
else echo "Отказано в доступе";

function changeStatus($conn, $order, $status){
    $sql = "UPDATE orders SET status = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $status, $order);
    $stmt->execute();
}