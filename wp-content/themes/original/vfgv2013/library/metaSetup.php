<?php
include_once 'MediaAccess.php';
include_once 'MetaBox.php';
 
// global styles for the meta boxes
if (is_admin()) wp_enqueue_style('wpalchemy-metabox-css', '/wp-content/themes/vfgv2013/library/metaboxes/meta.css');

include_once 'metaboxes/page_desafio_spec.php';
$wpalchemy_media_access = new WPAlchemy_MediaAccess();

/* eof */