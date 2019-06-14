<?php
/** Enable W3 Total Cache */
define('WP_CACHE', true); // Added by W3 Total Cache

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
define('DB_NAME', 'riojawine_db');

/** MySQL database username */
define('DB_USER', 'riojawine_db');

/** MySQL database password */
define('DB_PASSWORD', 'Ncr4t8Les6');

/** MySQL hostname */
define('DB_HOST', 'localhost');

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
// define('AUTH_KEY',         'j=na9|:gJi#)P*96N_)O7y6-!Ohozqg+B[ 2%*pgdZGtw;L$90C<-<_<qN]Y?y@[');
// define('SECURE_AUTH_KEY',  'v:EIAfE1Ce|H;A:7--Cm_!RyZAy&n;q`P_N1J0S*/=(kj+6PQrS_VSSs,-$ukMK}');
// define('LOGGED_IN_KEY',    'Kq)YIFM;rEf<z-(2kxJ2K.` uYKG#-AV(jYVT@5,7+fZ[| @q?&n<|@m7xdqj25w');
// define('NONCE_KEY',        '4ko3w8&Lj[+e5ZS2m*7uOD>f5?aM#E@&P%p<1yx?P9{]G4l<3HbB6%j$*==:<I$I');
// define('AUTH_SALT',        'aT+bWQ} ZzzXD~*jID(T)xqf]W0Y.COM|jx%h^,Ja+2FI6/T|;9|.!Ox)7_RC92%');
// define('SECURE_AUTH_SALT', '|G7ODdtp%DycA]GfM|)m=/u8vi o7Sa04Jfdm2btE#xfA5hV e8+[/#SFxO!S>&2');
// define('LOGGED_IN_SALT',   'iIu6at;g|7T`]w@/qN?{1pU1K$hh#y$0s.+^VKI]|Fb03_F&I_RtERwn2%z0<@2Y');
// define('NONCE_SALT',       'O#nVK}a/#s+r*I|DCH*)liw>ti{3:CLh0Z)pT0|R7I;YV :>&x.~*,VLN{wb+k P');
define('AUTH_KEY',         '8i.4Cp<by2ynlIq*`Wj~!H|@)0V~~7(emkVL0t7eML8<l;]I9a*ED?G%<8Cxpo.T');
define('SECURE_AUTH_KEY',  'U!r28>i^*U|o^28dC-i}_/lKKdTI4OJFAId*jX0W[ .>=H=3ZE|Jl8IGO>-5XR$[');
define('LOGGED_IN_KEY',    'Rg*X+$Z)5S56m<s$X$T%NWh4B+ ^z[|H5/lVK1F_(v0pNOU{-rF#?Ao9;n]}?7u>');
define('NONCE_KEY',        ']$l}&%.%H{BTx6IP~=s}!)k[yPvD3C!?OnAW;23V}|KMez6F.SaA`NSMO?lf|.% ');
define('AUTH_SALT',        'Ll=#kn?}s22v4MySnmYwml-yuKrF,z(Mu{,MWBLi)h+l&``@-(+J@McXG:e+M-Cp');
define('SECURE_AUTH_SALT', 'jj9_p%8dV 5vH7i$Vqx,:hV6bVF(|[qFkq!OZE=AS+DJY(`>wAzcfS;:aO+P#O3M');
define('LOGGED_IN_SALT',   'Ix<{5$Yo;zr>FM)G@]^*:@BrI9AWi)g[H+77|BNjP-K!wyjS>D8C+eCHMB8U65KO');
define('NONCE_SALT',       '!Bw;eJA|@HZ5p3JQz/+_Vt?1,(SkRnP5!NKhy~sH;PO2&3v5e)rB05v@D!-m*t[V');


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
define('WP_DEBUG', true);
define( 'WP_DEBUG_DISPLAY', true );

/* Multisite */
define( 'WP_ALLOW_MULTISITE', true );
define('SUBDOMAIN_INSTALL', false);
define('DOMAIN_CURRENT_SITE', 'riojawine.cn');
define('PATH_CURRENT_SITE', '/');
define('SITE_ID_CURRENT_SITE', 1);
define('BLOG_ID_CURRENT_SITE', 1);
define('WP_ALLOW_REPAIR', true);

define('DISALLOW_FILE_EDIT', true);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');

define('FS_METHOD', 'direct');

// define ('WPLANG', 'es_ES');
if ( !defined('RIOJAWINE_SEO_TITLE') )
	define('RIOJAWINE_SEO_TITLE', 'Consejo Regulador DOCa Rioja - Riojawine');

if ( !defined('URL_RIOJAWINE_API') )
	define('URL_RIOJAWINE_API', 'http://api.riojawine.com');

if ( !defined('GOOGLE_API_KEY') )
	define('GOOGLE_API_KEY', 'AIzaSyDHPhEqyxx-zFSmyJVEY61Z5jvoGihoZKA');
