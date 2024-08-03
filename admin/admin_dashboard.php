<?php @include '../controllers/session.php'; ?>
<?php @include '../controllers/AdminController.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>QR Scan</title>

    <!-- Custom fonts for this template-->
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../css/sb-admin-2.min.css" rel="stylesheet">
    <link href="../css/clock.css" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php @include 'admin_sidebar.php'; ?>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <?php @include 'admin_topbar.php'; ?>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                   <!-- Page Heading -->
                   <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Hello <?php echo $row_admin['firstname']; ?> <?php echo $row_admin['lastname']; ?></h1>
                       
                    </div>

                    <div class="card shadow mb-4">
                        <div class="card-body">
                            
                            <div class="wrapper">
                                <div class="display">
                                <div id="time"></div>
                                </div>
                                <span></span>
                                <span></span>
                            </div>
        <script>
           setInterval(()=>{
            const time = document.querySelector("#time");
            let date = new Date();
            let hours = date.getHours();
            let minutes = date.getMinutes();
            let seconds = date.getSeconds();
            if(hours > 12){
                day_night = "PM";
               hours = hours - 12;     
               
            }
            if(hours < 10){
              hours = "0" + hours; 
            }
            if(minutes < 10){
               minutes = "0" + minutes; 
            }
            if(seconds < 10){
               seconds = "0" + seconds; 
            }

            time.textContent = hours + ":" + minutes + ":" + seconds + " " + day_night;
           });
        </script>


                        </div>



                        <div class="card-body">
                            
                                    <center>
                                    <div class="media-body align-items-center">
                                        
                                        <div class="qr-code-container">
                                        <div class="qr-code" id="qr-code">

                                        </div>
                                        </div>

                                    
                                                                       
                                    </div>
                                    </center>

                        </div>

                    </div>
                    

                    

                    

                          

                        



                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <?php @include 'admin_footer.php'; ?>
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
                    <a class="btn btn-primary" href="../controllers/logout.php">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="../vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="../js/demo/chart-area-demo.js"></script>
    <script src="../js/demo/chart-pie-demo.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>

    <?php 
    $date = date("m-d-y");
    ?>

    <script>
    let qr_code_element = document.querySelector(".qr-code");
		var qrcode = new QRCode("qr-code",{
            text: `RH4NDON<?php echo $date; ?>`,
            colorDark: "#000000",
            colorLight: "#ffffff",
            correctLevel: QRCode.CorrectLevel.H
        });

   /*
    let download = document.createElement("button");

 
    qr_code_element.appendChild(download);

    let download_link = document.createElement("a");
    download_link.setAttribute("download", "admin.png");
    download_link.innerHTML = `Download <i class="fa-solid fa-download"></i>`;

    download.appendChild(download_link);
    */

    let qr_code_img = document.querySelector(".qr-code img");
    let qr_code_canvas = document.querySelector("canvas");

    if (qr_code_img.getAttribute("src") == null) {
      setTimeout(() => {
        download_link.setAttribute("href", `${qr_code_img.getAttribute("src")}`);
      }, 300);
    } else {
      setTimeout(() => {
        download_link.setAttribute("href", `${qr_code_img.getAttribute("src")}`);
      }, 300);
    }

	</script>

</body>

</html>