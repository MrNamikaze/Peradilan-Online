<?php
require_once('koneksi.php');
$sql = "SELECT * FROM recognition";
$row = $db->prepare($sql);
$row->execute();
$hasil = $row->fetchAll();
if(empty($hasil)){
    $gabung_kata = 'empty';
}
else{
    $a=0;
    foreach ($hasil as $b) {
        $kata[$a] = '"'.$b['nik'].'_'.$b['nama'].'"';
        $a++;
    }
    $gabung_kata = implode(',', $kata);
}
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
            width: 1100px;
            height: auto;
        }
        body {
            padding: 0;
            margin: 0;
            width: 90vw;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        canvas {
            position: absolute;
        }
    </style>
</head>

<body >

    <table>
        <tr>
            <th><video id="videoElement" width="1400" height="1100" autoplay></video></th>
            <th style="font-size: 28px;">
                Nik: <p id="nik"></p><br>
                Nama: <p id="nama"></p><br>
                Alamat: <p id="alamat"></p><br>
                Tempat Lahir: <p id="tempat_lahir"></p><br>
                Tanggal Lahir: <p id="tgl_lahir"></p><br>
                Agama: <p id="agama"></p><br>
            </th>
        </tr>
    </table>
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
    <script src="js/face-api.js"></script>
    <script src="js/face-api.min.js"></script>
    <script>
        const video = document.getElementById("videoElement");

        Promise.all([
          faceapi.nets.ssdMobilenetv1.loadFromUri("models"),
          faceapi.nets.faceRecognitionNet.loadFromUri("models"),
          faceapi.nets.faceLandmark68Net.loadFromUri("models"),
        ]).then(startWebcam).then(getLabeledFaceDescriptions);

        function startWebcam() {
          navigator.mediaDevices
            .getUserMedia({
              video: true,
              audio: false,
            })
            .then((stream) => {
              video.srcObject = stream;
            })
            .catch((error) => {
              console.error(error);
            });
        }

        function getLabeledFaceDescriptions() {
          const labels = [<?php echo $gabung_kata;?>];
          return Promise.all(
            labels.map(async (label) => {
              const descriptions = [];
              for (let i = 1; i <= 5; i++) {
                const img = await faceapi.fetchImage(`labeled_images/${label}/${i}.png`);
                const detections = await faceapi
                  .detectSingleFace(img)
                  .withFaceLandmarks()
                  .withFaceDescriptor();
                descriptions.push(detections.descriptor);
              }
              return new faceapi.LabeledFaceDescriptors(label, descriptions);
            })
          );
        }

        video.addEventListener("play", async () => {
          const labeledFaceDescriptors = await getLabeledFaceDescriptions();
          const faceMatcher = new faceapi.FaceMatcher(labeledFaceDescriptors);

          const canvas = faceapi.createCanvasFromMedia(video);
          document.body.append(canvas);

          const displaySize = { width: video.width, height: video.height };
          faceapi.matchDimensions(canvas, displaySize);

          setInterval(async () => {
            const detections = await faceapi
              .detectAllFaces(video)
              .withFaceLandmarks()
              .withFaceDescriptors();

            const resizedDetections = faceapi.resizeResults(detections, displaySize);
            canvas.getContext("2d").clearRect(0, 0, canvas.width, canvas.height);

            const results = resizedDetections.map((d) => {
              return faceMatcher.findBestMatch(d.descriptor);
            });
            results.forEach((result, i) => {
              const box = resizedDetections[i].detection.box;
              resizedDetections[i].detection.box._x = resizedDetections[i].detection.box._x - 100;
              resizedDetections[i].detection.box._y = resizedDetections[i].detection.box._y;
              var bagi =  result._label;
              const myArray = bagi.split("_");
              if(myArray == 'unknown'){
                  document.getElementById("nik").innerHTML = 'Undefined';
                  document.getElementById("nama").innerHTML = 'Undefined';
                  document.getElementById("alamat").innerHTML = 'Undefined';
                  document.getElementById("tempat_lahir").innerHTML = 'Undefined';
                  document.getElementById("tgl_lahir").innerHTML = 'Undefined';
                  document.getElementById("agama").innerHTML = 'Undefined';
              }
              else{
                fetch('response.php?id='+myArray[0])
                .then((response) => response.json())
                .then((data) => {
                  data1 = JSON.stringify(data, null, 2);
                  data2 = JSON.parse(data1);
                  document.getElementById("nik").innerHTML = data2.nik;
                  document.getElementById("nama").innerHTML = data2.nama;
                  document.getElementById("alamat").innerHTML = data2.alamat;
                  document.getElementById("tempat_lahir").innerHTML = data2.tempat_lahir;
                  document.getElementById("tgl_lahir").innerHTML = data2.tgl_lahir;
                  document.getElementById("agama").innerHTML = data2.agama;
                })
                .catch((error) => {
                  console.error('Error fetching data:', error);
                });
              }
              result._label = myArray[1];
              const drawBox = new faceapi.draw.DrawBox(box, {
                label: result,
              });
              drawBox.draw(canvas);
            });
          }, 100);
        });
    </script>
</body>

</html>