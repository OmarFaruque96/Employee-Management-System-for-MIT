<?php include "inc/header.php"; ?>
<?php include "inc/menu.php"; ?>
      
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <?php 

            $action = isset($_GET['action']) ? $_GET['action'] : 'view' ;

            switch ($action) {
              case 'view':
              $allusers = read_data('users', '*', 'status=1');
                    ?>

            <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">All Employee's Information List</h4>
                  <p class="card-description">
                  </p>
                  <div class="table-responsive">
                    <table class="table table-striped">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>User</th>
                          <th>Name</th>
                          <th>Email</th>
                          <th>Phone</th>
                          <th>Dept</th>
                          <th>Designation</th>
                          <th>Employee ID</th>
                          <th>Salary</th>
                          <th>Status</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        $serial = 0;
                        foreach ($allusers as $user) {
                          $serial++;
                          ?>
                          <tr>

                          <td><?php echo $serial;?></td>
                          <td class="py-1">
                            <img src="images/users/<?php echo $user['photo'];?>" alt="image">
                          </td>
                          <td><?php echo $user['username'];?></td>
                          <td><?php echo $user['email'];?></td>
                          <td><?php echo $user['phone'];?></td>
                          <td><?php echo $user['dept'];?></td>
                          <td><?php echo $user['position'];?></td>
                          <td><?php echo $user['employee_id'];?></td>
                          <td><?php echo find_col('current_salary', 'salary', $user['ID'], 'user_id');?></td>
                          <td><?php 
                          if($user['usertype'] == '0'){
                            echo '<span class="badge badge-warning">Intern</span>';
                          }
                          if($user['usertype'] == '1'){
                            echo '<span class="badge badge-success">Employee</span>';
                          }
                          if($user['usertype'] == '2'){
                            echo '<span class="badge badge-danger">Admin</span>';
                          }
                          ?>
                            
                          </td>
                          <td>
                            <a href=""  data-toggle="modal" data-target="#showprofile<?php echo $user['ID'];?>"><i class="mdi mdi-account-card-details"></i></a>

                            <div class="modal fade" id="showprofile<?php echo $user['ID'];?>" tabindex="-1" aria-labelledby="showprofile" aria-hidden="true">
                              <div class="modal-dialog">
                                <div class="modal-content">
                                  <div class="modal-header pb-4">
                                    
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                    </button>

                                    <?php 

                                    $suserinfo = read_data('users', '*', 'ID='.$user['ID']);

                                    foreach ($suserinfo as $single) {
                                      ?>
                                      <div class="m-profile">
                                        <div class="profile-top">
                                          <div class="profile-photo">
                                            <?php 
                                            if(empty($single['photo'])){
                                              echo '<img src="images/faces/face1.jpg" />';
                                            }else{
                                              echo '<img src="images/users/'.$single['photo'].'" />';
                                            }
                                            ?>
                                            
                                            <span class="status">
                                              <?php if($single['status'] == 1)
                                                echo 'Active'; 
                                              else 
                                                echo 'Inactive';?>
                                            </span>
                                          </div>
                                          <h4 class="name"><?php echo $single['username'];?> - <span><?php echo $single['employee_id'];?></span></h4>
                                          <h6 class="title">
                                            <span><?php echo $single['position'];?></span>
                                            - <span><?php echo $single['dept'];?></span>
                                          </h6>
                                        </div>

                                        <div class="profile-bottom">
                                          <div class="row">
                                            <label class="col-sm-3 offset-2">Email</label>
                                            <p class="col-sm-7"><?php echo $single['email'];?></p>
                                          </div>

                                          <div class="row">
                                            <label class="col-sm-3 offset-2">Phone</label>
                                            <p class="col-sm-7">+88<?php echo $single['phone'];?></p>
                                          </div>

                                          <div class="row">
                                            <label class="col-sm-3 offset-2">NID</label>
                                            <p class="col-sm-7">
                                              <a href="">Click to view</a>
                                            </p>
                                          </div>

                                          <div class="row">
                                            <label class="col-sm-3 offset-2">Joining Date</label>
                                            <p class="col-sm-7"><?php echo $single['joining_date'];?></p>
                                          </div>

                                          <div class="row">
                                            <label class="col-sm-3 offset-2">Salary</label>
                                            <p class="col-sm-7">
                                              <?php echo find_col('current_salary', 'salary', $single['ID'], 'user_id');?>
                                            </p>
                                          </div>

                                          <div class="row">
                                            <label class="col-sm-3 offset-2">Target</label>
                                            <p class="col-sm-7"><?php echo find_col('target_per_month', 'salary', $single['ID'], 'user_id');?></p>
                                          </div>

                                          <div class="row">
                                            <label class="col-sm-3 offset-2">Percentage Level</label>
                                            <p class="col-sm-7"><?php echo find_col('bonus_level', 'salary', $single['ID'], 'user_id');?></p>
                                          </div>

                                        </div>
                                    </div>
                                      <?php
                                    }

                                    ?>

                                  </div>
                                  
                                </div>
                              </div>
                            </div>
                            <a href="employee.php?action=edit&editid=<?php echo $user['ID'];?>"><i class="mdi mdi-grease-pencil"></i></a>
                            <a href="#delete<?php echo $user['ID'];?>" class="trigger-btn" data-toggle="modal"><i class="mdi mdi-delete-forever"></i></a>
                            <div id="delete<?php echo $user['ID'];?>" class="modal fade">
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
                                          <button type="button" class="btn btn-success rounded" data-dismiss="modal">Cancel</button>
                                          <a href="employee.php?action=delete&delete_id=<?php echo $user['ID'];?>" type="button" class="btn btn-danger rounded">Delete</a>
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
                        
                    

                      </tbody>
                    </table>
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
                  <h4 class="card-title">Add new employee</h4>
                  <form class="form-sample" method="POST" action="core/insert.php" enctype="multipart/form-data">
                    <p class="card-description">
                      Personal info
                    </p>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Employee Name</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" name="name" required="required">
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Gender</label>
                          <div class="col-sm-9">
                            <select class="form-control" name="gender">
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
                            <input type="text" class="form-control" name="email" required="required">
                            <small class="text-danger"><?php if(isset($_GET['mailmsg'])){echo $_GET['mailmsg'];}?></small>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Password</label>
                          <div class="col-sm-9">
                            <input type="password" class="form-control" name="password" required="required">
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Department</label>
                          <div class="col-sm-9">
                            <select class="form-control" name="dept" required="required">
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
                          <label class="col-sm-3 col-form-label">Employee Type</label>
                          <div class="col-sm-4">
                            <div class="form-check">
                              <label class="form-check-label">
                                <input type="radio" class="form-check-input" name="employee_type" id="membershipRadios1" value="1" required="required">
                                Parmanent
                              <i class="input-helper"></i></label>
                            </div>
                          </div>
                          <div class="col-sm-5">
                            <div class="form-check">
                              <label class="form-check-label">
                                <input type="radio" class="form-check-input" name="employee_type" id="membershipRadios2" value="0">
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
                             <input type="text" name="employee_id" class="form-control" required="required">
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Designation</label>
                          <div class="col-sm-9">
                            <input type="text" name="position" class="form-control" required="required">
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Joining Date</label>
                          <div class="col-sm-9">
                            <input type="date" name="joining" class="form-control" required="required">
                          </div>
                        </div>
                      </div>
                      
                    </div>
                    <p class="card-description">
                      Salary Information
                    </p>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Salary</label>
                          <div class="col-sm-9">
                            <input type="number" name="salary" class="form-control" required="required">
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Target</label>
                          <div class="col-sm-9">
                            <input type="number" name="target" class="form-control">
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Percentage Level</label>
                          <div class="col-sm-9">
                            <input type="number" name="level" class="form-control">
                          </div>
                        </div>
                      </div>
                    </div>
                    <p class="card-description">
                      Nid and Apointment Letter Details
                    </p>
                    <div class="row">
                      
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Select PDF Copy</label>
                          <div class="col-sm-9">
                            <input type="file" class="form-control" name="image[]" multiple="multiple" />
                            <small>Please select png or jpg format to upload.</small>
                          </div>
                        </div>
                      </div>

                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Phone</label>
                          <div class="col-sm-9">
                            <input type="number" class="form-control" name="phone" required="required">
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Date of Birth</label>
                          <div class="col-sm-9">
                            <input type="date" class="form-control" name="dob">
                          </div>
                        </div>
                      </div>
                    </div>
                    <p class="card-description">
                      Time Schedule
                    </p>
                    <div class="row">
                      
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Shift</label>
                          <div class="col-sm-9">
                            <select class="form-control" name="shift" required="required">
                              <option value="0" selected>Day</option>
                              <option value="1">Night - (first half)</option>
                              <option value="2">Night - (second half)</option>
                            </select>
                          </div>
                        </div>
                      </div>

                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Holiday</label>
                          <div class="col-sm-9">
                            <select class="form-control" name="holiday" required="required">
                              <option value="Fr" selected>Friday</option>
                              <option value="Sa">Saturday</option>
                              <option value="Su">Sunday</option>
                              <option value="Mo">Monday</option>
                              <option value="Tu">Tuesday</option>
                              <option value="We">Wednessday</option>
                              <option value="Th">Thursday</option>
                            </select>
                          </div>
                        </div>
                      </div>

                    </div>
                    <div class="row">
                      
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Set Entry</label>
                          <div class="col-sm-9">
                            <input type="time" class="form-control" name="entry" required="required">
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Set Exit</label>
                          <div class="col-sm-9">
                            <input type="time" class="form-control" name="exit" required="required">
                          </div>
                        </div>
                      </div>
                    </div>
                  
                    <div class="row my-4">
                      <div class="col-md-6">

                        <button type="submit" name="add_employee" class="btn btn-primary mr-2 rounded">Add Employee</button>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
                    <?php
                break;
              case 'edit':
                if(isset($_GET['editid'])){
                  $editid = $_GET['editid'];

                  $edituser = read_data('users', '*', 'ID='.$editid);
                  foreach ($edituser as $value) {
                      ?>
                      <div class="col-12 grid-margin">
                        <div class="card">
                          <div class="card-body">
                            <h4 class="card-title">Edit User Information </h4>
                            <form class="form-sample" method="POST" action="employee.php?action=update" enctype="multipart/form-data">
                              <p class="card-description">
                                Personal info
                              </p>
                              <div class="row">
                                <div class="col-md-6">
                                  <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Employee Name</label>
                                    <div class="col-sm-9">
                                      <input type="text" class="form-control" name="name" value="<?php echo $value['username'];?>">
                                    </div>
                                  </div>
                                </div>
                                <div class="col-md-6">
                                  <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Gender</label>
                                    <div class="col-sm-9">
                                      <select class="form-control" name="gender">
                                        <option value="Male" value="<?php if($value['gender'] == 'Male') echo 'selected';?>">Male</option>
                                        <option value="Female" value="<?php if($value['gender'] == 'Female') echo 'selected';?>">Female</option>
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
                                      <input type="text" class="form-control" name="email" required="required" value="<?php echo $value['email'];?>">
                                      <small class="text-danger"><?php if(isset($_GET['mailmsg'])){echo $_GET['mailmsg'];}?></small>
                                    </div>
                                  </div>
                                </div>
                                <div class="col-md-6">
                                  <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Set Password</label>
                                    <div class="col-sm-9">
                                      <input type="password" class="form-control" name="password" >
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-md-6">
                                  <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Department</label>
                                    <div class="col-sm-9">
                                      <select class="form-control" name="dept" >
                                        <option value="Business" <?php if($value['position'] =='Business' )echo 'selected';?>>Business</option>
                                        <option value="Sales" <?php if($value['position']=='Sales') echo 'selected';?>>Sales</option>
                                        <option value="Training" <?php if($value['position'] =='Training') echo 'selected';?>>Training</option>
                                        <option value="BOD" <?php if($value['position'] =='BOD')echo 'selected';?>>BOD</option>
                                      </select>
                                    </div>
                                  </div>
                                </div>
                                <div class="col-md-6">
                                  <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Employee Type</label>
                                    <div class="col-sm-4">
                                      <div class="form-check">
                                        <label class="form-check-label">
                                          <input type="radio" class="form-check-input" name="employee_type" value="1" <?php if($value['employee_type'] == '1')echo 'checked';?>>
                                          Parmanent
                                        <i class="input-helper"></i></label>
                                      </div>
                                    </div>
                                    <div class="col-sm-5">
                                      <div class="form-check">
                                        <label class="form-check-label">
                                          <input type="radio" class="form-check-input" name="employee_type" value="0" <?php if($value['employee_type'] == '0')echo 'checked';?>>
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
                                       <input type="text" name="employee_id" class="form-control" value="<?php echo $value['employee_id'];?>">
                                    </div>
                                  </div>
                                </div>
                                <div class="col-md-6">
                                  <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Designation</label>
                                    <div class="col-sm-9">
                                      <input type="text" name="position" class="form-control" value="<?php echo $value['position'];?>">
                                    </div>
                                  </div>
                                </div>
                                <div class="col-md-6">
                                  <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Joining Date</label>
                                    <div class="col-sm-9">
                                      <input type="date" name="joining" class="form-control" value="<?php echo $value['joining_date'];?>">
                                    </div>
                                  </div>
                                </div>
                                
                              </div>
                              <p class="card-description mt-5">
                                Salary Information
                              </p>
                              <div class="row">
                                <div class="col-md-6">
                                  <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Salary</label>
                                    <div class="col-sm-9">
                                      <input type="number" name="salary" class="form-control" value="<?php echo find_col('current_salary', 'salary', $value['ID'], 'user_id');?>">
                                    </div>
                                  </div>
                                </div>
                                <div class="col-md-6">
                                  <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Target</label>
                                    <div class="col-sm-9">
                                      <input type="number" name="target" class="form-control" value="<?php echo find_col('target_per_month', 'salary', $value['ID'], 'user_id');?>">
                                    </div>
                                  </div>
                                </div>
                                <div class="col-md-6">
                                  <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Percentage Level</label>
                                    <div class="col-sm-9">
                                      <input type="number" name="level" value="<?php echo find_col('bonus_level', 'salary', $value['ID'], 'user_id');?>" class="form-control">
                                    </div>
                                  </div>
                                </div>
                                <div class="col-md-6">
                                  <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Comments</label>
                                    <div class="col-sm-9">
                                      <textarea type="number" rows="3" name="comments" value="" class="form-control"></textarea>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <p class="card-description mt-5">
                                Nid and Apointment Letter Details
                              </p>
                              <div class="row">
                                
                                <div class="col-md-6">
                                  <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Select PDF Copy</label>
                                    <div class="col-sm-9">
                                      <input type="file" class="form-control" name="image[]" multiple="multiple" />
                                      <small>Please select png or jpg format to upload.</small>
                                    </div>
                                  </div>
                                </div>

                                <div class="col-md-6">
                                  <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Phone</label>
                                    <div class="col-sm-9">
                                      <input type="number" class="form-control" name="phone" value="<?php echo $value['phone'];?>">
                                    </div>
                                  </div>
                                </div>
                                <div class="col-md-6">
                                  <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Emergency Contact</label>
                                    <div class="col-sm-9">
                                      <input type="number" class="form-control" value="<?php echo $value['emergency_content'];?>" name="emergency">
                                    </div>
                                  </div>
                                </div>
                                <div class="col-md-6">
                                  <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Address</label>
                                    <div class="col-sm-9">
                                      <textarea type="number" rows="5" class="form-control" name="address"><?php echo $value['address'];?></textarea>
                                    </div>
                                  </div>
                                </div>
                                 <div class="col-md-6">
                                  <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Biodata</label>
                                    <div class="col-sm-9">
                                      <textarea type="number" rows="5" class="form-control" name="biodata"><?php echo $value['biodata'];?></textarea>
                                    </div>
                                  </div>
                                </div>
                                <div class="col-md-6 mt-2">
                                  <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Date of Birth</label>
                                    <div class="col-sm-9">
                                      <input type="date" class="form-control" value="<?php echo $value['dob'];?>" name="dob">
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <p class="card-description mt-5">
                                Time Schedule
                              </p>
                              <div class="row">
                                
                                <div class="col-md-6">
                                  <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Shift</label>
                                    <div class="col-sm-9">
                                      <select class="form-control" name="shift" required="required">
                                        <option value="0" <?php if(find_col('shift', 'attendance', $value['ID'], 'user_id') == 0)echo 'selected';?>>Day</option>
                                        <option value="1" <?php if(find_col('shift', 'attendance', $value['ID'], 'user_id') == 1)echo 'selected';?>>Night - (first half)</option>
                                        <option value="2" <?php if(find_col('shift', 'attendance', $value['ID'], 'user_id') == 2)echo 'selected';?>>Night - (second half)</option>
                                      </select>
                                    </div>
                                  </div>
                                </div>

                                <div class="col-md-6">
                                  <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Holiday</label>
                                    <div class="col-sm-9">
                                      <select class="form-control" name="holiday" required="required">
                                        <option value="Fr" <?php if(find_col('holiday', 'attendance', $value['ID'], 'user_id') == 'Fr')echo 'selected';?>>Friday</option>
                                        <option value="Sa" <?php if(find_col('holiday', 'attendance', $value['ID'], 'user_id') == 'Sa')echo 'selected';?>>Saturday</option>
                                        <option value="Su" <?php if(find_col('holiday', 'attendance', $value['ID'], 'user_id') == 'Su')echo 'selected';?>>Sunday</option>
                                        <option value="Mo" <?php if(find_col('holiday', 'attendance', $value['ID'], 'user_id') == 'Mo')echo 'selected';?>>Monday</option>
                                        <option value="Tu" <?php if(find_col('holiday', 'attendance', $value['ID'], 'user_id') == 'Tu')echo 'selected';?>>Tuesday</option>
                                        <option value="We" <?php if(find_col('holiday', 'attendance', $value['ID'], 'user_id') == 'We')echo 'selected';?>>Wednessday</option>
                                        <option value="Th" <?php if(find_col('holiday', 'attendance', $value['ID'], 'user_id') == 'Th')echo 'selected';?>>Thursday</option>
                                      </select>
                                    </div>
                                  </div>
                                </div>

                              </div>
                              <div class="row">
                                
                                <div class="col-md-6">
                                  <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Set Entry</label>
                                    <div class="col-sm-9">
                                      <input type="time" class="form-control" name="entry" value="<?php echo find_col('entry_time', 'attendance', $value['ID'], 'user_id');?>">
                                    </div>
                                  </div>
                                </div>
                                <div class="col-md-6">
                                  <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Set Exit</label>
                                    <div class="col-sm-9">
                                      <input type="time" class="form-control" name="exit" value="<?php echo find_col('exit_time', 'attendance', $value['ID'], 'user_id');?>">
                                    </div>
                                  </div>
                                </div>
                              </div>

                              <p class="card-description mt-5">
                                Access and Visibility
                              </p>
                              <div class="row">
                                
                                <div class="col-md-6">
                                  <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">User Access</label>
                                    <div class="col-sm-9">
                                      <select class="form-control" name="userrole">
                                        <option value="0" <?php if($value['usertype'] == 0)echo 'selected';?>>Intern</option>
                                        <option value="1" <?php if($value['usertype'] == 1)echo 'selected';?>>Employee</option>
                                        <option value="2" <?php if($value['usertype'] == 2)echo 'selected';?>>Admin</option>
                                        <option value="2" <?php if($value['usertype'] == 3)echo 'selected';?>>Super Admin</option>
                                      </select>
                                    </div>
                                  </div>
                                </div>

                                <div class="col-md-6">
                                  <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Visibility</label>
                                    <div class="col-sm-9">
                                      <select class="form-control" name="status">
                                        <option value="1" <?php if($value['usertype'] == 1)echo 'selected';?>>Active</option>
                                        <option value="0" <?php if($value['usertype'] == 0)echo 'selected';?>>Inactive</option>
                                      </select>
                                    </div>
                                  </div>
                                </div>

                              </div>
                              <p class="card-description mt-5">
                                User Photo
                              </p>
                              <div class="row">
                                <div class="col-md-6">
                                  <input type="file" name="photo" class="form-control">
                                </div>
                              </div>
                            
                              <div class="row my-4">
                                <div class="col-md-6">
                                  <input type="hidden" value="<?php echo $editid;?>" name="editid">
                                  <button type="submit" name="update" class="btn btn-primary mr-2 rounded">Add Employee</button>
                                </div>
                              </div>
                            </form>
                          </div>
                        </div>
                      </div>
                      <?php
                  }
                }
                    ?>

            

                    <?php
                break;
              case 'update':
                    if($_SERVER['REQUEST_METHOD'] === 'POST'){
                      $name         = $_POST['name'];
                      $gender       = $_POST['gender'];
                      $email        = $_POST['email'];
                      $password     = $_POST['password'];
                      $dept         = $_POST['dept'];
                      $employee_type= $_POST['employee_type'];
                      $employee_id  = $_POST['employee_id'];
                      $position     = $_POST['position'];
                      $joining      = $_POST['joining'];
                      $salary       = $_POST['salary'];
                      $target       = $_POST['target'];
                      $level        = $_POST['level'];
                      $address      = $_POST['address'];
                      $phone        = $_POST['phone'];
                      $emergency    = $_POST['emergency'];
                      $biodata      = $_POST['biodata'];
                      $file_name    = $_FILES['photo']['name'];
                      $tmp_name     = $_FILES['photo']['tmp_name'];
                      $dob          = $_POST['dob'];
                      $shift        = $_POST['shift'];
                      $holiday      = $_POST['holiday'];
                      $entry        = $_POST['entry'];
                      $exit         = $_POST['exit'];
                      $userrole     = $_POST['userrole'];
                      $status       = $_POST['status'];
                      $editid       = $_POST['editid'];
                      $comments       = $_POST['comments'];


                      // update users table
                       if(!empty($file_name) && !empty($password)){
                        if(is_img($file_name)){
                            $password = sha1($password);
                            $file_name = rand().$file_name;
                            move_uploaded_file($tmp_name, '../images/users/'.$file_name);
                          $up_sql = "UPDATE users SET username='$name', email='$email', password='$password', gender='$gender', dept='$dept', position='$position', employee_type='$employee_type', photo='$file_name', employee_id='$employee_id', phone='$phone', address='$address', dob='$dob', emergency_content='$emergency', joining_date='$joining', biodata='$biodata', usertype='$userrole', status='$status' WHERE ID='$editid'";
                        }
                       }
                       elseif(empty($file_name) && !empty($password)){
                        $password = sha1($password);
                        $up_sql = "UPDATE users SET username='$name', email='$email', password='$password', gender='$gender', dept='$dept', position='$position', employee_type='$employee_type', employee_id='$employee_id', phone='$phone', address='$address', dob='$dob', emergency_content='$emergency', joining_date='$joining', biodata='$biodata', usertype='$userrole', status='$status' WHERE ID='$editid'";
                       }elseif(!empty($file_name) && empty($password)){
                        if(is_img($file_name)){
                            $file_name = rand().$file_name;
                            move_uploaded_file($tmp_name, '../images/users/'.$file_name);
                          $up_sql = "UPDATE users SET username='$name', email='$email', gender='$gender', dept='$dept', position='$position', employee_type='$employee_type', photo='$file_name', employee_id='$employee_id', phone='$phone', address='$address', dob='$dob', emergency_content='$emergency', joining_date='$joining', biodata='$biodata', usertype='$userrole', status='$status' WHERE ID='$editid'";
                        }
                       }else{
                        // update in user table
                          $up_sql = "UPDATE users SET username='$name', email='$email', gender='$gender', dept='$dept', position='$position', employee_type='$employee_type', employee_id='$employee_id', phone='$phone', address='$address', dob='$dob', emergency_content='$emergency', joining_date='$joining', biodata='$biodata', usertype='$userrole', status='$status' WHERE ID='$editid'";
                          
                        }

                      // update in salary
                          $salary_sql = "UPDATE salary SET current_salary='$salary', target_per_month='$target', bonus_level='$level', update_history='$comments' WHERE user_id='$editid'";
                          $attendance_sql = "UPDATE attendance SET shift='$shift', entry_time='$entry', exit_time='$exit', holiday='$holiday' WHERE user_id='$editid'";
                          $res = mysqli_query($db,$up_sql);
                          $res2 = mysqli_query($db,$salary_sql);
                          $res3 = mysqli_query($db,$attendance_sql);
                          if($res && $res2 && $res3){
                            header('Location: employee.php?action=view');
                          }else{
                            die('User information update error!'.mysqli_error($db));
                          }

                    }
                break;
              case 'delete':
                    if(isset($_GET['delete_id'])){
                      $del_id = $_GET['delete_id'];

                      // delete only information
                      delete('users','ID',$del_id,'employee.php');
                    }
                break;
              
              default:
                      header('Location: employee.php');
                break;
            }


            ?>
          </div>
          
        </div>
        <!-- content-wrapper ends -->
<?php include "inc/footer.php"; ?>