<?php
require_once '../vendor/autoload.php';

$db = new MeekroDB('127.0.0.1', 'admin', 'admin', 'radyushin', null ,'utf8');

$title = $_POST['title'];
$author = $_POST['author_id'];
$genre = $_POST['genre_id'];
$rating = $_POST['rating'];

$answer = $db->insert('books', ['title' => $title, 'author_id' => $author, 'genre_id' => $genre, 'rating' => $rating]);

$sql = 'UPDATE authors SET rating = (SELECT avg(rating) FROM books WHERE author_id = ' . $author . ') WHERE id = ' . $author;
$db->query($sql);
die($answer);
