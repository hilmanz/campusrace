<?php
class checkemailblashchapter extends App{
	
	function beforeFilter(){
 		
		global $LOCALE,$CONFIG;
		$this->assign('basedomain',$CONFIG['BASE_DOMAIN']); 
		$this->memberblastHelper = $this->useHelper("memberblastHelper");
		
	}
	function main(){
	//pr('ss');exit;
	$statusemail=$this->memberblastHelper->cekemailchapter();

	}
	
	
	
	
}

?>