<?php
$nama_undang;
$judul_undang;
$kategori_undang;
$link_undang;
$m = 0;
$n = 0;
$o = 1;
$p = 0;
$q = 0;
for ($i=0; $i < 88; $i++) { 
    // URL of the website to scrape
    $j = $i+1;

    $websiteUrl = 'https://peraturan.bpk.go.id/Search?keywords=&tema=61&p='.$j;

    // Create a new DOMDocument object
    $dom = new DOMDocument();

    // Suppress warnings caused by malformed HTML
    libxml_use_internal_errors(true);

    // Load the HTML content from the website
    $dom->loadHTMLFile($websiteUrl);

    // Restore error handling
    libxml_clear_errors();
    libxml_use_internal_errors(false);

    // Create a DOMXPath object
    $xpath = new DOMXPath($dom);

    // Example: Scrape content from a div with class="target-div"
    $targetDivElements = $xpath->query("//div[contains(@class, 'card')]//div[contains(@class, 'card-body px-6 pb-6 d-flex')]//div[contains(@class, 'col-lg-8 fw-bold fs-4')]");


    if ($targetDivElements->length > 0) {
        $k = 0;
        foreach ($targetDivElements as $divElement) {
            $content = $divElement->textContent;
            $nama_undang[$i][$k] = $content . PHP_EOL;
            $k++;
            $m = $k;
        }
    } else {
        echo 'No div element with class="target-div" found on the page.';
    }

    $targetDivElements1 = $xpath->query("//div[contains(@class, 'card')]//div[contains(@class, 'card-body px-6 pb-6 d-flex')]//a[contains(@class, 'fs-1 fw-bold')]");


    if ($targetDivElements1->length > 0) {
        $k = 0;
        foreach ($targetDivElements1 as $divElement1) {
            $content1 = $divElement1->textContent;
            $judul_undang[$i][$k] = $content1 . PHP_EOL;
            $k++;
            $n = $k;
        }
    } else {
        echo 'No div element with class="target-div" found on the page.';
    }

    $targetDivElements2 = $xpath->query("//div[contains(@class, 'card')]//div[contains(@class, 'card-body px-6 pb-6 d-flex')]//p[contains(@class, 'mt-5 mb-10')]");


    if ($targetDivElements2->length > 0) {
        $k = 0;
        foreach ($targetDivElements2 as $divElement2) {
            $data = $xpath->query('.//span', $divElement2);
            $cellData = [];
            $l = 0;
            foreach ($data as $cell) {
                $content2 = $cell->textContent;
                $kategori_undang[$i][$k][$l] = $content2.PHP_EOL;
                $l++;
                $p = $l;
            }
            $k++;
        }
    } else {
        echo 'No div element with class="target-div" found on the page.';
    }
    // tag
    $elementsToPrint1 = $xpath->query('//p[@class="mt-5 mb-10"]');
    $k = 0;
    foreach ($elementsToPrint1 as $element) {
        // echo '<xmp>'.$dom->saveHTML($element).'</xmp><br><br>asd<br>';
        $element1 = $dom->saveHTML($element);
        $element2 = str_replace('<p class="mt-5 mb-10">','',$element1);
        $element3 = substr($element2, 0, -46);
        $element4 = str_replace('badge badge-secondary','badge badge-primary',$element3);
        $tag_undang[$i][$k] = $element4;
        // var_dump($element1);
        $k++;
    }
    //
    $elementsToPrint = $xpath->query('//div[@class="border-top border-gray-300 pt-4 mt-4"]');
    $k = 0;
    foreach ($elementsToPrint as $element) {
        // echo '<xmp>'.$dom->saveHTML($element).'</xmp><br><br>asd<br>';
        $element1 = $dom->saveHTML($element);
        // var_dump($element1);
        $jum_element = strpos($element1, '<a class="download-file text-danger');
        if($jum_element){
            $htmlString = $dom->saveHTML($element);

            // Create a new DOMDocument object
            $dom1 = new DOMDocument();

            // Suppress warnings caused by malformed HTML
            libxml_use_internal_errors(true);

            // Load the HTML content from the string
            $dom1->loadHTML($htmlString);

            // Restore error handling
            libxml_clear_errors();
            libxml_use_internal_errors(false);

            // Create a DOMXPath object
            $xpath1 = new DOMXPath($dom1);

            // Example: Scrape elements with class="target-class"
            $elementsToScrape = $xpath1->query('//a');
            $l = 0;
            foreach ($elementsToScrape as $element1) {
                $element2 = str_replace('Abstrak','',$element1->textContent);
                $nama_link_undang[$i][$k][$l] = $element2;
                
                $link_undang[$i][$k][$l] = $element1->getAttribute('href');
                $l++;
            }
        }
        else{
            $link_undang[$i][$k][0] = 'empty';
            $link_undang[$i][$k][1] = '';
        }
        $k++;
    }
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
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css" />

</head>

<body id="page-top">

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
                        <h1 class="h3 mb-0 text-gray-800">Daftar Peraturan</h1>
                    </div>
                    <table id="example" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Peraturan</th>
                                <th>Deskripsi</th>
                                <th>Tag</th>
                                <th>File</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php for($i=0; $i < 88; $i++):?>
                                <?php
                                $m = count($nama_undang[$i]);
                                ?>
                                    <?php for($k=0; $k < $m; $k++):?>
                                        <tr>
                                            <td ><?= $o;?></td>
                                            <td style="width: 500px;"><?= $nama_undang[$i][$k]?></td>
                                            <td style="width: 1200px;"><?= $judul_undang[$i][$k]?></td>
                                            <td><?= $tag_undang[$i][$k]?></td>
                                            <td><?php
                                            $o++; 
                                            $jumlah_down = count($link_undang[$i][$k])-1;
                                            for($l=0; $l < $jumlah_down; $l++){
                                                if($link_undang[$i][$k][$l] == 'empty'){
                                                    echo 'Tidak Ada File';
                                                }
                                                else{
                                                    echo '<a class="btn btn-primary" href="https://peraturan.bpk.go.id'.$link_undang[$i][$k][$l].'">'.$nama_link_undang[$i][$k][$l].'</a>';
                                                }
                                            }
                                            ?></td>
                                        </tr>
                                    <?php endfor;?>
                                <?php ?>
                            <?php endfor;?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>No</th>
                                <th>Nama Peraturan</th>
                                <th>Deskripsi</th>
                                <th>Tag</th>
                                <th>File</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                
            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Your Website 2021</span>
                    </div>
                </div>
            </footer>
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
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>
    <script>
        $(document).ready(function () {
            $('#example').DataTable();
        });
    </script>
</body>

</html>
