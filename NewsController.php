<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "lab2";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8mb4", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Kết nối cơ sở dữ liệu thất bại: " . $e->getMessage());
}
?>
<?php
//require_once './models/News.php';

class NewsController
{
    private $model;

    public function __construct($db)
    {
        $this->model = new News($db);
    }

    // Hiển thị danh sách tin tức
    public function index()
    {
        $newsList = $this->model->getAllNews();
        require './views/news/Index.php';
    }

    // Hiển thị form thêm tin tức
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

    // Hiển thị form sửa tin tức
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

    // Xóa tin tức
    public function delete($id)
    {
        $this->model->deleteNews($id);
        header('Location: index.php?controller=news&action=index');
    }
}
?>
