<?php
class voucherHelper {
	
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

	function voucher($start=null,$limit=10){
		global $CONFIG;
		
		$rs['result'] = false;
		$rs['total'] = 0;		
		if($start==null)$start = intval($this->apps->_request('start'));
		
		//Seaching Berdasarkan tanggal dan Nama Cabang 
		
		$filter='';
		$search=$this->apps->_request('search');

		$status=$this->apps->_request('status');
	
		
		
		//pr($status);exit;
		$from=date("Y-m-d",strtotime($this->apps->_request('startdate')));
		$to=date("Y-m-d",strtotime($this->apps->_request('enddate')));
		
		if($search){
			$filter = $search=="Search..." ? "" : "AND (voucer LIKE '%{$search}%' or voucer LIKE '%{$search}%')";
		}
		
		if($from != '1970-01-01' && $to != '1970-01-01' ){
			$filter .= $from ? " AND `created` between '{$from}' AND '{$to} 23:59:59' " : "";
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
		
		$order='order by id,n_status DESC';
		
		
		//Count total
		$limit = intval($limit);
		$sql = "SELECT COUNT(*) total 
				FROM  {$CONFIG['DATABASE'][0]['DATABASE']}.ss_voucer WHERE 1 {$statusquery} {$filter} "; 
		//pr($sql);exit;
		$total = $this->apps->fetch($sql);		
		//pr($sql);exit;
		if(intval($total['total'])<=$limit) $start = 0;
		
		$sql="select * from  {$CONFIG['DATABASE'][0]['DATABASE']}.ss_voucer sm where 1 {$statusquery} {$filter}  {$order} LIMIT {$start}, {$limit} ";
		//pr($sql);exit;
		$rsut=$this->apps->fetch($sql,1);
		if(!$rsut){ return false;} 
		$no = 1;
		
		if( $start>0){
			$no = $start+1;
		}
		foreach ($rsut as $key => $val){
			$rsut[$key]['no'] = $no++;
		}
		
		//pr($rsut);exit;
		$rs['status'] = true;
		$rs['result'] = $rsut;
		$rs['total'] = intval($total['total']); 
		return $rs;
	}
	
	function activestatus($idnya){
		global $CONFIG;

		$sql="update  {$CONFIG['DATABASE'][0]['DATABASE']}.ss_voucher set n_status=1 where id={$idnya}";
		//pr($sql);exit;
		$fetch=$this->apps->query($sql);
               
		return true;	
	}
	
	function inactivestatus($idnya){
		global $CONFIG;

		$sql="update  {$CONFIG['DATABASE'][0]['DATABASE']}.ss_voucer set n_status=0 where id={$idnya}";
		pr($sql);exit;
		$fetch=$this->apps->query($sql);
               
 
		return true;	
	}
	
	function listchapter(){
		global $CONFIG;

		$sql="select id,name_chapter from  {$CONFIG['DATABASE'][0]['DATABASE']}.ss_chapter where n_status=1";
		//pr($sql);exit;
		$fetch=$this->apps->fetch($sql,1);
		//pr($fetch);exit;
		return $fetch;	
	}
	
	
	function cancelstatus($idnya){
		global $CONFIG;
		
		//HAPUS YANG ADA DI SS AKSES LOGIN
                $sql="update {$CONFIG['DATABASE'][0]['DATABASE']}.ss_akses_login set n_status='2' WHERE user_id={$idnya} ";
                $fetch=$this->apps->query($sql,1);
		//$param = $data['param'];
		$sql="update  {$CONFIG['DATABASE'][0]['DATABASE']}.ss_voucher set n_status=2 where id={$idnya}";
		//pr($sql);exit;
		$fetch=$this->apps->query($sql,1);
		

		// KIRIM EMAIL NYA 
			//$sql = "SELECT * FROM ss_voucher WHERE id='{$param}'";
			$sql = "SELECT ss_voucher.username,ss_voucher.name,ss_chapter.name_chapter FROM ss_voucher, ss_chapter
					WHERE ss_voucher.chapter_id=ss_chapter.id
					and ss_voucher.id={$idnya} and ss_voucher.n_status=1";	
			//pr($sql);exit;
			$resGetvoucher = $this->apps->fetch($sql); 
			/* $dataArray = array(
				'username'=>$resGetvoucher['username'],
				'namevoucher'=>$resGetvoucher['name'],
				'namechapter'=>$resGetvoucher['name_chapter']
			); */
			//$link = urlencode64(serialize(array(
			//	'status'=>'1',
			//	'username'=>$resGetvoucher['username']
			//)));
			//pr($dataArray);exit;
			/* pr($dataArray);
			pr($link);
			exit; */
					
			/* $returnEmail = $this->send_delmemeber($dataArray);
			//pr($dataArray);die;
			if($returnEmail['status']!=1){	
				$nstatus='3';
			}
			else{
				$nstatus='0';
			} */
			
			return true;
	}
	
	function send_delmemeber($dataArray=null,$link=null) {  
		global $LOCALE;
		
		if($dataArray){
			$results['msg']='';
			$results['status']='';
			$template = $LOCALE[1]['delvoucher'];
			$template = str_replace('!#name',$dataArray['namevoucher'],$template);
			$template = str_replace('!#chaptername',$dataArray['namechapter'],$template);
			//$template = str_replace('!#link',$this->config['BASE_DOMAIN'].'voucherreg/'.$link,$template);
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
			 //pr($result);exit;
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
	
	/**function addvoucher($data){
	global $CONFIG;
	
		$nama_chapter = $data['chapter_id'];		
		$name = $data['name'];					
		$username = $data['email'];					
		$ktp_sim = $data['ktp_sim'];		
		$alamat = $data['alamat'];		
		$fb_id = $data['fb_id'];		
		$twitter_id = $data['twitter_id'];		
		$date_register = $data['date_register'];				
		
		$sql = "INSERT INTO `ss_voucher` SET
								`chapter_id`='{$nama_chapter}',
								`name`='{$name}',
								`username`='{$username}',
								`ktp_sim`='{$ktp_sim}',
								`alamat`='{$alamat}',
								`fb_id`='{$fb_id}',
								`twiiter_id`='{$twitter_id}',
								`date_register`='{$date_register}',
								`n_status`=0
								";
	
		/**$sql="insert into {$CONFIG['DATABASE'][0]['DATABASE']}.ss_voucher set `Name`='{$data['name']}'
		,`Abbr`='{$data['abbr']}',`voucherCode`='{$data['voucherCode']}',`AddressLine1`='{$data['AddressLine1']}',
		`AddressLine2`='{$data['AddressLine2']}',`District`='{$data['District']}',`SubDistrict`='{$data['SubDistrict']}',
		`City`='{$data['City']}',`Postcode`='{$data['Postcode']}',`Phone`='{$data['Phone']}',`Facs`='{$data['Facs']}',
		`Latitude`='{$data['Latitude']}',`Longitude`='{$data['Longitude']}',`Information`='{$data['Information']}',`Day`='{$data['Day']}',`TimeZone`='{$data['TimeZone']}',LastUpdate=NOW()";
		**/
		//pr($sql);exit;
				
		/**$fetch= $this->apps->query($sql);
				//pr($sql);exit;
				if($fetch)
				{
					return true;
				}else{
					return false;
				}	
		//pr($fetch);exit;
		return true;
		
	}**/
	function statusemail($email){
		
		$output = shell_exec('curl -s --user \'api:key-031f6c645c2c27d331e152ba8a959e28\' -G -d "recipient='.$email.'&limit=1" https://api.mailgun.net/v3/gte.supersoccer.co.id/campaigns/fkdf5/events');
		//pr($output);exit;
		$hasdecode=json_decode($output);
		$result=array();
		foreach($hasdecode as $key => $val ){
			$result['verifikasi']=$val->event;
			
		}
		if($result)
		{
			return $result['verifikasi'];
		}else{
			
			return "pending";
		}
	

	}
	
	function uploadvoucer($data){
		$voucer=$data;
		$sql = "INSERT INTO `ss_voucer` SET
							`voucer`='{$voucer}',							
							`n_status`=0
							";
		$result= $this->apps->query($sql);
		if($result)
		{
			return true;	
		}else{
			return "pending";
		}
	}
	
	
	
	function addvoucher($data){
		global $CONFIG;
	
		$email = $data['email'];
		$chapter_id = $data['chapter_id'];		
		$name = $data['name'];					
		//$username = $data['username'];					
		$ktp_sim = $data['ktp_sim'];		
		$alamat = $data['alamat'];		
		$fb_id = $data['fb_id'];		
		$twitter_id = $data['twitter_id'];		
		$date_register = $data['date_register'];	
		$no_tlp = $data['no_tlp'];

		$sqlGetVoucer = "SELECT id FROM ss_voucer WHERE n_status='0' order by rand() limit 1";
		$resGetVoucer = $this->apps->fetch($sqlGetVoucer);
		$voucer = $resGetVoucer['id'];
		//pr($voucer);exit;
		
		 //pr($email);exit;
		//pr($data);exit;
		if($email){				
			$emluser = trim($email);
			//INSERT DATANYA
			$sql = "INSERT INTO `ss_voucher` SET
							`voucer_id`='{$voucer}',
							`chapter_id`='{$chapter_id}',
							`name`='{$name}',
							`username`='".trim($emluser)."',
							`no_tlp`='{$no_tlp}',
							`ktp_sim`='{$ktp_sim}',
							`alamat`='{$alamat}',
							`fb_id`='{$fb_id}',
							`twiiter_id`='{$twitter_id}',
							`date_register`=NOW(),
							`n_status`=0
							";
			//pr($sql);exit;
			
			$result= $this->apps->query($sql);
			
			$q = "update ss_voucer SET `n_status`='1' where id='{$voucer}'";
			$r = $this->apps->query($q);
			
			$lastid=$this->apps->getLastInsertId();
			
			$sqlx = "INSERT INTO `ss_akses_login` SET
							`user_id`='{$lastid}',
							`username`='".trim($emluser)."',
							`role`='2',
							`date`=NOW(),
							`n_status`=0
							";
			//pr($sql);exit;
			
			$resultx= $this->apps->query($sqlx);
	
			
			
			$sql = "select chapter_id from `ss_voucher` where id='{$lastid}'";
			$result = $this->apps->fetch($sql,1);
		
			// KIRIM EMAIL NYA 
			$sqlGetChapter = "SELECT name_chapter as name FROM ss_chapter WHERE id='{$result[0]['chapter_id']}'";
			//pr($sqlGetChapter);exit;
			$resGetChapter = $this->apps->fetch($sqlGetChapter); 
			//pr($resGetChapter);exit;
			$namachapternyah=str_replace(' ','_',$resGetChapter['name']);
			//$ssgte_id=$namachapternyah.$lastid;
			$ssgte_id=$namachapternyah.'-'.$lastid;
			//pr($ssgte_id);exit;
			
			$sqlx = "update ss_voucher SET
							`ssgte_id`='{$ssgte_id}' where id='{$lastid}'
							";
			$result = $this->apps->query($sqlx);
			
			$dataArray = array(
				'email'=>$emluser,
				'name'=>$name,
				'namechapter'=>$resGetChapter['name']
			);
			$link = urlencode64(serialize(array(
				'status'=>'1',
				'email'=>$emluser
			)));
			/* pr($dataArray);
			pr($link);
			exit; */
					
			$returnEmail = $this->send_addmemeber($dataArray,$link);
			//pr($returnEmail);die;
			if($returnEmail['status']!=1){	
				$nstatus='3';
			}
			else{
				$nstatus='0';
			}
			
			
		}		
		// die;		
		return true;		
	}
	
	function send_addmemeber($dataArray=null,$link=null) {  
		global $LOCALE;
		
		if($dataArray){
			$results['msg']='';
			$results['status']='';
			$template = $LOCALE[1]['addvoucher'];
			$template = str_replace('!#name',$dataArray['name'],$template);
			$template = str_replace('!#chaptername',$dataArray['namechapter'],$template);
			$template = str_replace('!#link','http://www.supersoccer.co.id/sscrregion1/voucherreg/reactivate/'.$link,$template);
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
								  'subject' => "Registrasi voucher ".$dataArray['namechapter']."",
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
	
	function editvoucher($data){
		global $CONFIG;
		$password=$this->encrypt($data['password']);
		 $sql="update {$CONFIG['DATABASE'][0]['DATABASE']}.ss_voucher set 		
			`name`='{$data['name']}',
			`username`='{$data['email']}',
			`password`='{$password}',
			`ktp_sim`='{$data['idktp']}',
			`no_tlp`='{$data['no_tlp']}',
			`fb_id`='{$data['facebook']}',
			`twiiter_id`='{$data['twitter']}'		
			where `id`='{$data['idnya']}'";
	 
		//pr($sql);exit;
	
		$fetch = $this->apps->query($sql);
		
		$sql1="update {$CONFIG['DATABASE'][0]['DATABASE']}.ss_akses_login set `password`='{$password}' where user_id='{$data['idnya']}'";
		$fetch1 = $this->apps->query($sql1);
		//pr($fetch1);die;
		if($fetch1){
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
	
	function checkvoucher(){
		global $CONFIG;
		
		$idnya=$this->apps->_p('idnya');
		if($idnya){
			$sql="update  {$CONFIG['DATABASE'][0]['DATABASE']}.ss_voucher set n_status=1 where id={$idnya}";
			$fetch=$this->apps->query($sql);
			return true;
		}else{
			return false;
		}
	}
	
	function checkinactives(){
		global $CONFIG;
		
		$idnya=intval($_POST['idnya']);
		//	pr($idnya);exit;
		if($idnya){
			$sql="update  {$CONFIG['DATABASE'][0]['DATABASE']}.ss_voucher set n_status=0 where id={$idnya}";
			$fetch=$this->apps->query($sql);
			return true;
		}else{
			return false;
		}
	}
	
	function deletevoucher($inisiasi){
		global $CONFIG;
		
		if ($inisiasi){
			$sql="delete from {$CONFIG['DATABASE'][0]['DATABASE']}.ss_voucher where `id`='{$inisiasi}'";
			//pr($sql);exit;
			$fetch = $this->apps->query($sql);
			if($fetch)
			{
				return true;
			}else{
				return false;
			}
		}
	}
	
	function selectvoucher($inisiasi){
		global $CONFIG;
		if ($inisiasi){
			$sql="select *,DATE_FORMAT(sm.date_register,'%d-%m-%Y %H:%i') AS date_register from {$CONFIG['DATABASE'][0]['DATABASE']}.ss_voucher sm where `id`='{$inisiasi}'";
			//pr($sql);exit;
			$fetch = $this->apps->fetch($sql,1);
			
			foreach ($fetch as $key => $val){
			//	$sql = "SELECT name_chapter
			//		FROM  {$CONFIG['DATABASE'][0]['DATABASE']}.ss_chapter where 1 and id='{$val['chapter_id']}'"; 
			//	//pr($sql);exit;
			//	$chapter = $this->apps->fetch($sql);
			//	
			//	$fetch[$key]['name_chapter'] = $chapter['name_chapter'];
				$fetch[$key]['password'] =$this->decrypt($val['password']);
			}
			// pr($fetch);die;
			return $fetch;
		}		
	}
			
	function checkEmail($email){
		$sql = "
				SELECT *
				FROM {$this->config['DATABASE'][0]['DATABASE']}.ss_voucher 
				WHERE username='{$email['email']}' LIMIT 1";
		
		$rs = $this->apps->fetch($sql); 
			// pr($sql);die;
		return $rs;
	}
	
	function downloadListvoucher(){
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
		
		
		$sql="select *,n_status as status,DATE_FORMAT(sm.date_register,'%d-%m-%Y %H:%i') AS date_register from  {$CONFIG['DATABASE'][0]['DATABASE']}.ss_voucher sm where 1 AND n_status !=2 {$statusquery} {$filter}  {$order} ";
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
	
	function selectchap(){
		$sql = "
				SELECT *
				FROM {$this->config['DATABASE'][0]['DATABASE']}.ss_chapter";
		
		$rs = $this->apps->fetch($sql,1); 
			// pr($sql);die;
		return $rs;
	}
	
	protected function decrypt($encrypted)
	{
		$ENC_KEY='123456';
		return rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, md5($ENC_KEY), base64_decode($encrypted), MCRYPT_MODE_CBC, md5(md5($ENC_KEY))), "\0");
	}
}
?>
