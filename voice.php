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
</head>

<body >

    <!-- Page Wrapper -->
    <div id="wrapper">

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
                        <h1 class="h3 mb-0 text-gray-800">Voice To Text</h1>
                    </div>

                    <button type="button" id="startButton">Start Recognition</button>
                    <button type="button" onclick="addRow()">Add Speech</button>
                    <br>
                    <br>
                    <form id="dynamicForm">
                        <table id="dataTable" border="1">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Speech</th>
                                    <th>Action</th>
                                </tr>
                                <tr>
                                    <td><input type="text" id="name" name="name" required></td>
                                    <td><textarea id="output" style="width: 600px"></textarea></td>
                                </tr>
                            </thead>
                            <tbody>

                                <!-- Dynamic table rows will be added here -->
                            </tbody>
                        </table>
                        <br>
                    </form>
                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- End of Footer -->

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
    <script src="js/face-api.js"></script>
    <script src="js/face-api.min.js"></script>
    <script>
    document.addEventListener('DOMContentLoaded', function () {
            const outputText = document.getElementById('output');
            const startButton = document.getElementById('startButton');

            let recognition = new webkitSpeechRecognition();
            recognition.continuous = true;
            recognition.lang = 'id-ID'; // Set the language
            recognition.onresult = function (event) {
                let result = event.results[event.results.length - 1][0].transcript;
                outputText.value += ' ' + result;
            };

            recognition.onend = function () {
                recognition.start();
            };

            startButton.addEventListener('click', function () {
                recognition.start();
            });
        });

    function addRow() {
        // Get the table body
        var tableBody = $('#dataTable tbody');
        var name_voice = document.getElementById('name').value;
        var input_voice = document.getElementById('output').value;
        input_voice.value = '';
        // Create a new row
        var newRow = '<tr>' +
                        '<td><input type="text" name="name[]" value="'+name_voice+'" style="width: 600px; height: 80px"></td>' +
                        '<td><input type="email" name="output[]" value="'+input_voice+'" style="width: 600px; height: 80px"></td>' +
                        '<td><button type="button" onclick="deleteRow(this)">Delete</button></td>' +
                     '</tr>';
        
        // Append the new row to the table
        tableBody.prepend(newRow);
        var input_voice = document.getElementById('output');
        input_voice.value = '';
    }

    function deleteRow(button) {
        // Get the row to be deleted
        var row = $(button).closest('tr');

        // Remove the row
        row.remove();
    }
    </script>
</body>

</html>