
<?php
    include "conn.php";
    session_start();
    // var_dump($_SESSION['email_smtp']);
    // var_dump($_SESSION['pass_smtp']);
    if(isset($_SESSION['username']) == false){
      echo '<script> window.location.replace("index.php");</script>';
    }
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Import Data Excel dengan PHP</title>
    <!-- Load File bootstrap.min.css yang ada difolder css -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <!-- Style untuk Loading -->
    
    <!-- CKEDITOR -->
    <script type="text/javascript" src="ckeditor/ckeditor.js"></script>
	  <link rel="stylesheet" type="text/css" href="style.css">
    
    <style>
        #loading{
      background: whitesmoke;
      position: absolute;
      top: 140px;
      left: 82px;
      padding: 5px 10px;
      border: 1px solid #ccc;
    }
    </style>
    
    <!-- Load File jquery.min.js yang ada difolder js -->
    <script src="jquery.min.js"></script>
    
    <script>
    $(document).ready(function(){
      // Sembunyikan alert validasi kosong
      $("#kosong").hide();
    });
    </script>
  </head>
  <body>
    <!-- Membuat Menu Header / Navbar -->
    <nav class="navbar navbar-inverse" role="navigation">
      <div class="container-fluid">
        <div class="navbar-header">
          <a class="navbar-brand" href="#" style="color: white;"><b>Import Data Excel dengan PHP</b></a>
        </div>
      </div>
    </nav>
    
    <!-- Content -->
    <div style="padding: 0 15px;" class="container">
      <!-- Buat sebuah tombol Cancel untuk kemabli ke halaman awal / view data -->
      
      
      <h3>Form Import Data</h3>
      <hr>
      
      <!-- Buat sebuah tag form dan arahkan action nya ke file ini lagi -->
      <form method="post" action="" enctype="multipart/form-data">
        <a href="email.xlsx" class="btn btn-default">
          <span class="glyphicon glyphicon-download"></span>
          Download Format
        </a><br><br>
        
        <!-- 
        -- Buat sebuah input type file
        -- class pull-left berfungsi agar file input berada di sebelah kiri
        -->
        <input type="file" name="file" class="pull-left">
        
        <button type="submit" name="preview" class="btn btn-success btn-sm">
          <span class="glyphicon glyphicon-eye-open"></span> LIAT DATA
        </button>
      </form>
      
      <hr>
      
      <!-- Buat Preview Data -->
      <?php
      // Jika user telah mengklik tombol Preview
      if(isset($_POST['preview'])){
        $nama_file_baru = 'data.xlsx';
        
        // Cek apakah terdapat file data.xlsx pada folder tmp
        if(is_file('tmp/'.$nama_file_baru)) // Jika file tersebut ada
          unlink('tmp/'.$nama_file_baru); // Hapus file tersebut
        
        $ext = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION); // Ambil ekstensi filenya apa
        $tmp_file = $_FILES['file']['tmp_name'];
        // Cek apakah file yang diupload adalah file Excel 2007 (.xlsx)
        if($ext == "xlsx"){
          // Upload file yang dipilih ke folder tmp
          move_uploaded_file($tmp_file, 'tmp/'.$nama_file_baru);
          
          // Load librari PHPExcel nya
          require_once 'PHPExcel/PHPExcel.php';
          
          $excelreader = new PHPExcel_Reader_Excel2007();
          $loadexcel = $excelreader->load('tmp/'.$nama_file_baru); // Load file yang tadi diupload ke folder tmp
          $sheet = $loadexcel->getActiveSheet()->toArray(null, true, true ,true);
          
          // Buat sebuah tag form untuk proses import data ke database
          echo "<form method='post' action='kirim.php'>";
          
          // Buat sebuah div untuk alert validasi kosong
          echo "<div class='alert alert-danger' id='kosong'>
          Semua data belum diisi, Ada <span id='jumlah_kosong'></span> data yang belum diisi.
          </div>";
          
          // echo "<table class='table table-bordered'>
          // <tr>
          //   <th colspan='5' class='text-center'>Preview Data</th>
          // </tr>
          // <tr>
          //   <th>Email</th>
          // </tr>";
          
          $numrow = 1;
          $kosong = 0;
          $jumlahemail = 0;
          $listemail="";
          foreach($sheet as $row){ // Lakukan perulangan dari data yang ada di excel
            // Ambil data pada excel sesuai Kolom
            $email = $row['A']; // Ambil data EMAIL
            
            // Cek jika semua data tidak diisi
            if($email == "")
              continue; // Lewat data pada baris ini (masuk ke looping selanjutnya / baris selanjutnya)
            
            // Cek $numrow apakah lebih dari 1
            // Artinya karena baris pertama adalah nama-nama kolom
            // Jadi dilewat saja, tidak usah diimport
            if($numrow > 1){
              // Validasi apakah semua data telah diisi
              $email_td = ( ! empty($email))? "" : " style='background: #E07171;'"; // Jika email kosong, beri warna merah
              
              // Jika salah satu data ada yang kosong
              if($email == ""){
                $kosong++; // Tambah 1 variabel $kosong
              }else{
                $jumlahemail++;
              }
              if($listemail==""){
                $listemail.=$email;
              }else{
                $listemail.="|@|".$email;
              }
              
              // echo "<tr>";
              // echo "<td".$email_td.">".$email."</td>";
              // echo "</tr>";
            }
            
            $numrow++; // Tambah 1 setiap kali looping
          }
          
          // echo "</table>";
          echo $jumlahemail." EMAIL";
          
          // Cek apakah variabel kosong lebih dari 0
          // Jika lebih dari 0, berarti ada data yang masih kosong
          if($kosong > 0){
          ?>  
            <script>
            $(document).ready(function(){
              // Ubah isi dari tag span dengan id jumlah_kosong dengan isi dari variabel kosong
              $("#jumlah_kosong").html('<?php echo $kosong; ?>');
              
              $("#kosong").show(); // Munculkan alert validasi kosong
            });
            </script>
          <?php
          }else{ // Jika semua data sudah diisi
            echo "<hr>";
            
            // Buat sebuah tombol untuk mengimport data ke database
            ?>

            <h1>ISI EMAIL</h1>
                <div class="form-group">
                  <label for="nama">Nama Pengirim</label>
                  <input type="text" name="nama" class="form-control" id="nama" placeholder="Pengirim">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Subject</label>
                    <input type="text" name="subject" class="form-control" id="exampleInputEmail1" placeholder="Subject Email">
                    <input type="hidden" name="listemail" class="form-control" value="<?php echo $listemail; ?>">
                </div>
                <div class="form-group">
                  <label for="ckedtor">Body</label>
                  <textarea class="ckeditor" id="ckedtor" rows="3" name="body" placeholder="Isi email"></textarea>
                </div>
                <button type="submit" class="btn btn-primary">KIRIM</button>
            <?php
          }
          
          echo "</form>";
        }else{ // Jika file yang diupload bukan File Excel 2007 (.xlsx)
          // Munculkan pesan validasi
          echo "<div class='alert alert-danger'>
          Hanya File Excel 2007 (.xlsx) yang diperbolehkan
          </div>";
        }
      }
      ?>
      <br>
      <a href="email_smtp.php" class="btn btn-danger pull-right">
        <span class="glyphicon glyphicon-remove"></span> KEMBALI KE HALAMAN EMAIL
      </a>
    </div>

  </body>
</html>