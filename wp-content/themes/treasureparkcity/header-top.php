		<header>
			<div id="header_top">
				<a href="<?php echo home_url(); ?>"><img id="header-logo" src="<?php echo blankslate_relative_path("img/header_logo.png"); ?>" /></a>
                <div id="header_title">Welcome to Treasure Park City</div>
                <div id="header_subtitle">Developed by MPE Incorporated</div>
				<nav id="site-navigation" class="main-navigation" role="navigation">
					<?php wp_nav_menu( array( 'menu_class' => 'nav-menu', 'link_after' => '<li class="menu-divider"></li>' ) ); ?>
				</nav>
				<img id="social-img" src="<?php echo blankslate_relative_path("img/social_links.png"); ?>" height="37" width="138" alt="Contact Us" usemap="#social">
				<map id="social-map" name="social">
					<area shape="rect" coords="55,0,32,38" href="https://www.facebook.com/pages/TreasureParkCity/226369795036?ref=ts" target="_blank" alt="Facebook">
					<area shape="rect" coords="70,0,94,38" href="https://twitter.com/TreasureParkCity" target="_blank" alt="Twitter">
					<area shape="rect" coords="96,0,138,38" href="contact">
				</map>
			</div>
		</header>