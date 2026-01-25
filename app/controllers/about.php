<?php
// app/controllers/about.php

class about extends Controller {
    public function index() 
    {
        $this->views('layouts/header');
        $this->views('about/index');
        $this->views('layouts/footer');
    }
}