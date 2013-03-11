<?php
    $cookieInfo = new GA_Parse($_COOKIE);
?>
<div class="rodape">
    <div class="video">
      <a href="https://www.youtube.com/embed/pgLW7PaZY3A?rel=0&amp;wmode=transparent" title="Video tutorial Desafio FGV 2013" class="youtube">
        <img src="<?php bloginfo("template_directory"); ?>/assets/image/video-tutorial.png" alt="" />            	
    </a>
    </div>
    <script type="text/javascript">
    	jQuery(".youtube").colorbox({iframe:true, innerWidth:750, innerHeight:450});
    </script>
    <div class="vestibulars">
        <a href='<?php if($cookieInfo) { buildLink('http://vestibular.fgv.br/', $cookieInfo, 'facebookFanPage', 'paginadesafios', 'linkFooter', 'vestibular_2013_promo');} else { echo 'http://vestibular.fgv.br/?utm_source=facebookFanPage&utm_medium=linkFooter&utm_content=paginadesafios&utm_campaign=vestibular_2013_promo';} ?>'  onClick='_gaq.push(["_trackEvent", "interacao", "clicouFGV", "linkFooter"]);' target="_blank" title="Site Vestibular FGV">
            <img src="<?php bloginfo("template_directory"); ?>/assets/image/vestibular.png" alt="" />
        </a>
    </div>
</div>