<?php
     session_start();

$title = filter_input(INPUT_POST, 'title');
$author = filter_input(INPUT_POST, 'author');
$genre = filter_input(INPUT_POST, 'genre');
$publicationyear = filter_input(INPUT_POST, 'publicationyear');
$dateadded = filter_input(INPUT_POST, 'dateadded');
$type_id = filter_input(INPUT_POST, 'type_id' , FILTER_VALIDATE_INT);
$image = $_FILES['file1'];


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
         $_SESSION["add_error"] = "Invalid book data. Check all fields and try again.";
         $url = "error.php";
         header("Location: " . $url);
         die();
    }


   $image_name = '';


   if ($image && image['error'] == UPLOAD_ERR_OK) {
         $original_filename = basename($image['name']);
         $upload_path = $base_dir . $original_filename;
         move_uploaded_file($image['tmp_name'], $upload_path);


         process_image(&base_dir, $original_filename);
         $dot_pos = strpos($original_filename, '.');
         $name_100 = substr($original_filename, 0, $dot_pos) . '_100'_ . substr($original_filename, $dot_pos);
         $image_name = $name_100;
   }

   else {
     $placeholder = 'placeholder.jpg';
     $placeholder_100 = 'placeholder_100.jpg';
     $placeholder_400 = 'placeholder_400.jpg'; {
     }

   $image_name = $placeholder_100;

}

 $query = 'INSERT INTO booklists (title, author, genre, publicationyear, dateadded, imageName)
        VALUES (:title, :author, :genre, :publicationyear, :dateadded, :imageName)';


   $statement = $db->prepare($query);
   $statement->bindValue(':title', $title);
   $statement->bindValue(':author', $author);
   $statement->bindValue(':genre', $genre);
   $statement->bindValue(':publicationyear', $publicationyear);
   $statement->bindValue('dateadded', $dateadded);
   $statement->bindValue('imageName', $imageName);
   $statement->execute();
   $statement->closeCursor();


   $_SESSION["title"] = $title . " " . $author;
   $url = "add_confirmation.php";
   header("Location: " . $url);
   die();


?>
