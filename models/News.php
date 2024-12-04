<?php

class News {
    public $id;
    public $title;
    public $content;
    public $image;
    public $created_at;
    public $category_id;

    public function __construct($id = null, $title = null, $content = null, $image = null, $created_at = null, $category_id = null) {
        $this->id = $id;
        $this->title = $title;
        $this->content = $content;
        $this->image = $image;
        $this->created_at = $created_at;
        $this->category_id = $category_id;
    }
}