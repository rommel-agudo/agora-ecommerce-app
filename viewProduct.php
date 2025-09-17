<?php
	include_once 'siteFunctions/commonFunctions.php';
	require_once 'framework/htmlTemplate.php';
	require_once 'framework/htmlTable.php';
    include_once 'siteFunctions/buyerPage.php';

	$page = new BuyerPage();
	$db = $page->getDB();
    $productID = getFromUrl('ID');
    $content="";
	$findproduct = "SELECT productID, productName, productDetails, price FROM products WHERE productID = '$productID'";
    $product = $db->query($findproduct);
	
	// Format the products as an HTML table
	$table=new HtmlTable ($product);
	$content.= $table->getHtml( array (
		'productID'=>'Product ID',
		'productName'=>'Product Name',
        'productDetails' => 'Details',
        'price' => 'Price',
		'<a href ="buy.php?ID=<<productID>>" >Buy</a>' => 'Action'
		));
	
	// Finally, place the content in our master page
	$page->setTitle('Product Page');
	$page->setContent($content);	
	print $page->getHtml();
?>
