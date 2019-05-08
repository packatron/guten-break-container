<?php
/**
 * @version 0.0.1
 */
/*
Plugin Name: Guten Break Container
Plugin URI: https://github.com/wp-quality/guten-break-container
Description: Get a new banana for your split.
Author: WordPress Quality
Version: 0.0.1
Author URI: https://github.com/wp-quality
*/

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

require_once __DIR__.'/vendor/autoload.php';
require_once plugin_dir_path( __FILE__ ) . 'src/init.php';

use WpQuality\GutenBreakContainer\App;

$app = new App();

$app->run();
