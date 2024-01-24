<?php
require_once '../include/config.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../PHPMailer/src/Exception.php';
require '../PHPMailer/src/PHPMailer.php';
require '../PHPMailer/src/SMTP.php';

if(isset($_POST['bestel'])){
    $mail = new PHPMailer(true);

    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'donotwebshop@gmail.com';
    $mail->SMTPSecure = 'ssl';
    $mail->Port = 465;

    $mail->setFrom('donotwebshop@gmail.com');

    $mail->addAddress('rida541552@gmail.com');

    $mail->isHTML(true);

    $mail->Subject = 'Donot bestelling';
    $mail->Body = 'hello';

    $mail->send('email.php');

    echo "
    <script>
        alert('Email is verzonden');
        document.location.href = '../main/index.php';
    </script>
    ";
}   

?>
