<?php
    session_start();
    session_unset();
    session_destroy();
    // var_dump(isset($_SESSION['username']));
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
        <h1>LOGIN</h1>
        <form action="" class="col-md-6" method="post">
        <?php 
            if($_SERVER['REQUEST_METHOD']=='POST'){
                $username       = md5($_POST['username']);
                $password       = md5($_POST['password']);
                // var_dump($username);
                // var_dump($password);die();
                                                
                if($password=='' || $username==''){
                    echo "<div class='alert alert-warning fade show alert-dismissible mt-2'>
                            Form harus di isi semua !
                        </div>";	
                }else{
                    $u = "21232f297a57a5a743894a0e4a801fc3"; //admin
                    $p = "202cb962ac59075b964b07152d234b70"; //123
                    if($username === $u && $password === $p){
                        session_start();
                        $_SESSION['username'] = $u;
                        echo '<script> window.location.replace("email_smtp.php");</script>';

                    }else{
                        echo "<div class='alert alert-warning fade show alert-dismissible mt-2'>
                            Gagal Login mungkin Username atau password anda salah atau user anda kadaluwarsa !
                        </div>";	
                    }
                }
            }
            ?>
            <div class="form-group">
                <label for="exampleInputEmail1">Username</label>
                <input type="text" name="username" class="form-control" id="exampleInputEmail1">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Password</label>
                <input type="password" name="password" class="form-control" id="exampleInputPassword1">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
</body>
</html>