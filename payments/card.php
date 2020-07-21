<?php

session_start();
require '../data.php';


if ($_POST['submit']) {
    session_destroy();
    header("Location: http://avito/payments/1.php");
}

if (!$_SESSION["card"]) {
    header("Location: http://avito/");
}

$file = file_get_contents('../src/file/jsonFile.json');  // Открыть файл data.json
$taskList = json_decode($file, TRUE);        // Декодировать в массив


$card = $_SESSION["card"];
$purposePayment = $_SESSION['purposePayment'];
$sum = $_SESSION['sum'];
$date = date("d.m.Y H:i:s");

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../src/common.css">
    <link rel="stylesheet" href="../src/card.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <title>Document</title>
    <title>Подтвеждение оплаты</title>
</head>
<body>

<div class="card-container">
    <div class="card-container-title">Назначение платежа:</div>
    <div><?= $_SESSION["purposePayment"] ?></div>
    <div id="card-container-sum">
        <div class="card-container-title">Сумма:</div>
        <div><?= $_SESSION["sum"] ?> р.</div>
    </div>
    <form action="" method="post"><!--../index.php-->
        <input type="submit" value="Оплатить" name="submit" class=" btn-card btn-primary">
    </form>
</div>
<div id="table-container">
    <div id="table-container-title"> Таблица предыдущих оплат</div>
    <div class="form-group">
        <select class="form-control" name="state" id="maxRows">
            <option value="5000">Показать все</option>
            <option value="5">5</option>
            <option value="10">10</option>
            <option value="15">15</option>
            <option value="20">20</option>
            <option value="50">50</option>
            <option value="70">70</option>
            <option value="100">100</option>
        </select>

    </div>
    <table class="table table-striped table-class" id="myTable">
        <tr>
            <th>Номер карты</th>
            <th>Суммма оплаты</th>
            <th>Назанчение платежа</th>
            <th>Дата и время</th>
        </tr>

        <? foreach ($taskList

        as $val) {
        if ($_SESSION["card"] == $val['card']) { ?>
        <tr>

            <td><?= $val['card'] ?></td>
            <td><?= $val['sum'] ?> р.</td>
            <td><?= $val['purposePayment'] ?></td>
            <td><?= $val['date'] ?></td>
            <? }  } ?>
        </tr>
    </table>
    <div class='pagination-container '>
        <nav>
            <ul class="pagination ">

                <li data-page="prev" class="btn btn-secondary">
                    <span> < <span class="sr-only btn btn-secondary">Назад</span></span>
                </li>
                <!--	тут функция для создания цифр для прокручивания таблицы -->
                <li data-page="next" id="prev" class="btn btn-secondary">
                    <span> > <span class="sr-only btn btn-secondary">Вперед</span></span>
                </li>
            </ul>
        </nav>
    </div>
</div>
<script type="text/javascript" src="../src/jquery-3.5.1.min.js"></script>
<script type="text/javascript" src="../src/card.js"></script>


</body>
</html>
