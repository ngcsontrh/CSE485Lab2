<?php
require_once("./models/Category.php");
require_once("./service/CategoryService.php");
class CategoryController{
    public function index()
    {
        $cate = new CategoryService();
        $category = $cate->getAllCategory();

    }

}