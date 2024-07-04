<?php
// Assuming this PHP file is accessed using a GET request
require_once('koneksi.php');
$nik = $_GET['id'];
$sql = "SELECT * FROM recognition WHERE nik = $nik";
$row = $db->prepare($sql);
$row->execute();
$hasil = $row->fetch();
// Sample data (replace this with your own data retrieval logic)
if($hasil){
    $date= date_create($hasil['tgl_lahir']);
    $tanggal = date_format($date,"d-m-Y");
    $data = array(
        'status' => '200',
        'nik' => $hasil['nik'],
        'nama' => $hasil['nama'],
        'tempat_lahir' => $hasil['tempat_lahir'],
        'tgl_lahir' => $tanggal,
        'alamat' => $hasil['alamat'],
        'agama' => $hasil['agama'],
    );
}
else{
    $data = array(
        'status' => '400',
    );
}

echo json_encode($data);
// Set the response header to JSON
header('Content-Type: application/json');
?>
