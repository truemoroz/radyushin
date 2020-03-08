<?php

require_once '../vendor/autoload.php';
$db = new MeekroDB('127.0.0.1', 'admin', 'admin', 'radyushin', null ,'utf8');

$genres = $db->query('select * from genres');

die(json_encode($genres, JSON_NUMERIC_CHECK));
