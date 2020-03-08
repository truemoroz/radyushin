<?php
require_once '../vendor/autoload.php';

$db = new MeekroDB('127.0.0.1', 'admin', 'admin', 'radyushin', null ,'utf8');

$id = $_POST['id'];

$answer = $db->delete('authors', '%l', 'id=' . $id);
die($answer);
