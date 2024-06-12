<?php
	require_once 'models/entity.php';
/*
	Current logged in business is businessID in session
*/

class BusinessModel extends EntityModel{

	/* CONSTRUCTOR */
	function __construct($db, $businessID) {
		
		parent::__construct($db,'business');			// Bind to business table
		parent::defineKey ('businessID',$businessID);	// Define primary key
		parent::defineField ('userName');			// Say which fields we care about
		parent::defineField ('businessName');
		parent::defineField ('passwordHash');
		parent::defineField ('emailAddress');
		parent::defineField ('isAdmin');
		parent::defineField ('logo');
		
		if ($businessID!=null) {
			parent::load();
		}
	}
	
	
	/* 	PUBLIC SETTERS */

	public function setUserName($value) {
		parent::setValue('userName',"'$value'");
	}
	public function setBusinessName($value) {
		parent::setValue('businessName',"'$value");
	}
	public function setPasswordHash($value) {
		parent::setValue('passwordHash',"'$value'");
	}
	public function setEmailAddress($value) {
		parent::setValue('emailAddress',$value);
	}
	public function setIsAdmin($value) {
		parent::setValue('isAdmin',$value);
	}
	public function setLogo($value) {
		parent::setValue('logo',$value);
	}
	
	/* PUBLIC GETTERS */
	function getBusinessID() {
		return parent::getID();
	}
	public function getUserName() {
		return parent::getValue('userName');
	}
	public function getBusinessName() {
		return parent::getValue('businessName');
	}

	public function getPasswordHash() {
		return parent::getValue('passwordHash');
	}
	public function getEmailAddress() {
		return parent::getValue('emailAddress');
	}
	public function getIsAdmin() {
		return parent::getValue('isAdmin');
	}

	public function getLogo(){
		return parent::getValue('logo');
	}
	
	/* HELPER FUNCTIONS */
	
	public function isValidPassword() {
		$hash = "xxx";  //todo: calculate
		// get hash and compare
		return true;
		
	}	
}
?>
