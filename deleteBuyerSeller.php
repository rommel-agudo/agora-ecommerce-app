<?php
require_once 'framework/htmlTemplate.php';
require_once 'siteFunctions/commonFunctions.php';
require_once 'siteFunctions/businessPage.php';
require_once 'models/business.php';
	
	$error = null;
	$pg=new businessPage();
	$db = $pg->getDB();
	$method = $_SERVER['REQUEST_METHOD'];//asking what the method

	if ($method == "POST"){
		// receive all input values from the form
		$username = $_POST['userName'];
		$role =$_POST['role'];

        $find = "SELECT userName FROM $role WHERE userName = '$username'";
        $result = $db->query($find);

        	if ($result->size()>= 1) {
				$sql = "UPDATE $role SET businessID = null WHERE userName = '$username'";
				$db ->query($sql);		
			}
			else{
				$error.='Cannot find username';
			}
   		 } 
           
	$login=new HtmlTemplate('deleteBuyerSeller.html');
	$content=$login->getHtml(array());	
	if ($error!=null) {
		$content.='<br/><br/><p>'.$error.'<p><br/>';
	}

	$pg->setTitle('Delete Buyer/Seller');
	$pg->setContent($content);
	print $pg->getHtml();



