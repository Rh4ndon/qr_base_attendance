<?php 
@include '../controllers/session.php'; 
@include '../controllers/AdminController.php';

if($_GET['department'] == 'ap'){
    $department = 'ARALING PANLIPUNAN';
}else if ($_GET['department'] == 'ep'){
    $department = 'EDUKASYON SA PAGPAPAKATAO';
}else if ($_GET['department'] == 'eng'){
    $department = 'ENGLISH';
}else if ($_GET['department'] == 'fil'){
    $department = 'FILIPINO';
}else if ($_GET['department'] == 'mapeh'){
    $department = 'MAPEH';
}else if ($_GET['department'] == 'math'){
    $department = 'MATHEMATICS';
}else if ($_GET['department'] == 'scie'){
    $department = 'SCIENCE';
}else if ($_GET['department'] == 'tle'){
    $department = 'TLE';
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

    <title>Scan Sync</title>

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

                 <!-- DataTales Example -->
                 <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Attendance</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>AM Arrival</th>
                                            <th>AM Departure</th>
                                            <th>PM Arrival</th>
                                            <th>PM Departure</th>
                                            <th>Date</th>
                                        </tr>
                                    </thead>
                                 
                                    <tbody>
                                        <?php 
                                         $query_attendance= mysqli_query($conn,"SELECT teachers.firstname, teachers.lastname, attendance.am_time_in, attendance.am_time_out, attendance.pm_time_in, attendance.pm_time_out, attendance.date FROM teachers LEFT JOIN attendance ON teachers.user_id = attendance.user_id WHERE teachers.department = '$department' ORDER BY attendance.date ASC")or die(mysqli_error());
                                         while ($row_attendance = mysqli_fetch_array($query_attendance)){                    
                                            ?> 
                                        
                                        <tr>
                                            <td><?php echo $row_attendance['firstname']; ?> <?php echo $row_attendance['lastname']; ?></td>
                                            
                                            <td><?php echo $row_attendance['am_time_in']; ?></td>
                                            <td><?php echo $row_attendance['am_time_out']; ?></td>
                                            <td><?php echo $row_attendance['pm_time_in']; ?></td>
                                            <td><?php echo $row_attendance['pm_time_out']; ?></td>
                                            

                                            

                                            <td><?php 
                                            if ($row_attendance['date'] == ''){
                                                echo '<p style="color: red; font-weight: bold;">Absent</p>';
                                            }else{
                                                echo $row_attendance['date'];
                                            }
                                             ?></td>
                                        </tr> 
                                        <?php }?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    

                    

                <a href="../controllers/ExportAll.php?department=<?= $department ?>"><button class="btn btn-primary" type="button">Export to Xls</button></a>
                
                <a href="#" data-toggle="modal" data-target="#deleteModal"><button class="btn btn-danger" type="button">Delete Database Record</button></a>
  
               



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

    <!-- Delete Modal-->
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete Database?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Are you sure you want to delete database contents of the previous month?</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-danger" href="../controllers/DeleteAttendance.php">Delete</a>
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