<?php
    require_once ('../configs/config.php');
    require_once APP_root.'/controllers/CategoryController.php';

    // require_once APP_root.'/services/CategoryService.php';
    // $cate = new Categoryservice();
    // $category = $cate->getAllCategories();
    // echo "<pre>";
    // print_r($category);
    // echo "<pre>";

    $categoryController = new CategoryController();
    $categoryController->index();





