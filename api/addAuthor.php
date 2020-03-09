<?php
require_once '../vendor/autoload.php';

$name = $_POST['name'];

$answer = $db->insert('authors', ['name' => $name]);
die($answer);
