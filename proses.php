<?php
//ini wajib dipanggil paling atas
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

//ini sesuaikan foldernya ke file 3 ini
// require 'PHPMailer/PHPMailer/src/Exception.php';
// require 'PHPMailer/PHPMailer/src/PHPMailer.php';
// require 'PHPMailer/PHPMailer/src/SMTP.php';

require './PHPMailer-master/PHPMailer-master/src/Exception.php';
require './PHPMailer-master/PHPMailer-master/src/PHPMailer.php';
require './PHPMailer-master/PHPMailer-master/src/SMTP.php';


  //sesuaikan name dengan di form nya ya 
  $email = $_POST['email'];
  $judul = $_POST['judul'];
  $pesan = $_POST['pesan'];

//Create an instance; passing `true` enables exceptions
// zmlcpmwkljevadmo
$mail = new PHPMailer();


try {
    //Server settings
    $mail->SMTPDebug = 0;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'fedrianarahman21@gmail.com';                     //SMTP username
    $mail->Password   = 'zmlcpmwkljevadmo';                               //SMTP password
    $mail->SMTPSecure = 'tls';            //Enable implicit TLS encryption
    $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //pengirim
    
    $mail->setFrom('fedrianarahman21@gmail.com', 'Verifikasi');
    $mail->addAddress($email, 'Rahman Fedriana');     //Add a recipient
 
    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = $judul;
    $mail->Body    = $pesan;
    $mail->AltBody = '';
    //$mail->AddEmbeddedImage('gambar/logo.png', 'logo'); //abaikan jika tidak ada logo
    //$mail->addAttachment(''); 

    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";

}
          //redirect ke halaman index.php
        echo "<script>alert('Email berhasil terkirim! ke ');window.location='index.php';</script>";
        
        ?>
