<?php
// app/controllers/HomeController.php

class home extends Controller {
    public function index() 
    {
        $data = [
            'impacts' => $this->model('Impact_model')->getByPage('home'),
            'services' => $this->model('Service_model')->getAll(),
            'partners' => $this->model('Partner_model')->getAll(),
            'portfolios' => $this->model('Portfolio_model')->getAll(),
            'articles' => $this->model('Article_model')->getByType('blog'),
            'services_cb' => $this->model('ServiceItem_model')->getByCategory('cb'),
            'services_pd' => $this->model('ServiceItem_model')->getByCategory('pd'),
            'services_cs' => $this->model('ServiceItem_model')->getByCategory('cs'),
            'company_profile' => $this->model('Collaboration_model')->getActiveDocumentsByType('company_profile')[0] ?? null,
            'hero' => $this->model('Hero_model')->getByPage('home'),

        ];

        $this->views('layouts/header');
        $this->views('home/index', $data);
        $this->views('layouts/footer');
    }

    public function impact()
    {
        $data = [
            'impacts' => $this->model('Impact_model')->getAllByPage('home'),
            'hero' => $this->model('Hero_model')->getByPage('home'),
        ];

        $this->views('layouts/header');
        $this->views('home/impact', $data);
        $this->views('layouts/footer');
    }
}