<?php
session_start();


$title = filter_input(INPUT_POST, 'title');
$author = filter_input(INPUT_POST, 'author');
$genre = filter_input(INPUT_POST, 'genre');
$publicationyear = filter_input(INPUT_POST, 'publicationyear');
$dateadded = filter_input(INPUT_POST, 'dateadded');
$image = $_FILES['image'];

require_once('database.php');
require_once('image.php');

$base_dir = 'images';


$querybooklists = '
       SELECT bookId, title, author, genre, publicationyear, dateadded, imagename FROM booklists';


   $statement = $db->prepare($querybooklists);
   $statement->execute();
   $booklists = $statement->fetchAll();
   $statement->closeCursor();

   foreach ($booklists as $booklist) {
        if($author == $booklist["author"]){
             $_SESSION["add_error"] = "Invalid data, Duplicate author. Try again.";
        $url = "error.php";
        header("Location: " . $url);
        die();

      }
    }

   
    if ($title == null || $author == null || $genre == null ||
    $publicationyear == null || $dateadded == null) {
        $_SESSION["add_error"] = "Invalid book data, Check all fields and try again.";
        $url = "error.php";
        header("Location: " . $url); 
        die();
     }


    $query = 'INSERT INTO booklists (title, author, genre, publicationyear, dateadded)
         VALUES (:title, :author, :genre, :publicationyear, :dateadded)';

    $statement = $db->prepare($query);
    $statement->bindValue(':title', $title);
    $statement->bindValue(':author', $author);
    $statement->bindValue(':genre', $genre);
    $statement->bindValue(':publicationyear', $publicationyear);
    $statement->bindValue('dateadded', $dateadded);
    $statement->execute();
    $statement->closeCursor();

    $_SESSION["title"] = $title . " " . $author;
    $url = "add_confirmation.php";
    header("Location: " . $url);
    die();

?>