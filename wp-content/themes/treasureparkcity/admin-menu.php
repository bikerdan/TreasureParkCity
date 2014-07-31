<?php  

// create custom plugin settings menu  
add_action('admin_menu', 'dv_create_menu');  
  
function dv_create_menu() {  
  
    //create new top-level menu  
    add_menu_page('Treasure Park City Sidebar Settings', 'Edit Sidebar', 'administrator', __FILE__, 'dv_settings_page', null);  
  
    //call register settings function  
    add_action( 'admin_init', 'register_mysettings' );  
}  

function register_mysettings() {  
    //register our settings  
    register_setting( 'dv-settings-group', 'dv_event_calendar' );  
    register_setting( 'dv-settings-group', 'dv_newsletter' );  
    register_setting( 'dv-settings-group', 'dv_contact_form' );  
}  

function dv_settings_page() {  
	?>  
	<div class="wrap">  
	<h2>Edit Sidebar Sections</h2>  
	  
	<form method="post" action="options.php">  
	          
	    <?php settings_fields('dv-settings-group'); ?>  
	    <table class="form-table">  
	          
	        <tr valign="top">  
	        <th scope="row">Event Calendar</th>  
	        <td><textarea cols="100" rows="10" name="dv_event_calendar"><?php echo get_option('dv_event_calendar'); ?></textarea></td>  
	        </tr>  
	          
	    </table>  
	      
	    <table class="form-table">  
	          
	        <tr valign="top">  
	        <th scope="row">Newsletter</th>  
	        <td><textarea cols="100" rows="10" name="dv_newsletter"><?php echo get_option('dv_newsletter'); ?></textarea></td>  
	        </tr>  
	          
	    </table>  

	    <table class="form-table">  
	          
	        <tr valign="top">  
	        <th scope="row">Ownership Contact Form</th>  
	        <td><textarea cols="100" rows="10" name="dv_contact_form"><?php echo get_option('dv_contact_form'); ?></textarea></td>  
	        </tr>  
	          
	    </table>  
	      
	    <p class="submit">  
	    <input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" />  
	    </p>  
	  
	</form>  
	</div>  
	<?php 
} 

function dv_edit_newsletter() {  
	?>  
	<div class="wrap">  
	<h2>Edit Sidebar Sections</h2>  
	  
	<form method="post" action="options.php">  
	          
	    <?php settings_fields('dv-settings-group'); ?>  
	    <table class="form-table">  
	          
	        <tr valign="top">  
	        <th scope="row">Event Calendar</th>  
	        <td><textarea cols="100" rows="10" name="dv_event_calendar"><?php echo get_option('dv_event_calendar'); ?></textarea></td>  
	        </tr>  
	          
	    </table>  
	      
	    <table class="form-table">  
	          
	        <tr valign="top">  
	        <th scope="row">Newsletter</th>  
	        <td><textarea cols="100" rows="10" name="dv_newsletter"><?php echo get_option('dv_newsletter'); ?></textarea></td>  
	        </tr>  
	          
	    </table>  
	      
	    <p class="submit">  
	    <input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" />  
	    </p>  
	  
	</form>  
	</div>  
	<?php 
} 
