<?
	// HANDLE FORM SUBMISSION
	if (!empty($_REQUEST['sidebar_contact_submit'])) {
		$to = 'mike@lormikpromotions.com';
		$subject = "Message from TreasureParkCity Quick Contact";
		$name = $_REQUEST['full_name'];
		$phone = $_REQUEST['phone'];
		$email = $_REQUEST['email'];
		$headers = array(
			"From: $name <$email>"
		);
		$message = <<<MESSAGE
		Ownership Inquiry Form Submission:\n
			From: $name <$email>\n
			Phone: $phone\n
MESSAGE;
		$result = wp_mail( $to, $subject, $message, $headers);
		if ($result) {
			$dv_sidebar_message = "Message successfully sent!";
		}
	}
?>

<div id="events" class="sidebar-section">
	<a href="/contact-us-ownership">
	<div class="sidebar-section-title">OWNERSHIP INQUIRY</div>
	<div class="sidebar-section-body">
		<div class="sidebar_contact_box">
			<form name="sidebar_contact_us" action="<?php the_permalink(); ?>" method='post'>
				<div class="sidebar_contact_description"><?php echo get_option('dv_contact_form'); ?></div>
				<div class="sidebar_contact_label">FULL NAME:</div>
				<div class="sidebar_contact_field"><input type="text" name="full_name"/></div>
				<div class="sidebar_contact_label">PHONE NUMBER:</div>
				<div class="sidebar_contact_field"><input type="text" name="phone"/></div>
				<div class="sidebar_contact_label">EMAIL ADDRESS:</div>
				<div class="sidebar_contact_field"><input type="text" name="email"/></div>
				<input class="sidebar_contact_submit" name="sidebar_contact_submit" type="submit" />
			</form>
		</div>
	</div>
	</a>
</div>

<script>
	var dv_sidebar_message = '<? echo $dv_sidebar_message; ?>';
	if (dv_sidebar_message) {
		alert(dv_sidebar_message);
	}
</script>