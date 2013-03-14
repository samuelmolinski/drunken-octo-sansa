<?php
/*
 * Desafio Single
 */
	
	include_once "fbmain.php";
	
	//inspect(__FILE__);
?>
<?php get_header(); ?>
			
			<div id="content" class="SingleDesafio" >
			
				<div id="inner-content" class="wrap clearfix">
			
					<div id="main" class="eightcol clearfix" role="main">
						<?php 
							//inspect($activePost);
                                   //inspect($currentPost);
                                   
							//facebook stuff
							if (Null != $userData) {
								
								$winner = new User();
								$winner->getWinner($activePost);
                                        if (NULL != $winner->fb_ID) {
                                             $winnerOK = TRUE;
                                        } else {                                             
                                             $winnerOK = FALSE;
                                        }
								
								$u = new User();
								$user = $u->getUserComment($userData['id'], $activePost);
								$allOtherComments = $u->getOtherCommentsForPost($activePost, $userData['id']);
                                        $allComments = $u->getCommentsForPost($activePost);
                                        
								if ($user->fb_comment) {
									$alreadyCommented = TRUE;
								} else {
								}
							} else {
								$u = new User();
								$allComments = $u->getCommentsForPost($activePost);
							}
                                   
							if ( $logged ) {
								if ($allComments != NULL) { ?>
								     
									<h1>Desafio - <?php the_title(); ?></h1>
									<p><?php echo $_GET['actions']; ?></p>
									<style>body {overflow: visible !important;}.inputs {float:right;}label[for='win_no']{float:right;} .inputs label {float:left;clear: left;padding: 3px;}label input {display:inline-block; margin: 0 3px; vertical-align:middle;}.fb_comment { border-bottom:solid 1px #666; padding:20px;}.remove {color: #c00;}.commentBody  {width:525px;margin-left:70px;}.fb_comment img {margin-bottom:-60px}</style>
									<form id='commentAdmin' action="<?php bloginfo('template_url') ?>/fb_comments.php" method="post">
										<div class="fb_comment">
											<input type="hidden" name="commentAdminPostID" value="<?php echo $activePost ?>"/>
											<input type="hidden" name="redirect" value="<?php the_permalink($activePost); ?>"/>
											<label for="submit" class="defaults"><input type="submit" name="submit" id="submit" value="Atualizar"></label>
											<label class="win" for="win_no"><input type="radio" name="winner" id='win_no' value="none"/>Não Vencedor</label>							
											<div class="clearfix"></div>
										</div>
										<?php printComments($allComments, 'winners'); ?>
										<div class="fb_comment">
											<label for="submit" class="defaults"><input type="submit" name="submit" id="submit"  value="Atualizar"></label>
                                                       <input type="hidden" name="redirect" value="<?php the_permalink($activePost); ?>"/>
											<label class="win" for="win_no"><input type="radio" name="winner" id='win_no' value="none"/>Não Vencedor</label>							
											<div class="clearfix"></div>
										</div>
									</form>
									<?php
									
								} else {
                                             echo '<h1>Desafio - '. get_the_title(). '</h1>';
									echo '<p>Sem comentários</p>';
								}								
															
							} else {
								
						?>						
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
                                   		 
								if ('active' == $status) {		
									if (!$alreadyCommented){
                                        //echo "<p> no Comment</p>";
							?>							
								<div id="midBox" >	
									<div id="videoDesafio">
										<iframe width="510" height="280" src="https://www.youtube.com/embed/<?php echo cleanVideoURL($meta['linkVideo']); ?>" frameborder="0" allowfullscreen></iframe>
									</div>
									<div class="clearfix"></div>
								</div>
                                        <?php require ('socialMedia.php'); ?>
								<?php require ('desafioForm.php'); ?>							
							<?php	} else { // already commented 
                                        //echo "<p> alread Commented</p>";?>	
							
								<div id="midBox" >
									<div id="videoDesafio" class="ja">
										<iframe class="miniVid" width="325" height="183" src="https://www.youtube.com/embed/<?php echo cleanVideoURL($meta['linkVideo']); ?>" frameborder="0" allowfullscreen></iframe>
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
											if ($allOtherComments != NULL) {printComments($allOtherComments);}
										?>
									</div>
								</div>
							<?php 								
									} 
								} elseif (('closed' == $status) && (FALSE != $winnerOK)) {
                                        //echo "<p> closed + winner</p>"; ?>	
								<div id="midBox" class="win">
									<div id="videoDesafio" class="ja">
										<iframe class="miniVid" width="325" height="183" src="https://www.youtube.com/embed/<?php echo cleanVideoURL($meta['linkVideo']); ?>" frameborder="0" allowfullscreen></iframe>
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
										<iframe class="miniVid" width="325" height="183" src="https://www.youtube.com/embed/<?php echo cleanVideoURL($meta['linkVideo']); ?>" frameborder="0" allowfullscreen></iframe>
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
											if ($allOtherComments != NULL) {printComments($allOtherComments);}
										?>
									</div>
								</div>
							<?php } ?>
						</div>
						<?php } ?>
					</div> <!-- end #main -->
					
				</div> <!-- end #inner-content -->
    
			</div> <!-- end #content -->

<?php get_footer(); ?>