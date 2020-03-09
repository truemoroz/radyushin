<?php
require_once '../config.php';

$id = $_POST['id'];

$answer = $db->delete('authors', '%l', 'id=' . $id);
die($answer);
