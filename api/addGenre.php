<?php
require_once '../vendor/autoload.php';

$db = new MeekroDB('127.0.0.1', 'admin', 'admin', 'radyushin', null ,'utf8');

$title = $_POST['title'];

$answer = $db->insert('genres', ['title' => $title]);
die($answer);
