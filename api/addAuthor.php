<?php
require_once '../vendor/autoload.php';

$db = new MeekroDB('127.0.0.1', 'admin', 'admin', 'radyushin', null ,'utf8');

$name = $_POST['name'];

$answer = $db->insert('authors', ['name' => $name]);
die($answer);
