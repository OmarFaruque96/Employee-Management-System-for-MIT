<?php 

include 'db.php';

function getUserIpAddr(){
    if(!empty($_SERVER['HTTP_CLIENT_IP'])){
        //ip from share internet
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    }elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
        //ip pass from proxy
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    }else{
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    return $ip; 
}

// delete anything
function delete($table,$primarykey,$deleteid,$redirecturl){
    global $db;
    $del_sql = "DELETE FROM $table WHERE $primarykey='$deleteid'";
    $del_res = mysqli_query($db,$del_sql);
    if($del_res){
        header('Location: '.$redirecturl);
    }else{
        die('Delete Error in '.$table.'. Error Details: '.mysqli_error($db));
    }
}
// to read data from database
function read_data($table_name, $columns = '*', $conditions = ''){
    global $db;

    // Build the SQL query string
    $query = 'SELECT ' . $columns . ' FROM ' . $table_name;
    if (!empty($conditions)) {
        $query .= ' WHERE ' . $conditions;
    }
    //echo $query;
    $result = mysqli_query($db, $query);

    // Create an array to hold the data
    $data = array();

    // Loop through the result set and add each row to the data array
    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = $row;
    }
    // Close the database connection
    //mysqli_close($db);

    // Return the data array
    return $data;
}

// only read a single data
function read_data_by_id($table_name, $id) {
    // Call the read_data function with the appropriate conditions
    $conditions = 'id = ' . $id;
    $rows = read_data($table_name, '*', $conditions);
    // If the result set contains a single row, return it
    if (count($rows) == 1) {
        return $rows[0];
    }
    // Otherwise, return null
    return null;
}

// check image or not 
function is_img($file_name){
    global $db;

    $slited_names = explode('.', $file_name);
    $extn = strtolower(end($slited_names));

    $extensions = array('png','jpg');

    if(in_array($extn, $extensions) === true){
        return true;
    }
    return false;
}

function find_month_name($month){
    switch ($month) {
        case '1':
            return 'January';
            break;
        case '2':
            return 'February';
            break;
        case '3':
            return 'March';
            break;
        case '4':
            return 'April';
            break;
        case '5':
            return 'May';
            break;
        case '6':
            return 'June';
            break;
        case '7':
            return 'July';
            break;
        case '8':
            return 'August';
            break;
        case '9':
            return 'September';
            break;
        case '10':
            return 'October';
            break;
        case '11':
            return 'November';
            break;
        case '12':
            return 'December';
            break;
        
        default:
            # code...
            break;
    }
}

// find day name for a specific month in year
function find_day_name($month, $year){

    $firstDay = date('w', strtotime("$year-$month-01"));

    // Sunday is 0, Monday is 1, and so on
    // echo ["Su", "Mo", "Tu", "We", "Th", "Fr", "Sa"][$firstDay];
    $daysOfWeek = ["Su", "Mo", "Tu", "We", "Th", "Fr", "Sa"];

    for ($i = $firstDay; $i < $firstDay + 7; $i++) {
        $dayIndex = $i % 7;
        echo '<li>'.$daysOfWeek[$dayIndex].'</li>';
    }

}

// find single coloum info with id
function find_col($col, $table, $ID, $compareCol){
    global $db;

    $sql = "SELECT $col FROM $table WHERE $compareCol = '$ID'";
    $res = mysqli_query($db,$sql);
    $row = mysqli_fetch_assoc($res);

    if(isset($row[$col])){
        return $row[$col];
    }else{
        return '-';
    }
    
}

// calculate present of absent 
function is_present($entryTime, $exitTime, $employee_id){
    global $db;

    $user_id = find_col('ID', 'users', $employee_id, 'employee_id');
    $eatt = read_data('attendance','*', 'user_id='.$user_id);

    $buffer_time = strtotime("+15 minutes", strtotime($eatt[0]["entry_time"]));

    $half_day_count = strtotime("+90 minutes", strtotime($eatt[0]["entry_time"]));

    if($exitTime <= '00:00:00'){
        if($entryTime < date('h:i:s', $buffer_time)){
            $entry_status = 'P/NX';  
        }
        elseif($entryTime > date('h:i:s', $half_day_count)){
            $entry_status = 'H/NX';  
        }
        elseif($entryTime > date('h:i:s', $buffer_time) && $entryTime < date('h:i:s', $half_day_count)){
            $entry_status = 'L/NX'; 
        }elseif (empty($entryTime)) {
            $entry_status = 'Pending';
        }
    }else{
        if($entryTime < date('h:i:s', $buffer_time) && $exitTime > $eatt[0]["exit_time"]){
            $entry_status = 'P';  
        }
        elseif($entryTime > date('h:i:s', $half_day_count) && $exitTime > $eatt[0]["exit_time"]){
            $entry_status = 'H';  
        }
        elseif(($entryTime > date('h:i:s', $buffer_time) && $entryTime < date('h:i:s', $half_day_count)) && $exitTime > $eatt[0]["exit_time"]){
            $entry_status = 'L'; 
        }else{
            $entry_status = 'A'; 
        }
    }
    
    return $entry_status;
}

