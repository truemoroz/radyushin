<?php

require_once '../config.php';

$sql = 'SELECT b.id, b.title as book_title, b.rating, a.name, g.title as genre_title, a.id as author_id, g.id as genre_id 
FROM books b LEFT JOIN authors a ON b.author_id = a.id LEFT JOIN genres g ON b.genre_id = g.id';

$books = $db->query($sql);

die(json_encode($books, JSON_NUMERIC_CHECK));
