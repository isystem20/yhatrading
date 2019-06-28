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
define( 'DB_NAME', 'wpdata' );

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
define( 'AUTH_KEY',         'R(>-h_5B+}%{ XhT8V+Ay*$+|#}fUXU[j,WE~g9=OS$@`x=/u{+I[W+P4=Q>{t-1' );
define( 'SECURE_AUTH_KEY',  '~@?!@N)g!*COJP0luK{t%/-$StE_QE+HD]I1NsU5[<qW&F5Op_]/{|EB>$GIttLP' );
define( 'LOGGED_IN_KEY',    'Wux&NSh_.w}=^M7-H02&r2dH+={5_>6#;L3uJ:T_2tb/K[ng.4FWmB%T3BH-},_.' );
define( 'NONCE_KEY',        'y6P<G,W%;t}pl0:k7ARSRew6.19^g*_ua6dn^?v~0XR#$SkqeBu(|rojU`Wdt)q.' );
define( 'AUTH_SALT',        'w8asD{^3z)_`7G44E`Cw6CxMKtE8v(Bnvb551F>(;~[T{OXP[nRgX-![@kv:Z|{k' );
define( 'SECURE_AUTH_SALT', 'mAiFn%7pXZ6&s)Z`%&b{@J)s2:{|0A|EMQ^mNZCPmA(aU!/`i{|h1_1h;U|6i5@6' );
define( 'LOGGED_IN_SALT',   'wu;7D`b>r{XPJ~k^HqdftEP,!l{{#+ty.|XcLA0*Y!2z<R0GK7j-MxZR+Vo3p^[8' );
define( 'NONCE_SALT',       '<!c;=e+5UF4sg?MawT5dfVsqbQ[+gy5@%AvokvF)W:*$gZY.0hd=e)[+-7-V[!Oh' );

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
