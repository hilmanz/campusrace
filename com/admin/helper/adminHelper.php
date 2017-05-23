<?php
class adminHelper {
	
	var $_mainLayout="";
	
	var $login = false;
	
	function __construct($apps=false){
		global $logger,$CONFIG;
		$this->logger = $logger;
		$this->apps = $apps;
		$this->config = $CONFIG;
	}
	
	
	
	function listuser($start=null,$limit=10)
	{
		global $CONFIG;
		
		$result['result'] = false;
		$result['total'] = 0;
		
		if($start==null)$start = intval($this->apps->_request('start'));
		$limit = intval($limit);
		$search = strip_tags($this->apps->_p('search'));
		$notiftype = intval($this->apps->_p('notiftype'));
		
		$startdate = $this->apps->_p('startdate');
		$enddate = $this->apps->_p('enddate');
		
	
		
		//GET TOTAL
		$sql = "SELECT count(*) total
			FROM {$CONFIG['DATABASE'][0]['DATABASE']}.gm_user 
			WHERE 1 and n_status!=2 ";
		$total = $this->apps->fetch($sql);		
		
	
		if(intval($total['total'])<=$limit) $start = 0;
		
		//GET LIST
		$sql = "
			SELECT *,DATE_FORMAT(`date`,'%d-%m-%Y %H:%i') as tanggal
			FROM {$CONFIG['DATABASE'][0]['DATABASE']}.gm_user 
			WHERE 1 and n_status!=2 ORDER BY gm_user.id DESC LIMIT {$start},{$limit}"; 
		// pr($sql);die;
		$rqData = $this->apps->fetch($sql,1);

		if($rqData) {
			$no = $start+1;
			foreach($rqData as $key => $val){
				$val['no'] = $no++;
				$rqData[$key] = $val;

				$sql = "SELECT COUNT(*) total_data
							FROM {$CONFIG['DATABASE'][0]['DATABASE']}.gm_user 
						WHERE 1 and n_status!=2";
				
				$total_registrant = $this->apps->fetch($sql);
				$rqData[$key]['total_user'] = intval($total_registrant['total_data']);
			}
			//pr($rqData);exit;
			if($rqData) $qData=	$rqData;
			else $qData = false;
		} else $qData = false;
		
		$result['result'] = $qData;
		$result['total'] = intval($total['total']);
		$result['status'] = 1;
		//pr($result);exit;
		return $result;
	}	
	function deluser(){
		global $CONFIG;
		$id=$this->apps->_request('id');
			$sql = "UPDATE   {$CONFIG['DATABASE'][0]['DATABASE']}.gm_user SET
						n_status=2
						WHERE id='{$id}'"; 
				$res = $this->apps->query($sql);
	
	}
	
