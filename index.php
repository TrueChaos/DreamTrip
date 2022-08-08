<?php session_start();?>
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
    <!-- ГЛАВНАЯ-->  
     <section id = 'main'>
    <div class = 'container-fluid' style = "max-width: 1616px">

<!-- Аутентификация -->
<div class="modal fade" id ="LogIn" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Вход</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">

          <form class = "d-flex flex-column justify-content-between" style = "grid-row-gap: 10px;">
          <input type="email" name="email" class="form-control" placeholder="Введите email">
          <input type="password" name= "pas" class="form-control" placeholder="Введите пароль">
          <button type = "button" class="btn btn-danger" onclick = "sendForm(0)">Войти</button>
          </form>

      </div>
    </div>
  </div>
</div>
        
        <div class="modal fade" id="SignUp" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Регистрация</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
            <p class="text-center">Оставьте свои контакты и мы сгенерируем учетную запись в ближайшее время</p> 
          <form method = "POST" class = "d-flex flex-column justify-content-between" style = "grid-row-gap: 10px;">
          <input type="email" name="email" class="form-control" placeholder="Введите email">
          <input type="text" name= "name" class="form-control" placeholder="Введите Имя">
           <input type="password" name= "pas" class="form-control" placeholder="Введите пароль">  
          <button type="button" class="btn btn-danger" onclick= "sendForm(1)">Регистрация</button>
          </form>
      </div>
    </div>
  </div>
