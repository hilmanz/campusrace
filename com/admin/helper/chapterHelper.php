<?php
class chapterHelper {
	
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
	function chapter($start=null,$limit=10){
		global $CONFIG;
		
		$rs['result'] = false;
		$rs['total'] = 0;
		
		if($start==null)$start = intval($this->apps->_request('start'));
		
		//Seaching Berdasarkan tanggal dan Nama Cabang 
		
		$filter='';
		$search=$this->apps->_request('search');
		$clubs=$this->apps->_request('clubs');
		$kota=$this->apps->_request('kota');
		$points=$this->apps->_request('points');
		$from=date("Y-m-d",strtotime($this->apps->_request('startdate')));
		$to=date("Y-m-d",strtotime($this->apps->_request('enddate')));
		
		if($search){
			$filter = $search=="Search..." ? "" : "AND (name_chapter LIKE '%{$search}%' or email LIKE '%{$search}%')";
		}
		
		if($from != '1970-01-01' && $to != '1970-01-01' ){
			$filter .= $from ? " AND `date_register` between '{$from}' AND '{$to} 23:59:59'" : "";
		}
		
		$filter .= $clubs ? " AND `club_favorit`='{$clubs}'":"";
		$filter .= $kota ? " AND `kota`='{$kota}'":"";
		$order='';
		
		if($points==1){
			$order=' order by point_total desc';
		}elseif($points==2){
			$order=' order by point_total asc';
		}else{
			$order=' order by date_register desc';
		}
		//Count total
		$limit = intval($limit);
		$sql = "SELECT COUNT(*) total 
				FROM  {$CONFIG['DATABASE'][0]['DATABASE']}.ss_chapter where 1 and n_status!=2 {$filter} {$order}"; 
		//pr($sql);exit;
		$total = $this->apps->fetch($sql);
		
		if(intval($total['total'])<=$limit) $start = 0;
		
		$sql="select *,DATE_FORMAT(sc.date_register,'%d-%m-%Y %H:%i') AS date_register from  {$CONFIG['DATABASE'][0]['DATABASE']}.ss_chapter sc where 1 and n_status!=2 {$filter} {$order} LIMIT {$start} , {$limit}";
		//pr($sql);exit;
		$rsut=$this->apps->fetch($sql,1);
		//pr($rsut);exit;
		
		if(!$rsut){ return false;} 
		$no = 1;
		
		if( $start>0){
			$no = $start+1;
		}
		
		foreach ($rsut as $key => $val){
			//Untuk Nomor
			$rsut[$key]['no'] = $no++;
			
			// $sql = "
				// SELECT (SELECT SUM(point) as total FROM ss_activity_log  where chapter_id=sc.id ) as total
				// FROM ss_activity_log sal 
					// LEFT JOIN ss_chapter sc ON sal.chapter_id=sc.id 
				// WHERE sc.id='{$val['id']}'
				// GROUP BY sc.id";
				// $rs = $this->apps->fetch($sql); 
				
				// Sum total Point member
				// $sql = "select sum(`point_fm`+`point`) as totalnya from ss_member 
								// where chapter_id='{$val['id']}'";
				// $totalmember = $this->apps->fetch($sql);
				
				// Itung2 ngan total point chapter
				// $totalpointchapter['total']=$this->format_angka($totalmember['totalnya']/1000+$rs['total']);
			
			//Untuk Point Chapter
			$rsut[$key]['point'] = $this->format_angka($val['point_total']);
			
			
			$sql = "SELECT name_club
				FROM  {$CONFIG['DATABASE'][0]['DATABASE']}.ss_club where 1 and id='{$val['club_favorit']}'"; 
				//pr($sql);exit;
				$chapter = $this->apps->fetch($sql);
				$rsut[$key]['name_club'] = $chapter['name_club'];
				$sql="select count(*) as total_active  from {$CONFIG['DATABASE'][0]['DATABASE']}.ss_member where chapter_id={$val['id']} and n_status=1";
				//pr($sql);exit;
				$totalmember1=$this->apps->fetch($sql);
                                $sql="select count(*) as total_inactive  from {$CONFIG['DATABASE'][0]['DATABASE']}.ss_member where chapter_id={$val['id']} and n_status=0";
                                //pr($sql);exit;
                                $totalmember2=$this->apps->fetch($sql);
                                $sql="select count(*) as total_delete  from {$CONFIG['DATABASE'][0]['DATABASE']}.ss_member where chapter_id={$val['id']} and n_status=2";
                                //pr($sql);exit;
                                $totalmember3=$this->apps->fetch($sql);
				
			//Untuk Total member	
			$rsut[$key]['total_member_active'] = $totalmember1['total_active'];
			$rsut[$key]['total_member_inactive'] = $totalmember2['total_inactive'];
			$rsut[$key]['total_member_delete'] = $totalmember3['total_delete'];
			//Untuk Format date
			$rsut[$key]['date_register'] = date('d-m-Y', strtotime ($val['date_register']));
		}		
		
		//pr($rsut);exit;
		$rs['status'] = true;
		$rs['result'] = $rsut;
		$rs['total'] = intval($total['total']); 
		return $rs;
	}
	
