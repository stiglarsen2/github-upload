<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the
 * installation. You don't have to use the web site, you can
 * copy this file to "wp-config.php" and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'site1' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', '' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         't2Biw;bJNJ/mWk(CAt:a%K,/^>_tV2JPyH@`+E&n}Q<7RAw6}`%#3m:eg+N2T+he' );
define( 'SECURE_AUTH_KEY',  'J6IBtP|CK*gB8oJ]5w^}UfH&j(^Qv#/!v@Q>?^B5R0=c{,-7O~QDxR(rlM=-y0U8' );
define( 'LOGGED_IN_KEY',    '^RC45jCJ^zB+kg+)1@f~0J+f+zuJsLO>y/o0matks3hoP|Rvfzr#x}|VG D,8L_z' );
define( 'NONCE_KEY',        'AFx*2[a`S1.G82{/{(Lx7~c`8Xu(M}n4cpZD Vtmc+Wj:miX #f;!e*4+|b= [~<' );
define( 'AUTH_SALT',        'aKaEfO{rG]+bdSVgxzSJ0OG_dF2R5hic-oRVuV0JG(i^c0w}WXRj/In0rJC!;?K-' );
define( 'SECURE_AUTH_SALT', '#1=)b=Igp~=53k,=4DuK:ja`yVyPg0zB5Z8cgF^(L+v`gq>uSZG7oV=1bZsz)34#' );
define( 'LOGGED_IN_SALT',   '7($p,%y/gji?R)K/fYvZS2}d;:VE!z?@nfxC/a;J(+UB};R-Evu{VuLz:tK p3-7' );
define( 'NONCE_SALT',       'H:WHVA_)rTYjZ7I8/7.{vsabLL_.r?(2EtAFejb8j~[/CYiz)T)m(G|`I#@pOVn(' );

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define( 'WP_DEBUG', false );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once( ABSPATH . 'wp-settings.php' );
