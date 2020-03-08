<?php

require_once '../vendor/autoload.php';
$db = new MeekroDB('127.0.0.1', 'admin', 'admin', 'radyushin', null ,'utf8');

$authors = $db->query('select a.id, a.name, a.rating, count(b.id) as book_qty from authors a LEFT JOIN books b ON a.id = b.author_id GROUP BY a.id;');

die(json_encode($authors, JSON_NUMERIC_CHECK));