	function activestatus($idnya){
		global $CONFIG;
		
		$sql="update  {$CONFIG['DATABASE'][0]['DATABASE']}.ss_chapter set n_status=1 where id={$idnya}";
		//pr($sql);exit;
		$fetch=$this->apps->query($sql);
                $sql="update  {$CONFIG['DATABASE'][0]['DATABASE']}.ss_akses_login set n_status=1 where user_id={$idnya}";
                //pr($sql);exit;
                $fetch=$this->apps->query($sql);

		return true;
	}
	
	function totalmember(){
		global $CONFIG;
		
		$sql="select count(*) as total  {$CONFIG['DATABASE'][0]['DATABASE']}.ss_member where chapter_id={$this->apps->user->id} and n_status=1";
		//pr($sql);exit;
		$fetch=$this->apps->query($sql);
		return true;	
	}
	
	function listclub(){
		global $CONFIG;

		$sql="select * from {$CONFIG['DATABASE'][0]['DATABASE']}.ss_club";
		//pr($sql);exit;
		$fetch=$this->apps->fetch($sql,1);
		//pr($fetch);exit;
		return $fetch;
	}
	
	function listcity(){
		global $CONFIG;

		$sql="select * from {$CONFIG['DATABASE'][0]['DATABASE']}.cities ORDER BY city ASC";
		//pr($sql);exit;
		$fetch=$this->apps->fetch($sql,1);
		//pr($fetch);exit;
		return $fetch;
	}	
	
	function inactivestatus($idnya){
		global $CONFIG;

		$sql="update  {$CONFIG['DATABASE'][0]['DATABASE']}.ss_chapter set n_status=0 where id={$idnya}";
		//pr($sql);exit;
		$fetch=$this->apps->query($sql);
                $sql="update  {$CONFIG['DATABASE'][0]['DATABASE']}.ss_akses_login set n_status=0 where user_id={$idnya}";
                //pr($sql);exit;
                $fetch=$this->apps->query($sql);
 
		return true;
	}
	
	function cancelstatus($idnya){
		global $CONFIG;

		$sql="update  {$CONFIG['DATABASE'][0]['DATABASE']}.ss_chapter set n_status=2 where id={$idnya}";
		//pr($sql);exit;
		$fetch=$this->apps->query($sql);
                $sql="update  {$CONFIG['DATABASE'][0]['DATABASE']}.ss_akses_login set n_status=2 where user_id={$idnya}";
                //pr($sql);exit;
                $fetch=$this->apps->query($sql);
 
		return true;
	}
	
