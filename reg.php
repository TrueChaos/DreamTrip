<?php
require_once "conn.php";
$errors = [];

if(isset($_POST)){
    $_POST = json_decode(file_get_contents("php://input"), true);
    $name = $_POST["name"];
    $email = $_POST["email"];
    $pas = $_POST["pas"];

    $user = checkUserExists($conn,$email);
    if($user){
        $errors[] = "Email занят";
        echo "Email занят";
    }
    else{
        regUser($conn, $name, $email, $pas);
        $user = checkUserExists($conn,$email);
        session_start();
        $_SESSION["user"] = array("id" => $user["id"], "name" => $user["name"], "email" => $user["email"], "role" => $user["role"]);
        echo "Вы зарегестрированы";
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
