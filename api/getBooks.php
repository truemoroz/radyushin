<?php

require_once '../vendor/autoload.php';
$db = new MeekroDB('127.0.0.1', 'admin', 'admin', 'radyushin', null ,'utf8');

$sql = 'SELECT b.id, b.title as book_title, b.rating, a.name, g.title as genre_title, a.id as author_id, g.id as genre_id 
FROM books b LEFT JOIN authors a ON b.author_id = a.id LEFT JOIN genres g ON b.genre_id = g.id';

$books = $db->query($sql);

die(json_encode($books, JSON_NUMERIC_CHECK));
