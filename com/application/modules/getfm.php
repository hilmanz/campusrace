<?php
class getfm extends App{
	
	function beforeFilter(){
 		
		global $LOCALE,$CONFIG;
		$this->getfmHelper = $this->useHelper("getfmHelper");
		
	}
	
	function main(){
	global $LOCALE,$CONFIG;
	
	
		$getfmnya=$this->getfmHelper->getfm();
		pr($getfmnya);exit;
		
	
	
		
		
	}
}

?>