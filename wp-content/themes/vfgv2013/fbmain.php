<?php

	$fbconfig['appid'] = FB_ID;
	$fbconfig['secret'] = FB_SECRET;

	$fbconfig['baseUrl'] = FB_BASEURL;
	// "http://thinkdiff.net/demo/newfbconnect1/iframe/sdk3";
	$fbconfig['appBaseUrl'] = FB_APP_URL;
	// "http://apps.facebook.com/thinkdiffdemo";

	$browser = getBrowserName();
	if (isset($_GET['request_ids'])) {
		//user comes from invitation
		//track them if you need
	}
	require_once ('fb/Class-User.php');

			/*// Start Session Fix
			session_start();
			$page_url = "http://www.facebook.com/vestibularfgv?sk=app_444250602265563";
			if (isset($_GET["start_session"]))
			    die(header("Location:" . $page_url));
			$sid = session_id();
			if (!isset($_GET["sid"]))
			{
			    if(isset($_POST["signed_request"]))
			       $_SESSION["signed_request"] = $_POST["signed_request"];
			    die(header("Location:?sid=" . $sid));
			}
			if (empty($sid) || $_GET["sid"] != $sid)
			    die('<script>top.window.location="?start_session=true";</script>');
			// End Session Fix */

			$facebookpageurl = FB_APP_URL;
			$facebookappid = FB_ID;
			 

	function d($d) {
		echo '<pre>';
		print_r($d);
		echo '</pre>';
	}
			 
	function getBrowserName() {
		$u_agent = $_SERVER['HTTP_USER_AGENT']; 
		if(preg_match('/MSIE/i',$u_agent) && !preg_match('/Opera/i',$u_agent)) { 
			$bname = 'Internet Explorer'; 
		} elseif(preg_match('/Firefox/i',$u_agent)) { 
			$bname = 'Mozilla Firefox'; 
		} elseif(preg_match('/Chrome/i',$u_agent)) { 
			$bname = 'Google Chrome'; 
		} elseif(preg_match('/Safari/i',$u_agent)) { 
			$bname = 'Apple Safari'; 
		} elseif(preg_match('/Opera/i',$u_agent)) { 
			$bname = 'Opera'; 
		} elseif(preg_match('/Netscape/i',$u_agent)) { 
			$bname = 'Netscape'; 
		}
		return $bname;
	}


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

	// Using $wpdb to see if the script is executing inside of wordpress, if not we
	// skip this part
	// Include all wp based scripts inside the "if" statement.
	global $wpdb;
	if (NULL !== $wpdb) {

		require_once (TEMPLATEPATH . "/class.gaparse.php");

		//Init Variables
		global $inspect, $activePost, $page_desafio_mb, $wp_query, $log, $cookieInfo, $totalComments, $loginUrl, $facebook;
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



		// Create our Application instance.
		$facebook = new Facebook(array('appId' => $fbconfig['appid'], 'secret' => $fbconfig['secret'], 'cookie' => true, ));
		$userData = NULL;

		//Facebook Authentication part
		$fb_user = $facebook -> getUser();
		$loginUrl = $facebook -> getLoginUrl(array('canvas' => 1, 'fbconnect' => 0, 'scope' => 'email,user_about_me,offline_access,publish_stream', 'redirect_uri' => $fbconfig['appBaseUrl']));
		$signed_request = $facebook -> getSignedRequest();
		$log[] = $signed_request;

		$page_id = $signed_request["page"]["id"];
		$like_status = $signed_request["page"]["liked"];
		$app_dataJSON = $signed_request["app_data"];
		$app_data = json_decode($app_dataJSON);
		//$log[] = $app_data;
		//$log[] = array('$activePost', $activePost);
		//$log[] = array('$s[$app_data -> page]', $s[$app_data -> page]);	
		//inspect($currentPost);
		//inspect($activePost);

		//inspect('first'); 
		//inspect($loginUrl); 
		if($browser != "Apple Safari") {
			if ($fb_user) {
				try {
					// Proceed knowing you have a logged in user who's authenticated.
					$userData = $facebook -> api('/me');
					//inspect($userData);

				} catch (FacebookApiException $e) {
					//you should use error_log($e); instead of printing the info on browser
					//inspect($e);  // d is a debug function defined at the end of this file
					header("Location:".curPageURL());
					//$loginUrl = $facebook -> getLoginUrl(array('canvas' => 1, 'fbconnect' => 0, 'scope' => 'email,user_about_me,offline_access,publish_stream', 'redirect_uri' => curPageURL()));
			
					//header("Location: $loginUrl");
				}
			} else {
				if(!$logged&&(isset($_GET['callbacklink'])&&($browser != "Apple Safari"))) {
					header("Location: $loginUrl");
				} 
			}
		} else {
			if ($fb_user) {
				try {
					// Proceed knowing you have a logged in user who's authenticated.
					$userData = $facebook -> api('/me');
					//inspect($userData);

				} catch (FacebookApiException $e) {
					//you should use error_log($e); instead of printing the info on browser
					//inspect($e);  // d is a debug function defined at the end of this file
					header("Location:".curPageURL());
					//$loginUrl = $facebook -> getLoginUrl(array('canvas' => 1, 'fbconnect' => 0, 'scope' => 'email,user_about_me,offline_access,publish_stream', 'redirect_uri' => curPageURL()));
			
					//header("Location: $loginUrl");
				}
			} elseif(!$logged&&!isset($_GET['callbacklink'])) {
				session_start();
				//inspect('!$logged&&!isset($_GET[\'callbacklink\'])');
				$page_url = $facebookpageurl;
				
				if(NULL != $app_data) {					
					$p = strpos($page_url, '?');
					if (FALSE === $p) {
						$page_url = $page_url . '?' . $app_data;
					} else {
						$page_url = $page_url . '&' . $app_data;
					}
				}

				$sid = session_id();
				if(isset($_GET['start_session'])) {	
					//inspect('start_session');	
					//inspect($currentPost);
					//inspect($activePost);
					//exit();
					die(header("Location:".$page_url));
				} elseif(!isset($_GET['sid'])) {	
					//inspect('sid');	
					//inspect($currentPost);
					//inspect($activePost);
					//exit();
					die(header("Location:?sid=".session_id()));
				} elseif(empty($sid) || $_GET['sid'] != $sid) {
					//inspect('empty($sid) || $_GET['sid'] != $sid');	
					//inspect($currentPost);
					//inspect($activePost);
					//exit();
					?><script>top.window.location="?start_session=true";</script><?php
				}
			} else {
				header("Location:".curPageURL());
			}
		}
		

		//inspect(currentID());

		

		//////////////////////////////////////////////////////////////////////////////
		//inspect($facebook);
		//inspect($signed_request);	
		//inspect($app_data);
		//inspect(NULL != $app_data);

		//redirect to new page
		if (NULL != $app_data) {
			//if (NULL) {
			//any echoed or inspected elements will be lost when redirected
			//the redirect doesn't receive appdata

			//check if it is closed if so use activePost
			if ($activePost == $app_data->page) {
				//do nothing, no need to redirect
				header('Location: ' . get_permalink($activePost));
				exit();
			} elseif ($s[$app_data->page] == 'locked') {
				header('Location: ' . get_permalink($activePost));
				exit();
			} else {
				$activePost = $app_data->page;
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
			$fbURL = FB_APP_URL . '?' . $app_data;
		} else {
			$fbURL = FB_APP_URL . '&' . $app_data;
		}
		
		$loginUrl = $facebook -> getLoginUrl(array('canvas' => 1, 'fbconnect' => 0, 'scope' => 'email,user_about_me,offline_access,publish_stream', 'redirect_uri' => $fbURL));

		//inspect($fb_user); 
		//inspect($logged); 
		//inspect(is_single($activePost)); 
		if (!$fb_user and !$logged and is_single($activePost)) {
			//$log[] = array('$fb_user',$fb_user);
			//$log[] = array('$logged',$logged);
			//$log[] = array('fanpage', 'true');
			require ('page-fanpage.php');
			//echo "<script type='text/javascript'>top.location.href = '$loginUrl';</script>";
			//exit ;
		}

		if (($server != '192.168.0.22') && is_single($currentPost) && !$logged) {
			$userInfo = $facebook -> api("/$fb_user");
		}

		//echo '<p>fbmain.php</p>';

	}
