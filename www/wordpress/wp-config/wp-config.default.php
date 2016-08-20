<?php
/**
 * Default config settings
 *
 * Enter any WordPress config settings that are default to all environments
 * in this file. These can then be overridden in the environment config files.
 * 
 * Please note if you add constants in this file (i.e. define statements) 
 * these cannot be overridden in environment config files.
 * 
 * @package    Studio 24 WordPress Multi-Environment Config
 * @version    1.0
 * @author     Studio 24 Ltd  <info@studio24.net>
 */
  

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
define('AUTH_KEY',         'r.p5?VXo_+wVA<0v4M/[l.SL}= JLDRxsxFu$uGLMCFJrN6~>,KZTu{|@a_m&d u');
define('SECURE_AUTH_KEY',  's8=9ctAC[JJ?-d $]W<`%R_BB)/iVM%5Y-3LCPHm2Kqh5tY/@NCb2:bT5TFEY!!v');
define('LOGGED_IN_KEY',    'Dfo$:mwa5n78k6<;mtFj=sYajc!Wiq)a*%z^S-,#FHsx+3))0(f:~G3V,Z@)|1&<');
define('NONCE_KEY',        '-6Si+img t3Y7/m{D[-bX4arf7)Jl$h:o~VGV:817xu-$:oOQZA#gf@0gbmmbTYo');
define('AUTH_SALT',        'Ii?.o<>~4*Ks;Gt*< ._NH|unaiBFowgv[olk#kB+y*5S<|v--Jb|.qeNN$.%aSf');
define('SECURE_AUTH_SALT', '=+I4^[dxR/C6`. cx(6z6|i$)XG9hfC2%Z[ujn1,n4h;dP>MUu[>B~-8]Y_p.9G%');
define('LOGGED_IN_SALT',   'Q:MhDezaOPzQb|D+x$>]b6%)T;<A+5Uq bC/ >Ue-j,8da,~mqTSEpjS-V_i#$Vm');
define('NONCE_SALT',       'E/%<xi>SXkTzp[vkQ};L+Z;>s:1HO-xha~?,db|b>+)MB*ex^6zYU&Fmz![J<.`e');

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
 * Increase memory limit. 
 */
define('WP_MEMORY_LIMIT', '64M');