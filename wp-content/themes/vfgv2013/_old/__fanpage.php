<?php get_header(); ?>
			<!-- <script>jquery(document).ready(function() {jQuery('body').fadeIn(); console.debug('fan page fade')});</script>-->
			 <div id="content">
				<div id="inner-content" class="wrap clearfix">
					
					<div id="main" class="eightcol clearfix" role="main">
                              <a href='<?php if($cookieInfo) { buildLink('http://fgv.br/vestibular', $cookieInfo, 'facebookFanPage', 'paginadesafios', 'linkTop', 'vestibular_2012_2_promo');} else { echo 'http://fgv.br/vestibular?utm_source=facebookFanPage&utm_medium=linkTop&utm_content=paginadesafios&utm_campaign=vestibular_2012_2_promo';} ?>'  onClick='_gaq.push(["_trackEvent", "interacao", "clicouFGV", "linkTop"]);' id='home' id='home' target="_blank"></a>
                              <a href='<?php if($cookieInfo) { buildLink('http://vestibular.fgv.br/curso/curso-de-administracao-de-empresas-sp', $cookieInfo, 'facebookFanPage', 'paginadesafios', 'linkFooter', 'vestibular_2012_2_promo');} else { echo 'http://vestibular.fgv.br/curso/curso-de-administracao-de-empresas-sp?utm_source=facebookFanPage&utm_medium=linkFooter&utm_content=paginadesafios&utm_campaign=vestibular_2012_2_promo';} ?>'  onClick='_gaq.push(["_trackEvent", "interacao", "clicouFGV", "linkFooter"]);' id='course' target='_blank'></a>
						
						<div id="frame">
							<div id="statusBanner">
								<div class="descriptionBanner">
								</div>
								<div class="companies">
									<?php get_template_part('statusBanner'); ?>
								</div>
								<div class="cap"></div>
							</div>
							
							<?php 						
								$arg = array (
									'post_type' => 'desafio_2012-2', 
									'page_id' => $activePost,
									'order' => 'ASC'
								);
								$queryObject = new WP_Query($arg);
								
								if ($queryObject->have_posts()) {
									while ($queryObject->have_posts()) {
										$queryObject->the_post();
										
										global $page_desafio_mb, $totalComments;
										$page_desafio_mb->the_meta($activePost);
										$meta = $page_desafio_mb->meta;
										$status = $meta['status'];
										
										$winner = new User();
										$winner->getWinner($post->ID);
										
                                                  if (NULL != $winner->fb_ID) { $winnerOK = TRUE; } else { $winnerOK = FALSE; }
                                                  
                                                  $u = new User();
                                                  $allOtherComments = $u->getCommentsForPost($activePost);
                                                  
                                                  if('closed' != $status) {								
							?>							
								<div id="midBox" >	
									<div id="videoDesafio">
										<iframe width="510" height="280" src="https://www.youtube.com/embed/<?php echo cleanVideoURL($meta['linkVideo']); ?>&amp;wmode=transparent" frameborder="0" allowfullscreen></iframe>
									</div>
									<div class="clearfix"></div>
								</div>								
                                        <?php require ('socialMedia.php'); ?>
								<a id='userAuth' href='#' onclick='_gaq.push(["_trackEvent", "interacao", "autorizou", "<?php echo html_entity_decode(get_the_title($activePost)) ?>"]); setTimeout(function() {top.location.href = "<?php echo $loginUrl; ?>"}, 1500);'></a>
								<div id="commentsDesafio">
									<form name="fb_commentForm" method="">
                                                  <input type="hidden" name="totalComments" id="totalComments" value="<?php echo $totalComments ?>" />
                                                  <input type="hidden" name="endDate" id="endDate" value="<?php echo $meta['dateEnd']; ?>" /><br />
                                                  <input type="hidden" name="labelTitle" id="labelTitle" value="<?php echo get_the_title($activePost);?>" />
                                                  <!--[if IE]>
										<div id="fb_comment" style="outline: medium none; color: rgb(183, 183, 183);">Responda até o dia <?php echo $meta['dateEnd']; ?>, mas fique atento, você só pode responder uma vez. Boa sorte.</div>
										<![endif]-->
										<!--[if !IE]> -->
										<textarea id="fb_comment" name="fb_comment" rows="4" cols="20">Responda até o dia <?php echo $meta['dateEnd']; ?>, mas fique atento, você só pode responder uma vez. Boa sorte.</textarea>
										<!-- <![endif]-->
										<div class="clearfix"></div>
										<input id="fb_fake" type="button" value="Responder" name="fb_fake" />
									</form>
								</div>
								<?php } elseif (FALSE != $winnerOK) {
                                        //echo "<p> closed + winner</p>"; ?>    
                                        <div id="midBox" class="win">
                                             <div id="videoDesafio" class="ja">
                                                  <iframe class="miniVid" width="325" height="183" src="https://www.youtube.com/embed/<?php echo cleanVideoURL($meta['linkVideo']); ?>&amp;wmode=transparent" frameborder="0" allowfullscreen></iframe>
                                             </div>         
                                             <div id="videoDesafioExt">
                                                  <img src="<?php bloginfo('template_url') ?>/library/images/finished.png" class="desafioTitle" />
                                                  <div class="desafioMsg">
                                                       <img src='https://graph.facebook.com/<?php echo $winner->fb_ID ?>/picture' class="desafioUserPic"/>
                                                       <p><?php echo 'Parabéns, ' . $winner->fb_name . ', vencedor(a) desta etapa. Confira abaixo a resposta vencedora e continue se preparando para o vestibular FGV.'; ?></p>
                                                  </div>
                                             </div>                             
                                             <div class="clearfix"></div>
                                        </div>
                                        <img class="ribbon" src="<?php bloginfo('template_url') ?>/library/images/Respostas2.png" />
                                        <img class="badge" src="<?php bloginfo('template_url') ?>/library/images/winnerbadge.png" />
                                        <div id="commentsDesafio" class="ja win">
                                             <div class="commentWrapper scroll-pane">
                                                  <?php 
                                                       // print users comment first
                                                       if ($winner != NULL) {printComments($winner);}
                                                  ?>
                                             </div>
                                        </div>
                                        <div id='wsm'><?php require ('socialMedia.php'); ?></div>
                                   <?php } else { // closed without winner 
                                        //echo "<p>closed without winner</p>";?> 
                                   
                                        <div id="midBox" >
                                             <div id="videoDesafio" class="ja">
                                                  <iframe class="miniVid" width="325" height="183" src="https://www.youtube.com/embed/<?php echo cleanVideoURL($meta['linkVideo']); ?>?rel=0&amp;wmode=transparent
" frameborder="0" allowfullscreen></iframe>
                                             </div>         
                                             <div id="videoDesafioExt">
                                                  <img src="<?php bloginfo('template_url') ?>/library/images/finished.png" class="desafioTitle" />
                                                  <div class="desafioMsg">
                                                       <img src='<?php bloginfo('template_url') ?>/library/images/unknownUser.png' class="desafioUserPic"/>
                                                       <p><?php echo 'Obrigado a todos que participaram. Estamos analisando as respostas e em breve divulgaremos o vencedor.'; ?></p>
                                                  </div>
                                             </div>                             
                                             <div class="clearfix"></div>
                                        </div>
                                        <?php require ('socialMedia.php'); ?>
                                        <img class="ribbon" src="<?php bloginfo('template_url') ?>/library/images/Respostas.png" />
                                        <div id="commentsDesafio" class="ja">
                                             <div class="commentWrapper scroll-pane">
                                                  <?php 
                                                       // print users comment first
                                                       if ($allOtherComments != NULL) {printComments($allOtherComments);}
                                                  ?>
                                             </div>
                                        </div>
                                   <?php } ?>
							<?php }} ?>					
						</div>										
					
					</div> <!-- end #main -->
					
				</div> <!-- end #inner-content -->
    
			</div> <!-- end #content -->

<?php get_footer();  ?>