<?php

	require_once('ajaxFunctions.php');
	require_once('inspect.php');
	require_once('fb/facebook.php');
	require_once('fb/Class-User.php');
	
	if(TRUE) {
		//ini_set('display_errors','On');
		error_reporting(E_ALL);
	} else {
		error_reporting(E_ALL ^ E_NOTICE);
	}	
		
	// Vars
	$methodTypePOST = True;
	$data = array();
	$return = array();
	
	$fb_table = 'fb_comments';	
	
	//inspect($_REQUEST);
	
	if(!(empty($_POST['fb_ID']) && empty($_GET['fb_ID']))) {
	
		//quick debugging switch for using $_GET variable
		if ($methodTypePOST == TRUE) {
			foreach($_POST as $key => $item) {
				$data[$key] = $item;
			}
		} else {
			foreach($_GET as $key => $item) {
				$data[$key] = $item;
			}
		}
		//inspect($data);
		//dataSanitation($data);
		
		if (!$data['fb_name']) {
			close(debug($data, $return), TRUE, 'no Name');
		} elseif (!$data['fb_holder']) {
			close(debug($data, $return), TRUE, 'no holder');
		} elseif (!$data['post_ID']) {
			close(debug($data, $return), TRUE, 'no post_ID');
		}
		$data['fb_comment']= $data['fb_holder'];
		$user = new User();	
		
		$ok = $user->actionInsert($data['fb_ID'], $data['fb_name'], $data['fb_comment'], $data['post_ID']);
		inspect($ok);
		//$ok = $user->getByFBId(4321);
		
		//echo $ok->fb_ID;
		
		close($return, FALSE, 'without problems');
	} elseif (!(empty($_POST['commentAdminPostID']) && empty($_GET['commentAdminPostID']))) {
		//all the comment admin stuff
		
		if ($methodTypePOST == TRUE) {
			foreach($_POST as $key => $item) {
				$data[$key] = $item;
			}
		} else {
			foreach($_GET as $key => $item) {
				$data[$key] = $item;
			}
		}
		
		inspect($data);
		
		//initialize needed vars
		$pID = $data['commentAdminPostID'];
		$user = new User();			
		$ls = $user->getCommentsForPost($pID);
          $action = '';
		
          
          
          //sort data
          $remove = $flagged = $checked = array(); 
          
          foreach ($data as $key => $value) {
               //inspect($key);
               //inspect($value);
               if (FALSE !== strpos($key, 'flag')) {                  
                         echo "<br/>flag";
                    $o = json_decode($value);
                    $flagged[$o->fb_ID] = $o->fb_name;
               } elseif (FALSE !== strpos($key, 'remove')) {
                         echo "<br/>remove"; 
                    $o = json_decode($value);               
                    $remove[$o->fb_ID] = $o->fb_name;
               } elseif (FALSE !== strpos($key, 'win')) {
                         echo "<br/>win"; 
                    $o = json_decode($value);               
                    $checked[$o->fb_ID] = $o->fb_name;					
               } else {  }
          }
          
          //update previously flagged
          foreach ($ls as $key => $value) {
               $id = $value->fb_ID;
               if (!array_key_exists($id, $flagged)){
                    
                    //echo "<br/>remove from list $id";
                    $user->actionUpdate($id, $pID, '0');
                    //$action .= "Atualizada $value a normal;<br/> ";
               }
          }
		  
          //update previously checked
          foreach ($ls as $key => $value) {
               $id = $value->fb_ID;
               if (!array_key_exists($id, $checked)){
                    
                    //echo "<br/>remove from list $id";
                    $user->actionUpdate($id, $pID, '0');
                    //$action .= "Atualizada $value a normal;<br/> ";
               }
          }		  
          
          // need to reset all values for all flags or add them to 
          if (!empty($flagged)) {
               foreach ($flagged as $key => $value) {
                         echo "<br/>add to list $key";                
                    $user->actionUpdate($key, $pID, '-1');
                    $action .= "Atualizada <strong>$value</strong> a ofensivo;<br/> ";
               }
          }
          
          if (!empty($remove)) {
               foreach ($remove as $key => $value) {
                         echo "<br/>deleting from list $key";    
                    $user->actionDelete($key, $pID);
                    $action .= "Apagou <strong>$value</strong>;<br/> ";
               }
          }
          
			if (NULL !== $data['no_winner']) {

				//No winner but must remove current winner
				echo 'no p winner<br>';
					$action .= 'Atualizada, sem vencedor;<br/> ';
				$user->actionUpdate($user->fb_ID, $user->post_ID, '0');
								
			}else{

			 if (!empty($checked)) {
				   foreach ($checked as $key => $value) {
							echo "<br/>first time winner list $key";     
						$user->actionUpdate($key, $pID, 1);
						$action .= "Adicionou <strong>$value</strong> como um dos vencedores;<br/> ";
				   }
			  }		
			  
			}
		  
          
          
		//add winner 
//		if (NULL !== $data['winner']) {
//			// are the winners the same	
//			if ('win_no' != $data['winner']) {
//				$obj = json_decode($data['winner']);
//			} else {
//				$obj = FALSE;
//			}
//			$ok = $user->getWinner($pID);
//                    //inspect($ok);
//                    //inspect($obj);
//			
//			if ($ok && $obj) {
//				//previous winner, need check if equal 
//				//inspect($obj);
//				if ($obj->fb_ID != $user->fb_ID) {
//					//unset winner flag from old user
//                         echo 'unset winner flag from old user<br>';
//                         $action .= 'Mudou vencedor;<br/> ';
//					$user->actionUpdate($user->fb_ID, $user->post_ID, 0);
//					//update flag on new winner
//					$user->actionUpdate($obj->fb_ID, $pID, 1);
//				}
//			} elseif ($ok) {
//				//No winner but must remove current winner
//				echo 'no p winner<br>';
//                    $action .= 'Atualizada, sem vencedor;<br/> ';
//				$user->actionUpdate($user->fb_ID, $user->post_ID, '0');
//			} elseif ($obj) {
//				//first time winner
//                    //echo 'first time winner<br>';
//                    //$action .= 'Adicionou vencedor;<br/> ';
//					//$user->actionUpdate($obj->fb_ID, $pID, 1);
//			         if (!empty($checked)) {
//			               foreach ($checked as $key => $value) {
//			                    	echo "<br/>first time winner list $key";     
//			                    $user->actionUpdate($key, $pID, 1);
//			                    $action .= "Adicionou <strong>$value</strong> como um dos vencedores;<br/> ";
//			               }
//			          }					
//					
//			} 		
//		}
		inspect($action);
		inspect($str);
          $action = urlencode($action);
          $ls = $user->getCommentsForPost($pID);
          $str = 'Location: '. $data['redirect'];
          
          //inspect($ls);
          //inspect($str);
          
          $u = strpos($str, '?');
          if (FALSE === $u) {
               $str .= '?'.'actions='.$action;
          } else {
               $str .= '&'.'actions='.$action;
          }
          
          
          
		header($str);
		exit();
		//close($return, FALSE, 'without problems');
	}else {
		close($return, TRUE, "No fb_ID or ");
	}
	
?>