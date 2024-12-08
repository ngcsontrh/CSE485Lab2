<?php
    require_once("./models/News.php");
    require_once("./services/NewsService.php");
    class NewsController{
        public function index(){
            $tmp = isset($_GET["page"]) ? ($_GET["page"]) : 1;

            $newsService = new NewsService();
            $newsList = $newsService->getAllNews($tmp);
            include ("./view/news/index.php");
        }

        public function show(){
            $newsService = new NewsService();
            $news = $newsService->getNewsByID($_GET["id"]);
            include ("./view/news/show.php");
        }

        public function create(){

            include ('./view/news/create.php');
        }
        public function store(){
            $title = $_POST['title'];
            $content = $_POST['content'];
            $image = $_FILES['image']['name'];

            $picture_name = $_FILES['image']['name'];
            $picture_type = $_FILES['image']['type'];
            $picture_error= $_FILES['image']['error'];
            $picture_temp = $_FILES['image']['tmp_name'];

            $picture_path="C:/laragon/www/CSE485Lab2/images/";

            if(is_uploaded_file($picture_temp)){
                try{
                    move_uploaded_file($picture_temp,$picture_path.$picture_name);
                
                }
                catch(Exception $e){
                    echo $e->getMessage();
                }
            }

            $created_at = '2024-12-21';
            $category_name="abc";
            $news = new News(1,$title,$content,$image,$created_at,$category_name);   
            $newsService = new NewsService();
            $newsService->addNews($news);
            header("Location: index.php?controller=news&action=index");
        }

        public function edit(){
            $newsService = new NewsService();
            $news = $newsService->getNewsByID($_GET['id']);
            include ('./view/news/edit.php');
        }
            
        public function update(){
           
            $newsService = new NewsService();
            $title = $_POST['title'];
            $content = $_POST['content'];
            $image = $_FILES['image']['name'];
            $created_at = '2024-12-21';
            $category_name="abc";
            $news = new News(1,$title,$content,$image,$created_at,$category_name);
            $newsService->editNews($_GET['id'],$news);
            header('Location:index.php');
    }

        public function destroy(){
            $newsService = new NewsService();
            $id = $_GET['id'];
            $newsService->deleteNewsById($id);
            header('Location:index.php');
        }
}
?>