<?php
class home extends App{
	
	function beforeFilter(){
 		
		global $LOCALE,$CONFIG;
		
		$this->assign('basedomain',$CONFIG['BASE_DOMAIN']);
		$this->chapterHelper = $this->useHelper('chapterHelper');
		$this->FacebookHelper = $this->useHelper('FacebookHelper');
		$this->twitterHelper = $this->useHelper('twitterHelper');
		$this->memberHelper = $this->useHelper('memberHelper');
		$this->loginHelper = $this->useHelper('loginHelper');
		$this->homeHelper = $this->useHelper('homeHelper');
		$this->user=$this->session->getSession($this->config['SESSION_NAME'],"WEB");		
		$this->assign('user', $this->user);
		// echo"ddd";die;	
	}
	
	function main(){
		//pr('ss'); die;
		global $LOCALE,$CONFIG;
			
			// pr($this->FacebookHelper->checkUserLogin());die;
			if($this->FacebookHelper->checkUserLogin())
				{					
					$sessionFacebook = $this->session->getSession('facebook_session','facebook');					
					$array = json_decode(json_encode($sessionFacebook), true);
					//$data['email'] = $array['userProfile']['email'];
					//pr($array);die;
					$data['name'] = $array['userProfile']['name'];
					$data['userid'] = $array['userProfile']['id'];
					$ids = $array['userProfile']['id'];
					$password = $this->memberHelper->ambilpassword($data);
					$data['password'] = $password[0]['password'];
					$data['username'] = $password[0]['username'];
					//pr($data); die;
					
					$cekfacebook = $this->memberHelper->cekfacebook($data);
					//pr($cekfacebook); die;
					if($cekfacebook){
						$res = $this->loginHelper->loginSession1($data);
						//pr($res);die;
						//$sessionuser = @$this->session->getSession($CONFIG['SESSION_NAME'],"WEB");
						//pr($sessionuser); die;
						if($res['status']==1){
							sendRedirect("{$CONFIG['BASE_DOMAIN']}member");
						}
					}else{
						//pr($data); die;
						$addmember = $this->memberHelper->addmember($data);
						if($addmember)
						{
							//echo "aaa";
							$selectemail=$this->memberHelper->selectmail($ids);
							$this->assign('list',$selectemail);
							return $this->View->toString(TEMPLATE_DOMAIN_WEB .'apps/member-registration.html');	
							//sendredirect($CONFIG['ADMIN_DOMAIN'].'membermanagement');
						}else{
							echo "gagal";
						}
					}
					
					//pr($array['userProfile']['email']);die;
					//$this->assign('list',$array);
				}
			
		
			// pr($this->FacebookHelper->checkUserLogin());die; 
		$this->homeHelper = $this->useHelper('homeHelper');
		//pr($this->config['SESSION_NAME']);exit;
		//$this->user='';
		if($this->user->role==1){
				//pr('masuk');exit;
				sendRedirect("{$CONFIG['BASE_DOMAIN']}chapter/profile");
				return $this->out(TEMPLATE_DOMAIN_WEB . '/login_message.html');
				die();
		}
		if($this->user->role==2){
			
				sendRedirect("{$CONFIG['BASE_DOMAIN']}member");
				return $this->out(TEMPLATE_DOMAIN_WEB . '/login_message.html');
				die();
		}
		$pagechapter = $this->_request('startchapter');
		$pagemember = $this->_request('startmember');
		$leaderChapter = $this->homeHelper->chapter($pagechapter,$rows=10);
		$leaderMember = $this->homeHelper->member($pagemember,$rows=10);
		$this->assign("msg",'');
		$this->assign("leaderChapter",$leaderChapter['data']);
		// pr($leaderMember);die;
		$this->assign("totalleaderChapter",$leaderChapter['total']);
		$this->assign("leaderMember",$leaderMember['data']);
		$this->assign("totalleaderMember",$leaderMember['total']);
		$urlConect =$this->FacebookHelper->init();
		
		$this->assign("urlfb",$urlConect['urlConnect']);
		// pr($_POST);
		if($this->_p('ajaxchapter'))
			 {
				 if($leaderChapter)
					{
						print_r(json_encode(array('status'=>1,'msg'=>'sucsess','data'=>$leaderChapter,'total'=> $leaderChapter['total'])));die;
					}
					else
					{
						print_r(json_encode(array('status'=>0,'msg'=>'sucsess','data'=>false,'total'=> 0)));die;
					}
			 }
			 else if($this->_p('ajaxmember'))
			 {
				 if($leaderMember)
					{
						print_r(json_encode(array('status'=>1,'msg'=>'sucsess','data'=>$leaderMember,'total'=> $leaderMember['total'])));die;
					}
					else
					{
						print_r(json_encode(array('status'=>0,'msg'=>'sucsess','data'=>false,'total'=> 0)));die;
					}
			 }
			 else
			 {
				 return $this->View->toString(TEMPLATE_DOMAIN_WEB .'home.html');
			 }
		
	}
	function loginfb()
	{
		global $LOCALE,$CONFIG;
		if($this->FacebookHelper->checkUserLogin())
				{
					
					$sessionFacebook = $this->session->getSession('facebook_session','facebook');
					//sendRedirect("{$CONFIG['BASE_DOMAIN']}");
					 //pr($sessionFacebook );die; 
					 if($this->FacebookHelper->checkUserLogin()){					
						$sessionFacebook = $this->session->getSession('facebook_session','facebook');					
						$array = json_decode(json_encode($sessionFacebook), true);
						//$data['email'] = $array['userProfile']['email'];
						//pr($array);die;
						$data['name'] = $array['userProfile']['name'];
						$data['userid'] = $array['userProfile']['id'];
						$ids = $array['userProfile']['id'];
						$password = $this->memberHelper->ambilpassword($data);
						$data['password'] = $password[0]['password'];
						$data['username'] = $password[0]['username'];
						//pr($array); die;
						
						$cekfacebook = $this->memberHelper->cekfacebook($data);
						//pr($cekfacebook); die;
						if($cekfacebook){
							$res = $this->loginHelper->loginSession1($data);
							//pr($res);die;
							//$sessionuser = @$this->session->getSession($CONFIG['SESSION_NAME'],"WEB");
							//pr($sessionuser); die;
							if($res['status']==1){
								sendRedirect("{$CONFIG['BASE_DOMAIN']}member");
							}else{
								sendRedirect("{$CONFIG['BASE_DOMAIN']}");
							}
						}else{
							$addmember = $this->memberHelper->addmember($data);
							if($addmember)
							{
								//echo "aaa";
								$selectemail=$this->memberHelper->selectmail($ids);
								$this->assign('list',$selectemail);
								return $this->View->toString(TEMPLATE_DOMAIN_WEB .'apps/member-registration.html');	
								//sendredirect($CONFIG['ADMIN_DOMAIN'].'membermanagement');
							}else{
								echo "gagal";
							}
						}
						
						//pr($array['userProfile']['email']);die;
						//$this->assign('list',$array);
					}
				}
			else
				{
					$urlConect=$this->FacebookHelper->init();
					sendRedirect("{$urlConect['urlConnect']}");
					//pr($urlConect);die;
				}
				//print $application->out(TEMPLATE_DOMAIN_WEB . '/master.html');
	}
	function loginTwiiter()
	{
		global $LOCALE,$CONFIG;
		if($this->_g('loginType')=='twitter')
				{
		//pr('ss');die;
					//if($this->twitterHelper->authorize())
					if(@isset($this->session->getSession('twitter_session','twitter')->userProfile))
							{
					//pr('ss');die;
								
								$twitid = $this->session->getSession('twitter_session','twitter')->twitter_id;
								$twituser = $this->session->getSession('twitter_session','twitter')->user;
								$twit = $this->session->getSession('twitter_session','twitter')->userProfile;
								$array = json_decode(json_encode($twit), true);
								$data['user'] = $twituser;
								$data['userid'] = $twitid;
								$data['name'] = $array['name'];
								$password = $this->memberHelper->ambilpasswordtwitter($data);
								$data['password'] = $password[0]['password'];
								$data['username'] = $password[0]['username'];
								$cektwitter = $this->memberHelper->cektwitter($data);
								//pr($data['password']); die;
								//pr($array); die;
								if($cektwitter){
									$res = $this->loginHelper->loginSessionTwitter($data);
									//pr($res);die;
									//$sessionuser = @$this->session->getSession($CONFIG['SESSION_NAME'],"WEB");
									//pr($sessionuser); die;
									if($res['status']==1){
										sendRedirect("{$CONFIG['BASE_DOMAIN']}member");
									}else{
										sendRedirect("{$CONFIG['BASE_DOMAIN']}");
									}
								}else{
								
								//$img = $array['socimg'];
								$addmember1 = $this->memberHelper->addmembertwitter($data);
								if($addmember1){
									//echo "aaa";
									$selectuserid=$this->memberHelper->selectuserid($twitid);
									$this->assign('list',$selectuserid);
									return $this->View->toString(TEMPLATE_DOMAIN_WEB .'apps/member-registration-twitter.html');	
									//return $this->View->toString(TEMPLATE_DOMAIN_WEB .'apps/member-register-fb.html');	
									//sendredirect($CONFIG['ADMIN_DOMAIN'].'membermanagement');
								}else{
									echo "gagal";
								}
								//pr($data['twitterid']);
								//die;
							}}
							else
							{
								if(isset($_REQUEST['oauth_token']))
								{
									
									pr($this->twitterHelper->authorize());
									
								}
								else
								{
									
								
									$urlConnect=$this->twitterHelper->request_login_link($flavorid,$module);
									
									sendRedirect("{$urlConnect['urlConnect']}");
								}
							}
				}
			else
			{
				$urlConnect=$this->twitterHelper->request_login_link($flavorid,$module);
				//return $this->View->toString(TEMPLATE_DOMAIN_WEB .'home.html');					
				sendRedirect("{$urlConnect['urlConnect']}"); 
			}
	}
	function registerChapter()
	{
		$this->chapterHelper = $this->useHelper('chapterHelper');
		global $LOCALE,$CONFIG;
		$listclub=$this->chapterHelper->selectclub();
		
		$this->assign("listclub",$listclub);
		$selectcity=$this->chapterHelper->selectcity();
		//pr($selectcity);exit;
		$this->assign("listcity",$selectcity);
		
		return $this->View->toString(TEMPLATE_DOMAIN_WEB .'apps/register1.html');
	}
	function pointblastmember(){
		$this->pointblastHelper = $this->useHelper('pointblastHelper');
		$pointblast=$this->pointblastHelper->pointblast();
		pr('ok Proses update member selesai');exit;
	}
	function pointblastchapter(){
		$this->pointblastHelper = $this->useHelper('pointblastHelper');
		$pointblast=$this->pointblastHelper->pointblastchapter();
		pr('ok Proses update chapter selesai');exit;
	}
	
