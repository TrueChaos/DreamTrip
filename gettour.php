<?php
require_once "conn.php";
$errors = [];

if(isset($_GET)){
    $season =  $_GET["season"];
    $category = $_GET["category"];
    header('Content-Type: application/json');
    echo getTours($conn, $season, $category);
}


function getTours($conn, $season, $category){
    #Инициализируем параметры запроса
    $c_id = 1; $s_id = 1;
    $sql = "SELECT * FROM tours JOIN categories ON tours.category_id = categories.id JOIN seasons ON categories.season_id = seasons.id WHERE category_id = ? AND season_id = ?";
    #Для категории "все" запрос коллапсирует в список 1 порядка
    if($category == "all") $sql = "SELECT * FROM tours JOIN categories ON tours.category_id = categories.id JOIN seasons ON categories.season_id = seasons.id";
    #Для определенной категории
    else if($category == "ski") $c_id = 1;
    else if($category == "alp") $c_id = 2;

    if($season == "winter") $s_id = 1;
    else if($season == "spring") $s_id = 2;
    else if($season == "summer") $s_id = 3;
    else if($season == "autumn") $s_id = 4;

    $stmt = $conn->prepare($sql);
    if($category != "all") $stmt->bind_param("ss", $c_id, $s_id);
    $stmt->execute();
    $result = $stmt->get_result();
    #var_dump($result);
    $tours = [];
    while($row = $result->fetch_assoc()){
        array_push($tours, $row);
    }
    #var_dump(json_encode($tours));
    return json_encode($tours);
}