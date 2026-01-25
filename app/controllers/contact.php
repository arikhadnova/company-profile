<?php

class Contact extends Controller {
    public function index() {
        $this->views('layouts/header');
        $this->views('contact/index');
        $this->views('layouts/footer');
    }

    public function store() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [
                'name' => $_POST['name'] ?? '',
                'email' => $_POST['email'] ?? '',
                'message' => $_POST['message'] ?? ''
            ];

            $contactModel = $this->model('Contact_model');
            if ($contactModel->add($data)) {
                // Send email notification to Admin
                $subject = "Pesan Baru dari " . $data['name'];
                $content = "
                    <h3>Pesan Baru dari Website</h3>
                    <p><strong>Nama:</strong> {$data['name']}</p>
                    <p><strong>Email:</strong> {$data['email']}</p>
                    <p><strong>Pesan:</strong><br>{$data['message']}</p>
                    <hr>
                    <p><small>Pesan ini juga tersimpan di Dashboard Admin GoSirk.</small></p>
                ";
                
                Mail::sendToAdmin($subject, $content);

                echo json_encode(['status' => 'success', 'message' => 'Pesan Anda telah terkirim!']);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Gagal mengirim pesan. Silakan coba lagi nanti.']);
            }
            exit;
        }
    }
}

