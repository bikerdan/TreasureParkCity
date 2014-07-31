<?php

add_action( 'after_setup_theme', 'blankslate_setup' );
function blankslate_setup() {
	load_theme_textdomain( 'blankslate', get_template_directory() . '/languages' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'post-thumbnails' );
	global $content_width;
	if ( ! isset( $content_width ) ) $content_width = 640;
	register_nav_menus(
		array( 'main-menu' => __( 'Main Menu', 'blankslate' ) )
	);
}

add_action( 'comment_form_before', 'blankslate_enqueue_comment_reply_script' );
function blankslate_enqueue_comment_reply_script() {
	if ( get_option( 'thread_comments' ) ) { wp_enqueue_script( 'comment-reply' ); }
}

add_filter( 'the_title', 'blankslate_title' );
function blankslate_title( $title ) {
	if ( $title == '' ) {
		return 'Untitled';
	} else {
		return $title;
	}
}

add_filter( 'wp_title', 'blankslate_filter_wp_title' );
function blankslate_filter_wp_title( $title ) {
	return $title . esc_attr( get_bloginfo( 'name' ) );
}

add_filter( 'comment_form_defaults', 'blankslate_comment_form_defaults' );
function blankslate_comment_form_defaults( $args ) {
	$req = get_option( 'require_name_email' );
	$required_text = sprintf( ' ' . __( 'Required fields are marked %s', 'blankslate' ), '<span class="required">*</span>' );
	$args['comment_notes_before'] = '<p class="comment-notes">' . __( 'Your email is kept private.', 'blankslate' ) . ( $req ? $required_text : '' ) . '</p>';
	$args['title_reply'] = __( 'Post a Comment', 'blankslate' );
	$args['title_reply_to'] = __( 'Post a Reply to %s', 'blankslate' );
	return $args;
}

add_action( 'init', 'blankslate_add_shortcodes' );
function blankslate_add_shortcodes() {
	add_shortcode( 'wp_caption', 'fixed_img_caption_shortcode' );
	add_shortcode( 'caption', 'fixed_img_caption_shortcode' );
	add_filter( 'img_caption_shortcode', 'blankslate_img_caption_shortcode_filter', 10, 3 );
	add_filter( 'widget_text', 'do_shortcode' );
}
function blankslate_relative_path($relative_path) {
	return "/wp-content/themes/treasureparkcity/".$relative_path;
}
function blankslate_img_caption_shortcode_filter( $val, $attr, $content = null ) {
	extract( shortcode_atts( array(
				'id' => '',
				'align' => '',
				'width' => '',
				'caption' => ''
			), $attr ) );
	if ( 1 > (int) $width || empty( $caption ) )
		return $val;
	$capid = '';
	if ( $id ) {
		$id = esc_attr( $id );
		$capid = 'id="figcaption_'. $id . '" ';
		$id = 'id="' . $id . '" aria-labelledby="figcaption_' . $id . '" ';
	}
	return '<figure ' . $id . 'class="wp-caption ' . esc_attr( $align ) . '" style="width: '
		. ( 10 + (int) $width ) . 'px">' . do_shortcode( $content ) . '<figcaption ' . $capid
		. 'class="wp-caption-text">' . $caption . '</figcaption></figure>';
}

