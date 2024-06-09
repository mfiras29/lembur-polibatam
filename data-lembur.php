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
      <h3><i class="fas fa-table mr-2"></i>Data Lembur</h3>
      <hr>
      <?php if($_SESSION['role'] == 'Kepala Unit'){?>
      <a href="form-tambah-lembur.php" class="btn btn-info btn-sm active mb-2"> <i class="fas fa-plus-circle mr-2"></i>Add Data Lembur</a>
      <?php } ?>
      <div class="table-responsive">
      <table class="table table-striped table-bordered" id="dataTable">
        <thead>
          <tr>
            <th scope="col">No</th>
            <th scope="col">NIK</th>
            <th scope="col">Nama</th>     
            <th scope="col">Jurusan</th>
            <th scope="col">Bagian</th>
            <th scope="col">Tanggal</th>
            <th scope="col">Jam Mulai</th>
            <th scope="col">Jam Selesai</th>
            <th scope="col">Kegiatan</th>
            <?php if($_SESSION['role'] == 'Kepala Unit'){?>
            <th scope="col">Aksi</th>
            <?php }?>
          </tr>
        </thead>
        <tbody>
          <?php

              if($_SESSION['role'] == "Karyawan"){
                $query = "SELECT * FROM form_lembur join user on form_lembur.username = user.username INNER JOIN unit as un on user.unit=un.id_unit where form_lembur.username = '".$_SESSION['user']."'";

              }else{
                $query = "SELECT * FROM form_lembur as fl join user as u on fl.username = u.username INNER JOIN unit as un on u.unit = un.id_unit where jurusan='".$_SESSION['jurusan']."'";
              }

              $i = 0;
              $sql = mysqli_query($koneksi, $query);
              while($data = mysqli_fetch_array($sql)) {
                $timestart = getTime($data['jam_mulai']);
                $timeend = getTime($data['jam_selesai']);
            ?>
          <tr>
            <td><?= ++$i ?></td>
            
            <td><?php echo $data['NIK']; ?></td>
            <td><?php echo $data['nama']; ?></td>
            <td><?php echo $data['jurusan']; ?></td>
            <td><?php echo $data['nama_unit']; ?></td>
            <td><?php echo $data['tanggal']; ?></td>
            <td><?php echo $timestart; ?></td>
            <td><?php echo $timeend; ?></td>
            <td><?php echo $data['keterangan']; ?></td>
            <?php if($_SESSION['role'] == 'Kepala Unit'){?>
              <td>
              <a class="fas fa-edit bg-success p-1 text-white rounded" href="ubah_lembur.php?id=<?php echo $data['id_form_lembur']; ?>"></a>
              <a class="fas fa-trash-alt bg-danger p-1 text-white rounded" onclick="deleteData('hapus_lembur.php?id=<?php echo $data['id_form_lembur']; ?>')"></a></td>
              <?php } else if($_SESSION['role'] == 'Kepala Unit'){?>
              <td>
              <a class="fas fa-edit bg-success p-1 text-white rounded" href="ubah_lembur.php?id=<?php echo $data['id_form_lembur']; ?>"></a>
              <a class="fas fa-trash-alt bg-danger p-1 text-white rounded" onclick="deleteData('hapus_lembur.php?id=<?php echo $data['id_form_lembur']; ?>')"></a></td>
              <?php } ?>
          </tr>
          <?php 
              }
              function getTime($time){
                $piece = explode(" ",$time);
                return $piece[1];
              }
            ?>
        </tbody>
      </table>
    </div>

  </div>

  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <?php include "template/footer.php"; ?>
</body>

</html>