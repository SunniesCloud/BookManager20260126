<?php
class Book {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function getAllBooks() {
        $query = "SELECT * FROM books ORDER BY title";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getBookById($id) {
        $query = "SELECT * FROM books WHERE book_id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function addBook($title, $author, $genre, $isbn, $publication_year, $rating) {
        $query = "INSERT INTO books (title, author, genre, isbn, publication_year, rating) 
                  VALUES (:title, :author, :genre, :isbn, :publication_year, :rating)";
        $stmt = $this->db->prepare($query);
        
        return $stmt->execute([
            ':title' => $title,
            ':author' => $author,
            ':genre' => $genre,
            ':isbn' => $isbn,
            ':publication_year' => $publication_year,
            ':rating' => $rating
        ]);
    }

    public function updateBook($id, $title, $author, $genre, $isbn, $publication_year, $rating) {
        $query = "UPDATE books SET 
                  title = :title, 
                  author = :author, 
                  genre = :genre, 
                  isbn = :isbn, 
                  publication_year = :publication_year, 
                  rating = :rating 
                  WHERE book_id = :id";
        $stmt = $this->db->prepare($query);
        
        return $stmt->execute([
            ':id' => $id,
            ':title' => $title,
            ':author' => $author,
            ':genre' => $genre,
            ':isbn' => $isbn,
            ':publication_year' => $publication_year,
            ':rating' => $rating
        ]);
    }

    public function deleteBook($id) {
        $query = "DELETE FROM books WHERE book_id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function searchBooks($searchTerm) {
        $query = "SELECT * FROM books 
                  WHERE title LIKE :search 
                  OR author LIKE :search 
                  OR genre LIKE :search 
                  ORDER BY title";
        $stmt = $this->db->prepare($query);
        $searchParam = "%$searchTerm%";
        $stmt->bindParam(':search', $searchParam, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>

