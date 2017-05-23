<?php
class puzzle2 extends App{

	function beforeFilter(){
		global $LOCALE,$CONFIG;
		$this->puzzleHelper = $this->useHelper('puzzleHelper');
		$this->assign('basedomain',$CONFIG['BASE_DOMAIN']); 
		$this->assign('basedomainpath', $CONFIG['BASE_DOMAIN_PATH']);
		$this->assign('assets_domain', $CONFIG['ASSETS_DOMAIN_ADMIN']);
		$this->assign('locale', $LOCALE[1]);		
		$this->assign('pages', strip_tags($this->_g('page')));
		$this->assign('user',$this->user);
	}
	
	function main($start=null,$limit=1){
	
				
			return $this->View->toString(TEMPLATE_DOMAIN_WEB .'apps/puzzle2.html');
	}
	
	function savedata(){		
		$storyList = $this->puzzleHelper->savedata();
		//pr($storyList);exit;
		if($storyList==true){
		print json_encode(array('status'=>true));
		}else{ 
			print json_encode(array('status'=>false));
		}
		
		exit;
		
	}
	
		
}
?>
