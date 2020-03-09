<?php
require_once '../config.php';

$id = $_POST['id'];
$name = $_POST['name'];

$answer = $db->update('authors', ['name' => $name], 'id=' . $id);

die($answer);
