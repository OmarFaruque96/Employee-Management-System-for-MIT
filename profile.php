<?php 
include 'inc/db.php';
include 'inc/functions.php';
session_start();

include 'profile/datafetch.php';

?>
<html>
<head>
	<title>Employee Profile Page</title>
	<meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.tailwindcss.com"></script>

  <link rel="stylesheet" type="text/css" href="css/calender.css">
</head> 
<body class="lg:py-10 md:py-10 py-4">


<?php include 'profile/form_display.php'; ?>
<!-- take attendance form -->
<div class="<?php echo $showexitform;?>">
    <?php show_exit_form($employee_id,'exit');?>
</div>

<div class="fixed bottom-4 right-4 <?php echo $showclock;?>">
    <a href="profile.php?action=showexit"><img src="images/clock.gif" class="w-16 rounded-full" /></a>
</div>

<div class="bg-white md:mx-auto rounded shadow-xl w-full md:w-1/2 overflow-hidden <?php echo $showprofile;?>">
  <div class="relative h-[140px] bg-gradient-to-r from-cyan-500 to-blue-500 z-10">
  	<!-- <a href="profile.php?action=edit"><img src="images/edit.png" class="absolute right-4 top-4 w-6" /></a> -->
  </div>
  <div class="px-5 py-2 flex flex-col gap-3 pb-6 z-20">
    <div class="h-[90px] shadow-md w-[90px] rounded-full border-4 overflow-hidden -mt-14 border-white z-20">
        <?php 
        if(empty($photo)){
            echo '<img src="images/users/default.png" class="w-full h-full rounded-full object-center object-cover">';
        }else{
            echo '<img src="images/users/'.$photo.'" class="w-full h-full rounded-full object-center object-cover">';
        }
        ?>
    	</div>

    <div class="relative">
       
      <h3 class="text-xl text-slate-900 relative font-bold leading-6">
        <?php echo $username.' - '.$employee_id;?></h3>
      <p class="text-sm text-gray-600"><?php echo $email;?></p>
    </div>
    <div class="flex gap-3 flex-wrap">
    	<span class="rounded-sm bg-yellow-100 px-3 py-1 text-xs font-medium text-yellow-800"><?php echo $position;?></span>
    	<span class="rounded-sm bg-green-100 px-3 py-1 text-xs font-medium text-green-800"><?php echo $dept;?></span>
    	
    </div>
    <div class="flex gap-2">

    	<a type="button" href="#" id="profile-btn" class="inline-flex w-auto cursor-pointer select-none appearance-none items-center justify-center space-x-1 rounded border border-gray-200 bg-white-800 px-3 py-2 text-sm font-medium text-gray-800 transition hover:border-blue-300 hover:bg-blue-600 focus:blue-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-300">Profile</a>

    	<a type="button" href="#" id="attendance-btn" class="inline-flex w-auto cursor-pointer select-none appearance-none items-center justify-center space-x-1 rounded border border-gray-200 bg-white px-3 py-2 text-sm font-medium text-gray-800 transition hover:border-blue-300 hover:bg-blue-600 active:bg-blue-700 focus:blue-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-300 hover:text-white active:text-white">Attendance</a>

        <a type="button" href="profile/editprofile.php?id=<?php echo $userid;?>" id="" class="inline-flex w-auto cursor-pointer select-none appearance-none items-center justify-center space-x-1 rounded border border-gray-200 bg-white px-3 py-2 text-sm font-medium text-gray-800 transition hover:border-blue-300 hover:bg-blue-600 focus:blue-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-300 hover:text-white active:text-white" >Edit Profile</a>

        <a type="button" href="inc/logout.php" id="wallet-btn" class="inline-flex w-auto cursor-pointer select-none appearance-none items-center justify-center space-x-1 rounded border border-gray-200 bg-red-600 px-3 py-2 text-sm font-medium text-white transition" >Logout</a>
    	
    </div>

    <div class="" id="profile">
    	<h4 class="text-md font-medium leading-3">About</h4>
	    <p class="text-sm text-stone-500"><?php echo $biodata;?></p>

	    <h4 class="text-md font-medium leading-3 my-4">Personal Information</h4>
	    <div class="flex flex-col gap-3">
	    
	      <div class="flex items-center gap-3 px-2 py-3 bg-white rounded border w-full ">
	      	<img src="images/profile/icon/phone-call.png" class="w-8">
	        <div class="leading-3">
	          <p class=" text-sm font-bold text-slate-700">+880 <?php echo $phone;?></p>
	          <!-- <span class="text-xs text-slate-600">5 years</span> -->
	        </div>
	        <p class="text-sm text-slate-500 self-start ml-auto">
	        Your active contact info
	    	</p>
	      </div>

	      <div class="flex items-center gap-3 px-2 py-3 bg-white rounded border w-full ">
	      	<img src="images/profile/icon/calendar.png" class="w-8">
	        <div class="leading-3">
	          <p class=" text-sm font-bold text-slate-700"><?php echo $joining_date;?></p>
	          
	        </div>
	        <p class="text-sm text-slate-500 self-start ml-auto">
	        Your joining date
	    	</p>
	      </div>

	      <div class="flex items-center gap-3 px-2 py-3 bg-white rounded border w-full ">
	      	<img src="images/profile/icon/pay.png" class="w-8">
	        <div class="leading-3">
	          <p class=" text-sm font-bold text-slate-700">
               <?php echo find_col('current_salary', 'salary', $userid, 'user_id');?>   
              </p>
	          <!-- <span class="text-xs text-slate-600">5 years</span> -->
	        </div>
	        <p class="text-sm text-slate-500 self-start ml-auto">
	        Your current salary
	    	</p>
	      </div>

	      <div class="flex items-center gap-3 px-2 py-3 bg-white rounded border w-full ">
	      	<img src="images/profile/icon/document.png" class="w-8">
	        <div class="leading-3">
	          <span class=" text-sm font-bold text-slate-700">Your Documents</span>
	        </div>
	        <p class="text-sm text-slate-500 self-start ml-auto">
	        
	    	</p>
	      </div>

          <div class="grid md:grid-cols-2 grid-cols-1 p-6 gap-3">
            <?php 

            $docs = explode(';', $official_document);

            foreach ($docs as $key) {
                if(!empty($key)){
                    echo '<div><img src="images/documents/'.$key.'" class="mw-full h-auto" /></div>';
                }
                
            }

            ?>
              
          
          </div>

	    </div>
    </div>
    <!-- attendance -->
    <div class="" id="attendance">
    	<h4 class="text-md font-medium leading-3 mb-6 mt-4">Attendance</h4>
        <div class="color-theory">
            <ul>
                <li><span class="box present"></span> Present</li>
                <li><span class="box absence"></span> Absence</li>
                <li><span class="box late"></span> Late</li>
                <li><span class="box halfday"></span> Half Day</li>
                <li><span class="box holiday"></span> Holiday</li>
                <li><span class="box pending"></span> Pending</li>
            </ul>
        </div>
    	<div class="month">      
		  <ul>
		    <li class="prev">&#10094;</li>
		    <li class="next">&#10095;</li>
		    <li>
                
		      <span id="currentMonthInProfile "><?php echo find_month_name($currentMonth);?></span><br>
		      <span style="font-size:18px"><?php echo $currentYear;?></span>
		    </li>
		  </ul>
		</div>

		<div id="profileatt-show">
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

                            //$tttoday = "2023-04-13";
                            $dayName = date("l", strtotime($makeDate));
                            $holiday = find_col('holiday', 'attendance', $userid, 'user_id');
                            if( substr($dayName, 0, 2) == $holiday){
                                echo '<li><span style="background-color:#3F0071;">'.$i.'</span></li>';
                            }else{
                                echo '<li><span style="background-color:'.attendance_info($userid,$employee_id,$entryTime,$exitTime).'">'.$i.'</span></li>';
                            }

                            // find holiday
                            
                            if($i % 7 == 0){
                                echo '<br>';
                            }
                        }
                        else{

                            echo '<li><span style="color: black">'.$i.'</span></li>';
                            if($i % 7 == 0){
                                echo '<br>';
                            }
                        }
                        
                      $i++;
                    }
                ?>
    		</ul>
        </div>
    </div>

    <!-- wallet -->
    <div class="" id="wallet">
    	<!-- <h4 class="text-md font-medium leading-3 mb-6 mt-4">Wallet</h4> -->
    	<div class="mobile">
            <div class="header">
                <div class="navigation">
                    <i class="fas fa-arrow-left"></i>
                </div>
                <div class="filter">
                    <div class="calendar">
                        <i class="far fa-calendar-alt"></i>
                    </div>
                    <div class="option"><?php echo $currentYear;?></div>
                    <div class="select">
                        <i class="fas fa-angle-down"></i>
                    </div>
                </div>
            </div>
            <div class="content">
                <div class="total">
                    <div class="label">Salary Margin</div>
                    <div class="value"><?php echo $current_salary.' TK';?></div>
                    <div class="balance"><?php echo 'Target: '.$target_per_month.' TK';?></div>
                </div>
              
                <div class="list">
                    <div class="item1">
                        <div class="section1">
                            <div class="icon down">
                                <i class="fas fa-arrow-up"></i>
                            </div>
                            <div class="text">
                                <div class="title">iTunes Gift Card #22338</div>
                                <div class="description">Today, 13:45</div>
                            </div>
                        </div>
                        <div class="section2">
                            <div class="signal negative">-</div>
                            <div class="value">$198.25</div>
                        </div>
                    </div>
                    <div class="item2">
                        <div class="section1">
                            <div class="icon up">
                                <i class="fas fa-arrow-up"></i>
                            </div>
                            <div class="text">
                                <div class="title">Self Deposit ING BANK</div>
                                <div class="description">Today, 13:45</div>
                            </div>
                        </div>
                        <div class="section2">
                            <div class="signal positive">+</div>
                            <div class="value">$260.00</div>
                        </div>
                    </div>
                    <div class="item3">
                        <div class="section1">
                            <div class="icon down">
                                <i class="fas fa-arrow-up"></i>
                            </div>
                            <div class="text">
                                <div class="title">Paypal Transfer</div>
                                <div class="description">July 23, 2016</div>
                            </div>
                        </div>
                        <div class="section2">
                            <div class="signal negative">-</div>
                            <div class="value">$840.20</div>
                        </div>
                    </div>
                    <div class="item4">
                        <div class="section1">
                            <div class="icon up">
                                <i class="fas fa-arrow-up"></i>
                            </div>
                            <div class="text">
                                <div class="title">Self Deposit ING BANK</div>
                                <div class="description">Today, 13:45</div>
                            </div>
                        </div>
                        <div class="section2">
                            <div class="signal positive">+</div>
                            <div class="value">$260.00</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

  </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script type="text/javascript" src="js/ajaxcall.js"></script>

