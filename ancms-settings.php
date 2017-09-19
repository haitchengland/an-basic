<?php
/* These setting need to be loaded from the theme, as each theme will have different settings */

define( 'ANCMS_PLUGIN_URL', plugins_url( '', __FILE__ ) );  //      http://dev.autonerd.co.uk/wp-content/plugins/autonerd-basic
define( 'ANCMS_PLUGIN_PATH', plugin_dir_path( __FILE__ ) ); //      E:\Dropbox\Server\autonerd\wp-content\plugins\autonerd-basic/
define( 'ANCMS_TEMPLATE_PATH', ANCMS_PLUGIN_PATH . 'templates/' ); 
define( 'ANCMS_TEMPLATE_URL', ANCMS_PLUGIN_URL . '/templates/' ); 
define( 'ANCMS_ASSETS_URL', ANCMS_PLUGIN_URL . '/templates/assets/' ); 
define( 'ANCMS_IMAGES_URL', ANCMS_PLUGIN_URL . '/templates/assets/images/' ); 

if ( ! defined( 'SHCMS_BASE_FILE' ) )
    define( 'SHCMS_BASE_FILE', __FILE__ );                  //      E:\Dropbox\Server\autonerd\wp-content\plugins\autonerd-basic\ancms-settings.php
if ( ! defined( 'SHCMS_BASE_DIR' ) )
    define( 'SHCMS_BASE_DIR', dirname( SHCMS_BASE_FILE ) ); //      E:\Dropbox\Server\autonerd\wp-content\plugins\autonerd-basic
if ( ! defined( 'SHCMS_PLUGIN_URL' ) )
    define( 'SHCMS_PLUGIN_URL', plugin_dir_url( __FILE__ ) ); //    http://dev.autonerd.co.uk/wp-content/plugins/autonerd-basic/



