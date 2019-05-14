<?php

/* Plugin Name: FAQs Post Type
 * Description: Add FAQs post type and taxonomies.
 * Version:     1.0.0
 * Author:      Bob O'Brien, Digital Eel, Inc.
 * Author URI:  http://digitaleel.com/
 * License:     GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 */


// Exit if accessed directly
if( ! defined( 'ABSPATH' ) ) {
    exit;
}


require_once plugin_dir_path(__FILE__) . 'includes/post-type.php';
require_once plugin_dir_path(__FILE__) . 'includes/meta-boxes.php';
include_once plugin_dir_path(__FILE__) . 'includes/assets.php';

