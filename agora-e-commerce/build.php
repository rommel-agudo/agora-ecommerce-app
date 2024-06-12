<?php
require_once 'siteFunctions/commonFunctions.php';
require_once 'siteFunctions/masterPage.php';
require_once 'framework/MySQLDB.php';

	try {
		$db=getNewDatabase();

		//BUSINESS
		$db->execute( "drop table if exists business");
	   
		$db->execute( "create table business
						(businessID  	integer not null auto_increment,
						userName		char(30),
						 businessName 	char(30),
						 passwordHash	char(64),
						 emailAddress	char(100),
						 isAdmin		boolean,
						 logo 			varchar(100),
						 primary key	(businessID), 
						 unique key 	(userName)
						)");
	   
		$db->execute( "insert into business values (null,'business1','City Fitbit','business1','hush@gmail.com',false,null )") ;
		$db->execute( "insert into business values (null,'business2','Moorhouse Gang','business2','jordan@gmail.com',false, null)" ) ;
		$db->execute( "insert into business values (null,'business3','Tekapo Thingz','business3','alex@gmail.com',false,null)" ) ;



		//BUYER
		$db->execute( "create table buyer
						(buyerID  		integer not null auto_increment,
						userName			char(30),
						 givenName 		char(30),
						 familyName 	char(30),
						 passwordHash	char(64),
						 emailAddress	char(100),
						 businessID     integer,
						 primary key	(buyerID), 
						 FOREIGN KEY (businessID) REFERENCES business(businessID),
						 unique key 	(userName)
						)");
	   
		$db->execute( "insert into buyer values (null,'buyer1','givenName', 'familyName','buyer1','jose@gmail.com',null)") ;
		$db->execute( "insert into buyer values (null,'buyer2','givenName', 'familyName','buyer2','david@gmail.com',null)") ;
		$db->execute( "insert into buyer values (null,'buyer3','givenName', 'familyName','buyer3','yo@gmail.com',null)") ;


		//SELLER
		$db->execute( "create table seller
						(sellerID  		integer not null auto_increment,
						userName			char(30),
						givenName 		char(30),
						familyName 	char(30),
						passwordHash	char(64),
						emailAddress	char(100),
						businessID     integer,
						primary key	(sellerID), 
						FOREIGN KEY (businessID) REFERENCES business(businessID),
						unique key 	(userName)
						)");

		$db->execute( "insert into seller values (null,'seller1','givenName', 'familyName','seller1','seller1@gmail.com',null)") ;
		$db->execute( "insert into seller values (null,'seller2','givenName', 'familyName','seller2','seller1@gmail.com',null)") ;
		$db->execute( "insert into seller values (null,'seller3','givenName', 'familyName','seller3','seller1@gmail.com',null)") ;


		//PRODUCTS
		$db->execute( "drop table if exists products");
		$db->execute( "create table products
						(productID  	integer not null auto_increment,
						productName		char(30),
						productDetails 	char(30),
						price 	decimal(10,2),
						sellerID integer,
						buyerID integer,
						FOREIGN KEY (buyerID) REFERENCES buyer(buyerID),
						FOREIGN KEY (sellerID) REFERENCES seller(sellerID),
						primary key	(productID)
						)");

		$db->execute( "insert into products values (1,'book','handy dandy book', 10.55,1,null)") ;
		$db->execute( "insert into products values (2,'diary','record everthing with this', 5.55,2,null)") ;
		$db->execute( "insert into products values (3,'pen','of course you need a pen', 2.55,3,null)") ;

		//ORDERS
		$db->execute( "drop table if exists orders");
		$db->execute( "create table orders
						(orderID  	integer not null auto_increment,
						productID	integer,
						productName char(30),
						buyerID 	integer,
						sellerID integer,
						FOREIGN KEY (buyerID) REFERENCES buyer(buyerID),
						FOREIGN KEY (sellerID) REFERENCES seller(sellerID),
						primary key	(orderID)
						)");

			
		$content='<p>The database has been built.</p>';
		
		$pg=new MasterPage();
		$pg->setTitle('Database build/rebuild');
		$pg->setContent($content);
		print $pg->getHtml();
		
	} catch (exception $ex) {
		print $ex;
	}

