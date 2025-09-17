<?php
require_once 'framework/htmlTemplate.php';
require_once 'siteFunctions/commonFunctions.php';
require_once 'siteFunctions/validationFunctions.php';
require_once 'siteFunctions/masterPage.php';

	
	$error = null;
	$pg=new MasterPage();
	$db = $pg->getDB();
	$method = $_SERVER['REQUEST_METHOD'];//asking what the method

	if ($method == "POST"){
		// receive all input values from the form
		$username = $_POST['userName'];
		$givenName = $_POST['givenName'];
		$familyName = $_POST['familyName'];
		$email =$_POST['emailAddress'];
		$password =$_POST['passwordHash'];
		$confirmPassword = $_POST['confirmPassword'];
		$role = $_POST['role'];

		$checkusername = "SELECT userName FROM $role WHERE userName = '$username'";
		$result = $db ->query($checkusername);
		if ($result->size()> 0) {
			$error.='Please enter a different username.';
		}    
        else {
			$findEmail = "SELECT emailAddress FROM business WHERE emailAddress ='$email'";
			$result = $db ->query($findEmail);
            if ($result->size()> 0) 
			{
            	$error.='Please enter a different email address.';
            	}
            	else{
					$errors = checkPassword($password,$username);
					if (!empty($errors)){
						$error.= display_errors($errors);
					}
					else if($password != $confirmPassword){
							$error.='Passwords do not match.';
					}
					else{
						$passwordHash = password_hash($password, PASSWORD_DEFAULT);
						$sql =  "INSERT INTO $role(userName, givenName, familyName, emailAddress, passwordHash) 
						VALUES('$username', '$givenName', '$familyName','$email','$passwordHash')";
						$db ->query($sql);
						$error.='<p>Account created successfully<p>'.'<button><a class="nav-link" href="buyerLogin.php">Log in here</a></button><br/><br/>';
						}
	 		}
		}
	}
	$login=new HtmlTemplate('userSignup.html');
	$content=$login->getHtml(array());	
	if ($error!=null) {
		$content.='<br/><br/><p>'.$error.'<p><br/>';
	}

	$pg->setTitle('Create User Account');
	$pg->setContent($content);
	print $pg->getHtml();



