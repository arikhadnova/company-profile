<?php
// app/core/Controller.php

class Controller {
    // Model loader
    public function model($model) {
        require_once dirname(__DIR__) . '/models/' . $model . '.php';
        return new $model();
    }

    // Primary view loader used across controllers (keeps compatibility)

    public function views($view, $data = []) {
        if (!empty($data) && is_array($data)) {
            extract($data);
        }

        // Normalize common folder name typos (eg. 'layout' -> 'layouts')
        if (strpos($view, 'layout/') === 0) {
            $view = 'layouts/' . substr($view, strlen('layout/'));
        }

        $base = dirname(__DIR__); // app/
        $path = $base . '/views/' . $view . '.php';
        if (file_exists($path)) {
            require_once $path;
            return;
        }

        // Fallback: try the view path as given (keeps previous behavior)
        require_once $base . '/views/' . $view . '.php';
    }

    // Backwards-compatible alias
    public function view($view, $data = []) {
        return $this->views($view, $data);
    }
}
