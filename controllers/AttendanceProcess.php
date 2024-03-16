<?php 
@include '../models/dbconn.php';


$schoolID = isset($_POST['QRContent']) ? $_POST['QRContent'] :0; 
$verifyID = isset($_POST['UserId']) ? $_POST['UserId'] :0; 

if ($schoolID == "BNHS2024"){
$dateObject = new DateTime('now', new DateTimeZone('Asia/Manila'));
$currentDate_Time = $dateObject->format('Y-m-d H:i:s');
$currentDate = $dateObject->format('m-d-Y');
$currentTime =  $dateObject->format('H:i:s');

$query_date = mysqli_query($conn,"select * from attendance where user_id = '$verifyID' && date = '$currentDate'")or die(mysqli_error());

if(mysqli_num_rows($query_date) > 0){

    $row_teacher = mysqli_fetch_array($query_date);

    $startTime= $row_teacher['date_time'];

    $endTime = $currentDate_Time;

    $timeDifference = calculateTimeDifference($startTime, $endTime);


    //echo "Time passed: $timeDifference";

    if ($timeDifference >= 1){

        

        if(mysqli_num_rows($query_date) < 2){
            
          
            $insert = "INSERT INTO attendance (user_id,time, date, date_time) VALUES ('$verifyID','$currentTime','$currentDate','$currentDate_Time')";
            mysqli_query($conn, $insert);

        }else{

           
            echo "<script>alert('You have already  submitted your attendance for today!')</script>; ";
        }

    }else{
    echo "<script>
            $('#attendanceModal').modal('show');
        </script>";
    }
    

      



} else {



    $insert = "INSERT INTO attendance (user_id,time, date, date_time) VALUES ('$verifyID','$currentTime','$currentDate','$currentDate_Time')";
    mysqli_query($conn, $insert);
            echo "<script>
            $('#recordModal').modal('show');
        </script>";


        

    
} 
    


}else{
    echo "<script>
            $('#wrongModal').modal('show');
        </script>";
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