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
define('DB_NAME', 'wordpress');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

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
define('AUTH_KEY',         'GZixqI+>%b+mOQvLuiGy<WtzPcaNs}5rac1J)rbT^b LOs+@Aw/TKYns5vyr.T #');
define('SECURE_AUTH_KEY',  '=B|:pK>`f05:Y]FC7-;JeLOMZ>Cz2h_c5(m8//5_n=Km&d{|$YTT&igiQG0+]Fe<');
define('LOGGED_IN_KEY',    'ut`4v &,vU{FLw(;qTi:`db]J-+;v1JwXrY.LQ.ENMl$zplZ(Ic-kJNK/#H#B6WK');
define('NONCE_KEY',        'Wt`0QcSG]xv@a^k]n?!>cWFX%;%WI^}JFCQL9<d%S*SJ^vrWdr5=Z5D84EcVL4no');
define('AUTH_SALT',        'O)QKosCjXlm#{1I!n9ice|E45uY[/fPP>+]VCD0Z>%~:Sl}=HpnI6++6ybgLQ;?J');
define('SECURE_AUTH_SALT', '<N*5xmtZM$=n*@kEtH|@pCCLI}nnyH@JBQ(z&>G^tyg^PTh/p}EGuFe)d=?=n |I');
define('LOGGED_IN_SALT',   '&HU1[I+[~iuW:STo(kYu]^.ZIrxTo;H{d`D&OEcwn9f&c<XhNY/|BLQW^e{:?m0(');
define('NONCE_SALT',       'X co|@SpW0Des98#|55`6_B$F?Z)w^3G3F}aNpqGIZ!H+FK5|=EA,/yr=k[i1^j_');

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
