<?php

require_once '../config.php';

$authors = $db->query('select a.id, a.name, a.rating, count(b.id) as book_qty from authors a LEFT JOIN books b ON a.id = b.author_id GROUP BY a.id;');

die(json_encode($authors, JSON_NUMERIC_CHECK));
