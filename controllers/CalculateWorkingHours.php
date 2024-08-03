<?php

function get_working_hours($from, $to) {
    // Convert dates to timestamps
    $from_timestamp = strtotime($from);
    $to_timestamp = strtotime($to);

    // Define workday hours (9 AM to 5 PM)
    $workday_start_hour = 9;
    $workday_end_hour = 17;
    $workday_seconds = ($workday_end_hour - $workday_start_hour) * 3600;

    // Calculate workdays between dates (minus 1 day)
    $from_date = date('Y-m-d', $from_timestamp);
    $to_date = date('Y-m-d', $to_timestamp);
    $workdays_number = count(get_workdays($from_date, $to_date)) - 1;
    $workdays_number = $workdays_number < 0 ? 0 : $workdays_number;

    // Calculate start and end time in seconds
    $start_time_in_seconds = date("H", $from_timestamp) * 3600 + date("i", $from_timestamp) * 60;
    $end_time_in_seconds = date("H", $to_timestamp) * 3600 + date("i", $to_timestamp) * 60;

    // Final calculation for working hours
    $working_hours = ($workdays_number * $workday_seconds + $end_time_in_seconds - $start_time_in_seconds) / 86400 * 24;

    return $working_hours;
}


?>