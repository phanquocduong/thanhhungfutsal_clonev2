<?php
    require_once __DIR__ . '/../vendor/autoload.php';

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    class MailService {
        private $mailer;

        public function __construct() {
            $this->mailer = new PHPMailer(true);
            $this->mailer->CharSet = 'UTF-8';
            $this->configureSMTP();
        }

        private function configureSMTP() {
            $this->mailer->isSMTP();
            $this->mailer->Host = 'smtp.gmail.com';
            $this->mailer->SMTPAuth = true;
            $this->mailer->Username = 'phanquocduong.070905@gmail.com';
            $this->mailer->Password = 'jiyc xwil lkkm jhkg';
            $this->mailer->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $this->mailer->Port = 587;
        }

        public function sendEmail($to, $subject, $body) {
            try {
                $this->mailer->setFrom('phanquocduong.070905@gmail.com', 'Thanh Hùng Futsal');
                $this->mailer->addAddress($to);
                $this->mailer->isHTML(true);
                $this->mailer->Subject = $subject;
                $this->mailer->Body = $body;

                $this->mailer->send();
                return true;
            } catch (Exception $e) {
                error_log("Không thể gửi email. Lỗi gửi thư: {$this->mailer->ErrorInfo}");
                return false;
            }
        }
    }
?>
