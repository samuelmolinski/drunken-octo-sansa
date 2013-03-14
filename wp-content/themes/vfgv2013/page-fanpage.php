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
        <?php get_template_part('topo-2013'); ?>
        <div class="desafios-on">
            <ul>
                <?php 
                global $page_desafio_mb, $activePost, $activeImgURL; 
                $arg = array ('post_type' => 'desafio_2013', 'order' => 'ASC' ); 
                $queryObject = new WP_Query($arg);
                
                if ($queryObject->have_posts()) {while ($queryObject->have_posts()) {$queryObject->the_post();
                    $page_desafio_mb->the_meta(); 
                    $meta = $page_desafio_mb->meta; 
                ?>
                    <?php if($meta['status'] == 'active'){?>
                        <li><a href="<?php echo $loginUrl; ?>" target="_top"><img src="<?php echo $meta['fb_post_image_home']; ?>" alt="<?php the_title(''); ?>" /></a></li>
                    <?php } ?>
                <?php }} ?>
            </ul>
        </div>
    </div>
<?php get_footer();  ?>
        