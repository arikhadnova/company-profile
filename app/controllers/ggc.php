<?php

class ggc extends Controller {
    public function index() {
        $data = [
            'hero' => $this->model('Hero_model')->getByPage('ggc'),
            'impacts' => $this->model('Impact_model')->getByPage('ggc')
        ];
        $this->views('layouts/header', $data);
        $this->views('ggc/index', $data);
        $this->views('layouts/footer');
    }
}

