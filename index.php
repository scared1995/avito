<?php
session_start();

require 'data.php';
$_SESSION["card"] = $_GET['card'];
$_SESSION["purposePayment"] = $_GET['purposePayment'];
$_SESSION["sum"] = $_GET['sum'];


?>




<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="src/common.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
          integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>

<div class="card-container">
    <form action="" method="get" id="card-pay">
        <div class="card-text">Введите номер карты</div>
        <input type="text" id="card" class="form-control" name="card" placeholder="XXXX XXXX XXXX XXXX" required>
        <? if ($_GET['card']) {
            echo "<div class='card-error'> Неправильно введен номер карты </div>";
        } ?>
        <div class="card-text">Назначение платежа</div>
        <input type="text" class="form-control" name="purposePayment" maxlength="30" placeholder="Небольше 30 символов"
               required>
        <div class="card-text">Введите сумму оплаты</div>
        <input type="text" maxlength="5" class="form-control" id="card-sum" name="sum" placeholder="Сумма платежа"
               required>
        <button class="btn-card btn-primary" type="submit">Оплатить</button>
    </form>
</div>
<script src="src/main.js"></script>
</body>
</html>
