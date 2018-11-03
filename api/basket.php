<?php
    $id = $_POST['id'];
//$subject = $_POST['subject_id'];
//$rate = $_POST['rate'];
//$rno = $_POST['id'];


// $json = file_get_contents('php://input');
// $obj = json_decode($json,true);


//$fd = fopen("hello.txt", 'w') or die("не удалось создать файл");
////$str = $name ." ".$surname;
//$str = $id;
//fwrite($fd, $str);
//fclose($fd);

ini_set("mysqli.default_port", 3307);
$mysqli = new mysqli('localhost', 'root', 'root', 'phpstore');
$mysqli->set_charset('utf8');
if (mysqli_connect_errno()) {
    echo "Ошибка подключения к серверу MySQL. Код ошибки:" . mysqli_connect_error();
    exit;
}
$stmt = $mysqli->prepare("INSERT into basket(goods_id, quantity) VALUES ('" . $id . "', '1')");
$stmt->execute();
$mysqli->close();

$return_arr[] = array('status' => 'ok');

echo json_encode($return_arr);
