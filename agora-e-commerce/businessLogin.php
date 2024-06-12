<?php
require_once 'framework/htmlTemplate.php';
require_once 'siteFunctions/commonFunctions.php';
require_once 'siteFunctions/businessPage.php';

	$pg=new BusinessPage();
	$method=$_SERVER['REQUEST_METHOD'] ;
	$error=null;

	if (isset($_SESSION['businessID'])) {
		session_destroy();
		header('Location: businessLogin.php');
	}

	if ($method=='POST') {
		$userName=$_POST['userName'];
		$password=$_POST['password'];
	
		$businessID=getBusinessID($userName,$password);
		if ($businessID==null) {
			$error='Your login credentials were rejected, please try again.';
		} else {
			$_SESSION['businessID']=$businessID;
			header('Location: businessPage.php'."?business=$businessID");
			exit;
		}
	}

	$login=new HtmlTemplate('businessLogin.html');
	$content=$login->getHtml(array());	
	if ($error!=null) {
		$content.='<br/><br/><p>'.$error.'<p><br/>';
	}

	$pg->setTitle('Log in for Business');
	$pg->setContent($content);
	print $pg->getHtml();


