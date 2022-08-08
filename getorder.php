<?php
require_once "conn.php";
$errors = [];

if(isset($_GET)){
    session_start();
    $user = $_SESSION["user"];
    echo getOrder($conn, $user["id"]);
}


function getOrder($conn, $user){
    $sql = "SELECT * FROM orders JOIN tours ON orders.tour_id = tours.id JOIN categories ON tours.category_id = categories.id WHERE user_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s",$user);
    $stmt->execute();
    $result = $stmt->get_result();
    $orders = [];
    while($row = $result->fetch_assoc()){
        array_push($orders, $row);
    }
    return json_encode($orders);
}