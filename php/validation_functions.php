<?php

function validateDate($value) {
    $valid = false;

    if (preg_match("/\d{4}\-\d{2}\-\d{2}/", $value)) {
        // date picker produces universal date format
        // yyyy-mm-dd
        $day = $month = $year = "";
        // split up the pieces 
        list($year, $month, $day) = explode("-", $value);

        $day = intval($day);
        $month = intval($month);
        $year = intval($year);

        // now use PHP checkdate to verify it is a valid date - 1 is supplied for day
        if (checkdate($month, $day, $year)) {
            $valid = true;
        }
    } else if (preg_match("/\d{2}\/\d{2}\/\d{4}/", $value)) {
        // if we are here user has entered format of dd/mm/yyyy
        $day = $month = $year = "";
        // split up the pieces 
        list($day, $month, $year) = explode("/", $value);

        $day = intval($day);
        $month = intval($month);
        $year = intval($year);

        // now use PHP checkdate to verify it is a valid date - 1 is supplied for day
        if (checkdate($month, $day, $year)) {
            $valid = true;
        }
    }

    return $valid;
}

function validateDOB($value) {
    $valid = true;
    if (validateDate($value)) {
        $today = date('Y-m-d');
        $dob = date($value);
        $todayTime = strtotime($today);
        $dobTime = strtotime($dob);

        if ($todayTime <= $dobTime) {
            $valid = false;
        }
    }

    return $valid;
}