<script type="text/javascript">
	$(document).ready(function(){

		$('#attendance').hide();
		$('#wallet').hide();

        $("#profile-btn").css('background-color','blue');
            $("#profile-btn").css('color','white');

		$('#profile-btn').click(function(){
			$('#profile').show();
			$('#attendance').hide();
			$('#wallet').hide();

            $("#profile-btn").css('background-color','blue');
            $("#profile-btn").css('color','white');

            $("#attendance-btn").css('background-color','white');
            $("#attendance-btn").css('color','grey'); 

            $("#wallet-btn").css('background-color','white');
            $("#wallet-btn").css('color','grey');


		});

		$('#attendance-btn').click(function(){
			$('#profile').hide();
			$('#attendance').show();
			$('#wallet').hide();

            $("#profile-btn").css('background-color','white');
            $("#profile-btn").css('color','grey');

            $("#attendance-btn").css('background-color','blue');
            $("#attendance-btn").css('color','white'); 

            $("#wallet-btn").css('background-color','white');
            $("#wallet-btn").css('color','grey');

		});

		$('#wallet-btn').click(function(){
			$('#profile').hide();
			$('#attendance').hide();
			$('#wallet').show();

            $("#profile-btn").css('background-color','white');
            $("#profile-btn").css('color','grey');

            $("#attendance-btn").css('background-color','white');
            $("#attendance-btn").css('color','grey'); 

            $("#wallet-btn").css('background-color','blue');
            $("#wallet-btn").css('color','white');
		});

        $('#profilemenu').hide();
        $('#togglemenu').click(function(){
            $('#profilemenu').toggle();
        });
	});
</script>




</body>
</html>