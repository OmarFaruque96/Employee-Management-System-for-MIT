<?php 

include '../inc/db.php'; 
include '../inc/functions.php';

$currentMonth = $_GET["month"];
$currentYear  = $_GET["year"];

$days = cal_days_in_month(CAL_GREGORIAN,$currentMonth,$currentYear);
$allusers = read_data('users','*','status=1');
$today = date("Y-m-d");

?>
<table class="table table-striped">
  <thead>
    <tr>
      <th>User</th>
      <th>Name</th>
      <?php 
        $i=1;
        while($days >= $i){
          echo '<th>'.$i.'</th>';
          $i++;
        }
      ?>
      <th>Action</th>
    </tr>
  </thead>
  <tbody>
    
      <?php 

      foreach ($allusers as $user) {
         echo '<tr><td class="py-1">
        <img src="images/users/'.$user["photo"].'" alt="image"></td><td>'.$user["username"].'</td>';
        // calculate attendance
        $j=1;
        while($days >= $j){
          if($j<10){
            $j= '0'.$j;
          }
          $makeDate = $currentYear.'-'.$currentMonth.'-'.$j;
          
          $entryTime = entry_exit_time('entry_time', 'take_attendance', 'cdate="'.$makeDate.'" AND employee_id="'.$user["employee_id"].'"');
          $exitTime = entry_exit_time('exit_time', 'take_attendance', 'cdate="'.$makeDate.'" AND employee_id="'.$user["employee_id"].'"');

          if($entryTime != '-'){
            echo '<td>'.is_present($entryTime, $exitTime, $user["employee_id"]).'</td>';
          }else{
            echo '<td>-</td>';
          }

          $j++;
        }
        
        echo '</tr>';
      }

      ?>  
  </tbody>
</table>
        
    