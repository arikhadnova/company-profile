<?php

class Library extends Controller {
    public function index() {
        $data = [
            'articles' => $this->model('Article_model')->getByType('library')
        ];
        $this->views('layouts/header');
        $this->views('library/index', $data);
        $this->views('layouts/footer');
    }
}
