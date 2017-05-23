<?php
class memberblast extends App{
	
	function beforeFilter(){
 		
		global $LOCALE,$CONFIG;
		$this->assign('basedomain',$CONFIG['BASE_DOMAIN']); 
		$this->memberblastHelper = $this->useHelper("memberblastHelper");
		
	}
	protected function main(){
		pr('ss');exit
	$memberblast=$this->memberblastHelper->memberblast();
	}
	
	
	function statusemail(){
		$memberblast=$this->memberblastHelper->statusemail();
	}
	
	
}

?>