<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, WordPress Language, and ABSPATH. You can find more information
 * by visiting {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'treasureparkcity');

/** MySQL database username */
define('DB_USER', 'treasureparkcity');

/** MySQL database password */
define('DB_PASSWORD', 'fL#lE6Zx14ae');

/** MySQL hostname */
define('DB_HOST', 'treasureparkcity.db.3573874.hostedresource.com');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         ' @^5G-(H4`n;n0qx M)(Iio5<~3MpRNM1Uv+bq?6fuPj)oqJHIT.UKF/3gxZxPB`');
define('SECURE_AUTH_KEY',  'Zj#&uqPOB*y?b1@2)xdpU:z-oySA!fc$S/]#+Sx[DD|9Eia[Z|BeOj?w}?&;za^:');
define('LOGGED_IN_KEY',    '1nGCxtXXfTA={w/w$ZD FW@nj2N<`8Rj!hZn}qsr{$R9Ef>/`l,H XoO*h]L(|.)');
define('NONCE_KEY',        'e~_7Mz-|f6vIDZXS^:b/2^(#Mtk}1htE_3^Y8:}vNdXVv&Y>hr8#?KG4<nvF:2l)');
define('AUTH_SALT',        ':n*-Qv6yd88E54]RId59(E7!ln*--WfB-ge/m&EAv<$.[)<U/gbu-C=Ggg^sK?3d');
define('SECURE_AUTH_SALT', '}<WZK+4r[9[+V)/61-g5J+hTlW#-L20DljS(_%WIW}-+4NUWz3gX=$tCb2}P1.Z?');
define('LOGGED_IN_SALT',   '|[QY<{0K4Bm9Z-X].iHZ 68=2=m_Gz9uhB+y{TRu7wuv MnC3QZIKGd/WQD/~[Kk');
define('NONCE_SALT',       'i1yLM-_lAm%i/|c&-E#}weVI|+|WblJl7+ik,X87hsz-!Qo^PaWz<@5x|g^3Mzvv');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * WordPress Localized Language, defaults to English.
 *
 * Change this to localize WordPress. A corresponding MO file for the chosen
 * language must be installed to wp-content/languages. For example, install
 * de_DE.mo to wp-content/languages and set WPLANG to 'de_DE' to enable German
 * language support.
 */
define('WPLANG', '');

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');

