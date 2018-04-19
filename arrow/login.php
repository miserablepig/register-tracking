<?php
require_once '../admin/config.php';
if(logged_in()) {header('Location: partner_list.php');}

if($_POST && (!empty($_POST['username'])) && (!empty($_POST['password']))) {

	validate_user($_POST['username'], $_POST['password']);
}


?>

<?php include 'header.php'; ?>

    <!-- MAIN CONTENT -->
	<div class="wrapper on-light">	
	        <div id="contact-form" class="clearfix">
	            <h1>Restricted Access</h1>
            <div class="inner-dot-separator notopmargin"></div>

	            <form method="post" action="login.php">
	                <label for="username">Username: <span class="required">*</span></label>
	                <input type="text" id="username" name="username" value="" required autofocus />
	                
	                <label for="password">Password: <span class="required">*</span></label>
	                <input type="password" id="password" name="password" value="" required />
	     
	                
            <div class="inner-dot-separator"></div>
	                <input type="submit" value="Login" id="submit-button" />
	                <p id="req-field-desc"><span class="required">*</span> indicates a required field</p>
	            </form>
	        </div>
    <div class="clear"></div>
    <div class="one left">
	   	<h4>Authorised Access Only</h4>
	   	<p>Access to this system is strictly prohibited, and is available to members of Arrow ECS or NetApp only! Your IP address has been logged, and any unauthorised entry will face prosecution. Should you be a member of Arrow ECS or NetApp and require access to this system, please email stuart.harrison@arrowecs.co.uk.</p>
	</div>
	</div>

    <!-- END MAIN CONTENT -->
<?php include 'footer.php'; ?>
    


