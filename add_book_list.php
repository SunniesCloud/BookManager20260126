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
                    <label>Title:</label>
                    <input type="text" name="title" required /><br />

                    <label>Author:</label>
                    <input type="text" name="author" required /><br />

                    <label>Genre:</label>
                    <input type="text" name="genre" /><br />

                    <label>Publication Year:</label>
                    <input type="number" name="publicationyear" min="1000" max="<?php echo date('Y'); ?>" /><br />

                    <label>Date Added:</label>
                    <input type="date" name="dateadded" value="<?php echo date('Y-m-d'); ?>" /><br />

                    <label>Status:</label><br />
                    <input type="radio" name="status" value="listed" /> Listed<br />
                    <input type="radio" name="status" value="nonlisted" checked /> Non-Listed<br />

                    <label>Upload Image:</label>
                    <input type="file" name="file1" accept="image/*" /><br />
                </div>

                <div id="buttons">
                    <label>&nbsp;</label>
                    <input type="submit" value="Save Book" /><br />
                </div>
            </form>
            
            <p><a href="index.php">View Book Lists</a></p>
        </main>
 
        <?php include("footer.php"); ?>
    </body>
</html>
