<?php
	require_once 'framework/htmlTemplate.php';
	require_once 'siteFunctions/commonFunctions.php';
	require_once 'models/business.php';

class BusinessPage {

	var $db;
	var $title;
	var $content;
	var $buyer;
	var $buyerID;
	var $business;
	var $businessID;
	var $seller;
	var $sellerID;
	
	public function __construct() {
		$this->title='Untitled';
		$this->businessID=null;
		$this->business=null;
		$this->content="<p>content not yet specified</p>";
		$this->db=getDatabase();
		$this->init();
	}
	
	private function init () {
		
		session_save_path ('.\sessions');
		session_start();	

		if (isset($_SESSION['businessID'])) {
			$this->businessID=$_SESSION['businessID'];
		}
		if ($this->businessID!=null) {
			$this->business=new BusinessModel($this->db, $this->businessID);
		}

		
	}
		
	public function setTitle($title) {
		$this->title = $title;
	}
	
	public function setContent($content) {
		$this->content=$content;
	}

	public function getDB() {
		return $this->db;
	}
	
	public function getMember() {
		return $this->member;
	}

	public function getBuyer() {
		return $this->buyer;
	}

	public function getBusiness() {
		return $this->business;
	}

	public function getSeller() {
		return $this->seller;
	}

	public function getHtml() {		
		$pg = new HtmlTemplate('masterPage.html');
		return $pg->getHtml(array(
			'pagename'=>$this->title,
			'login'=>$this->getLoginPanel(),
			'content'=>$this->content));
	}
	
	public function logout() {
		$this->businessID=null;
		$this->business=null;
		session_destroy();
	}
	
	private function getLoginPanel() {

		if ($this->business==null) {
			return '<li><a href="businessLogin.php">Business Log in</a></li>';
		}
        $html = '<li class="nav-item"><a class="nav-link" href="businessPage.php">Business Page</a></li>';
		
        $html .='<span class="login">Logged in as <em>'.$this->business->getBusinessName().'</em>'.'<img src ="'.$this->business->getLogo().'" width =25px>';
		$html .= '<li><a href="logout.php">Logout</a></li>';
		$html .='</span>';
		return $html;
	}
}

