<?php
require_once "conn.php";
$errors = [];
session_start();

if(($_SESSION["user"]["role"] == "admin")){
    if(!isset($_GET["tour"])) echo showOrders($conn);
    else echo filterOrders($conn, $_GET["tour"]);
}
else echo "Отказано в доступе";

function showOrders($conn){
    $sql = "SELECT orders.id, users.email, tours.t_name, orders.status FROM orders JOIN tours ON orders.tour_id = tours.id JOIN users ON orders.user_id = users.id";
    $result = $conn->query($sql);
    $orders = [];
    while($row = $result->fetch_assoc()){
        array_push($orders, $row);
    }
    return json_encode($orders);
}

function filterOrders($conn, $tour){
    $sql = "SELECT orders.id, users.email, tours.t_name, orders.status FROM orders JOIN tours ON orders.tour_id = tours.id JOIN users ON orders.user_id = users.id WHERE tours.t_name = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $tour);
    $stmt->execute();
    $result = $stmt->get_result();
    $orders=[];
    while($row = $result->fetch_assoc()){
        array_push($orders, $row);
    }
    return json_encode($orders);
}