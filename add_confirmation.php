<?php
   session_start();
?>


<!DOCTYPE html>
<html>


   <head>
       <title>Book Manager - Add Book Confirmation</title>
       <link rel="stylesheet" type="text/css" href="css/book.css" />
   </head>
  
   <body>
       <?php include("header.php"); ?>


       <main>
           <h2>Add Book Confirmation</h2>
           <p>
               Thank you, <strong><?php echo htmlspecialchars($_SESSION["title"]); ?></strong> has been added to the book list.
           <p>


           <p><a href="index.php">Back to Home</a></p>
      
       </main>


        <?php include("footer.php"); ?>


   </body>
</html>

