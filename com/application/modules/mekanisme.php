<?php
class mekanisme extends App{
	
	function beforeFilter(){
 		
		global $LOCALE,$CONFIG;
		$this->assign('basedomain',$CONFIG['BASE_DOMAIN']); 
		
	}
	
	function main(){
		
		$this->assign("msg",'');
		return $this->View->toString(TEMPLATE_DOMAIN_WEB .'apps/mekanisme.html');
	}
	
}
?>
