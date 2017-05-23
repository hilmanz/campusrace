<?php

class deleteeventHelper {
	
	var $_mainLayout=""; 
	
	var $login = false;
	
	function __construct($apps){
		global $logger,$CONFIG;
		$this->logger = $logger;
		$this->apps = $apps;
 
		
		$this->config = $CONFIG;
		if( $this->apps->session->getSession($this->config['SESSION_NAME'],"admin") ){
			
			$this->login = true;
		
		}
		 
	}
	function deleteevent($idevent,$id){
		//pr('s');exit;
		$sql = "delete * from {$this->config['DATABASE'][0]['DATABASE']}.ss_event where
			id='{$idevent}' and chapter_id='{$id}'
			";
			pr($sql);exit;
		$rs = $this->apps->query($sql); 
			// pr($sql);die;
		if($rs){
			
			return true;
		}else{
			return false;
		}
	}
}
?>