	function publish(){
		global $CONFIG;
		$idjobs=$this->apps->_g('id');
		$result['status']=0;
		$result['msg']='proses gagal coba lagi';
		
		if($idjobs)
			{
				$sql = "UPDATE   {$CONFIG['DATABASE'][0]['DATABASE']}.jobboard SET
						n_status=1
						WHERE id_job='{$idjobs}'"; 
				$res = $this->apps->query($sql);
				if($res)
				{
					$sql = "SELECT   jbc.category_id  AS category_id,jbc.subcategory_id  AS subcategory_id,jb.job_title AS job_title,ts.nama_perusahaan AS nama_perusahaan,
						ts.user_id AS user_id
						FROM  {$CONFIG['DATABASE'][0]['DATABASE']}.job_category jbc
						LEFT JOIN jobboard jb ON jbc.jobboard_id=jb.id_job
						LEFT JOIN tbl_talent_seeker ts ON jb.talent_seeker_id=ts.id
						WHERE jobboard_id='{$idjobs}'"; 
						// pr($sql);die;
					$response = $this->apps->fetch($sql,1);
					if($response)
					{
						foreach ($response as $key=>$row)
						{
							$sql = "SELECT   * 
							FROM  {$CONFIG['DATABASE'][0]['DATABASE']}.my_subcategory
							
							WHERE category_id='{$row['category_id']}' and subcategory_id='{$row['subcategory_id']}'"; 
							$responseuser = $this->apps->fetch($sql,1);
							// pr($sql);
							if($responseuser)
							{
								foreach ($responseuser as $keyuser=>$rowuser)
								{
									
									$sqlinsertapllication = "INSERT INTO {$CONFIG['DATABASE'][0]['DATABASE']}.my_application 
															(`user_id`,`jobboard_id`,`date`,`n_status`) 
															VALUES ('{$rowuser['user_id']}','{$idjobs}',NOW(),0)";
														// pr($sqlinsertapllication);	
									$resinsertapllication = $this->apps->query($sqlinsertapllication);
									if($resinsertapllication)
									{
										$subject  = $row['nama_perusahaan'].' menawarkan kerja sama ';
										$detail = 'Anda Mendapat Penawaran Kerja sama di '.$row['nama_perusahaan'].' sebagai '.$row['job_title'];
										$sqlinsertnotification = "INSERT INTO {$CONFIG['DATABASE'][0]['DATABASE']}.tbl_notification 
															(`from`,`to`,`subject`,`detail`,`created_date`,`n_status`) 
															VALUES ('{$row['user_id']}' ,'{$rowuser['user_id']}','{$subject}','{$detail}',NOW(),1)";
														 // pr($sqlinsertnotification);	
										$resinsertnotification = $this->apps->query($sqlinsertnotification);
										
										$result['status']=1;
										$result['msg']='proses berhasil';
									
									}
									else
									{
										$result['status']=0;
										$result['msg']='proses Query  my_application gagal coba lagi';
									}
								}
							}else
							{
								$result['status']=1;
								$result['msg']='proses Query  my_subcategory gagal coba lagi';
							}
						}
					}
					else
					{
						$result['status']=0;
						$result['msg']='proses Query  job_category gagal coba lagi';
					}
				}
				else{
					$result['status']=0;
					$result['msg']='proses UPDATE  jobboard gagal coba lagi';
				}
			}
			return $result;
		
	
	}
	function listtype(){
	global $CONFIG;
		$sql = "SELECT * FROM {$CONFIG['DATABASE'][0]['DATABASE']}.gm_type where 1"; 
		//pr($sql);exit;
		$rqData = $this->apps->fetch($sql,1);
		return $rqData;
	
	
	}
	function listmodule(){
		global $CONFIG;
		$sql = "SELECT * FROM {$CONFIG['DATABASE'][0]['DATABASE']}.gm_module where 1 and n_status=1"; 
		//pr($sql);exit;
		$rqData = $this->apps->fetch($sql,1);
		return $rqData;
	
	
	}
	function addUser(){
		global $CONFIG;
		
		
		$name = strip_tags(@$this->apps->_p('name'));       
		$type = @$_POST['type'];  
		$email = @$_POST['email']; 
		$username = @$_POST['username'];  
		$password = strip_tags(@$_POST['password']); 
		$menu=@$_POST['menu'];
		$hash = $this->encrypt($password);
		
		
		$sql = "INSERT INTO gm_user set
				`name`='{$name}',
				`username`='{$username}',
				`email`='{$email}',
				`type`='{$type}',
				`date`=NOW(),
				`password`='{$hash}',
				`n_status`=1";
		
		$res = $this->apps->query($sql);
		$id=$this->apps->getLastInsertId();
		if($menu)
		{
			foreach($menu as $row)
			{
				$sql = "REPLACE INTO  gm_permission
				(user_id, module_id)
				VALUES ('{$id}', '{$row}')";
				
				$res = $this->apps->query($sql);
			
			}
		
		}
		
		return true;
		}	
	function editsUser(){
		global $CONFIG;
		
		
		$name = strip_tags(@$this->apps->_p('name'));   
		$iduser = strip_tags(@$this->apps->_p('iduser'));    		
		$type = @$_POST['type'];  
		$email = @$_POST['email']; 
		$username = @$_POST['username'];  
		$password = strip_tags(@$_POST['password']); 
		$qpassword='';
		if($password)
		{
			$hash = $this->encrypt($password);
			$qpassword=',`password`="'.$hash.'"';
		}
		$menu=@$_POST['menu'];
		
		
		
		$sql = "UPDATE gm_user set
				`name`='{$name}',
				`username`='{$username}',
				`email`='{$email}',
				`type`='{$type}',
				`date`=NOW()
				{$qpassword}
				where id='{$iduser}' ";
		// pr($sql);
		$res = $this->apps->query($sql);
		$sql = "Delete  FROM gm_permission where user_id='{$iduser}' ";
		
		$res = $this->apps->query($sql);
		if($type==9)
			{
				$sql = "SELECT id FROM {$CONFIG['DATABASE'][0]['DATABASE']}.gm_module where 1 and n_status=1"; 
			
				$rqData = $this->apps->fetch($sql,1);
				foreach($rqData as $row)
				{
					$sql = "REPLACE INTO  gm_permission
					(user_id, module_id)
					VALUES ('{$iduser}', '{$row['id']}')";
				
					$res = $this->apps->query($sql);
					//pr($sql);
				}
			}
		else
		{
			if($menu)
			{
				
					
		
				
				
				
				
					foreach($menu as $row)
					{
						$sql = "INSERT INTO  gm_permission
						(user_id, module_id)
						VALUES ('{$iduser}', '{$row}')";
					
						$res = $this->apps->query($sql);
						// pr($sql);
					}
				
			}
		}
		// die;
		return true;
		}	
	function cat_category(){
		global $CONFIG;
		$sql = "select id,category_name as cat from {$CONFIG['DATABASE'][0]['DATABASE']}.tbl_category";
		$fetch = $this->apps->fetch($sql,1);	
		return $fetch;
		
		}
	function subcat(){
		global $CONFIG;
		$id=$this->apps->_p('id');
		$sqlcheck ="SELECT *
						FROM {$CONFIG['DATABASE'][0]['DATABASE']}.tbl_subcategory where category_id={$id}";
						
		//pr($sqlcheck);
		$rqData = $this->apps->fetch($sqlcheck,1);
		return $rqData;
	}
	function getuser(){
		global $CONFIG;
		$id=$this->apps->_g('id');
		$sqlcheck ="SELECT *
						FROM {$CONFIG['DATABASE'][0]['DATABASE']}.gm_user where id='{$id}'";
						
		$rqData = $this->apps->fetch($sqlcheck);
		return $rqData;
	}
	function getmenu(){
		global $CONFIG;
		$id=$this->apps->_g('id');
		$sqlcheck ="SELECT *
						FROM {$CONFIG['DATABASE'][0]['DATABASE']}.gm_permission where user_id='{$id}'";
						
		$rqData = $this->apps->fetch($sqlcheck,1);
		$data['menu']='';
		if($rqData )
		{
			foreach($rqData as $row)
			{
				$data['menu'][]=$row['module_id'];
			
			}
		}
		// pr($data);die;
		return $data;
	}
	protected function encrypt($string)
	{	
		$ENC_KEY='123456';
		return base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5($ENC_KEY), $string, MCRYPT_MODE_CBC, md5(md5($ENC_KEY))));
	}
	protected function decrypt($encrypted)
	{
		$ENC_KEY='123456';
		return rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, md5($ENC_KEY), base64_decode($encrypted), MCRYPT_MODE_CBC, md5(md5($ENC_KEY))), "\0");
	}
}
	
