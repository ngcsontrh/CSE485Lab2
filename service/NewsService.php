
<?php
    require_once("./models/News.php");
    require_once("./database/Database.php");
    class NewsService{
        public function getAllNews($page){
            $page = max($page, 1); 
            $offset = ($page-1)*5;
            try{
                $db = new Database();
                $conn = $db->getConnection();
                $sql = "SELECT NEWS.id,title,content,image,created_at,name FROM NEWS.NEWS JOIN NEWS.CATEGORIES ON NEWS.CATEGORY_ID = CATEGORIES.ID  order by news.id desc limit 5 offset $offset";
                $stmt= $conn->prepare($sql);
                $stmt->execute();
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            }
            catch(Exception $e){
                echo "". $e->getMessage();
            }

            $news = [];
            foreach($result as $row){
                $new = new News ($row['id'],$row['title'],$row['content'],$row['image'],$row['created_at'],$row['name']);
                $news[] = $new;
            }
            return $news;
        }

        public function getNewsByID($id){
            $db = new Database();
            $conn = $db->getConnection();
            $sql = "SELECT * FROM NEWS.NEWS JOIN NEWS.CATEGORIES ON NEWS.CATEGORY_ID = CATEGORIES.ID WHERE NEWS.ID = :id";
            $stmt= $conn->prepare($sql);
            $stmt->bindParam(":id", $id);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $news = [];
            foreach($result as $row){
                $news[] = new News ($row["id"],$row["title"],$row["content"],$row["image"],$row["created_at"],$row["name"]);
            }
            return $news;
        }

        public function addNews($news){
            $db = new Database();
            $conn = $db->getConnection();
            $sql = "INSERT INTO NEWS.NEWS(TITLE,CONTENT,IMAGE,CREATED_AT,CATEGORY_ID) VALUES(:title,:content,:image,now(),1)";
            $stmt= $conn->prepare($sql);
            $stmt->bindParam(":title", $news->getTitle());
            $stmt->bindParam(":content", $news->getContent());
            $stmt->bindParam(":image",$news->getImage());
            $stmt->execute();
        }

        public function editNews($id,$news){
            $title = $news->getTitle();
            $content = $news->getContent();
            $image = $news->getImage();
            $created_at = $news->getCreatedAt();
            $catagory_id = 1;
            $db = new Database();
            $conn = $db->getConnection();
            $sql = "UPDATE NEWS.NEWS SET TITLE = :title,CONTENT = :content,image = :image,created_at= :created_at,category_id = $catagory_id where id = $id";
            $stmt= $conn->prepare($sql);
            $stmt->bindParam(":title", $news->getTitle());
            $stmt->bindParam(":content", $news->getContent());
            $stmt->bindParam(":created_at", $news->getCreatedAt());
            $stmt->bindParam(":image",$news->getImage());
            $stmt->execute();
        }

        public function deleteNewsById($id){
            $db = new Database();
            $conn = $db->getConnection();
            $sql = "DELETE FROM NEWS.NEWS WHERE id = :id";
            $stmt= $conn->prepare($sql);
            $stmt->bindParam(":id", $id);
            $stmt->execute();
    }
}

?>