add_action( 'widgets_init', 'blankslate_widgets_init' );
function blankslate_widgets_init() {
	register_sidebar( array (
			'name' => __( 'Sidebar Widget Area', 'blankslate' ),
			'id' => 'primary-widget-area',
			'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
			'after_widget' => "</li>",
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>',
		) );
}
$preset_widgets = array (
	'primary-aside'  => array( 'search', 'pages', 'categories', 'archives' ),
);
function blankslate_get_page_number() {
	if ( get_query_var( 'paged' ) ) {
		print ' | ' . __( 'Page ' , 'blankslate' ) . get_query_var( 'paged' );
	}
}
function blankslate_catz( $glue ) {
	$current_cat = single_cat_title( '', false );
	$separator = "\n";
	$cats = explode( $separator, get_the_category_list( $separator ) );
	foreach ( $cats as $i => $str ) {
		if ( strstr( $str, ">$current_cat<" ) ) {
			unset( $cats[$i] );
			break;
		}
	}
	if ( empty( $cats ) )
		return false;
	return trim( join( $glue, $cats ) );
}
function blankslate_tag_it( $glue ) {
	$current_tag = single_tag_title( '', '',  false );
	$separator = "\n";
	$tags = explode( $separator, get_the_tag_list( "", "$separator", "" ) );
	foreach ( $tags as $i => $str ) {
		if ( strstr( $str, ">$current_tag<" ) ) {
			unset( $tags[$i] );
			break;
		}
	}
	if ( empty( $tags ) )
		return false;
	return trim( join( $glue, $tags ) );
}
function blankslate_commenter_link() {
	$commenter = get_comment_author_link();
	if ( ereg( '<a[^>]* class=[^>]+>', $commenter ) ) {
		$commenter = preg_replace( '/(<a[^>]* class=[\'"]?)/', '\\1url ' , $commenter );
	} else {
		$commenter = preg_replace( '/(<a )/', '\\1class="url "' , $commenter );
	}
	$avatar_email = get_comment_author_email();
	$avatar = str_replace( "class='avatar", "class='photo avatar", get_avatar( $avatar_email, 80 ) );
	echo $avatar . ' <span class="fn n">' . $commenter . '</span>';
}
function blankslate_custom_comments( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	$GLOBALS['comment_depth'] = $depth;
?>
<li id="comment-<?php comment_ID() ?>" <?php comment_class() ?>>
<div class="comment-author vcard"><?php blankslate_commenter_link() ?></div>
<div class="comment-meta"><?php printf( __( 'Posted %1$s at %2$s', 'blankslate' ), get_comment_date(), get_comment_time() ); ?><span class="meta-sep"> | </span> <a href="#comment-<?php echo get_comment_ID(); ?>" title="<?php _e( 'Permalink to this comment', 'blankslate' ); ?>"><?php _e( 'Permalink', 'blankslate' ); ?></a>
<?php edit_comment_link( __( 'Edit', 'blankslate' ), ' <span class="meta-sep"> | </span> <span class="edit-link">', '</span>' ); ?></div>
<?php if ( $comment->comment_approved == '0' ) { echo '\t\t\t\t\t<span class="unapproved">'; _e( 'Your comment is awaiting moderation.', 'blankslate' ); echo '</span>\n'; } ?>
<div class="comment-content">
<?php comment_text() ?>
</div>
<?php
	if ( $args['type'] == 'all' || get_comment_type() == 'comment' ) :
		comment_reply_link( array_merge( $args, array(
					'reply_text' => __( 'Reply', 'blankslate' ),
					'login_text' => __( 'Login to reply.', 'blankslate' ),
					'depth' => $depth,
					'before' => '<div class="comment-reply-link">',
					'after' => '</div>'
				) ) );
	endif;
?>
<?php }
function blankslate_custom_pings( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
?>
<li id="comment-<?php comment_ID() ?>" <?php comment_class() ?>>
<div class="comment-author"><?php printf( __( 'By %1$s on %2$s at %3$s', 'blankslate' ),
		get_comment_author_link(),
		get_comment_date(),
		get_comment_time() );
	edit_comment_link( __( 'Edit', 'blankslate' ), ' <span class="meta-sep"> | </span> <span class="edit-link">', '</span>' ); ?></div>
<?php if ( $comment->comment_approved == '0' ) { echo '\t\t\t\t\t<span class="unapproved">'; _e( 'Your trackback is awaiting moderation.', 'blankslate' ); echo '</span>\n'; } ?>
<div class="comment-content">
<?php comment_text() ?>
</div>
<?php }

/**
 * CUSTOM INCLUDES
 */
require_once (TEMPLATEPATH . '/admin-menu.php');


/**
 * CUSTOM SHORT CODES 
 */

function get_first_three_images_for_gallery($id) {
	return get_images_for_gallery($id, 3);
}
function get_images_for_gallery($id, $limit=null) {
	global $wpdb;
	$id = mysql_real_escape_string($id);
	$id = "g.gid = '{$id}'";
	$images = $wpdb->get_results( "SELECT p.filename, p.alttext, p.description, g.name, g.path FROM wp_ngg_gallery g INNER JOIN wp_ngg_pictures p ON (g.gid = p.galleryid) WHERE {$id} AND p.exclude = '0' ORDER BY p.sortorder ".($limit?"LIMIT $limit":"") );
	return $images;
}
function get_gallery_preview_image_html($attr, $links=null){
	$link = $attr['link'];
	$rollover = $attr['rollover'];
	$gid = $attr['gallery_id'];
	$id = "gallery-".$gid;
	$images = get_first_three_images_for_gallery($gid);
	$html = <<<HTML
		<style type="text/css">
			#$id {
				margin: auto;
			}
			#$id .gallery-item {
				margin: auto;
				margin-top: 10px;
				text-align: center;
				width: 33%;
			}
			#$id .gallery-caption {
				margin-left: 0;
			}
		</style>
		<div id="$id" class="gallery gallery-size-thumbnail" style="height: 330px; width: 1185px;">
		
