<?php
class success_reg extends App{
	
	function beforeFilter(){
 		
		global $LOCALE,$CONFIG;
	
		
	}
	
	function main(){
	return $this->View->toString(TEMPLATE_DOMAIN_WEB .'apps/success-registration.html');		
		
		
	}
	
}
?>
