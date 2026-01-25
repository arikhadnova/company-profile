<?php

class Publication extends Controller {
    public function index() {
        $this->views('layouts/header');
        $this->views('publication/index');
        $this->views('layouts/footer');
    }

    public function gosirk() {
        $data = [
            'publications' => $this->model('Publication_model')->getByType('gosirk')
        ];
        $this->views('layouts/header');
        $this->views('publication/gosirk', $data);
        $this->views('layouts/footer');
    }

    public function reference() {
        $data = [
            'publications' => $this->model('Publication_model')->getByType('reference')
        ];
        $this->views('layouts/header');
        $this->views('publication/reference', $data);
        $this->views('layouts/footer');
    }
}
