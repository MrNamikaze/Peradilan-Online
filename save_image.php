<?php
require_once("koneksi.php");
// Get the image data from the POST request
$imageData = $_POST['imageData'];
$count = $_POST['count'];
$nama = isset($_POST["nama"] ) ? $_POST["nama"]: '';
$nik = isset($_POST["nik"] ) ? $_POST["nik"]: '';
$tempat_lahir = isset($_POST["tempat_lahir"] ) ? $_POST["tempat_lahir"]: '';
$tgl_lahir = isset($_POST["tgl_lahir"] ) ? $_POST["tgl_lahir"]: '';
$alamat = isset($_POST["alamat"] ) ? $_POST["alamat"]: '';
$agama = isset($_POST["agama"] ) ? $_POST["agama"]: '';

$sql = "SELECT * FROM recognition WHERE nik = $nik";
$row = $db->prepare($sql);
$row->execute();
$hasil = $row->fetchAll();

if(!empty($hasil)){
    
}
else{
    // menyiapkan query
    $sql = "INSERT INTO recognition (nama, nik, tempat_lahir, tgl_lahir, alamat, agama) 
            VALUES (:nama, :nik, :tempat_lahir, :tgl_lahir, :alamat, :agama)";
    $stmt = $db->prepare($sql);

    // bind parameter ke query
    $params = array(
        ":nama" => $nama,
        ":nik" => $nik,
        ":tempat_lahir" => $tempat_lahir,
        ":tgl_lahir" => $tgl_lahir,
        ":alamat" => $alamat,
        ":agama" => $agama,
    );

    // eksekusi query untuk menyimpan ke database
    $saved = $stmt->execute($params);
    if($saved){
        echo '1';
    }
    else{
        echo 'b';
    }
    // jika query simpan berhasil, maka user sudah terdaftar
    // maka alihkan ke halaman login
}
//Remove the data URL prefix (e.g., "data:image/png;base64,")
$imageData = str_replace('data:image/png;base64,', '', $imageData);

// Decode the base64-encoded image data
$decodedImage = base64_decode($imageData);

// Generate a unique filename for the image
$filename = $count . '.png';
//
$folderName = 'labeled_images/'.$nik.'_'.$nama;

if (!is_dir($folderName)) {
    if (mkdir($folderName)) {
        echo 'Folder created successfully.';
    } else {
        echo 'Failed to create folder.';
    }
} else {
    echo 'Folder already exists.';
}
// Specify the directory to save the image
$uploadDirectory = 'labeled_images/'.$nik.'_'.$nama.'/';

// Save the image to the specified directory
if (file_put_contents($uploadDirectory . $filename, $decodedImage)) {
    echo 'Image saved successfully';
} else {
    echo 'Failed to save image';
}
?>