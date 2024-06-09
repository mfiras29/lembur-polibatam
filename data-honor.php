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
    <title>Data Honor</title>
</head>

<body>

    <?php include 'template/sidebar.php'; ?>

        <div class="col-md-10 p-4 pt-2">
            <h3><i class="fas fa-table mr-2"></i>Data Honor</h3>
            <hr>
            <div class="table-responsive">
            <table class="table table-striped table-bordered" id="dataTable">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Nama</th>
                        <!-- <th scope="col">Kegiatan</th> -->
                        <th scope="col">Tanggal</th>
                        <th scope="col">Jam Lembur</th>
                        <th scope="col">Istirahat Lembur</th>
                        <th scope="col">Total Jam Lembur</th>
                        <th scope="col">Uang Makan</th>
                        <th scope="col">Keterangan</th>
                    </tr>
                </thead>
        <tbody>
          <?php
          function timeToSecond($time){
            $parsed = date_parse($time);
            $seconds = $parsed['hour'] * 3600 + $parsed['minute'] * 60 + $parsed['second'];
            return $seconds;
        }

              $i = 0;

              if($_SESSION['role'] == "Keuangan"){
                $query = "SELECT u.*,j.id_kategori,fl.id_form_lembur,fl.username,fl.tanggal, fl.jam_mulai, fl.jam_selesai, TIMESTAMPDIFF(HOUR, jam_mulai, jam_selesai) as `jam_lembur`,IF(TIMESTAMPDIFF(HOUR, jam_mulai, jam_selesai) > 3,TIMESTAMPDIFF(HOUR, jam_mulai, jam_selesai) -1,TIMESTAMPDIFF(HOUR, jam_mulai, jam_selesai)) as `total_lembur`,IF(TIMESTAMPDIFF(HOUR, jam_mulai, jam_selesai) > 3,1,0) as `istirahat`,IF(TIMESTAMPDIFF(HOUR, jam_mulai, jam_selesai) > 3,TIMESTAMPDIFF(HOUR, jam_mulai, jam_selesai) -1,TIMESTAMPDIFF(HOUR, jam_mulai, jam_selesai)) as `total_lembur`,IF(TIMESTAMPDIFF(HOUR, jam_mulai, jam_selesai) > 3,30000,0) as `uang_makan`,(tarif*TIMESTAMPDIFF(HOUR, jam_mulai, jam_selesai)) as `penghasilan` FROM form_lembur as fl INNER JOIN user as u ON fl.username = u.username INNER JOIN jabatan as j on u.jabatan = j.id_jabatan INNER JOIN kategori as k on j.id_kategori = k.id_kategori  where u.jurusan = '".$_SESSION['jurusan']."' GROUP BY fl.username";
              }else if($_SESSION['role'] == "Kepala Unit"){
                $query = "SELECT u.*,j.id_kategori,fl.id_form_lembur,fl.username,fl.tanggal, fl.jam_mulai, fl.jam_selesai, TIMESTAMPDIFF(HOUR, jam_mulai, jam_selesai) as `jam_lembur`,IF(TIMESTAMPDIFF(HOUR, jam_mulai, jam_selesai) > 3,TIMESTAMPDIFF(HOUR, jam_mulai, jam_selesai) -1,TIMESTAMPDIFF(HOUR, jam_mulai, jam_selesai)) as `total_lembur`,IF(TIMESTAMPDIFF(HOUR, jam_mulai, jam_selesai) > 3,1,0) as `istirahat`,IF(TIMESTAMPDIFF(HOUR, jam_mulai, jam_selesai) > 3,TIMESTAMPDIFF(HOUR, jam_mulai, jam_selesai) -1,TIMESTAMPDIFF(HOUR, jam_mulai, jam_selesai)) as `total_lembur`,IF(TIMESTAMPDIFF(HOUR, jam_mulai, jam_selesai) > 3,30000,0) as `uang_makan`,(tarif*TIMESTAMPDIFF(HOUR, jam_mulai, jam_selesai)) as `penghasilan` FROM form_lembur as fl INNER JOIN user as u ON fl.username = u.username INNER JOIN jabatan as j on u.jabatan = j.id_jabatan INNER JOIN kategori as k on j.id_kategori = k.id_kategori  where u.jurusan = '".$_SESSION['jurusan']."' GROUP BY fl.username";
              }else{
                $query = "SELECT u.*,j.id_kategori,fl.id_form_lembur,fl.username,fl.tanggal, fl.jam_mulai, fl.jam_selesai, TIMESTAMPDIFF(HOUR, jam_mulai, jam_selesai) as `jam_lembur`,IF(TIMESTAMPDIFF(HOUR, jam_mulai, jam_selesai) > 3,TIMESTAMPDIFF(HOUR, jam_mulai, jam_selesai) -1,TIMESTAMPDIFF(HOUR, jam_mulai, jam_selesai)) as `total_lembur`,IF(TIMESTAMPDIFF(HOUR, jam_mulai, jam_selesai) > 3,1,0) as `istirahat`,IF(TIMESTAMPDIFF(HOUR, jam_mulai, jam_selesai) > 3,TIMESTAMPDIFF(HOUR, jam_mulai, jam_selesai) -1,TIMESTAMPDIFF(HOUR, jam_mulai, jam_selesai)) as `total_lembur`,IF(TIMESTAMPDIFF(HOUR, jam_mulai, jam_selesai) > 3,30000,0) as `uang_makan`,(tarif*TIMESTAMPDIFF(HOUR, jam_mulai, jam_selesai)) as `penghasilan` FROM form_lembur as fl INNER JOIN user as u ON fl.username = u.username INNER JOIN jabatan as j on u.jabatan = j.id_jabatan INNER JOIN kategori as k on j.id_kategori = k.id_kategori where fl.username = '".$_SESSION['user']."'";
              }

              $sql = mysqli_query($koneksi, $query);
              $data = mysqli_fetch_all($sql, MYSQLI_ASSOC);
              foreach($data as $data){
                $username = $data['username'];
                // var_dump($data);
            ?>
          <tr>
            <td><?= ++$i ?></td>
            <td><?= $data['nama']; ?></td>
            <!-- <td><?php //$data['keterangan']; ?></td> -->
            <td><?= $data['tanggal']; ?></td>
            <td><?= $data['jam_lembur'] ?></td>
            <td><?= $data['istirahat'] ?></td>
            <td><?= $data['total_lembur'] ?></td>
            <td><?= $data['uang_makan'] ?></td>
            <td>
              <form method="POST" action="">
              <a href="det_honor1.php?username=<?php echo $username?>" class="btn btn-primary btn-sm">Detail</a>
            </form>
            </td>
          </tr>
          <?php 
              }
            ?>
        </tbody>
              </table>
            </div>
        </div>

    </div>
    
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <?php include 'template/footer.php'; ?>
    
</body>

</html>