<?php

include_once WP_CONTENT_DIR . '/wpalchemy/MediaAccess.php';
include_once WP_CONTENT_DIR . '/wpalchemy/MetaBox.php';
 
// global styles for the meta boxes
if (is_admin()) wp_enqueue_style('wpalchemy-metabox', get_stylesheet_directory_uri() . '/metaboxes/meta.css');
if (is_admin()) wp_enqueue_style('colorpicker', get_template_directory_uri() . '/js/colorpicker.js');

/* eof */