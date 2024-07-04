<?php
// memanggil library FPDF
require('library/fpdf.php');
 
// intance object dan memberikan pengaturan halaman PDF
$pdf=new FPDF('P','mm','A4');
$pdf->AddPage();
$pdf->SetFont('Times');
$pdf->Cell(80);
$pdf->Cell(0,0,'LAPORAN POLISI',0,1);
$pdf->Cell(65);
$pdf->Cell(0,10,'Nomor Lap/123ABCD/123ABCD',0,1);
$pdf->Cell(40,0,'',0,1);
$pdf->Cell(40);
$pdf->Cell(0,10,'Macam kejahatan : Lorem Ipsum',0,1);
$pdf->Cell(40);
$pdf->Cell(0,0,'Melanggar pasal : Lorem Ipsum',0,1);
$pdf->Cell(40,5,'',0,1);
$pdf->Cell(20);
$pdf->Cell(0,10,'Pada hari ini, Senin tanggal 08, sekira pukul 10:00, telah ',0,1);
$pdf->Cell(10);
$pdf->Cell(0,0,'datang melapor kepada saya :',0,1);
$pdf->Cell(40,5,'',0,1);
$pdf->SetFont('Times', 'U', 12);
$pdf->Cell(80);
$pdf->Cell(0,10,'Lorem Ipsum',0,1);
$pdf->Cell(40,5,'',0,1);
$pdf->Cell(10);
$pdf->SetFont('Times');
$pdf->Cell(0,10,'Pangkat Lorem Ipsum, NRP Lorem Ipsum jabatan Lorem Ipsum kesatuan Lorem Ipsum, seorang',0,1);
$pdf->Cell(10);
$pdf->Cell(0,0,'laki-laki/perempuan *) yang belum/sudah *) saya kenal, yang mengaku bernama:',0,1);
$pdf->Cell(40,5,'',0,1);
$pdf->SetFont('Times', 'U', 12);
$pdf->Cell(80);
$pdf->Cell(0,10,'Lorem Ipsum',0,1);
$pdf->Cell(40,5,'',0,1);
$pdf->SetFont('Times');
$pdf->Cell(10);
$pdf->Cell(0,5,'Umur 24 tahun, tempat & tanggal lahir Jakarta, 18 Agustus 1990, kewarganegaraan',0,1);
$pdf->Cell(10);
$pdf->Cell(0,5,'Indonesia pekerjaan Tentara pangkat/golongan Lorem Ipsum',0,1);
$pdf->Cell(10);
$pdf->Cell(0,5,'NRP/NIP 1234567890 jabatan Lorem Ipsum kesatuan Lorem Ipsum instansi Lorem Ipsum ',0,1);
$pdf->Cell(10);
$pdf->Cell(0,5,'alamat tempat tinggal Jl Kh Agus Salim No 18 yang pokok inti laporannya sebagai ',0,1);
$pdf->Cell(10);
$pdf->Cell(0,5,'berikut:',0,1);
$pdf->Cell(10);
$pdf->Cell(0,5,'................................................................................................................................................................',0,1);
$pdf->Cell(10);
$pdf->Cell(0,5,'................................................................................................................................................................',0,1);
$pdf->Cell(10);
$pdf->Cell(0,5,'................................................................................................................................................................',0,1);
$pdf->Cell(40,5,'',0,1);
$pdf->Cell(20);
$pdf->Cell(0,10,'Untuk bukti atas kebenaran laporan tersebut, pelapor membubuhkan tanda',0,1);
$pdf->Cell(10);
$pdf->Cell(0,0,'tangannya di bawah ini.',0,1);
$pdf->Cell(40,5,'',0,1);
$pdf->Cell(140);
$pdf->Cell(0,10,'Pelapor,',0,1);
$pdf->Cell(40,13,'',0,1);
$pdf->Cell(140);
$pdf->Cell(0,10,'Badrul',0,1);
$pdf->Cell(140);
$pdf->Cell(0,0,'Sersan Satu',0,1);
$pdf->Cell(40,5,'',0,1);
$pdf->Cell(20);
$pdf->Cell(0,5,'Demikian Laporan Polisi ini dibuat dengan sebenarnya dan atas kekuatan',0,1);
$pdf->Cell(10);
$pdf->Cell(0,5,'sumpah jabatan, kemudian ditutup dan ditandatangani pada hari, tanggal dan',0,1);
$pdf->Cell(10);
$pdf->Cell(0,5,'tempat tersebut di atas.',0,1);
$pdf->Cell(40,5,'',0,1);
$pdf->Cell(140);
$pdf->Cell(0,10,'Penerima Laporan,',0,1);
$pdf->Cell(40,13,'',0,1);
$pdf->Cell(140);
$pdf->Cell(0,10,'Badrul',0,1);
$pdf->Cell(140);
$pdf->Cell(0,0,'Sersan Satu',0,1);
$pdf->Cell(40,10,'',0,1);
$pdf->Cell(10);
$pdf->Cell(0,5,'Tercatat dalam Register Perkara Nomor: 1234567890. tanggal 08 Mei 2023',0,1);
$pdf->Output();
 
?>