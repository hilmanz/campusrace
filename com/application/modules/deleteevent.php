<?php
class deleteevent extends App{
	
	function beforeFilter(){
 		
		global $LOCALE,$CONFIG;
		$this->deleteeventHelper = $this->useHelper('deleteeventHelper');		
		$this->loginHelper = $this->useHelper('loginHelper');
		$this->uploadHelper = $this->useHelper('uploadHelper');
		$this->assign('basedomain',$CONFIG['BASE_DOMAIN']); 
		$this->user=$this->session->getSession($this->config['SESSION_NAME'],"WEB");
		$this->assign('user', $this->user);
	}
	
	
	function main(){
		// echo"ssss";die;
		if($this->user)
		{
		pr('ss');exit;
		$idevent=$this->_g('event');
		pr($idevent);exit;
		$result=$this->deleteeventHelper->deleteevent($idevent,$this->user->user_id);
		if($result==true){
			
				sendRedirect("{$CONFIG['BASE_DOMAIN']}chapter/profile");
				return $this->out(TEMPLATE_DOMAIN_WEB . '/login_message.html');
				die();
		}
		
		}
	
	}
	
	function deleteevent(){
		pr('s');exit;
	}
	
	
}
?>