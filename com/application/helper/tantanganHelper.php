<?php

class tantanganHelper {
	
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
	function prosesadTantangan($data,$iduser){
	
		$name = $data['name'];
		$keterangan = $data['keterangan'];
		$kat = $data['kat'];
		$subcat = $data['subcat'];
		
		$jmlhpoint = $data['jmlhpoint'];
		$jmlcoint = $data['jmlcoint'];
		$mediasocial = $data['mediasocial'];
		$datestart = $data['datestart'];
		$datefinish = $data['datefinish'];
		
				$sql = "INSERT INTO `ss_chalangge` SET
								`chapter_id`='{$iduser}',
								`name`='{$name}',
								`description`='".$keterangan."',
								`start_time`='{$datestart}',
								`end_time`='{$datefinish}',
								`category`='".$kat."',
								`subcategory`='{$subcat}',
								`hastags`='{$mediasocial}',
								`point`='{$jmlhpoint}',
								`coin`='{$jmlcoint}',
								`create_challange`=NOW(),
								`n_status`=0
								";
				// pr($sql);die;
				$result= $this->apps->query($sql);
				
		return true;
	}
	function getTantangan($id,$idchapter){
		$sql = "
				SELECT *,DATE_FORMAT(start_time,'%d/%m/%Y') as date_start,DATE_FORMAT(start_time,'%h:%h:%p') as waktu_start,DATE_FORMAT(end_time,'%d/%m/%Y') as date_end,DATE_FORMAT(start_time,'%d/%m/%Y') as time_start,DATE_FORMAT(end_time,'%d/%m/%Y') as time_end,DATE_FORMAT(end_time,'%h:%h:%p') as waktu_end, ss_category_tantangan.name_category as categ
				FROM {$this->config['DATABASE'][0]['DATABASE']}.ss_chalangge, {$this->config['DATABASE'][0]['DATABASE']}.ss_challange_detail, {$this->config['DATABASE'][0]['DATABASE']}.ss_category_tantangan
				where ss_chalangge.id=ss_challange_detail.id_challange
				and ss_chalangge.category=ss_category_tantangan.id
				and ss_challange_detail.id_chapter='{$idchapter}'
				AND  ss_challange_detail.id='{$id}'";
		
			$rs = $this->apps->fetch($sql); 
			 //pr($sql);die;
		return $rs;
	}
	
	function tantangan($id){
		/* $sql = "
				SELECT *,DATE_FORMAT(start_time,'%d/%m/%Y') as time_start,DATE_FORMAT(end_time,'%d/%m/%Y') as time_end,(select count(*) as total FROM ss_list_pesertatantangan WHERE tantangan_id=ss_chalangge.id AND chapter_id={$id}) as total_peserta
				FROM {$this->config['DATABASE'][0]['DATABASE']}.ss_chalangge, {$this->config['DATABASE'][0]['DATABASE']}.ss_challange_detail 
				WHERE ss_chalangge.id=ss_challange_detail.id_challange and ss_challange_detail.id_chapter='{$id}'  AND  n_status=1  AND  end_time >= NOW() ORDER BY end_time ASC";
		 */
		$sql = "
				SELECT *,DATE_FORMAT(start_time,'%d/%m/%Y') as time_start,DATE_FORMAT(end_time,'%d/%m/%Y') as time_end
				FROM {$this->config['DATABASE'][0]['DATABASE']}.ss_chalangge
				WHERE n_status=1  AND  end_time >= NOW() ORDER BY end_time ASC";
			//pr($sql);exit;
			$rs = $this->apps->fetch($sql,1); 
			//pr($sql);die;
		return $rs;
	}
	function tantanganold($id){
		$sql = "
				SELECT *,DATE_FORMAT(start_time,'%d/%m/%Y') as time_start,DATE_FORMAT(end_time,'%d/%m/%Y') as time_end,(select count(*) as total FROM ss_list_pesertatantangan WHERE tantangan_id=ss_chalangge.id AND chapter_id={$id}) as total_peserta
				FROM {$this->config['DATABASE'][0]['DATABASE']}.ss_chalangge 
				WHERE chapter_id='{$id}' AND ss_chalangge.end_time < NOW()  ORDER BY ss_chalangge.end_time DESC";
		
			$rs = $this->apps->fetch($sql,1); 
			// pr($sql);die;
		return $rs;
	}
	function getTantanganpeserta($id,$idchapter){
		$sql = "
				SELECT name
				FROM {$this->config['DATABASE'][0]['DATABASE']}.ss_list_pesertatantangan slp
				LEFT JOIN {$this->config['DATABASE'][0]['DATABASE']}.ss_member ON slp.member_id=ss_member.id
				WHERE slp.chapter_id='{$idchapter}' AND  slp.tantangan_id='{$id}'";
		
			$rs = $this->apps->fetch($sql,1); 
			// pr($sql);die;
		return $rs;
	}
	
}
