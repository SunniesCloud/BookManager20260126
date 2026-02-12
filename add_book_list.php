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
        <title>Book Manager - Add Book</title>
        <link rel="stylesheet" type="text/css" href="css/book.css" />
    </head>
 
    <body>
        <?php include("header.php"); ?>
        <main>
            <h2>Add Book</h2>

            <form action="add_book.php" method="post" id="add_book_list" enctype="multipart/form-data">

                <div id="data">

                     <div class="card">
            <h2>Search Books</h2>
            <form method="POST" class="search-container">
                <input type="text" name="search" placeholder="Search by title, author, or genre..." 
                       value="<?php echo htmlspecialchars($_POST['search'] ?? ''); ?>">
                <button type="submit" name="action" value="search" class="btn btn-primary">Search</button>
                <button type="button" onclick="window.location.href='index.php'" class="btn btn-secondary">Clear</button>
            </form>
        </div>
        
        
        <div class="card">
            <h2><?php echo isset($_GET['edit']) ? 'Edit Book' : 'Add New Book'; ?></h2>
            <form method="POST" id="bookForm">
                <input type="hidden" name="book_id" id="book_id" 
                       value="<?php echo htmlspecialchars($_GET['edit'] ?? ''); ?>">
                <input type="hidden" name="action" id="form_action" 
                       value="<?php echo isset($_GET['edit']) ? 'update' : 'add'; ?>">
                
                <div class="form-row">
                    <div class="form-group">
                        <label for="title">Title *</label>
                        <input type="text" id="title" name="title" required 
                               value="<?php 
                                   if (isset($_GET['edit'])) {
                                       $book = $bookModel->getBookById($_GET['edit']);
                                       echo htmlspecialchars($book['title'] ?? '');
                                   }
                               ?>">
                    </div>
                    
                    <div class="form-group">
                        <label for="author">Author *</label>
                        <input type="text" id="author" name="author" required
                               value="<?php 
                                   if (isset($_GET['edit'])) {
                                       echo htmlspecialchars($book['author'] ?? '');
                                   }
                               ?>">
                    </div>
                </div>
                
                <div class="form-row">
                    <div class="form-group">
                        <label for="genre">Genre</label>
                        <select id="genre" name="genre">
                            <option value="">Select Genre</option>
                            <option value="History" <?php if(isset($book) && $book['genre'] == 'History') echo 'selected'; ?>>History</option>
                            <option value="Science" <?php if(isset($book) && $book['genre'] == 'Science') echo 'selected'; ?>>Science</option>
                            <option value="Psychology" <?php if(isset($book) && $book['genre'] == 'Psychology') echo 'selected'; ?>>Psychology</option>
                            <option value="Memoir" <?php if(isset($book) && $book['genre'] == 'Memoir') echo 'selected'; ?>>Memoir</option>
                            <option value="Self-Help" <?php if(isset($book) && $book['genre'] == 'Self-Help') echo 'selected'; ?>>Self-Help</option>
                            <option value="Biography" <?php if(isset($book) && $book['genre'] == 'Biography') echo 'selected'; ?>>Biography</option>
                            <option value="Technology" <?php if(isset($book) && $book['genre'] == 'Technology') echo 'selected'; ?>>Technology</option>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label for="isbn">ISBN</label>
                        <input type="text" id="isbn" name="isbn"
                               value="<?php 
                                   if (isset($_GET['edit'])) {
                                       echo htmlspecialchars($book['isbn'] ?? '');
                                   }
                               ?>">
                    </div>
                </div>
                
                <div class="form-row">
                    <div class="form-group">
                        <label for="publication_year">Publication Year</label>
                        <input type="number" id="publication_year" name="publication_year" min="1900" max="2024"
                               value="<?php 
                                   if (isset($_GET['edit'])) {
                                       echo htmlspecialchars($book['publication_year'] ?? '');
                                   }
                               ?>">
                    </div>
                </div>
                
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">
                        <?php echo isset($_GET['edit']) ? 'Update Book' : 'Add Book'; ?>
                    </button>
                    <?php if (isset($_GET['edit'])): ?>
                        <button type="button" onclick="window.location.href='index.php'" class="btn btn-secondary">Cancel</button>
                    <?php endif; ?>
                </div>
            </form>
        </div>
        
            
            </form>


            <p><a href="index.php">View Book List</a></p>
           
        </main>
 
         <?php include("footer.php"); ?>

    </body>
</html>