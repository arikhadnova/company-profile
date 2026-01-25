<?php
// app/core/Mail.php

class Mail {
    /**
     * Send an email using Brevo API (v3)
     * @param string $to Recipient email
     * @param string $subject Email subject
     * @param string $message Email body (HTML)
     * @param string $attachmentPath Optional absolute path to attachment
     * @param string $attachmentName Optional custom name for the attachment
     * @return bool
     */
    public static function send($to, $subject, $message, $attachmentPath = null, $attachmentName = null) {
        if (empty(BREVO_API_KEY)) return false;

        $url = 'https://api.brevo.com/v3/smtp/email';
        
        $data = [
            'sender' => [
                'name' => MAIL_FROM_NAME,
                'email' => MAIL_FROM
            ],
            'to' => [
                ['email' => $to]
            ],
            'subject' => $subject,
            'htmlContent' => $message
        ];

        // Handle attachment if provided
        if ($attachmentPath && file_exists($attachmentPath)) {
            $fileName = $attachmentName ?: basename($attachmentPath);
            $content = base64_encode(file_get_contents($attachmentPath));
            
            $data['attachment'] = [
                [
                    'content' => $content,
                    'name' => $fileName
                ]
            ];
        }

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'api-key: ' . BREVO_API_KEY,
            'Content-Type: application/json',
            'Accept: application/json'
        ]);

        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        return ($httpCode === 201 || $httpCode === 200);
    }

    /**
     * Send a notification to Admin via Brevo API
     * @param string $subject
     * @param string $content
     * @return bool
     */
    public static function sendToAdmin($subject, $content) {
        if (empty(MAIL_ADMIN_ADDRESS)) return false;
        return self::send(MAIL_ADMIN_ADDRESS, $subject, $content);
    }
}
