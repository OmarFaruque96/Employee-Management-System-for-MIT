<?php include "inc/header.php"; ?>
<?php include "inc/menu.php"; ?>
<?php 
$currentMonth = date('n');
$currentYear  = date('Y');
?>

      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            


            <?php 

            $action = isset($_GET['action']) ? $_GET['action'] : 'view' ;

            switch ($action) {
              case 'view':
                    ?>

            <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Daily Cost Information</h4>
                  <p class="card-description" id="showtotal_cost_per_month">
                    Total Expence for current month: 000
                  </p>
                  <div class="sorting-meta mr-3">
                      <select class="form-control month-sort" style="width: 160px" id="currentYear">
                        <option>Year</option>
                        <option value="2022" <?php if($currentYear == 2022)echo 'selected';?>>2022</option>
                        <option value="2023" <?php if($currentYear == 2023)echo 'selected';?>>2023</option>
                      </select>
                      <select class="form-control month-sort" style="width: 160px" onchange="updateCostData(this.value); totalcost(this.value);">
                        <option value="">Month</option>
                        <option value="01" <?php if($currentMonth == 1)echo 'selected';?>>January</option>
                        <option value="02" <?php if($currentMonth == 2)echo 'selected';?>>February</option>
                        <option value="03" <?php if($currentMonth == 3)echo 'selected';?>>March</option>
                        <option value="04" <?php if($currentMonth == 4)echo 'selected';?>>April</option>
                        <option value="05" <?php if($currentMonth == 5)echo 'selected';?>>May</option>
                        <option value="06" <?php if($currentMonth == 6)echo 'selected';?>>June</option>
                        <option value="07" <?php if($currentMonth == 7)echo 'selected';?>>July</option>
                        <option value="08" <?php if($currentMonth == 8)echo 'selected';?>>August</option>
                        <option value="09" <?php if($currentMonth == 9)echo 'selected';?>>September</option>
                        <option value="10" <?php if($currentMonth == 10)echo 'selected';?>>October</option>
                        <option value="11" <?php if($currentMonth == 11)echo 'selected';?>>November</option>
                        <option value="12" <?php if($currentMonth == 12)echo 'selected';?>>December</option>
                      </select>
                    </div>
                  <div class="table-responsive">
                    <div id="dailycostdata">
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
                        <div id="dailycostdata">
                          
                          <?php

                          $all_cost = "SELECT * FROM dailycost";
                          $read_res = mysqli_query($db,$all_cost);

                          $serial = 0;

                          while($row = mysqli_fetch_assoc($read_res)){
                            $id            = $row['ID'];
                            $cost_date     = $row['cost_date'];
                            $cost_purpose  = $row['cost_purpose'];
                            $total_amount  = $row['total_amount'];
                            $paid_by       = $row['paid_by'];
                            $money_receipt = $row['money_receipt'];
                            $serial++;
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
                                        <?php 

                                        $docs = explode(';', $money_receipt);

                                        foreach ($docs as $key) {
                                            if(!empty($key)){
                                                echo '<div><img src="images/moneyreceipt/'.$key.'" alt="money receipt" class="moneyreceipt" /></div>';
                                            }
                                            
                                        }

                                        ?>
                                          
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
                          }?>
                        
                        </div>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>

                    <?php
                break;
              case 'add':
                    ?>
            <div class="col-12 grid-margin">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Add new cost</h4>
                  <form class="form-sample" method="POST" action="core/insert.php" enctype="multipart/form-data">
                    <p class="card-description">
                      Daily Cost Info
                    </p>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Cost Purpose</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" name="costpurpose">
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Paid By</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" name="paidby">
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Total Amount</label>
                          <div class="col-sm-9">
                            <input type="number" class="form-control" name="amount">
                          </div>
                        </div>
                      </div>
                    </div>
                   
                    <p class="card-description">
                      Money Receipt Photo
                    </p>
                    <div class="row">
                      
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Money Receipt</label>
                          <div class="col-sm-9">
                            <input type="file" name="image[]" class="form-control" multiple="multiple">
                          </div>
                        </div>
                      </div>

                    </div>
                  
                    <div class="row my-4">
                      <div class="col-md-6">

                        <button type="submit" class="btn btn-primary mr-2 rounded" name="add_cost">Add Cost Info</button>
              
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
                    <?php
                break;
              case 'edit':

                  if(isset($_GET['eid'])){
                    $edit_id = $_GET['eid']; 
                    $costs = read_data('dailycost','*','ID = '.$edit_id);

                    foreach ($costs as $cost) {
                      $date = $cost['cost_date'];
                      $cost_purpose = $cost['cost_purpose'];
                      $total_amount = $cost['total_amount'];
                      $paid_by = $cost['paid_by'];
                      $money_receipt = $cost['money_receipt'];
                    }
                  }
                    ?>
                  

            <div class="col-12 grid-margin">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Edit Cost Information</h4>
                  <form class="form-sample" method="POST" enctype="multipart/form-data" action="core/update.php">
                    <p class="card-description">
                      Daily Cost Info
                    </p>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Cost Purpose</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" name="costpurpose" value="<?php echo $cost_purpose;?>">
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Paid By</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" name="paidby" value="<?php echo $paid_by;?>">
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Total Amount</label>
                          <div class="col-sm-9">
                            <input type="number" class="form-control" name="amount" value="<?php echo $total_amount;?>">
                          </div>
                        </div>
                      </div>
                    </div>
                   
                    <p class="card-description">
                      Money Receipt Photo
                    </p>
                    <div class="row">
                      
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Money Receipt</label>
                          <div class="col-sm-9">
                            <input type="hidden" name="oldfiles" value="<?php echo $money_receipt;?>">
                            <input type="file" class="form-control" name="image[]" >
                            <?php 

                            $docss = explode(';', $money_receipt);

                            foreach ($docss as $key) {
                                if(!empty($key)){
                                    echo '<img src="images/moneyreceipt/'.$key.'" class="img-fluid " width="200" alt="money receipt photo" />';
                                }
                            }

                            ?>
                          </div>
                        </div>
                      </div>

                    </div>
                  
                    <div class="row my-4">
                      <div class="col-md-6">
                        <input type="hidden" value="<?php echo $edit_id;?>" name="editid">
                        <button type="submit" class="btn btn-primary mr-2 rounded" name="update_cost">Update Cost Info</button>
                       
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>

                    <?php
                break;
              
              case 'delete':
                    if(isset($_GET['id'])){
                      $delete_id = $_GET['id'];

                      $del_sql = "DELETE FROM dailycost WHERE ID='$delete_id'";
                      $del_res = mysqli_query($db,$del_sql);
                      if($del_res){
                          header('Location: dailycost.php');
                      }else{
                          die('Delete Error in dailycost. Error Details: '.mysqli_error($db));
                      }
                    }
                break;
              
              default:
                      header('Location: dailycost.php');
                break;
            }


            ?>
          </div>
          
        </div>
        
        <!-- content-wrapper ends -->
<?php include "inc/footer.php"; ?>