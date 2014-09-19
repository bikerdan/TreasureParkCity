<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta http-equiv="content-type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
	<meta name="viewport" content="width=1280" />
	<title><?php wp_title(' | ', true, 'right'); ?></title>
    <link href="<?php echo blankslate_relative_path("bootstrap/css/bootstrap.css"); ?>" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_uri(); ?>" />
	<link rel="icon" type="image/png" href="/wp-content/themes/treasureparkcity/favicon.png">
	<script src="<?php echo blankslate_relative_path("js/jquery-1.9.1.min.js"); ?>"></script>
	<script src="<?php echo blankslate_relative_path("js/jquery.slides.min.js"); ?>"></script>
	<script src="<?php echo blankslate_relative_path("js/galleria-1.2.9.min.js"); ?>"></script>
	<script>Galleria.loadTheme('/wp-content/themes/treasureparkcity/js/themes/treasureparkcity/galleria.classic.min.js');</script>
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
	<div id="wrapper">
		<?php include("header-top.php"); ?>
		<?php include("header-slideshow.php"); ?>