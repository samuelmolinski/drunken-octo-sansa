<?php
/*
 * Template Name: Desafio
 */
//facebook application configuration

	
    include_once "fbmain.php";
	
	//inspect(__FILE__);    
	//inspect($activePost);
	
?>
<?php get_header(); ?>
			
			<div id="content" class="PageDesafio" >
				<div id="inner-content" class="wrap clearfix">
					
					<div id="main" class="eightcol clearfix" role="main">
                              <a href='<?php if($cookieInfo) { buildLink('http://fgv.br/vestibular', $cookieInfo, 'facebookFanPage', 'paginadesafios', 'linkTop', 'vestibular_2013_promo');} else { echo 'http://fgv.br/vestibular?utm_source=facebookFanPage&utm_medium=linkTop&utm_content=paginadesafios&utm_campaign=vestibular_2013_promo';} ?>'  onClick='_gaq.push(["_trackEvent", "interacao", "clicouFGV", "linkTop"]);' id='home' target="_blank"></a>
                              <a href='<?php if($cookieInfo) { buildLink('http://vestibular.fgv.br/curso/curso-de-administracao-de-empresas-sp', $cookieInfo, 'facebookFanPage', 'paginadesafios', 'linkFooter', 'vestibular_2013_promo');} else { echo 'http://vestibular.fgv.br/curso/curso-de-administracao-de-empresas-sp?utm_source=facebookFanPage&utm_medium=linkFooter&utm_content=paginadesafios&utm_campaign=vestibular_2013_promo';} ?>'  onClick='_gaq.push(["_trackEvent", "interacao", "clicouFGV", "linkFooter"]);' id='course' target='_blank'></a>
						
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
									'post_type' => 'desafio_2013', 
									'page_id' => $activePost,
									'order' => 'ASC'
								);
                                        
								$queryObject = new WP_Query($arg);
								
								if ($queryObject->have_posts()) {
									while ($queryObject->have_posts()) {
										$queryObject->the_post();
										
										global $page_desafio_mb;
										$page_desafio_mb->the_meta($activePost);
										$meta = $page_desafio_mb->meta;
										
										//inspect($meta);
										$status = $meta['status'];
										
										//facebook stuff
										if (Null != $userData) {
											//inspect($post->ID);
											
											$winner = new User();
                                                       $winner->getWinner($activePost);
                                                       if (NULL != $winner->fb_ID) {
                                                            $winnerOK = TRUE;
                                                       } else {                                             
                                                            $winnerOK = FALSE;
                                                       }
											
											$u = new User();
											$user = $u->getUserComment($userData['id'], $post->ID);
											$allComments = $u->getOtherCommentsForPost($post->ID, $userData['id']);
											//inspect($user);
											//inspect($allComments);

											if ($user->fb_comment) {
												$alreadyCommented = TRUE;
											} else {
											}
											//inspect($alreadyCommented);
										} else {
											$u = new User();
											$user = $u->getUserComment(0, $post->ID);
											$allComments = $u->getOtherCommentsForPost($post->ID, $userData['id']);
										}
                                                  
                                                  //inspect($status);
                                                  //inspect($alreadyCommented);

								if ('active' == $status) {		
									if (!$alreadyCommented){
                                        //echo "<p> no Comment</p>";
							?>							
								<div id="midBox" >	
									<div id="videoDesafio">
										<iframe width="510" height="280" src="https://www.youtube.com/embed/<?php echo cleanVideoURL($meta['linkVideo']); ?>?rel=0&amp;wmode=transparent
" frameborder="0" allowfullscreen></iframe>
									</div>
									<div class="clearfix"></div>
								</div>								
                                        <?php require ('socialMedia.php'); ?>
								<?php require ('desafioForm.php'); ?>		
							
							<?php	} else { // already commented 
							     //echo "<p> Already Commented</p>"; ?>	
							      
								<div id="midBox" >
									<div id="videoDesafio" class="ja">
										<iframe class="miniVid" width="325" height="183" src="https://www.youtube.com/embed/<?php echo cleanVideoURL($meta['linkVideo']); ?>?rel=0&amp;wmode=transparent
" frameborder="0" allowfullscreen></iframe>
									</div>		
									<div id="videoDesafioExt">
										<img src="<?php bloginfo('template_url') ?>/library/images/ja.png" class="desafioTitle ja" />
										<div class="desafioMsg">
											<p>Obrigado por participar. Fique atento ao resultado e participe dos próximos desafios.</p>
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
											if ($user != NULL) {printComments($user);}
											if ($allComments != NULL) {printComments($allComments);}
										?>
									</div>
								</div>
							<?php 								
									} 
								} elseif (('closed' == $status) && (NULL != $winnerOK)) { 
                                        //echo "<p> cloased  with winner</p>";?>	
								<div id="midBox" class="win">
									<div id="videoDesafio" class="ja">
										<iframe class="miniVid" width="325" height="183" src="https://www.youtube.com/embed/<?php echo cleanVideoURL($meta['linkVideo']); ?>?rel=0&amp;wmode=transparent
" frameborder="0" allowfullscreen></iframe>
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
                                        //echo "<p> closed without</p>";?> 
							
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
											if ($user != NULL) {printComments($user);}
											if ($allComments != NULL) {printComments($allComments);}
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