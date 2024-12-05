<?php
require './database/Database.php';
class News
{
    public function getAllNews()
    {   
        $db = new Database();
        $conn = $db->GetConnection();
        $query = "SELECT news.*, categories.name AS category_name 
                  FROM news 
                  LEFT JOIN categories ON news.category_id = categories.id
                  ORDER BY news.created_at DESC";
        $stmt = $this->$conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    
    public function getNewsById($id)
    {   
        $db = new Database();
        $conn = $db->GetConnection();
        $query = "SELECT * FROM news WHERE id = :id";
        $stmt = $this->$conn->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    
    public function createNews($data)
    {   
        $db = new Database();
        $conn = $db->GetConnection();
        $query = "INSERT INTO news (title, content, image, category_id, created_at) 
                  VALUES (:title, :content, :image, :category_id, :created_at)";
        $stmt = $this->$conn->prepare($query);

        $stmt->bindParam(':title', $data['title']);
        $stmt->bindParam(':content', $data['content']);
        $stmt->bindParam(':image', $data['image']);
        $stmt->bindParam(':category_id', $data['category_id']);
        $stmt->bindParam(':created_at', date('Y-m-d H:i:s'));

        return $stmt->execute();
    }

    // Cập nhật tin tức
    public function updateNews($id, $data)
    {   
        $db = new Database();
        $conn = $db->GetConnection();
        $query = "UPDATE news 
                  SET title = :title, content = :content, image = :image, category_id = :category_id 
                  WHERE id = :id";
        $stmt = $this->$conn->prepare($query);

        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':title', $data['title']);
        $stmt->bindParam(':content', $data['content']);
        $stmt->bindParam(':image', $data['image']);
        $stmt->bindParam(':category_id', $data['category_id']);

        return $stmt->execute();
    }

    
    public function deleteNews($id)
    {   
        $db = new Database();
        $conn = $db->GetConnection();
        $query = "DELETE FROM news WHERE id = :id";
        $stmt = $this->$conn->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
?>
