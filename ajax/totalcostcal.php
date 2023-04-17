<?php

include '../inc/db.php';
include '../inc/functions.php';

  $month=$_GET["month"];
  $year=$_GET["year"];
  $sum = 0;
  $date = $year.'-'.$month.'-';

  $all_cost = "SELECT * FROM dailycost WHERE cost_date LIKE '%$date%'";
  $read_res = mysqli_query($db,$all_cost);
  while($row = mysqli_fetch_assoc($read_res)){
    $total_amount  = $row['total_amount'];
    $sum = $sum+$total_amount;
  }

  echo 'Total Expence for <span>'.find_month_name($month).'</span>: <span class="text-danger d-inline-block">
                        '.$sum.'
                      </span>tk';