<?php
class adminmanagement extends App{
		
	function beforeFilter(){ 
		global $LOCALE,$CONFIG; 
		$this->adminHelper = $this->useHelper("adminHelper");
				$this->assign('basedomain', $CONFIG['ADMIN_DOMAIN']);
		$this->assign('basedomainpath', $CONFIG['BASE_DOMAIN_PATH']);
		$this->assign('locale', $LOCALE[1]);
		$this->assign('user', $this->user);
		$this->assign('tokenize',gettokenize(5000*60,$this->user->id));	

			//$this->user=$this->session->getSession($this->config['SESSION_NAME'],"ADMIN");
	}

	 
	function main(){
		$listuser = $this->adminHelper->listuser();
		// pr($listuser);exit;
		$this->assign('list',$listuser['result']);
		$this->assign('total',$listuser['total']);
		if($this->_p('ajax'))
		{
			print json_encode($listuser);die;
		}
		else
		{
			return $this->View->toString(TEMPLATE_DOMAIN_ADMIN .'apps/adminmanagement.html');
		}
		

		
	}
	function publish(){
		global $LOCALE,$CONFIG; 
		$idjob = $this->_g('id');
		$publish= $this->adminHelper->publish();
		
		if($publish['status']==1)
		{
			$this->emailnotifHelper->sendEmail();
			sendRedirect($CONFIG['ADMIN_DOMAIN']."jobmanagement");
		}
		else
		{
			pr($publish);die;
		}

	}
	function addUser(){
	   global $LOCALE,$CONFIG; 
	 
		$listtype = $this->adminHelper->listtype();
		$listModule = $this->adminHelper->listmodule();
		
	
		$this->assign('load',$listtype);
		$this->assign('listModule',$listModule);
		
		if(@$_POST['submit'])
		{
				
				$name = strip_tags($this->_p('name'));     
		
				$type = $this->_p('type');  
			
				$email = $this->_p('email'); 
				$emailval=$this->is_valid_email(strip_tags($email));
				$username = @$this->_p('username');  
				$password = strip_tags($this->_p('password')); 
				$passwordconfirm = strip_tags($this->_p('passwordc')); 
				$menu=@$_POST['menu'];
				
				$name_no="";
				$type_no='';
				$email_no='';
				$username_no='';
				$password_no ='';
				$pesan_error="";
				
				if($name=='')
				{
					$name_no="You cannot leave this field empty";
					$pesan_error="ada";
				
				}
				if($email=='' || !$emailval)
				{
					$email_no="You cannot leave this field empty";
					$pesan_error="ada";
				
				}
				if($username=='')
				{
					$username_no="You cannot leave this field empty";
					$pesan_error="ada";
				
				}
				if($password=='')
				{
					$password_no="You cannot leave this field empty";
					$pesan_error="ada";
				
				}
				if($password!=$passwordconfirm )
				{
					$password_no="The password you entered does not match";
					$pesan_error="ada";
				
				}
				
			if($pesan_error)
			{
					$this->assign('name', $name);
					$this->assign('type', $type);
					
					$this->assign('name_no', $name_no);
					$this->assign('email', $email);
					$this->assign('email_no', $email_no);
					$this->assign('username', $username);
					$this->assign('username_no', $username_no);
					$this->assign('password', $password);
					$this->assign('password_no', $password_no);
					$this->assign('checkmenu', $menu);
						// pr($_POST);die;			
				return $this->View->toString(TEMPLATE_DOMAIN_ADMIN .'apps/adduseradmin.html');
			}
				
			
			
			
			$listjob = $this->adminHelper->addUser();
			if($listjob )
			{
				sendRedirect($CONFIG['ADMIN_DOMAIN']."adminmanagement");
			}
		}
		
		return $this->View->toString(TEMPLATE_DOMAIN_ADMIN .'apps/adduseradmin.html');
	
	
	}
	function editadmin(){
	   
	  // pr($this->user->id);exit;
	  global $LOCALE,$CONFIG; 
		
		
		
		if(isset($_POST['submit']))
		{
			//$listjob = $this->adminHelper->editjob();
			$name = strip_tags($this->_p('name'));     
		
				$type = $this->_p('type');  
			
				$email = $this->_p('email'); 
				$emailval=$this->is_valid_email(strip_tags($email));
				$username = @$this->_p('username');  
				
				$menu=@$_POST['menu'];
				
				$name_no="";
				$type_no='';
				$email_no='';
				$username_no='';
				$password_no ='';
				$pesan_error="";
				
				if($name=='')
				{
					$name_no="Kolom ini harus di isi";
					$pesan_error="ada";
				
				}
				if($email=='' || !$emailval)
				{
					$email_no="Kolom ini harus di isi";
					$pesan_error="ada";
				
				}
				if($username=='')
				{
					$username_no="Kolom ini harus di isi";
					$pesan_error="ada";
				
				}
				
				
			if($pesan_error)
			{
					$this->assign('name', $name);
					$this->assign('type', $type);
					
					$this->assign('name_no', $name_no);
					$this->assign('email', $email);
					$this->assign('email_no', $email_no);
					$this->assign('username', $username);
					$this->assign('username_no', $username_no);
					
					$this->assign('checkmenu', $menu);
						// pr($_POST);die;			
				//return $this->View->toString(TEMPLATE_DOMAIN_ADMIN .'apps/edituseradmin.html');
			}
			$listjob = $this->adminHelper->editsUser();
			if($listjob )
			{
				sendRedirect($CONFIG['ADMIN_DOMAIN']."adminmanagement");
			}
		}
		$listtype = $this->adminHelper->listtype();
		$listModule = $this->adminHelper->listmodule();
		$getuser = $this->adminHelper->getuser();
	
		$getmenu = $this->adminHelper->getmenu();
		// pr($getmenu['menu']);die;
		$this->assign('load',$listtype);
		$this->assign('checkmenu',$getmenu['menu']);
		$this->assign('user',$getuser);
		$this->assign('listModule',$listModule);
		
		return $this->View->toString(TEMPLATE_DOMAIN_ADMIN .'apps/edituseradmin.html');
	
	
	}
	function deluser(){
		global $LOCALE,$CONFIG; 
		$result = $this->adminHelper->deluser();
			sendRedirect($CONFIG['ADMIN_DOMAIN']."adminmanagement");
						return $this->out(TEMPLATE_DOMAIN_ADMIN . '/login_message.html');
						die();
	}
	}
?>