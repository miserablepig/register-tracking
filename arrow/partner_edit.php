<?php 
	require_once '../admin/config.php';
	admin_required();

	// Get partner data from database
	$pid = (int) $_GET['pid'];

	if($pid == 0) {
		header('location: partner_list.php');
	}
	
	$courseinfo = query("SELECT tbPartners.Partner_ID AS Partner_ID, tbBDMs.BDM_ID, tbPartners.Name AS Partner_Name, tbPartners.Status AS Partner_Status, tbPartners.Website AS Partner_Website, tbPartners.BDM_ID AS Partner_BDM, tbPartners.Note AS Partner_Note FROM tbPartners LEFT JOIN tbBDMs ON tbPartners.BDM_ID = tbBDMs.BDM_ID WHERE tbPartners.Partner_ID = '$pid' LIMIT 1");
	
	// Quickly validate ID by checking if database query successful
	if(empty($courseinfo[0]['Partner_Name'])) {
		echo 'Error - Invalid partner ID.';
		exit;
	}
	
	// Init Variables
	$cf = array();
	$sr = false;
	
	if(isset($_SESSION['cf_returndata'])){
		$cf = $_SESSION['cf_returndata'];
		$sr = true;
	}

	$bdm_options = '';
	$bdms = query("SELECT BDM_ID, Firstname, Surname FROM tbBDMs ORDER BY Surname");

	foreach ($bdms as $row) {
    	$id = $row["BDM_ID"];
	    $bdm = $row["Firstname"]." ".$row["Surname"];

		if ($id == (($sr && !$cf['form_ok']) ? $cf['posted_form_data']['bdm_id'] : $courseinfo[0]['BDM_ID'])) {
	    	$bdm_options .= "<option value='$id' selected='selected'>$bdm</OPTION>";
	    } else {
		    $bdm_options .= "<option value='$id'>$bdm</OPTION>";
	    }
	}
?>

<?php include 'header.php'; ?>
    <!-- MAIN CONTENT -->
	<div class="wrapper on-light"> 
        <div id="contact-form" class="clearfix">
            <h1><?php echo $courseinfo[0]['Partner_Name']; ?> - Edit</h1>
            <div class="inner-dot-separator notopmargin"></div>

            <h2>Please use the form below to edit the selected partner.<span class="ar"><a href="partner_list.php" title="Back"><img src="../img/arrow_left.png" alt="Back"/></a></span></h2>
            <ul id="errors" class="<?php echo ($sr && !$cf['form_ok']) ? 'visible' : ''; ?>">
                <li id="info">There was a problem saving your changes:</li>
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
	            <form method="post" action="partner_process_edit.php">
	            	<input type="hidden" name="partner_id" value="<?php echo $courseinfo[0]['Partner_ID'] ?>">
	            	
	                <label for="partner_name">Partner Name: <span class="required">*</span></label>
	                <input type="text" id="partner_name" name="partner_name" value="<?php echo ($sr && !$cf['form_ok']) ? $cf['posted_form_data']['partner_name'] : $courseinfo[0]['Partner_Name'] ?>" placeholder="Acme Ltd" required autofocus />
	                
	                <label for="partner_status">Status:</label>
	                <input type="text" id="partner_status" name="partner_status" value="<?php echo ($sr && !$cf['form_ok']) ? $cf['posted_form_data']['partner_status'] : $courseinfo[0]['Partner_Status'] ?>" placeholder="Silver" />
	        </div>
            
            <div id="area-right">
	                <label for="partner_website">Website:</label>
	                <input type="text" id="partner_website" name="partner_website" value="<?php echo ($sr && !$cf['form_ok']) ? $cf['posted_form_data']['partner_website'] : $courseinfo[0]['Partner_Website'] ?>" placeholder="www.example.com" />
	                
                	<label for="bdm_id">Business Development Manager: <span class="required">*</span></label>
					<select name="bdm_id" required>Select BDM<?php echo $bdm_options;?></select> 
            </div>
		            <label for="partner_note">Notes:</label>
	                <textarea rows="10" class="memo" type="text" id="partner_note" name="partner_note" placeholder="Notes about this partner" ><?php echo ($sr && !$cf['form_ok']) ? $cf['posted_form_data']['partner_note'] : $courseinfo[0]['Partner_Note'] ?></textarea>
		
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