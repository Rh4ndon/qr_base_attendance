<?php   
        include('../models/dbconn.php');
        $query_teacher= mysqli_query($conn,"select * from teachers where user_id = '$session_id'")or die(mysqli_error());
        $row_teacher = mysqli_fetch_array($query_teacher);

        $teacher_fullname = $row_teacher['firstname'] . ' ' . $row_teacher['lastname'];

        $query_month = mysqli_query($conn, "SELECT * FROM attendance WHERE user_id = '$session_id' ORDER BY date DESC LIMIT 1") or die(mysqli_error());

        $row_month = mysqli_fetch_array($query_month);


        $dateString = $row_month['date_time']; // Assuming $row_month['date_time'] is a string
        $dateObject = new DateTime($dateString);
        $currentMonth_Year = $dateObject->format('F Y');



       

						
?>

