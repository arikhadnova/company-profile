<?php

class Portfolio extends Controller {
    private $portfolioModel;

    public function __construct() {
        $this->portfolioModel = $this->model('Portfolio_model');
    }

    public function index() {
        header('Location: ' . BASE_URL);
        exit;
    }

    public function detail($id) {
        $portfolio = $this->portfolioModel->getById($id);
        
        if (!$portfolio) {
            header('Location: ' . BASE_URL);
            exit;
        }

        $data = [
            'title' => $portfolio->title_id . ' - Portfolio',
            'portfolio' => $portfolio
        ];

        $this->views('layouts/header', $data);
        $this->views('portfolio/detail', $data);
        $this->views('layouts/footer');
    }
}
