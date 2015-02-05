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

//define('WP_CACHE', true); //Added by WP-Cache Manager
define( 'WPCACHEHOME', '/home/weiluen/public_html/desktop/blog/wp-content/plugins/wp-super-cache/' ); //Added by WP-Cache Manager
define('DB_NAME', 'weiluen_fyre182');

/** MySQL database username */
define('DB_USER', 'weiluen_fyre182');

/** MySQL database password */
define('DB_PASSWORD', 'B!urredfyre182');

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
define('AUTH_KEY',         'DBYgHKb0pHdhI2rYQu1KIKxJzs8udUJUh0Mk1ss9yBMXex4QsNZmLrN6q85I6IgR');
define('SECURE_AUTH_KEY',  'Vak2KJzPNq6TCNmiVl0o62FGhGlC5ZnFG2GKKnBpGeOISTVpkSDkUi8JiFmbG7nN');
define('LOGGED_IN_KEY',    'jCBdaXFZrJcJuxO9Fwt6zhwKIFGI6qhMFPtYGAmFgQUzG3uQQnNBzCbMNkCHxM0v');
define('NONCE_KEY',        'q1K1EyCgrfrx86gBqweBeB0WM48Bq6IoQQ9EXBUCK2rZbOzloHTrCYj9uM27b8Bb');
define('AUTH_SALT',        'HofdRqC0872Zudr1ajUubrHJrcRhAJBkFo5pdLhtYOIMmYQMNPTnvZkzNZRlWQp2');
define('SECURE_AUTH_SALT', '3dVXuQ7FIrURmlh86guiwYwbdDMhqNwjQMdhNUDN0EXj3yvFWleEmBQDEUDDX9fp');
define('LOGGED_IN_SALT',   'cIoHLGBgLDajUG7QaVQlEZBNlvO5wu8ev6I6YoCxhTZs2NmQymktUJHcuWAUUAGK');
define('NONCE_SALT',       'YI4CLzJCmlMhFPAPUKebvebFBDZhOsZaNRM2oXfUkA4mbEpZJa3Itaut5aLYkm19');

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
