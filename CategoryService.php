<?php
require_once APP_root.'/models/Category.php';
class CategoryService
{
    public function getAllCategories()
    {
        try {
            $conn = new PDO('mysql:host=localhost;dbname=lab2', 'root','');
            $sql = "Select * from categories";
            $stmt= $conn->query($sql);

            $cates = [];
            while($row = $stmt->fetch()){
                $cate = new Category($row['id'], $row['name']);
                $cates[] = $cate;
            }
            return $cates;
            

        }catch (PDOException $e){
            return $cates = [];


        }
        
    }
}







