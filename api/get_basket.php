<?php

ini_set("mysqli.default_port", 3307);
$mysqli = new mysqli('localhost', 'root', 'root', 'phpstore');
$mysqli->set_charset('utf8');
if (mysqli_connect_errno()) {
    echo "Ошибка подключения к серверу MySQL. Код ошибки:" . mysqli_connect_error();
    exit;
}

if ($stmt = $mysqli->query("SELECT * FROM basket_view")) {

//    while ($row = $stmt->fetch_object()) {
//        echo json_encode($row);
//    }

//    $fd = fopen("hello.txt", 'w') or die("не удалось создать файл");
////$str = $name ." ".$surname;
////$str = $obj;
//    fwrite($fd, $stmt->fetch_object());
//    fclose($fd);

    $result_array = array();
    if ($stmt->num_rows > 0) {

        while($row = $stmt->fetch_assoc()) {

            array_push($result_array, $row);

        }

    }

    echo json_encode($result_array);
    /* Закрытие выражения */
    $stmt->close();
}
