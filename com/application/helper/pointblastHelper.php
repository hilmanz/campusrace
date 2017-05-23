<?php

class pointblastHelper {
	
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
	function format_angka($angka){
	 //$rupiah=number_format($angka,0,',','.');
	   $rupiah=number_format($angka,0,',','.');
	 return $rupiah;
	}
	
	function pointblast(){
		$sql="select * from {$this->config['DATABASE'][0]['DATABASE']}.ss_member WHERE n_status=1";
		$result= $this->apps->fetch($sql,1);
		//pr($result);exit;
		foreach($result as $key => $val){
			$pointnya=$val['point']+$val['point_fm'];
			$sql2="update {$this->config['DATABASE'][0]['DATABASE']}.ss_member set point_total='{$pointnya}' where id='{$val['id']}'";
			$resultupdate= $this->apps->query($sql2,1);
		}
		
		return true;
	}
	
	function pointblastchapter(){
		//$sql="SELECT sc.*,
		//	 (SELECT SUM(point) as total FROM ss_activity_log  where chapter_id=sc.id ) as total
		//	  FROM ss_activity_log sal 
		//	  LEFT JOIN ss_chapter sc ON sal.chapter_id=sc.id where sc.id !=''";
		$sql="SELECT id,point as total, point FROM ss_chapter WHERE n_status=1"; 
		$result= $this->apps->fetch($sql,1);
		//pr($result);exit;
		foreach($result as $key => $val){
				$sql = "select sum(`point_fm`+`point`) as totalnya from ss_member 
						where chapter_id='{$val['id']}' and n_status=1";
				$totalmember = $this->apps->fetch($sql);
				//pr($totalmember);exit;
				$pointnya=$totalmember['totalnya']/1000+$val['total'];
				//pr($pointnya);exit;
				$sql2="update {$this->config['DATABASE'][0]['DATABASE']}.ss_chapter set point_total='{$pointnya}' where id='{$val['id']}'";
				$resultupdate= $this->apps->query($sql2,1);
		}
		
		return true;
	}
	
	
}
