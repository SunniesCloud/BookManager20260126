<?php

require("database.php");

    $queryBooklists = '
        SELECT TITLE, AUTHOR, GENRE, PUBLICATIONYEAR, DATEADDED';
 
    $statement = $db->prepare($queryBooklists);
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
            <h2>Book List</h2>
            <table>
                <tr>
                    <th>title</th>
                    <th>author</th>
                    <th>genre</th>
                    <th>publicationyearr</th>
                    <th>dateadded</th>
                    
                </tr>
 
                <?php foreach ($booklists as $booklist): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($booklist['title']); ?></td>
                        <td><?php echo htmlspecialchars($booklist['author']); ?></td>
                        <td><?php echo htmlspecialchars($booklist['genre']); ?></td>
                        <td><?php echo htmlspecialchars($booklist['publicationyear']); ?></td>
                        <td><?php echo htmlspecialchars($booklist['dateadded']); ?></td>
                        
                    </tr>
                <?php endforeach; ?>
 
            </table>
        </main>
 
         <?php include("footer.php"); ?>
    </body>
</html>