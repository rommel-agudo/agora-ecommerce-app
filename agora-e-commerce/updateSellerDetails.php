<?php
require_once 'framework/htmlTemplate.php';
require_once 'siteFunctions/commonFunctions.php';
require_once 'siteFunctions/sellerPage.php';

	
	$error = null;
	$pg=new sellerPage();
	$db = $pg->getDB();
	$method = $_SERVER['REQUEST_METHOD'];//asking what the method
    $seller = $pg->getSeller();
    $sellerID = $seller->getID();

        if ($method == "POST"){
            // receive all input values from the form
            $username = $_POST['userName'];
            $givenName =$_POST['givenName'];
            $familyName =$_POST['familyName'];
            $email =$_POST['emailAddress'];
            $password =$_POST['passwordHash'];


            $checkUserName = "SELECT userName FROM seller WHERE userName = '$username'";
            $result = $db ->query($checkUserName);

            if ($result->size()> 0) {
                $error.='User name taken. Please enter a different username.';
            } 
            else {
                 $checkEmail =  "SELECT emailAddress FROM seller WHERE emailAddress ='$email'";
                 $result = $db ->query($checkEmail);
                        }
                    if ($result->size()> 0) {
                        $error.='Please enter a different email address.';
                        }
                    else{
                        $checkPassword = "SELECT passwordHash FROM seller  WHERE passwordHash ='$password'";
                         $result = $db ->query($checkPassword);
                            }
                            if ($result->size()> 0) {
                                $error.='Please enter a different password.';
                            }
                            else{
                                if (empty(trim($username))){}
                                else{
                                    $sql =  "UPDATE seller set userName = '$username' WHERE sellerID = '$sellerID'";
                                    $db ->query($sql);
                                }
                                if (empty(trim($givenName))){}
                                else{
                                    $sql =  "UPDATE seller set givenName = '$givenName' WHERE sellerID = '$sellerID'";
                                    $db ->query($sql);
                                }
                                if (empty(trim($familyName))){}
                                else{
                                    $sql =  "UPDATE seller set familyName = '$familyName' WHERE sellerID = '$sellerID'";
                                    $db ->query($sql);
                                }
                                if (empty(trim($email))){}
                                else{
                                    $sql =  "UPDATE seller set emailAddress = '$email' WHERE sellerID = '$sellerID'";
                                    $db ->query($sql);
                                }
                                if (empty(trim($password))){}
                                else{
                                    $sql =  "UPDATE seller set passwordHash = '$password' WHERE sellerID = '$sellerID'";
                                    $db ->query($sql);
                                }
                                    echo "Records updated: ".$username."-".$givenName."-".$familyName."-".$email."-".$password;
                                    header('Location: sellerPage.php'."?seller=$sellerID");
			                        exit;
                            }              
                
	}
	$login=new HtmlTemplate('updateSellerDetails.html');
	$content=$login->getHtml(array());	
	if ($error!=null) {
		$content.='<br/><br/><p>'.$error.'<p><br/>';
	}

	$pg->setTitle('Edit Seller Account');
	$pg->setContent($content);
	print $pg->getHtml();



