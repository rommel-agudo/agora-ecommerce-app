<?php
	require_once 'framework/htmlTemplate.php';
	require_once 'siteFunctions/commonFunctions.php';
	require_once 'models/seller.php';

class SellerPage {

	var $db;
	var $title;
	var $content;
	var $seller;
	var $sellerID;
	
	public function __construct() {
		$this->title='Untitled';
		$this->sellerID=null;
		$this->seller=null;
		$this->content="<p>content not yet specified</p>";
		$this->db=getDatabase();
		$this->init();
	}
	
	private function init () {
		
		session_save_path ('.\sessions');
		session_start();	

		if (isset($_SESSION['sellerID'])) {
			$this->sellerID=$_SESSION['sellerID'];
		}
		if ($this->sellerID!=null) {
			$this->seller=new SellerModel($this->db, $this->sellerID);
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
		$this->sellerID=null;
		$this->seller=null;
		session_destroy();
	}
	
	private function getLoginPanel() {

		if ($this->seller==null) {
			return '<li><a href="sellerLogin.php">Seller Log in</a></li>';
		}

		$html = '<li><a href="sellerPage.php">Account</a></li>';
		$html .= '<li><a href="products.php">Products</a></li>';
		$html .= '<li><a href="listing.php">Add product</a></li>';
		$html .='<span class="login">Logged in as <em>'.$this->seller->getUserName().'</em>';
		$html .= '<li><a href="logout.php">Logout</a></li>';
		$html .='</span>';
		return $html;
	}
}

