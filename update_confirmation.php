<?php
    session_start();
?>

<!DOCTYPE html>
<html>

    <head>
        <title>Book Manager - Update Book Confirmation</title>
        <link rel="stylesheet" type="text/css" href="css/contact.css" />
    </head>
    
    <body>
        <?php include("header.php"); ?>

        <main>
            <h2>Update Book Confirmation</h2>
            <p>
                Thank you, <?php echo $_SESSION["book"]; ?> for updating information.
                We look forward to continuing to serve you.
            <p>

            <p><a href="index.php">Back to Home</a></p>
        
        </main>

         <?php include("footer.php"); ?>

    </body>
</html>

