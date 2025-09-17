<?php
require_once 'framework/htmlTemplate.php';
require_once 'siteFunctions/commonFunctions.php';
require_once 'siteFunctions/validationFunctions.php';
require_once 'siteFunctions/businessPage.php';

	$content= null;
	$error = null;
	$pg=new businessPage();
	$db = $pg->getDB();
	$method = $_SERVER['REQUEST_METHOD'];//asking what the method

	if ($method == "POST"){
		// receive all input values from the form
		$username = $_POST['userName'];
        $businessName =$_POST['businessName'];
        $password =$_POST['passwordHash'];
		$confirmPassword = $_POST['confirmPassword'];
		$email =$_POST['emailAddress'];

		$find = "SELECT userName FROM business WHERE userName = '$username'";
		$result = $db ->query($find);
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
						$sql =  "INSERT INTO business(userName, businessName, passwordHash, emailAddress) 
						VALUES('$username', '$businessName', '$passwordHash','$email')";
						$db ->query($sql);
						$error.='<p>Account created successfully<p>'.'<button><a class="nav-link" href="businessLogin.php">Log in here</a></button><br/><br/>';
						}
	 		}
		}
	}
	
	$login=new HtmlTemplate('businessSignup.html');
	$content=$login->getHtml(array());	
	if ($error!=null) {
		$content.='<br/><br/><p>'.$error.'<p><br/>';
	}

	$pg->setTitle('Create Business Account');
	$pg->setContent($content);
	print $pg->getHtml();



