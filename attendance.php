<?php include "inc/header.php"; ?>
<?php include "inc/menu.php"; ?>
<?php 
$currentMonth = date('n');
$currentYear  = date('Y');

$days = cal_days_in_month(CAL_GREGORIAN,$currentMonth,$currentYear);
$allusers = read_data('users','*','status=1');
$today = date("Y-m-d");
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
                  <div class="position-relative">
                    <h4 class="card-title">All Employee's Attendance</h4>
                    <p class="card-description">
                       Based on their official time schedule
                    </p>
                    <div class="sorting-meta">
                      <select class="form-control month-sort" style="width: 160px" id="currentYear">
                        <option>Year</option>
                        <option value="2022" <?php if($currentYear == 2022)echo 'selected';?>>2022</option>
                        <option value="2023" <?php if($currentYear == 2023)echo 'selected';?>>2023</option>
                      </select>
                      <select class="form-control month-sort" style="width: 160px" onchange="monthwise_attendance(this.value)">
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
                  </div>
                  <div class="table-responsive" id="showattendance">
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

                  </div>
                </div>
              </div>
            </div>

                    <?php
                break;
              case 'single':
                    ?>
            <div class="col-lg-10 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <div class="position-relative">
                    <h4 class="card-title">Todays Update</h4>
                    <p class="card-description">
                      Want to take attendance manually ? <a href=""  data-toggle="modal" data-target="#takeattendance">Click here</a>
                    <form method="POST" action="core/customattendance.php">
                      <div class="modal fade tattendance" id="takeattendance" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLabel">Manual Attendance</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body">
                              <div class="form-group">
                                <label>Select Employee</label>
                                <select class="form-control" name="employee_id">
                                  <?php 
                                  $employee_list = read_data('users');

                                  foreach ($employee_list as $member) {
                                    echo '<option value="'.$member["employee_id"].'">'.$member["username"].'</option>';
                                  }
                                  ?>
                                  
                                </select>
                              </div>
                              <div class="row mt-3">
                                <div class="form-group col-md-6">
                                  <label>Entry Time</label>
                                  <input type="time" class="form-control" name="entry">
                                </div>
                                <div class="form-group col-md-6">
                                  <label>Exit Time</label>
                                  <input type="time" class="form-control" name="exit">
                                </div>
                              </div>
                              <div class="row mt-3">
                                <div class="col-md-12">
                                  <div class="form-group">
                                    <label>Comments</label>
                                    <textarea cols="100%" rows="5" name="comments" class="form-control"></textarea>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="modal-footer">
                              <button type="submit" name="custom-attendance" class="btn btn-primary rounded">Save</button>
                            </div>
                          </div>
                        </div>
                      </div>
                    </form>
                    </p>
                  </div>
                  <div class="table-responsive" id="showattendance">
                    <table class="table table-striped">
                      <thead>
                        <tr>
                          <th>User</th>
                          <th>Name</th>
                          <th>Entry</th>
                          <th>Exit</th>
                          <th>Status</th>
                          <th>Comments</th>
                          <th>Ip Address</th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php 

                      $t_attr = read_data('take_attendance','*','cdate LIKE "%'.$today.'%"');

                      foreach ($t_attr as $data) {
                          echo '<tr>
                          <td class="py-1">
                            <img src="images/users/'.find_col("photo", "users", $data["employee_id"], "employee_id").'" class="att-img" alt="user image" />
                          </td><td>'.find_col("username", "users", $data["employee_id"], "employee_id").'</td><td>'.$data["entry_time"].'</td><td>'.$data["exit_time"].'</td><td>'.is_present($data["entry_time"], $data["exit_time"], $data["employee_id"]).'</td>
                          <td>'.$data["comment"].'</td><td>'.$data["ip"].'</td>
                        </tr>';
                      }

                      ?>
                        
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
                    <?php
                break;
              case 'edit':
                    ?>

            <div class="col-12 grid-margin">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Edit Employee Information</h4>
                  <form class="form-sample">
                    <p class="card-description">
                      Personal information
                    </p>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Employee Name</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" name="name">
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Gender</label>
                          <div class="col-sm-9">
                            <select class="form-control">
                              <option>Male</option>
                              <option>Female</option>
                            </select>
                          </div>
                        </div>
                      </div>
                      
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Email Address</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" name="email">
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Password</label>
                          <div class="col-sm-9">
                            <input type="password" class="form-control" name="password">
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Department</label>
                          <div class="col-sm-9">
                            <select class="form-control">
                              <option>Business</option>
                              <option>Sales</option>
                              <option>Training</option>
                              <option>Office Head</option>
                            </select>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Employee Level</label>
                          <div class="col-sm-4">
                            <div class="form-check">
                              <label class="form-check-label">
                                <input type="radio" class="form-check-input" name="membershipRadios" id="membershipRadios1" value="" checked="">
                                Parmanent
                              <i class="input-helper"></i></label>
                            </div>
                          </div>
                          <div class="col-sm-5">
                            <div class="form-check">
                              <label class="form-check-label">
                                <input type="radio" class="form-check-input" name="membershipRadios" id="membershipRadios2" value="option2">
                                Intern
                              <i class="input-helper"></i></label>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Employee ID</label>
                          <div class="col-sm-9">
                             <input type="text" name="" class="form-control">
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Designation</label>
                          <div class="col-sm-9">
                            <input type="text" name="" class="form-control">
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Joining Date</label>
                          <div class="col-sm-9">
                            <input type="date" name="" class="form-control">
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Salary</label>
                          <div class="col-sm-9">
                            <input type="number" name="" class="form-control">
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Target</label>
                          <div class="col-sm-9">
                            <input type="number" name="" class="form-control">
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Percentage Level</label>
                          <div class="col-sm-9">
                            <input type="number" name="" class="form-control">
                          </div>
                        </div>
                      </div>
                    </div>
                    <p class="card-description">
                      Nid Details
                    </p>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">NID Number</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control">
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">NID Card PDF Copy</label>
                          <div class="col-sm-9">
                            <input type="file" class="form-control">
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Phone</label>
                          <div class="col-sm-9">
                            <input type="number" class="form-control" name="phone">
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Postcode</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control">
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">City</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control">
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Country</label>
                          <div class="col-sm-9">
                            <select class="form-control">
                              <option>America</option>
                              <option>Italy</option>
                              <option>Russia</option>
                              <option>Britain</option>
                            </select>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row my-4">
                      <div class="col-md-6">

                        <button type="submit" class="btn btn-primary mr-2 rounded">Update Information</button>
                        <button class="btn btn-light rounded" >Cancel</button>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>

                    <?php
                break;
              case 'update':
                    
                break;
              case 'delete':
                    
                break;
              
              default:
                      header('Location: employee.php');
                break;
            }


            ?>
          </div>
          
        </div>
        <script type="text/javascript">
          function monthwise_attendance(month){

            //alert(month);
            var year = document.getElementById('currentYear').value;
            var xmlreq=new XMLHttpRequest();
              xmlreq.onreadystatechange=function() {
                if (this.readyState==4 && this.status==200) {
                  document.getElementById("showattendance").innerHTML=this.responseText;
                }
              }
              xmlreq.open("GET","ajax/showattendance.php?month="+month+"&year="+year,true);
              xmlreq.send();
          }
        </script>
        <!-- content-wrapper ends -->
<?php include "inc/footer.php"; ?>