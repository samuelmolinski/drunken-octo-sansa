<?php
/* Bones Custom Post Type Example
This page walks you through creating 
a custom post type and taxonomies. You
can edit this one or copy the following code 
to create another one. 

I put this in a seperate file so as to 
keep it organized. I find it easier to edit
and change things if they are concentrated
in their own file.

Developed by: Eddie Machado
URL: http://themble.com/bones/
*/


// let's create the function for the custom type
function desafio_2013() { 
	// creating (registering) the custom type 
	register_post_type( 'desafio_2013', /* (http://codex.wordpress.org/Function_Reference/register_post_type) */
	 	// let's now add all the options for this post type
		array('labels' => array(
			'name' => __('Desafio 2013', 'post type general name'), /* This is the Title of the Group */
			'singular_name' => __('Desafio 2013', 'post type singular name'), /* This is the individual type */
			'add_new' => __('Novo Desafio', 'custom post type item'), /* The add new menu item */
			'add_new_item' => __('Novo Desafio'), /* Add New Display Title */
			'edit' => __( 'Editar' ), /* Edit Dialog */
			'edit_item' => __('Editar Desafio'), /* Edit Display Title */
			'new_item' => __('Novo Desafio'), /* New Display Title */
			'view_item' => __('Ver Desafio'), /* View Display Title */
			'search_items' => __('Buscar Desafios'), /* Search Custom Type Title */ 
			'not_found' =>  __('Nada foi encontrado no banco de dados.'), /* This displays if there are no entries yet */ 
			'not_found_in_trash' => __('Nada foi encontrado no lixo.'), /* This displays if there is nothing in the trash */
			'parent_item_colon' => ''
			), /* end of arrays */
			'description' => __( 'Novo desafios do 2013' ), /* Custom Type Description */
			'public' => true,
			'publicly_queryable' => true,
			'exclude_from_search' => false,
			'show_ui' => true,
			'query_var' => true,
			'menu_position' => 8, /* this is what order you want it to appear in on the left hand side menu */ 
			'menu_icon' => get_stylesheet_directory_uri() . '/library/images/custom-post-icon.png', /* the icon for the custom post type menu */
			'rewrite' => true,
			'capability_type' => 'post',
			'hierarchical' => false,
			/* the next one is important, it tells what's enabled in the post editor */
			'supports' => array( 'title', 'editor', 'thumbnail')
	 	) /* end of options */
	); /* end of register post type */
}
	// adding the function to the Wordpress init
	add_action( 'init', 'desafio_2013');
	

?>