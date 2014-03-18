FB.login(function(response) { 
     if (response.authResponse) { 
          var access_token =   FB.getAuthResponse()['accessToken']; 
          console.log('Access Token = '+ access_token); 

          FB.api('me/photos', 'post', { 
               message: 'has shared Picture', 
               status: 'success', 
               access_token: access_token, 
               url: jQuery('#pic').val()  
          }, function (response) { 

               if (!response || response.error) { 
                    log('Error occured:', response); 
               } else { 
                    log('Post ID: ', response.id); 
               } 

          }); 
     } else { 
          log('User cancelled login or did not fully authorize.'); 
     } 
}, {scope: 'user_photos,photo_upload,publish_stream,offline_access'});



=======================================================================================================


/*img.src = "https://graph.facebook.com/<album_id>/picture?access_token=' + 
           FB._session.access_token;*/


=======================================================================================================


FB.api('/<?=$album_id?>/photos?access_token=<?=$fanpage_token?>', 'post', {
      message: ementa,
      url: selected_image
      }, function(response) {
    if (!response || response.error) {
      alert('Falhou a publicar a ementa com imagem');
    } else {
      alert('Page Post ID: ' + response.id);
    }
  });

$args = array('message' => 'Photo Caption');
$args['image'] = '@' . realpath($FILE_PATH);

$data = $facebook->api('/'. $ALBUM_ID . '/photos', 'post', $args);
print_r($data);


=======================================================================================================
 var connecter=false;
  window.fbAsyncInit = function() {
    FB.init({
      appId      : 'xxxxxxx', // App ID
      oauth      : true,
      channelUrl : '//www.streamazing.net/js/channel.html', // Channel File
      status     : true, // check login status
      cookie     : true, // enable cookies to allow the server to access the session
      xfbml      : true  // parse XFBML
    });

    FB.Event.subscribe('auth.login', function (response) {
               window.location.reload();
            });

    FB.Event.subscribe('auth.logout', function (response) {
               window.location.reload();
            });

    FB.getLoginStatus(function(response) {
            if (response.status === 'connected') {
                connecter=true;
                FB.api('/me', function(user) {
                var user2=user;
                console.log(user2.name);

                });

            }
        else connecter=false;
        });

    var body = 'This is a test';
                FB.api('/me/feed', 'post', { message: body }, function(response) {
                    if (!response || response.error) {
                        console.log(response.error);
                    } else {
                        alert('Post ID: ' + response.id);
                    }
                });
};



========================================================================================================


$album_name = 'Myname';
$album_description = 'Mydesc';

post_login_url = "http://apps.facebook.com/likeablephotos/";

$access_token = "XXX (a valid token)";
// Create a new album
$graph_url = "https://graph.facebook.com/422287937792470/albums?" . "access_token=". $access_token;

$postdata = http_build_query(
    array(
        'name' => $album_name,
        'message' => $album_description
    )
);
$opts = array('http' =>
    array(
        'method'=> 'POST',
        'header'=>
        'Content-type: application/x-www-form-urlencoded',
        'content' => $postdata
    )
);
$context  = stream_context_create($opts);
$result = json_decode(file_get_contents($graph_url, false, $context));