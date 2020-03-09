<?php
require_once '../config.php';

$title = $_POST['title'];

$answer = $db->insert('genres', ['title' => $title]);
die($answer);
