<?php

class getfmHelper {
	
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
	
	function bacaHTML($url){
     // inisialisasi CURL
     $data = curl_init();
     // setting CURL
     curl_setopt($data, CURLOPT_RETURNTRANSFER, 1);
     curl_setopt($data, CURLOPT_URL, $url);
     // menjalankan CURL untuk membaca isi file
     $hasil = curl_exec($data);
     curl_close($data);
     return $hasil;
	}


	function getfm(){
		$sql = "select id,username as email
				FROM ss_member WHERE n_status=1";
		
		$rs = $this->apps->fetch($sql,1); 
	
		//pr($rs);exit;
		foreach($rs as $key =>$val)
		
		{
		$email=$val['email'];
		//AMBIL STATUS DI FM ADA ATAU TIDAK ? 
		$ok=$this->bacaHTML('http://www.supersoccer.co.id/service/ssgte_check?email='.$email.'');
		$decodejson=json_decode($ok);
		
		if($decodejson->status=='1'){
			//UPDATE STATUS TERDAFTAR APA ENGGA DI FM (1=Yes, 0=No(Default))  
			$sql = "UPDATE ss_member SET `status_fm`=1 where id='{$val['id']}'";
			$rs = $this->apps->query($sql); 
			
			
			//AMBIL POINTNYA KALO - MINUS TIDAK DI TAMBAHKAN KALO + 0 DI UPDATE
			$idnya=$decodejson->user->id;
			$bacapoint=$this->bacaHTML('http://www.supersoccer.co.id/service/ssgte_stats/'.$idnya.'');
			$decpoint=json_decode($bacapoint);
			
			if($decpoint->total_points > 0){
				$sql = "UPDATE ss_member SET `point_fm`='{$decpoint->total_points}' where id='{$val['id']}'";
				//pr($sql);exit;
				$rs = $this->apps->query($sql); 
			}
		
		}
		
		}
		return true;
	}
	

	
	
}