	function checkEmail()
	{
		
			$data['email']=$this->_p('email');
			//pr($data);exit;
			$result=$this->chapterHelper->cekemail($data);
			//pr($result);exit;
			if($result)
			{
				// pr($result);
				// pr($data['email']);
				print_r(json_encode(array('status'=>1,'email'=>$data['email'])));die;
			}
			else
			{
				print_r(json_encode(array('status'=>0)));die;
				
			}
			return $this->View->toString(TEMPLATE_DOMAIN_WEB .'/apps/register1.html');
		
	}
	
	function registerMember(){
		//pr('asas');die;
		return $this->View->toString(TEMPLATE_DOMAIN_WEB .'/apps/member-registration-campus.html');		
	}
	
	function prosesaddMember()
	{
			global $LOCALE,$CONFIG;
		
			$data['email']=$this->_p('email');
			$result=$this->homeHelper->prosesaddMember($data);
			if($result)
			{
				sendRedirect("{$CONFIG['BASE_DOMAIN']}");
				return $this->out(TEMPLATE_DOMAIN_WEB . '/login_message.html');
				die();
			}
			die;
			// return $this->View->toString(TEMPLATE_DOMAIN_WEB .'/apps/addmember.html');		
	}
	
	function checkEmailMember()
	{
		global $LOCALE,$CONFIG;
			$data['email']=$this->_p('email');
			$data['twiiter_id']=$this->_p('twitteranggota');
			$result=$this->homeHelper->checkEmailMember($data);
			//$result1=$this->homeHelper->checkTwitterMember($data);
			//pr($result);exit;
			if($result)
			{
				// pr($result);
				// pr($data['email']);
				print_r(json_encode(array('status'=>1,'email'=>$data['email'])));die;
			}
			else
			{
				print_r(json_encode(array('status'=>0)));die;
				
			}
			
			return $this->View->toString(TEMPLATE_DOMAIN_WEB .'/apps/addmember.html');		
	}
}
?>