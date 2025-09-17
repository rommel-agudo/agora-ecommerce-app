<?php
require_once 'framework/htmlTemplate.php';
require_once 'siteFunctions/commonFunctions.php';
require_once 'siteFunctions/buyerPage.php';

    $error = null;
	$pg=new BuyerPage();
	$db = $pg->getDB();
	$method = $_SERVER['REQUEST_METHOD'];//asking what the method
    $content = "";
	if (!isset($_SESSION['buyerID'])) {
		header('Location: buyerLogin.php');
	}

		// receive all input values from the form

		$buyerID = $_SESSION['buyerID'];
        $productID = getFromUrl('ID');
        $findproduct = "SELECT * FROM products WHERE productID = '$productID'";

        $obj = $db->query($findproduct);
        $row = $obj-> fetch();

        $productName = $row['productName'];
        $sellerID = $row['sellerID'];
       

        $updateOrder =  "INSERT INTO orders VALUES(null,$productID,'$productName',$buyerID,$sellerID)";
        $db ->query($updateOrder);

		$updateProducts =  "DELETE FROM products WHERE productID = '$productID'";
        $db ->query($updateProducts);

		$content.='<p>Order has been recorded<p>';
		$content.='<p><a href="products.php">Buy another product</a></p>';

        
	$pg->setTitle('Buying product');
	$pg->setContent($content);
	print $pg->getHtml();
