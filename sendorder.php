<?php
require_once "conn.php";
$errors = [];
session_start();

if(isset($_SESSION["user"])){
    $tour = $_GET["tour"];
    $user = $_SESSION["user"];
    $user = $user["id"];
    sendOrder($conn, $tour, $user);
    header("location: lk.php");
}


function sendOrder($conn, $tour_id, $user_id){
    $sql = "INSERT INTO orders(tour_id, user_id) VALUES(?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss",$tour_id, $user_id);
    $stmt->execute();
}