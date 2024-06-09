<?php 
  include 'koneksi.php';
  include 'cek_status_login.php';
  $user = $_SESSION['user'];
?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <?php include 'template/header.php'; ?>
    <title>Detail Honor</title>
</head>

<body>

    <?php include 'template/sidebar.php'; ?>
    <div class="col-md-10 p-5 pt-2">
            <h3><i class="fas fa-table mr-2"></i>Detail Honor Lembur Karyawan</h3>
            <hr>
            <div class="table-responsive">
            <table class="table table-striped table-bordered" id="dataTable">
                <thead>
                    <tr>
                        <th scope="col">Bulan</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
          <?php
          if(isset($_GET['username'])){
            $username = $_GET['username'];
          }
            if($_SESSION['role'] == "Keuangan"){ 
                $query = "SELECT u.*,k.*,j.id_kategori,fl.id_form_lembur,fl.username,fl.tanggal, fl.jam_mulai, fl.jam_selesai, TIMESTAMPDIFF(HOUR, jam_mulai, jam_selesai) as `jam_lembur`,IF(TIMESTAMPDIFF(HOUR, jam_mulai, jam_selesai) > 3,TIMESTAMPDIFF(HOUR, jam_mulai, jam_selesai) -1,TIMESTAMPDIFF(HOUR, jam_mulai, jam_selesai)) as `total_lembur`,IF(TIMESTAMPDIFF(HOUR, jam_mulai, jam_selesai) > 3,1,0) as `istirahat`,IF(TIMESTAMPDIFF(HOUR, jam_mulai, jam_selesai) > 3,TIMESTAMPDIFF(HOUR, jam_mulai, jam_selesai) -1,TIMESTAMPDIFF(HOUR, jam_mulai, jam_selesai)) as `total_lembur`,IF(TIMESTAMPDIFF(HOUR, jam_mulai, jam_selesai) > 3,30000,0) as `uang_makan`,(tarif*TIMESTAMPDIFF(HOUR, jam_mulai, jam_selesai)) as `penghasilan` FROM form_lembur as fl INNER JOIN user as u ON fl.username = u.username INNER JOIN jabatan as j on u.jabatan = j.id_jabatan INNER JOIN kategori as k on j.id_kategori = k.id_kategori  where u.jurusan = '".$_SESSION['jurusan']."' AND fl.username = '$username'";
            }else if($_SESSION['role'] == "Kepala Unit"){
                $query = "SELECT u.*,k.*,j.id_kategori,fl.id_form_lembur,fl.username,fl.tanggal, fl.jam_mulai, fl.jam_selesai, TIMESTAMPDIFF(HOUR, jam_mulai, jam_selesai) as `jam_lembur`,IF(TIMESTAMPDIFF(HOUR, jam_mulai, jam_selesai) > 3,TIMESTAMPDIFF(HOUR, jam_mulai, jam_selesai) -1,TIMESTAMPDIFF(HOUR, jam_mulai, jam_selesai)) as `total_lembur`,IF(TIMESTAMPDIFF(HOUR, jam_mulai, jam_selesai) > 3,1,0) as `istirahat`,IF(TIMESTAMPDIFF(HOUR, jam_mulai, jam_selesai) > 3,TIMESTAMPDIFF(HOUR, jam_mulai, jam_selesai) -1,TIMESTAMPDIFF(HOUR, jam_mulai, jam_selesai)) as `total_lembur`,IF(TIMESTAMPDIFF(HOUR, jam_mulai, jam_selesai) > 3,30000,0) as `uang_makan`,(tarif*TIMESTAMPDIFF(HOUR, jam_mulai, jam_selesai)) as `penghasilan` FROM form_lembur as fl INNER JOIN user as u ON fl.username = u.username INNER JOIN jabatan as j on u.jabatan = j.id_jabatan INNER JOIN kategori as k on j.id_kategori = k.id_kategori  where u.jurusan = '".$_SESSION['jurusan']."' AND u.username ='$username'  GROUP BY SUBSTRING_INDEX(SUBSTRING_INDEX(fl.tanggal,'-',2),'-',-1)";
                // $query = "SELECT nama, kategori, tarif, tanggal, sum(jam_lembur) as jam_lembur, sum(uang_makan) as uang_makan, rekening FROM honor JOIN form_lembur on honor.id = form_lembur.id JOIN user on user.username = form_lembur.username join kategori on kategori.id_kategori = user.kategori where user.jurusan = '".$_SESSION['jurusan']."' group by form_lembur.username, MONTH(tanggal), YEAR(tanggal)";
            }else{
                $query = "SELECT u.*,k.*,j.id_kategori,fl.id_form_lembur,fl.username,fl.tanggal, fl.jam_mulai, fl.jam_selesai, TIMESTAMPDIFF(HOUR, jam_mulai, jam_selesai) as `jam_lembur`,IF(TIMESTAMPDIFF(HOUR, jam_mulai, jam_selesai) > 3,TIMESTAMPDIFF(HOUR, jam_mulai, jam_selesai) -1,TIMESTAMPDIFF(HOUR, jam_mulai, jam_selesai)) as `total_lembur`,IF(TIMESTAMPDIFF(HOUR, jam_mulai, jam_selesai) > 3,1,0) as `istirahat`,IF(TIMESTAMPDIFF(HOUR, jam_mulai, jam_selesai) > 3,TIMESTAMPDIFF(HOUR, jam_mulai, jam_selesai) -1,TIMESTAMPDIFF(HOUR, jam_mulai, jam_selesai)) as `total_lembur`,IF(TIMESTAMPDIFF(HOUR, jam_mulai, jam_selesai) > 3,30000,0) as `uang_makan`,(tarif*TIMESTAMPDIFF(HOUR, jam_mulai, jam_selesai)) as `penghasilan` FROM form_lembur as fl INNER JOIN user as u ON fl.username = u.username INNER JOIN jabatan as j on u.jabatan = j.id_jabatan INNER JOIN kategori as k on j.id_kategori = k.id_kategori  where u.jurusan = '".$_SESSION['jurusan']."' AND u.username ='$username'  GROUP BY SUBSTRING_INDEX(SUBSTRING_INDEX(fl.tanggal,'-',2),'-',-1)";
                // $query = "SELECT u.*,k.*,j.id_kategori,fl.id_form_lembur,fl.username,fl.tanggal, fl.jam_mulai, fl.jam_selesai, TIMESTAMPDIFF(HOUR, jam_mulai, jam_selesai) as `jam_lembur`,IF(TIMESTAMPDIFF(HOUR, jam_mulai, jam_selesai) > 3,TIMESTAMPDIFF(HOUR, jam_mulai, jam_selesai) -1,TIMESTAMPDIFF(HOUR, jam_mulai, jam_selesai)) as `total_lembur`,IF(TIMESTAMPDIFF(HOUR, jam_mulai, jam_selesai) > 3,1,0) as `istirahat`,IF(TIMESTAMPDIFF(HOUR, jam_mulai, jam_selesai) > 3,TIMESTAMPDIFF(HOUR, jam_mulai, jam_selesai) -1,TIMESTAMPDIFF(HOUR, jam_mulai, jam_selesai)) as `total_lembur`,IF(TIMESTAMPDIFF(HOUR, jam_mulai, jam_selesai) > 3,30000,0) as `uang_makan`,(tarif*TIMESTAMPDIFF(HOUR, jam_mulai, jam_selesai)) as `penghasilan` FROM form_lembur as fl INNER JOIN user as u ON fl.username = u.username INNER JOIN jabatan as j on u.jabatan = j.id_jabatan INNER JOIN kategori as k on j.id_kategori = k.id_kategori where form_lembur.username = '".$_SESSION['user']."'";
            }
            
            $sql = mysqli_query($koneksi, $query);
            $i = 0; 
              while($data = mysqli_fetch_array($sql)) {
                //   var_dump($data);
                  $total_uang_lembur = $data['total_lembur'] * $data['tarif'];
                  $total_uang_lembur_makan = $total_uang_lembur + $data['uang_makan'];
                  $uang_pph = round($total_uang_lembur_makan * 0.05);
                ?>
            
            <tr>
                <td><?php
 $monthNum = explode("-",$data['tanggal'])[1];
 $monthName = date("F", mktime(0, 0, 0, $monthNum, 10));
 echo $monthName; // Output: May
?></td>
                <td><form method="POST" action="">
              <a href="detail-honor.php?username=<?php echo $username?>&month=<?php echo $monthNum ?>" class="btn btn-primary btn-sm">Detail</a>
            </form>
            </td>
                
            </tr>
          <?php 
        }
            ?>
        </tbody>
            </table>
</body>
</html>