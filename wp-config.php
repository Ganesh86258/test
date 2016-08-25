<?php
/**
* Testing the comment
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, and ABSPATH. You can find more information by visiting
 * {@link https://codex.wordpress.org/Editing_wp-config.php Editing wp-config.php}
 * Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'ajax-db');

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
define('AUTH_KEY',         '[q@uPO=$Bk|[3u2o$m=aB$1u5vL[(wmKz/=~SFc+s|z+D6s_ZaP1%$H8/d8^JYk,');
define('SECURE_AUTH_KEY',  '6|b]34p7&e]|>./=%3Wq^+|~J-=ou&8S!s.3SAsG$,(, f;X~/IU(#C9E=rO&.!{');
define('LOGGED_IN_KEY',    '-20&2t[#(+)!{[BOp4b#tO.$oD9DdFREGLvZ99GaTmt`cqJoS{0~2t|Dr-ZP@41m');
define('NONCE_KEY',        '{w(qVvCRXg{u2XG}O-p#AyUs:X|-hR]*zH|atO3::?Vhe<z6{+;]`rd$Il79kd!0');
define('AUTH_SALT',        'AY0X`}YC{.`SDDU<}l`-vUpv+TaFa/yQ}FfU4QVt$,n}hhLKGPN@^qx/IyE42]-s');
define('SECURE_AUTH_SALT', 'Z|rQLHH<oZl_ghB&fxi4T1O6,Y&_F,4+moTP!)BQuj^Vfmt7bK`1}mi(<dftZ>gl');
define('LOGGED_IN_SALT',   '#27@Y,l<v^Aq+,.ALvInn*1;Nyj|KDHpvsEWhMA/D^by?+ 3Rfr$Y*_,=&yu)+$3');
define('NONCE_SALT',       'i@joWre2_<dJ..B_t^EGx%B0?lo[F5JOS`sR&lMILY`.cqT+-`P&-IYYQHhlS6$#');

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

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
