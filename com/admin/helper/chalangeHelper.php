<?php
class chalangeHelper {
	
	var $_mainLayout="";
	var $login = false;
	
	function __construct($apps=false){
		global $logger,$CONFIG;
		$this->logger = $logger;
		$this->apps = $apps;
		$this->config = $CONFIG;
		
	}
	
	function chalange($start=null,$limit=10){
		global $CONFIG;
		$rs['result'] = false;
		$rs['total'] = 0;		
		if($start==null)$start = intval($this->apps->_request('start'));
		
		//Seaching Berdasarkan tanggal dan Nama Cabang 
		
		$filter='';
		$search=$this->apps->_request('search');
		
		
		$from=date("Y-m-d",strtotime($this->apps->_request('startdate')));
		$to=date("Y-m-d",strtotime($this->apps->_request('enddate')));
		
		if($search){
		$filter = $search=="Search..." ? "" : "AND (Name LIKE '%{$search}%')";
		}
		if($from != '1970-01-01' && $to != '1970-01-01' )
		{
		$filter .= $from ? " AND `LastUpdate` between '{$from}' AND '{$to}' " : "";
		}
		
		
		
		//Count total
		$limit = intval($limit);
		$sql = "SELECT COUNT(*) total 
				FROM  {$CONFIG['DATABASE'][0]['DATABASE']}.ss_chalangge where 1 {$filter}"; 
		//pr($sql);exit;
		$total = $this->apps->fetch($sql);		
		if(intval($total['total'])<=$limit) $start = 0;
		
		
		$sql="select * from  {$CONFIG['DATABASE'][0]['DATABASE']}.ss_chalangge where 1  {$filter} LIMIT {$start}, {$limit} ";
		//pr($sql);exit;
		$rsut=$this->apps->fetch($sql,1);
		if(!$rsut){ return false;} 
		$no = 1;
		if( $start>0)
		{
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

	
	$sql="update  {$CONFIG['DATABASE'][0]['DATABASE']}.ss_chalange set n_status=1 where id={$idnya}";
	//pr($sql);exit;
	$fetch=$this->apps->query($sql);
	return true;
	
	
	}
	
	function inactivestatus($idnya){
	global $CONFIG;

	
	$sql="update  {$CONFIG['DATABASE'][0]['DATABASE']}.ss_chalange set n_status=0 where id={$idnya}";
	//pr($sql);exit;
	$fetch=$this->apps->query($sql);
	return true;
	
	
	}
	
	function cancelstatus($idnya){
	global $CONFIG;

	
	$sql="update  {$CONFIG['DATABASE'][0]['DATABASE']}.ss_chalange set n_status=2 where id={$idnya}";
	//pr($sql);exit;
	$fetch=$this->apps->query($sql);
	return true;
	
	
	}
	
	

	function addchalange($data){
	global $CONFIG;
	
		$sql="insert into {$CONFIG['DATABASE'][0]['DATABASE']}.ss_chalange set `Name`='{$data['name']}'
		,`Abbr`='{$data['abbr']}',`chalangeCode`='{$data['chalangeCode']}',`AddressLine1`='{$data['AddressLine1']}',
		`AddressLine2`='{$data['AddressLine2']}',`District`='{$data['District']}',`SubDistrict`='{$data['SubDistrict']}',
		`City`='{$data['City']}',`Postcode`='{$data['Postcode']}',`Phone`='{$data['Phone']}',`Facs`='{$data['Facs']}',
		`Latitude`='{$data['Latitude']}',`Longitude`='{$data['Longitude']}',`Information`='{$data['Information']}',`Day`='{$data['Day']}',`TimeZone`='{$data['TimeZone']}',LastUpdate=NOW()";
	
		//pr($sql);exit;
	
		$fetch = $this->apps->query($sql);
		if($fetch)
		{
			return true;
		}else{
			return false;
		}
	}
	function editchalange($data){
	global $CONFIG;
	
	
		$sql="update {$CONFIG['DATABASE'][0]['DATABASE']}.ss_chalange set `Name`='{$data['name']}'
		,`Abbr`='{$data['abbr']}',`chalangeCode`='{$data['chalangeCode']}',`AddressLine1`='{$data['AddressLine1']}',
		`AddressLine2`='{$data['AddressLine2']}',`District`='{$data['District']}',`SubDistrict`='{$data['SubDistrict']}',
		`City`='{$data['City']}',`Postcode`='{$data['Postcode']}',`Phone`='{$data['Phone']}',`Facs`='{$data['Facs']}',
		`Latitude`='{$data['Latitude']}',`Information`='{$data['Information']}',`Day`='{$data['Day']}',`Latitude`='{$data['Latitude']}',`Longitude`='{$data['Closing']}',`TimeZone`='{$data['TimeZone']}',LastUpdate=NOW()
		where `id`='{$data['id']}'";
	
		//pr($sql);exit;
	
		$fetch = $this->apps->query($sql);
		if($fetch)
		{
			return true;
		}else{
			return false;
		}
	}
	
	
	function checkchalange(){
	global $CONFIG;
	$idnya=$this->apps->_p('idnya');
	if($idnya)
	{
	$sql="update  {$CONFIG['DATABASE'][0]['DATABASE']}.ss_chalange set n_status=1 where id={$idnya}";
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
	if($idnya)
	{
	$sql="update  {$CONFIG['DATABASE'][0]['DATABASE']}.ss_chalange set n_status=0 where id={$idnya}";

	$fetch=$this->apps->query($sql);
	return true;
	}else{
	return false;
	}
	
	}
	
		function deletechalange($inisiasi){
		global $CONFIG;
			if ($inisiasi){
				$sql="delete from {$CONFIG['DATABASE'][0]['DATABASE']}.ss_chalange where `id`='{$inisiasi}'";
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
	
	function selectchalange($inisiasi){
		global $CONFIG;
			if ($inisiasi){
				$sql="select * from {$CONFIG['DATABASE'][0]['DATABASE']}.ss_chalange where `id`='{$inisiasi}'";
				//pr($sql);exit;
				$fetch = $this->apps->fetch($sql,1);
				return $fetch;
				
			}
			
			}
	
	
	}
?>