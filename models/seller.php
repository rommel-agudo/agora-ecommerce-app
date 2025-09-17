<?php
	require_once 'models/entity.php';
/*
	Current logged in member is sellerID in session
*/

class SellerModel extends EntityModel{

	/* CONSTRUCTOR */
	function __construct($db, $sellerID) {
		
		parent::__construct($db,'seller');			// Bind to members table
		parent::defineKey ('sellerID',$sellerID);	// Define primary key
		parent::defineField ('userName');			// Say which fields we care about
		parent::defineField ('givenName');
		parent::defineField ('familyName');
		parent::defineField ('passwordHash');
		parent::defineField ('emailAddress');
		
		if ($sellerID!=null) {
			parent::load();
		}
	}
	
	
	/* 	PUBLIC SETTERS */
	public function setUserName($value) {
		parent::setValue('userName',"'$value'");
	}
	public function setGivenName($value) {
		parent::setValue('givenName',"'$value'");
	}
	public function setFamilyName($value) {
		parent::setValue('familyName',"'$value");
	}
	public function setPasswordHash($value) {
		parent::setValue('passwordHash',"'$value'");
	}
	public function setEmailAddress($value) {
		parent::setValue('emailAddress',$value);
	}
	
	/* PUBLIC GETTERS */
	function getID() {
		return parent::getID();
	}
	public function getUserName() {
		return parent::getValue('userName');
	}
	public function getGivenName() {
		return parent::getValue('givenName');
	}
	public function getFamilyName() {
		return parent::getValue('familyName');
	}

	public function getPasswordHash() {
		return parent::getValue('passwordHash');
	}
	public function getEmailAddress() {
		return parent::getValue('emailAddress');
	}
	
	/* HELPER FUNCTIONS */
	
	public function isValidPassword() {
		$hash = "xxx";  //todo: calculate
		// get hash and compare
		return true;
		
	}	
}
?>
