<?php
require_once '../vendor/autoload.php';

$db = new MeekroDB('127.0.0.1', 'admin', 'admin', 'radyushin', null ,'utf8');

$id = $_POST['id'];
$name = $_POST['name'];

$answer = $db->update('authors', ['name' => $name], 'id=' . $id);

die($answer);
