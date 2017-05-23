<?php
class tnc extends App{
	
	function beforeFilter(){
 		
		global $LOCALE,$CONFIG;
		$this->memberHelper = $this->useHelper('memberHelper');
		$this->uploadHelper = $this->useHelper("uploadHelper");
		$this->loginHelper = $this->useHelper('loginHelper');
		$this->assign('basedomain',$CONFIG['BASE_DOMAIN']); 
		$this->user=$this->session->getSession($this->config['SESSION_NAME'],"WEB");
		$this->assign('user', $this->user);
	}
	
	function main(){
	global $LOCALE,$CONFIG;
	
	//pr($this->decrypt('vbbvifLcdaYMXvLbFScbwn0UZVxS68vgZ6wiWvwVUhE='));exit;
	
	
		return $this->View->toString(TEMPLATE_DOMAIN_WEB .'apps/tnc.html');		
		
	
	
		
		
	}
}

?>