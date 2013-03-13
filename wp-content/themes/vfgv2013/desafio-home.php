<div id="content" class='clearfix'>
    <?php get_template_part('topo-2013'); ?>
    <div class="videos-single clearfix">
    	<div class="premio-single ">
        	<img src="<?php echo $meta['fb_post_image_premio']; ?>" alt="" />
        </div>
    	<div class="video-youtube">
        	<?php $url = $meta['linkVideo']; ?>
        	<iframe width="492" height="273" src="https://www.youtube.com/embed/<?php echo cleanVideoURL($url); ?>?rel=0&amp;wmode=transparent" frameborder="0" allowfullscreen></iframe>
        </div>
    </div>
    <div class="resposta-single clearfix">
		<?php 						
		if ('active' == $status) {		
			if (!$alreadyCommented){
				require ('desafioForm.php');
			?>
			<div class="comentarios">
            <div class="flexcroll">
				<?php 
					// print users comment first
					if ($allOtherComments != NULL) {
						printComments($allOtherComments);
					}else{
						echo '<p>Ninguém respondeu ao desafio ainda. Seja o primeiro!</p>';
					}
				?>
			</div>
            </div>				
			<?php
        	}else{
				?>
					<img src="<?php bloginfo('template_url') ?>/assets/image/participou.png" alt="" />
                    <div class="comentarios">
                    <div class="flexcroll">
                  <?php 
                  // print users comment first
                  if ($user != NULL) {printComments($user);}
                  if ($allOtherComments != NULL) {printComments($allOtherComments);}
                  ?>
                  </div>
                  </div>
				<?php
			}
		}elseif(('closed' == $status) && (FALSE != $winnerOK)) {
		?>
			<div id="respostassss" style="background:url(<?php bloginfo('template_url') ?>/assets/image/vencedor.png) no-repeat center center; width: 810px; height:190px;">
            	<p>
	  			  <?php 
	  			  // print users comment first
	  			  if ($winner != NULL) {printWinnersName($winner);}
	  			  ?>                
                </p>
            </div>
				<div class="comentarios">
                <div class="flexcroll">
			  <?php 
			  // print users comment first
			  if ($winner != NULL) {printComments($winner);}
			  ?>
              </div>
			  </div>            
		<?php
		}else{
		?>
			<img src="<?php bloginfo('template_url') ?>/assets/image/encerrado.png" alt="" />
		<div class="comentarios">
        <div class="flexcroll">
		  <?php 
		  // print users comment first
		  if ($user != NULL) {printComments($user);}
		  if ($allOtherComments != NULL) {printComments($allOtherComments);}
		  ?>
		  </div>  
          </div>          
		<?php			
		}
		?>
    </div>
    <script type="text/javascript">
    	//jQuery('.comentarios').jScrollPane();
    </script>
    <?php get_template_part('rodape-2013'); ?>
</div>