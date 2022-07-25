<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the web site, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'filter' );

/** Database username */
define( 'DB_USER', 'phpmyadmin' );

/** Database password */
define( 'DB_PASSWORD', 'root' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication unique keys and salts.
 *
 * Change these to different unique phrases! You can generate these using
 * the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}.
 *
 * You can change these at any point in time to invalidate all existing cookies.
 * This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         '<Ftx(V#f?tS0T;GELGEO70:[}6&+P^4TMKI+M SwrXj~-2h-GsS),#_vO5R-0cy#' );
define( 'SECURE_AUTH_KEY',  '5Cg*hHULf8leTj#vNd=kdnx4|K.z$0dlyP?@LksjiT&|vy:VEf!qGYMa-?`2L5SZ' );
define( 'LOGGED_IN_KEY',    'Y=/L>,t(%A-@~To$pe=qH/748>S8(azlQ$Jo0{;0:DE|Pn$rQ+PjN.V[-6O4bL0k' );
define( 'NONCE_KEY',        '9r?P%#},GF6h.>-atN/JE9i{|l[>c/YX}dLj8wJttk9lZrm3MuSERb+eZ1zgJA>W' );
define( 'AUTH_SALT',        'mU]@?qzi@3J7VtbTbx1yJ)GRVw`Z=~j*jV9;2)>9UwPGAxwV?c?j>(OgJjG&i8=`' );
define( 'SECURE_AUTH_SALT', '4bZCa*t|:C]L`*~!J-dI2cjw8<jLX#n%4Vxk&Lzg5~(`K9sLe2([e I>a}5{YdzI' );
define( 'LOGGED_IN_SALT',   'OL];kx !a$IrM&Y~Nj(mjXLFG=_%$1mfl{fi2^T,[*rp}Naj{cTd;qse8Qkf.#Ys' );
define( 'NONCE_SALT',       ')&#(O-:_%ZKfY26/nx7qATQ}9/]kB5CQ cs:.pAoK2oy5U1H[w6Nx;.B9aFSXT,h' );

/**#@-*/

/**
 * WordPress database table prefix.
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
 * visit the documentation.
 *
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
