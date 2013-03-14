<?php

	// Enforce https on production
	if ($_SERVER['HTTP_X_FORWARDED_PROTO'] == "http" && $_SERVER['REMOTE_ADDR'] != '127.0.0.1') {
	  header("Location: https://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"]);
	  exit();
	}
	
	
	$fb_app_id  = '';
	$fb_secret  = '';
	$fb_app_url  = '';
	
	require_once('fb/facebook.php');
	
	$facebook = new Facebook(array(
	  'appId'  => $fb_app_id,
	  'secret' => $fb_secret,
	  'cookie' => true,
	));

	$friends = array();
	$sent = false;
	$userData = null;

	//redirect to facebook page
	if(isset($_GET['code'])){
		header("Location: " . $fb_app_url);
		exit;
	}

	$user = $facebook->getUser();
	if ($user) {
		//get user data
		try {
			$userData = $facebook->api('/me');
		} catch (FacebookApiException $e) {
			//do something about it
		}

		//get 5 random friends
		try {
			$friendsTmp = $facebook->api('/' . $userData['id'] . '/friends');
			shuffle($friendsTmp['data']);
			array_splice($friendsTmp['data'], 5);
			$friends = $friendsTmp['data'];
		} catch (FacebookApiException $e) {
			//do something about it
		}

		//post message to wall if it is sent trough form
		if(isset($_POST['mapp_message'])){
			try {
				$facebook->api('/me/feed', 'POST', array(
					'message' => $_POST['mapp_message']
				));
				$sent = true;
			} catch (FacebookApiException $e) {
				//do something about it
			}
		}

	} else {
		$loginUrl = $facebook->getLoginUrl(array(
			'canvas' => 1,
			'fbconnect' => 0,
			'scope' => 'publish_stream',
		));
	}
	
	//db_mode(TRUE);
	//$tweetlink = "http://50.57.182.5/tweetsBobs/apiGetTweets.php?id=14&sm=12&sd=17&sy=2010&em=1&ed=17&ey=2012&o=d&l=250&from_user=&text=&lang=";
?><!doctype html>  
<!--[if IEMobile 7 ]> <html <?php language_attributes(); ?> class="no-js iem7"> <![endif]-->
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 7]>    <html class="no-js lt-ie9 lt-ie8" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 8]>    <html class="no-js lt-ie9" <?php language_attributes(); ?>> <![endif]-->
<!--[if (gte IE 8)|(gt IEMobile 7)|!(IEMobile)|!(IE)]><!--><html class="no-js" <?php language_attributes(); ?>><!--<![endif]-->
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		
		<title><?php wp_title(''); ?></title>
		
		<!-- meta tags should be handled by SEO plugin. I recommend (http://yoast.com/wordpress/seo/) -->
		
		<!-- mobile optimized -->
		<meta name="viewport" content="width=device-width">
		
		<!-- allow pinned sites -->
		<meta name="application-name" content="<?php bloginfo('name'); ?>" />
		
		<!-- icons & favicons (for more: http://themble.com/support/adding-icons-favicons/) -->
		<link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/favicon.ico">

  		<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
		
		<!-- wordpress head functions -->
		<?php wp_head(); ?>
		<!-- end of wordpress head -->
		
		<!-- load all styles for IE -->
		<!--[if (lt IE 9) & (!IEMobile)]>
    		<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/library/css/ie.css">	
		<![endif]-->
		
	</head>
	
	<body <?php body_class(); ?>>
		
		<div>
			<h1>Janar's graph-API example app using php-sdk</h1>
		
			<?php if ($user){ ?>
				<?php if ($sent){ ?>
					<p><strong>Message sent!</strong></p>
				<?php } ?>
				<form method="post" action="">
					<p><input type="text" value="Your message here..." size="60" name="mapp_message" /></p>
					<p><input type="submit" value="Send message to the wall" name="sendit" /></p>
				</form>
				<p>
					<br /><br />
					5 of your randomly picked friends:<br /><br />
					<?php foreach($friends as $k => $i){ ?>
						<strong><?php echo $i['name']; ?></strong><br />
					<?php } ?>
				</p>
			<?php } else { ?>
				<p>
				<strong><a href="<?php echo $loginUrl; ?>" target="_top">Allow this app to interact with my profile</a></strong>
				<br /><br />
				This is just a simple app for testing/demonstrating some facebook graph API calls usinf php-sdk library. After allowing this application, 
				it can be used to post messages on your wall. Also it will list 5 of your randomly picked friends.
				</p>
			<?php } ?>
			<p>
				<a href="http://eagerfish.eu/example-facebook-iframe-app-using-graph-api-through-php-sdk/"><strong>Download source and read blogpost about this</strong></a>
			</p>
		</div>
		<div id="container">
			
			<header role="banner" class="header">
			
				<div id="inner-header" class="wrap clearfix">
				
					<!-- to use a image just replace the bloginfo('name') with your img src and remove the surrounding <p> -->
					<p id="logo" class="h1"><a href="<?php echo home_url(); ?>" rel="nofollow"><?php bloginfo('name'); ?></a></p>
					
					<!-- if you'd like to use the site description you can un-comment it below -->
					<?php // bloginfo('description'); ?>
					
					<nav role="navigation" class="nav">
						<?php bones_main_nav(); // Adjust using Menus in Wordpress Admin ?>
					</nav>
				
				</div> <!-- end #inner-header -->
			
			</header> <!-- end header -->
