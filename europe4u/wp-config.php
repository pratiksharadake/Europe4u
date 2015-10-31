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
define('DB_NAME', 'europe4you_it');

/** MySQL database username */
define('DB_USER', 'laracomi');

/** MySQL database password */
define('DB_PASSWORD', 'X02L4FnN8sXx');

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
define('AUTH_KEY',         '[kHqWxp-D]+~;MF^avU3)jI%p3]7e<a{A;)Em>ShUQoq3RWiE#@`?3tj*uD)]A:l');
define('SECURE_AUTH_KEY',  '09*}YUDxfKCo^H_}9J+X}ahs/~c!+rw9|~`_7-kQ,dhfN]iBQ{oy-4a<_+K2A;DZ');
define('LOGGED_IN_KEY',    '>^GIP%9XqnG&_M&VVlvP3Z ;4/w-!t&kk~+Au/71,3q~q5i( 0=h.+|AKH{~5YUP');
define('NONCE_KEY',        '([[UCF[0:0Bg4UsbZ^6p=>iUlASf#y~g(Y&4C8FMA&3?GN.,xx6#5WIXhYz-J|+^');
define('AUTH_SALT',        '@r<)sr`,^LX-i$RT[l(N.hq+CKUTJ,TN>3|i+O?s}WRv/3P6g 1<$>S-q7W&R{xC');
define('SECURE_AUTH_SALT', '[ahXY]s;z<5krRLBzhxeU=bA5^SE*|*9@)uawg*Q /M;Xc7WsdSB#c#0@2i1-hz;');
define('LOGGED_IN_SALT',   'aJ_W2brtM.BoPg^H_F|b+iR~)dt3;s)X_]_xFr@}p=+qH=$)oN.%3_S5Bci 2|DV');
define('NONCE_SALT',       ')9M-zirmFKm9.T>h.m-Bs6&;MF,rk$:7=dQ|H)dv+zZF.<5~`UL/dt[.7jW<x${t');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', false);
define('WP_HOME','http://www.europe4you.it');
define('WP_SITEURL','http://www.europe4you.it');
/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
