<?php 
  include 'koneksi.php';
  include 'cek_status_login.php';
  $user = $_SESSION['user'];
?>
<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
      <!-- Required meta tags -->
      <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
  <?php include "template/header.php";?>
  <title>Data Lembur</title>
</head>

<body>
  <?php include 'template/sidebar.php'; ?>
    <div class="col-md-10 p-5 pt-2">
    <?php

$this_day = date("Y-m-d");
// var_dump($_SESSION);
// echo $this_day;
// $sql = "SELECT *FROM data_absen  LEFT JOIN tanggal on  WHERE id_tgl='$this_day' AND username='$user'";
$sql = "SELECT fl.*,da.id_absen FROM form_lembur as fl LEFT JOIN data_absen as da on da.id_form_lembur = fl.id_form_lembur where fl.tanggal='$this_day' AND fl.username='$user'";
$query_tday = mysqli_query($koneksi,$sql);
$row = mysqli_fetch_all($query_tday, MYSQLI_ASSOC);
// var_dump($row);
if(isset($row[0]['id_form_lembur'])){

  $idfl = $row[0]['id_form_lembur'];
  $idabsen = $row[0]['id_absen'];
}
// $disable_in="";
// $disable_out="";
// Notifikasi Absen
	if (isset($_GET['ab'])) {
		if ($_GET['ab']==1) {
			echo "<div class='alert alert-warning'><strong>Terimakasih, Absen berhasil.</strong></div>";
		} elseif($_GET['ab']==2) {
			echo "<div class='alert alert-danger'><strong>Maaf, Absen Gagal. Silahkan Coba Kembali!</strong></div>";
		}
	}
echo "<div class='table-responsive'>
           <table class='table table-striped'>
            <thead>
               <tr>
                <th>Status</th>
                <th>Keterangan</th>
                <th>Absen Pulang</th>
               </tr>
            </thead>
            <tbody>";

if (mysqli_num_rows($query_tday) ==1) {
       $status='./lib/img/warning.png';
       $message = "Anda Belum Mengisi Absen Hari Ini";
       $disable_in = "";
       $disable_out = " disabled='disabled'";
} else {
	   
       $disable_in = " disabled='disabled'";
       while($get_day= $query_tday->fetch_assoc()){
        // echo $get_day['jam_klr'];
       
       
      //  $koneksi->close();
       
       if ($get_day['jam_klr']!=="") {
       		$status='img/complete.png';
       		$message = "Absensi hari ini selesai! Terimakasih.";
       		$disable_out = " disabled='disable'";
       } else {
       		$status='img/minus.png';
       		$message = "Absen Masuk Selesai. Jangan Lupa Absen Pulang !";
       		$disable_out = "";
       }
      }
}
$a = 0;
if ($query_tday->num_rows==1 && $idabsen == NULL) {
  $status='img/warning.png';
  $message = "Anda Belum Mengisi Absen Hari Ini";
  $disable_in = "";
  $disable_out = "";
  // $disable_out = " disabled='disabled'";
}else if($query_tday->num_rows==1 && $idabsen != NULL) {
  $status='';
  $message = "Anda Sudah Mengisi Absen Hari Ini";
  $disable_in = "";
  $disable_out = "disabled='disabled'";
}
else {

  $disable_in = " disabled='disabled'";
  
  
  // $koneksi->close();
  while($get_day= $query_tday->fetch_assoc()){
    if (!empty($get_day['jml_klr'])) {
      $status='img/complete.png';
      $message = "Absensi hari ini selesai! Terimakasih.";
      $disable_out = " disabled='disabled'";
  } else {
      $status='img/minus.png';
      $message = "Absen Masuk Selesai. Jangan Lupa Absen Pulang !";
      $disable_out = "";
  }
  }
 
//  $test = isset($get_day['jam_klr']) && $get_day['jml_klr']!==NULL;
// if($test === false){
//   echo '<script>alert("Welcome to Geeks for Geeks")</script>';
// }
  
}
if(isset($status,$message,$disable_out)){
  echo 	"<tr>
        <td><img src='$status' width='30px'/></td>
        <td><h5>$message</h5></td>
        <td><button type='button' class='btn btn-danger' onclick=\"window.location.href='proses.php?absen=2&id_fl=$idfl';\" $disable_out>Absen Pulang</button></td>
        </tr>";
}
else{
  echo "<tr>
        <td>Tidak Ada Absen Lembur Hari Ini</td>
        <td><h5></h5></td>
        <td></td>
        <td></td>
        </tr>";
}
echo "</table></div>";

?>

  </div>

  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <?php include "template/footer.php"; ?>
</body>

</html>