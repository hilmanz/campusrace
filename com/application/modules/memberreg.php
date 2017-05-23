<?php
class memberreg extends App{
	
	function beforeFilter(){
 		
		global $LOCALE,$CONFIG;
		$this->memberregHelper = $this->useHelper('memberregHelper');
		$this->loginHelper = $this->useHelper('loginHelper');
		$this->assign('basedomain',$CONFIG['BASE_DOMAIN']); 
		$this->user=$this->session->getSession($this->config['SESSION_NAME'],"WEB");
		$this->assign('user', $this->user);
	}
	
	function main(){
	global $LOCALE,$CONFIG;
	//pr($this->_g(act));exit;
	//pr('abc'); die;
	
	   //pr('ss'); die;
	   $data['name'] =strip_tags($this->_p('name'));
	   $data['email'] =strip_tags($this->_p('email'));
	   $data['password'] =strip_tags($this->_p('password'));
	   $data['repassword'] =strip_tags($this->_p('repassword'));
	   $data['idktpsim'] =strip_tags($this->_p('idktpsim'));
	   $data['fbanggota'] =strip_tags($this->_p('fbanggota'));
	   $data['twitteranggota'] =strip_tags($this->_p('twitteranggota'));
	   $data['no_telp'] =strip_tags($this->_p('no_telp'));
	   $data['alamat'] =strip_tags($this->_p('alamat'));
	   $data['kampus'] =strip_tags($this->_p('kampus'));
	   $data['userid'] =strip_tags($this->_p('userid'));
	 //  pr($_POST);exit;
	  $prosesregistrasi=$this->memberregHelper->registrasimember($data);
	  //pr($prosesregistrasi);exit; 
	   if($prosesregistrasi){
			//pr('ss'); die;
				$res = $this->loginHelper->loginSession();
				$sessionuser = @$this->session->getSession($CONFIG['SESSION_NAME'],"WEB");
				 //pr($res);die;
				if($res['status']==1){
					sendRedirect("{$CONFIG['BASE_DOMAIN']}memberreg/confirm");
					return $this->out(TEMPLATE_DOMAIN_WEB . '/login_message.html');
					die();
				}
		
	   } 
	 
	// pr($_GET);die;
	if($this->_g('act')){
		
		$decrypt=urldecode64($this->_g(act));
		//pr($decrypt);exit;
		$unserialize=unserialize($decrypt);
		//Email parsingan dari Emailuser 
		$emailuser=$unserialize['email'];
		//pr($emailuser);exit;
		$selectemail=$this->memberregHelper->selectemail($emailuser);
		// pr($selectemail);exit;
		if($selectemail[0]['n_status']==0)
		{
		$this->assign('countmember',$selectemail[0]['countmember']);
		$this->assign('list',$selectemail);
		$this->assign('img_avatar',$selectemail[0]['img_avatar_chapter']);
		return $this->View->toString(TEMPLATE_DOMAIN_WEB .'apps/member-registration.html');	
		}else{
		sendRedirect($CONFIG['BASE_DOMAIN']);
		exit;
		}
		
		
	}else{
	sendRedirect($CONFIG['WEB_DOMAIN'].'home');
	exit;
	}		
	}
	
	function registerTwitter(){
		//pr('ss'); die;
		global $LOCALE,$CONFIG;
	//pr($this->_g(act));exit;
	
	//if($this->_p('submit')){
	   //pr('ss'); die;
	   $data['name'] =strip_tags($this->_p('name'));
	   $data['email'] =strip_tags($this->_p('email'));
	   $data['password'] =strip_tags($this->_p('password'));
	   $data['repassword'] =strip_tags($this->_p('repassword'));
	   $data['idktpsim'] =strip_tags($this->_p('idktpsim'));
	   $data['fbanggota'] =strip_tags($this->_p('fbanggota'));
	   $data['twitteranggota'] =strip_tags($this->_p('twitteranggota'));
	   $data['no_telp'] =strip_tags($this->_p('no_telp'));
	   $data['alamat'] =strip_tags($this->_p('alamat'));
	   $data['kampus'] =strip_tags($this->_p('kampus'));
	   $data['userid'] =strip_tags($this->_p('userid'));
	  //pr($data['name']);exit;
	  $prosesregistrasi=$this->memberregHelper->registrasimembertwitter($data);
	  //pr($prosesregistrasi);exit; 
	   if($prosesregistrasi){
			//pr('ss');die;
				$res = $this->loginHelper->loginSessionTwitter1($data);
				$sessionuser = @$this->session->getSession($CONFIG['SESSION_NAME'],"WEB");
				 //pr($res);die;
				if($res['status']==1){
					sendRedirect("{$CONFIG['BASE_DOMAIN']}memberreg/confirm");
					return $this->out(TEMPLATE_DOMAIN_WEB . '/login_message.html');
					die();
				}
		
	   } 
	//}
	}
	
