		<div id="links">
			<a href="/the-club">The Club</a>
			<a href="/residences">Residences</a>
			<a href="/ownership">Ownership</a>
			<a href="/amenities">Amenities</a>
			<a href="/galleries">Galleries</a>
			<a href="/location">Location</a>
			<a href="/residents-gallery">Our Owners</a>
			<a href="/contact">Contact</a>
		</div>
		<?php
			// HANDLE FORM SUBMISSION
			if (!empty($_REQUEST['sidebar_newsletter_submit'])) {
				$to = 'test@treasureparkcity.com';
				$subject = "Message from Treasure Park City Newsletter Sidebar Form";
				$name = $_REQUEST['full_name'];
				$phone = $_REQUEST['phone'];
				$email = $_REQUEST['email'];
				$headers = array(
					"From: $name <$email>",
					"Cc: jbennett@tresureparkcity.com"
				);
				$message = <<<MESSAGE
					Newsletter request form submission:\n
						From: $name <$email>\n
						Phone: $phone\n
MESSAGE;
				$result = wp_mail( $to, $subject, $message, $headers);
				if ($result) {
					$dv_newsletter_sidebar_message = "Message successfully sent!";
				}
			}
		?>
		<div id="events" class="sidebar-section">
			<a href="/newsletter">
				<div class="sidebar-section-title">NEWSLETTER</div>
			</a>
			<div class="sidebar-section-body">
				<div class="sidebar_newsletter_box">
					<form name="sidebar_newsletter" action="<?php the_permalink(); ?>" method='post'>
						<div class="sidebar_newsletter_description"><?php echo get_option('dv_newsletter'); ?></div>
						<div class="sidebar_newsletter_label">FULL NAME:</div>
						<div class="sidebar_newsletter_field"><input type="text" name="full_name"/></div>
						<div class="sidebar_newsletter_label">PHONE NUMBER:</div>
						<div class="sidebar_newsletter_field"><input type="text" name="phone"/></div>
						<div class="sidebar_newsletter_label">EMAIL ADDRESS:</div>
						<div class="sidebar_newsletter_field"><input type="text" name="email"/></div>
						<input class="sidebar_newsletter_submit" name="sidebar_newsletter_submit" type="submit" />
					</form>
				</div>
			</div>
		</div>
		<script>
			var dv_newsletter_sidebar_message = '<?php echo $dv_newsletter_sidebar_message ?>';
			if (dv_newsletter_sidebar_message) {
				alert(dv_newsletter_sidebar_message);
			}
		</script>


		<!--<div id="events" class="sidebar-section">
			<a href="/events-calendar">
				<div class="sidebar-section-title">EVENTS CALENDAR</div>
				<div class="sidebar-section-body"><?php echo get_option('dv_event_calendar'); ?></div>
			</a>
		</div>-->
		<? echo do_shortcode('[dv_contact_ownership_form]'); ?>
		<? //include(get_template_directory()."/form-contact-ownership.php"); ?>