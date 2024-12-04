<?php
require_once APP_root.'/services/CategoryService.php';
class CategoryController{
    public function index()
    {
        $cate = new Categoryservice();
        $category = $cate->getAllCategories();
        
        include APP_root.'/views/category/index.php';
    }

}
