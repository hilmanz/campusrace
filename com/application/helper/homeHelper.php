<?php

class homeHelper {
	
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
	function format_rupiah($angka){
	 //$rupiah=number_format($angka,0,',','.');
	   $rupiah=number_format($angka,0,',','.');
	 return $rupiah;
	}
	
	function chapter($page=null,$rows=10){
		if($page)
			{
				$start = $page ;
			}
		else
			{
				$start = 0;
			}
		/* $sql = "
				SELECT sc.*,
				(SELECT SUM(point) as total FROM ss_activity_log  where chapter_id=sc.id ) as total
				FROM ss_activity_log sal 
					LEFT JOIN ss_chapter sc ON sal.chapter_id=sc.id where sc.id !=''
				GROUP BY sc.id
				ORDER BY point_total desc"; */
		$sql = "SELECT *,point_total, point FROM ss_chapter WHERE n_status='1' ORDER BY point_total desc";
		
		$uDatatotal = $this->apps->fetch($sql,1);
		$rs['total']=count($uDatatotal);
		$sql .=" LIMIT ".$start.",".$rows;
		$rs['data'] = $this->apps->fetch($sql,1); 
			// pr($sql);
			foreach($rs['data'] as $key => $val){
				
				/* $sql = "select sum(`point_fm`+`point`) as totalnya from ss_member 
						where chapter_id='{$val['id']}'";
				$totalmember = $this->apps->fetch($sql); */
				//pr($totalmember);exit;
				/* $totalpointchapter=$this->format_rupiah($totalmember['totalnya']/1000+$val['total']); */
				$rs['data'][$key]['total']=$this->format_rupiah($val['point_total']);
				
				
				$sql = "
				SELECT city
				FROM {$this->config['DATABASE'][0]['DATABASE']}.cities  
				WHERE id='{$val['kota']}' LIMIT 1";
				
				$fetch = $this->apps->fetch($sql);
				//pr($fetch);exit;
				$rs['data'][$key]['citinya'] = $fetch['city'];
				//$rs['data'][$key]['total']=$this->format_rupiah($val['total']);
			}
			//pr($rs);die;
		return $rs;
	}
	
	
	
	function member($page=null,$rows=10){
		if($page)
			{
				$start = $page ;
			}
		else
			{  
				$start = 0;
			}
			//$sql = "
			//	SELECT sm.*,
			//	(SELECT SUM(point) as total FROM ss_activity_log  where user_id=sm.id ) as total,
			//	sc.name_chapter
			//	FROM ss_activity_log sal 
			//	LEFT JOIN ss_member sm ON sal.user_id=sm.id 
			//	LEFT JOIN ss_chapter sc ON sm.chapter_id=sc.id
			//	where sm.id!=''
			//	GROUP BY sm.id
			//	ORDER BY point_total desc";
			
			$sql = "SELECT sm.kampus as kampus,sm.point as point,sm.point_fm as point_fm, sm.point_total as point_total, sm.name
				FROM ss_member sm
				WHERE sm.n_status=1 
				ORDER BY sm.point_total DESC";	
			//pr($sql);exit;
			// $sql = "
			// SELECT *,
			// sc.name_chapter
			// FROM  ss_member sm 
			// LEFT JOIN ss_chapter sc ON sm.chapter_id=sc.id
			// where sm.id!=''
			// ORDER BY sm.point_total desc";
			$uDatatotal = $this->apps->fetch($sql,1);
			$rs['total']=count($uDatatotal);
			$sql .=" LIMIT ".$start.",".$rows;
			$rs['data'] = $this->apps->fetch($sql,1); 
			foreach($rs['data'] as $key => $val){
		
				$rs['data'][$key]['total']=$this->format_rupiah($val['point_total']);
				$rs['data'][$key]['point']=$val['point']+$val['point_fm'];
			}
			// pr($sql);die;
		return $rs;
	}
	
	function prosesaddMember($dataemail){
	
		$email = explode(',',$dataemail['email']);
		// pr($email);
		// pr($dataemail);
		if($email)
		{
				
			foreach($email as $row)
			{
				$emluser = trim($row);
				// $iduser
				
				$dataArray = array(
						'email'=>$emluser,						
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
								`n_status`={$nstatus}";
				// pr($sql);
				$result= $this->apps->query($sql);
				$lastid=$this->apps->getLastInsertId();
				/**$sql = "select chapter_id from `ss_member` where id='{$lastid}'";
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
				**/
				
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
			$template = $LOCALE[1]['campusrace'];
			$template = str_replace('!#name',$dataArray['email'],$template);
			//$template = str_replace('!#chaptername',$dataArray['namechapter'],$template);
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
								  'subject' => "Registrasi Member",
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
	
	function checkEmailMember($email){
		$sql = "
				SELECT *
				FROM {$this->config['DATABASE'][0]['DATABASE']}.ss_akses_login
				WHERE username='{$email['email']}' LIMIT 1";
		
			$rs = $this->apps->fetch($sql); 
			 //pr($sql);die;
		return $rs;
	}
	
	function checkTwitterMember($data){
		$sql = "
				SELECT *
				FROM {$this->config['DATABASE'][0]['DATABASE']}.ss_member
				WHERE twiiter_id='{$data['twiiter_id']}' LIMIT 1";
		
			$rs = $this->apps->fetch($sql); 
			 pr($sql);die;
		return $rs;
	}
	
}
