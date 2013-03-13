<?php
/*
* Desafio Single
*/
include_once "fbmain.php";

//inspect(__FILE__);

get_header();
?>
		<?php
			// ### inspect
			//inspect($activePost);
			//inspect($currentPost);

			// ### facebook stuff =====================================================
			if (Null != $userData) {
				$winner = new User();
				//$winner->getWinner($activePost);
				$winner = $winner->getWinner($activePost);
				

				if (NULL != $winner) {
				//if (!FALSE) {		
					$winnerOK = TRUE;
				}else{                                             
					$winnerOK = FALSE;
				}

				$u                = new User();
				$user  			  = $u->getUserComment($userData['id'], $activePost);
				$allOtherComments = $u->getOtherCommentsForPost($activePost, $userData['id']);
				$allComments 	  = $u->getCommentsForPost($activePost);

				if ($user->fb_comment) {
					$alreadyCommented = TRUE;
				}else{
				
				}
			}else{
				$u 			 = new User();
				$allComments = $u->getCommentsForPost($activePost);
			}
			// ### ==================================================================		  
			if ( $logged ) {
				// ### verifica se não tem comentários =====================================================  
				if ($allComments != NULL) { 
					include("resultado-form.php"); 
				// ### ==================================================================		  		  
				}else{
					echo '<h1>Desafio - '. get_the_title(). '</h1>';
					echo '<p>Sem comentários</p>';
				}
			}else{
				include("desafio-home.php");
			}
		?>

<?php get_footer(); ?>