<?php

require("database.php");

    $querybooklists = '
        SELECT title, author, genre, publicationyear, dateadded FROM booklists';
 
    $statement = $db->prepare($querybooklists);
    $statement->execute();
    $booklists = $statement->fetchAll();
    $statement->closeCursor();

?>

<!DOCTYPE html>
<html>
 
    <head>
        <title>Book Manager - Add Book</title>
        <link rel="stylesheet" type="text/css" href="css/book.css" />
    </head>
 
    <body>
        <?php include("header.php"); ?>
        <main>
            <h2>Add Book</h2>

            <form action="add_book.php" method="post" id="add_booklists" enctype="multipart/form-data">

                <div id="data">

                     <label>title</label>
                     <input type= "text" name="title" /><br />

                     <label>title</label>
                     <input type= "text" name="author" /><br />

                     <label>title</label>
                     <input type= "text" name="genre" /><br />

                     <label>title</label>
                     <input type= "text" name="publicationyear" /><br />

                     <label>title</label>
                     <input type= "text" name="dateadded" /><br />

                     <label>Status:</label><br />
                     <input type="radio" name="status" value="listed" />Listed<br />
                     <input type="radio" name="status" value="nonlisted" checked />Non-Listed<br />

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