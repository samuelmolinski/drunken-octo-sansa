<?php

define('FB_BASEURL', 'https://www.vestibularfgv.com.br/2013CLONE/');

define('FB_ID', '440982045925181');
define('FB_SECRET', 'b8716067e7df5173183aa5865b021657');
//define('FB_APP_URL', 'https://www.facebook.com/vestibularfgv?sk=app_127828760677303');
define('FB_APP_URL', 'https://www.facebook.com/pages/Vestibular-FGV/141618765913092?sk=app_440982045925181');

include_once "fbmain.php";
include_once "inspect.php";

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

               $message = "\n" . $fbURL;
               $statusUpdate = $facebook -> api('/me/feed', 'post', array('message' => $message, 'picture' => $picture, 'link' => $link, 'name' => $name, 'caption' => $caption, 'description' => $description, 'source' => $source, 'place' => $place, 'tags' => $tags));
          } catch (FacebookApiException $e) {
               d($e);
               echo $_REQUEST['message'];
          }
          echo "Status Update Successfull. " . $_REQUEST['message'];
          //exit ;
          
     }
}

inspect($_REQUEST);
inspect($fb_user);
inspect($message);
inspect($statusUpdate);


exit ;
?>