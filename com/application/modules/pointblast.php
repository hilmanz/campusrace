<?php
class pointblast extends App{
	
	function beforeFilter(){
 		
		global $LOCALE,$CONFIG;
		$this->assign('basedomain',$CONFIG['BASE_DOMAIN']); 
		$this->pointblastHelper = $this->useHelper("pointblastHelper");
		
	}
	function main(){
	
	$pointblast=$this->pointblastHelper->pointblast();
	pr('ok Proses update selesai');exit;
	}
	
	
	
	
	
}

?>