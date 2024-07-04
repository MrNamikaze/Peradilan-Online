<?php
$id = $_GET['id'];
require_once('koneksi.php');
$sql = "SELECT * FROM recognition WHERE id = $id";
$row = $db->prepare($sql);
$row->execute();
$hasil = $row->fetch();
$sql = "DELETE FROM recognition WHERE id = $id";
$row = $db->prepare($sql);
$row->execute();
$gabung = $hasil['nik'].'_'.$hasil['nama'];
function deleteFolder($folderPath) {
    if (!is_dir($folderPath)) {
        return false; // Not a folder, nothing to delete
    }

    // Open the folder
    $dirHandle = opendir($folderPath);

    // Loop through the folder's contents
    while (($file = readdir($dirHandle)) !== false) {
        if ($file != "." && $file != "..") {
            $filePath = $folderPath . DIRECTORY_SEPARATOR . $file;
            
            if (is_dir($filePath)) {
                // Recursively delete subfolders and their contents
                deleteFolder($filePath);
            } else {
                // Delete the file
                unlink($filePath);
            }
        }
    }

    // Close the folder handle
    closedir($dirHandle);

    // Remove the empty folder
    return rmdir($folderPath);
}

// Usage example:
$folderPath = 'labeled_images/'.$gabung;
if (deleteFolder($folderPath)) {
    header("location: picture.php", true, 301);
} else {
    echo "Failed to delete the folder.";
}
?>