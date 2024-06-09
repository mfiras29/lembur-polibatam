<?php 
    include('koneksi.php');
    include 'cek_status_login.php';
    include 'kepalaUnitFilter.php';

    function timeToSecond($time){
        $parsed = date_parse($time);
        $seconds = $parsed['hour'] * 3600 + $parsed['minute'] * 60 + $parsed['second'];
        return $seconds;
    }

    function uangMakan($total_lembur){
        
        if($total_lembur <= 2){
            $uang_makan = 0;
          }else if($total_lembur > 5){
            $uang_makan = 30000;
          }else{
            $uang_makan = 25000;
          }

          return $uang_makan;
    }
    function convertHtmlTime($date,$time){
      $newDate = date($date);
      $newTime = date($time);
      $datetime = new DateTime($newDate.$newTime);
      return date_format($datetime, 'Y-m-d H:i:s');
}

    function hitungIstirahat($jam_lembur){
        if($jam_lembur <= 8){
            $istirahat = 0;
          }else if($jam_lembur > 16){
            $istirahat = 2;
          }else{
            $istirahat = 1;
          }
          return $istirahat;
    }

    $nama = $_POST['username'];
    $tanggal = $_POST['tanggal'];
    $jam_mulai = convertHtmlTime($tanggal,$_POST['jam_mulai']) ;
    $jam_selesai = convertHtmlTime($tanggal,$_POST['jam_selesai']) ;
    
    $keterangan = $_POST['keterangan'];
    echo "$nama";
    echo $tanggal;
    $queryCheck = "SELECT * from form_lembur WHERE username = '$nama' and tanggal = '$tanggal'";
    $check = mysqli_query($koneksi, $queryCheck);
    $countRow = mysqli_num_rows($check);

    //Jika telah ada data dengan username dan tanggal yang sama, maka data tidak akan masuk ke database
    if(!$countRow){

        $input = mysqli_query($koneksi,"INSERT INTO form_lembur (id_form_lembur,username, tanggal, jam_mulai, jam_selesai, keterangan) VALUES(NULL,'$nama','$tanggal','$jam_mulai','$jam_selesai','$keterangan')") or die(mysqli_error($koneksi));
        if($input){
          
          $getFormLembur = "SELECT id_form_lembur FROM form_lembur where username='$nama' and tanggal='$tanggal'";
          $executeQuery = mysqli_query($koneksi, $getFormLembur);
          while($data = mysqli_fetch_array($executeQuery)){
            $formLemburId = $data['id_form_lembur'];
          }
          
          $jam_lembur = number_format((timeToSecond($jam_selesai) - timeToSecond($jam_mulai)) / 3600, 2, '.', '');
          if($jam_lembur < 0){
            $today = 86400 - timeToSecond($jam_mulai);
            $tomorrow = timeToSecond($jam_selesai);
            $jam_lembur = number_format(($today + $tomorrow) / 3600, 2, '.', '');
          }

          $istirahat = hitungIstirahat($jam_lembur);
          $total_lembur = number_format($jam_lembur - $istirahat, 2, '.', '');
          $uangMakan = uangMakan($total_lembur);
          
          mysqli_query($koneksi, "INSERT INTO honor (id, jam_lembur, istirahat, total_lembur, uang_makan) values ($formLemburId, '$jam_lembur', '$istirahat', '$total_lembur', '$uangMakan')");
        }else{
            echo "Gagal Disimpan";
        }
        header("location:data-lembur.php");  
    }else{?>
        <script>
        alert("Nama dan tanggal yang sama telah terdaftar");
        window.location.href = "form-tambah-lembur.php";
        </script>
    <?php }       
?>