<?php 
require "fpdf/fpdf.php";//berdasarkan library FPDF
//$db = new PDO('mysql:host=localhost:3307;dbname=wisata','root','');//menentukan database yang ingin dicetak
$nama = $_POST['nama'];
$id = $_POST['id'];
$hp = $_POST['hp'];
$tempat = $_POST['tempat'];
$tanggal = $_POST['tgl'];
$dewasa = $_POST['dewasa'];
$anak = $_POST['anak'];

session_start();
error_reporting(0);
$harga = $_SESSION['hrg'];
$total = $_SESSION['tot'];


include 'koneksi.php';//MENGACU File database phpmyadmin
if (isset($_POST['psn']) && is_numeric($_POST['hp']) && is_numeric($_POST['id'])  && is_numeric($_POST['dewasa'])  
&& is_numeric($_POST['anak']) && !empty($_POST['nama'] )&& $_POST['tempat'] != '-- pilih --' &&  strtotime($_POST['tgl']) )
    {
    mysqli_query($koneksi, "insert INTO pemesanan set
    nama_pemesan  = '$_POST[nama]',
    nik = '$_POST[id]',
    no_hp = '$_POST[hp]', 
    tempat_wisata = '$_POST[tempat]', 
    tanggal = '$_POST[tgl]',
    pengunjung_dewasa = '$_POST[dewasa]', 
    pengunjung_anak = '$_POST[anak]', 
    harga = '$harga', 
    total_bayar = '$total'");//untuk menyimpan data ke database

    class myPDF extends FPDF{//Membuat class berdasarkan library
        function header(){//dari librarynya
            $this->SetFont('Arial','B',14);
            $this->Cell(190,5,'DATA PEMESANAN STAR TRAVELLER',0,0,'C');
            $this->Ln();
            $this->SetFont('Times','',12);
            $this->Cell(190,10,'jl. kobak jaya RT02/RW17 ',0,0,'C');
            $this->Ln();
        }
        function headerViewer($total){
            $this->SetFont('Times','B',9);
            $this->Cell(95,10,'nama pemesan',1,0,'C');
            $this->Cell(95,10,$_POST['nama'],1,0,'C');
            $this->Ln();
            $this->Cell(95,10,'nik',1,0,'C');
            $this->Cell(95,10,$_POST['id'],1,0,'C');
            $this->Ln();
            $this->Cell(95,10,'no hp',1,0,'C');
            $this->Cell(95,10,$_POST['hp'],1,0,'C');
            $this->Ln();
            $this->Cell(95,10,'tempat wisata',1,0,'C');
            $this->Cell(95,10,$_POST['tempat'],1,0,'C');
            $this->Ln();
            $this->Cell(95,10,'tanggal',1,0,'C');
            $this->Cell(95,10,$_POST['tgl'],1,0,'C');
            $this->Ln();
            $this->Cell(95,10,'pengunjung dewasa',1,0,'C');
            $this->Cell(95,10,$_POST['dewasa'],1,0,'C');
            $this->Ln();
            $this->Cell(95,10,'pengunjung anak',1,0,'C');
            $this->Cell(95,10,$_POST['anak'],1,0,'C');
            $this->Ln();
            $this->Cell(95,10,'harga',1,0,'C');
            $this->Cell(95,10,$_SESSION['hrg'],1,0,'C');
            $this->Ln();
            $this->Cell(95,10,'total bayar',1,0,'C');
            $this->Cell(95,10,$total,1,0,'C');
            $this->Ln();
        }
    
    }
    $pdf = new myPDF();
    $pdf->AliasNbPages();
    //menggunakan fungsi dari class
    $pdf->AddPage('P','A4',0);
    $pdf->headerViewer($total);//memanggil Header dari tabel
    $pdf->SetFont('courier','',9);
    //non fungsi
    $pdf->Output();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css"/>
  <title>kembali</title>
</head>
<body>
<center>
<H5>BELUM INPUT FORM!</H5>
<a href="wisata.php"><button class="btn btn-primary">KEMBALI</button></a>
<script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
</center>
</body>
</html>