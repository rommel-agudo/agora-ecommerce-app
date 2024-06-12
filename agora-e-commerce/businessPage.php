<?php

require_once 'framework/htmlTemplate.php';
require_once 'framework/htmlTable.php';
require_once 'models/business.php';
require_once 'siteFunctions/commonFunctions.php';
require_once 'siteFunctions/businessPage.php';
		
		$pg = new BusinessPage();	
        $content = '';
		$db=$pg->getDB();	
        $business = $pg->getBusiness();
        $businessID = $business->getBusinessID();
        
        $findlogo = "SELECT logo FROM business WHERE businessID = '$businessID'";
        $obj = $db->query($findlogo);
        $row = $obj-> fetch();

        $logo = $row['logo'];
        $content.= "<img src = $logo width = '150px'>";

        $findbusiness = "SELECT businessID, userName, businessName, emailAddress FROM business WHERE businessID = '$businessID'";
        $result = $db->query($findbusiness);
        if ($result->size()>0 ) {
            echo'hello';
            $businessDetails=new HtmlTable ($result);
            $content.=$businessDetails->getHtml( array (
                    'businessID'=>'Business ID', 
                    'userName'=>'User Name',
                    'businessName' => 'Business Name',
                    'emailAddress'=>'Email Address'));
                }
        
        $content.='<br/><button><a class="nav-link" href="updateBusinessDetails.php">Update your Details</a></button>';
        $buyers = $db-> query("select * from buyer WHERE businessID = '$businessID'");
        $sellers = $db-> query("select * from seller WHERE businessID = '$businessID'");

        $content.= "<br><br><h3>Registered Users</h3>";
      
        if ($buyers->size()>0 ) {
        $buyerTable=new HtmlTable ($buyers);
		$content.=$buyerTable->getHtml( array (
				'buyerID'=>'Buyer ID', 
				'givenName'=>'Given Name',
				'familyName'=>'Family Name'));
            }
        else
            $content.='<p>You have no buyers</p>';
        
        $content.= "<br>";
        if ($sellers->size()>0 ) {
        $sellerTable=new HtmlTable ($sellers);
		$content.=$sellerTable->getHtml( array (
				'sellerID'=>'Seller ID', 
				'givenName'=>'Given Name',
				'familyName'=>'Family Name'));
            }
        else
            $content.='<p>You have no sellers</p>';
            $content.='<button><a class="nav-link" href="addBuyerSeller.php">Add Users</a></button><br/>';
            $content.='<button><a class="nav-link" href="deleteBuyerSeller.php">Delete users </a></button>';

        $businessName = $business->getBusinessName();

		$pg->setTitle('Welcome '.$businessName);
		$pg->setContent($content);
		print $pg->getHtml();
        