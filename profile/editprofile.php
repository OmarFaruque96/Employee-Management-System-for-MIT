<?php include '../inc/db.php'; ?>
<?php include '../inc/functions.php'; ?>
<?php //session_start();?>
<!DOCTYPE html>
<html>
<head>
	<title>Edit Profile</title>
	<meta charset="UTF-8">
  	<meta name="viewport" content="width=device-width, initial-scale=1.0">
  	<script src="https://cdn.tailwindcss.com"></script>
</head>
<body>

	<!--
  This example requires some changes to your config:
  
  ```
  // tailwind.config.js
  module.exports = {
    // ...
    plugins: [
      // ...
      require('@tailwindcss/forms'),
    ],
  }
  ```
-->

<?php 
	
	if(isset($_GET['id'])){
		$editid = $_GET['id'];

		$editprofile = read_data('users', '*', 'ID='.$editid);

		foreach ($editprofile as $data) {
			$username 	= $data['username'];
			$email 		= $data['email'];
			$password 	= $data['password'];
			$gender 	= $data['gender'];
			$phone 		= $data['phone'];
			$address 	= $data['address'];
			$dob 		= $data['dob'];
			$emergency_content = $data['emergency_content'];
			$photo 		= $data['photo'];
			$biodata 	= $data['biodata'];
			}
	
		?>

<div class="md:w-1/2 w-full mx-auto my-24 md:p-0 p-4">
	<h2 class="mb-6 md:text-3xl text-xl font-semibold">>> Please edit your information from here</h2>
	<form method="POST" action="update.php" enctype="multipart/form-data">
	  <div class="space-y-12">
	    <div class="border-b border-gray-900/10 pb-12">
	      <h2 class="text-base font-semibold leading-7 text-gray-900">Profile</h2>
	      <p class="mt-1 text-sm leading-6 text-gray-600">This information will be displayed publicly so be careful what you share.</p>

	      <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
	        <div class="sm:col-span-4">
	          <label for="username" class="block text-sm font-medium leading-6 text-gray-900">Username</label>
	          <div class="mt-2">
	            <div class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">
	              <span class="flex select-none items-center pl-3 text-gray-500 sm:text-sm">workcation.com/</span>
	              <input type="text" name="username" id="username" autocomplete="username" class="block flex-1 border-0 bg-transparent py-1.5 pl-1 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6" placeholder="janesmith" value="<?php echo $data['username'];?>">
	            </div>
	          </div>
	        </div>

	        <div class="col-span-full">
	        	<fieldset>
	          <legend class="text-sm font-semibold leading-6 text-gray-900">Gender</legend>
	          <div class="mt-6 space-y-6">
	            <div class="flex items-center gap-x-3">
	              <input id="push-everything" name="gender" value="Male" type="radio" class="h-4 w-4 border-gray-300 text-indigo-600 focus:ring-indigo-600" <?php if($gender == 'Male') echo 'checked';?>>
	              <label for="push-everything" class="block text-sm font-medium leading-6 text-gray-900">Male</label>
	            </div>
	            <div class="flex items-center gap-x-3">
	              <input id="push" name="gender" value="Female" type="radio" class="h-4 w-4 border-gray-300 text-indigo-600 focus:ring-indigo-600" <?php if($gender == 'Female') echo 'checked';?>>
	              <label for="push" class="block text-sm font-medium leading-6 text-gray-900">Female</label>
	            </div>
	            
	          </div>
	        </fieldset>
	        </div>

	        <div class="col-span-full">
	          <label for="about" class="block text-sm font-medium leading-6 text-gray-900">About</label>
	          <div class="mt-2">
	            <textarea id="about" name="about" rows="3" class="pl-5 block w-full rounded-md border-0 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:py-1.5 sm:text-sm sm:leading-6"><?php echo $address;?></textarea>
	          </div>
	          <p class="mt-3 text-sm leading-6 text-gray-600">Write a few sentences about yourself.</p>
	        </div>

	        <div class="col-span-full">
	          <label for="photo" class="block text-sm font-medium leading-6 text-gray-900">Photo</label>
	          <div class="mt-2 flex items-center gap-x-3">
	            <!-- <svg class="h-12 w-12 text-gray-300" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
	              <path fill-rule="evenodd" d="M18.685 19.097A9.723 9.723 0 0021.75 12c0-5.385-4.365-9.75-9.75-9.75S2.25 6.615 2.25 12a9.723 9.723 0 003.065 7.097A9.716 9.716 0 0012 21.75a9.716 9.716 0 006.685-2.653zm-12.54-1.285A7.486 7.486 0 0112 15a7.486 7.486 0 015.855 2.812A8.224 8.224 0 0112 20.25a8.224 8.224 0 01-5.855-2.438zM15.75 9a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0z" clip-rule="evenodd" />
	            </svg> -->
	            <img src="../images/users/<?php echo $photo;?>" class="w-10 h-10 rounded-full" />
	            <button type="button" class="rounded-md bg-white px-2.5 py-1.5 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50">Change</button>
	          </div>
	        </div>

	        <div class="col-span-full">
	          <label for="cover-photo" class="block text-sm font-medium leading-6 text-gray-900">Cover photo</label>
	          <div class="mt-2 flex justify-center rounded-lg border border-dashed border-gray-900/25 px-6 py-10">
	            <div class="text-center">
	              <svg class="mx-auto h-12 w-12 text-gray-300" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
	                <path fill-rule="evenodd" d="M1.5 6a2.25 2.25 0 012.25-2.25h16.5A2.25 2.25 0 0122.5 6v12a2.25 2.25 0 01-2.25 2.25H3.75A2.25 2.25 0 011.5 18V6zM3 16.06V18c0 .414.336.75.75.75h16.5A.75.75 0 0021 18v-1.94l-2.69-2.689a1.5 1.5 0 00-2.12 0l-.88.879.97.97a.75.75 0 11-1.06 1.06l-5.16-5.159a1.5 1.5 0 00-2.12 0L3 16.061zm10.125-7.81a1.125 1.125 0 112.25 0 1.125 1.125 0 01-2.25 0z" clip-rule="evenodd" />
	              </svg>
	              <div class="mt-4 flex text-sm leading-6 text-gray-600">
	                <label for="file-upload" class="relative cursor-pointer rounded-md bg-white font-semibold text-indigo-600 focus-within:outline-none focus-within:ring-2 focus-within:ring-indigo-600 focus-within:ring-offset-2 hover:text-indigo-500">
	                  <span>Upload a file</span>
	                  <input id="file-upload" name="image" type="file" class="sr-only">
	                </label>
	                <p class="pl-1">or drag and drop</p>
	              </div>
	              <p class="text-xs leading-5 text-gray-600">PNG, JPG up to 1MB</p>
	            </div>
	          </div>
	        </div>
	      </div>
	    </div>

	    <div class="border-b border-gray-900/10 pb-12">
	      <h2 class="text-base font-semibold leading-7 text-gray-900">Personal Information</h2>
	      <p class="mt-1 text-sm leading-6 text-gray-600">Use a permanent address where you can receive mail.</p>

	      <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
	        <!-- <div class="sm:col-span-3">
	          <label for="first-name" class="block text-sm font-medium leading-6 text-gray-900">First name</label>
	          <div class="mt-2">
	            <input type="text" name="first-name" id="first-name" autocomplete="given-name" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
	          </div>
	        </div>

	        <div class="sm:col-span-3">
	          <label for="last-name" class="block text-sm font-medium leading-6 text-gray-900">Last name</label>
	          <div class="mt-2">
	            <input type="text" name="last-name" id="last-name" autocomplete="family-name" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
	          </div>
	        </div> -->

	        <div class="sm:col-span-4">
	          <label for="email" class="block text-sm font-medium leading-6 text-gray-900">Email address</label>
	          <div class="mt-2">
	            <input id="email" name="email" type="email" autocomplete="email" class="pl-4 block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" value="<?php echo $email;?>" disabled>
	          </div>
	        </div>

	        <div class="sm:col-span-4">
	          <label for="email" class="block text-sm font-medium leading-6 text-gray-900">Set New Password</label>
	          <div class="mt-2">
	            <input id="password" name="password" type="password" autocomplete="email" class="pl-4 block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" placeholder="Minimum 8 letters long!">
	          </div>
	        </div>

	        <div class="sm:col-span-3">
	          <label for="country" class="block text-sm font-medium leading-6 text-gray-900">Country</label>
	          <div class="mt-2">
	            <select id="country" name="country" autocomplete="country-name" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
	              <option>Bangladesh</option>
	              <!-- <option>Canada</option>
	              <option>Mexico</option> -->
	            </select>
	          </div>
	        </div>

	        <div class="col-span-full">
	          <label for="street-address" class="block text-sm font-medium leading-6 text-gray-900">Biodata</label>
	          <div class="mt-2">
	            <textarea id="about" name="biodata" rows="3" class="pl-5 block w-full rounded-md border-0 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:py-1.5 sm:text-sm sm:leading-6"><?php echo $biodata;?></textarea>
	          </div>
	        </div>

	        <div class="sm:col-span-2 sm:col-start-1">
	          <label for="phone" class="block text-sm font-medium leading-6 text-gray-900">Phone</label>
	          <div class="mt-2">
	            <input type="text" name="phone" id="phone" autocomplete="address-level2" class="pl-2 block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" value="<?php echo $phone;?>">
	          </div>
	        </div>

	        <div class="sm:col-span-2">
	          <label for="emergency" class="block text-sm font-medium leading-6 text-gray-900">Emergency Contact</label>
	          <div class="mt-2">
	            <input type="text" name="emergency" id="emergency" autocomplete="address-level1" class="pl-2 block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" value="<?php echo $emergency_content;?>">
	          </div>
	        </div>

	        <div class="sm:col-span-2">
	          <label for="dob" class="block text-sm font-medium leading-6 text-gray-900">Date of Birth</label>
	          <div class="mt-2">
	            <input type="date" name="dob" id="dob" autocomplete="postal-code" class="pl-2 block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" value="<?php echo $dob;?>">
	          </div>
	        </div>
	      </div>
	    </div>

	    <!-- <div class="border-b border-gray-900/10 pb-12">
	      <h2 class="text-base font-semibold leading-7 text-gray-900">Notifications</h2>
	      <p class="mt-1 text-sm leading-6 text-gray-600">We'll always let you know about important changes, but you pick what else you want to hear about.</p>

	      <div class="mt-10 space-y-10">
	        <fieldset>
	          <legend class="text-sm font-semibold leading-6 text-gray-900">By Email</legend>
	          <div class="mt-6 space-y-6">
	            <div class="relative flex gap-x-3">
	              <div class="flex h-6 items-center">
	                <input id="comments" name="comments" type="checkbox" class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-600">
	              </div>
	              <div class="text-sm leading-6">
	                <label for="comments" class="font-medium text-gray-900">Comments</label>
	                <p class="text-gray-500">Get notified when someones posts a comment on a posting.</p>
	              </div>
	            </div>
	            <div class="relative flex gap-x-3">
	              <div class="flex h-6 items-center">
	                <input id="candidates" name="candidates" type="checkbox" class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-600">
	              </div>
	              <div class="text-sm leading-6">
	                <label for="candidates" class="font-medium text-gray-900">Candidates</label>
	                <p class="text-gray-500">Get notified when a candidate applies for a job.</p>
	              </div>
	            </div>
	            <div class="relative flex gap-x-3">
	              <div class="flex h-6 items-center">
	                <input id="offers" name="offers" type="checkbox" class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-600">
	              </div>
	              <div class="text-sm leading-6">
	                <label for="offers" class="font-medium text-gray-900">Offers</label>
	                <p class="text-gray-500">Get notified when a candidate accepts or rejects an offer.</p>
	              </div>
	            </div>
	          </div>
	        </fieldset>
	        <fieldset>
	          <legend class="text-sm font-semibold leading-6 text-gray-900">Push Notifications</legend>
	          <p class="mt-1 text-sm leading-6 text-gray-600">These are delivered via SMS to your mobile phone.</p>
	          <div class="mt-6 space-y-6">
	            <div class="flex items-center gap-x-3">
	              <input id="push-everything" name="push-notifications" type="radio" class="h-4 w-4 border-gray-300 text-indigo-600 focus:ring-indigo-600">
	              <label for="push-everything" class="block text-sm font-medium leading-6 text-gray-900">Everything</label>
	            </div>
	            <div class="flex items-center gap-x-3">
	              <input id="push-email" name="push-notifications" type="radio" class="h-4 w-4 border-gray-300 text-indigo-600 focus:ring-indigo-600">
	              <label for="push-email" class="block text-sm font-medium leading-6 text-gray-900">Same as email</label>
	            </div>
	            <div class="flex items-center gap-x-3">
	              <input id="push-nothing" name="push-notifications" type="radio" class="h-4 w-4 border-gray-300 text-indigo-600 focus:ring-indigo-600">
	              <label for="push-nothing" class="block text-sm font-medium leading-6 text-gray-900">No push notifications</label>
	            </div>
	          </div>
	        </fieldset>
	      </div>
	    </div> --> 
	  </div>

	  <div class="mt-6 flex items-center justify-end gap-x-6">
	  	<input type="hidden" value="<?php echo $editid;?>" name="editid">
	    <a type="button" href="../profile.php?action=viewprofile" class="text-sm font-semibold leading-6 text-gray-900">Cancel</a>
	    <button type="submit" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600" name="update">Update</button>
	  </div>
	</form>
</div>
<?php 
}

?>


</body>
</html>