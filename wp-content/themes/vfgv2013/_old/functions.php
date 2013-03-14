<?php
/*
  Author: Eddie Machado
  URL: htp://themble.com/bones/

  This is where you can drop your custom functions or
  just edit things like thumbnail sizes, header images,
  sidebars, comments, ect.
 */
define('GOOGLE_API_KEY', 'AIzaSyBLxv3xZgvL-MyMHGCupCydYMnuUsrCU14');
define('GOOGLE_ENDPOINT', 'https://www.googleapis.com/urlshortener/v1');
define('BASEURL', 'http://vestibular.fgv.br/sites/vestibular.fgv.br/themes/vestibular/vestibular2012-2.php');
define('FB_BASEURL', 'https://www.vestibularfgv.com.br/2013CLONE/');


define('FB_ID', '440982045925181');
define('FB_SECRET', 'b8716067e7df5173183aa5865b021657');
define('FB_APP_URL', 'https://www.facebook.com/pages/Vestibular-FGV/141618765913092?sk=app_440982045925181');
//define('FB_APP_URL', 'https://www.facebook.com/pages/SamplePage/220134694676331?sk=app_440982045925181');


// Get Bones Core Up & Running!
require_once('library/bones.php');			// core functions (don't remove)
require_once('library/plugins.php');		  // plugins & extra functions (optional)
//require_once('library/custom-post-type.php'); // custom post type example
require_once('library/desafio-2013.php'); // custom post type example

require_once ("library/metaSetup.php");

// Admin Functions (commented out by default)
// require_once('library/admin.php');         // custom admin functions

/* * *********** THUMBNAIL SIZE OPTIONS ************ */

// Thumbnail sizes
add_image_size('bones-thumb-600', 600, 150, true);
add_image_size('bones-thumb-300', 300, 100, true);
/*
  to add more sizes, simply copy a line from above
  and change the dimensions & name. As long as you
  upload a "featured image" as large as the biggest
  set width or height, all the other sizes will be
  auto-cropped.

  To call a different size, simply change the text
  inside the thumbnail function.

  For example, to call the 300 x 300 sized image,
  we would use the function:
  <?php the_post_thumbnail( 'bones-thumb-300' ); ?>
  for the 600 x 100 image:
  <?php the_post_thumbnail( 'bones-thumb-600' ); ?>

  You can change the names and dimensions to whatever
  you like. Enjoy!
 */

/* * *********** ACTIVE SIDEBARS ******************* */

// Sidebars & Widgetizes Areas
function bones_register_sidebars() {
	register_sidebar(array(
		'id' => 'sidebar1',
		'name' => 'Sidebar 1',
		'description' => 'The first (primary) sidebar.',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="widgettitle">',
		'after_title' => '</h4>',
	));

	/*
	  to add more sidebars or widgetized areas, just copy
	  and edit the above sidebar code. In order to call
	  your new sidebar just use the following code:

	  Just change the name to whatever your new
	  sidebar's id is, for example:

	  register_sidebar(array(
	  'id' => 'sidebar2',
	  'name' => 'Sidebar 2',
	  'description' => 'The second (secondary) sidebar.',
	  'before_widget' => '<div id="%1$s" class="widget %2$s">',
	  'after_widget' => '</div>',
	  'before_title' => '<h4 class="widgettitle">',
	  'after_title' => '</h4>',
	  ));

	  To call the sidebar in your template, you can just copy
	  the sidebar.php file and rename it to your sidebar's name.
	  So using the above example, it would be:
	  sidebar-sidebar2.php

	 */
}

// don't remove this bracket!

/* * *********** COMMENT LAYOUT ******************** */

