<?php

require_once './models/News.php';

class NewsController
{
    private $model;

    public function __construct($db)
    {
        $this->model = new News($db);
    }

    
    public function index()
    {
        $newsList = $this->model->getAllNews();
        require '../views/news/Index.php';
    }

    
    public function add()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'title' => $_POST['title'],
                'content' => $_POST['content'],
                'image' => $_POST['image'],
                'category_id' => $_POST['category_id']
            ];
            $this->model->createNews($data);
            header('Location: index.php?controller=news&action=index');
        }
        require './views/news/Add.php';
    }

    
    public function edit($id)
    {
        $news = $this->model->getNewsById($id);
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'title' => $_POST['title'],
                'content' => $_POST['content'],
                'image' => $_POST['image'],
                'category_id' => $_POST['category_id']
            ];
            $this->model->updateNews($id, $data);
            header('Location: index.php?controller=news&action=index');
        }
        require './views/news/Edit.php';
    }

    
    public function delete($id)
    {
        $this->model->deleteNews($id);
        header('Location: index.php?controller=news&action=index');
    }
}
?>
