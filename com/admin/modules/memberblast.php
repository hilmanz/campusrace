<?php
class memberblast extends App{
	
	function beforeFilter(){
 		
		global $LOCALE,$CONFIG;
		$this->assign('basedomain',$CONFIG['BASE_DOMAIN']); 
		$this->memberblastHelper = $this->useHelper("memberblastHelper");
		
	}
	function main(){
	
	 $memberblast=$this->memberblastHelper->memberblast(); 
	}
	
	
	function statusemail(){
		$memberblast=$this->memberblastHelper->statusemail();
	}
	
}

?>