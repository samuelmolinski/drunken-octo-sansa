<div class="desafios auth">
    <?php get_template_part('statusBanner'); ?>
</div>
<div class="inscreva-se">
    <div class="clique">
        <a href='https://www.facebook.com/vestibularfgv/app_192759390836325'  onClick='_gaq.push(["_trackEvent", "interacao", "clicouInscrevase", "linkTop"]);' target="_blank" style='text-indent: -9999em;'>
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
   
   		<!--<a href="https://twitter.com/share" class="twitter-share-button" data-url="http://goo.gl/FvXES" data-text="Encare os desafios que a FGV preparou pra você." data-lang="pt">Tweetar</a>   -->
       
       <div class="twitter-share-button" style="margin-right:9px; float:right"><a href="javascript:;" onClick="abre('https://twitter.com/intent/tweet?original_referer=https://twitter.com/intent/tweet?original_referer=https://www.vestibularfgv.com.br/2013CLONE/&ref=ts&source=tweetbutton&text=Encare os desafios que a FGV preparou pra você.&url=http://goo.gl/FvXES');_gaq.push(['_trackEvent', 'compartilhamento', 'twittter', 'linkHeader']);"><img src="<?php bloginfo("template_directory"); ?>/assets/image/compartilharTwitter.png" width="66" height="20" /></a></div>
                                                                   
       
      
		<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
        
        <script type="text/javascript">
			var url_final = jQuery("#url_post_final").val();
        	
        </script>
    </div>
</div>
<!-- <div class="escolha"></div> -->