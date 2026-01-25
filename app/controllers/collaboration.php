<?php

class collaboration extends Controller {
    public function index() 
    {
        $collaborationModel = $this->model('Collaboration_model');
        $data = [
            'docs' => $collaborationModel->getActiveDocumentsByType('executive_summary'),
            'compro' => $collaborationModel->getActiveDocumentsByType('company_profile')[0] ?? null
        ];

        $this->views('layouts/header', $data);
        $this->views('collaboration/index', $data);
        $this->views('layouts/footer');
    }

    public function request() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $collaborationModel = $this->model('Collaboration_model');
            
            $doc_id = $_POST['doc_id'];
            $doc = $collaborationModel->getDocumentById($doc_id);

            $data = [
                'doc_id' => $doc_id,
                'name' => $_POST['name'],
                'email' => $_POST['email'],
                'organization' => $_POST['organization'],
                'jabatan' => $_POST['jabatan']
            ];

            if ($collaborationModel->logRequest($data)) {
                if ($doc && !empty(MAIL_FROM)) {
                    $attachmentPath = realpath(__DIR__ . '/../storage/documents/' . $doc->file_path);
                    
                    // Email to User
                    $userSubject = "Dokumen yang Anda Minta: " . $doc->title_id;
                    $userMessage = "Halo " . $data['name'] . ",<br><br>Terima kasih telah tertarik dengan inisiatif kami. Terlampir adalah dokumen <b>" . $doc->title_id . "</b> yang Anda minta.<br><br>Salam,<br>" . SITE_NAME;
                    
                    Mail::send($data['email'], $userSubject, $userMessage, $attachmentPath);

                    // Email to Admin
                    $adminSubject = "Permintaan Dokumen Baru: " . $doc->title_id;
                    $adminMessage = "Halo Admin,<br><br>Seseorang telah meminta dokumen:<br>" .
                                    "<b>Nama:</b> " . $data['name'] . "<br>" .
                                    "<b>Email:</b> " . $data['email'] . "<br>" .
                                    "<b>Instansi:</b> " . $data['organization'] . "<br>" .
                                    "<b>Jabatan:</b> " . $data['jabatan'] . "<br>" .
                                    "<b>Dokumen:</b> " . $doc->title_id . "<br><br>" .
                                    "Silakan tindak lanjuti jika diperlukan.";
                    
                    Mail::sendToAdmin($adminSubject, $adminMessage);
                }

                echo json_encode(['status' => 'success', 'message' => 'Permintaan berhasil dikirim! Silakan cek email Anda (pastikan cek folder spam jika tidak ditemukan).']);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Gagal memproses permintaan.']);
            }
            exit;
        }
    }
}
