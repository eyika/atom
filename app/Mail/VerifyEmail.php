<?php
namespace App\Mail;

use App\Mail\Mailer;
use PHPMailer\PHPMailer\Exception;

class VerifyEmail
{
    private static $mail;

    public function __construct(string $address, string $name)
    {
        self::$mail = Mailer::to($address, $name)->from(env('NOREPLY_EMAIL_USER'), env('NOREPLY_EMAIL_NAME'));
    }

    public static function send(string $address, string $name, string $subject, string $code)
    {
        try {
            new static($address, $name);

            static::$mail->buildHtml('verify.html', [
                'title' => "Email Verification",
                'header' => "Email Verification",
                'sender_email' => env('NOREPLY_EMAIL_USER'),  //$sender->email,
                'contents' => [
                    $name ? "Hello $name," : "Hy,",
                    "You or someone requested to verify this email account with us",
                    "If it wasn't you please simply disregard this email. If it was you, then <span style='font-weight: 400;'>use this code <strong>$code</strong> to verify your email or click the “Verify Email Button” below to Verify Your Account.</span>"
                ],
                'links' => [
                    'Verify Email' => config("app.url")."/auth/verify?email=$address&code=$code"
                ]
            ]);

            static::$mail->send($subject);
            return true;
        } catch (Exception $e) {
            logger(storage_path("logs/email.log"))->error('Caught a ' . get_class($e) . ': ' . $e->getMessage(), $e->getTrace());
            return false;
        }
    }
}
