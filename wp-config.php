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
define('DB_NAME', 'nejhudba');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

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
define('AUTH_KEY',         'N8Aj245yybN&Y2r/*YGNo??PXY6Ia!7G&7%[;CSG!?VrxZidF){k@C@}1S3Kr3I(');
define('SECURE_AUTH_KEY',  'd@k1ene[H%[eD.HP+DI:<9sma^sE@6:51z}{Cz0aM=JjG29wu/8lP^W;h~Wflrg+');
define('LOGGED_IN_KEY',    'MPynk<@9#+P?uA<.N!oP]@=|6T iWN|AF3c ?!X-IL_/R)n-WT]^[7#D0_:z4{//');
define('NONCE_KEY',        '2,Np^Lm~&Jg:YI V_gzT-i`xQV04y^Ur>hv=euLw~UV[hlLduoB|:_w;k3R,Cw~J');
define('AUTH_SALT',        '[a]- bU>93<.w.[3XnN5E:6}x&P:U96Y;WW+J/UEFtY|=Kz!|$7+OMZk]1*hr,_<');
define('SECURE_AUTH_SALT', '_P]D,o|wk:ai#%L:efMblJwD*W$#qdp-O1-Iz5gI}RTkTZ@,Dfd^V*?SQ8VDbc+q');
define('LOGGED_IN_SALT',   'u7^!-.n/b.opxcQkQ*vXKlNt911c%@xxnuk5*let}/v<H8D-6MSUK?m=!f5@M,iy');
define('NONCE_SALT',       'y0om]MbYqLp<N522>h?j4vbqVB-k<L4|qJk9={{#[-^NZ}qbxWeF7eZ`W-f6`j~7');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

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
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
# Enable all core updates, including minor and major:
define( 'WP_AUTO_UPDATE_CORE', true );
define( 'DISALLOW_FILE_EDIT', true );
add_filter( 'auto_update_plugin', '__return_true' );
error_reporting(0);
@ini_set(‘display_errors’, 0);