<?php 

include '../inc/db.php'; 
include '../inc/functions.php';

$userid = $_SESSION['ID'];
$employee_id = find_col('employee_id', 'users', $userid, 'ID');

$currentMonth = $_GET["month"];
$currentYear  = $_GET["year"];

?>
<?php 
            $days = cal_days_in_month(CAL_GREGORIAN,$currentMonth,$currentYear);
            //echo find_day_name($currentMonth, $currentYear);
            ?>
            <ul class="weekdays">
              <?php find_day_name($currentMonth, $currentYear);?>
            </ul>
    		<ul class="days">  
                <?php 
                    $i=1;
                    while($days >= $i){

                        if($i<10){
                            $i='0'.$i;
                        }

                        if($i <= $currentDay){
                            $makeDate = $currentYear.'-'.$currentMonth.'-'.$i;
                            $entryTime = entry_exit_time('entry_time', 'take_attendance', 'cdate="'.$makeDate.'" AND employee_id="'.$employee_id.'"');
                            $exitTime = entry_exit_time('exit_time', 'take_attendance', 'cdate="'.$makeDate.'" AND employee_id="'.$employee_id.'"');

                            // find holiday
                            echo '<li><span style="background-color:'.attendance_info($userid,$employee_id,$entryTime,$exitTime).'">'.$i.'</span></li>';
                        }
                        else{
                            echo '<li><span style="color: black">'.$i.'</span></li>';
                        }
                        
                      $i++;
                    }
                ?>
    		</ul>