HTML;

	$i=0;
	$last = count($images)-1;
	foreach ($images as $img) {
		$xtra = "";
		if ($i == 0) { 
			$xtra = "gallery-item-left";
		} else if ($i == $last) { 
			$xtra = "gallery-item-right";
		}
		$tmp_link = $link;
		if (count($links) > 0){
			$tmp_link = $links[$i];
		}

		$html .= <<<HTML
			<a id="gallery-img-link-{$id}-{$i}" href="{$tmp_link}" title="{$img->alttext}"
				><dl class="gallery-item {$xtra}">
					<dt class="gallery-icon" style="position: relative;">
						<img class='gallery-thumb' style="position: absolute; top: 0px; left: 0px;" width="300" height="300" src="/{$img->path}/thumbs/thumbs_{$img->filename}">
HTML;

		if ($rollover == 'true') {
			$html .= <<<HTML
						<div id="gallery-rollover-$id-$i" class="gallery-thumbnail-rollover" style="display: none; position: absolute; height: 306px; width: 306px;  top: 0px; left: 0px;">
							<div id="gallery-rollover-background-$id-$i" class="gallery-thumbnail-rollover-background" style="position: absolute; height: 306px; width: 306px;  top: 0px; left: 0px;"></div>
							<div class="gallery-thumbnail-rollover-title">{$img->alttext}</div>
							<div class="gallery-thumbnail-rollover-desc">{$img->description}</div>
							<div class="gallery-thumbnail-rollover-link">Explore More ></div>
						</div>
						<script>
							$("#gallery-img-link-{$id}-{$i}").mouseout(function(){
								$("#gallery-rollover-$id-$i").hide();
							});
							$("#gallery-img-link-{$id}-{$i}").mouseover(function(){
								$("#gallery-rollover-$id-$i").show();
							});
						</script>
HTML;
		}

		$html .= <<<HTML
					</dt>
				</dl
			></a>
HTML;
		$i++;
	}
	$html .= <<<HTML
				<br style="clear: both;">
			</div>
HTML;
	return $html;
}

add_shortcode( 'dv_gallery_preview', 'dv_gallery_preview_func' );
function dv_gallery_preview_func( $atts, $content=null ) {
	static $instance = 0;
	$instance++;

	extract( shortcode_atts( array(
		'label' => '',
		'gallery_id' => '',
		'link' => '',
		'rollover' => 'false'
	), $atts ) );

	$links = null;
	if ($content != null) {
		$content = preg_replace('/(^\s*|\s*$|<\/?p\s*\/?>|<br\s*\/?>|\n)/i', '', $content);
		$links = explode(',',$content);
		// THERE IS NOT A SYNTAX ERROR!  SOME PHP VALIDATION WILL SHOW THIS AS INCORRECT!!!
		array_walk($links, function(&$val){
			$val = trim($val);
		});
	} 

	$label = strtoupper($label);
	$html = <<<HTML
		<div class="gallery-sample-container">
			<div class="gallery-sample-header">{$label}</div>
			<div class="gallery-sample-more"><a href="{$link}">more</a></div>
			<hr class="gallery-sample-hr" />

HTML;
	$html .= get_gallery_preview_image_html($atts, $links);
	$html .= '</div>';
	return $html;
}


add_shortcode( 'dv_section', 'dv_section_func' );
function dv_section_func($atts, $content=null) {
	static $instance = 0;
	$instance++;
   	extract( shortcode_atts( array(
      'label' => ''
    ), $atts ));
    $label = strtoupper($label);
    $html = '<div class="page-section">';
    if (strlen($label)) {
    	$html .= <<<HTML
			<div class="page-section-header">{$label}</div>
			<hr class="gallery-sample-hr" />
HTML;
    }
	// strip leading <br> tags and whitespace
	$content = preg_replace('/^\s*(?:<br\s*\/?>\s*)*/i', '', $content);
	$html .= trim($content);
	$html .= '</div>';
	return $html;
}


