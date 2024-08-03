<?php 
if(isset($_POST['export'])) {

  $user_id = $_POST['user_id'];
  $user_name = $_POST['name'];

  include('../models/dbconn.php');

  include 'session.php';
   
  $setRec= mysqli_query($conn,"SELECT * FROM attendance LEFT JOIN teachers ON attendance.user_id = teachers.user_id WHERE attendance.user_id = '$session_id' ORDER BY date ASC")or die(mysqli_error());
  




  $dateObject = new DateTime('now', new DateTimeZone('Asia/Manila'));
  $currentDate_Time = $dateObject->format('Y-m-d H:i:s');
  $currentMonth = $dateObject->format('F');



  $columnHeader = '';  
  $monthHeader = "Month Of" . "\t" . $currentMonth . "\t";   
  $columnHeader = "First Name" . "\t" . "Last Name" . "\t" . "Gender" . "\t". "Contact No." . "\t". "Department" . "\t"  . "AM Arrival" . "\t" . "AM Departure" . "\t" ."PM Arrival" . "\t" . "PM Departure" . "\t" . "Date" . "\t";  
  $setData = '';  
    while ($rec = mysqli_fetch_array($setRec)) {  
   
      if ($rec['date'] == ''){
        $date = 'Absent';
    }else{
      $date = $rec['date'];
    }

      $rowData = '"' . $rec['firstname'] . ' "'. "\t". '"' .$rec['lastname'].  '"' . "\t". '"' .$rec['gender'].  '"' . "\t". '"' .$rec['contact'].  '"' . "\t". '"' .$rec['department'].  '"' . "\t" . '"' .$rec['am_time_in'].  '"' . "\t". '"' .$rec['am_time_out'].  '"' . "\t". '"' .$rec['pm_time_in'].  '"' . "\t". '"' .$rec['pm_time_out'].  '"' . "\t". '"' .$date.  '"' . "\t";   
      $setData .= trim($rowData) . "\n";  
  }  

    
  header("Content-type: application/octet-stream");  
  header("Content-Disposition: attachment; filename=.$user_name.xls");  
  header("Pragma: no-cache");  
  header("Expires: 0");  
  
  echo ucwords($monthHeader) . "\n" . ucwords($columnHeader) . "\n" . $setData . "\n";  

}

?>