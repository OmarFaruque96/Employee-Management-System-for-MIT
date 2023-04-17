<?php

include '../inc/db.php';

  $q=$_GET["q"];
  $year=$_GET["y"];

  $sum = 0;

  $date = $year.'-'.$q.'-';

  $all_cost = "SELECT * FROM dailycost WHERE cost_date LIKE '%$date%'";
  $read_res = mysqli_query($db,$all_cost);

  $serial = 0;

  ?>
  <table class="table table-striped">
  <thead> 
    <tr>
      <th>#</th>
      <th>Date</th>
      <th>Cost Purpose</th>
      <th>Total Amount</th>
      <th>Paid By</th>
      <th>Money Recipt</th>
      <th>Action</th>
    </tr>
  </thead>
  <?php
  while($row = mysqli_fetch_assoc($read_res)){
    $id            = $row['ID'];
    $cost_date     = $row['cost_date'];
    $cost_purpose  = $row['cost_purpose'];
    $total_amount  = $row['total_amount'];
    $paid_by       = $row['paid_by'];
    $money_receipt = $row['money_receipt'];
    $serial++;
    $sum = $sum + $total_amount;
    ?>

  <tr>

    <td><?php echo $serial;?></td>
    <td><?php echo $cost_date;?></td>
    <td><?php echo $cost_purpose;?></td>
    <td><?php echo $total_amount;?></td>
    <td><?php echo $paid_by;?></td>
    <td>
      <a href=""  data-toggle="modal" data-target="#moneyreceipt<?php echo $id;?>">Click Here</a>
      <div class="modal fade" id="moneyreceipt<?php echo $id;?>" tabindex="-1" aria-labelledby="moneyreceipt" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header pb-4">
              
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>


              <div class="m-profile">
                  
                <img src="images/moneyreceipt/<?php echo $money_receipt;?>" width="100%" alt="money receipt" class="moneyreceipt" />
                  
              </div>


            </div>
            
          </div>
        </div>
      </div>
    </td>
    
    <td>
      
      <a href="dailycost.php?action=edit&eid=<?php echo $id;?>"><i class="mdi mdi-grease-pencil"></i></a>
      <a href="#deletecost<?php echo $id;?>" class="trigger-btn" data-toggle="modal"><i class="mdi mdi-delete-forever"></i></a>
      <div id="deletecost<?php echo $id;?>" class="modal fade">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>

              <div class="row text-center pb-4">
                  
                  <div class="col-sm-10 offset-1">
                    <div class="mt-4">
                    <img class="trash-img" src="images/trash-bin.png" alt="trash" />
                  </div>            
                  <h4 class="trash-title">Are you sure?</h4>  
                  <p class="del-desc">Do you really want to delete these records? This process cannot be undone.</p>

                  <div class="justify-content-center">
                    <button type="button" class="btn btn-secondary rounded" data-dismiss="modal">Cancel</button>
                    <a href="dailycost.php?action=delete&id=<?php echo $id;?>" type="button" class="btn btn-danger rounded">Delete</a>
                  </div>
                  </div>

              </div>
            </div>
          
            
          </div>
        </div>
      </div> 
    </td>
  </tr>

    <?php

}
?>
</table>

<p class="d-none" id="totalcost_permonth"><?php echo $sum;?></p>

<?php
?>