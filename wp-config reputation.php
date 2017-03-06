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
define('DB_NAME', 'db669804158');

/** MySQL database username */
define('DB_USER', 'dbo669804158');

/** MySQL database password */
define('DB_PASSWORD', 'gwnuY7@1-p+AQ!3');

/** MySQL hostname */
define('DB_HOST', 'db669804158.db.1and1.com');

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
define('AUTH_KEY',         'l4jVT8PNa=#cP fNoCF(pbM)FPVC c73q,H,>L9.HsPqm9TQwWr,uy3g0n~FJ=oD');
define('SECURE_AUTH_KEY',  '+ld^/1i|21~$&Oj=SfP,HZVY-s5QP|#[u:O<|]>KbqY%qFeR(M*9$2FJy+M=|tr&');
define('LOGGED_IN_KEY',    'TW-1TX,h/1Ec=:(/J9fSEv*aI33,|1j8sWB/R6Th^XcN&Qjt/TU4/N)zch]>YP%@');
define('NONCE_KEY',        'F)BUc6@|G89P/);R`%hLcZ_[Q.[fD=P/89R`FVmUVLC[JgW~6kv*/L{tvbj^*x2{');
define('AUTH_SALT',        '{h AEEE:R0 ^hc($6q`:Q<-OS@h&6L&j686K-@#4~PBm&<T=nNE@y4%r?jNohP`z');
define('SECURE_AUTH_SALT', 'nk3M),0tv|z%TPhF${!)(S1thPKB4oj;.dnlvKn}z:x%f&l[!]Zybc-#pUL?~$%)');
define('LOGGED_IN_SALT',   'ztZwt$[x?`zL@/,&Eu%/{/@gmd@>Q1*<av4Do1WYyl+PO7PE$??3lS4q2jKgJ%.~');
define('NONCE_SALT',       'A2DB?FhPmW=l;^#Ob.ey,49_5?Rn<`@E7G IL7@?knLi_irx>EC7xK{txg[uuZ<;');

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

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
