<?php
require_once('koneksi.php');
$id = $_GET['id'];
$sql = "SELECT * FROM recognition WHERE id = $id";
$row = $db->prepare($sql);
$row->execute();
$hasil = $row->fetch();
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>e Court - Dashboard</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <style>
        video {
            position: relative;
            width: 100%;
            height: 800px;
        }

        canvas {
            position: absolute;
        }
    </style>
</head>

<body >

    <!-- Page Wrapper -->
    <div id="wrapper" style="width: 1800px">

        <!-- Sidebar -->
        <?php
        require 'sidebar.php';
        ?>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <?php
                require 'navbar.php';
                ?>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Take A Picture</h1>
                        <button class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" id="captureButton">Capture</button>
                    </div>
                    <div class="alert alert-success mt-3" role="alert" id="myAlert1" style="display: none;">
                      Tunggu Sebentar!!
                    </div>

                    <div class="alert alert-success mt-3" role="alert" id="myAlert" style="display: none;">
                      Data Berhasil Disimpan
                      <button type="button" class="close" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="row">
                        <div class="col">
                          <input type="text" class="form-control" id="nama" placeholder="Nama" value="<?= $hasil['nama']?>" readonly>
                          <p id="nama1"></p>
                        </div>
                        <div class="col">
                          <input type="text" class="form-control" id="nik" placeholder="NIK" value="<?= $hasil['nik']?>" readonly>
                          <p id="nik1" hidden></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                          <input type="text" class="form-control" id="tempat_lahir" placeholder="Tempat Lahir" value="<?= $hasil['tempat_lahir']?>" readonly>
                          <p id="nama1"></p>
                        </div>
                        <div class="col">
                          <input type="date" class="form-control" id="tgl_lahir" placeholder="Tanggal Lahir" value="<?= $hasil['tgl_lahir']?>" readonly>
                          <p id="nik1" hidden></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                          <input type="text" class="form-control" id="alamat" placeholder="Alamat" value="<?= $hasil['alamat']?>" readonly>
                          <p id="nama1"></p>
                        </div>
                        <div class="col">
                          <input type="text" class="form-control" id="agama" placeholder="Agama" value="<?= $hasil['agama']?>" readonly>
                          <p id="nik1" hidden></p>
                        </div>
                    </div>
                    <br>
                    <video id="video" width="600" height="480" autoplay></video>
                    <canvas id="canvas" width="600" height="480" style="display: none;"></canvas>
                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="login.html">Logout</a>
                </div>
            </div>
        </div>
    </div>
    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script>
    <script>
        const video = document.getElementById('video');
        const canvas = document.getElementById('canvas');
        const captureButton = document.getElementById('captureButton');
        const context = canvas.getContext('2d');
        var nama;
        var nik;
        // Access the camera stream
        navigator.mediaDevices.getUserMedia({ video: true })
            .then((stream) => {
                video.srcObject = stream;
            })
            .catch((error) => {
                console.error('Error accessing camera:', error);
            });

        // Capture the image from the video stream
        let count = 1;
        const maxCount = 5;
        console.log(captureButton);
        captureButton.addEventListener('click', () => {
            const interval = setInterval(() => {
              if (count <= maxCount) {
                const alertElement = document.getElementById('myAlert');
                alertElement.style.display = 'none';
                const alertElement1 = document.getElementById('myAlert1');
                alertElement1.style.display = 'block';
                nama = document.getElementById("nama").value;
                nik = document.getElementById("nik").value;
                tempat_lahir = document.getElementById("tempat_lahir").value;
                tgl_lahir = document.getElementById("tgl_lahir").value;
                alamat = document.getElementById("alamat").value;
                agama = document.getElementById("agama").value;
                context.drawImage(video, 0, 0, canvas.width, canvas.height);
                const imageDataURL = canvas.toDataURL('labeled_images/syahrul');
                // Send the image data to PHP for saving
                saveImage(imageDataURL);
                count++;
              } else {
                clearInterval(interval);
                const alertElement1 = document.getElementById('myAlert1');
                alertElement1.style.display = 'none';
                const alertElement = document.getElementById('myAlert');
                alertElement.style.display = 'block';
                count = 1;
              }
            }, 100);
        });
        function hideAlert() {
          const alertElement = document.getElementById('myAlert');
          alertElement.style.display = 'none';
        }
        const closeButton = document.querySelector('#myAlert .close');
        closeButton.addEventListener('click', hideAlert);
        // Send the image data to PHP for saving
        function saveImage(imageDataURL) {
            const xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    console.log(nama);
                }
            };
            xhr.open('POST', 'save_image.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.send('imageData=' + encodeURIComponent(imageDataURL ) + '&count=' + count + '&nama=' + nama + '&nik=' + nik + '&tempat_lahir=' + tempat_lahir + '&tgl_lahir=' + tgl_lahir + '&alamat=' + alamat + '&agama=' + agama);
        }
    </script>
</body>

</html>