// profile attendance update
function attendance_info($userid,$employee_id,$entryTime,$exitTime){
    global $db;

    $att = read_data('attendance','*', 'user_id=1');
    $buffer_time = strtotime("+15 minutes", strtotime($att[0]["entry_time"]));

    $half_day_count = strtotime("+90 minutes", strtotime($att[0]["entry_time"]));

    if($exitTime == '00:00:00'){
        $status = '#009FBD'; // pending (exit time not found)
    }
    elseif ($entryTime == '' && $exitTime == '') {
        $status = '#FF6000'; // holiday
    }
    else{
        if($entryTime < date('h:i:s', $buffer_time) && $exitTime > $att[0]["exit_time"]){
            $status = '#5D9C59';  // present 
        }
        elseif($entryTime > date('h:i:s', $half_day_count) && $exitTime > $att[0]["exit_time"]){
            $status = '#BFDB38';  // half day 
        }
        elseif(($entryTime > date('h:i:s', $buffer_time) && $entryTime < date('h:i:s', $half_day_count)) && $exitTime > $att[0]["exit_time"]){
            $status = '#FC7300';   //Late
        }else{
            $status = '#DF2E38';  // absence
        }
    }
    
    return $status;
}


// find entry and exit time for specific user
function entry_exit_time($cols, $table, $conditions=''){
    global $db; 
    // Build the SQL query string
    $query = 'SELECT ' . $cols . ' FROM ' . $table;
    if (!empty($conditions)) {
        $query .= ' WHERE ' . $conditions;
    }

    $result = mysqli_query($db, $query);

    $row = mysqli_fetch_assoc($result);

    if(isset($row[$cols])){
        return $row[$cols];
    }else{
        return '-';
    }
}

// check duplicate mail in login
function email_exist($email){
    global $db;

    $mail_res = mysqli_query($db,"SELECT email FROM users WHERE email='$email'");
    if(mysqli_num_rows($mail_res) > 0){
        return true;
    }else{
        return false;
    }
}


function show_form($userid, $status, $showentryform){

    if($status == 'In-Time'){
        $color ="bg-[#5D9C59]";

    }
    if($status == 'Already Late'){
        $color ="bg-[#FC7300]";

    }
    if($status == 'Half Day'){
        $color ="bg-[#BFDB38]";
    }
    if($status == 'Absent Already'){
        $color ="bg-[#DF2E38]";
    }


    echo '<div class="w-full h-screen flex items-center '.$showentryform.'">
    <div class="rounded-md text-center lg:w-96 md:w-80 w-64 mx-auto p-8 bg-cyan-500 shadow-lg shadow-black-400/50 ...">
        <h4 class="text-white text-xl mb-6 semibold">Please starting your working timer!</h4>
        <form method="POST" action="core/userattendance.php">
        <input type="hidden" value="'.$userid.' name="userid" />
            <button type="submit" name="takeatt" class="inline-flex w-auto cursor-pointer select-none appearance-none items-center justify-center space-x-1 rounded border border-gray-200 '.$color.' px-3 py-2 text-sm font-medium text-white transition hover:border-blue-300 hover:bg-blue-600 active:bg-blue-700 focus:blue-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-300"><span>'.$status.'</span></button>
        </form>
    </div>
</div>';
}

function show_exit_form($employee_id, $exit){
    echo '<div class="w-full h-screen flex items-center">
    <div class="rounded-md text-center lg:w-96 md:w-80 w-64 mx-auto p-8 bg-cyan-500 shadow-lg shadow-black-400/50 ...">
        <h4 class="text-white text-xl mb-6 semibold">You are going to leave now! See you soon then.</h4>
        <form method="POST" action="core/userattendance.php">
        <input type="hidden" value="'.$employee_id.' name="userid" />
            <button type="submit" name="exitatt" class="inline-flex w-auto cursor-pointer select-none appearance-none items-center justify-center space-x-1 rounded border border-gray-200 bg-red-600 px-3 py-2 text-sm font-medium text-white transition hover:border-blue-300 hover:bg-blue-600 active:bg-blue-700 focus:blue-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-300"><span>End Clock!</span></button>
        </form>
    </div>
</div>';
}

function duplicate_mail_check($email){
    global $db;

    $email_sql = "SELECT email FROM users WHERE email = '$email'";
    $res = mysqli_query($db,$email_sql);
    if(mysqli_num_rows($res) > 0){
        return true;
    }else{
        return false;
    }
    
}