<?php

require_once '../config.php';

$id = $_POST['id'];
$authors = $db->query('SELECT DISTINCT a.name, a.rating FROM authors a LEFT JOIN books b ON a.id = b.author_id WHERE b.genre_id = ' . $id);

die(json_encode($authors, JSON_NUMERIC_CHECK));

