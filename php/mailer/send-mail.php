<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    require_once('./class.phpmailer.php');

    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $subject = trim($_POST['subject']);
    $message = trim($_POST['message']);
    $gotcha = trim($_POST['gotcha']);
    $gotcha_email = base64_decode($gotcha);


    if ($gotcha_email == $email){
        try {
            $email_msg = "'" . $name . "' has emailed support with the following message:<br><br>" . $message;
            $email_subject = $subject . " (" . $name . " -> support@contactABG.com)";

            $mail = new PHPMailer();
            $mail->SMTPDebug  = 0;
            $mail->SMTPAuth   = true;
            $mail->SMTPSecure = "ssl";
            $mail->Host       = "smtp.gmail.com";
            $mail->Port       = 465;
            $mail->AddAddress('abo@contactABG.com');
            $mail->Username= "4boc4do@gmail.com";
            $mail->Password= "tD4k2fNvqs9XsGbT";
            $mail->SetFrom($email);
            $mail->AddReplyTo($email);
            $mail->Subject    = $email_subject;
            $mail->MsgHTML($email_msg);
            $mail->Send();
        } catch (Exception $e) {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }

        echo $name . " Thank you for contacting us. We will be in touch shortly!";
    }
    else {
        echo "Email Authentication failed " . $gotcha_email;
    }


}
else {
    echo "Unauthorized Usage...you have been reported!";
}
?>