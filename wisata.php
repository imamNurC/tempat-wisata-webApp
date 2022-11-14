<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css"/>
  <title>Assesmen Wisata</title>
  </head>


  <body class="text-bg-dark p-3">
  <div class="container" align="" >
  <h2>FORM PEMESANAN</h2>
  <hr>
  <form method="POST" action=""  id="form"></p>
  <label for="nama"></label>
  Nama Lengkap : <input type='text' name='nama' id="nama" style="margin-left: 55px;"></p>
  <label for="id"></label>
  Nomor Identitas : <input type='number' min="1000000000000000" max="9999999999999999" name='id' id="id"  style="margin-left: 45px;"></p>
  <label for="hp"></label>
  No. Hp : <input type='number' name='hp' id="hp" style="margin-left: 110px;"></p>
  <label for="tempat"></label>
  Tempat wisata :   <select name="tempat" class="form-select-sm" id="tempat" style="margin-left: 60px;">
  <option align="center">-- pilih --</option>";

    <?php
    $tempat_wisata = array(
      "Taman Safari" => 'https://www.youtube.com/embed/qgrYVyUnQOY',
      "Pantai Ancol" => 'https://www.youtube.com/embed/9QoALTRd4N4',
      "Candi Borobudur" => 'https://www.youtube.com/embed/wiXpz2_csUc'
    );

    $tempatWisata = array_keys($tempat_wisata);//menjadikan sort pada key nya
    sort($tempatWisata);//mensortir arraynya
    
    for ($i = 0; $i < count($tempatWisata); $i++){
         echo"<option> $tempatWisata[$i] </option>";
        
    }
    echo "</select></p>";    

    ?>
  <label for="tgl"></label>
  Tanggal Kunjungan : <input type='date' name='tgl' id="tgl" style="margin-left: 25px;"></p>
  <label for="dewasa"></label>
  Pengunjung Dewasa : <input type='number' name='dewasa' id="dewasa" style="margin-left: 15px;"></p>
  <label for="dewasa"></label>
  Pengunjung Anak : <input type='number' name='anak' id="anak" style="margin-left: 35px;"></p>
  <input type="checkbox" id="check" name="check" value="">
  <label for="check"> Saya dan/atau rombongan telah membaca, memahami, dan setuju berdasarkan syarat dan ketentuan yang 
	telah ditetapkan</label>
   <p><p><p> 
  <button class="btn btn-primary" type="submit" name="cek" value="cek" >Hitung Total Bayar</button>
  <button class="btn btn-primary"  name="psn" name value="psn" formaction="pdf.php">Pesan Tiket</button>
  <button class="btn btn-primary" onclick="reset_form()">Cancel</button>
    
   </form>
  </div>
  <hr>
  <div class="container">
    <table align="center" class="table table-striped table-dark table-hover">
    <h3>Hasil pengecekkan :</h3>

    <?php    
      if ( isset($_POST['cek']) && isset($_POST['check']) && is_numeric($_POST['hp']) && is_numeric($_POST['id'])  && is_numeric($_POST['dewasa'])  
      && is_numeric($_POST['anak']) && !empty($_POST['nama'] )
      && $_POST['tempat'] != '-- pilih --' &&  strtotime($_POST['tgl']) )//mengacu form submit
      {
      session_start();  
      function url($tempatWisata,$tempat)//Menentukan fungsi untuk mencocokan pilihan tempat dengan gambar yang akan ditampilkan
      {  
        global $harga;
        global $url;
         
        $subject = array_keys($tempatWisata);//menentukan array keys nya untuk array $tempat_wisata
        $hrg = [10000, 20000, 30000];
        foreach($subject as $i => $namaWisata ) {
          if ($tempat == $namaWisata){
            $harga = $hrg[$i];
            $url = $tempatWisata[$subject[$i]];
            return $_SESSION['hrg'] = $harga;
            return $url;// url wisata dari tempat
          }
        }
      }

      function totalBayar($anak,$harga,$dewasa)
      {
          global $total;
          $total = (($anak*$harga)*0.5) +($dewasa*$harga);
          return $_SESSION['tot'] = $total;
      }
      
        // data dari form kesini dulu
        $nama = $_POST['nama'];
        $id = $_POST['id'];
        $hp = $_POST['hp'];
        $tempat = $_POST['tempat'];
        $tanggal = $_POST['tgl'];
        $dewasa = $_POST['dewasa'];
        $anak = $_POST['anak'];

       
        echo "<pre>";
        echo "Nama Lengkap  	      	: $nama <br>";
        echo "Nomor Identitas		: $id <br>";
        echo "No. Hp 	      		: $hp <br>";
        echo "Tempat wisata   	: $tempat <br>";
        echo "Tanggal Kunjungan	: $tanggal <br>";
        echo "Pengunjung dewasa	: $dewasa <br>";
        echo "Pengunjung Anak		: $anak<br>";
        url($tempat_wisata,$tempat);//mereturn $harga dari array $hrg  fungsi sekaligus mengembalikan $url nya
        echo "Harga Tiket		: " .number_format($harga);      
        echo "<br>";
        echo "======================================<br>";
        //mereturn total
        echo "Total Bayar  : "."Rp.".number_format(totalBayar($anak,$harga,$dewasa));//memanggil fungsi totalbayar dan ngitung total
        echo "<br>";
        echo "======================================<br>";
        echo "</pre>";
        
  
      } else {
        echo "tombol belum di cek dan jumlah belum dipilih<br>";
      }
      
    ?>
    </table>
    <iframe src="<?php echo $url; ?>" width="420" height="315" ></iframe>
    </div>
    
    
    <!-- Bootstrap JavaScript -->
    <script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
    </body>

</html