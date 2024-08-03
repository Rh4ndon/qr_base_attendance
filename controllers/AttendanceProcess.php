<?php 
@include '../models/dbconn.php';


$schoolID = isset($_POST['QRContent']) ? $_POST['QRContent'] :0; 
$verifyID = isset($_POST['UserId']) ? $_POST['UserId'] :0; 

$date = date('m-d-y');

if ($schoolID == "RH4NDON" . $date) {

$dateObject = new DateTime('now', new DateTimeZone('Asia/Manila'));
$currentDate_Time = $dateObject->format('Y-m-d H:i:s');
$currentDate = $dateObject->format('Y-m-d');
$currentTime =  $dateObject->format('H:i:s');

$query_date = mysqli_query($conn,"select * from attendance where user_id = '$verifyID' && date = '$currentDate'")or die(mysqli_error());

    if(mysqli_num_rows($query_date) > 0){

    $row_teacher = mysqli_fetch_array($query_date);

    $startTime= $row_teacher['date_time'];

    $endTime = $currentDate_Time;

    $timeDifference = calculateTimeDifference($startTime, $endTime);

    $attendance_id = $row_teacher['id'];
    //echo "Time passed: $timeDifference";

    $teacher_am_in = $row_teacher['am_time_in'];
    $teacher_am_out = $row_teacher['am_time_out'];
    $teacher_pm_in = $row_teacher['pm_time_in'];
    $teacher_pm_out = $row_teacher['pm_time_out'];

        if ($timeDifference >= 1){


        if($row_teacher['am_time_out'] == '' ){
            
       
            mysqli_query($conn, "UPDATE attendance SET user_id = '$verifyID',am_time_in = '$teacher_am_in', am_time_out = '$currentTime', pm_time_in = '', pm_time_out = '', date = '$currentDate', date_time = '$currentDate_Time'  where id = '$attendance_id'")or die(mysqli_error());

            echo 'success2.php';

        }else if ($row_teacher['am_time_out'] != '' && $row_teacher['pm_time_in'] == '' && $row_teacher['pm_time_out'] == '' ){


            mysqli_query($conn, "UPDATE attendance SET user_id = '$verifyID',am_time_in = '$teacher_am_in', am_time_out = '$teacher_am_out', pm_time_in = '$currentTime', pm_time_out = '', date = '$currentDate', date_time = '$currentDate_Time'  where id = '$attendance_id'")or die(mysqli_error());

            echo 'success3.php';
     
        } else if ($row_teacher['am_time_out'] != '' && $row_teacher['pm_time_in'] != '' && $row_teacher['pm_time_out'] == '' ){

    
            mysqli_query($conn, "UPDATE attendance SET user_id = '$verifyID',am_time_in = '$teacher_am_in', am_time_out = '$teacher_am_out', pm_time_in = '$teacher_pm_in', pm_time_out = '$currentTime', date = '$currentDate', date_time = '$currentDate_Time'  where id = '$attendance_id'")or die(mysqli_error());

            echo 'success4.php';
     
          
        }else if ($row_teacher['am_time_out'] != '' && $row_teacher['pm_time_in'] != '' && $row_teacher['pm_time_out'] != '' ){

           
            echo 'done.php';
     
   
        }


    }else{

        echo "wait.php";

    }
    



    } else {



    $insert = "INSERT INTO attendance (user_id, am_time_in, am_time_out, pm_time_in, pm_time_out, date, date_time) VALUES ('$verifyID','$currentTime', '', '', '', '$currentDate','$currentDate_Time')";
    mysqli_query($conn, $insert);
    
    echo 'success.php';


        

    
    } 
    


}else{

    echo "Opps! thats not our schools' QR code";
}



//function to calculate time
function calculateTimeDifference($startTime, $endTime) {
    $startTimeUnix = strtotime($startTime);
    $endTimeUnix = strtotime($endTime);

    $timeDiff = $endTimeUnix - $startTimeUnix;

    $hours = floor($timeDiff / 3600);
    $minutes = floor(($timeDiff % 3600) / 60);
    $seconds = $timeDiff % 60;

    //return sprintf('%02d:%02d:%02d', $hours, $minutes, $seconds);
    return ($hours);
}



?>