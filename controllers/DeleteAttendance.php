<?php include('../models/dbconn.php');


// Construct the SQL query for the previous month (assuming 'attendance' is your table name)
$sql = "DELETE FROM attendance WHERE DATE_FORMAT(date_time, '%Y-%m') = DATE_FORMAT(CURRENT_DATE - INTERVAL 1 MONTH, '%Y-%m')";

if ($conn->query($sql) === TRUE) {
    header("Location: ../admin/attendance_record.php");
    exit;
} else {
    echo "Error deleting rows: " . $conn->error;
}





















?>