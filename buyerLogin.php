<?php
require_once 'framework/htmlTemplate.php';
require_once 'siteFunctions/commonFunctions.php';
require_once 'siteFunctions/buyerPage.php';
	
	$pg=new BuyerPage();
	$method=$_SERVER['REQUEST_METHOD'] ;
	$error=null;
	
	if (isset($_SESSION['buyerID'])) {
		session_destroy();
		header('Location: buyerLogin.php');
	}
	
	if ($method=='POST') {
		$userName=$_POST['userName'];
		$password=$_POST['password'];
		
		$buyerID=getBuyerID($userName,$password);
		if ($buyerID==null) {
			$error='Your login credentials were rejected, please try again.';
		} else {
			$_SESSION['buyerID']=$buyerID;
			header('Location: buyerPage.php'."?buyer=$buyerID");
			exit;
		}
	}

	$login=new HtmlTemplate('buyerLogin.html');
	$content=$login->getHtml(array());	
	if ($error!=null) {
		$content.='<br/><br/><p>'.$error.'<p><br/>';
	}

	$pg->setTitle('Log in for buyers');
	$pg->setContent($content);
	print $pg->getHtml();


