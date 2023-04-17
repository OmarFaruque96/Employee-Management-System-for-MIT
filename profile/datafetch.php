<?php

$currentMonth = date('n');
$currentYear  = date('Y');
$currentDay = date('j');

date_default_timezone_set('Asia/Dhaka');
$current_time = date('H:i:s');
$today = date("Y-m-d");

if(empty($_SESSION['ID'])){
    header('Location: index.php');
}else{
    $userid = $_SESSION['ID'];
    $employee_id = find_col('employee_id', 'users', $userid, 'ID');
    //echo $employee_id;
}



// read all information for logged in user
$user_basic_info = read_data('users', '*', 'ID="'.$userid.'"');
foreach ($user_basic_info as $user) {
    $username       = $user['username'];
    $email          = $user['email'];
    $password       = $user['password'];
    $dept           = $user['dept'];
    $position       = $user['position'];
    $employee_type  = $user['employee_type'];
    $employee_id    = $user['employee_id'];
    $phone          = $user['phone'];
    $address        = $user['address'];
    $dob            = $user['dob'];
    $emergency_content = $user['emergency_content'];
    $photo          = $user['photo'];
    $official_document = $user['official_document'];
    $joining_date   = $user['joining_date'];
    $biodata        = $user['biodata'];
}
// salary information
$user_salary_info = read_data('salary', '*', 'user_id="'.$userid.'"');

foreach ($user_salary_info as $salary) {
    $current_salary     = $salary['current_salary'];
    $target_per_month   = $salary['target_per_month'];
    $bonus_level        = $salary['bonus_level'];
    $update_history     = $salary['update_history'];
}

// attendance information
$user_attendance_info = read_data('take_attendance', '*', 'employee_id="'.$employee_id.'"');

foreach ($user_attendance_info as $attr) {
    $cdate          = $attr['cdate'];
    $entry_time     = $attr['entry_time'];
    $exit_time      = $attr['exit_time'];
    $status         = $attr['status'];
    $comment        = $attr['comment'];
    $ip             = $attr['ip'];
}

// entry, exit and shifting time
$schedule = read_data('attendance', '*', 'user_id="'.$userid.'"');
foreach ($schedule as $time) {
    $shift = $time['shift'];
    $mentry_time = $time['entry_time'];
    $mexit_time = $time['exit_time'];
    $holiday = $time['holiday'];
}



//echo $current_time;
$showentryform = 'block';
$showexitform = 'hidden';
$showprofile = 'hidden';
$showclock = 'hidden';

$entry_time = "SELECT entry_time from take_attendance WHERE employee_id='$employee_id' AND cdate = '$today'";
//echo $entry_time;
$res = mysqli_query($db,$entry_time);

if(mysqli_num_rows($res) > 0){
    $showentryform = 'hidden';
    $showexitform = 'hidden';
    $showprofile = 'block';
    $showclock = 'block';
}

$exit_time = "SELECT exit_time from take_attendance WHERE employee_id='$employee_id' AND cdate = '$today'";
$res = mysqli_query($db,$exit_time);

if(mysqli_num_rows($res) > 0){
    $showentryform = 'hidden';
    $showexitform = 'hidden';
    $showprofile = 'block';
    $showclock = 'hidden';
}



if(isset($_GET['action'])){
    $action = $_GET['action'];
    if($action == 'viewprofile'){
        $showprofile='block';
        $showentryform = 'hidden';
        $showexitform = 'hidden';
        $showclock = 'block';
    }
    if($action == 'showexit'){
        $showexitform = 'block';
        $showprofile='hidden';
        $showentryform = 'hidden';
        $showclock = 'hidden';
    }
    if($action == 'complete'){
        $showprofile='block';
        $showentryform = 'hidden';
        $showexitform = 'hidden';
        $showclock = 'hidden';
    }
}



