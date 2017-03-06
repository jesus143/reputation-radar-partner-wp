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
define('DB_NAME', 'db639369002');
/** MySQL database username */
define('DB_USER', 'dbo639369002');
/** MySQL database password */
define('DB_PASSWORD', '1qazxsw2!QAZXSW@');
/** MySQL hostname */
define('DB_HOST', 'db639369002.db.1and1.com');
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
define('AUTH_KEY',         'V#LmX+`.z%%kTn&YF~;2jbrWT[Df]^ARzg}r:]+(2~n(: ]N5zuRPa!]E_wsZRu_');
define('SECURE_AUTH_KEY',  'h4N/7T3K-Y#Z*N+gTi;@h=]S)Ps(!Y9^PPj,@-XYsjhxzLxshjgVb.5A4)kQ^9l2');
define('LOGGED_IN_KEY',    'AGpuiC;=1K), :q~!TbXfC]my5$Eb%mc:V9+^Or`%z6uj8*K9>c!p3TI0l:avhvb');
define('NONCE_KEY',        'g9#mK7DD6pTH1?p_KV75.B-{nIfzA=:Tu|W`+jwFbE]<D)5w{G84in+Z+DirZFU]');
define('AUTH_SALT',        's=+5Pr{dadFa;wZW/}~]mN 4%ZS?We|4DovX7j]~-*F~Iz6v%A:MFj1Y-81@| Lh');
define('SECURE_AUTH_SALT', 'v3RIP+G9hBoT>7|A?|4ep$!>/U=0h4|5QM uG~m{|(K-XM)3OK 1zl+w$5jz~^j7');
define('LOGGED_IN_SALT',   '1my-m}Z hO*(.::7+|H4W>m5rCz?FAY!kuAo7B21Q;|r}E -2#3,H=9Lft+Fo6F-');
define('NONCE_SALT',       'dRXlH;uX]s)JQpk=I}CBsU=N}R+-zSrtL+~ <|9ir.$g`!V@,d1]ve-~&4c~r>5X');
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

//error_reporting(E_ALL); ini_set('display_errors', '1');