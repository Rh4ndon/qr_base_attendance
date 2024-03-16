<?php 
if(isset($_POST['export'])) {

  $user_id = $_POST['user_id'];
  $user_name = $_POST['name'];

  include('../models/dbconn.php');
  
  $sql = "SELECT teachers.firstname, teachers.lastname, teachers.gender,teachers.contact,teachers.department, MIN(attendance.time) AS time_in, MAX(attendance.time) AS time_out, attendance.date  FROM teachers LEFT JOIN attendance ON teachers.user_id = attendance.user_id ORDER BY date ASC";  
  
  
  $setRec = mysqli_query($conn, $sql);  
  $columnHeader = '';  
  $columnHeader = "First Name" . "\t" . "Last Name" . "\t" . "Gender" . "\t". "Contact No." . "\t". "Department" . "\t" . "Time In" . "\t" . "Time Out" . "\t" . "Date" . "\t";  
  $setData = '';  
    while ($rec = mysqli_fetch_row($setRec)) {  
      $rowData = '';  
      foreach ($rec as $value) {  
          $value = '"' . $value . '"' . "\t";  
          $rowData .= $value;  
      }  
      $setData .= trim($rowData) . "\n";  
  }  
    
  header("Content-type: application/octet-stream");  
  header("Content-Disposition: attachment; filename=.$user_name.xls");  
  header("Pragma: no-cache");  
  header("Expires: 0");  
  
    echo ucwords($columnHeader) . "\n" . $setData . "\n";  


}


    ?>