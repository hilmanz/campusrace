<?php
class home extends App{
		
	function beforeFilter(){ 
		global $LOCALE,$CONFIG; 
				

		$this->uploadHelper = $this->useHelper('uploadHelper');
		
		$this->assign('basedomain', $CONFIG['ADMIN_DOMAIN']);
		$this->assign('basedomainpath', $CONFIG['BASE_DOMAIN_PATH']);
		$this->assign('locale', $LOCALE[1]);
		$this->assign('user', $this->user);
		//$this->assign('tokenize',gettokenize(5000*60,$this->user->id));	

		
	}

	 
	function main(){

		$time['time'] = '%H:%M:%S';
		return $this->View->toString(TEMPLATE_DOMAIN_ADMIN .'apps/home.html');
	
		
	}
	
	
	
	}
?>