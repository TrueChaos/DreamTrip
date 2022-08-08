<?php
session_start();
if(isset($_SESSION["user"])) {
    $user = $_SESSION["user"];
    if($user["role"] == "admin") header("location: admin.php");
}
else header("location: index.php");
?>
<!DOCTYPE HTML>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel = 'stylesheet' href = 'style.css'>
    <link href="http://fonts.cdnfonts.com/css/montserrat" rel="stylesheet">
    <title>Dream Trip</title>
    <script async src="https://use.fontawesome.com/releases/v5.0.13/js/all.js"></script>
</head>
<body>
<section style = "background-color: black; background-size: 300px 300px;">
    <div class = 'container-fluid' style = "max-width: 1616px">
<!-- Навигация -->
<nav class="navbar navbar-expand-lg navbar-dark" id = "navpanel" style = "padding-top: 35px;">
    <div class="container-fluid" >
        <img src="images/logo.svg">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="index.php#list">Туры</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="index.php#aboutus">О нас</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="index.php#contacts">Контакты</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="index.php#blog" tabindex="-1">Блог</a>
                </li>
            </ul>

            <ul class="navbar-nav justify-content-end">
                <li style = "width: 65px; display: flex; flex-direction: column; align-items: center" >
                    <img src = "images/user.svg" width="48px">
                    <a style = "font-size: 14px; color:white; ">guest</a>
                </li>
                <li class="nav-item m-4">
                    <a class="nav-link active" href="logout.php" tabindex="-1" style = "color: #FF802C">Выход</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
    </div>
</section>

<section>
    <div class = 'container-fluid' style = "max-width: 1616px">
        <h1 style = "padding-top: 50px; font-weight: bold;">Личный кабинет</h1>
<h5 style = "font-weight: 300;padding-bottom: 20px;">Добро пожаловать <?php
    echo $user["name"];
 ?> !</h5>
        <table class="table" style = "max-width: 600px;">
            <thead class="table table-dark">
            <tr>
                <th scope="col">Тур</th>
                <th scope="col">Статус заявки</th>
            </tr>
            </thead>
            <tbody id = "orders">
            </tbody>
        </table>
<div id = "text"></div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
<script src = "script.js"></script>
<script>
    orders = [];
    async function load(){
        await fetch('/getorder.php').then((response) => {
            return response.text();
        })
            .then((data) => {
                orders = JSON.parse(data);
                orders.forEach(item => {
                    appendRow(item);
                });

            })
            .catch(error => console.error(error));
    }
    load();

    function appendRow(row){
        table = document.querySelector("#orders");
        tour = row["t_name"];
        status = row["status"];
        tr = document.createElement("tr");
        tour_td = document.createElement("td");
        status_td = document.createElement("td");
        tour_td.innerHTML = tour;
        status_td.innerHTML = status;
        tr.appendChild(tour_td);
        tr.appendChild(status_td);
        if(status == "accept") tr.className = "table-success";
        else if(status == "reject") tr.className = "table-danger";
        else tr.className = "table-warning";
        table.appendChild(tr);
    }
</script>