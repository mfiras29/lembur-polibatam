<?php 
  include 'koneksi.php';
  include 'cek_status_login.php';
  include 'kepalaUnitFilter.php';
?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="lembur.css">
    <link rel="stylesheet" type="text/css" href="fontawesome/css/all.min.css">
    <title>Tambah Lembur</title>
</head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        
<body>
    <?php include 'template/sidebar.php'; ?>
        <div class="col-md-10 p-5 pt-2">
            <h3><i class="fas fa-users mr-2"></i> Input Data Baru</h3>
            <hr>
            <form action="simpan_lembur.php" method="post">

            <div class="form-group">
                <label for="nama">Pilih NIK</label>
                <select class="form-control" id="nama"  onchange="jsFunction(this)">
                <?php
                        if($_SESSION['role'] == 'Bagian Keuangan'){
                            $query = "SELECT username, nama, jurusan, unit FROM user";
                        }else{
                            $query = "SELECT u.username, u.nama, u.NIK,u.jurusan, u.unit ,j.id_kategori, u.rekening,u.telp FROM user as u INNER JOIN jabatan as j on j.id_jabatan = u.jabatan where u.jurusan = '".$_SESSION['jurusan']."'";
                        }
                        $sql = mysqli_query($koneksi, $query);
                        while($data = mysqli_fetch_array($sql)) {?>
                        <option data="test" value="<?= $data['username'] ?> <?= $data['telp'] ?> <?= $data['unit'] ?> <?= $data['id_kategori'] ?> <?= $data['rekening'] ?>"><?= $data['NIK']?></option>
                        
                        <?php } ?>
                    </select>
                    <input  type="hidden" id="myNik" name ="username"  value="">
            </div>
            <div id="createLabel"></div>
            <div id="createTextbox"></div>
            <div id="createLabel2"></div>
            <div id="createTextbox2"></div>
            <div id="createLabel3"></div>
            <div id="createTextbox3"></div>
            <div id="createLabel4"></div>
            <div id="createTextbox4"></div>
            <div id="createLabel5"></div>
            <div id="createTextbox5"></div>
                
                <div class="form-row">
                    <div class="form-group col-md-3">
                        <label>Tanggal</label>
                        <input type="date" name="tanggal" class="form-control" id="tanggal">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-3">
                        <label>Jam Mulai</label>
                        <input type="time" name="jam_mulai" class="form-control" id="jam_mulai">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label>Jam Selesai</label>
                        <input type="time" name="jam_selesai" class="form-control" id="jam_selesai">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label>Kegiatan</label>
                        <input type="text" name="keterangan" class="form-control" id="keterangan">
                    </div>
                </div>
                
                <button type="submit" class="btn btn-primary">SIMPAN</button>
            </form>
        </div>
    </div>
</body>
<script>
    let a =0;
            $(document).ready(function(){
            $('#nama').change(function(){
                //Selected value
                
                var inputValue = $(this).val().split(" ");
                if(a>0){
        document.getElementById("myText").value = inputValue[0];
        document.getElementById("myText2").value = inputValue[1];
        document.getElementById("myText3").value = inputValue[2];
        document.getElementById("myText4").value = inputValue[3];
        document.getElementById("myText5").value = inputValue[4];

        document.getElementById("myNik").value = inputValue[0];
    }
    if(a<1){
       
                    
        createLabel.innerHTML = createLabel.innerHTML +`<br><label for="html">Nama</label>`;
        createTextbox.innerHTML = createTextbox.innerHTML +`<input type='text' id='myText' value=${inputValue[0]} disabled >`;

        createLabel2.innerHTML = createLabel2.innerHTML +`<br><label for="html">Telpon</label>`;
        createTextbox2.innerHTML = createTextbox2.innerHTML +`<input type='text' id='myText2' value=${inputValue[1]} disabled >`;

        createLabel3.innerHTML = createLabel3.innerHTML +`<br><label for="html">Bagian</label>`;
        createTextbox3.innerHTML = createTextbox3.innerHTML +`<input type='text' id='myText3' value=${inputValue[2]} disabled >`;

        createLabel4.innerHTML = createLabel4.innerHTML +`<br><label for="html">Kategori</label>`;
        createTextbox4.innerHTML = createTextbox4.innerHTML +`<input type='text' id='myText4' value=${inputValue[3]} disabled >`;

        createLabel5.innerHTML = createLabel5.innerHTML +`<br><label for="html">Rekening</label>`;
        createTextbox5.innerHTML = createTextbox5.innerHTML +`<input type='text' id='myText5' value=${inputValue[4]} disabled >`;
        a++;
        document.getElementById("myNik").value = inputValue[0];
        }
                alert("value in js "+inputValue);

                // Ajax for calling php function
                // $.post('simpan_lembur.php', { dropdownValue: inputValue }, function(data){
                //     alert('ajax completed. Response:  '+data);
                //     //do after submission operation in DOM
                // });
            });
        });
        </script>
<!-- <script>
    let a= 0
    function jsFunction(select)
    {
    //   alert(select.options[select.selectedIndex].value);
    if(a>0){
        document.getElementById("myText").value = select.options[select.selectedIndex].value;
    }
    if(a<1){
       
                    
        createLabel.innerHTML = createLabel.innerHTML +`<br><label for="html">Nama</label>`;
        createTextbox.innerHTML = createTextbox.innerHTML +`<input type='text' id='myText' value=${select.options[select.selectedIndex].value} disabled >`;

        createLabel2.innerHTML = createLabel2.innerHTML +`<br><label for="html">NIK</label>`;
        createTextbox2.innerHTML = createTextbox2.innerHTML +`<input type='text' id='myText' value=${document.getElementById("myNik").value } disabled >`;
        a++;
        }
    }
    
    
</script> -->

</html>