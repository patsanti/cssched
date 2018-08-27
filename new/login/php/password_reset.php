<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
include($_SERVER['DOCUMENT_ROOT']."/augeo/global/php/connection.php");
$send_to = $_POST['email'];
$bol = 0;
// check if entered email is in the database
$result = mysqli_query($conn,"SELECT augeo_user_end.user.email,augeo_user_end.user.account_id FROm augeo_user_end.user where augeo_user_end.user.email = '$send_to' ");
    if($row=mysqli_num_rows($result) == 1){
            $found = mysqli_fetch_array($result);
            $bol = 1;
           $account_id =  $found['account_id'];
        }
    else{
            $bol = 0;
}




if($bol == 1){

   require $_SERVER['DOCUMENT_ROOT']."/augeo/global/vendor/PHPMailer/src/PHPMailer.php";
//    require "PHPMailer/src/OAuth.php";
    require $_SERVER['DOCUMENT_ROOT']."/augeo/global/vendor/PHPMailer/src/SMTP.php";
//    require "PHPMailer/src/POP3.php";
    require $_SERVER['DOCUMENT_ROOT']."/augeo/global/vendor/PHPMailer/src/Exception.php";

$mail = new PHPMailer(true);                          // Passing `true` enables exceptions
try {
    //Server settings
$mail->SMTPOptions = array(
    'ssl' => array(
        'verify_peer' => false,
        'verify_peer_name' => false,
        'allow_self_signed' => true
    )
);
    $mail->SMTPDebug = 1;                                 // Enable verbose debug output
    $mail->isSMTP(false);                                      // Set mailer to use SMTP
    $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication

    $mail->Username = 'augeowebsite@gmail.com';                 // SMTP username
    $mail->Password = 'augeop@55w0rd';                           // SMTP password
    $mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 465;                                    // TCP port to connect to

    //Recipients
    $mail->setFrom('augeowebsite@gmail.com', 'AUGEO');
    $mail->addAddress($send_to);     // Add a recipient
 //   $mail->addAddress('ellen@example.com');               // Name is optional
   // $mail->addCC('cc@example.com');
   // $mail->addBCC('bcc@example.com');

    //Attachments
  //  $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
    // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

    //Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'Change Password';
    $mail->Body    = '<h1> AUGEO WEBSITE</h1><br>
                    <p> to Change password, click <a href="http://localhost/augeo/login/password_reset/?aassmmss='.$account_id.'"> here </a>

    ';
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
   echo "success";
} catch (Exception $e) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
}
}

else{
    echo "failed";
}