// Comment Layout
function bones_comments($comment, $args, $depth) {
	$GLOBALS['comment'] = $comment;
	?>
	<li <?php comment_class(); ?>>
		<article id="comment-<?php comment_ID(); ?>" class="clearfix">
			<header class="comment-author vcard">
				<?php echo get_avatar($comment, $size = '32', $default = '<path_to_url>'); ?>
			<?php printf(__('<cite class="fn">%s</cite>'), get_comment_author_link()) ?>
				<time><a href="<?php echo htmlspecialchars(get_comment_link($comment->comment_ID)) ?>"><?php printf(__('%1$s'), get_comment_date(), get_comment_time()) ?></a></time>
	<?php edit_comment_link(__('(Edit)'), '  ', '') ?>
			</header>
			<?php if ($comment->comment_approved == '0') : ?>
				<div class="help">
					<p><?php _e('Your comment is awaiting moderation.') ?></p>
				</div>
			<?php endif; ?>
			<section class="comment_content clearfix">
	<?php comment_text() ?>
			</section>
		<?php comment_reply_link(array_merge($args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
		</article>
	    <!-- </li> is added by wordpress automatically -->
		<?php
	}

// don't remove this bracket!

	/*	 * *********** SEARCH FORM LAYOUT **************** */

// Search Form
	function bones_wpsearch($form) {
		$form = '<form role="search" method="get" id="searchform" action="' . home_url('/') . '" >
    <label class="screen-reader-text" for="s">' . __('Search for:', 'bonestheme') . '</label>
    <input type="text" value="' . get_search_query() . '" name="s" id="s" placeholder="Search the Site..." />
    <input type="submit" id="searchsubmit" value="' . esc_attr__('Search') . '" />
    </form>';
		return $form;
	}

// don't remove this bracket!

	function desaturateImg($image_src) {

// Find thumbnail locations
		$image_src_path = dirname($image_src);
//		inspect($image_src_path);
		$image_src_filename = basename($image_src);
//		inspect($image_src_filename);

// Create greyscale filename
		$image_src_extention_loc = (strripos($image_src_filename, '.') - strlen($image_src_filename));
		$bw_image_filename = substr($image_src_filename, 0, $image_src_extention_loc) . '_bw' . substr($image_src_filename, $image_src_extention_loc);
		
		$path = explode('wp-content', $image_src_path);
//		inspect(WP_CONTENT_DIR);
//		inspect($path);
//		inspect($bw_image_filename);
		
		if(file_exists(WP_CONTENT_DIR . $path[1] .'/'. $bw_image_filename)) {
//			inspect('found it!');
		}
		
		
		
		if (!file_exists(WP_CONTENT_DIR . $path[1] .'/'. $bw_image_filename)) {
			// Create greyscale image
			$bw_image = wp_load_image(WP_CONTENT_DIR . $path[1] .'/'. $image_src_filename);
//			inspect($bw_image);

			// Apply greyscale filter
			imagefilter($bw_image, IMG_FILTER_GRAYSCALE);

			// Save the image.
			imagejpeg($bw_image, WP_CONTENT_DIR . $path[1] .'/'. $bw_image_filename, 100);

			imagedestroy($bw_image);
		}

		return $image_src_path . '/' . $bw_image_filename;
	}


 
     function shortenUrl($longUrl) {
        
        // initialize the cURL connection
        $ch = curl_init(
            sprintf('%s/url?key=%s', GOOGLE_ENDPOINT, GOOGLE_API_KEY)
        );
 
        // tell cURL to return the data rather than outputting it
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
 
        // create the data to be encoded into JSON
        $requestData = array(
            'longUrl' => $longUrl
        );
 
        // change the request type to POST
        curl_setopt($ch, CURLOPT_POST, true);
 
        // set the form content type for JSON data
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-type: application/json'));
 
        // set the post body to encoded JSON data
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($requestData));
 
        // perform the request
        $result = curl_exec($ch);
        curl_close($ch);
		
        return json_decode($result, true);
    }

	function genURL($p = null, $description = NULL) {
	     
	     global $post, $page_desafio_mb, $activePost;
          //inspect($activePost);
          if (null != $p) {
               if ($activePost) {$p = $activePost;} else {$p = currentID();}
          }
		            
		$page_desafio_mb->the_meta($p);
		$meta = $page_desafio_mb->meta;
		$URL = urlencode(get_permalink($p));
          
		$baseURL = BASEURL;
		$page = '&page='.urlencode($p);
        $img = '&image='.urlencode($meta['fb_post_image']);
		$title = '&title='.urlencode( html_entity_decode(get_the_title($p)));
		
          if (null == $description) {
               $description = '&description='.urlencode($meta['shareFrase']);
          } else {
               $description = '&description='.urlencode($description);
          }
          
		$ext = 'forwardURL='.$URL.$page.$img.$title.$description;
          
		$u = strpos($baseURL, '?');
		if (FALSE === $u) {
			$URL = $baseURL.'?'.$ext;
		} else {
               $URL = $baseURL.'&'.$ext;
		}
		return $URL;
	}

	function get_post_image_scr() {
		global $post;
		if (current_theme_supports('post-thumbnails') && has_post_thumbnail()) {
			$thumbURL = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), '');
			$imgSrc = $thumbURL[0];
		}
		return $imgSrc;
	}

	function get_crop_image($imgSrc, $timthumbOptions = '&amp;w=300&amp;h=300&amp;zc=1', $classes = '', $alt = '') {
		$template_url = get_bloginfo('template_url');
		return "<img class='$classes' src='$template_url/library/timthumb.php?src=" . $imgSrc . $timthumbOptions . "' alt='$alt' />";
	}
	
     function the_crop_image($imgSrc, $timthumbOptions = '&amp;w=300&amp;h=300&amp;zc=1', $classes = '', $alt = '') {
		echo crop_image($imgSrc, $timthumbOptions, $classes, $alt);
	}

	function cleanVideoURL($videoURL) {
				
		$strip = explode('/', $videoURL);
		//inspect($strip);
		$strip = explode('v=', $strip[count($strip)-1]);
		//inspect($strip);
		count($strip)>1 ? $strip = explode('&', $strip[1]): $strip = explode('&', $strip[0]);
		//inspect($strip);
		$strip = explode('?', $strip[0]);		
		//inspect($strip);		
		$url = $strip[0];
		
		return $url;
	}
	
	function printComments($userComment, $format = 'normal') {
		
		if (!is_array($userComment)) {
			// main function
			$name = $userComment->fb_name;
			$id = $userComment->fb_ID;
			$comment = $userComment->fb_comment;
			$comment = str_replace('\n', '<br/>', $comment);
			$date = $userComment->fb_date;
			$post_id = $userComment->post_ID;
			$fb_flag = $userComment->fb_flag;
			$imgUrl = "https://graph.facebook.com/$id/picture" ;	
			$linkUrl = "https://www.facebook.com/profile.php?id=$id" ;	
			$itemID = $id; //$post_id . '_'. $id;
			$checked = $flagged = '';
			//inspect($fb_flag);
			if (1 == $fb_flag) {
				$checked = 'checked="checked"';
			} elseif ( -1 == $fb_flag) {
				$flagged = 'checked="checked"';
			}
			 
			$str = json_encode(array('fb_name'=> $name, 'fb_ID'=> $id));
			
			//inspect($str);
			
			if ('normal' == $format ) {
			?>
			
			<div class="fb_comment">
				<div class="photos">
                	<a href="<?php echo $linkUrl ?>" target="_blank"><img src="<?php echo $imgUrl; ?>" /></a>
                </div>
				<div class="commentBody">
					<h4><a href="<?php echo $linkUrl ?>" target="_blank"><?php echo $name; ?></a></h4>
					<?php echo wpautop($comment); ?>
				</div>
				<div class="clearfix"></div>
			</div>			
            
			<?php
			} else {
			?>
			
		<div class="fb_comment">
			<div class="inputs">
				<label class="win" for="win_<?php echo $itemID ?>"><input type="checkbox" name="winner_<?php echo $itemID ?>" id='win_<?php echo $itemID ?>' value='<?php echo $str; ?>' <?php echo $checked ?> />Vencedor</label>
				<label class="offensive" for="flag_<?php echo $itemID ?>"><input type="checkbox" name='flag_<?php echo $itemID ?>' id='flag_<?php echo $itemID ?>' value='<?php echo $str; ?>' <?php echo $flagged ?> />Ofensiva</label>
				<label class="remove" for="remove_<?php echo $itemID ?>"><input type="checkbox" name='remove_<?php echo $itemID ?>' id='remove_<?php echo $itemID ?>' value='<?php echo $str; ?>' />Apagar</label>
			</div>
			<a href="<?php echo $linkUrl ?>" target="_blank"><img src="<?php echo $imgUrl; ?>" /></a>
			<div class="commentBody">
			    <h4><a href="<?php echo $linkUrl ?>" target="_blank"><?php echo $name; ?></a></h4>
				<?php echo wpautop($comment); ?>
			</div>
			<div class="clearfix"></div>
		</div>			
			<?php
			}
		} else {
			// It's an array, let's do recursion!
			foreach ($userComment as $key => $value) {
				printComments($value, $format);
			}
		}
	}
	
	function printWinnersName($userComment) {
			$contar = count($userComment);
			//inspect($contar);
			
			if($contar > 1){
				//inspect($userComment);
				echo "Parabéns, ";
				foreach ($userComment as $key => $value) {
					echo $value->fb_name . ", ";
				}				
				echo "vencedores desta etapa. Confira abaixo as respostas vencedoras.";
			}else{
				echo "Parabéns, ";
				echo $userComment->fb_name;
				echo " , vencedor(a) desta etapa. Confira abaixo a resposta vencedora.";
			}
	}
	
	function showComments($userComment) {
		?>
		
		<form name="winnerForm" method="POST">
		<div class="fb_comment">
			<p>Ninguém</p>
			<input type="radio" id='none_one' />
			<div class="clearfix"></div>
		</div>	
		<?php
		foreach ($userComment as $key => $value) {
			$name = $userComment->fb_name;
			$id = $userComment->fb_ID;
			$comment = $userComment->fb_comment;
			$date = $userComment->fb_date;
			$post_id = $userComment->post_ID;
			$imgUrl = "https://graph.facebook.com/$id/picture" ;	
			$linkUrl = "https://www.facebook.com/profile.php?id=$id" ;
			?>
		<div class="fb_comment">
			<a href="<?php echo $linkUrl ?>" target="_blank"><img src="<?php echo $imgUrl; ?>" /></a>
			<div class="commentBody">
			    <h4><a href="<?php echo $linkUrl ?>" target="_blank"><?php echo $name; ?></a></h4>
				<?php echo wpautop($comment); ?>
			</div>
		<div class="clearfix"></div>
		</div>			
		<?php
		} ?>
		</form>
		<?php
	}
	
	function currentID() {
		global $wp_query;
		//inspect($wp_query);
		return $wp_query->post->ID;
		
	}
	
	function buildLink($originalLink, $cookieInfo, $utm_source, $utm_content, $utm_medium, $utm_campaign) {
	
		$linkExt = '';
		
		$campaign_source = $cookieInfo->campaign_source;
		$campaign_medium = $cookieInfo->campaign_medium;
		$campaign_content = $cookieInfo->campaign_content;
		$campaign_name = $cookieInfo->campaign_name;
					
		if ($campaign_source =='(direct)'||$campaign_source =='(none)'||$campaign_source =='direct'||$campaign_source =='none'||$campaign_source =='(referral)'||$campaign_source =='referral'||$campaign_source =='undefined'||$campaign_source ==$utm_source||$campaign_source =='') {$utm_source = $utm_source;} else { $utm_source = $campaign_source . '___' . $utm_source; }
		//echo "utm_source = " . $utm_source;
		
		if ($campaign_content =='(direct)'||$campaign_content =='(none)'||$campaign_content =='direct'||$campaign_content =='none'||$campaign_content =='(referral)'||$campaign_content =='referral'||$campaign_content =='undefined'||$campaign_content ==$utm_content||$campaign_content =='') {$utm_content = $utm_content;} else { $utm_content = $campaign_content  . '___' . $utm_content; }
		//echo "campaign_content = " . $campaign_content;
		
		if ($campaign_medium =='(direct)'||$campaign_medium =='(none)'||$campaign_medium =='direct'||$campaign_medium =='none'||$campaign_medium =='(referral)'||$campaign_medium =='referral'||$campaign_medium =='undefined'||$campaign_medium ==$utm_medium||$campaign_medium =='') {$utm_medium = $utm_medium;} else { $utm_medium =$campaign_medium  . '___' . $utm_medium; }
		//echo "campaign_medium = " . $campaign_medium;
		
		if ($campaign_name =='(direct)'||$campaign_name =='(none)'||$campaign_name =='direct'||$campaign_name =='none'||$campaign_name =='(referral)'||$campaign_name =='referral'||$campaign_name =='undefined'||$campaign_name ==$utm_campaign||$campaign_name =='') {$utm_campaign = $utm_campaign;} else { $utm_campaign =$campaign_name . '___' . $utm_campaign; }
		//echo "campaign_name = " . $campaign_name;
		
		if (stripos($originalLink, "?")) {
			$linkExt = $originalLink . "&utm_source=" . $utm_source . "&utm_medium=" . $utm_medium . "&utm_content=" . $utm_content . "&utm_campaign=" . $utm_campaign; } 
		else { $linkExt = $originalLink . "?utm_source=" . $utm_source . "&utm_medium=" . $utm_medium . "&utm_content=" . $utm_content . "&utm_campaign=" . $utm_campaign; }
		
		echo $linkExt;
	}
	
	
	include_once('inspect.php');
	?>