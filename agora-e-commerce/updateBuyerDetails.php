<?php
require_once 'framework/htmlTemplate.php';
require_once 'siteFunctions/commonFunctions.php';
require_once 'siteFunctions/buyerPage.php';

	
	$error = null;
	$pg=new buyerPage();
	$db = $pg->getDB();
	$method = $_SERVER['REQUEST_METHOD'];//asking what the method
    $buyer = $pg->getBuyer();
    $buyerID = $buyer->getID();

        if ($method == "POST"){
            // receive all input values from the form
            $username = $_POST['userName'];
            $givenName =$_POST['givenName'];
            $familyName =$_POST['familyName'];
            $email =$_POST['emailAddress'];
            $password =$_POST['passwordHash'];


            $checkUserName = "SELECT userName FROM buyer WHERE userName = '$username'";
            $result = $db ->query($checkUserName);

            if ($result->size()> 0) {
                $error.='User name taken. Please enter a different username.';
            } 
            else {
                 $checkEmail =  "SELECT emailAddress FROM buyer WHERE emailAddress ='$email'";
                 $result = $db ->query($checkEmail);
                        }
                    if ($result->size()> 0) {
                        $error.='Please enter a different email address.';
                        }
                    else{
                        $checkPassword = "SELECT passwordHash FROM buyer  WHERE passwordHash ='$password'";
                         $result = $db ->query($checkPassword);
                            }
                            if ($result->size()> 0) {
                                $error.='Please enter a different password.';
                            }
                            else{
                                if (empty(trim($username))){}
                                else{
                                    $sql =  "UPDATE buyer set userName = '$username' WHERE buyerID = '$buyerID'";
                                    $db ->query($sql);
                                }
                                if (empty(trim($givenName))){}
                                else{
                                    $sql =  "UPDATE buyer set givenName = '$givenName' WHERE buyerID = '$buyerID'";
                                    $db ->query($sql);
                                }
                                if (empty(trim($familyName))){}
                                else{
                                    $sql =  "UPDATE buyer set familyName = '$familyName' WHERE buyerID = '$buyerID'";
                                    $db ->query($sql);
                                }
                                if (empty(trim($email))){}
                                else{
                                    $sql =  "UPDATE buyer set emailAddress = '$email' WHERE buyerID = '$buyerID'";
                                    $db ->query($sql);
                                }
                                if (empty(trim($password))){}
                                else{
                                    $sql =  "UPDATE buyer set passwordHash = '$password' WHERE buyerID = '$buyerID'";
                                    $db ->query($sql);
                                }
                                    echo "Records updated: ".$username."-".$givenName."-".$familyName."-".$email."-".$password;
                                    header('Location: buyerPage.php'."?buyer=$buyerID");
			                        exit;
                            }              
                
	}
	$login=new HtmlTemplate('updateBuyerDetails.html');
	$content=$login->getHtml(array());	
	if ($error!=null) {
		$content.='<br/><br/><p>'.$error.'<p><br/>';
	}

	$pg->setTitle('Edit Buyer Account');
	$pg->setContent($content);
	print $pg->getHtml();



