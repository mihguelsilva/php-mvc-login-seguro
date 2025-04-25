<?php
namespace Core;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Mailer
{
    public static function send(string $to,string $subject,string $body)
    {
        $mail = new PHPMailer(true);

        try {
            $mail->isSMTP();
            $mail->Host = $_ENV['MAIL_HOST'];
            $mail->SMTPAuth = true;
            $mail->Username = $_ENV['MAIL_USERNAME'];
            $mail->Password = $_ENV['MAIL_PASSWORD'];
            $mail->SMTPSecure = $_ENV['MAIL_SECURE'];
            $mail->Port = $_ENV['MAIL_PORT'];

            // Remetente e destinatário
            $mail->setFrom($_ENV['MAIL_FROM'], $_ENV['MAIL_FROM_NAME']);
            $mail->addAddress($to);

            // Conteúdo
            $mail->isHTML(true);
            $mail->Subject = $subject;
            $mail->Body = $body;

            $mail->send();

            return true;
        } catch(Exception $e) {
            error_log("Erro ao enviar e-mail: {$mail->ErrorInfo}");
            return false;
        }
    }
}

// xfpl fxpm yqrn hvdv 
?>