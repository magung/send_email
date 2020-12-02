<?php
include "conn.php";

session_start();
// var_dump(isset($_SESSION['username']));
if(isset($_SESSION['username']) == false){
	echo '<script> window.location.replace("index.php");</script>';
}

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once "library/PHPMailer.php";
require_once "library/Exception.php";
require_once "library/OAuth.php";
require_once "library/POP3.php";
require_once "library/SMTP.php";
 
$listemail = explode("|@|", $_POST['listemail']);
// var_dump($listemail);
$jumlah = count($listemail);
// var_dump($jumlah);die();

for($i=0;$i<$jumlah;$i++){
	sleep ( rand ( 1, 3));

	$mail = new PHPMailer;
 
	//Enable SMTP debugging. 
	$mail->SMTPDebug = 3;                               
	//Set PHPMailer to use SMTP.
	$mail->isSMTP();            
	//Set SMTP host name                          
	$mail->Host = "tls://smtp.gmail.com"; //host mail server
	//Set this to true if SMTP host requires authentication to send email
	$mail->SMTPAuth = true;                          
	//Provide username and password     
	$mail->Username = $_SESSION['email_smtp'];   //nama-email smtp          
	$mail->Password = $_SESSION['pass_smtp'];    //password email smtp
	//If SMTP requires TLS encryption then set it
	$mail->SMTPSecure = "tls";                           
	//Set TCP port to connect to 
	$mail->Port = 587;                                   
 
	$mail->From = $_SESSION['email_smtp']; //email pengirim
	$mail->FromName = $_POST['nama'];; //nama pengirim
 
	$mail->addAddress($listemail[$i]); //email penerima
 
	$mail->isHTML(true);
 
	$mail->Subject = $_POST['subject']; //subject
    $mail->Body    = $_POST['body']; //isi email
        // $mail->AltBody = "PHP mailer"; //body email (optional)
	
	$status = "";
	if(!$mail->send()) 
	{
		$status = "GAGAL";
	    echo "Mailer Error: " . $mail->ErrorInfo;
	} 
	else 
	{
		$status = "SUKSES";
		echo "Message has been sent successfully";
	}
	$queryinsert = "INSERT INTO `history` (`id`, `email`, `subject`, `body`, `created_at`, `email_pengirim`, `nama_pengirim`, `status`) VALUES (NULL, '$listemail[$i]', '$_POST[subject]', '$_POST[body]', current_timestamp(), '$_SESSION[email_smtp]', '$_POST[nama]', '$status');";
	mysqli_query($koneksi, $queryinsert);  
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Send Email</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
</head>
<body>
    <div class="container">
	<a href="email_smtp.php" class="btn btn-danger pull-right">
        <span class="glyphicon glyphicon-remove"></span> KEMBALI KE HALAMAN EMAIL
      </a>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
</body>
</html>