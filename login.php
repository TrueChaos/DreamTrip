<?php
require_once "conn.php";
$errors = [];

if(isset($_POST)){
    $_POST = json_decode(file_get_contents("php://input"), true);
    $email = $_POST["email"];
    $pas = $_POST["pas"];
    $user = authUser($conn,$email,$pas);
    if($user){
        session_start();
        $_SESSION["user"] = array("id" => $user["id"], "name" => $user["name"], "email" => $user["email"], "role" => $user["role"]);
        if($user["role"] == "guest") echo "Вы вошли";
        else if($user["role"] == "admin") echo "Приветствую, админ";
    }
    else{
        $errors[] = "Неверный логин или пароль";
        echo "Неверный логин или пароль";
    }
}

function authUser($conn, $email, $pas){
    $sql = "SELECT * from users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $result = $result->fetch_assoc();
    if($result) $hash = $result["password"];
    else $hash = null;
    $match = password_verify("$pas","$hash");
    if($match) return $result;
    else return false;
}