add_shortcode('dv_map', 'dv_map_func');
function dv_map_func($atts, $content=null) {
	static $instance = 0;
	$instance++;
   	extract( shortcode_atts( array(
      'label' => ''
    ), $atts ));
    $label = strtoupper($label);
    $html = '<div style="width:1100px; margin: 50px auto 10px auto;"><div class="page-section">';
    if (strlen($label)) {
    	$html .= <<<HTML
			<div class="page-section-header">{$label}</div>
			<hr class="gallery-sample-hr" />
HTML;
    }
	// strip leading <br> tags and whitespace
	$content = preg_replace('/^\s*(?:<br\s*\/?>\s*)*/i', '', $content);
	$content = <<<CONTENT
		<center>
			<iframe width="1092" height="750" class="gallery-thumb" frameborder="0" scrolling="no" marginheight="25" marginwidth="0" 
				src="http://maps.google.com/maps?f=q&amp;source=s_q&amp;hl=en&amp;geocode=&amp;q=7720+Royal+Street+East,+Park+City,+UT+84060&amp;aq=&amp;sll=40.622618,-111.48695&amp;sspn=0.014625,0.032015&amp;gl=us&amp;ie=UTF8&amp;hq=&amp;hnear=7720+Royal+St,+Park+City,+Summit,+Utah+84060&amp;t=m&amp;z=14&amp;ll=40.622618,-111.48695&amp;output=embed"></iframe>
		</center>
		<div style="margin-top:7px;">
			$content
		</div>
CONTENT;
	$html .= trim($content);
	$html .= '</div></div>';
	return $html;
}


add_shortcode('dv_gallery', 'dv_gallery_func');
function dv_gallery_func($atts, $content) {
	extract( shortcode_atts( array(
      'label' => '',
      'gallery_id' => ''
    ), $atts ));
	$id = "gallery-".$gallery_id;
	$images = get_images_for_gallery($gallery_id);
	$html = '<div style="width:1100px; margin: 50px auto 10px auto;"><div class="page-section">';
	if (strlen($label)) {
    	$html .= <<<HTML
			<div class="page-section-header">{$label}</div>
			<hr class="gallery-sample-hr" />
HTML;
    }
	$html .= "<div id='{$id}' class='galleria'>";
	foreach ($images as $img) {
		$html .= <<<HTML
			<img alt="test1" src="/{$img->path}/{$img->filename}" />
HTML;
	}
	$html .= <<<HTML
		</div></div></div>
		<script>
		    Galleria.run('#{$id}');
		</script>
HTML;
	return $html;
}


add_shortcode('dv_event', 'dv_event_func');
function dv_event_func($atts, $content) {
	extract( shortcode_atts( array(
      'month' => '',
      'date' => ''
    ), $atts ));

	$month = strtoupper($month);
	$ord_suffix = strtoupper(date('S', strtotime("$month-$date-".date('Y'))));
	$content = preg_replace('/^\s*(?:<br\s*\/?>\s*)*/i', '', $content);

    $html = <<<HTML
    	<div class="event-section">
		    <div class="event-section-header">
		    	{$month}
		    </div>
			<div class="event-date">
				{$date}<span class="ord-suffix">$ord_suffix</span>
			</div><div class="content">{$content}</div>
		</div>
HTML;
	return $html;
}

add_shortcode('dv_contact_ownership_form', 'dv_contact_ownership_func');
function dv_contact_ownership_func() {
	// HANDLE FORM SUBMISSION
	if (!empty($_REQUEST['sidebar_contact_submit'])) {
		$to = 'test@treasureparkcity.com';
		$subject = "Message from Treasure Park City Ownership Form";
		$name = $_REQUEST['full_name'];
		$phone = $_REQUEST['phone'];
		$email = $_REQUEST['email'];
		$headers = array(
			"From: $name <$email>",
			"Cc: jbennett@treasureparkcity.com"
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

	// BUILD THE FORM
	$the_permalink = get_permalink();
	$dv_contact_form = get_option('dv_contact_form');
	$html = <<<HTML
    	<div id="events" class="sidebar-section">
			<a href="/contact-us-ownership">
			<div class="sidebar-section-title">OWNERSHIP INQUIRY</div>
			</a>
			<div class="sidebar-section-body">
				<div class="sidebar_contact_box">
					<form name="sidebar_contact_us" action="$the_permalink" method='post'>
						<div class="sidebar_contact_description">{$dv_contact_form}</div>
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
		</div>

		<script>
			var dv_sidebar_message = '{$dv_sidebar_message}';
			if (dv_sidebar_message) {
				alert(dv_sidebar_message);
			}
		</script>
HTML;
	return $html;
}
