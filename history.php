<?php include "conn.php"; ?>
<html>
<head>

  <title>Project Base Team 3</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    <!-- Bootstrap core CSS -->

      <link rel="stylesheet" type="text/css" href="DataTables/datatables.min.css"/>
      <script type="text/javascript" src="DataTables/datatables.min.js"></script>
      <script>
        $(document).ready(function () {
            $('#dataTables-example').dataTable();
           
        });
      </script>
    <!-- Data table -->
</head>
<body>
<body>
    <div class='container'>
        <h1 class='text-center'>History Pengiriman</h1>
        <a href="email_smtp.php" class="btn btn-danger">Kembali</a><br><br>
        <div class="table-responsive p-5">
            
            <table id='dataTables-example' class="text-gray-900 table">
                <thead>
                <tr> 
                    <th>No.</th>
                    <th>Email</th>
                    <th>Subject</th>
                    <th>Body</th>
                    <th>Pengirim</th>
                    <th>Status</th>
                    <th>Tanggal</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $sql=mysqli_query($koneksi, "SELECT * FROM history");
                $no = 1;
                while($d=mysqli_fetch_array($sql)){
                    echo "<tr id='search'>
                            <td>".$no++."</td>
                            <td>$d[email]</td>
                            <td>$d[subject]</td>
                            <td>$d[body]</td>
                            <td>Nama : $d[nama_pengirim]<br>Email : $d[email_pengirim]</td>
                            <td>$d[status]</td>
                            <td>$d[created_at]</td>
                        </tr>
                        ";
                }
                ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
<script>
// Peringatan hapus buku
$('.hapus-pejabat').click(function(){

    var nama = $(this).attr('data-nama');
    $('#nama_pejabat').text(nama);

    var id=$(this).data('id');
    $('#modalDelete').attr('href','anggota_delete.php?id='+id);
});
</script>
</html>