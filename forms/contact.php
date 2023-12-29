<?php

class PHP_Email_Form
{
    public $to;
    public $from_name;
    public $from_email;
    public $subject;
    public $message;
    public $headers;
    public $smtp;

    public function add_message($content, $label = '')
    {
        $this->message .= "<strong>$label:</strong> $content<br>";
    }

    public function send()
    {
        $this->headers = "MIME-Version: 1.0" . "\r\n";
        $this->headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $this->headers .= "From: $this->from_name <$this->from_email>" . "\r\n";

        if (isset($this->smtp)) {
            $this->smtp_send();
        } else {
            $this->mail_send();
        }
    }

    private function mail_send()
    {
        mail($this->to, $this->subject, $this->message, $this->headers);
    }

    private function smtp_send()
    {
        // You need to implement SMTP sending logic here
        // Use the $this->smtp array for SMTP configuration
        // Example:
        /*
        $mail = new PHPMailer(true);

        $mail->isSMTP();
        $mail->Host = $this->smtp['host'];
        $mail->SMTPAuth = true;
        $mail->Username = $this->smtp['username'];
        $mail->Password = $this->smtp['password'];
        $mail->SMTPSecure = 'tls';
        $mail->Port = $this->smtp['port'];

        $mail->setFrom($this->from_email, $this->from_name);
        $mail->addAddress($this->to);
        $mail->Subject = $this->subject;
        $mail->msgHTML($this->message);

        if (!$mail->send()) {
            echo 'Message could not be sent.';
            echo 'Mailer Error: ' . $mail->ErrorInfo;
        } else {
            echo 'Message has been sent';
        }
        */
    }
}

// Replace contact@example.com with your real receiving email address
$receiving_email_address = 'uacoding01@gmail.com';

$contact = new PHP_Email_Form;
$contact->ajax = true;

$contact->to = $receiving_email_address;
$contact->from_name = $_POST['name'];
$contact->from_email = $_POST['email'];
$contact->subject = $_POST['subject'];

$contact->add_message($_POST['name'], 'From');
$contact->add_message($_POST['email'], 'Email');
$contact->add_message($_POST['message'], 'Message', 10);

echo $contact->send();
?>
