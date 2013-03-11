<?php 
     $l = genURL($activePost);
	//global $totalComments;
	//inspect(__FILE__);
 ?>
<div id="commentsDesafio">
  <form name="fb_commentForm" method="POST">
    <input type="hidden" name="labelTitle" id="labelTitle" value="<?php echo $meta['inputFrase']; ?>" />
    <input type="hidden" name="msg" id="msg" value="" />
    <input type="hidden" name="pic" id="pic" value="<?php echo $meta['fb_post_image']; ?>" />
    <input type="hidden" name="l" id="l" value="<?php echo $l; ?>" />
    <input type="hidden" name="cap" id="cap" value="Vestibular FGV 2013" />
    <input type="hidden" name="n" id="n" value="Vestibular FGV 2013 - <?php echo $meta['shareTitle']; ?>" />
    <input type="hidden" name="des" id="des" value="<?php echo $meta['shareFrase']; ?>" />
    <input type="hidden" name="fb_ID" id="fb_ID" value="<?php echo $userData['id'] ?>" />
    <input type="hidden" name="fb_name" id="fb_name" value="<?php echo $userData['name'] ?>" />
    <input type="hidden" name="post_ID" id="post_ID" value="<?php echo $activePost; ?>" />
    <input type="hidden" name="url_post_final" id="url_post_final" value="https://www.facebook.com/vestibularfgv?sk=app_440982045925181" />
    <div class="fb_commentWrapper">
      <textarea id="fb_comment" name="fb_comment" rows="4" cols="20"><?php echo $meta['inputFrase']; ?></textarea>
    </div>
    <input id="fb_submit" type="button" value=" " name="fb_submit" style="display: none;" />  
    <div class="publicar-fb" style="display: none;">
		<label for='fb_status'><span>Publicar minha participação no mural</span>
			<input id="fb_status" type="checkbox" checked="true" name="fb_status"  onClick='_gaq.push(["_trackEvent", "interacao", "respondeu", "<?php echo html_entity_decode(get_the_title($activePost)) ?>"]);' />
		</label>    
    </div>
  </form>
</div>
