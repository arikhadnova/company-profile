<?php

class Blog extends Controller {
    public function index() {
        $data = [
            'articles' => $this->model('Article_model')->getByType('blog')
        ];
        $this->views('layouts/header');
        $this->views('blog/index', $data);
        $this->views('layouts/footer');
    }

    public function detail($id = null) {
        $data = [
            'article' => $this->model('Article_model')->getById($id)
        ];
        $this->views('layouts/header');
        $this->views('blog/detail', $data);
        $this->views('layouts/footer');
    }
}
