<?php

class chapterHelper {
	
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
	
	function addChapter($data){
		
		$sql = "INSERT INTO `ss_chapter` SET
							`name_chapter`='$name',
							`name`='$username',
							`alamat`='$email',
							`kota`='$password',
							`email`='$role',
							`no_tlp`='$areacode',
							`club_favorit`='$avatar_pic',
							`date_register`='1',
							`n_status`=1";
							pr($sql);die;
		$this->apps->query($sql);
	}
		
	 function loginSession($type=1 ){
		 $result=$this->goLogin($type);
		
		return $result;
	}
	
	function goLogin($type=1){
		global $logger, $APP_PATH,$LOCALE;
		 
		$username = trim($this->apps->_p('username'));
		$password = trim($this->apps->_p('password'));
		
		$data['status']=0;
		$data['msg']='Your login was unsucccesful. The user name or password provided is incorrect.';
		$sqlcount = "
		SELECT count(*) as total
		FROM {$this->config['DATABASE'][0]['DATABASE']}.social_member sm
		WHERE username='{$username}'";
	
		$rscount = $this->apps->fetch($sqlcount); 
		if($rscount['total']>1)
		{
			$sql = "
				SELECT *
				FROM {$this->config['DATABASE'][0]['DATABASE']}.social_member sm
				WHERE username='{$username}' and n_status!=2 LIMIT 1";
		
			$rs = $this->apps->fetch($sql); 
		}
		else
		{
			$sql = "
				SELECT *
				FROM {$this->config['DATABASE'][0]['DATABASE']}.social_member sm
				WHERE username='{$username}' LIMIT 1";
	
			$rs = $this->apps->fetch($sql); 
		}
		
		 // pr($rs);exit;
		// pr($this->encrypt($password));exit;
		$hash = $this->encrypt($password);
		// pr($hash);die;
		$plainpass = $this->decrypt($rs['password']);
		if(	$rs)
		{
			if(($plainpass==$password)&&($hash==$rs['password'])){
				
					if($rs['n_status']==1){
						
						$this->setdatasessionuser($rs);
						
						$logger->log('Able to login BEAT');
						 
						$this->login = true; 
						$data['status']=1;
						$data['msg']='proses berhasil';
						return $data;
						
					} 
					elseif ($rs['n_status']==2)
					{
						$iduser=$rs['id'];
						$sqlcekdeaktive = "
						SELECT *
						FROM {$this->config['DATABASE'][0]['DATABASE']}.deactive_ts
						WHERE user_id='{$iduser}' LIMIT 1";
					
						$rscekdeaktive = $this->apps->fetch($sqlcekdeaktive); 
						if($rscekdeaktive)
						{
							$data['status']=0;
							$data['msg']='Your login was unsucccesful. The user name or password provided is incorrect.';
						}
						else
						{
							$data['status']=0;
							$data['msg']='Sorry, your account has been deleted. If you have not received an email from us, please do not hesitate to contact us for further details.';
						}
						return $data;
					
					}
					else
					{
							$data['status']=0;
							$data['msg']='Sorry, your account has been suspended. If you have not received an email from us, please do not hesitate to contact us for further details.';
					}
			}
			else
			{
				$data['msg']='Your login was unsucccesful. The user name or password provided is incorrect.';
			
			
			}
		}
	
				$this->login = false;
				$this->add_try_login($rs);
				$logger->log("Not able to login BEAT ");
			 
				return $data;
			 
	 
	
	}
	
