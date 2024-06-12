<?php
	require_once 'framework/htmlTemplate.php';
	require_once 'siteFunctions/commonFunctions.php';
	require_once 'models/buyer.php';

class BuyerPage {

	var $db;
	var $title;
	var $content;
	var $buyer;
	var $buyerID;
	var $role;
	
	public function __construct() {
		$this->title='Untitled';
		$this->buyerID=null;
		$this->buyer=null;
		$this->content="<p>content not yet specified</p>";
		$this->db=getDatabase();
		$this->init();
	}
	
	private function init () {
		
		session_save_path ('.\sessions');
		session_start();	

		if (isset($_SESSION['buyerID'])) {
			$this->buyerID=$_SESSION['buyerID'];
		}
		if ($this->buyerID!=null) {
			$this->buyer=new BuyerModel($this->db, $this->buyerID);
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

	public function getBuyer() {
		return $this->buyer;
	}

	public function getHtml() {		
		$pg = new HtmlTemplate('masterPage.html');
		return $pg->getHtml(array(
			'pagename'=>$this->title,
			'login'=>$this->getLoginPanel(),
			'content'=>$this->content));
	}
	
	public function logout() {
		$this->buyerID=null;
		$this->buyer=null;
		session_destroy();
	}
	
	private function getLoginPanel() {

		if ($this->buyer==null) {
			return '<li><a href="buyerLogin.php">Buyer Log in</a></li>';
		}

		
        $html = '<li><a href="buyerPage.php">Account</a></li>';
		$html .= '<li><a href="products.php">Products</a></li>';
		
        $html .='<span class="login">Logged in as <em>'.$this->buyer->getUserName().'</em>';
		$html .= '<li><a href="logout.php">Logout</a></li>';
		$html .='</span>';
		return $html;
	}
}

