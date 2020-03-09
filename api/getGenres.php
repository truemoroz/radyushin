<?php

require_once '../config.php';

$genres = $db->query('select * from genres');

die(json_encode($genres, JSON_NUMERIC_CHECK));
