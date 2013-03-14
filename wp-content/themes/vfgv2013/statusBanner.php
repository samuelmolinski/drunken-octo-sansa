<div id="carousel">
<ul>
<?php
	global $page_desafio_mb, $activePost, $activeImgURL, $loginUrl;
    $arg = array (
        'post_type' => 'desafio_2013', 
		'order' => 'ASC'
    );
    $queryObject = new WP_Query($arg);
    //the loop...
    if ($queryObject->have_posts()) {
        while ($queryObject->have_posts()) {
            $queryObject->the_post();
			
			$imgsrc = get_post_image_scr();
			if ($activePost == $post->id) {$activeImgURL = $imgsrc;}
			$img = get_crop_image($imgsrc, '&amp;w=94&amp;h=63&amp;zc=1');

			$page_desafio_mb->the_meta();
			$meta = $page_desafio_mb->meta;
			$addLink = FALSE;
			
			if(($meta['status'] == 'active' || $meta['status'] == 'closed')) {$addLink = TRUE;}
			
			if($meta['status']== 'locked') {
				$status = '&nbsp;';
			} elseif($meta['status']== 'active')  {
				$status = 'Desafio Ativo';
			} elseif($meta['status']== 'closed')  {
				$status = 'Encerrado';
			}
			
			if ($meta['status']== 'active') {
				$img = get_crop_image($imgsrc, '&amp;w=85&amp;h=60&amp;zc=1', '', get_the_title());
			} else {
				$imgsrc = desaturateImg($imgsrc);
				$img = get_crop_image($imgsrc, '&amp;w=85&amp;h=60&amp;zc=1', 'c', get_the_title());
			}
               
               if ('locked' == $meta['status']){
                    $title = "title='Esse desafio começa dia ${meta['dateStart']}'";
               }
?>
	
	
    	
	<li class="carouselItem">

        <div class="company" <?php echo $title ?> >
            <?php if ($addLink) { ?><a href="<?php if(!$fb_user) { echo $loginUrl; } else {the_permalink(); } ?>" ><?php } ?>
            <?php echo $img; ?>
            <span class="status <?php echo $meta['status'] ?>"><?php echo $status ?></span>		
            <?php if ($addLink) { ?></a><?php } ?>		
        </div>
    </li>
<?php }}?>
</ul>
</div>
<script>
		// initialize tooltip
	jQuery("div.company[title]").tooltip({
	 
	   // tweak the position
	   offset: [10, 2],
	 
	   // use the "slide" effect
	   effect: 'slide'
	 
	// add dynamic plugin with optional configuration for bottom edge
	}).dynamic({ bottom: { direction: 'down', bounce: true } });
</script>