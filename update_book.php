<?php
    session_start();

    require_once('database.php');

    $book_Id = filter_input(INPUT_POST, 'book_id', FILTER_VALIDATE_INT);

    $title = filter_input(INPUT_POST, 'title');
    $author = filter_input(INPUT_POST, 'author');
    $genre = filter_input(INPUT_POST, 'genre');
    $publicationyear = filter_input(INPUT_POST, 'publicationyear');
    $dateadded = filter_input(INPUT_POST, 'dateadded');

   
    $querybooklists = '
       SELECT bookId, title, author, genre, publicationyear, dateadded FROM booklists';


   $statement = $db->prepare($querybooklists);
   $statement->execute();
   $booklists = $statement->fetchAll();
   $statement->closeCursor();

   foreach ($booklists as $booklist) {
        if($author == $booklist["author"] && $book_id != $bookid["bookId"]) {
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


    $query = '
        UPDATE booklists
        SET title = :title,
        author = :author,
        genre = :genre,
        publicationyear = :publicationyear,
        dateadded = :dateadded
        WHERE bookId= :bookId
    ';
    

    $statement = $db->prepare($query);
    $statement->bindValue(':title', $title);
    $statement->bindValue(':author', $author);
    $statement->bindValue(':genre', $genre);
    $statement->bindValue(':publicationyear', $publicationyear);
    $statement->bindValue(':dateadded', $dateadded);
    $statement->bindValue(':bookId', $book_Id);
    $statement->execute();
    $statement->closeCursor();

    $_SESSION["title"] = $title . " " . $author;
    $url = "update_confirmation.php";
    header("Location: " . $url);
    die();

?>