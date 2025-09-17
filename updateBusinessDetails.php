<?php
require_once 'framework/htmlTemplate.php';
require_once 'siteFunctions/commonFunctions.php';
require_once 'siteFunctions/businessPage.php';

	
	$error = null;
	$pg=new businessPage();
	$db = $pg->getDB();
	$method = $_SERVER['REQUEST_METHOD'];//asking what the method
    $business = $pg->getBusiness();
    $businessID = $business->getBusinessID();

        if ($method == "POST"){
            // receive all input values from the form
            $username = $_POST['userName'];
            $businessName =$_POST['businessName'];
            $email =$_POST['emailAddress'];
            $password =$_POST['passwordHash'];
            $logo = $_POST['logo'];


            // $checkUserName = "SELECT userName FROM business WHERE userName = '$username'";
            // $result = $db ->query($checkUserName);

            // if ($result->size()> 0) {
            //     $error.='Please enter a different username.';
            // } 
            // else {
            //     $checkBusinessName = "SELECT businessName FROM business WHERE businessName ='$businessName'";
            //     $result = $db ->query($checkBusinessName);
                
            //         if ($result->size()> 0) {
            //             $error.='Please enter a different business name.';
            //         }

            //         else{
            //             $checkEmail =  "SELECT emailAddress FROM business WHERE emailAddress ='$email'";
            //             $result = $db ->query($checkEmail);
            //             }

            //             if ($result->size()> 0) {
            //                 $error.='Please enter a different email address.';
            //             }
            //             else{
            //                 $checkPassword = "SELECT passwordHash FROM business WHERE passwordHash ='$password'";
            //                 $result = $db ->query($checkPassword);
            //                 }
                    
            //                 if ($result->size()> 0) {
            //                     $error.='Please enter a different password.';
            //                 }
            //                 else{
            //                     $checkLogo =  "SELECT logo FROM business WHERE logo ='images/$logo'";
            //                     $result = $db ->query($checkLogo);
            //                      }

            //                     if ($result->size()> 0) {
            //                     $error.='Please enter a different logo.';
            //                     }
            //                         else{
                                    if (empty($logo)){}
                                    else{
                                        $sql =  "UPDATE business set logo = 'images/$logo' WHERE businessID = '$businessID'";
                                        $db ->query($sql);
                                    }
                                    if (empty(trim($username))){}
                                    else{
                                        $sql =  "UPDATE business set userName = '$username' WHERE businessID = '$businessID'";
                                        $db ->query($sql);
                                    }
                                    if (empty(trim($businessName))){}
                                    else{
                                        $sql =  "UPDATE business set businessName = '$businessName' WHERE businessID = '$businessID'";
                                        $db ->query($sql);
                                    }
                                    if (empty(trim($email))){}
                                    else{
                                        $sql =  "UPDATE business set emailAddress = '$email' WHERE businessID = '$businessID'";
                                        $db ->query($sql);
                                    }
                                    if (empty(trim($password))){}
                                    else{
                                        $sql =  "UPDATE business set passwordHash = '$password' WHERE businessID = '$businessID'";
                                        $db ->query($sql);
                                    }
                                
                                        //echo "Records updated: ".$username."-".$businessName."-".$email."-".$password;
                                        header('Location: businessPage.php'."?business=$businessID");
                                        exit;
                            }
                 
	  
                

	$login=new HtmlTemplate('updateBusinessDetails.html');
	$content=$login->getHtml(array());	
	if ($error!=null) {
		$content.='<br/><br/><p>'.$error.'<p><br/>';
	}

	$pg->setTitle('Edit Business Account');
	$pg->setContent($content);
	print $pg->getHtml();



