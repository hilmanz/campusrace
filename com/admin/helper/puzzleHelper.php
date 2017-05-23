<?php
class puzzleHelper {
	
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

	function puzzle($start=null,$limit=10){
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
				FROM  {$CONFIG['DATABASE'][0]['DATABASE']}.ss_puzzle where n_status<>'2' {$statusquery} {$filter}"; 

		$total = $this->apps->fetch($sql);		
		
		
		
		if(intval($total['total'])<=$limit) $start = 0;
				
		$sql = "select * from {$CONFIG['DATABASE'][0]['DATABASE']}.ss_puzzle where n_status<>'2' {$statusquery} {$filter} order by id desc LIMIT {$start}, {$limit}";
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
	
	function skorpuzzle($start=null,$limit=10)
	{	
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
		
		$tglskrg=date('Y-m-d');
		
		//Count total
		$limit = intval($limit);
		$sql = "SELECT COUNT(*) total 
				FROM  {$this->config['DATABASE'][0]['DATABASE']}.ss_skor_puzzle sp 
				left join {$this->config['DATABASE'][0]['DATABASE']}.ss_member sm on sp.user_id=sm.id 
				left join {$this->config['DATABASE'][0]['DATABASE']}.ss_chapter sc on sp.chapter_id=sc.id 
				where 1 {$filter}"; 

		$total = $this->apps->fetch($sql);		
		
		
		if(intval($total['total'])<=$limit) $start = 0;
		
		$sql = "SELECT ssp.*,sp.gbr_besar,sm.name,sc.name_chapter FROM  {$this->config['DATABASE'][0]['DATABASE']}.ss_skor_puzzle ssp
				left join {$this->config['DATABASE'][0]['DATABASE']}.ss_puzzle sp on sp.id=ssp.puzzle_id
				left join {$this->config['DATABASE'][0]['DATABASE']}.ss_member sm on ssp.user_id=sm.id 
				left join {$this->config['DATABASE'][0]['DATABASE']}.ss_chapter sc on ssp.chapter_id=sc.id 
				where 1 {$filter}   order by sp.id LIMIT {$start}, {$limit}";

		$rsut = $this->apps->fetch($sql,1); 
		
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
		$rs['total'] = intval($total['total']); 
		return $rs;	
	}
	
	function activestatus($idnya){
		global $CONFIG;

		$sql="update  {$CONFIG['DATABASE'][0]['DATABASE']}.ss_puzzle set n_status=1 where id={$idnya}";
		//pr($sql);exit;
		$fetch=$this->apps->query($sql);
                
		return true;	
	}

	function deactivatestatus($idnya){
		global $CONFIG;

		$sql="update  {$CONFIG['DATABASE'][0]['DATABASE']}.ss_puzzle set n_status=0 where id<>{$idnya}";
		//pr($sql);exit;
		$fetch=$this->apps->query($sql);
                
		return true;	
	}
	
	function inactivestatus($idnya){
		global $CONFIG;

		$sql="update  {$CONFIG['DATABASE'][0]['DATABASE']}.ss_puzzle set n_status=0 where id={$idnya}";
		//pr($sql);exit;
		$fetch=$this->apps->query($sql);
                
		return true;	
	}
	
	function cancelstatus($idnya){
		global $CONFIG;

		$sql="update  {$CONFIG['DATABASE'][0]['DATABASE']}.ss_puzzle set n_status=2 where id={$idnya}";
		//pr($sql);exit;
		$fetch=$this->apps->query($sql);
		return true;	
	}
		
	function addpuzzle($data){
		global $CONFIG;
		
		$bigimg = $data['bigimg'];
		$smallimg = $data['smallimg'];
				
	//pr($data);die;
			//INSERT DATANYA
			$sql = "INSERT INTO `ss_puzzle` SET
							
							`gbr_besar`='{$bigimg}',
							`gbr_kecil`='{$smallimg}',
							`n_status`='0',							
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
	
	function editpuzzle($data){
		global $CONFIG;
		$id = $data['id'];
		$bigimg = $data['bigimg'];
		$smallimg = $data['smallimg'];

			//INSERT DATANYA			
			$sql = "update {$CONFIG['DATABASE'][0]['DATABASE']}.ss_puzzle set							
							gbr_besar='{$bigimg}',
							`gbr_kecil`='{$smallimg}',							
							created=NOW() where id='{$id}'
							";	
			
			$result= $this->apps->query($sql);
			

		if($result){
			return true;
		}else{
			return false;
		}			
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
	
	
	protected function decrypt($encrypted)
	{
		$ENC_KEY='123456';
		return rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, md5($ENC_KEY), base64_decode($encrypted), MCRYPT_MODE_CBC, md5(md5($ENC_KEY))), "\0");
	}
	
	function selectgambar($id){
		global $CONFIG;
		$sql="select * from  {$CONFIG['DATABASE'][0]['DATABASE']}.ss_puzzle where id='{$id}'";
		
		$fetch=$this->apps->fetch($sql);

		return $fetch;
	}
}
?>
