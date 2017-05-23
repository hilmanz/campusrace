<?php
class memberregHelper {
	
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
	
	protected function encrypt($string)
	{	
		$ENC_KEY='123456';
		return base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5($ENC_KEY), $string, MCRYPT_MODE_CBC, md5(md5($ENC_KEY))));
	}
	
	
	function registrasimember($data){
		//pr('sss'); die;
	   global $logger,$CONFIG;
		$password=$this->encrypt($data['password']);
		//pr($password);exit;
		
		$sqlGetVoucer = "SELECT id FROM ss_voucer WHERE n_status='0' order by rand() limit 1";
		$resGetVoucer = $this->apps->fetch($sqlGetVoucer);
		$voucer = $resGetVoucer['id'];
	   
		$sql = "
				UPDATE {$this->config['DATABASE'][0]['DATABASE']}.ss_member set `username`='{$data['email']}', `voucer_id`='{$voucer}',`name`='{$data['name']}'
				,password='{$password}',fb_id='{$data['fbanggota']}',twiiter_id='{$data['twitteranggota']}',`date_register`=NOW(),`point`='0',
				n_status=1,no_tlp='{$data['no_telp']}',alamat='{$data['alamat']}',kampus='{$data['kampus']}',`ktp_sim`={$data['idktpsim']} where `user_login`='{$data['userid']}' and `name`='{$data['name']}'
				order by id desc limit 1
				";
		//pr($sql);exit;
		$rs = $this->apps->query($sql); 
			
		$q = "update ss_voucer SET `n_status`='1' where id='{$voucer}'";
			$r = $this->apps->query($q);
		
		$sql="select id,chapter_id,point from {$this->config['DATABASE'][0]['DATABASE']}.ss_member where user_login='{$data['userid']}' order by id desc limit 1";
		$res = $this->apps->fetch($sql); 
		
		
		
		if($rs)
		{
			$sqlpoint="SELECT  * FROM
						{$this->config['DATABASE'][0]['DATABASE']}.ss_point WHERE type_user=1 AND type_parameter=1";
			$resultpoint= $this->apps->fetch($sqlpoint);
			if ($resultpoint)
			{
				$sqlInsertPoint = "
						INSERT {$this->config['DATABASE'][0]['DATABASE']}.ss_activity_log SET
						`type_paremeter_point`='{$resultpoint['type_parameter']}',
						`user_id`='{$res['id']}',
						`chapter_id`='{$res['chapter_id']}',
						`point`='0',
						`date`='NOW()',
						`n_status`=1
						
						 
						";
				// pr($sql);exit;
				$rsInsertPoint = $this->apps->query($sqlInsertPoint); 
				$point = $resultpoint['points']+$res['point'];
				$sql = "
				UPDATE {$this->config['DATABASE'][0]['DATABASE']}.ss_member set `point`='0' where `id`='{$res['id']}'";
		
				$rs = $this->apps->query($sql); 
			}
			
		}
		
		//pr($res['id']);exit;
		$sql = "
				UPDATE {$this->config['DATABASE'][0]['DATABASE']}.ss_akses_login set username='{$data['email']}',password='{$password}',salt='123456',date=NOW(),`role`='2',user_id='{$res['id']}',n_status=1 where `user_login`='{$data['userid']}'
				order by id desc limit 1
				";
		
		$rs = $this->apps->query($sql); 
		
		
	//pr($sql);die;
		return true;
	}
	
	function registrasimembertwitter($data){
		//pr('sssssssss'); die;
	   global $logger,$CONFIG;
		$password=$this->encrypt($data['password']);
		//pr($password);exit;
		
		$sqlGetVoucer = "SELECT id FROM ss_voucer WHERE n_status='0' order by rand() limit 1";
		$resGetVoucer = $this->apps->fetch($sqlGetVoucer);
		$voucer = $resGetVoucer['id'];
	   
		$sql = "
				UPDATE {$this->config['DATABASE'][0]['DATABASE']}.ss_member set `username`='{$data['email']}',`name`='{$data['name']}'
				,password='{$password}',fb_id='{$data['fbanggota']}',twiiter_id='{$data['twitteranggota']}',`date_register`=NOW(),`point`='0',n_status=1,no_tlp='{$data['no_telp']}',alamat='{$data['alamat']}',kampus='{$data['kampus']}',`ktp_sim`={$data['idktpsim']} where `user_login`='{$data['userid']}' and `name`='{$data['name']}'
				order by id desc limit 1
				";
		//pr($sql);exit;
		$rs = $this->apps->query($sql); 
			
		$q = "update ss_voucer SET `n_status`='1' where id='{$voucer}'";
			$r = $this->apps->query($q);
		
		$sql="select id,chapter_id,point from {$this->config['DATABASE'][0]['DATABASE']}.ss_member where user_login='{$data['userid']}' order by id desc limit 1";
		$res = $this->apps->fetch($sql); 
		
		
		
		if($rs)
		{
			$sqlpoint="SELECT  * FROM
						{$this->config['DATABASE'][0]['DATABASE']}.ss_point WHERE type_user=1 AND type_parameter=1";
			$resultpoint= $this->apps->fetch($sqlpoint);
			if ($resultpoint)
			{
				$sqlInsertPoint = "
						INSERT {$this->config['DATABASE'][0]['DATABASE']}.ss_activity_log SET
						`type_paremeter_point`='{$resultpoint['type_parameter']}',
						`user_id`='{$res['id']}',
						`chapter_id`='{$res['chapter_id']}',
						`point`='0',
						`date`='NOW()',
						`n_status`=1
						
						 
						";
				// pr($sql);exit;
				$rsInsertPoint = $this->apps->query($sqlInsertPoint); 
				$point = $resultpoint['points']+$res['point'];
				$sql = "
				UPDATE {$this->config['DATABASE'][0]['DATABASE']}.ss_member set `point`='0' where `id`='{$res['id']}'";
		
				$rs = $this->apps->query($sql); 
			}
			
		}
		
		//pr($res['id']);exit;
		$sql = "
				UPDATE {$this->config['DATABASE'][0]['DATABASE']}.ss_akses_login set username='{$data['email']}',password='{$password}',salt='123456',date=NOW(),`role`='2',user_id='{$res['id']}',n_status=1 where `user_login`='{$data['userid']}'
				order by id desc limit 1
				";
		//pr($sql); die;
		$rs = $this->apps->query($sql); 
		
		
	//pr($sql);die;
		return true;
	}
	
	function registrasimembercampus($data){
		//pr('sssssssss'); die;
	   global $logger,$CONFIG;
		$password=$this->encrypt($data['password']);
		//pr($password);exit;
		
		$sqlGetVoucer = "SELECT id FROM ss_voucer WHERE n_status='0' order by rand() limit 1";
		$resGetVoucer = $this->apps->fetch($sqlGetVoucer);
		$voucer = $resGetVoucer['id'];
	   //pr($voucer); die;
		$sql = "		
				INSERT {$this->config['DATABASE'][0]['DATABASE']}.ss_member SET
						`name`='{$data['name']}',
						`voucer_id`='{$voucer}',
						`username`='{$data['email']}',
						`password`='{$password}',
						`fb_id`='{$data['fbanggota']}',
						`twiiter_id`='{$data['twitteranggota']}',
						`date_register`=NOW(),
						`point`='0',
						`n_status`=1,
						`user_login`='{$data['email']}',
						`no_tlp`='{$data['no_telp']}',
						`alamat`='{$data['alamat']}',
						`kampus`='{$data['kampus']}',
						`ktp_sim`={$data['idktpsim']}				
				";
		//pr($sql);die;
		$rs = $this->apps->query($sql);
		
			
		$lastid=$this->apps->getLastInsertId();
			
		$q = "update ss_voucer SET `n_status`='1' where id='{$voucer}'";
			$r = $this->apps->query($q);
		
		$sql="select id,chapter_id,point from {$this->config['DATABASE'][0]['DATABASE']}.ss_member where username='{$data['email']}'";
		$res = $this->apps->fetch($sql); 
		
		if($rs)
		{
			$sqlpoint="SELECT  * FROM
						{$this->config['DATABASE'][0]['DATABASE']}.ss_point WHERE type_user=1 AND type_parameter=1";
			$resultpoint= $this->apps->fetch($sqlpoint);
			if ($resultpoint)
			{
				$sqlInsertPoint = "
						INSERT {$this->config['DATABASE'][0]['DATABASE']}.ss_activity_log SET
						`type_paremeter_point`='{$resultpoint['type_parameter']}',
						`user_id`='{$res['id']}',
						`chapter_id`='{$res['chapter_id']}',
						`point`='0',
						`date`='NOW()',
						`n_status`=1
						
						 
						";
				// pr($sql);exit;
				$rsInsertPoint = $this->apps->query($sqlInsertPoint); 
				$point = $resultpoint['points']+$res['point'];
				$sql = "
				UPDATE {$this->config['DATABASE'][0]['DATABASE']}.ss_member set `point`='0' where `id`='{$res['id']}'";
		
				$rs = $this->apps->query($sql); 
			}
			
		}
		
		//pr($res['id']);exit;
		$sql = "
				insert {$this->config['DATABASE'][0]['DATABASE']}.ss_akses_login set username='{$data['email']}',user_login='{$data['email']}',password='{$password}',user_id='{$lastid}',salt='123456',date=NOW(),`role`='2',n_status=1				
				";
		//pr($sql); die;
		$rs = $this->apps->query($sql); 
		
		
	//pr($sql);die;
		return true;
	}
	
	
	
	function selectemail($parsing_email){
		global $CONFIG;
		
		$sql="select * from {$this->config['DATABASE'][0]['DATABASE']}.ss_akses_login sal left join ss_member sm on sal.username=sm.username where sal.username='{$parsing_email}' limit 1";
		$result= $this->apps->fetch($sql,1);
		// pr($sql);exit;
		foreach($result as $key => $val)
		{
			$sql="select * from {$this->config['DATABASE'][0]['DATABASE']}.ss_chapter where id='{$val['chapter_id']}'";
			$fetch= $this->apps->fetch($sql,1);
				$sql="select count(*) as total from {$this->config['DATABASE'][0]['DATABASE']}.ss_member where chapter_id='{$val['chapter_id']}'";
			$countmember= $this->apps->fetch($sql);
			// pr($countmember);exit;
			//pr($fetch[0]['img_avatar']);exit;
			$result[$key]['countmember']=$countmember['total'];
			$result[$key]['img_avatar_chapter']=$fetch[0]['img_avatar'];
			
		}
		//pr($result);exit;
		return $result;
	
	}
	
	function getEvent($id,$idchapter){
	global $CONFIG;
		$sql = "
				SELECT *
				FROM {$this->config['DATABASE'][0]['DATABASE']}.ss_event 
				WHERE chapter_id='{$idchapter}' AND  id='{$id}'";
		
			$rs = $this->apps->fetch($sql,1); 
			
			foreach($rs as $key => $val){
				$result[$key]['time_start']=date("d/m/Y",strtotime($val['time_start']));
				$result[$key]['time_end']=date("d/m/Y",strtotime($val['time_end']));
				$rs[$key]['jam_awal']=date("g:i a",strtotime($val['time_start']));
				$rs[$key]['jam_akhir']=date("g:i a",strtotime($val['time_end']));
				
			}
			//pr($rs);exit;
		return $rs[0];
	}
	
	function updateimg($id=null,$files=null){
	global $CONFIG;
		$sql = "
				UPDATE {$this->config['DATABASE'][0]['DATABASE']}.ss_member set `img_avatar`='{$files}'
				 where `id`='{$id}'
				
				";
		//pr($sql);exit;
		$rs = $this->apps->query($sql); 
		return true;
	}
	
	
}

?>