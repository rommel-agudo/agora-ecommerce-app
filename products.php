<?php
	include_once 'siteFunctions/commonFunctions.php';
	include_once 'siteFunctions/buyerPage.php';
	require_once 'framework/htmlTemplate.php';
	require_once 'framework/htmlTable.php';

	$page = new BuyerPage();
	$db = $page->getDB();
	$sql="select productID, productName ".
		 "from products ";


	$products = $db->query($sql);
	
	// Format the books as an HTML table
	$table=new HtmlTable ($products);
	$content= $table->getHtml( array (
		'productID'=>'Product ID',
		'productName'=>'Product Name',
		'<a href ="viewProduct.php?ID=<<productID>>" >View</a>' => 'View Details'
		));
	
	// Finally, place the content in our master page
	$page->setTitle('Products database');
	$page->setContent($content);	
	print $page->getHtml();
?>
