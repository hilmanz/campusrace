<?php
class jadwalHelper {
	
	var $_mainLayout="";
	var $login = false;
	
	function __construct($apps=false){
		global $logger,$CONFIG;
		$this->logger = $logger;
		$this->apps = $apps;
		$this->config = $CONFIG;		
	}
	
	function format_angka($angka){
		//$rupiah=number_format($angka,0,',','.');
		$rupiah=number_format($angka,0,',','.');
		return $rupiah;
	}

	function jadwal($start=null,$limit=10){
		global $CONFIG;
		
		$rs['result'] = false;
		$rs['total'] = 0;		
		if($start==null)$start = intval($this->apps->_request('start'));
		
		//Seaching Berdasarkan tanggal dan Nama Cabang 
		
		$filter='';
		$search=$this->apps->_request('search');
		$points=$this->apps->_request('points');
		$status=$this->apps->_request('status');
		$chapternya=$this->apps->_request('chapternya');
		
		//pr($status);exit;
		$from=date("Y-m-d",strtotime($this->apps->_request('startdate')));
		$to=date("Y-m-d",strtotime($this->apps->_request('enddate')));
		
		if($search){
			$filter = $search=="Search..." ? "" : "AND (name LIKE '%{$search}%' or username LIKE '%{$search}%')";
		}
		
		if($from != '1970-01-01' && $to != '1970-01-01' ){
			$filter .= $from ? " AND `date_register` between '{$from}' AND '{$to} 23:59:59' " : "";
		}
		
		if($chapternya){
				$filter .= $chapternya ? " AND `chapter_id`={$chapternya}": "";
		}
		$statusquery="";
		
		if($status==1){
			$statusquery= " AND `n_status`='{$status}'";
		}else if($status==2){
			$statusquery= " AND `n_status`=0";
                }else if($status==3){
                        $statusquery= " AND `n_status`=2";
		}else if($status==4){
                        $statusquery= " AND `n_status`=3";
                }
		
		$order='';
		if($points==1){
			$order=' order by point_total DESC';
		}elseif($points==2){
			$order=' order by point_total ASC';
		}else{
			$order=' order by sm.date_register DESC';
		}
		
		
		//Count total
		$limit = intval($limit);
		$sql = "SELECT COUNT(*) total 
				FROM  {$CONFIG['DATABASE'][0]['DATABASE']}.ss_pertandingan_tebakskor where 1 {$statusquery} {$filter}"; 

		$total = $this->apps->fetch($sql);		
		
		
		
		if(intval($total['total'])<=$limit) $start = 0;
				
		$sql = "select * from {$CONFIG['DATABASE'][0]['DATABASE']}.ss_pertandingan_tebakskor order by id desc LIMIT {$start}, {$limit}";
		//pr($sql);die;
		$rsut=$this->apps->fetch($sql,1);
		if(!$rsut){ return false;} 
		$no = 1;
		
		if( $start>0){
			$no = $start+1;
		}
		
		foreach ($rsut as $key => $val){
			$rsut[$key]['no'] = $no++;
	
		}		
		
		$rs['status'] = true;
		$rs['result'] = $rsut;
		//pr($rsut);die;
		$rs['total'] = intval($total['total']); 
		return $rs;
	}
	
	function activestatus($idnya){
		global $CONFIG;

		$sql="update  {$CONFIG['DATABASE'][0]['DATABASE']}.ss_pertandingan_tebakskor set n_status=1 where id={$idnya}";
		//pr($sql);exit;
		$fetch=$this->apps->query($sql);
                
		return true;	
	}

	function deactivatestatus($idnya){
		global $CONFIG;

		$sql="update  {$CONFIG['DATABASE'][0]['DATABASE']}.ss_pertandingan_tebakskor set n_status=0 where id<>{$idnya}";
		//pr($sql);exit;
		$fetch=$this->apps->query($sql);
                
		return true;	
	}
	
	function inactivestatus($idnya){
		global $CONFIG;

		$sql="update  {$CONFIG['DATABASE'][0]['DATABASE']}.ss_pertandingan_tebakskor set n_status=0 where id={$idnya}";
		//pr($sql);exit;
		$fetch=$this->apps->query($sql);
                
		return true;	
	}
	
