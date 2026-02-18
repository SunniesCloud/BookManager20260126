<?php

require_once("database.php");

 $book_id = filter_input(INPUT_POST, 'book_id', FILTER_VALIDATE_INT);

    $querybooklists = '
        SELECT title, author, genre, publicationyear, dateadded FROM booklists WHERE bookId = :book_id';
 
    $statement = $db->prepare($querybooklists);
    $statement->bindValue(':contact_id', $book_id)
    $statement->execute();
    $booklist = $statement->fetch();
    $statement->closeCursor();

?>

<!DOCTYPE html>
<html>
 
    <head>
        <title>Book Manager - Update Booklists</title>
        <link rel="stylesheet" type="text/css" href="css/book.css" />
    </head>
 
    <body>
        <?php include("header.php"); ?>
        <main>
            <h2>Update Book</h2>

            <form action="update_booklists.php" method="post" id="update_booklists.form" enctype="multipart/form-data">
                <input type="hidden" name="book_id" value="<?php echo $booklist['bookId']; ?>" />
                <div id="data">

                     <label>title</label>
                     <input type= "text" name="title" value="<?php echo $booklist['title']; ?>" /><br />

                     <label>title</label>
                     <input type= "text" name="author" value="<?php echo $booklist['author']; ?>" /><br />


                     <label>title</label>
                     <input type= "text" name="genre" value="<?php echo $booklist['genre']; ?>" /><br />


                     <label>title</label>
                     <input type= "text" name="publicationyear" value="<?php echo $booklist['publicationyear']; ?>" /><br />


                     <label>title</label>
                     <input type= "text" name="dateadded" value="<?php echo $booklist['dateadded']; ?>" /><br />


                      <label>Status:</label><br />
                     <input type="radio" name="status" value="listed" <?php if ($booklist['status'] == 'listed') echo 'checked'; ?>/>Listed<br />
                     <input type="radio" name="status" value="nonlisted" <?php if ($booklist['status'] == 'nonlisted') echo 'checked'; ?>/>Non-Listed<br />

                    <label>author:</label>
                    <input type="author" name="author" /><br />


                 </div>

                 <div id="buttons">
                    <label>&nbsp;</label>
                    <input type="submit" value="Save Book" /><br />
                
                 </div>

            </form>
            
        </p><a href="index.php">View Book Lists</a></p>

        </main>
 
         <?php include("footer.php"); ?>

    </body>
</html>