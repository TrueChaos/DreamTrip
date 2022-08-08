<?php
session_start();

if($_SESSION["user"]["role"] == "admin") {
    $user = $_SESSION["user"];
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
                            <a style = "font-size: 14px; color:white; ">admin</a>
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
        <h1 style = "padding-top: 50px; font-weight: bold;">Админ панель</h1>
        <div class = "d-flex justify-content-between align-items-center" style = "max-width: 1000px">
            <a style = "color: red; font-size: 20px;">Список заявок: </a>
            <div class="dropdown">
                <select class="form-select" id = "filter" required>
                    <option selected value = "Все">Все туры</option>
                    <option value="Хибины">Хибины</option>
                    <option value="Шерегеш">Шерегеш</option>
                    <option value="Эверест">Эверест</option>
                </select>
                </ul>
            </div>
        </div>
        <table class="table table-dark" style = "max-width: 1000px;margin-top: 10px">
            <thead>
            <tr>
                <th scope="col">Пользователь</th>
                <th scope="col">Тур</th>
                <th scope="col">Статус заявки</th>
                <th scope="col"></th>
                <th scope="col"></th>
            </tr>
            </thead>
            <tbody id = "orders" class = "table-dark">
            </tbody>
        </table>
        <div id = "text"></div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
        <script src = "script.js"></script>
        <script>
            orders = [];
            load_orders("ordersadmin.php");
            let filter = document.querySelector("#filter");
            filter.addEventListener("change", function (){
                    if(this.value != "Все"){
                        load_orders(`ordersadmin.php?tour=${this.value}`);
                    }
                    else load_orders("ordersadmin.php");
                });

            table = document.querySelector("#orders");

            async function load_orders(link){
                await fetch(link).then((response) => {
                    return response.text();
                })
                    .then((data) => {
                        while (table.firstChild) {
                            table.removeChild(table.firstChild);
                        }
                        orders = JSON.parse(data);
                        orders.forEach(item => {
                            appendRow(item);
                        });

                    })
                    .catch(error => console.error(error));
            }


            function appendRow(row){
                user = row["email"];
                tour = row["t_name"];
                status = row["status"];
                user_td = document.createElement("td");
                tour_td = document.createElement("td");
                status_td = document.createElement("td");
                accept_td = document.createElement("td");
                reject_td = document.createElement("td");
                user_td.innerHTML = user;
                tour_td.innerHTML = tour;
                status_td.innerHTML = status;
                tr = document.createElement("tr");
                tr.appendChild(user_td);
                tr.appendChild(tour_td);
                tr.appendChild(status_td);
                if(status == "waiting") {
                    reject_a = document.createElement("a");
                    accept_a = document.createElement("a");
                    reject_a.addEventListener("click", function(){
                        order = row["id"];
                        location = `changestatus.php?order=${order}&status=reject`;
                    });
                    accept_a.addEventListener("click", function(){
                        order = row["id"];
                        location = `changestatus.php?order=${order}&status=accept`;
                    })
                    reject_a.innerHTML = "Отказать";
                    accept_a.innerHTML = "Принять";
                    reject_a.classList = "btn btn-danger";
                    accept_a.classList = "btn btn-success";
                    reject_td.appendChild(reject_a);
                    accept_td.appendChild(accept_a);
                    tr.appendChild(reject_td);
                    tr.appendChild(accept_td);
                    table.appendChild(tr);
                }

                else if(status == "accept") {
                    tr.className = "table-success";
                    tr.appendChild(reject_td);
                    tr.appendChild(accept_td);
                    table.appendChild(tr);
                }
                else if(status == "reject") {
                    tr.className = "table-danger";
                    tr.appendChild(reject_td);
                    tr.appendChild(accept_td);
                    table.appendChild(tr);
                }
                else {
                    tr.className = "table";
                    tr.appendChild(reject_td);
                    tr.appendChild(accept_td);
                    table.appendChild(tr);
                }
            }

        </script>