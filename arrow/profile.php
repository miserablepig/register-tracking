<?php 
	require_once '../admin/config.php';
	login_required();

	// Get partner data from database
	$uid = (int) $_GET['uid'];

	if($uid !== $_SESSION['user_id']) {
		header('location: index.php');
	}

	$courseinfo = query("SELECT UserID, Username, Password, Fullname, Email FROM tbUsers WHERE UserID = '$uid' LIMIT 1");
	
	// Quickly validate ID by checking if database query successful
	if(empty($courseinfo[0]['Username'])) {
		echo 'Error - Invalid user ID.';
		exit;
	}
?>

<?php include 'header.php'; ?>
    <!-- MAIN CONTENT -->
	<div class="wrapper on-light"> 
        <div id="contact-form" class="clearfix">
            <h1><?php echo $courseinfo[0]['Fullname']; ?> - Profile Edit</h1>
            <div class="inner-dot-separator notopmargin"></div>

            <h2>Please use the form below to edit your profile.</h2>
            <ul id="errors" class="<?php echo ($sr && !$cf['form_ok']) ? 'visible' : ''; ?>">
                <li id="info">There was a problem saving your profile:</li>
                <?php 
				if(isset($cf['errors']) && count($cf['errors']) > 0) :
					foreach($cf['errors'] as $error) :
				?>
                <li><?php echo $error ?></li>
                <?php
					endforeach;
				endif;
				?>
            </ul>

            <p id="success" class="<?php echo ($sr && $cf['form_ok']) ? 'visible' : ''; ?>">Your changes have been saved!</p>

            <div id="area-left">
	            <form method="post" action="profile_process_edit.php">
					<input type="hidden" name="user_id" value="<?php echo $courseinfo[0]['UserID'] ?>">
					<input type="hidden" name="old_password" value="<?php echo $courseinfo[0]['Password'] ?>">
	            	
	                <label for="fullname">Fullname:</label>
	                <input type="text" disabled id="fullname" name="fullname" value="<?php echo ($sr && !$cf['form_ok']) ? $cf['posted_form_data']['fullname'] : $courseinfo[0]['Fullname'] ?>" autofocus />
	                
					<label for="password">Password:</label>
	                <input type="password" id="password" name="password" placeholder="Enter your new password here" required />
	        </div>
            
            <div id="area-right">
					<label for="email">Email:</label>
	                <input type="text" disabled id="email" name="email" value="<?php echo ($sr && !$cf['form_ok']) ? $cf['posted_form_data']['email'] : $courseinfo[0]['Email'] ?>" placeholder="john.smith@example.com" />

					<label for="repassword">Re-type Password:</label>
	                <input type="password" id="repassword" name="repassword" placeholder="Please re-type your password" required />
            </div>
		            <div class="clear"></div>
		            <div class="inner-dot-separator"></div>
		            <input type="submit" value="Save" id="submit-button" />
		            <p id="req-field-desc"><span class="required">*</span> indicates a required field</p>
	            </form>
	            <?php unset($_SESSION['cf_returndata']); ?>
		</div>
    </div>


	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.5.1/jquery.min.js"></script>
	<script>!window.jQuery && document.write(unescape('%3Cscript src="../js/libs/jquery-1.5.1.min.js"%3E%3C/script%3E'))</script>
<!--
	<script src="../js/plugins.js"></script>
	<script src="../js/script.js"></script>
-->
	
	
	
	<!--[if lt IE 7 ]>
	<script src="../js/libs/dd_belatedpng.js"></script>
	<script> DD_belatedPNG.fix('img, .png_bg');</script>
	<![endif]-->
</body>
</html>