	function listchapter(){
		global $CONFIG;

		$sql="select id,name_chapter from  {$CONFIG['DATABASE'][0]['DATABASE']}.ss_chapter where n_status=1 ORDER BY name_chapter ASC";
		//pr($sql);exit;
		$fetch=$this->apps->fetch($sql,1);
		//pr($fetch);exit;
		return $fetch;	
	}
	
	function selectweekid($idnya){
		global $CONFIG;

		$sql="select *from  {$CONFIG['DATABASE'][0]['DATABASE']}.ss_pertandingan_tebakskor where week_id={$idnya}";
		
		$fetch=$this->apps->fetch($sql,1);
		return $fetch;	
	}
	
	
	function cancelstatus($idnya){
		global $CONFIG;
		
		//HAPUS YANG ADA DI SS AKSES LOGIN
                $sql="update {$CONFIG['DATABASE'][0]['DATABASE']}.ss_akses_login set n_status='2' WHERE user_id={$idnya} ";
                $fetch=$this->apps->query($sql,1);
		//$param = $data['param'];
		$sql="update  {$CONFIG['DATABASE'][0]['DATABASE']}.ss_member set n_status=2 where id={$idnya}";
		//pr($sql);exit;
		$fetch=$this->apps->query($sql,1);
		

		// KIRIM EMAIL NYA 
			//$sql = "SELECT * FROM ss_member WHERE id='{$param}'";
			$sql = "SELECT ss_member.username,ss_member.name,ss_chapter.name_chapter FROM ss_member, ss_chapter
					WHERE ss_member.chapter_id=ss_chapter.id
					and ss_member.id={$idnya} and ss_member.n_status=1";	
			//pr($sql);exit;
			$resGetMember = $this->apps->fetch($sql); 
			$dataArray = array(
				'username'=>$resGetMember['username'],
				'namemember'=>$resGetMember['name'],
				'namechapter'=>$resGetMember['name_chapter']
			);
			//$link = urlencode64(serialize(array(
			//	'status'=>'1',
			//	'username'=>$resGetMember['username']
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
	
	function addjadwal($data){
		global $CONFIG;
		$weekid = $data['weekid'];
		$club1 = $data['club1'];
		$club2 = $data['club2'];
		$club3 = $data['club3'];
		$club4 = $data['club4'];
		$club5 = $data['club5'];
		$club6 = $data['club6'];
		$last_submit_time = $data['last_submit_time'];

			//INSERT DATANYA
			$sql = "INSERT INTO `ss_pertandingan_tebakskor` SET
							week_id='{$weekid}',
							`club1`='{$club1}',
							`club2`='{$club2}',
							`club3`='{$club3}',
							`club4`='{$club4}',
							`club5`='{$club5}',
							`club6`='{$club6}',
							last_submit_time ='{$last_submit_time}',
							created=NOW()
							";			
			$result= $this->apps->query($sql);
					

		if($result){
			return true;
		}else{
			return false;
		}		
	}
	
	function send_addmemeber($dataArray=null,$link=null) {  
		global $LOCALE;
		
		if($dataArray){
			$results['msg']='';
			$results['status']='';
			$template = $LOCALE[1]['addmember'];
			$template = str_replace('!#name',$dataArray['name'],$template);
			$template = str_replace('!#chaptername',$dataArray['namechapter'],$template);
			//$template = str_replace('!#link','http://www.supersoccer.co.id/sscrregion1/memberreg/reactivate/'.$link,$template);
			$template = str_replace('!#link',$this->config['BASE_DOMAIN'].'memberreg/reactivate/'.$link,$template);
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
	
	function editjadwal($data){
		global $CONFIG;
		$id= $data['id'];
		$weekid= $data['weekid'];
		$club1 = $data['club1'];
		$club2 = $data['club2'];
		$club3 = $data['club3'];
		$club4 = $data['club4'];
		$club5 = $data['club5'];
		$club6 = $data['club6'];
		$last_submit_time = $data['last_submit_time'];
		
		 $sql="update {$CONFIG['DATABASE'][0]['DATABASE']}.ss_pertandingan_tebakskor set 
			`week_id`='{$weekid}',
			`club1`='{$club1}',
			`club2`='{$club2}',
			`club3`='{$club3}',
			`club4`='{$club4}',
			`club5`='{$club5}',
			`club6`='{$club6}',
			last_submit_time='{$last_submit_time}',
			`created`=NOW()
			where `id`='{$id}'";
		$fetch = $this->apps->query($sql);
				
		return true;
	}
	
	protected function encrypt($string)
	{	
		$ENC_KEY='123456';
		return base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5($ENC_KEY), $string, MCRYPT_MODE_CBC, md5(md5($ENC_KEY))));
	}

	function checkEmail($email){
		$sql = "
				SELECT *
				FROM {$this->config['DATABASE'][0]['DATABASE']}.ss_member 
				WHERE username='{$email['email']}' LIMIT 1";
		
		$rs = $this->apps->fetch($sql); 
			// pr($sql);die;
		return $rs;
	}
	
	function downloadListmember(){
		global $CONFIG;
		
		
		$filter='';
		$search=$this->apps->_request('search');
		$points=$this->apps->_request('points');
		$status=$this->apps->_g('status');
		$chapternya=$this->apps->_request('chapternya');
		
		//pr($status);exit;
		$from=date("Y-m-d",strtotime($this->apps->_request('startdate')));
		$to=date("Y-m-d",strtotime($this->apps->_request('enddate')));
		
		if($search){
			$filter = $search=="Search..." ? "" : "AND (Name LIKE '%{$search}%')";
		}
		
		if($from != '1970-01-01' && $to != '1970-01-01' ){
			$filter .= $from ? " AND `date_register` between '{$from}' AND '{$to} 23:59:59' " : "";
		}
		
		if($chapternya){
				$filter .= $chapternya ? " AND `chapter_id`={$chapternya}": "";
		}
		$statusquery="";
		
		if($status==1){
			$statusquery= " AND `n_status`='{$status}'";
		}else if($status==2){
			$statusquery= " AND `n_status`=0";
		}
		
		$order='';
		if($points==1){
			$order=' order by point DESC';
		}elseif($points==2){
			$order=' order by point ASC';
		}else{
			$order=' order by sm.date_register DESC';
		}
		
		
		$sql="select *,n_status as status,DATE_FORMAT(sm.date_register,'%d-%m-%Y %H:%i') AS date_register from  {$CONFIG['DATABASE'][0]['DATABASE']}.ss_member sm where 1 AND n_status !=2 {$statusquery} {$filter}  {$order} ";
		//pr($sql);exit;
		$fetch=$this->apps->fetch($sql,1);
		foreach($fetch as $key =>$val){
			
			if($val['n_status']==1)
			{
				$fetch[$key]['statusnya']='Active';
			}
			if($val['n_status']==0)
			{
				$fetch[$key]['statusnya']='Inactive';
			}
			if($val['n_status']==3)
			{
				$fetch[$key]['statusnya']='Gagal';
			}
			
			
			$sql="select * from  {$CONFIG['DATABASE'][0]['DATABASE']}.ss_chapter where id='{$val['chapter_id']}'";
			$fetchchapter=$this->apps->fetch($sql);
			$fetch[$key]['namachapter']=$fetchchapter['name_chapter'];
		}
		
		//pr($fetch);exit;
		return $fetch;
	}
	
	function selectclub(){
		$sql = "
				SELECT *
				FROM {$this->config['DATABASE'][0]['DATABASE']}.ss_club";
		
		$rs = $this->apps->fetch($sql,1); 
			// pr($sql);die;
		return $rs;
	}
	
	function selectpertandingan(){
		$id=$this->apps->_g('id');
		$sql = "
				SELECT *
				FROM {$this->config['DATABASE'][0]['DATABASE']}.ss_pertandingan_tebakskor where id='$id'";
		
		$rs = $this->apps->fetch($sql,1); 

		return $rs;
	}
	
	protected function decrypt($encrypted)
	{
		$ENC_KEY='123456';
		return rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, md5($ENC_KEY), base64_decode($encrypted), MCRYPT_MODE_CBC, md5(md5($ENC_KEY))), "\0");
	}
}
?>
