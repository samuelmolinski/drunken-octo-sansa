<?php
error_reporting(E_ALL);
define('FB_BASEURL', 'https://www.vestibularfgv.com.br/2013CLONE/');

define('FB_ID', '440982045925181');
define('FB_SECRET', 'b8716067e7df5173183aa5865b021657');
//define('FB_APP_URL', 'https://www.facebook.com/vestibularfgv?sk=app_127828760677303');
define('FB_APP_URL', 'https://www.facebook.com/pages/Vestibular-FGV/141618765913092?sk=app_440982045925181');

include_once "inspect.php";
//include_once "fbmain.php";

$fb_user = null;
//facebook user uid
try {
     include_once "fb/facebook.php";
} catch(Exception $o) {
     echo '<pre>';
     print_r($o);
     echo '</pre>';
}
function l($o) {
     echo '<pre>';
     print_r($o);
     echo '</pre>';
}

// Create our Application instance.
$facebook = new Facebook(array('appId' => FB_ID, 'secret' => FB_SECRET, 'cookie' => true, ));

//Facebook Authentication part
$fb_user = $facebook -> getUser();

$message = $picture = $link = $name = $caption = $description = $source = $place = $tags = $app_data = '';

if ($fb_user) {
     //update user's status using graph api
     if (isset($_REQUEST['message'])) {
          if (isset($_REQUEST['message']))
               $message = $_REQUEST['message'];
          if (isset($_REQUEST['picture']))
               $picture = $_REQUEST['picture'];
          if (isset($_REQUEST['link']))
               $link = $_REQUEST['link'];
          if (isset($_REQUEST['post_ID'])) 
               $page = $_REQUEST['post_ID']; 
          if (isset($_REQUEST['name']))
               $name = $_REQUEST['name'];
          if (isset($_REQUEST['caption']))
               $caption = $_REQUEST['caption'];
          if (isset($_REQUEST['description']))
               $description = $_REQUEST['description'];
          if (isset($_REQUEST['source']))
               $source = $_REQUEST['source'];
          if (isset($_REQUEST['place']))
               $place = $_REQUEST['place'];
          if (isset($_REQUEST['tags']))
               $tags = $_REQUEST['tags'];
          try {

               if (isset($page)){
                    $app_data = $page;
                    //inspect($app_data);
                    $app_data = urlencode(json_encode(array('page' =>$app_data)));
                    //inspect($app_data);
                    $app_data = 'app_data='.$app_data;
                    //inspect($app_data);
               }
               
               $fbURL = FB_APP_URL;
               $p = strpos($fbURL, '?');
               if (NULL != $app_data)  {
                    if (FALSE === $p) {
                         $fbURL = FB_APP_URL.'?'.$app_data;
                    } else {
                         $fbURL = FB_APP_URL.'&'.$app_data;
                    }
               }               

               $message = "Vestibular FGV 2013-2 / $caption<br/>\n$message<br/>\n" . FB_APP_URL;
               $statusUpdate = $facebook -> api('/me/feed', 'post', array('message' => $message, 'picture' => $picture, 'link' => $link, 'name' => $name, 'caption' => $caption, 'description' => $description, 'source' => $source, 'place' => $place, 'tags' => $tags));
               //$statusUpdate = $facebook -> api('/me/photos', 'post', array('message' => $message, 'source' => $picture));
          } catch (FacebookApiException $e) {
               d($e);
               echo $_REQUEST['message'];
          }
          echo "Status Update Successfull. " . $_REQUEST['message'];
          //exit ;
          
     }
}

/*l($_REQUEST);
l($fb_user);
l($message);
l($statusUpdate);*/


exit ;