</div>

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
          <a class="nav-link active" aria-current="page" href="#list">Туры</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="#aboutus">О нас</a>
        </li>
       <li class="nav-item">
          <a class="nav-link active" href="#contacts">Контакты</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="#blog" tabindex="-1">Блог</a>
        </li>
      </ul>
        
      <ul class="navbar-nav">
      <li style = "width: 65px; display: flex; flex-direction: column; align-items: center" >
        <img src = "images/wing.svg">
          <a style = "font-size: 14px; color:white; ">Заказы</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#"  id = "user_actions" role="button" data-bs-toggle="dropdown" aria-expanded="false" style = "font-weight: 600;">Личный кабинет
          </a>
             <?php
             if(isset($_SESSION["user"])){
                 echo '<ul class="dropdown-menu" aria-labelledby="user_actions" style = "width: 250px;" id = "userlogged">
            <li><a class="dropdown-item" href="lk.php">Перейти</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="logout.php">Выйти</a></li>
            </ul>'; }
             else{
                 echo '<ul class="dropdown-menu" aria-labelledby="user_actions" style = "width: 250px;">
            <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#LogIn">Войти</a></li>
             <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="#" data-bs-toggle = "modal" data-bs-target = "#SignUp">Регистрация</a></li>
          </ul>'; }
        ?>
          </li>
        </ul>
    </div>
  </div>
</nav>
         <div id = "offer">
        <p>ТОТ САМЫЙ СКАЗОЧНЫЙ МИР</p>
        <p>Окунитесь в незабываемое путешествие.<br>
            Испытайте новые эмоции.<br>
            Заново откройте мир.</p>
        <button type = "button" class = "btn btn-danger" href = "#list">ВЫБОР НАПРАВЛЕНИЯ</button>
        </div> 
        <div style = "display: flex; justify-content: flex-end;">
<div id = "socialn">
        <img src = "images/inst.svg">
        <img src = "images/wp.svg">
        <img src = "images/tgram.svg">
        </div>
    </div>
         </div>
      </section>
      <div class = "d-flex justify-content-center d-flex align-items-center gx-5" id = "banner">
      <img src = "images/plan.svg">
         <a>Подбери индивидуальный тур по сезону и типу</a>
      </div>
        <!-- СПИСОК ТУРОВ -->  
      <section class = "container" style = "height: 1000px;" id = "list">
          
      <div class="btn-group" role="group" aria-label="Basic radio toggle button group" id = "seasons">
  <input type="radio" class="btn-check" name="btnradio" id="btnradio1" autocomplete="off" checked>
  <label class="btn btn-outline-danger btn-lg" for="btnradio1" name="winter">Зима</label>

  <input type="radio" class="btn-check" name="btnradio" id="btnradio2" autocomplete="off">
  <label class="btn btn-outline-danger btn-lg" for="btnradio2" name="spring">Весна</label>

  <input type="radio" class="btn-check" name="btnradio" id="btnradio3" autocomplete="off">
  <label class="btn btn-outline-danger btn-lg" for="btnradio3" name="summer">Лето</label>
  
  <input type="radio" class="btn-check" name="btnradio" id="btnradio4" autocomplete="off">
  <label class="btn btn-outline-danger btn-lg" for="btnradio4" name="autumn">Осень</label>
</div>
          <ul id = "categories">
              <li>
                  <a class="nav-link active" aria-current="page" name = "all">Все</a>
              </li>
              <li>
                  <a class="nav-link active" aria-current="page" name = "ski">Горнолыжные</a>
              </li>
              <li>
                  <a class="nav-link active" aria-current="page" name = "alp">Альпинизм</a>
              </li>
          </ul>
     <!-- Слайдер-->
<div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
  <div class="carousel-inner" id = "c-inner">
    <div class="carousel-item active">
<div class="row justify-content-between gx-5">
    <div class="col" id = "first">
      <!-- сюда подставим тур из БД -->
    </div>
    <div class="col" id = "second">

    </div>
  </div>
    </div>

  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls"  data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Предыдущий</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls"  data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Следующий</span>
  </button>
</div>          
 
<!-- Окно заказа -->
<div class="modal fade" id="orderModal" tabindex="-1" aria-labelledby="OrderModalLabel" aria-hidden="true">
  <div class="modal-dialog" id = "Order">
    <div class="modal-content">
      <div class="modal-header">
       <img src = "images/xibini.jpg" class = "w-100">
      </div>
      <div class="modal-body">
        <div class = "d-flex flex-column justify-content-between" style = "grid-row-gap: 10px;">
            <div>
          <h2 class="modal-title text-center" id="exampleModalLabel">Хотите забронировать тур?</h2>
          <p class="text-center">Оставьте свои контакты и мы сгенерируем учетную запись в ближайшее время</p>
            </div>
          <input type="text" name="email" class="form-control" placeholder="Введите email">
          <input type="text" name= "name" class="form-control" placeholder="Введите Имя">
          <button type="button" class="btn btn-danger">Отправить</button>
             <p class="text-center">Нажимая на кнопку вы соглашаетесь с политикой конфиденциальности</p>
          </div>
      </div>
    </div>
  </div>
</div>
            
</section>   
      
      <!-- О НАС-->
      <section id = "aboutus">
        <div class = "container">
          <p>Почему выбирают нас?</p>
            <div class="row row-cols-1 row-cols-md-2 g-5">
  <div class="col">
    <div class="card" id = "stats">
      <img src="images/calend.png" class="card-img-top" alt="..."  >
      <div class="card-body">
        <h1 class="card-title">Организация</h1>
        <p class="card-text">Подберем тур и программу, поможем с билетами.
Расскажем что, где и как!</p>
      </div>
    </div>
  </div>
  <div class="col">
    <div class="card" id = "stats">
      <img src="images/guitar.png" class="card-img-top" alt="..." style = "width: 31%" >
      <div class="card-body">
        <h1 class="card-title">Атмосфера</h1>
        <p class="card-text">Легкая, позитивная и драйвовая атмосфера. Влиться в компанию проще, чем кажется!</p>
      </div>
    </div>
  </div>
  <div class="col">
    <div class="card" id = "stats">
      <img src="images/map.png" class="card-img-top" alt="..."  >
      <div class="card-body">
        <h1 class="card-title" class="text-center">Маршруты</h1>
        <p class="card-text">Никаких пакетых туров, разрабатываем каждый уникальный маршрут сами.</p>
      </div>
    </div>
  </div>
  <div class="col">
  <div class="card" id = "stats">
      <img src="images/bank.png" class="card-img-top" alt="..." style = "width: 25%">
      <div class="card-body">
        <h1 class="card-title" class="text-center">Бронирование</h1>
        <p class="card-text">Бронирование по предоплате! Вам не нужно платить за тур всю сумму сразу!</p>
      </div>
    </div>
  </div>
</div>
          </div>
          
          <!-- БЛОГ-->
      </section>
      <section id = "blog">
          <div class = "container">
              <div class="d-flex flex-column">
                  <h1>БЛОГ О ПУТЕШЕСТВИЯХ</h1>
                   <p class = "w-100">Рассказываем всё самое интересное о наших любимых местах и показываем лучшие локации. Гайды по городам и регионам, подборки баров и наши личные рекомендации - всё это в блоге Dream Trip.</p>
              <img src = "images/blog1.jpg" class = "w-750">
                  <img src = "images/xib2.jpg" class = "w-750">
                  <img src = "images/xib1.jpg" class = "w-750">
              </div>
          </div>
      </section>
      
                <!-- КОНТАКТЫ -->
<footer class="bg-dark text-center text-white" id = "contacts">
  <!-- Grid container -->
  <div class="container p-4 pb-0">
    <!-- Section: Social media -->
    <section class="mb-4">
      <!-- Facebook -->
      <a class="btn btn-outline-light btn-floating m-1" href="#!" role="button"
        ><i class="fab fa-facebook-f"></i
      ></a>

      <!-- Twitter -->
      <a class="btn btn-outline-light btn-floating m-1" href="#!" role="button"
        ><i class="fab fa-twitter"></i
      ></a>

      <!-- Google -->
      <a class="btn btn-outline-light btn-floating m-1" href="#!" role="button"
        ><i class="fab fa-google"></i
      ></a>

      <!-- Instagram -->
      <a class="btn btn-outline-light btn-floating m-1" href="#!" role="button"
        ><i class="fab fa-instagram"></i
      ></a>

      <!-- Linkedin -->
      <a class="btn btn-outline-light btn-floating m-1" href="#!" role="button"
        ><i class="fab fa-linkedin-in"></i
      ></a>

      <!-- Github -->
      <a class="btn btn-outline-light btn-floating m-1" href="#!" role="button"
        ><i class="fab fa-github"></i
      ></a>
    </section>
    <!-- Section: Social media -->
  </div>
  <!-- Grid container -->

  <!-- Copyright -->
  <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
    © 2022 Copyright:
    <a class="text-white" href="https://mdbootstrap.com/">DreamTrip inc</a>
  </div>
  <!-- Copyright -->
</footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
  <script src = "script.js"></script>
  </body>
</html>