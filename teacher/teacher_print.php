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

    <title>Scan Sync</title>

    <!-- Custom fonts for this template-->
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../css/sb-admin-2.min.css" rel="stylesheet">
    <link href="../css/print.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">


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
                <div class="container-fluid margin2">

                 <!-- DataTales Example -->
                 <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 text-primary">Civil Service Form No. 48</h6>
                            <center><h4 class="m-0 font-weight-bold text-primary">Daily Time Record</h4></center>
                            <br>
                            <center><h5 class="m-0 font-weight-bold text-primary"><u><?= $teacher_fullname ?></u></h5></center>
                            <center><h6 class="m-0 text-primary">(Name)</h6></center>
                            <br>
                            <h5 class="m-0 text-primary d-flex justify-content-between"><i>For the month of</i> <u><?= $currentMonth_Year ?></u></h5>
                            <br>
                            <h6 class="m-0 text-primary d-flex justify-content-between"><i>Official hours for arrival</i> <i>Regular days &nbsp; <input type="number"class="underlined-input"></i></h6>
                            <br>
                            <h6 class="m-0 text-primary d-flex justify-content-between"><i>and departure</i> <i>Saturdays &nbsp; <input type="number" class="underlined-input"></i></h6>

                        </div>
                        <div class="card-body margin">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
        <tr>
            <th>Day</th>
    
            <th>AM Arrival</th>
            <th>AM Departure</th>
            <th>PM Arrival</th>
            <th>PM Departure</th>
            <th>Undertime Hrs</th>
            <th>Undertime Mins</th>

        </tr>
    </thead>
    <tbody>
        <?php
        $query_attendance = mysqli_query($conn, "SELECT * FROM attendance WHERE user_id = '$session_id' ORDER BY date ASC") or die(mysqli_error());

        // Create an array to store attendance data indexed by date
        $attendance_data = array();

        while ($row_attendance = mysqli_fetch_array($query_attendance)) {
            // Assuming $row_teacher contains the teacher's information
            $teacher_fullname = $row_teacher['firstname'] . ' ' . $row_teacher['lastname'];
            $am_time_in = $row_attendance['am_time_in'];
            $am_time_out = $row_attendance['am_time_out'];
            $pm_time_in = $row_attendance['pm_time_in'];
            $pm_time_out = $row_attendance['pm_time_out'];
            $attendance_date = $row_attendance['date'];

            // Extract day of the month from the date
            $day_of_month = date('j', strtotime($attendance_date));

            // Get the day of the week (0 = Sunday, 6 = Saturday)
            $day_of_week = date('w', strtotime($attendance_date));

            // Store attendance data in the array
            $attendance_data[$day_of_month] = array(
     
                'am_time_in' => $am_time_in,
                'am_time_out' => $am_time_out,
                'pm_time_in' => $pm_time_in,
                'pm_time_out' => $pm_time_out,
                'day_of_week' => $day_of_week,
            );
        }

        // Loop through all days of the month
        for ($day = 1; $day <= 31; $day++) {
            $date_key = date('Y-m-d', strtotime("2024-05-$day"));

            // Check if attendance data exists for this day
            if (isset($attendance_data[$day])) {
                $attendance = $attendance_data[$day];
            } else {
                // If no attendance data, create empty placeholders
                $attendance = array(
           
                    'am_time_in' => '',
                    'am_time_out' => '',
                    'pm_time_in' => '',
                    'pm_time_out' => '',
                    'day_of_week' => date('w', strtotime($date_key)),
                );
            }

            // Display "Sat" or "Sun" based on the day of the week
            if ($attendance['day_of_week'] == 6) {
                $day_label = 'Sat';
            } elseif ($attendance['day_of_week'] == 0) {
                $day_label = 'Sun';
            } else {
                $day_label = $attendance['am_time_in']; // Display am_time_in for other days
            }
        ?>
            <tr>
                <td><?php echo $day; ?></td>
    
                <td contenteditable="true"><?php echo $day_label; ?></td>
                <td contenteditable="true"><?php echo $attendance['am_time_out']; ?></td>
                <td contenteditable="true"><?php echo $attendance['pm_time_in']; ?></td>
                <td contenteditable="true"><?php echo $attendance['pm_time_out']; ?></td>
                <td contenteditable="true"></td>
                <td contenteditable="true"></td>
               
            </tr>
        <?php } ?>
    </tbody>
                                </table>
                            </div>
                        </div>


                        <div class="card-header py-3 margin3">
                            <center><h6 class="m-0 text-primary text-justify "><i>I certify on my honor that the above is a true and correct report of the 
                                hours of work performed, record of which was made daily at the time of arrival and departure from office.
                            </i></h6></center>
                            <br>
                            <center><h5 class="m-0 font-weight-bold text-primary"><u><?= $teacher_fullname ?></u></h5></center>
                            <br>
                            <center><h6 class="m-0 text-primary">VERIFIED as the prescribe office hours:</h6></center>
                            <br>
                            <center><h5 class="m-0 font-weight-bold text-primary"><u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u></h5></center>
                            <center><h6 class="m-0 text-primary">In Charge</h6></center>
                        </div>











                    </div>

                    
                  
                    <button class="btn btn-info" onclick="window.print();" type="button"><i class="bi bi-printer"></i> Print</button>
                  

                          

                        



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

    <!-- Bootstrap core JavaScript-->
    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="../vendor/chart.js/Chart.min.js"></script>



</body>

</html>