<?php
	require_once 'models/entity.php';
/*
	Current logged in buyer is buyerID in session
*/

class BuyerModel extends EntityModel{

	/* CONSTRUCTOR */
	function __construct($db, $buyerID) {
		
		parent::__construct($db,'buyer');			// Bind to members table
		parent::defineKey ('buyerID',$buyerID);	// Define primary key
		parent::defineField ('userName');			// Say which fields we care about
		parent::defineField ('givenName');
		parent::defineField ('familyName');
		parent::defineField ('passwordHash');
		parent::defineField ('emailAddress');
		
		if ($buyerID!=null) {
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
	public function getFullName() {
		return $this->getGivenName() . ' ' . $this->getFamilyName() ;
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
