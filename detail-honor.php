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
                        <th scope="col">No</th>
                        <!-- <th scope="col">Nama</th> -->
                        <th scope="col">Kategori</th>
                        <th scope="col">Tarif</th>
                        <th scope="col">Tanggal</th>
                        <th scope="col">Jmlh Jam</th>
                        <th scope="col">Total Lembur</th>
                        <th scope="col">Uang Makan</th>
                        <th scope="col">Total Uang Lembur+Makan</th>
                        <th scope="col">PPh Pasal21</th>
                        <th scope="col">Total Honor Setelah Pajak</th>
                        <th scope="col">No.Rekening</th>
                    </tr>
                </thead>
                <tbody>
          <?php
          if(isset($_GET['username'])){
            $username = $_GET['username'];
            $month = $_GET['month'];
          }
            if($_SESSION['role'] == "Keuangan"){ 
                $query = "SELECT u.*,k.*,j.id_kategori,fl.id_form_lembur,fl.username,fl.tanggal, fl.jam_mulai, fl.jam_selesai, TIMESTAMPDIFF(HOUR, jam_mulai, jam_selesai) as `jam_lembur`,IF(TIMESTAMPDIFF(HOUR, jam_mulai, jam_selesai) > 3,TIMESTAMPDIFF(HOUR, jam_mulai, jam_selesai) -1,TIMESTAMPDIFF(HOUR, jam_mulai, jam_selesai)) as `total_lembur`,IF(TIMESTAMPDIFF(HOUR, jam_mulai, jam_selesai) > 3,1,0) as `istirahat`,IF(TIMESTAMPDIFF(HOUR, jam_mulai, jam_selesai) > 3,TIMESTAMPDIFF(HOUR, jam_mulai, jam_selesai) -1,TIMESTAMPDIFF(HOUR, jam_mulai, jam_selesai)) as `total_lembur`,IF(TIMESTAMPDIFF(HOUR, jam_mulai, jam_selesai) > 3,30000,0) as `uang_makan`,(tarif*TIMESTAMPDIFF(HOUR, jam_mulai, jam_selesai)) as `penghasilan` FROM form_lembur as fl INNER JOIN user as u ON fl.username = u.username INNER JOIN jabatan as j on u.jabatan = j.id_jabatan INNER JOIN kategori as k on j.id_kategori = k.id_kategori  where u.jurusan = '".$_SESSION['jurusan']."' AND fl.username = '$username'";
            }else if($_SESSION['role'] == "Kepala Unit"){
                $query = "SELECT u.*,k.*,j.id_kategori,fl.id_form_lembur,fl.username,fl.tanggal, fl.jam_mulai, fl.jam_selesai, TIMESTAMPDIFF(HOUR, jam_mulai, jam_selesai) as `jam_lembur`,IF(TIMESTAMPDIFF(HOUR, jam_mulai, jam_selesai) > 3,TIMESTAMPDIFF(HOUR, jam_mulai, jam_selesai) -1,TIMESTAMPDIFF(HOUR, jam_mulai, jam_selesai)) as `total_lembur`,IF(TIMESTAMPDIFF(HOUR, jam_mulai, jam_selesai) > 3,1,0) as `istirahat`,IF(TIMESTAMPDIFF(HOUR, jam_mulai, jam_selesai) > 3,TIMESTAMPDIFF(HOUR, jam_mulai, jam_selesai) -1,TIMESTAMPDIFF(HOUR, jam_mulai, jam_selesai)) as `total_lembur`,IF(TIMESTAMPDIFF(HOUR, jam_mulai, jam_selesai) > 3,30000,0) as `uang_makan`,(tarif*TIMESTAMPDIFF(HOUR, jam_mulai, jam_selesai)) as `penghasilan` FROM form_lembur as fl INNER JOIN user as u ON fl.username = u.username INNER JOIN jabatan as j on u.jabatan = j.id_jabatan INNER JOIN kategori as k on j.id_kategori = k.id_kategori  where u.jurusan = '".$_SESSION['jurusan']."' AND u.username ='$username'  AND (SUBSTRING_INDEX(SUBSTRING_INDEX(fl.tanggal,'-',2),'-',-1) = '$month')";
                // $query = "SELECT nama, kategori, tarif, tanggal, sum(jam_lembur) as jam_lembur, sum(uang_makan) as uang_makan, rekening FROM honor JOIN form_lembur on honor.id = form_lembur.id JOIN user on user.username = form_lembur.username join kategori on kategori.id_kategori = user.kategori where user.jurusan = '".$_SESSION['jurusan']."' group by form_lembur.username, MONTH(tanggal), YEAR(tanggal)";
            }else{
                $query = "SELECT u.*,k.*,j.id_kategori,fl.id_form_lembur,fl.username,fl.tanggal, fl.jam_mulai, fl.jam_selesai, TIMESTAMPDIFF(HOUR, jam_mulai, jam_selesai) as `jam_lembur`,IF(TIMESTAMPDIFF(HOUR, jam_mulai, jam_selesai) > 3,TIMESTAMPDIFF(HOUR, jam_mulai, jam_selesai) -1,TIMESTAMPDIFF(HOUR, jam_mulai, jam_selesai)) as `total_lembur`,IF(TIMESTAMPDIFF(HOUR, jam_mulai, jam_selesai) > 3,1,0) as `istirahat`,IF(TIMESTAMPDIFF(HOUR, jam_mulai, jam_selesai) > 3,TIMESTAMPDIFF(HOUR, jam_mulai, jam_selesai) -1,TIMESTAMPDIFF(HOUR, jam_mulai, jam_selesai)) as `total_lembur`,IF(TIMESTAMPDIFF(HOUR, jam_mulai, jam_selesai) > 3,30000,0) as `uang_makan`,(tarif*TIMESTAMPDIFF(HOUR, jam_mulai, jam_selesai)) as `penghasilan` FROM form_lembur as fl INNER JOIN user as u ON fl.username = u.username INNER JOIN jabatan as j on u.jabatan = j.id_jabatan INNER JOIN kategori as k on j.id_kategori = k.id_kategori  where u.jurusan = '".$_SESSION['jurusan']."' AND u.username ='$username'  AND (SUBSTRING_INDEX(SUBSTRING_INDEX(fl.tanggal,'-',2),'-',-1) = '$month')";
                // $query = "SELECT u.*,k.*,j.id_kategori,fl.id_form_lembur,fl.username,fl.tanggal, fl.jam_mulai, fl.jam_selesai, TIMESTAMPDIFF(HOUR, jam_mulai, jam_selesai) as `jam_lembur`,IF(TIMESTAMPDIFF(HOUR, jam_mulai, jam_selesai) > 3,TIMESTAMPDIFF(HOUR, jam_mulai, jam_selesai) -1,TIMESTAMPDIFF(HOUR, jam_mulai, jam_selesai)) as `total_lembur`,IF(TIMESTAMPDIFF(HOUR, jam_mulai, jam_selesai) > 3,1,0) as `istirahat`,IF(TIMESTAMPDIFF(HOUR, jam_mulai, jam_selesai) > 3,TIMESTAMPDIFF(HOUR, jam_mulai, jam_selesai) -1,TIMESTAMPDIFF(HOUR, jam_mulai, jam_selesai)) as `total_lembur`,IF(TIMESTAMPDIFF(HOUR, jam_mulai, jam_selesai) > 3,30000,0) as `uang_makan`,(tarif*TIMESTAMPDIFF(HOUR, jam_mulai, jam_selesai)) as `penghasilan` FROM form_lembur as fl INNER JOIN user as u ON fl.username = u.username INNER JOIN jabatan as j on u.jabatan = j.id_jabatan INNER JOIN kategori as k on j.id_kategori = k.id_kategori where form_lembur.username = '".$_SESSION['user']."'";
            }
            
            $sql = mysqli_query($koneksi, $query);
            $i = 0; 
            $row = mysqli_num_rows($sql);
            $j = 1;
            $total = 0;
            for($j ; $j <= $row; $j++) {
                  $data = mysqli_fetch_array($sql);
                //   var_dump($data);
                  $total_uang_lembur = $data['total_lembur'] * $data['tarif'];
                  $total_uang_lembur_makan = $total_uang_lembur + $data['uang_makan'];
                  $uang_pph = round($total_uang_lembur_makan * 0.05);
                  $total += ($total_uang_lembur_makan - $uang_pph);
                ?>
            
            <tr>
                <td><?= ++$i; ?></td>
                
                <td><?= $data['id_kategori']; ?></td>
                <td><?= $data['tarif']; ?></td>
                <td><?= date("d-m-Y", strtotime($data['tanggal'])); ?></td>
                <td><?= $data['jam_lembur'] ?></td>
                <td><?= $data['total_lembur'] ?></td>
                <td><?= $data['uang_makan'] ?></td>
                <td><?= $total_uang_lembur_makan ?></td>
                <td><?= $uang_pph ?></td>
                <td><?= $total_uang_lembur_makan - $uang_pph ?></td>
                <td><?= $data['rekening'] ?></td>
            </tr>
            <?php if($j == $row){?>
                <tr>
                <td>Total</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td><?php echo $total?> </td>
                </tr>

            <?php }?>
          <?php 
        }
            ?>
        </tbody>
         
            <?php if ($_SESSION['role'] == 'Bagian Keuangan'){?>
                
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#cetakPdfModal">
                <i class="fas fa mr-2"></i>Cetak PDF</a>
                </button>

                <!-- Modal -->
                <div class="modal fade" id="cetakPdfModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Download Detail Honor</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                    <form action="mpdf.php" method="post">
                        <div class="form-row">
                            <div class="form-group">
                                <label for="exampleFormControlSelect1">Pilih Unit</label>
                                <select class="form-control" id="unit" name="unit">
                                <?php
                                    $sql = mysqli_query($koneksi, "SELECT * FROM unit");
                                    while($data = mysqli_fetch_array($sql)) {?>
                                    <option value="<?= $data['nama_unit'] ?>"><?= $data['nama_unit']?></option>
                                <?php } ?>
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Bulan</label>
                                <input type="month" name="bulan" class="form-control" id="bulan">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-primary">Download Data</button>
                        </div>
                    </form>
                    </div>
                </div>
                </div>
            <?php } ?>
        </div>
        
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <?php include 'template/footer.php'; ?>
</body>

</html>