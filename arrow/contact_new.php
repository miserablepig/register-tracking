<?php 
	require_once '../admin/config.php';
	login_required();
	
	// Init Variables
	$cf = array();
	$sr = false;
	
	if(isset($_SESSION['cf_returndata'])){
		$cf = $_SESSION['cf_returndata'];
		$sr = true;
	}
	
	$partner_options = '';
	$partners = query("SELECT Partner_ID, Name FROM tbPartners ORDER BY Name");

	foreach ($partners as $row) {
    	$id = $row["Partner_ID"];
	    $partner = $row["Name"];

		$partner_options .= "<option value='$id'>$partner</OPTION>";
	}
?>

<?php include 'header.php'; ?>

    <!-- MAIN CONTENT -->
	<div class="wrapper on-light"> 
        <div id="contact-form" class="clearfix">
            <h1>New Contact</h1>
            <div class="inner-dot-separator notopmargin"></div>
            <h2>Please use the form below to create your new contact.<span class="ar"><a href="contact_list.php" title="Back"><img src="../img/arrow_left.png" alt="Back"/></a></span></h2>
            <ul id="errors" class="<?php echo ($sr && !$cf['form_ok']) ? 'visible' : ''; ?>">
                <li id="info">There was a problem creating your contact:</li>
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
            <p id="success" class="<?php echo ($sr && $cf['form_ok']) ? 'visible' : ''; ?>">Your contact has been created!</p>
 
	 		<div id="area-left">
	            <form method="post" action="contact_process_new.php">	            	
	                <label for="contact_firstname">Firstname: <span class="required">*</span></label>
	                <input type="text" id="contact_firstname" name="contact_firstname" value="<?php echo ($sr && !$cf['form_ok']) ? $cf['posted_form_data']['contact_firstname'] : '' ?>" placeholder="John" required autofocus />
	                
	                <label for="contact_surname">Surname: <span class="required">*</span></label>
	                <input type="text" id="contact_surname" name="contact_surname" value="<?php echo ($sr && !$cf['form_ok']) ? $cf['posted_form_data']['contact_surname'] : '' ?>" placeholder="Smith" required />

                   	<label for="contact_mobile">Mobile:</label>
	                <input type="text" id="contact_mobile" name="contact_mobile" value="<?php echo ($sr && !$cf['form_ok']) ? $cf['posted_form_data']['contact_mobile'] : '' ?>" placeholder="01234 567890" />

	        </div>
            
            <div id="area-right">
                	<label for="partner_id">Partner: <span class="required">*</span></label>
					<select name="partner_id" required>Select Partner<?php echo $partner_options;?></select> 

					<label for="contact_email">Email:</label>
	                <input type="text" id="contact_email" name="contact_email" value="<?php echo ($sr && !$cf['form_ok']) ? $cf['posted_form_data']['contact_email'] : '' ?>" placeholder="john.smith@example.com" />

					<label for="contact_role">Role:</label>
	                <input type="text" id="contact_role" name="contact_role" value="<?php echo ($sr && !$cf['form_ok']) ? $cf['posted_form_data']['contact_role'] : '' ?>" placeholder="Solutions Consultant" />
            </div>
					<label for="contact_note">Notes:</label>
	                <textarea rows="5" class="memo" type="text" id="contact_note" name="contact_note" value="<?php echo ($sr && !$cf['form_ok']) ? $cf['posted_form_data']['contact_note'] : '' ?>" placeholder="Notes about this contact"></textarea>

		            <div class="clear"></div>
		            <div class="inner-dot-separator"></div>
		            <input type="submit" value="Save" id="submit-button" />
		            <p id="req-field-desc"><span class="required">*</span> indicates a required field</p>
	            </form>
	            <?php unset($_SESSION['cf_returndata']); ?>
		</div>
	    <div class="one left">
	    	<h4>Information Accuracy</h4>
	    	<p>All changes are tracked and your user details are stored. Please do your best to ensure the information you enter is accurate and up-to-date. Should you have any doubts regarding the accuracy of your information, please contact the Arrow Business Development Manager aligned to the relevant partner.</p>
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