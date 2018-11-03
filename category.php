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


if ($stmt = $mysqli->prepare("SELECT * FROM category WHERE parent_id=(?)")) {

    $stmt->bind_param("i", $category_id);
//    $area = 100000;

    $stmt->execute();

    /* Объявление переменных для заготовленного выражения*/
    $stmt->bind_result($id, $parent_id, $name);

    /* Выборка значений */
    echo "<table><tr><td>id</td><td>Название</td></tr>";
    while ($stmt->fetch()) {
        echo "<tr><td>" . $id . "</td>";
        echo "<td><a href='./goodslist.php?id=" . $id . "'>" . $name . "</a></td></tr>";
//        echo $name . " имя " . $surname . " фамилия.<br>";
    }
    echo "</table>";

    /* Закрытие выражения */
    $stmt->close();
}

?>


</body>
</html>
