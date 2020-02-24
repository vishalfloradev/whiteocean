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
define( 'DB_NAME', 'i3601582_white' );

/** MySQL database username */
define( 'DB_USER', 'whiteocean' );

/** MySQL database password */
define( 'DB_PASSWORD', '4#S9.&^pk5ui' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

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
define('AUTH_KEY',         'mJp7s8tnHXSjRcbw3QcGkuRR9XYDvwmsyA5TaMpxN62jZvHjCIw3m5TkyuG0eniD');
define('SECURE_AUTH_KEY',  'I84EWsgyy9dLeHQkFExANdkWEw1FQaBZCtkyI1OrDaIFGqrpm9N9WDVrF24ERqkt');
define('LOGGED_IN_KEY',    'f8SYT59OvoJBJvJPKZJfV0qf3Y4L3zi7yACMDX8Q59POexWCbY0jpgixpWPqqEhC');
define('NONCE_KEY',        'h4H9zdxvDfsTjJHdEB6W7SDwyYrC1qwPA590813ufwUeImio1Ru7lQ2Kb756sOsa');
define('AUTH_SALT',        'Vxq7DqTso4omFwNMsJEJ8VatJfR3E93gja7eLsp8yZp8tqhP2jCIi96my50cCFBi');
define('SECURE_AUTH_SALT', 'x4AdIvgBUISJCO63xplAU6fuZqEEPI8iVWZ5jJmlwUkn6MBiXeVgiwlQRCJB0pGZ');
define('LOGGED_IN_SALT',   'kjumYdYOe1vEzWJPqEEFTMuKbw0MCQ8VoRzDaKeaJJOATU2s7xfl906lQvhzk3Ce');
define('NONCE_SALT',       'vd0mMsq0WP5TsAEARk5LZvEnpb5ABy3Ummx2NcZrjWSh5on88kJl7crxOfgsoZMa');

/**
 * Other customizations.
 */
define('FS_METHOD','direct');
define('FS_CHMOD_DIR',0755);
define('FS_CHMOD_FILE',0644);
define('WP_TEMP_DIR',dirname(__FILE__).'/wp-content/uploads');

/**
 * Turn off automatic updates since these are managed externally by Installatron.
 * If you remove this define() to re-enable WordPress's automatic background updating
 * then it's advised to disable auto-updating in Installatron.
 */
define('AUTOMATIC_UPDATER_DISABLED', false);


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
define( 'WP_DEBUG', true );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once( ABSPATH . 'wp-settings.php' );
