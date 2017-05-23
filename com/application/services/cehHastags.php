<?php
global $ENGINE_PATH;
include_once $ENGINE_PATH."Utility/Twitter/tmhOAuth.php";
include_once $ENGINE_PATH."Utility/Twitter/tmhUtilities.php";
class cehHastags extends ServiceAPI{

	

	
	function getHastags(){
	
		$this->twitterHelper  = $this->useHelper('twitterHelper');
		
		$hastagstwitter = $this->twitterHelper->getHastags();
		
	}
	

}

?>