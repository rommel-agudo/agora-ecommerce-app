<?php
require_once 'siteFunctions/businessPage.php';

	$pg=new BusinessPage();
	if ($pg->getBusiness()!=null) {
		header("location: businessPage.php");
	} else {
			
		$content=' <section id = "home">';
		$content.='<h5>NEW ARRIVALS</h5>';
		$content.='<h1><span>Best Products</span> This Season</h1>';
		$content.='<p>Agora offers e-commerce services</p>';
		$content.='<p>Already have an account? Login using <strong>username</strong> and <strong>password</strong><br/><br/>';
		$content.='<button><a class="nav-link" href="businessSignup.php">Create Business Account</a></button><br/><br/>';
		$content.='<button><a class="nav-link" href="userSignup.php">Create User Account</a></button>';
		$content.='</section>';


				   
		$pg->setTitle('');
		$pg->setContent($content);
		print $pg->getHtml();
	}


