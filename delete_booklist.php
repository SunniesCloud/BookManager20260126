<?php
    require_once('database.php');

    $book_id = filter_input(INPUT_POST, 'book_id', FILTER_VALIDATE_INT);
   
    if ($book_id != false) {
        $query = 'DELETE FROM booklists WHERE bookId = :book_id';

        $statement = $db->prepare($query);
        $statement->bindValue('booklist-id', $booklist_id);

        $statement->execute();
        $statement->closeCursor();
    }
    $url = "index.php";
    header("Location: " . $url);
    die();

?>