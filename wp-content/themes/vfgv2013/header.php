<?php
header('P3P: CP="IE is often a NIGHTMARE"');

	global $activePost, $fb_user;;
  	//inspect($fb_user);
	
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
        
        <link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>">
		
		<!-- icons & favicons (for more: http://themble.com/support/adding-icons-favicons/) -->
		<link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/favicon.ico">

  		<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
		
		<!-- wordpress head functions -->
		<?php wp_head(); ?>
		<script type="text/javascript">if(!window.log) {window.log = function() {log.history = log.history || [];log.history.push(arguments);if(this.console) {console.log(Array.prototype.slice.call(arguments));}};}</script>
        <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/assets/js/jquery.colorbox.js"></script>
        <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/assets/js/flexcroll.js"></script>
        <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assets/styles/colorbox.css">        
		<!-- <script src="https://cdn.jquerytools.org/1.2.6/tiny/jquery.tools.min.js"></script> -->
		<!--<script type="text/javascript" src="https://connect.facebook.net/pt_BR/all.js#appId=<?php echo FB_ID ?>"></script>-->
        <script type="text/javascript" src="https://connect.facebook.net/pt_BR/all.js"></script>
		
		<script type="text/javascript">
		   
		window.fbAsyncInit = function() {
		
			FB.init({
			 appId  : '<?php echo FB_ID ?>',
			 status : true, // check login status
			 cookie : true, // enable cookies to allow the server to access the session
			 xfbml  : true// parse XFBML
			 });
			 

        };	

		function pegar(altura){
			//log("altura:" + altura);
			FB.Canvas.setSize({ width: 810, height: altura });
		}
			
        function newInvite(){
			jQuery("#videoDesafio").hide();
             var receiverUserIds = FB.ui({ 
                    method : 'apprequests',
                    message: 'Que amigos você deseja convidar para o Desafio FGV?',
             },
             function(receiverUserIds) {
                      //console.log("IDS : " + receiverUserIds.request_ids);
					  jQuery("#videoDesafio").show();
                    }
             );   
        }
        
		(function(){
			 var twitterWidgets = document.createElement('script');
			 twitterWidgets.type = 'text/javascript';
			 twitterWidgets.async = true;
			 twitterWidgets.src = 'https://platform.twitter.com/widgets.js';
			 // Setup a callback to track once the script loads.
			 //twitterWidgets.onload = _ga.trackTwitter;
			 document.getElementsByTagName('head')[0].appendChild(twitterWidgets);
		 })();
		  
        function updateStatus(msg, pic, l, n, cap, des, s, p, t){
            
            jQuery.ajax({
                type: "POST",
                url: "<?php bloginfo('template_url'); ?>/ajax.php",
                fb: jQuery("#fb_holder").val(),
                data: {
                	message: msg,
                	picture: pic, 
                	link: l,
                	name: n,
                	caption: cap,
                	description: des,
                	source: s,
                	place: p,
                	tags: t
                },
                success: function(msg){
                },
                error: function(msg){
                     //console.debug('updateStatus failed')
                }
            });            
        }

		//TIME OUT DO CANVAS
		jQuery(function(){				
			
			<?php if(is_single()){ ?>
				log('setting height');
				setInterval(function(){
					pegar(1100);
				}, 1000);
			<?php }else{ ?>
				
				setInterval(function(){
					var altura = jQuery("#altura").height();
					altura = (altura + 180);
					pegar(altura);
				}, 1000);
			<?php } ?>
		});
		</script> 
		
		<meta property="fb:admins" content="100000220196116,1049257200,679573088"/>
		
		<?php	if ( !(is_user_logged_in()) ) {
			$app_data = '';
			
			if (isset($_GET['page'])){
				$app_data = $_GET['page'];
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
			//inspect($fbURL);
			
			//inspect($app_data);
		?>
		
		<script type="text/javascript">
		
		
		var FacebookURL = '<?php echo $fbURL ?>';
		
		  var _gaq = _gaq || [];
		  	//FGV
		  	_gaq.push(['_setAccount', 'UA-21723915-21']);
			_gaq.push(['_setDomainName', 'none']);
		  	_gaq.push(['_addIgnoredRef', 'static.ak.facebook.com']);
		  	_gaq.push(['_setAllowAnchor', true]);
			_gaq.push(['_setAllowHash', false]);
			_gaq.push(['_setAllowLinker', true]);
			
			function checkIfAnalyticsLoaded() {
			   if (window._gat && window._gat._getTracker && self.location == top.location) {
				// Create a fake URL that we can filter in Google Analytics. This pageview also sends the traffic/campaign data to Google Analytics. Consider naming the fake URL so you can differentiate between the different Iframes.
				_gaq.push(['_trackPageview', '/facebookFanPage/<?php echo html_entity_decode(get_the_title($activePost)); ?>/']); //needs to be the same for post single and page
				// Tracking done, let's frame the page
				setTimeout(top.location.href = FacebookURL, 200);
				//console.debug('1');
				} else if (self.location != top.location) {
				 _gaq.push(['_trackPageview', '/facebookFanPage/<?php echo html_entity_decode(get_the_title($activePost)); ?>/']);
				 jQuery(document).ready(function(){jQuery('#container').fadeIn(); });
				//console.debug('2');
			  } else {
				// Probably want to cap the total number of times you call this.
				setTimeout('checkIfAnalyticsLoaded()', 500);
				//console.debug('3');
			  }
		    };
						
			checkIfAnalyticsLoaded();
			
			//remove this on live
			//jQuery(document).ready(function(){jQuery('#container').fadeIn(); });

		(function() {
		var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
		ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
		var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
		})();
		
		</script>
		
		<?php } ?>
				
		<!-- end of wordpress head -->
		<script src="<?php echo get_template_directory_uri(); ?>/library/js/custom.js"></script>
		<script src="<?php echo get_template_directory_uri(); ?>/library/js/jquery.tools.min.js"></script>
        
        <script language="javascript" type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/library/js/jquery.carousel.min.js"></script>
        <script language="javascript" type="text/javascript">
    jQuery(window).load(function() {
        //$('#slider').nivoSlider();
		jQuery("#carousel").carousel({ dispItems: 5, animSpeed: "slow", loop: true });		
		jQuery("#carousel").delay(1500);	
		jQuery("#carousel").css('margin-left', 'auto')
		
    });
   
	
</script>
		<!-- load all styles for IE -->
		<!--[if (lt IE 9) & (!IEMobile)]>
    		<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/library/css/ie.css">
		<![endif]-->
		<?php
		global $logged, $fb_user;
			if($logged) {
				echo "<style>body, #frame {overflow:visible !important;} #container {display:block !important;}</style>";
			} 
		?>
		<!-- Coloque esta tag na tag "head" ou logo antes da tag "body" final -->
		<script type="text/javascript" src="https://apis.google.com/js/plusone.js">
		  {lang: 'pt-BR'}
		</script>        
	</head>
	
	<body <?php body_class(); ?>>
	     <div id='preloader'>
               <img src="<?php bloginfo('template_url') ?>/library/images/socialMedia_bg-F.png" />
               <img src="<?php bloginfo('template_url') ?>/library/images/socialMedia_bg-I.png" />
               <img src="<?php bloginfo('template_url') ?>/library/images/socialMedia_bg-T.png" />
               <?php //global $log; inspect($log, 1); ?>
	     </div>
		<div id="fb-root"></div>
		<div id="container">
        <div id="altura" class='clearfix'>
