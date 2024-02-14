<?php @include '../controllers/session.php'; ?>
<?php @include '../controllers/TeacherController.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Dashboard</title>

    <!-- Custom fonts for this template-->
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php @include 'teacher_sidebar.php'; ?>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <?php @include 'teacher_topbar.php'; ?>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                   <!-- Page Heading -->
                   <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Hello <?php echo $row_teacher['firstname']; ?> <?php echo $row_teacher['lastname']; ?></h1>
                       
                    </div>




    <div id="errorMSG" class="col-md-12"></div>
     <div id="qrcode">
      <div class="col">

        <script src="qr3/instascan.min.js"></script>

        <div class="col-sm-12"> 
          <video id="camera" class="p-1 border" style="width:100%;border :1px solid #ddd"></video>
        </div>
        <script type="text/javascript">

            let scanner = new Instascan.Scanner({
              video: document.getElementById("camera"),
                // Whether to horizontally mirror the video preview. This is helpful when trying to
                // scan a QR code with a user-facing camera. Default true.
                mirror: true,
                
                // Whether to include the scanned image data as part of the scan result. See the "scan" event
                // for image format details. Default false.
                captureImage: false,
                
                // Only applies to continuous mode. Whether to actively scan when the tab is not active.
                  // When false, this reduces CPU usage when the tab is not active. Default true.
                  backgroundScan: true,
                  
                  // Only applies to continuous mode. The period, in milliseconds, before the same QR code
                  // will be recognized in succession. Default 5000 (5 seconds).
                  refractoryPeriod: 5000,
                  
                  // Only applies to continuous mode. The period, in rendered frames, between scans. A lower scan period
                  // increases CPU usage but makes scan response faster. Default 1 (i.e. analyze every frame).
                  scanPeriod: 1
            });

            let result = document.getElementById("qrcode");
            // let idno = document.getElementById("PersonID")
            // let tdate = document.getElementById("transdate");
            scanner.addListener("scan", function(content) {
              // result.innerText = content;
              // idno.value = content;

              // scanner.stop();
              // scanner.start(cameras[0]);

              // alert(content);

            // var SchedID = document.getElementById("ScheduleID").value;
              
        


            $.ajax({
                  type:"POST", 
                  url:"../controllers/AttendanceProcess.php",
                  dataType: "text",  //expect html to be returned  
                  data:{QRContent:content,
                        UserId:"<?php echo $row_teacher['user_id']; ?>"
                        },//send extra parameters if needed   
                  success:function(data){
                    if (data=='Attendance cannot be process! Please check your time scheduled.') {
                      $("#errorMSG").fadeOut();  
                      $("#errorMSG").fadeIn();
                      $("#errorMSG").css({"background-color": "#E13B2E", "color": "#fff", "padding": "5px"});  
                      $("#errorMSG").html(data);


                          let timerId = setTimeout(function() {
                            // body...
                                 $("#errorMSG").fadeOut();  
                          }, 2000);
                           
                          // clearTimeout(timerId);
                           

                    }else{              
                      $("#errorMSG").fadeOut();  
                      $("#errorMSG").fadeIn();
                      $("#errorMSG").css({"background-color": "#559759", "color": "#fff"});  
                      $("#errorMSG").html(data);  

                          let timerId = setTimeout(function() {
                            // body...
                                 $("#errorMSG").fadeOut();  
                          }, 2000);
                           

                      // $("#qrcode").html(data);
                    }
                     // result.html = data;
                  } 
               });


            });


            Instascan.Camera.getCameras()
              .then(function(cameras) {
                if (cameras.length > 0) {
                  scanner.start(cameras[0]);
                          $('[name="options"]').on('change',function(){
                            if($(this).val()==1){
                              if(cameras[0]!=""){
                                scanner.start(cameras[0]);
                              }else{
                                alert('No Front camera found!');
                              }
                            }else if($(this).val()==2){
                              if(cameras[1]!=""){
                                scanner.start(cameras[1]);
                              }else{
                                alert('No Back camera found!');
                              }
                            }
                          });
                } else {
                  result.innerText = "No cameras found.";
                }
              })
              .catch(function(e) {
                result.innerText = e;
              });
 
        </script> 
        <center>
        <div class="btn-group btn-group-toggle mb-5" data-toggle="buttons">
          <label class="btn btn-primary active">
          <input type="radio" name="options" value="1" autocomplete="off" checked> Front Camera
          </label>
          <label class="btn btn-primary">
          <input type="radio" name="options" value="2" autocomplete="off"> Back Camera
          </label>
        </div>
        <center>
        
         </div> 
      </div> 
   
                    

                    

                    

                          

                        



                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <?php @include 'teacher_footer.php'; ?>
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
    <!-- Attendance Modal-->
    <div class="modal fade" id="attendanceModal" tabindex="-1" role="dialog" aria-labelledby="attendanceModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Oh i'm sorry but your attendance is already recorded</div>
                <div class="modal-footer">
                    <button class="btn btn-primary" type="button" data-dismiss="modal">Ok</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Attendance Modal-->
    <div class="modal fade" id="recordModal" tabindex="-1" role="dialog" aria-labelledby="attendanceModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Good day your attendance was successfully recorded!</div>
                <div class="modal-footer">
                    <button class="btn btn-primary" type="button" data-dismiss="modal">Ok</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Wrong QR Modal-->
    <div class="modal fade" id="wrongModal" tabindex="-1" role="dialog" aria-labelledby="attendanceModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Opps! thats not our schools' QR code</div>
                <div class="modal-footer">
                    <button class="btn btn-primary" type="button" data-dismiss="modal">Ok</button>
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

</body>

</html>