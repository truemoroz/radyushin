<?php
require_once '../config.php';

$id = $_POST['id'];

$answer = $db->delete('genres', '%l', 'id=' . $id);
die($answer);
