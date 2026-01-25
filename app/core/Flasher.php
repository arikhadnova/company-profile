<?php

class Flasher {
    public static function setFlash($pesan, $aksi = '', $tipe = '', $errors = []) {
        $_SESSION['flash'] = [
            'pesan' => $pesan,
            'aksi' => $aksi,
            'tipe' => $tipe,
            'errors' => $errors
        ];
    }

    public static function flash() {
        if (isset($_SESSION['flash'])) {
            $f = $_SESSION['flash'];
            $pesan = $f['pesan'];
            $aksi = $f['aksi'];
            $tipe = $f['tipe']; // success, danger, warning, info
            
            // Map Bootstrap types to SweetAlert2 icon types
            $icon = $tipe;
            if($tipe == 'danger') $icon = 'error';
            if($tipe == 'info') $icon = 'info';

            $htmlContent = '<strong>' . $pesan . '</strong> ' . $aksi;
            
            if (!empty($f['errors'])) {
                $htmlContent .= '<ul style="text-align: left; margin-top: 10px; font-size: 14px;">';
                foreach ($f['errors'] as $field => $errList) {
                    foreach ($errList as $e) {
                        $htmlContent .= '<li>' . $e . '</li>';
                    }
                }
                $htmlContent .= '</ul>';
            }

            $safeHtml = addslashes($htmlContent);
            $safeTitle = addslashes($tipe == 'success' ? 'Berhasil!' : 'Oops...');

            echo "
            <script>
                Swal.fire({
                    icon: '{$icon}',
                    title: '{$safeTitle}',
                    html: '{$safeHtml}',
                    confirmButtonColor: '#0D4A7C',
                    timer: 5000,
                    timerProgressBar: true
                });
            </script>";
            
            unset($_SESSION['flash']);
        }
    }
}
