<?php 
include 'koneksi.php';
echo $_SESSION['jurusan'];
$query = "SELECT u.*,j.id_kategori,fl.id_form_lembur,fl.username,fl.tanggal, fl.jam_mulai, fl.jam_selesai, TIMESTAMPDIFF(HOUR, jam_mulai, jam_selesai) as `jam_lembur`,IF(TIMESTAMPDIFF(HOUR, jam_mulai, jam_selesai) > 3,TIMESTAMPDIFF(HOUR, jam_mulai, jam_selesai) -1,TIMESTAMPDIFF(HOUR, jam_mulai, jam_selesai)) as `total_lembur`,IF(TIMESTAMPDIFF(HOUR, jam_mulai, jam_selesai) > 3,1,0) as `istirahat`,IF(TIMESTAMPDIFF(HOUR, jam_mulai, jam_selesai) > 3,TIMESTAMPDIFF(HOUR, jam_mulai, jam_selesai) -1,TIMESTAMPDIFF(HOUR, jam_mulai, jam_selesai)) as `total_lembur`,IF(TIMESTAMPDIFF(HOUR, jam_mulai, jam_selesai) > 3,30000,0) as `uang_makan`,(tarif*TIMESTAMPDIFF(HOUR, jam_mulai, jam_selesai)) as `penghasilan` FROM form_lembur as fl INNER JOIN user as u ON fl.username = u.username INNER JOIN jabatan as j on u.jabatan = j.id_jabatan INNER JOIN kategori as k on j.id_kategori = k.id_kategori  where u.jurusan = '".$_SESSION['jurusan']."' GROUP BY fl.username";

              

              $sql = mysqli_query($koneksi, $query);
              $data = mysqli_fetch_all($sql);
              foreach($data as $row){
                var_dump($row);
            }
?>