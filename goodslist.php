<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0">
    <link href="./css/style.css" rel="stylesheet" media="all">
    <script type="text/javascript" src="./js/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="./js/index.js"></script>
</head>
<body>

<?php
/* Подключение к серверу MySQL */
ini_set("mysqli.default_port", 3307);
$mysqli = new mysqli('localhost', 'root', 'root', 'phpstore');
$mysqli->set_charset('utf8');
if (mysqli_connect_errno()) {
    echo "Ошибка подключения к серверу MySQL. Код ошибки:" . mysqli_connect_error();
    exit;
}

$category_id = $_GET['id'];


if ($stmt = $mysqli->prepare("SELECT * FROM goods WHERE category_id=(?)")) {

    $stmt->bind_param("i", $category_id);
//    $area = 100000;

    $stmt->execute();

    /* Объявление переменных для заготовленного выражения*/
    $stmt->bind_result($id, $category_id_id, $name, $price, $img);

    /* Выборка значений */
    echo "<table><tr><td>id</td><td>Название</td><td>Цена</td><td>Изображение</td></tr>";
    while ($stmt->fetch()) {
        echo "<tr><td>" . $id . "</td>";
        echo "<td>" . $name . "</td>";
        echo "<td>" . $price . "</td>";
        echo "<td><img src='./img/" . $img . ".jpg' alt=''></td>";
        echo "<td><button class='js-add-goods' data-id='" . $id . "'>В корзину</button></td></tr>";
//        echo $name . " имя " . $surname . " фамилия.<br>";
    }
    echo "</table>";

    /* Закрытие выражения */
    $stmt->close();
}


if ($stmt = $mysqli->query("SELECT * FROM basket_view")) {

    echo "<table id='basket'><tr><th>Товар</th><th>Цена</th><th>Количество</th><th>Сумма</th></tr>";
    while ($row = $stmt->fetch_object()) {
        $name = $row->name;
        $price = $row->price;
        $quantity = $row->quantity;
        echo "<tr><td>" . $name . "</td>";
        echo "<td>" . $price . "</td>";
        echo "<td>" . $quantity . "</td>";
        echo "<td>" . $price . "</td></tr>";
    }

    echo "</table>";

    /* Закрытие выражения */
    $stmt->close();
}


?>


<!--<table id="basket">-->
<!--    <tr>-->
<!--        <th>Товар</th>-->
<!--        <th>Цена</th>-->
<!--        <th>Количество</th>-->
<!--        <th>Сумма</th>-->
<!--    </tr>-->
<!--    <tr>-->
<!--        <td>1</td>-->
<!--        <td>1</td>-->
<!--        <td>1</td>-->
<!--        <td>1</td>-->
<!--    </tr>-->
<!--</table>-->


</body>
</html>
