<?php

class implementasi_partner extends Controller {
    public function index() {
        $data = [
            'hero' => $this->model('Hero_model')->getByPage('partner'),
            'impacts' => $this->model('Impact_model')->getByPage('implementasi'),
            'testimonials' => $this->model('Testimonial_model')->getByPage('implentasi_partner'),
            'faqs' => $this->model('Faq_model')->getByPage('implentasi_partner'),
            'partners' => $this->model('Partner_model')->getAll()
        ];
        $this->views('layouts/header');
        $this->views('implentasi_partner/index', $data);
        $this->views('layouts/footer');
    }
}
