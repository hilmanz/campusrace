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
	function updateimg($id=null,$files=null){
	global $CONFIG;
		$sql = "
				UPDATE {$this->config['DATABASE'][0]['DATABASE']}.ss_chapter set `img_avatar`='{$files}'
				 where `id`='{$id}'
				
				";
		//pr($sql);exit;
		$rs = $this->apps->query($sql); 
		return true;
	}
	
	function Addfoto($id=null,$files=null){
	global $CONFIG;
		$sql = "
				UPDATE {$this->config['DATABASE'][0]['DATABASE']}.ss_event set `upload_foto`='{$files}'
				 where `id`='{$id}'
				
				";
		//pr($sql);exit;
		$rs = $this->apps->query($sql); 
		return true;
	}
	
	function editprofile($files=null,$data,$id_user){
	global $CONFIG;
		if($data['password']!=''){
			$sql="update {$CONFIG['DATABASE'][0]['DATABASE']}.ss_akses_login set `password`='{$data['password']}' where user_id={$id_user} and role=1";
			//pr($sql);exit;
			$query = $this->apps->query($sql);
		}
		
		$fb = $this->apps->_p('facebook');
		if($fb)
		{
			$fb=str_replace('https://www.facebook.com/','',$fb);
			$fb=str_replace('http://www.facebook.com/','',$fb);
			$fb=str_replace('www.facebook.com/','',$fb);
			$fb=str_replace('www.facebook.com','',$fb);
		}
		$twitter = $this->apps->_p('twitter');
		if($twitter)
		{
			$twitter=str_replace('https://twitter.com/','',$twitter);
			$twitter=str_replace('http://twitter.com/','',$twitter);
			$twitter=str_replace('twitter.com/','',$twitter);
			$twitter=str_replace('twitter.com','',$twitter);
		
		}
		
		
	if($files==null || $files==''){
	
		$sql = "
				UPDATE {$this->config['DATABASE'][0]['DATABASE']}.ss_chapter set
				`name_chapter`='{$data['name_chapter']}',
				`email`='{$data['email']}',
				`no_tlp`='{$data['telp']}',
				`facebook`='{$fb}',
				`twitter`='{$twitter}',
				`alamat`='{$data['alamat']}'
				 where `id`='{$id_user}'
				";
		
	}else{
	
		$sql = "
				UPDATE {$this->config['DATABASE'][0]['DATABASE']}.ss_chapter set
				`name_chapter`='{$data['name_chapter']}',
				`email`='{$data['email']}',
				`no_tlp`='{$data['telp']}',
				`img_avatar`='{$files}',
				`alamat`='{$data['alamat']}',
				`facebook`='{$fb}',
				`twitter`='{$twitter}'
				
				
				 where `id`='{$id_user}'
				";
	
	
	}
	
	
	//	pr($sql);exit;
		$rs = $this->apps->query($sql); 
		return true;
	}
	
	
	function profile($id){
		$sql = "
				SELECT sc.*
				FROM {$this->config['DATABASE'][0]['DATABASE']}.ss_akses_login  sal
				LEFT JOIN {$this->config['DATABASE'][0]['DATABASE']}.ss_chapter sc
				ON sal.user_id=sc.id
				WHERE sal.id='{$id}' LIMIT 1";
		
			$rs = $this->apps->fetch($sql,1); 
			//pr($rs);exit;
			foreach($rs as $key => $val){
				$sql = "
				SELECT city
				FROM {$this->config['DATABASE'][0]['DATABASE']}.cities  
				WHERE id='{$val['kota']}' LIMIT 1";
				
				$fetch = $this->apps->fetch($sql);
				//pr($fetch);exit;
				$rs[$key]['citinya'] = $fetch['city'];
				
			}
			// pr($rs);die;
		return $rs[0];
	}
	
	function selecteprofileedit($id){
		$sql = "
				SELECT sc.*,sal.password as password
				FROM {$this->config['DATABASE'][0]['DATABASE']}.ss_akses_login  sal
				LEFT JOIN {$this->config['DATABASE'][0]['DATABASE']}.ss_chapter sc
				ON sal.user_id=sc.id
				WHERE sal.id='{$id}' LIMIT 1";
		
			$rs = $this->apps->fetch($sql); 
			// pr($sql);die;
		return $rs;
	}
	function countMember($id){
		$sql = "
				SELECT count(*) as total
				FROM {$this->config['DATABASE'][0]['DATABASE']}.ss_member 
				WHERE chapter_id='{$id}' and n_status in (0,1) LIMIT 1";
		
			$rs = $this->apps->fetch($sql); 
			// pr($sql);die;
		return $rs;
	}
	
	function deleteevent($idevent,$id){
		//pr('s');exit;
		$sql = "delete * from {$this->config['DATABASE'][0]['DATABASE']}.ss_event where
			id='{$idevent}' and chapter_id='{$id}'
			";
			//pr($sql);exit;
		$rs = $this->apps->query($sql); 
			// pr($sql);die;
		if($rs){
			
			return true;
		}else{
			return false;
		}
	}
	
	function hapusevent($idevent,$id){
		//pr('s');exit;
		$sql = "delete from {$this->config['DATABASE'][0]['DATABASE']}.ss_event where
			id='{$idevent}' and chapter_id='{$id}'
			";
			//pr($sql);exit;
		$rs = $this->apps->query($sql); 
			 //pr($rs);die;
		if($rs){
			
			return true;
		}else{
			return false;
		}
	}
	function countEvent($id){
		$sql = "
				SELECT count(*) as total
				FROM {$this->config['DATABASE'][0]['DATABASE']}.ss_event 
				WHERE chapter_id='{$id}' AND n_status in (0,1) LIMIT 1";
		
			$rs = $this->apps->fetch($sql); 
			// pr($sql);die;
		return $rs;
	}
	function countTantangan($id){
		$sql = "
				
				SELECT count(*) as total
				FROM {$this->config['DATABASE'][0]['DATABASE']}.ss_challange_detail, {$this->config['DATABASE'][0]['DATABASE']}.ss_chalangge
				WHERE ss_challange_detail.id_challange=ss_chalangge.id 
				and ss_challange_detail.id_chapter='{$id}' 
				AND ss_chalangge.n_status=1 LIMIT 1
				";
		
			$rs = $this->apps->fetch($sql); 
			 //pr($sql);die;
		return $rs;
	}
	
	function cekemail($email){
		//pr($email['email']);exit;
		$sql = " SELECT *
				FROM {$this->config['DATABASE'][0]['DATABASE']}.ss_chapter 
				WHERE email='{$email['email']}' LIMIT 1";
		//pr($sql);exit;
		$rs = $this->apps->fetch($sql); 
		// pr($rs);die
		
		return $rs;
	}
	
	function member($id,$page=null,$rows=10){
		$search=$this->apps->_request('search');
		$status=$this->apps->_request('status');
		$filter='';
		if($search){
		$filter = $search=="Search..." ? "" : "AND (name LIKE '%{$search}%' or username LIKE '%{$search}%' )";
		}
		$statusquery='';
		if($status==1){
			$statusquery= " AND `n_status`='{$status}'";
		}else if($status==2){
			$statusquery= " AND `n_status`=0";
		}else if($status==3){
			$statusquery= " AND `n_status`=3";
		}else{
			$statusquery= " and n_status in (1,0,3)";
			
		}
		if($page)
			{
				$start = $page ;
			}
		else
			{
				$start = 0;
			}
		$sql = "
				SELECT *
				FROM {$this->config['DATABASE'][0]['DATABASE']}.ss_member 
				WHERE chapter_id='{$id}'  {$filter} {$statusquery} order by name asc";
				//pr($sql);exit;
		$uDatatotal = $this->apps->fetch($sql,1);
		$rs['total']=count($uDatatotal);
		$sql .=" LIMIT ".$start.",".$rows;
			$rs['data'] = $this->apps->fetch($sql,1); 
			//pr($rs);exit;
			foreach($rs['data'] as $key => $val){
				//$rs['data'][$key]['point']=$this->format_angka($val['point']+$val['point_fm']);
				$rs['data'][$key]['point']=$val['point_total'];
				$rs['data'][$key]['id_memberCrypt']=$this->encrypt($val['id']);
			}
			// pr($sql);die;
		return $rs;
	}
	
	function deletemember($data){
		
			//PARAMETER DELETENYA DI DECRYPT DULU
		
			$param = $data['param'];
			//$param = str_replace("_","+",$param);
			//pr($param);exit;
			//$datanya=$this->decrypt($param);
			
			//HAPUS YANG ADA DI SS AKSES LOGIN
			$sql = "update 
				 {$this->config['DATABASE'][0]['DATABASE']}.ss_akses_login set n_status='2'
				WHERE user_id={$param} ";
		
			$rsid = $this->apps->query($sql,1); 
		
			//HAPUS YANG ADA DI SS MEMBER
			$sql = "
				update 
				{$this->config['DATABASE'][0]['DATABASE']}.ss_member set n_status='2'
				WHERE id={$param} ";
			//pr($sql);exit;
			$rs = $this->apps->query($sql,1);
			
			// KIRIM EMAIL NYA 
			//$sql = "SELECT * FROM ss_member WHERE id='{$param}'";
			$sql = "SELECT ss_member.username,ss_member.name,ss_chapter.name_chapter FROM ss_member, ss_chapter
                                        WHERE ss_member.chapter_id=ss_chapter.id
                                        and ss_member.id={$param}";
			//pr($sql);exit;
			$resGetMember = $this->apps->fetch($sql); 
			$dataArray = array(
				'username'=>$resGetMember['username'],
				'namemember'=>$resGetMember['name'],
				'namechapter'=>$resGetMember['name_chapter']
			);
			//$link = urlencode64(serialize(array(
			//	'status'=>'1',
			//	'username'=>$emluser
			//)));
			//pr($dataArray);exit;
			/* pr($dataArray);
			pr($link);
			exit; */
					
			$returnEmail = $this->send_delmemeber($dataArray);
			//pr($dataArray);die;
			if($returnEmail['status']!=1){	
				$nstatus='3';
			}
			else{
				$nstatus='0';
			}
			
			return true;			
	}
	
	function send_delmemeber($dataArray=null,$link=null) {  
		global $LOCALE;
		
		if($dataArray){
			$results['msg']='';
			$results['status']='';
			$template = $LOCALE[1]['delmember'];
			$template = str_replace('!#name',$dataArray['namemember'],$template);
			$template = str_replace('!#chaptername',$dataArray['namechapter'],$template);
			//$template = str_replace('!#link',$this->config['BASE_DOMAIN'].'memberreg/'.$link,$template);
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
			curl_setopt($ch, CURLOPT_USERPWD, 'api:key-031f6c645c2c27d331e152ba8a959e28');
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
			curl_setopt($ch, CURLOPT_URL, 
					  'https://api.mailgun.net/v3/gte.supersoccer.co.id/messages');
			curl_setopt($ch, CURLOPT_POSTFIELDS, 
							array('from' => 'Supersoccer Community Race<sscr-admin@supersoccer.co.id>',
								  'to' => $dataArray['username'],
								  'subject' => "Pemberitahuan dari Chapter ".$dataArray['namechapter']."",
								  'html' => $template,
								  'o:campaign' => 'fkdf5'));
			$result = curl_exec($ch);
			$info = curl_getinfo($ch);
			// pr($info);
			// pr($result);
			$res = json_decode($result,TRUE);
			 
			if($info['http_code']!='200'){
					$results['msg']=$res['message'];
					$results['status']='0';
			}
			else{
				$results['msg']=$res['message'];
				$results['status']='1';				  
			}
			curl_close($ch);
			return $results;
		}
		$results['status']='0';
		return $results;
	}
	
	function memberpoint($id,$page=null,$rows=10){ 
		$search=$this->apps->_request('search');
		$status=$this->apps->_g('status');
		$filter='';
		if($search){
		$filter = $search=="Search..." ? "" : "AND (Name LIKE '%{$search}%')";
		}
		$statusquery='';
		if($status==1){
			$statusquery= " AND `n_status`='{$status}'";
		}else if($status==2){
			$statusquery= " AND `n_status`=0";
		}else{
			$statusquery= " and n_status in (1,0,3) ";
			
		}
			if($page)
			{
				$start = $page ;
			}
		else
			{
				$start = 0;
			}
		$sql = "
				SELECT *
				FROM {$this->config['DATABASE'][0]['DATABASE']}.ss_member 
				WHERE chapter_id='{$id}' {$filter} {$statusquery} order by point desc ";
		$uDatatotal = $this->apps->fetch($sql,1);
		$rs['total']=count($uDatatotal);
		$sql .=" LIMIT ".$start.",".$rows;
			$rs['data'] = $this->apps->fetch($sql,1); 
		//pr($rs['data']);exit;
		
		foreach($rs['data'] as $key => $val){
		/* $rs['data'][$key]['point']=$this->format_angka($val['point']+$val['point_fm']); */
		$rs['data'][$key]['point']=$val['point_total'];		
		}
		return $rs;
	}
	
	function memberpaging($start=null,$limit=10){
		global $CONFIG;
		
		$rs['result'] = false;
		$rs['total'] = 0;		
		if($start==null)$start = intval($this->apps->_request('start'));
		
		//Seaching Berdasarkan tanggal dan Nama Cabang 
		
		$filter='';
		
		
		//Count total
		$limit = intval($limit);
		$sql = "SELECT COUNT(*) total 
				FROM  {$CONFIG['DATABASE'][0]['DATABASE']}.ss_member where 1 AND n_status !=2  {$filter} "; 
		//pr($sql);exit;
		$total = $this->apps->fetch($sql);		
		if(intval($total['total'])<=$limit) $start = 0;
		
		
		
		//pr($rsut);exit;
		$rs['status'] = true;
		$rs['result'] = $rsut;
		$rs['total'] = intval($total['total']); 
		return $rs;
	}
	
	function selectclub(){
		$sql = "
				SELECT *
				FROM {$this->config['DATABASE'][0]['DATABASE']}.ss_club";
		
			$rs = $this->apps->fetch($sql,1); 
			// pr($sql);die;
		return $rs;
	}
	
	function selectcity(){
		$sql = "
				SELECT *
				FROM {$this->config['DATABASE'][0]['DATABASE']}.cities ORDER BY city ASC";
		
			$rs = $this->apps->fetch($sql,1); 
			// pr($sql);die;
		return $rs;
	}
	function event($id){
		$sql = "
				SELECT *
				FROM {$this->config['DATABASE'][0]['DATABASE']}.ss_event 
				WHERE chapter_id='{$id}'  AND  time_end >= NOW() and n_status in (0,1)ORDER BY time_end ASC LIMIT 3";
		//pr($sql);exit;
			$rs = $this->apps->fetch($sql,1); 
			//pr($rs);die;
			foreach($rs as $key => $val){
				$rs[$key]['jam_awal']=date("g:i a",strtotime($val['time_start']));
				$rs[$key]['jam_akhir']=date("g:i a",strtotime($val['time_end']));
				
			}
		return $rs;
	}
	function eventold($id){
		$sql = "
				SELECT *,DATE_FORMAT(time_end, '%d %M %Y') as time_end,(select count(*) as total FROM ss_list_pesertaevent WHERE event_id=ss_event.id AND chapter_id={$id}) as total_peserta
				FROM {$this->config['DATABASE'][0]['DATABASE']}.ss_event 
				WHERE chapter_id='{$id}' AND ss_event.n_status=3 ORDER BY ss_event.time_end DESC LIMIT 3";
		
			// pr($sql);die;
			$rs = $this->apps->fetch($sql,1); 
			
		return $rs;
	}
	
	function getEventpeserta($id,$idchapter){
		$sql = "
				SELECT name
				FROM {$this->config['DATABASE'][0]['DATABASE']}.ss_list_pesertaevent slp
				LEFT JOIN {$this->config['DATABASE'][0]['DATABASE']}.ss_member ON slp.member_id=ss_member.id
				WHERE slp.chapter_id='{$idchapter}' AND  slp.event_id='{$id}'";
		
			$rs = $this->apps->fetch($sql,1); 
			// pr($sql);die;
		return $rs;
	}
	function getEvent($id,$idchapter){
		global $LOCALE,$CONFIG;
		$sql = "
				SELECT se.*,time_start as waktu_awal,time_end as waktu_akhir,DATE_FORMAT(time_start,'%d-%m-%Y') as date_start,DATE_FORMAT(time_start,'%h:%h %p') as waktu_start,DATE_FORMAT(time_end,'%d-%m-%Y') as date_end,DATE_FORMAT(time_start,'%d/%m/%Y') as time_start,DATE_FORMAT(time_end,'%d/%m/%Y') as time_end,DATE_FORMAT(time_end,'%h:%h %p') as waktu_end,ste.name_type,DATE_FORMAT(NOW(),'%d-%m-%Y') as time_now
				FROM {$this->config['DATABASE'][0]['DATABASE']}.ss_event se
				LEFT JOIN {$this->config['DATABASE'][0]['DATABASE']}.ss_type_event ste ON se.type=ste.id
				WHERE se.chapter_id='{$idchapter}' AND  se.id='{$id}'";
	
			//pr($sql);exit;
			$rs = $this->apps->fetch($sql,1); 
	
			foreach($rs as $key => $val){
			
			//BUAT AMBIL FOTO 
			
			$unserfoto=unserialize($val['upload_foto']);
			// pr($unserfoto);
			$ix=0;
			foreach($unserfoto['file'] as $k =>$v){
				// pr($v);
				if($v['name']){
					$unser['upload_foto'][]['name']=$v['name'];
					// pr($v['name']);
				} 
				$ix++;
			}
			// pr($unser);
			$rs[$key]['upload_foto']=$unser['upload_foto'];
			$rs[$key]['jam_awal']=date("g:i a",strtotime($val['waktu_awal']));
			$rs[$key]['jam_akhir']=date("g:i a",strtotime($val['waktu_akhir']));
		}
		//pr($rs);exit;
		return $rs;
	}
	function getMember($id,$idmember){
		$sql = "
				SELECT sm.*,sc.name_chapter
				FROM {$this->config['DATABASE'][0]['DATABASE']}.ss_member sm
				LEFT JOIN ss_chapter sc ON sm.chapter_id=sc.id
				WHERE sm.chapter_id='{$id}' AND  sm.id='{$idmember}'";
		
			$rs = $this->apps->fetch($sql); 
			// pr($sql);die;
		return $rs;
	}
	function addChapter($data){
		 //pr($data);exit;
		$sql = "INSERT INTO `ss_chapter` SET
							`name_chapter`='{$data['namechapter']}',
							`name`='{$data['name']}',
							`alamat`='{$data['alamat']}',
							`kota`='{$data['kota']}',
							`email`='{$data['email']}',
							`no_tlp`='{$data['telp']}',
							`ktp_sim`='{$data['ktp_sim']}',
							`club_favorit`='{$data['club']}',
							`facebook`='{$data['facebook']}',
							`twitter`='{$data['twitter']}',
							`date_register`=NOW(),
							`n_status`=1";
							 //pr($sql);exit;
		$result= $this->apps->query($sql);
		 //pr($result);
		if($result)
		{
			$idusers=$this->apps->getLastInsertId();
				$sql = "INSERT INTO `ss_akses_login` SET
							`user_id`='{$idusers}',
							`username`='{$data['email']}',
							`password`='{$data['password']}',
							`role`='1',
							`date`=NOW(),
							`n_status`=1";
				// pr($sql);			
			$result= $this->apps->query($sql);
			
			//$sql="select id,point from {$this->config['DATABASE'][0]['DATABASE']}.ss_chapter where id='{$idusers}'";
			//$res = $this->apps->fetch($sql);
			
			//$sqlpoint="SELECT  * FROM {$this->config['DATABASE'][0]['DATABASE']}.ss_point WHERE type_user=2 AND type_parameter=11";
			//$resultpoint= $this->apps->fetch($sqlpoint);
			//if ($resultpoint)
			//{
			//	$sqlInsertPoint = "
			//			INSERT {$this->config['DATABASE'][0]['DATABASE']}.ss_activity_log SET
			//			`type_paremeter_point`='{$resultpoint['type_parameter']}',
			//			`chapter_id`='{$idusers}',
			//			`point`='{$resultpoint['points']}',
			//			`date`='NOW()',
			//			`n_status`=1
			//			
			//			 
			//			";
			//	// pr($sql);exit;
			//	$rsInsertPoint = $this->apps->query($sqlInsertPoint); 
			//	
			//	
			//	
			//	$point = $resultpoint['points']+$res['point'];
			//	$sql = "UPDATE {$this->config['DATABASE'][0]['DATABASE']}.ss_chapter set `point`='{$point}' where `id`='{$idusers}'";
		
			//	$rs = $this->apps->query($sql); 
			//}
		}
		return $result;
	}
		
	 function loginSession($type=1 ){
		 $result=$this->goLogin($type);
		
		return $result;
	}
	function checkEmail($email){
		$sql = "
				SELECT *
				FROM {$this->config['DATABASE'][0]['DATABASE']}.ss_akses_login
				WHERE username='{$email['email']}' LIMIT 1";
		
			$rs = $this->apps->fetch($sql); 
			// pr($sql);die;
		return $rs;
	}
	function gettypeEvent($email){
		$sql = "
				SELECT *
				FROM {$this->config['DATABASE'][0]['DATABASE']}.ss_type_event";
		
			$rs = $this->apps->fetch($sql,1); 
			// pr($sql);die;
		return $rs;
	}
	function prosesaddMember($dataemail,$iduser){
	
		$email = explode(',',$dataemail['email']);
		// pr($email);
		// pr($dataemail);
		if($email)
		{
				
			foreach($email as $row)
			{
				$emluser = trim($row);
				// $iduser
				$sqlGetChapter = "SELECT name_chapter FROM ss_chapter WHERE id='{$iduser}'";
				$resGetChapter = $this->apps->fetch($sqlGetChapter); 
				$dataArray = array(
						'email'=>$emluser,
						'namechapter'=>$resGetChapter['name_chapter']
					);
					$link = urlencode64(serialize(array(
						'status'=>'1',
						'email'=>$emluser
					)));
					
				$returnEmail = $this->send_addmemeber($dataArray,$link);
				// pr($returnEmail);die;
				if($returnEmail['status']!=1)
				{	
					$nstatus='3';
				}
				else
				{
					$nstatus='0';
					
				}
				$sql = "INSERT INTO `ss_member` SET
								`username`='".trim($row)."',
								`chapter_id`='{$iduser}',
								`n_status`={$nstatus}";
				// pr($sql);
				$result= $this->apps->query($sql);
				$lastid=$this->apps->getLastInsertId();
				$sql = "select chapter_id from `ss_member` where id='{$lastid}'";
				$result = $this->apps->fetch($sql,1);
			
				// KIRIM EMAIL NYA 
				$sqlGetChapter = "SELECT name_chapter as name FROM ss_chapter WHERE id='{$result[0]['chapter_id']}'";
				//pr($sqlGetChapter);exit;
				$resGetChapter = $this->apps->fetch($sqlGetChapter); 
				//pr($resGetChapter);exit;
				$namachapternyah=str_replace(' ','_',$resGetChapter['name']);
				$ssgte_id=$namachapternyah.'-'.$lastid;
				$sqlx = "update ss_member SET
							`ssgte_id`='{$ssgte_id}' where id='{$lastid}'
							";
				$resultx = $this->apps->query($sqlx);
				
				
				$sql = "INSERT INTO `ss_akses_login` SET
								`user_id`='{$lastid}',
								`username`='".trim($row)."',
								`role`='2',
								`n_status`={$nstatus}";
				// pr($sql);
				$result= $this->apps->query($sql);
				
				
			}	
			
		}
		
		// die;
		
		return true;
	}
	function send_addmemeber($dataArray=null,$link=null) {  
		global $LOCALE;
		if($dataArray)
		{
			$results['msg']='';
			$results['status']='';
			$template = $LOCALE[1]['addmember_web'];
			//$template = str_replace('!#name',$dataArray['email'],$template);
			$template = str_replace('!#chaptername',$dataArray['namechapter'],$template);
			$template = str_replace('!#link',$this->config['BASE_DOMAIN_REG'].$link,$template);
			  $ch = curl_init();
			  curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
			  curl_setopt($ch, CURLOPT_USERPWD, 'api:key-031f6c645c2c27d331e152ba8a959e28');
			  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			  curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
			  curl_setopt($ch, CURLOPT_URL, 
						  'https://api.mailgun.net/v3/gte.supersoccer.co.id/messages');
			  curl_setopt($ch, CURLOPT_POSTFIELDS, 
							array('from' => 'Supersoccer Community Race<sscr-admin@supersoccer.co.id>',
								  'to' => $dataArray['email'],
								  'subject' => "Registrasi Member ".$dataArray['namechapter']."",
								  'html' => $template,
								  'o:campaign' => 'fkdf5'));
			  $result = curl_exec($ch);
			  $info = curl_getinfo($ch);
			 // pr($info);
			   //pr($result);
			  $res = json_decode($result,TRUE);
			  
			  if($info['http_code']!='200')
			  {
					$results['msg']=$res['message'];
					$results['status']='0';
			  }
			   else
			   {
				   $results['msg']=$res['message'];
					$results['status']='1';
				   
			   }
			  curl_close($ch);
			  return $results;
		}
		$results['status']='0';
		return $results;
	}
	
	function prosesadEvent($data,$iduser){
	
		$placename = $data['placename'];
		$events = $data['events'];
		$catevent = $data['catevent'];
		$jumlahpeserta = $data['jumlahpeserta'];
		$lang = $data['lang'];
		$lat = $data['lat'];
		$alamat = '<p>'.$data['alamat'].'</p>';
		$datestart = $data['datestart'];
		$datefinish = $data['datefinish'];
		// pr($email);
		// pr($dataemail);
				
			
				/*$sql = "INSERT INTO `ss_event` SET
								`chapter_id`='{$iduser}',
								`type`='{$catevent}',
								`name`='".$placename."',
								`alamat`='{$alamat}',
								`lat`={$lat},
								`long`='".$lang."',
								`description`='{$events}',
								`target_peserta`='{$jumlahpeserta}',
								`time_start`='{$datestart}',
								`time_end`='{$datefinish}',
								`date_create`=NOW(),
								`n_status`=0
								";*/
								
				$sql = "INSERT INTO `ss_event` SET
								`chapter_id`='{$iduser}',
								`type`='{$catevent}',
								`name`='".$placename."',
								`alamat`='{$alamat}',
								
								`description`='{$events}',
								`target_peserta`='{$jumlahpeserta}',
								`time_start`='{$datestart}',
								`time_end`='{$datefinish}',
								`date_create`=NOW(),
								`point`=0,
								`n_status`=0
								";
				
				$result= $this->apps->query($sql);
				$idevents=$this->apps->getLastInsertId();
				/**$sqlmember="SELECT * FROM ss_member WHERE `chapter_id`='{$iduser}' AND n_status=1";
				$sqlchapter="SELECT * FROM ss_chapter WHERE `id`='{$iduser}' AND n_status=1";
				$rsmember = $this->apps->fetch($sqlmember,1);
				$rschapter = $this->apps->fetch($sqlchapter);
				// pr($rsmember);
				foreach($rsmember as $keymember=>$valuemember)
				{
					if($catevent=='1')
					{
						$typeEvenya ='Nonton Bareng';
					}
					else if($catevent=='2')
					{
						$typeEvenya ='Futsal';
					}
					else
					{
						$typeEvenya ='Gathering';
					}
					$dataArray= array(
						'idevent' => $idevents,
						'userid' => $valuemember['id'],
						'email' => $valuemember['email'],
						'membename' => $valuemember['name'],
						'chapterid' => $iduser,
						'eventname'=>$placename,
						'email'=>$valuemember['username'],
						'tempat'=>$alamat,
						'tanggal'=>date('d/m/Y - g:i a',strtotime($datestart)),
						'phone' => $rschapter['no_tlp'],
						'typeevent'=>$typeEvenya
					);
					
					$link = urlencode64(serialize(array(
						'idevent'=>$idevents,
						'userid'=>$valuemember['id'],
						'chapterid'=>$iduser
					)));
					// pr();
					$this->send_addeventtomemeber($dataArray,$link);
				}**/
				
				// pr($sql);die;
				
		
		
		// die;
		
		return true;
	}
	function send_addeventtomemeber($dataArray=null,$link=null) {  
		global $LOCALE;
		if($dataArray)
		{
				$results['msg']='';
				$results['status']='';
				
				$template = $LOCALE[1]['event'];
				$template = str_replace('!#name',$dataArray['membename'],$template);
				$template = str_replace('!#typeevent',$dataArray['eventname'],$template);
				$template = str_replace('!#tempat',$dataArray['tempat'],$template);
				$template = str_replace('!#hari',$dataArray['tanggal'],$template);
				$template = str_replace('!#tlp',$dataArray['phone'],$template);
				//$template = str_replace('!#link',$this->config['BASE_DOMAIN'].'member/reservation?pram='.$link,$template);
			// pr($to);
			  $ch = curl_init();
			  curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
			  curl_setopt($ch, CURLOPT_USERPWD, 'api:key-031f6c645c2c27d331e152ba8a959e28');
			  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			  curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
			  curl_setopt($ch, CURLOPT_URL, 
						  'https://api.mailgun.net/v3/gte.supersoccer.co.id/messages');
			  curl_setopt($ch, CURLOPT_POSTFIELDS, 
							array('from' => 'Supersoccer Community Race<sscr-admin@supersoccer.co.id>',
								  'to' => $dataArray['email'],
								  'subject' => "Undangan Event ".$dataArray['eventname']."",
								  'html' => $template,
								  'o:campaign' => 'fkdf5'));
			  $result = curl_exec($ch);
			  $info = curl_getinfo($ch);
			  //pr($info);exit;
                           //pr($result);exit; 
			  $res = json_decode($result,TRUE);
			  
			  if($info['http_code']!='200')
			  {
					$results['msg']=$res['message'];
					$results['status']='0';
			  }
			   else
			   {
				   $results['msg']=$res['message'];
					$results['status']='1';
				   
			   }
			   
			  curl_close($ch);
			  return $results;
		}
		$results['status']='0';
		 return $results;
	}
	function proseseditEvent($data,$iduser){
	
		$placename = $data['placename'];
		$events = $data['events'];
		$catevent = $data['catevent'];
		$jumlahpeserta = $data['jumlahpeserta'];
		$lang = $data['lang'];
		$lat = $data['lat'];
		$alamat = $data['alamat'];
		$datestart = $data['datestart'];
		$datefinish = $data['datefinish'];
		$idevent = $data['idevent'];
		// pr($email);
		// pr($dataemail);
				
			
				$sql = "UPDATE `ss_event` SET
								`chapter_id`='{$iduser}',
								`type`='{$catevent}',
								`name`='".$placename."',
								`alamat`='{$alamat}',
								`lat`={$lat},
								`long`='".$lang."',
								`description`='{$events}',
								`target_peserta`='{$jumlahpeserta}',
								`time_start`='{$datestart}',
								`time_end`='{$datefinish}'
								WHERE  id='{$idevent}'
								";
				// pr($sql);die;
				$result= $this->apps->query($sql);
				// pr($sql);die;
				
		
		
		
		
		return true;
	}
	function goLogin($type=1){
		global $logger, $APP_PATH,$LOCALE;
		 
		$username = trim($this->apps->_p('username'));
		$password = trim($this->apps->_p('password'));
		
		$data['status']=0;
		$data['msg']='Username atau Password yang Anda masukkan salah.';
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
							$data['msg']='Username atau Password yang Anda masukkan salah.';
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
				$data['msg']='Username atau Password yang Anda masukkan salah.';
			
			
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
	function format_angka($angka){
	 //$rupiah=number_format($angka,0,',','.');
	   $rupiah=number_format($angka,0,',','.');
	 return $rupiah;
	}
	
	function akumulasichapter($id){
		//$sql = "
		//		SELECT sc.point_total as point_total,(SELECT SUM(point) as total FROM ss_activity_log  where chapter_id=sc.id ) as total
		//		FROM ss_activity_log sal 
		//			LEFT JOIN ss_chapter sc ON sal.chapter_id=sc.id 
		//		WHERE sc.id='{$id}'
		//		GROUP BY sc.id";
		
		$sql = "SELECT point_total, point FROM ss_chapter WHERE id='{$id}'";
		$rs = $this->apps->fetch($sql); 
		//pr($rs);die;
		/* $sql = "select sum(`point_fm`+`point`) as totalnya from ss_member 
						where chapter_id='{$id}'";
		$totalmember = $this->apps->fetch($sql); */
		//pr($totalmember);exit;
		$totalpointchapter['total']=$rs['point_total'];
		//$rs['data'][$key]['total']=$totalpointchapter;
		//pr($totalpointchapter);die;
		
		return $totalpointchapter;
	}
}
