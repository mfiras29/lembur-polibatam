<?php 
    include('koneksi.php');
    include 'cek_status_login.php';
    include 'kepalaUnitFilter.php';

    $NIK = $_POST['NIK'];
    $nama = $_POST['nama'];
    $jurusan = $_SESSION['jurusan'];
    $unit = $_POST['unit'];
    $telp = $_POST['telp'];
    $kategori = $_POST['kategori'];
    $rekening = $_POST['rekening'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $role = $_POST['role'];
    $jabatan = $_POST['jabatan'];
    // var_dump($_POST);
    $input = mysqli_query($koneksi,"INSERT INTO user (NIK,nama,jurusan,username,password,role_id,unit,telp,jabatan,rekening) VALUES('$NIK','$nama','$jurusan','$username','$password','$role','$unit','$telp','$jabatan','$rekening')") or die(mysqli_error($koneksi));
    if($input){
        echo "Data Berhasil Disimpan";
        header("location:data-karyawan.php"); 
    }else{
        echo "Gagal Disimpan";
    }   
?>