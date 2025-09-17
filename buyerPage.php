<?php

require_once 'framework/htmlTemplate.php';
require_once 'framework/htmlTable.php';
require_once 'siteFunctions/commonFunctions.php';
require_once 'siteFunctions/buyerPage.php';
require_once 'models/buyer.php';
		
		$pg = new buyerPage();	
        $content = '';
        $content.= "<p>Welcome to the buyer page</p>";
		$db=$pg->getDB();	
        $buyer = $pg->getBuyer();
        $buyerID = $buyer->getID();
        
        $findbuyer = "SELECT * FROM buyer WHERE buyerID = '$buyerID'";
        $result = $db->query($findbuyer);

        if ($result->size()>0 ) {
            echo'hello';
            $buyerDetails=new HtmlTable ($result);
            $content.=$buyerDetails->getHtml( array (
                    'buyerID'=>'Buyer ID', 
                    'userName'=>'User Name',
					'givenName'=>'Given Name',
                    'familyName' => 'Family Name',
                    'emailAddress'=>'Email Address'));
                }
        $content.='<a href="updateBuyerDetails.php">Edit your details here</a><br/><br/>';
        $orders = $db-> query("select * from orders WHERE buyerID = '$buyerID'");

        $content.= "<br><br><h3>Purchase History</h3>";
      
        if ($orders->size()>0 ) {
        $ordersTable=new HtmlTable ($orders);
		$content.=$ordersTable->getHtml( array (
				'orderID'=>'Order ID', 
				'productID'=>'Product ID',
				'productName'=>'Product Name'));
            }
        else
            $content.='<p>You have no orders</p>';
        $content.='<br/><br/><a href="products.php">View available products here</a>';

		$pg->setTitle('Buyer Page');
		$pg->setContent($content);
		print $pg->getHtml();
        