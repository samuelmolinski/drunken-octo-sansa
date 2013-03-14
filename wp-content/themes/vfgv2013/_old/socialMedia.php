<?php 
	
      //shortenUrl($meta['linkShort']);
     
     //$status  add: Curti a reposta do vencedor no Desafio FGV | Santander. 
     //inspect($status);
     //inspect($winnerOK);
     if (('closed' == $status) && (FALSE != $winnerOK)){
         $t = 'Curti a reposta do vencedor no Desafio FGV | '. html_entity_decode(get_the_title($activePost));
         $link = genURL($activePost, $t);
         $link .= '&win=ok';
     } else {	 
          $t = 'Participe do Desafio FGV e mostre que você mandou bem ao escolher administração no vestibular.';
          //$t = 'Participe do Desafio FGV | '. html_entity_decode(get_the_title($activePost)) . ' e mostre que você mandou bem ao escolher administração no vestibular.';
          //'http://cabanapps.com.br/vestibular2013.php?forwardURL=https%3A%2F%2Fwww.vestibularfgv.com.br%2F2013%2F%3Fdesafio_2013%3Dca-2&page=&image=https%3A%2F%2Fwww.vestibularfgv.com.br%2F2013%2Fwp-content%2Fuploads%2F2012%2F03%2FCeA.jpg&title=C%26%23038%3BA&description=Curti+a+reposta+do+vencedor+no+Desafio+FGV+%7C+C%26%23038%3BA&win=ok';
          $link = genURL($activePost, $t);
     }
     //inspect($t);
     //inspect($link);
	$shortLink = shortenUrl($link);
	$d = urlencode($t);
?>
<div class="socialMedia">
    <script type="text/javascript">function fbs_click() {u='<?php echo addslashes($link); ?>';t=document.title;window.open('http://www.facebook.com/sharer.php?u='+encodeURIComponent(u)+'&t='+'<?php echo $d; ?>','sharer','toolbar=0,status=0,width=650,height=460');return false;}
                                   function tws_click() {u='<?php echo $t; ?>';t=document.title;window.open('https://twitter.com/intent/tweet?via=VestibularFGV&text='+encodeURIComponent(u)+'&url=<?php echo $shortLink['id'] ?>','sharer','toolbar=0,status=0,width=650,height=460');return false;}</script>
    <a href='#' class="convida" onClick='_gaq.push(["_trackEvent", "compartilhamento", "convidou", "<?php echo html_entity_decode(get_the_title($activePost)) ?>"]); newInvite(); return false;' ></a>
    <div class="links">
        <a href="#" onclick=' fbs_click(); _gaq.push(["_trackEvent", "compartilhamento", "facebook", "<?php echo html_entity_decode(get_the_title($activePost)) ?>"]); return false;' target="blank"  class="ft fb"></a>						
        <a href="#" onclick=' tws_click(); _gaq.push(["_trackEvent", "compartilhamento", "twittter", "<?php echo html_entity_decode(get_the_title($activePost)) ?>"]); return false;' title="Clique aqui para compartilhar este post no Twitter" target="blank" class="ft tw"></a>							
        <div class="tiny" id='tiny' ><?php echo $shortLink['id'] ?></div>
    </div>
</div>