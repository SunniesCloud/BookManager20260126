<?php

require("database.php");

    $querybooklists = '
        SELECT bookId, title, author, genre, publicationyear, dateadded FROM booklists';

    $statement = $db->prepare($querybooklists);
    $statement->execute();
    $booklists = $statement->fetchAll();
    $statement->closeCursor();

?>

<!DOCTYPE html>
<html>
 
    <head>
        <title>Book Manager - Home</title>
        <link rel="stylesheet" type="text/css" href="css/book.css" />
    </head>
 
    <body>
        <?php include("header.php"); ?>
        <main>
            <h2>Book Lists</h2>
            <table>
                <tr>
                    <th>title</th>
                    <th>author</th>
                    <th>genre</th>
                    <th>publicationyear</th>
                    <th>dateadded</th>
                    <th>photo</th>
                    <th>&nbsp;</th> <!-- for uodate -->
                    <th>&nbsp;</th> <!-- for delete -->
                </tr>
 
                <?php foreach ($booklists as $booklist): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($booklist['title']); ?></td>
                        <td><?php echo htmlspecialchars($booklist['author']); ?></td>
                        <td><?php echo htmlspecialchars($booklist['genre']); ?></td>
                        <td><?php echo htmlspecialchars($booklist['publicationyear']); ?></td>
                        <td><?php echo htmlspecialchars($booklist['dateadded']); ?></td>
                        <td></td>
                        <td>
                            <form action="update_booklist_form.php" method="post">
                                <input type="hidden" name="book_id" value="<?php echo $booklist['bookId']; ?>" />
                                <input type="submit" value="Update" />
                            </form>
                        </td>
                        <td>
                            <form action="delete_booklist.php" method="post">
                                <input type="hidden" name="book_id" value="<?php echo $booklist['bookId']; ?>" />
                                <input type="submit" value="Delete" />
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
 
            </table>
        </main>
 
         <?php include("footer.php"); ?>
    </body>
</html>