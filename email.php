<?php
// Get client IP address (honor X-Forwarded-For)
if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
    $ip = $_SERVER['HTTP_CLIENT_IP'];
} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
} else {
    $ip = $_SERVER['REMOTE_ADDR'];
}

// Send Email
if (strpos($_SERVER['HTTP_REFERER'], 'gamily.in') !== false || strpos($_SERVER['HTTP_REFERER'], '127.0.0.1') !== false ) {

    require '../PHPMailer/PHPMailerAutoload.php';

    $mail = new PHPMailer();
    $mail->IsSMTP();
    $mail->CharSet = 'UTF-8';

    $mail->Host       = 'research.iiit.ac.in';
    $mail->SMTPDebug  = 0;
    $mail->SMTPAuth   = true;
    $mail->Port       = 25;
    $mail->Username   = 'shivam.khandelwal@research.iiit.ac.in';
    $mail->Password   = 'WHY YOU THINK I SHOULD SHARE THIS?';
    $mail->From = $_POST['email'];
    $mail->FromName = $_POST['name'];
    $mail->AddAddress('shivam.khandelwal@research.iiit.ac.in', 'Shivam Khandelwal');
    $mail->AddCC('saikrishna.sripada@research.iiit.ac.in', 'Saikrishna Sripada');
    $mail->IsHTML(true);
    $mail->Subject = 'Gamily.in contact form : ' . $_POST['subject'];
    $mail->Body = nl2br($_POST['message']) . '<br><br>Sent from IP : ' . $ip;
    if(!$mail->Send())
    {
       echo 'Error. Please send to shivam.khandelwal@research.iiit.ac.in directly. Sorry. :(';
       exit(0);
    }

    echo 'Thanks for writing to us. We will try to get back asap!';

}
