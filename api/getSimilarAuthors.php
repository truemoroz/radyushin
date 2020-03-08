<?php
require_once '../vendor/autoload.php';

$db = new MeekroDB('127.0.0.1', 'admin', 'admin', 'radyushin', null ,'utf8');

$id = $_POST['id'];

$sql = 'SELECT DISTINCT a.name FROM authors a LEFT JOIN books b ON a.id = b.author_id WHERE b.genre_id = (SELECT DISTINCT genre_id FROM books b WHERE b.author_id = ' . $id. ') AND a.id != ' . $id;
$answer = $db->query($sql);
die(json_encode($answer));
