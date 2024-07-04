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
<html>
<head>
    <title>Live Face Recognition Example</title>
    <script src="js/face-api.js"></script>
    <script src="js/face-api.min.js"></script>
</head>
<body>
    <h1>Live Face Recognition Example</h1>
    <video id="videoElement" width="640" height="480" autoplay></video>
    <canvas id="canvas" width="640" height="480"></canvas>

    <script>
        // Load the face-api.js models
        Promise.all([
            faceapi.nets.ssdMobilenetv1.loadFromUri('models'),
            faceapi.nets.faceRecognitionNet.loadFromUri('models'),
        ]).then(startVideo);

        // Start capturing video from the camera
        function startVideo() {
            navigator.mediaDevices.getUserMedia({ video: true })
                .then(function (stream) {
                    const videoElement = document.getElementById('videoElement');
                    videoElement.srcObject = stream;
                    videoElement.play();
                    recognizeFaces();
                })
                .catch(function (error) {
                    console.error('Error accessing the camera:', error);
                });
        }

        // Recognize faces in the video stream
        function recognizeFaces() {
            const videoElement = document.getElementById('videoElement');
            const canvas = document.getElementById('canvas');
            const displaySize = { width: videoElement.width, height: videoElement.height };

            // Set canvas dimensions
            canvas.width = displaySize.width;
            canvas.height = displaySize.height;

            // Perform face detection and recognition in a loop
            setInterval(async () => {
                const detections = await faceapi.detectAllFaces(videoElement).withFaceLandmarks().withFaceDescriptors();
                const resizedDetections = faceapi.resizeResults(detections, displaySize);

                // Clear the canvas
                const context = canvas.getContext('2d');
                context.clearRect(0, 0, canvas.width, canvas.height);

                // Draw bounding boxes around the detected faces
                faceapi.draw.drawDetections(canvas, resizedDetections);

                // Perform face recognition
                const labeledFaceDescriptors = await loadLabeledFaceDescriptors();
                const faceMatcher = new faceapi.FaceMatcher(labeledFaceDescriptors);
                const results = resizedDetections.map(detection => faceMatcher.findBestMatch(detection.descriptor));

                // Display the recognized faces
                results.forEach((result, index) => {
                    const box = resizedDetections[index].detection.box;
                    const { label, distance } = result;

                    const text = `${label} (${distance.toFixed(2)})`;
                    new faceapi.draw.DrawTextField([text], box.bottomRight).draw(canvas);
                });
            }, 100);
        }

        // Load labeled face descriptors for face recognition
        async function loadLabeledFaceDescriptors() {
            const labels = [<?php echo $gabung_kata;?>]; // Replace with your own labels
            const labeledFaceDescriptors = await Promise.all(
                labels.map(async (label) => {
                    const descriptions = [];
                    for (let i = 1; i <= 2; i++) {
                        const img = await faceapi.fetchImage(`labeled_images/${label}/${i}.png`);
                        const detections = await faceapi.detectSingleFace(img).withFaceLandmarks().withFaceDescriptor();
                        descriptions.push(detections.descriptor);
                    }
                    return new faceapi.LabeledFaceDescriptors(label, descriptions);
                })
            );
            return labeledFaceDescriptors;
        }
    </script>
</body>
</html>
