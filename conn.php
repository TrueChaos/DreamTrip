<?php
try{
    $conn = new mysqli("localhost", "root", "", "dreamtrip");
}
catch(mysqli_sql_exception $e){
    echo 'Выброшено исключение: ', $e->getMessage();
    die();
}