	function registerMemberCampus(){		
		global $LOCALE,$CONFIG;
		
	   $data['name'] =strip_tags($this->_p('name'));
	   $data['email'] =strip_tags($this->_p('email'));
	   $data['password'] =strip_tags($this->_p('password'));
	   $data['repassword'] =strip_tags($this->_p('repassword'));
	   $data['idktpsim'] =strip_tags($this->_p('idktpsim'));
	   $data['fbanggota'] =strip_tags($this->_p('fbanggota'));
	   $data['twitteranggota'] =strip_tags($this->_p('twitteranggota'));
	   $data['no_telp'] =strip_tags($this->_p('no_telp'));
	   $data['alamat'] =strip_tags($this->_p('alamat'));
	   $data['kampus'] =strip_tags($this->_p('kampus'));
	   //$data['userid'] =strip_tags($this->_p('userid'));
	  //pr($data['name']);exit;
	  $prosesregistrasi=$this->memberregHelper->registrasimembercampus($data);
	  //pr($prosesregistrasi);exit; 
	   if($prosesregistrasi){
			//pr('ss');die;
				$res = $this->loginHelper->loginSessionCampus($data);
				$sessionuser = @$this->session->getSession($CONFIG['SESSION_NAME'],"WEB");
				 //pr($res);die;
				if($res['status']==1){
					sendRedirect("{$CONFIG['BASE_DOMAIN']}memberreg/confirm");
					return $this->out(TEMPLATE_DOMAIN_WEB . '/login_message.html');
					die();
				}
		
	   } 	
	}
	
	function reactivate(){
		
		global $LOCALE,$CONFIG;
	//pr($this->_g(act));exit;
	
	if($this->_p('submit')){
	   
	   $data['name'] =strip_tags($this->_p('name'));
	   $data['email'] =strip_tags($this->_p('email'));
	   $data['password'] =strip_tags($this->_p('password'));
	   $data['repassword'] =strip_tags($this->_p('repassword'));
	   $data['idktpsim'] =strip_tags($this->_p('idktpsim'));
	   $data['fbanggota'] =strip_tags($this->_p('fbanggota'));
	   $data['twitteranggota'] =strip_tags($this->_p('twitteranggota'));
	   $data['no_telp'] =strip_tags($this->_p('no_telp'));
	   $data['alamat'] =strip_tags($this->_p('alamat'));
	 //  pr($_POST);exit;
	  $prosesregistrasi=$this->memberregHelper->registrasimember($data);
	  //pr($prosesregistrasi);exit; 
	   if($prosesregistrasi){
			
				$res = $this->loginHelper->loginSession();
				$sessionuser = @$this->session->getSession($CONFIG['SESSION_NAME'],"WEB");
				 //pr($sessionuser);die;
				if($res['status']==1){
					sendRedirect("{$CONFIG['BASE_DOMAIN']}memberreg/confirm");
					return $this->out(TEMPLATE_DOMAIN_WEB . '/login_message.html');
					die();
				}
		
	   } 
	} 
	// pr($_GET);die;
	if($this->_g('aktivasi')){
		
		$decrypt=urldecode64($this->_g('aktivasi'));
		//pr($decrypt);exit;
		$unserialize=unserialize($decrypt);
		//Email parsingan dari Emailuser 
		$emailuser=$unserialize['email'];
		//pr($emailuser);exit;
		$selectemail=$this->memberregHelper->selectemail($emailuser);
		// pr($selectemail);exit;
		if($selectemail[0]['n_status']==0)
		{
		$this->assign('countmember',$selectemail[0]['countmember']);
		$this->assign('list',$selectemail);
		$this->assign('img_avatar',$selectemail[0]['img_avatar_chapter']);
		return $this->View->toString(TEMPLATE_DOMAIN_WEB .'apps/member-registration2.html');	
		}else{
		sendRedirect($CONFIG['BASE_DOMAIN']);
		exit;
		}
		
		
	}else{
	sendRedirect($CONFIG['WEB_DOMAIN'].'home');
	exit;
	}
	
	
	}
	
	protected function confirm($string)
	{
		if($this->user)
		{
			return $this->View->toString(TEMPLATE_DOMAIN_WEB .'/apps/success-registration-member.html');
		}
		else
		{
				sendRedirect("{$CONFIG['BASE_DOMAIN']}home");
				return $this->out(TEMPLATE_DOMAIN_WEB . '/login_message.html');
				die();
		}
		
		
	}
	function successreg(){
			return $this->View->toString(TEMPLATE_DOMAIN_WEB .'apps/success-registration-member.html');		
	}

	function reservation()
	{
		$decrypt=urldecode64($this->_request('pram'));
		$unserialize=unserialize($decrypt);
		$result=$this->memberregHelper->getEvent($unserialize['idevent'],$unserialize['chapterid']);
		$this->assign('dataevent',$result); 
		$this->assign('iduser',$unserialize['userid']);
		$this->assign('chapterid',$unserialize['chapterid']);		
		return $this->View->toString(TEMPLATE_DOMAIN_WEB .'/apps/reservation1.html');
		// pr($result);die;
	}
	

}
?>
