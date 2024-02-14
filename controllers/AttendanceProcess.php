<?php 
@include '../models/dbconn.php';


$schoolID = isset($_POST['QRContent']) ? $_POST['QRContent'] :0; 
$verifyID = isset($_POST['UserId']) ? $_POST['UserId'] :0; 

if ($schoolID == "BNHS2024"){
    $dateObject = new DateTime('now', new DateTimeZone('Asia/Manila'));
$currentDate = $dateObject->format('m-d-Y');
$currentTime =  $dateObject->format('H:i:s');

$query_date = mysqli_query($conn,"select * from attendance where user_id = '$verifyID' && date = '$currentDate'")or die(mysqli_error());

if(mysqli_num_rows($query_date) > 0){

    echo "<script>
            $('#attendanceModal').modal('show');
        </script>";

} else{
    $insert = "INSERT INTO attendance (user_id,time, date) VALUES ('$verifyID','$currentTime','$currentDate')";
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








?>