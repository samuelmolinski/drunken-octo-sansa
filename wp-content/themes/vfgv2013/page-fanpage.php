<?php
/*
 * Template Name: Desafio
 */
//include_once "fbmain.php";
//inspect(__FILE__);    
//inspect($activePost);
?>
<?php get_header(); ?>
    <div id="content" class="homeHeight">
        <div>
            <a href="<?php echo $loginUrl; ?>" style="display: block; width: 100%; height: 80px; position: absolute; " target="_top"></a>
        </div>
        <div class="desafios unauth">
            <?php get_template_part('statusBannerUnauth'); ?>
        </div>
        <div class="inscreva-se">
            <div class="clique">
                <a href='https://www.facebook.com/vestibularfgv/app_192759390836325'  onClick='_gaq.push(["_trackEvent", "interacao", "clicouInscrevase", "linkTop"]);' target="_blank">
                    <?php _e("clique e inscreva-se no vestibular FGV")?>
                </a>
            </div>
            <div class="share">
                <script>
                    function abre(x,y) {                    
                        var w = 1000;                        
                        var h = 480;                        
                        var lado = (screen.width - w) / 2;                        
                        var topo = (screen.height - h) / 2;                        
                        window.open(x,y,'height='+h+',width='+w+',top='+topo+',left='+lado+'');                    
                    }
                </script>
                <div class="fb-like"><a href="javascript:;" onClick="abre('https://www.facebook.com/dialog/feed?app_id=440982045925181&link=https%3A//www.vestibularfgv.com.br/2013CLONE%3Futm_source%3DfacebookWall%26utm_medium%3DclickFacebookWall%26utm_campaign%3DsharedNoWall&picture=<?php bloginfo("template_directory"); ?>/assets/image/logoFanPage.jpg&name=Desafio%20FGV&caption=Vai encarar o desafio do vestibular?&description=Então encare também os que a FGV e grandes empresas prepararam para você.&redirect_uri=<?php bloginfo("template_directory"); ?>/closepage.php');_gaq.push(['_trackEvent', 'compartilhamento', 'facebookTimeline', 'linkHeader']);"><img src="<?php bloginfo("template_directory"); ?>/assets/image/compartilhar.png" width="97" height="20" /></a></div>
                <div class="twitter-share-button" style="margin-right:9px; float:right"><a href="javascript:;" onClick="abre('https://twitter.com/intent/tweet?original_referer=https://twitter.com/intent/tweet?original_referer=https://www.vestibularfgv.com.br/2013CLONE/&ref=ts&source=tweetbutton&text=Encare os desafios que a FGV preparou pra você.&url=http://goo.gl/FvXES');_gaq.push(['_trackEvent', 'compartilhamento', 'twittter', 'linkHeader']);"><img src="<?php bloginfo("template_directory"); ?>/assets/image/compartilharTwitter.png" width="66" height="20" /></a></div>

                <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
                
                <script type="text/javascript">
                    var url_final = jQuery("#url_post_final").val();
                    
                </script>
            </div>
        </div>
        <!-- <div class="escolha"></div> -->
        <div class="desafios-on">
            <ul>
                <?php 
                global $page_desafio_mb, $activePost, $activeImgURL; 
                $arg = array ('post_type' => 'desafio_2013', 'order' => 'ASC' ); 
                $queryObject = new WP_Query($arg);
                
                if ($queryObject->have_posts()) {while ($queryObject->have_posts()) {$queryObject->the_post();
                    $page_desafio_mb->the_meta(); 
                    $meta = $page_desafio_mb->meta; 

                    //d($post->ID);

                    $app_data = '';
                    $app_data = urlencode(json_encode(array('page' => $queryObject->post->ID)));
                    $app_data = 'app_data=' . $app_data;
                    $fbURL = FB_APP_URL;
                    $p = strpos($fbURL, '?');
                    if (FALSE === $p) {
                        $fbURL = FB_APP_URL . '?' . $app_data;
                    } else {
                        $fbURL = FB_APP_URL . '&' . $app_data;
                    }
                    
                    $loginUrl = $facebook -> getLoginUrl(array('canvas' => 1, 'fbconnect' => 0, 'scope' => 'email,user_about_me,offline_access,publish_stream', 'redirect_uri' => $fbURL));

                ?>
                    <?php if($meta['status'] == 'active') { ?>
                        <li><a href="<?php echo $loginUrl; ?>" target="_top"><img src="<?php echo $meta['fb_post_image_home']; ?>" alt="<?php the_title(''); ?>" /></a></li>
                    <?php } ?>
                <?php }} ?>
            </ul>
        </div>
    </div>
<?php get_footer();  ?>
        