<?php
$counter = 1;

#setcookie("counter", 1, strtotime("+30 days"));
#ДОБАВИТЬ ДАТУ РЕГИСТРАЦИИ ПОЛЬЗОВАТЕЛЯ
if(isset($_COOKIE["counter"])){
    $counter = $_COOKIE["counter"] + 1;
}
setcookie("counter", $counter, strtotime("+30 days"));
#echo("Количество посещений: " .$counter);

$errors = [];

try{
    $conn = new mysqli("localhost", "root", "", "dreamtrip");
}
catch(mysqli_sql_exception $e){
    echo 'Выброшено исключение: ', $e->getMessage();
    die();
}
#Регистрация
if(isset($_POST["nam"])){
    $name = $_POST["name"];
    $email = $_POST["email"];
    $pas = $_POST["pas"];

    $user = checkUserExists($conn,$email);
    if($user){
        $errors[] = "email занят";
        echo "<script type='text/javascript'>alert('Такой пользователь уже существует');</script>";
    }
    else{
        regUser($conn, $name, $email, $pas);
        header("location: lk.php");
        echo "<script type='text/javascript'>alert('Вы успешно зарегистрировались');</script>";
    }
}
#Авторизация
if(isset($_POST)){
    $_POST = json_decode(file_get_contents("php://input"), true);
    #var_dump($_POST);
    $email = $_POST["email"];
    $pas = $_POST["pas"];
    $user = authUser($conn,$email,$pas);
    if($user){
        session_start();
        $_SESSION["user"] = array("name" => $user["name"], "email" => $user["email"]);
        echo true;
    }
    else{
        $errors[] = "Неверный логин или пароль";
        echo false;
    }
}


function checkUserExists($conn, $email){
    $sql = "SELECT * FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s",$email);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_assoc();
}

function regUser($conn, $name, $email, $pas){
    $pas  = password_hash("$pas", PASSWORD_DEFAULT);
    $sql = "INSERT INTO users(name, email, password) VALUES(?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss",$name, $email, $pas);
    $stmt->execute();
}


function authUser($conn, $email, $pas){
    $sql = "SELECT * from users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $result = $result->fetch_assoc();
    $hash = $result["password"];
    $match = password_verify("$pas","$hash");
    if($match) return $result;
    else return false;
}


if(isset($_GET)){
    $season =  $_GET["season"];
    $category = $_GET["category"];
    header('Content-Type: application/json');
    echo getTours($conn, $season, $category);
}


function getTours($conn, $season, $category){
    #Инициализируем параметры запроса
    $c_id = 1; $s_id = 1;
    $sql = "SELECT * FROM tours JOIN categories ON tours.category_id = ? JOIN seasons ON categories.season_id = ?";
    #Для категории "все" запрос коллапсирует в список 1 порядка
    if($category == "alll") $sql = "SELECT * FROM tours JOIN seasons ON tours.season_id = ?";
    #Для определенной категории
    else if($category == "ski") $c_id = 1;
    else if($category == "alp") $c_id = 2;

    if($season == "winter") $s_id = 1;
    else if($season == "spring") $s_id = 2;
    else if($season == "summer") $s_id = 3;
    else if($season == "autumn") $s_id = 4;

    #$sql = "SELECT tours.name, categories.name, seasons.name FROM tours INNER JOIN categories ON tours.category_id = categories.id INNER JOIN seasons ON category.season_id = seasons.id";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $c_id, $s_id);
    #if($category == "all") $stmt->bind_param("s",$s_id);
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