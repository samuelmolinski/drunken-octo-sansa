<?php

	$fbconfig['appid'] = FB_ID;
	$fbconfig['secret'] = FB_SECRET;

	$fbconfig['baseUrl'] = FB_BASEURL;
	// "http://thinkdiff.net/demo/newfbconnect1/iframe/sdk3";
	$fbconfig['appBaseUrl'] = FB_APP_URL;
	// "http://apps.facebook.com/thinkdiffdemo";

	if (isset($_GET['request_ids'])) {
		//user comes from invitation
		//track them if you need
	}
	require_once ('fb/Class-User.php');


	function d($d) {
		echo '<pre>';
		print_r($d);
		echo '</pre>';
	}

	// Using $wpdb to see if the script is executing inside of wordpress, if not we
	// skip this part
	// Include all wp based scripts inside the "if" statement.
	global $wpdb;
	if (NULL !== $wpdb) {

		require_once (TEMPLATEPATH . "/class.gaparse.php");

		//Init Variables
		global $inspect, $activePost, $page_desafio_mb, $wp_query, $log, $cookieInfo, $totalComments;
		$server = $_SERVER['SERVER_NAME'];
		$cookieInfo = new GA_Parse($_COOKIE);
		//inspect($cookieInfo);
		$log[] = array('$cookieInfo', $cookieInfo);
		$logged = is_user_logged_in();
		$currentPost = currentID();
		$totalComments = new User;
		$totalComments = $totalComments -> totalComments();
		$alreadyCommented = FALSE;
		$activePost = FALSE;
		$active = array();
		$closed = array();
		$s = array();

		global $fb_user;
		$fb_user = null;
		//facebook user uid
		try {
			include_once "fb/facebook.php";
		} catch(Exception $o) {
			echo '<pre>';
			print_r($o);
			echo '</pre>';
		}

		// Create our Application instance.
		$facebook = new Facebook(array('appId' => $fbconfig['appid'], 'secret' => $fbconfig['secret'], 'cookie' => true, ));

		$userData = NULL;

		//Facebook Authentication part
		$fb_user = $facebook -> getUser();
		// We may or may not have this data based
		// on whether the user is logged in.
		// If we have a $user id here, it means we know
		// the user is logged into
		// Facebook, but we donï¿½t know if the access token is valid. An access
		// token is invalid if the user logged out of Facebook.

		//inspect($fb_user);
		//inspect($userData);

		$loginUrl = $facebook -> getLoginUrl(array('canvas' => 1, 'fbconnect' => 0, 'scope' => 'email,user_about_me,offline_access,publish_stream', 'redirect_uri' => $fbconfig['appBaseUrl']));
		
		if ($fb_user) {
			try {
				// Proceed knowing you have a logged in user who's authenticated.
				$userData = $facebook -> api('/me');
				//inspect($userData);

			} catch (FacebookApiException $e) {
				//you should use error_log($e); instead of printing the info on browser
				//inspect($e);  // d is a debug function defined at the end of this file
				$fb_user = null;
				header("Location:".curPageURL());
			}
		} else {
			if(!$logged&&(isset($_GET['callbacklink']))) {
				header("Location: $loginUrl");
			}
		}

		if ($logged) {
			//$inspect = TRUE;
		} else {
			//$inspect = FALSE;
		};

		function curPageURL() {
			$pageURL = 'http';
			if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
				$pageURL .= "://";
			if ($_SERVER["SERVER_PORT"] != "80") {
				$pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
			} else {
				$pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
			}
			return $pageURL;
		}

		//inspect(currentID());

		// deciding on which post to get
		$arg = array('post_type' => 'desafio_2013', 'order' => 'ASC');

		$queryObject = new WP_Query($arg);
		$p = $queryObject -> posts;

		foreach ($p as $key => $value) {
			$page_desafio_mb -> the_meta($value -> ID);
			$meta = $page_desafio_mb -> meta;
			$status = $meta['status'];

			$s[$value -> ID] = $status;

			if ('active' == $status) {
				//gets first active
				$active[] = $value -> ID;
				//break;
			}
			if ('closed' == $status) {
				//gets last closed
				$closed[] = $value -> ID;
			}
		}

		if ((in_array($currentPost, $active)) or ((is_single($currentPost) && (('closed' == $s[$currentPost]) or $logged)))) {
			$activePost = $currentPost;
		} elseif (!empty($active)) {
			$activePost = $active[0];
		} else {
			$activePost = array_pop($closed);
		}

		//////////////////////////////////////////////////////////////////////////////
		//inspect($facebook);
		$signed_request = $facebook -> getSignedRequest();
		$log[] = $signed_request;

		$page_id = $signed_request["page"]["id"];
		$like_status = $signed_request["page"]["liked"];
		$app_data = $signed_request["app_data"];
		//inspect($signed_request);
		$app_data = json_decode($app_data);
		$log[] = $app_data;
		$log[] = array('$activePost', $activePost);
		$log[] = array('$s[$app_data -> page]', $s[$app_data -> page]);		

		//redirect to new page
		if (NULL != $app_data) {
			//if (NULL) {
			//any echoed or inspected elements will be lost when redirected
			//the redirect doesn't receive appdata

			//check if it is closed if so use activePost
			if ($activePost != $app_data -> page) {
				//do nothing no need to redirect
			} elseif ($s[$app_data -> page] == 'locked') {
				header('Location: ' . get_permalink($activePost));
				exit();
			} else {
				$activePost = $app_data -> page;
				header('Location: ' . get_permalink($activePost));
				exit();
			}

		}

		//final settings after finilizing $activePost
		$page_desafio_mb -> the_meta($activePost);
		$meta = $page_desafio_mb -> meta;
		$status = $meta['status'];

		//////////////////////////////////////////////////////////////////////////////

		//echo '<pre>'.$inspect.'</pre>';

		$app_data = '';
		$app_data = urlencode(json_encode(array('page' => $activePost)));
		$app_data = 'app_data=' . $app_data;
		$fbURL = FB_APP_URL;
		$p = strpos($fbURL, '?');
		if (FALSE === $p) {
			//$fbURL = FB_APP_URL . '?' . $app_data;
		} else {
			//$fbURL = FB_APP_URL . '&' . $app_data;
		}
		
		$loginUrl = $facebook -> getLoginUrl(array('canvas' => 1, 'fbconnect' => 0, 'scope' => 'email,user_about_me,offline_access,publish_stream', 'redirect_uri' => $fbURL));

		if (!$fb_user and !$logged) {

			//$log[] = array('$fb_user',$fb_user);
			//$log[] = array('$logged',$logged);
			//$log[] = array('fanpage', 'true');
			require ('fanpage.php');
			/*echo "<script type='text/javascript'>top.location.href = '$loginUrl';</script>";*/
			//exit ;
		}

		// prevents localhost CURL fatal error for facebook while using SSL
		//inspect($activePost);
		//inspect($currentPost);
		//inspect(is_single($currentPost));
		//inspect($logged);

		// Gets current user information from FB
		// only if on if not on locahost, single post (admin panel for tests) and not
		// logged in
		// this is needed for normal pages and singles
		// not needed for Test admin panel
		if (($server != '192.168.0.22') && is_single($currentPost) && !$logged) {
			$userInfo = $facebook -> api("/$fb_user");
		}

		//echo '<p>fbmain.php</p>';

	}
