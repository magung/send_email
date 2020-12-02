<?php
    include "conn.php";
    session_start();
    // var_dump(isset($_SESSION['username']));
    if(isset($_SESSION['username']) == false){
      echo '<script> window.location.replace("index.php");</script>';
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
        <h1>EMAIL SMTP</h1>
        <form action="" class="col-md-6" method="post">
        <?php 
            if($_SERVER['REQUEST_METHOD']=='POST'){
                $email_smtp       = $_POST['email_smtp'];
                
                $emailpass = explode("@|@", $email_smtp);
                $email = $emailpass[0];
                $pass = $emailpass[1];
                // var_dump($email." ".$pass);die();
                if($email_smtp==''){
                    echo "<div class='alert alert-warning fade show alert-dismissible mt-2'>
                            Form harus di isi semua !
                        </div>";	
                }else{
                    $_SESSION['email_smtp'] = $email;
                    $_SESSION['pass_smtp'] = $pass;
                    echo '<script> window.location.replace("list_email.php");</script>';
                }
            }
            ?>
            <div class="form-group">
                <label for="exampleInputEmail1">EMAIL SMTP (email yang dipakai pengirim)</label>
                <select class="custom-select" name="email_smtp" id="exampleInputEmail1" required>
                    <option selected disabled value="">Choose...</option>
                    <?php 
                        $sqlkategori=mysqli_query($koneksi, 'SELECT * FROM email_smtp');  
                        while($dataemail=mysqli_fetch_array($sqlkategori)){
                            echo "<option value='$dataemail[email]@|@$dataemail[password]'>$dataemail[email]</option>";
                        }
                    ?>
                    <option></option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">SUBMIT</button>
            <a href="history.php" class="btn btn-success">HISTORY</a>
            <a href="index.php" class="btn btn-danger">LOGOUT</a>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
</body>
</html>