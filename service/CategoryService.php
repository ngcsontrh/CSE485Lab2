<?php
require_once("./models/Category.php");
require_once("./database/Database.php");
class CategoryService{
    public function getAllCategory($page){
        $page = max($page, 1);
        $offset = ($page-1)*5;
        try{
            $db = new Database();
            $conn = $db->getConnection();
            $sql = "SELECT categories  order by categories.id desc limit 5 offset $offset";
            $stmt= $conn->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        catch(Exception $e){
            echo "". $e->getMessage();
        }

        $Cate = [];
        foreach($result as $row){
            $Cates = new Category ($row['id'],$row['name']);
            $Cate[] = $Cates;
        }
        return $Cate;
    }

    public function getCategoryByID($id){
        $db = new Database();
        $conn = $db->getConnection();
        $sql = "SELECT * CATEGORIES WHERE CATEGORIES.ID = :id";
        $stmt= $conn->prepare($sql);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $Cates = [];
        foreach($result as $row){
            $Cates = new Category ($row['id'],$row['name']);
        }
        return $Cates;
    }

    public function addCategory($Category){
        $db = new Database();
        $conn = $db->getConnection();
        $sql = "INSERT INTO Categories(ID, Name) VALUES(:id, :name)";
        $stmt= $conn->prepare($sql);
        $stmt->bindParam(":id",$Category->getID());
        $stmt->bindParam(":name",$Category->getName());
        $stmt->execute();
    }

    public function editCategory($id,$Category){
        $id = $Category->getID();
        $name = $Category->getName();

        $db = new Database();
        $conn = $db->getConnection();
        $sql = "UPDATE CATEGORIES SET ID = :id,Name = :name where id = $id";
        $stmt= $conn->prepare($sql);
        $stmt->bindParam(":id", $Category->getID());
        $stmt->bindParam(":name", $Category->getName());
        $stmt->execute();
    }

    public function deleteCategoryById($id){
        $db = new Database();
        $conn = $db->getConnection();
        $sql = "DELETE FROM CATEGORIES WHERE id = :id";
        $stmt= $conn->prepare($sql);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
    }
}

?>