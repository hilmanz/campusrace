<?php
class teslogin extends App{
	
	function beforeFilter(){
 		
		global $LOCALE,$CONFIG;
		
		$this->assign('basedomain',$CONFIG['BASE_DOMAIN']);
		$this->chapterHelper = $this->useHelper('chapterHelper');
		$this->homeHelper = $this->useHelper('homeHelper');
		$this->FacebookHelper  = $this->useHelper('FacebookHelper');
		$this->user=$this->session->getSession($this->config['SESSION_NAME'],"WEB");
		
		// echo"ddd";die;	
	}
	
	function main(){
		global $LOCALE,$CONFIG;
		unset($_SESSION['facebook_session']); 
		unset($_SESSION['fb_675762459151638_code']);
		unset($_SESSION['fb_675762459151638_access_token']);
		unset($_SESSION['fb_675762459151638_user_id']);
		//$flavour_list = $this->flavourHelper->flavorList();
		
			return $this->View->toString(TEMPLATE_DOMAIN_WEB .'/apps/teslogin.html');		
	}
	public function logout() {
	 
		 session_destroy();
		 
		 redirect(base_url().'login');
	 
	 }
}
?>
