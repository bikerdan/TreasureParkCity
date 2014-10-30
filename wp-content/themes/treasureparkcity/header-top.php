		<header>
			<div id="header_top">
				<img id="header-logo" src="<?php echo blankslate_relative_path("img/header.png"); ?>" usemap="social" />
				<nav id="site-navigation" class="main-navigation" role="navigation">
					<?php wp_nav_menu( array( 'menu_class' => 'nav-menu', 'link_after' => '<li class="menu-divider"></li>' ) ); ?>
				</nav>
                <map id="social-map" name="social">
                    <area shape="rect" coords="0,0,275,141" href="http://www.treasureparkcity.net">
                    <area shape="rect" coords="1170,100,1195,141" href="https://www.facebook.com/pages/TreasureParkCity/226369795036?ref=ts" target="_blank" alt="Facebook">
                    <area shape="rect" coords="1200,100,1230,141" href="https://twitter.com/TreasureParkCity" target="_blank" alt="Twitter">
                    <area shape="rect" coords="1235,100,1275,141" href="mailto:info@treasureparkcity.com">
                </map>
			</div>
		</header>