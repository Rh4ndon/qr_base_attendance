<?php   
        include('../models/dbconn.php');
        $query_admin= mysqli_query($conn,"select * from users where user_id = '$session_id'")or die(mysqli_error());
        $row_admin = mysqli_fetch_array($query_admin);
						
?>