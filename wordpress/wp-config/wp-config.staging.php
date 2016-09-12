<?php
/**
 * Development environment config settings
 *
 * Enter any WordPress config settings that are specific to this environment 
 * in this file.
 * 
 * @package    Studio 24 WordPress Multi-Environment Config
 * @version    1.0
 * @author     Studio 24 Ltd  <info@studio24.net>
 */
  

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'novamedia');

/** MySQL database username */
define('DB_USER', 'novamedia');

/** MySQL database password */
define('DB_PASSWORD', '3MdQkVANd9UUxvpt');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', true);
define( 'WP_DEBUG_DISPLAY', true );
define( 'WP_DEBUG_LOG', true );

@ini_set( 'display_errors', 1 );
ini_set('log_errors', 'On');

define( 'SAVEQUERIES', true );

define( 'SCRIPT_DEBUG', true );

define('WP_CACHE', true); //Added by WP-Cache Manager
