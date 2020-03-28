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
define('DB_NAME', '');

/** MySQL database username */
define('DB_USER', '');

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
define('AUTH_KEY',         'sH*-4agu*P6e7jO@(z~AUn{JC2gAL$Z5GM8Go>wn<.G*{/NO$K/b|GY`QW&!aAW[');
define('SECURE_AUTH_KEY',  'q%7 =3y(*1X=no,$=|<}eiR /^KXNlGfJu!z4@ada(E-U4Q5wFll_3ZSU<kvqKQ ');
define('LOGGED_IN_KEY',    '1)nS0EeIx`>!5~eC}pi%Tbo .dA Wv}@|4wH[>D^AQ^s}-V3N;EP%r07:X`$u]P|');
define('NONCE_KEY',        'hxj{t*V)*tBwxZ}]>jcf#L>kcl9P3R7dCXXL,Vj@XfV-Z84NivQQ~$CU4HF@VUdr');
define('AUTH_SALT',        'z4[W!RCTN[,cRU[XJi!kY f|;_H<O4&TkNj,L 6R$#|o//:gawPq1Eh0=8=BxS-^');
define('SECURE_AUTH_SALT', '8Hi!G{d|Vd.PX<R=|]r?Unc44:%DDE?>pd7hlvsDkHA`<<irr7>;mPm2S08ODusk');
define('LOGGED_IN_SALT',   '5L3eci1 O,3OxN$/1Gx~AM1gZJ3,=Q%3TT8}`1(;1vgcIv*ZrBB<6r;pd];mfyg#');
define('NONCE_SALT',       'N?2pTvj4O@w<_fU=03hi.b$I_0(uo-u~/bWvTu3hD~ Q.s*u#LV~kKB|Do I4+|*');

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

/* Handle HTTPS Protocol */

define('WP_DEBUG', false);
define('FORCE_SSL_ADMIN', true);
define('FORCE_SSL_LOGIN', true);

if ($_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https')

  $_SERVER['HTTPS']='on';



/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
