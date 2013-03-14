<?php
    if(NULL != $_GET['title']) {
    	$title = 'Vestibular FGV 2013 | '. trim($_GET['title']);
    } else {
    	$title = 'Vestibular FGV 2013 | ';
    }
    if(NULL != $_GET['description']) {
    	$description = $_GET['description'];
    } else {
    	$description = 'A FGV e algumas das maiores empresas do Brasil criaram desafios exclusivos para você. Aqui, você conhece um pouco do que os profissionais enfrentam e tem a chance de solucionar desafios propostos por eles. Além disso, você pode ganhar prêmios. Clique em Desafio e participe.';
    }
    if(NULL != $_GET['image']) {
    	$image = $_GET['image'];
    } else {
    	$image = 'http://profile.ak.fbcdn.net/hprofile-ak-snc4/195714_141618765913092_6846049_n.jpg';
    }
    if(NULL != $_GET['forwardURL']) {
    	$forwardURL = $_GET['forwardURL'];
    } else {
    	$forwardURL = 'https://vestibularfgv.com.br/2013/';
    }
    if(NULL != $_GET['page']) {
    	$page = 'page='.$_GET['page'];
    } else {
    	$page = NULL;
    }
	
	//prep URL
	
	$p = strpos($forwardURL, '?');
	if (NULL != $page)  {
		if (FALSE === $p) {
			$forwardURL = $forwardURL.'?'.$page;
		} else {
			$forwardURL = $forwardURL.'&'.$page;
		}
	}
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Vestibular FGV</title>

<meta property="fb:app_id" content="444250602265563">
<meta property="fb:admins" content="100000220196116,1049257200,679573088"/>
<meta property="og:title" content="<?php echo $title; ?>" />
<meta property="og:url" content="<?php echo curPageURL(); ?>" />
<meta property="og:description" content="<?php echo $description; ?>" />
<meta property="og:image" content="<?php echo $image; ?>" />

<script type="text/javascript">
setTimeout( function() {top.location.href = "<?php echo $forwardURL; ?>"}, 200); // wordpress page
</script> 
</head>
<body>
</body>
</html>
<?php
function curPageURL() {
 $pageURL = 'http';
 if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
 $pageURL .= "://";
 if ($_SERVER["SERVER_PORT"] != "80") {
  $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
 } else {
  $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
 }
 return $pageURL;
}
?>