	function addchapter($data){
		global $CONFIG;
	
		$sql="insert into {$CONFIG['DATABASE'][0]['DATABASE']}.ss_chapter set `Name`='{$data['name']}'
		,`Abbr`='{$data['abbr']}',`chapterCode`='{$data['chapterCode']}',`AddressLine1`='{$data['AddressLine1']}',
		`AddressLine2`='{$data['AddressLine2']}',`District`='{$data['District']}',`SubDistrict`='{$data['SubDistrict']}',
		`City`='{$data['City']}',`Postcode`='{$data['Postcode']}',`Phone`='{$data['Phone']}',`Facs`='{$data['Facs']}',
		`Latitude`='{$data['Latitude']}',`Longitude`='{$data['Longitude']}',`Information`='{$data['Information']}',`Day`='{$data['Day']}',`TimeZone`='{$data['TimeZone']}',LastUpdate=NOW()";
	
		//pr($sql);exit;
	
		$fetch = $this->apps->query($sql);
		if($fetch){
			return true;
		}else{
			return false;
		}
	}
	
	function editchapter($data){
		global $CONFIG;
		$password=$this->encrypt($data['password']);
		$sql="update {$CONFIG['DATABASE'][0]['DATABASE']}.ss_chapter set
			`name_chapter`='{$data['name']}',
			`alamat`='{$data['alamat']}',
			`club_favorit`='{$data['club_fav']}',
			`kota`='{$data['kota_chapter']}',
			`email`='{$data['email']}',
			`password`='{$password}',
			`no_tlp`='{$data['telp']}',
			`facebook`='{$data['facebook']}',
			`twitter`='{$data['twitter']}',
			`name`='{$data['headchapter']}'
			where `id`='{$data['chapter_id']}'";
	
		//pr($sql);exit;
	
		$fetch = $this->apps->query($sql);
		
		$sql="update {$CONFIG['DATABASE'][0]['DATABASE']}.ss_akses_login set
			`password`='{$password}'
			where user_id='{$data['chapter_id']}'";
		$fetch = $this->apps->query($sql);
	
		
		if($fetch){
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
		
	function checkchapter(){
		global $CONFIG;
		
		$idnya=$this->apps->_p('idnya');
		if($idnya){
			$sql="update  {$CONFIG['DATABASE'][0]['DATABASE']}.ss_chapter set n_status=1 where id={$idnya}";
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
			$sql="update  {$CONFIG['DATABASE'][0]['DATABASE']}.ss_chapter set n_status=0 where id={$idnya}";

			$fetch=$this->apps->query($sql);
			return true;
		}else{
			return false;
		}	
	}
	
	function deletechapter($inisiasi){
		global $CONFIG;
		
		if ($inisiasi){
			$sql="delete from {$CONFIG['DATABASE'][0]['DATABASE']}.ss_chapter where `id`='{$inisiasi}'";
			//pr($sql);exit;
			$fetch = $this->apps->query($sql);
			
			if($fetch){
				return true;
			}else{
				return false;
			}
		}
	}
	
	function selectchapter($inisiasi){
		global $CONFIG;
		
		if ($inisiasi){
			$sql="select *, ss_chapter.id as idc, DATE_FORMAT(ss_chapter.date_register,'%d-%m-%Y %H:%i') AS date_register from {$CONFIG['DATABASE'][0]['DATABASE']}.ss_chapter, ss_akses_login where ss_chapter.id=ss_akses_login.user_id and ss_chapter.id='{$inisiasi}'";
			//pr($sql);exit;
			$fetch = $this->apps->fetch($sql,1);
			//pr($fetch);exit;
			foreach ($fetch as $key => $val){
				
				//pr($sql);exit;
				$fetch[$key]['password'] =$this->decrypt($val['password']);
			}
			
			return $fetch;
		}			
	}
			
	function selectclub(){
		global $CONFIG;
			
		$sql="select * from {$CONFIG['DATABASE'][0]['DATABASE']}.ss_club";
		//pr($sql);exit;
		$fetch = $this->apps->fetch($sql,1);
		return $fetch;
	}	
	
	function selectcity(){
		global $CONFIG;
	
		$sql="select * from {$CONFIG['DATABASE'][0]['DATABASE']}.cities order by city asc";
		//pr($sql);exit;
		$fetch = $this->apps->fetch($sql,1);
		return $fetch;
	}
	
	function decrypt($encrypted)
	{
		$ENC_KEY='123456';
		return rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, md5($ENC_KEY), base64_decode($encrypted), MCRYPT_MODE_CBC, md5(md5($ENC_KEY))), "\0");
	}
}
?>
