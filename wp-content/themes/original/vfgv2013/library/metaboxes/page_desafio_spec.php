<?php

$page_desafio_mb = new WPAlchemy_MetaBox(array
(
	'id' => '_page_desafio_meta',
	'title' => 'Configurações do Desafio',
	'types' => array('desafio_2013'), // added only for pages and to custom post type "events"
	'context' => 'normal', // same as above, defaults to "normal"
	'priority' => 'high', // same as above, defaults to "high"
	'template' => WP_CONTENT_DIR . '/themes/vfgv2013/library/metaboxes/page_desafio_meta.php'
));

/* eof */