<?php
// session_start();
include 'koneksi.php';
include 'template/header.php';?>
<body>
  <?php include 'template/sidebar.php'; ?>
    <div class="col-md-10 p-5 pt-2">
		<?php
	if (isset($_SESSION['user'])) {
		$username = $_SESSION['user'];
		$sql = "SELECT*FROM user WHERE username='$username'";
	    $query = $koneksi->query($sql);
		$get_user=$query->fetch_assoc();
		$name = $get_user['nama'];
		$id_user = $get_user['username'];

		echo "<h1 class='page-header'>Welcome, $name</h1>";
		
			if ($koneksi->query("SELECT* FROM data_absen")->num_rows!==0) {
				$no=0;
				$jurusan =  $_SESSION['jurusan'];
			 	$query_month=$koneksi->query("SELECT*,b.nama_bln,
				 SUBSTRING_INDEX(SUBSTRING_INDEX(tanggal, '-', 2), '-', -1) AS bulan FROM form_lembur AS fl INNER JOIN bulan as b on b.id_bln = SUBSTRING_INDEX(SUBSTRING_INDEX(tanggal, '-', 2), '-', -1) INNER JOIN  data_absen as da on da.id_form_lembur = fl.id_form_lembur INNER JOIN user on fl.username = user.username WHERE user.jurusan ='$jurusan' GROUP BY id_bln ORDER BY bulan ASC");
			 	while ($get_month=$query_month->fetch_assoc()) {
			      $month=$get_month['nama_bln'];
			      $id_month=$get_month['bulan'];
			      $jurusan =  $_SESSION['jurusan'];
			      $query_absen=$koneksi->query("SELECT*, SUBSTRING_INDEX(SUBSTRING_INDEX(tanggal, '-', 2), '-', -1) AS bulan FROM form_lembur AS fl INNER JOIN data_absen as da on da.id_form_lembur = fl.id_form_lembur INNER JOIN user on fl.username = user.username WHERE user.jurusan ='$jurusan' AND SUBSTRING_INDEX(SUBSTRING_INDEX(tanggal, '-', 2), '-', -1) = $id_month ");
			      
			      $cek = $query_absen->num_rows;
		
			      if ($cek!==0) {
			        echo "<h3 class='sub-header'>Absensi - $month </h3>";
			        echo "<div class='table-responsive'>
			           <table class='table table-striped'>
			            <thead>
			               <tr>
			                <th>No</th>
							<th>Nama Karyawan </th>
			                <th>Tanggal</th>
			                <th>Jam Masuk</th>
			                
			                <th>Jam Keluar</th>
			                
			               </tr>
			            </thead>
			            <tbody>";
			          $no=0;
			          while ($get_absen=$query_absen->fetch_assoc()) {
			            $no++;
			            $date = "$get_absen[tanggal]";
			            $time_in = "$get_absen[jam_mulai]";
			             if ($get_absen['absen_jam_keluar']==="") {
			             	$time_out = "<strong>Belum Absen</strong>";
			             } else {
			             	$time_out = "$get_absen[absen_jam_keluar]";
			             }
			            $st_in = $get_absen['jam_mulai'];
			            $st_out = $get_absen['absen_jam_keluar'];
			            echo "<tr>
			                <td>$no</td>
							<td>$get_absen[nama]</td>
			                <td>$date</td>
			                <td>$time_in</td>
			                
			                <td>$time_out</td>
			                
			              </tr>";
			          }
			          echo "</table></div>";
			      	}
				}
			$koneksi->close();
			} else {
				echo "<div class='alert alert-warning'><strong>Tidak ada Absensi untuk ditampilkan.</strong></div>";
			}
	} else {
		$username = $_SESSION['user'];
	    $id_siswa = mysqli_real_escape_string($koneksi, $username);
		$query = $koneksi->query("SELECT*FROM  user WHERE username='$username'");
		$get_user=$query->fetch_assoc();
		$name = $get_user['name_user'];
		$id_user = $get_user['id_user'];
			if ($koneksi->query("SELECT*FROM data_absen WHERE username='$username'")->num_rows!==0) {
				$no=0;
			 	$query_month=$koneksi->query("SELECT*FROM bulan ORDER BY id_bln ASC");
			 	while ($get_month=$query_month->fetch_assoc()) {
			      $month = $get_month['nama_bln'];
			      $year = date("Y");
			      $id_month=$get_month['id_bln'];
			      
			      $query_absen=$koneksi->query("SELECT*FROM form_lembur AS fl INNER JOIN data_absen as da on da.id_form_lembur = fl.id_form_lembur INNER JOIN user on fl.username = user.username WHERE id_user='$id_user'");
			      
			      $cek = $query_absen->num_rows;
			      if ($cek!==0) {
			        echo "<h4 class='sub-header'><strong>Absensi:</strong> $name<br><strong>Bulan:</strong> $month $year </h4>";
			        echo "<div class='table-responsive'>
			           <table class='table table-striped'>
			            <thead>
			               <tr>
			                <th>No</th>
			                <th>Hari, Tanggal</th>
			                <th>Jam Masuk</th>
			                <th>Status</th>
			                <th>Jam Keluar</th>
			                <th>Status</th>
			               </tr>
			            </thead>
			            <tbody>";
			          $no=0;
			          while ($get_absen=$query_absen->fetch_assoc()) {
			            $no++;
			            $date = "$get_absen[tanggal]";
			            $time_in = "$get_absen[jam_mulai]";
			             if ($get_absen['absen_jam_keluar']==="") {
			             	$time_out = "<strong>Belum Absen</strong>";
			             } else {
			             	$time_out = "$get_absen[jam_klr]";
			             }
			            $st_in = "$get_absen[jam_mulai]";
			            $st_out = "$get_absen[absen_jam_keluar]";
			            echo "<tr>
			                <td>$no</td>
			                <td>$date</td>
			                <td>$time_in</td>
			                <td><strong>$st_in</strong></td>
			                <td>$time_out</td>
			                <td><strong>$st_out</strong></td>
			              </tr>";
			          }
			          echo "</table></div>";
			      	}
				}
				$koneksi->close();
			} else {
				echo "<div class='alert alert-warning'><strong>Tidak ada Absensi untuk ditampilkan.</strong></div>";
			}
	}
	include 'template/footer.php';
?>
</body>