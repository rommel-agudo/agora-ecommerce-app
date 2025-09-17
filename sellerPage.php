<?php

require_once 'framework/htmlTemplate.php';
require_once 'framework/htmlTable.php';
require_once 'siteFunctions/commonFunctions.php';
require_once 'siteFunctions/sellerPage.php';
require_once 'models/seller.php';
		
		$pg = new sellerpage();	
        $content = '';
        $content.= "<p>Welcome to the seller page</p>";
		$db=$pg->getDB();	
        $seller = $pg->getSeller();
        $sellerID = $seller->getID();
        
        $findseller = "SELECT * FROM seller WHERE sellerID = '$sellerID'";
        $result = $db->query($findseller);

        if ($result->size()>0 ) {
            echo'hello';
            $sellerDetails=new HtmlTable ($result);
            $content.=$sellerDetails->getHtml( array (
                    'sellerID'=>'Seller ID', 
                    'userName'=>'User Name',
					'givenName'=>'Given Name',
                    'familyName' => 'Family Name',
                    'emailAddress'=>'Email Address'));
                }
        $content.='<a href="updateSellerDetails.php">Edit your details here</a><br/><br/>';

		$products = $db-> query("select * from products WHERE sellerID = '$sellerID'");

        $content.= "<br><br><h3>Here are your products</h3>";
      
        if ($products->size()>0 ) {
        $productsTable=new HtmlTable ($products);
		$content.=$productsTable->getHtml( array (
				'productID'=>'Product ID', 
				'productName'=>'Product Name',
				'productDetails'=>'Details',
				'price' => 'Price'));
            }
        else
            $content.='<p>You have no products</p>';

        $content.='<a href="listing.php">List Products Here</a>';

		$pg->setTitle('Seller Page');
		$pg->setContent($content);
		print $pg->getHtml();
        