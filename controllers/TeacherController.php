<?php   
        include('../models/dbconn.php');
        $query_teacher= mysqli_query($conn,"select * from teachers where user_id = '$session_id'")or die(mysqli_error());
        $row_teacher = mysqli_fetch_array($query_teacher);
						
?>