	protected function encrypt($string)
	{	
		$ENC_KEY='youknowwho2014';
		return base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5($ENC_KEY), $string, MCRYPT_MODE_CBC, md5(md5($ENC_KEY))));
	}
	protected function decrypt($encrypted)
	{
		$ENC_KEY='youknowwho2014';
		return rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, md5($ENC_KEY), base64_decode($encrypted), MCRYPT_MODE_CBC, md5(md5($ENC_KEY))), "\0");
	}
	
	 
	function setdatasessionuser($rs=false){
		//pr($rs);exit;
		if(!$rs) return false;
	 

		$this->logger->log('can login');
		$id = intval($rs['id']);
 
		$this->add_stat_login($id);
	 
		// $this->reset_try_login($rs);
		 // pr($this->config['SESSION_NAME']);die;
		$this->apps->session->setSession($this->config['SESSION_NAME'],"WEB",$rs);
		// pr($this->apps->session->getSession($this->config['SESSION_NAME'],"WEB"));die;
	
	}
	
	function add_try_login($rs=false){
		
		if($rs==false) return false;	
	
		$sql ="UPDATE {$this->config['DATABASE'][0]['DATABASE']}.social_member SET last_login=now(),try_to_login=try_to_login+1 WHERE id='{$rs['id']}' LIMIT 1";
		$res = $this->apps->query($sql);
		
		$sql = "SELECT try_to_login FROM {$this->config['DATABASE'][0]['DATABASE']}.social_member WHERE id='{$rs['id']}' LIMIT 1";
		$res = $this->apps->fetch($sql);
		
		//if($res){
		//	if($res['try_to_login']>4) {
		//		$sql ="UPDATE {$this->config['DATABASE'][0]['DATABASE']}.social_member SET n_status=9 WHERE id='{$rs['id']}' LIMIT 1";
		//		$res = $this->apps->query($sql);
		//	}
		//}
	}
	
	function reset_try_login($rs=false){
		
		if($rs==false) return false;	
	
		$sql ="UPDATE {$this->config['DATABASE'][0]['DATABASE']}.social_member SET last_login=now(),try_to_login=0 WHERE id='{$rs['id']}' LIMIT 1";
		$res = $this->apps->query($sql);
				
	}
	
	function add_stat_login($user_id){
	
	
		// $sql ="UPDATE social_member SET last_login=now(),login_count=0 WHERE id={$user_id} LIMIT 1";
		$sql ="UPDATE {$this->config['DATABASE'][0]['DATABASE']}.social_member SET last_login=now(),login_count=login_count+1 WHERE id={$user_id} LIMIT 1";
		// pr($sql);die;
		$rs = $this->apps->query($sql);

	
	}
	
	function getProfile(){
	
		$user = json_decode(urldecode64($this->apps->session->getSession($this->config['SESSION_NAME'],"admin")));
		
		return $user;
	
	}
	  
	 
	
	function realeaselock(){
			$username = strip_tags($this->apps->_p('username'));
			$sql = "
					UPDATE {$this->config['DATABASE'][0]['DATABASE']}.social_member SET n_status = 1,try_to_login=0
					WHERE username = '{$username}' LIMIT 1				
			";
			// pr($sql);
			return $this->apps->query($sql);
	}
	
	 
	 
	function synchdatabeat($beatdata =false,$branddata=false){
		 global $CONFIG;
		$this->logger->log('do register');
		
		
		$datas['msg'] = 'cannot register or updates ';
		$datas['result'] =false;
		if(!$beatdata) return $datas;
		
		$notsaved = "not save";
		$saved = "saved";
		// user stat
		$name = strip_tags($beatdata->name );
		$last_name = strip_tags($beatdata->last_name );
		$nickname = strip_tags($beatdata->nickname );		
		$username = strip_tags($beatdata->username );		
		$registerid = strip_tags($beatdata->id);		
	  
		$email = null;
		$email = trim(strip_tags($beatdata->email ));		 
		$deviceid = trim(strip_tags($beatdata->username ));		 
		$sex = trim(strip_tags($beatdata->sex ));
		//page stat
	 
 
		$rolesname = trim(strip_tags($beatdata->role ));
		$type =trim(strip_tags($beatdata->roletype ));		 
		$img = strip_tags($beatdata->img );
		$otherid = 0;
		$brandid = 0;
		$brandsubid = 0;
		$areaid = 0;
		$city = strip_tags($beatdata->cityname );
		$created_date = date("Y-m-d H:i:s");
		$closed_date = date("Y-m-d H:i:s");
		
		if($branddata){
			foreach($branddata as $key =>$val){
				if($key==0)$brandid = $val->id;
				else $brandsubid = $val->id;
			}
				
		}
		 
		$n_status = 1;
		
		if($email==''||$email==null){
			$this->logger->log('form registration not complete.');
			return   $datas['msg'] = "form registration not complete. email not found";
		}
			
	 
		$sql = "SELECT * FROM {$this->config['DATABASE'][0]['DATABASE']}.social_member WHERE email='{$email}' LIMIT 1 ";
		$qData = $this->apps->fetch($sql);
		// pr($qData);
		if($qData){
			if($email==''||$email==null){
				$this->logger->log('form registration not complete.');
				return $datas['msg'] =  "form registration not complete. email not found";
			}
			 $socialupdates = array();
			if($registerid)$socialupdates[] = "registerid='{$registerid}'";
			if($deviceid) $socialupdates[] = "deviceid='{$deviceid}'";
			if($last_name) $socialupdates[] = "last_name='{$last_name}'";
			if($last_name) $socialupdates[] = "name='{$name}'";
			if($last_name) $socialupdates[] = "gender='{$sex}'";
			if($nickname) $socialupdates[] = "nickname='{$nickname}'";
			$socialupdates[] = "n_status = 1,try_to_login=0  ";
		 
			if($socialupdates){
				$qUpdatesocialupdateData = implode(',',$socialupdates);
			
					
					$sql = "
						UPDATE {$this->config['DATABASE'][0]['DATABASE']}.social_member SET {$qUpdatesocialupdateData} 
							WHERE id = {$qData['id']} LIMIT 1				
						
					";
					// pr($sql); 
					$this->apps->query($sql);
			}
			$sql = "SELECT ownerid FROM {$this->config['DATABASE'][0]['DATABASE']}.my_profile WHERE ownerid={$qData['id']} LIMIT 1 ";
			$rqData = $this->apps->fetch($sql);
			
			if($rqData){
				$dataupdate = false;
				if($rolesname!='') $dataupdate[] = "name='{$rolesname}'";
				if($type!='') $dataupdate[] = "type='{$type}'";
				if($img!='') $dataupdate[] = "img='{$img}'";		 
				$dataupdate[] = "brand='{$brandid}'";
				$dataupdate[] = "brandsub='{$brandsubid}'";
				 
				if($city!='') $dataupdate[] = "city='{$city}'";
				$qUpdateData = "";
				if($dataupdate){
					$qUpdateData = implode(',',$dataupdate);
				}else return $datas['msg'] =  "form registration not complete. email not found";
				
				$sql = "
						UPDATE {$this->config['DATABASE'][0]['DATABASE']}.my_profile SET 
						{$qUpdateData} 
						WHERE ownerid = {$qData['id']} LIMIT 1				
				";
				$this->logger->log($sql);
				$this->apps->query($sql);
				
				$datas['msg'] = 'Update Success.';
						$datas['result'] = true;
						return  $datas;
			}else{
				$sql = "
					INSERT INTO {$this->config['DATABASE'][0]['DATABASE']}.my_profile (ownerid ,	name, 	description ,	type 	,img ,		brand 	,brandsub ,	city 	,created_date ,	closed_date,n_status) 
					VALUES ('{$qData['id']}','{$rolesname}','',{$type},'{$img}','{$brandid}','{$brandsubid}','{$city}',NOW(),DATE_ADD(NOW(),INTERVAL 5 YEAR),1)
				";
				// pr($sql);
				 $this->apps->query($sql);
					if($this->apps->getLastInsertId()>0)  {
						$datas['msg'] = 'Update Success.';
						$datas['result'] = true;
						return  $datas;
						 
					}
			
			}
		}else{
			if($email==''||$email==null){
				$this->logger->log('form registration not complete.');
				return  $datas['msg'] =  "form registration not complete. email not found";
			}
		
			$sql = "
				INSERT INTO {$this->config['DATABASE'][0]['DATABASE']}.social_member (deviceid,email,register_date,salt,n_status,name,nickname,username,last_name,sex,registerid) 
				VALUES ('{$deviceid}','{$email}',NOW(),'{$CONFIG['salt']}',1,'{$name}','{$nickname}','{$username}','{$last_name}','{$sex}','{$registerid}')			
			";
		
			$this->apps->query($sql);
			$lastID = $this->apps->getLastInsertId();
			if($lastID>0) {
				$sql = "
					INSERT INTO {$this->config['DATABASE'][0]['DATABASE']}.my_profile (ownerid ,	name, 	description ,	type 	,img ,brand 	,brandsub ,		city 	,created_date ,	closed_date,n_status) 
					VALUES ('{$lastID}','{$rolesname}','',{$type},'{$img}',{$brandid},{$brandsubid},'{$city}',NOW(),DATE_ADD(NOW(),INTERVAL 5 YEAR),1)
				";
				// pr($sql); 
				 $this->apps->query($sql);
					if($this->apps->getLastInsertId()>0)  {
						$datas['msg'] = 'Registration Complete.';
						$datas['result'] = true;
						return  $datas;
					}
			}		
		}
		$datas['msg'] =  "Failed";
		return  $datas;
	}
	
	
	
}
