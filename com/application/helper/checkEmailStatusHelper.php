<?php

class checkEmailStatusHelper {
	
        function __construct($apps){
                global $logger,$CONFIG;
                $this->logger = $logger;
                $this->apps = $apps;
                if(is_object($this->apps->user)) {
                                $uid = intval($this->apps->_request('uid'));
                                if($uid==0) $this->uid = intval($this->apps->user->id);
                                else $this->uid = $uid;
                }

        }

	function statusemail($email){
		
		$output = shell_exec('curl -s --user \'api:key-031f6c645c2c27d331e152ba8a959e28\' -G -d "recipient='.$email.'&limit=1" https://api.mailgun.net/v3/gte.supersoccer.co.id/campaigns/fkdf5/events');
		//pr(json_decode($output));exit;
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
	
	function checkMail(){
		$sql = "select id,username
				FROM ss_member WHERE n_status=0 AND status_email=0 ";
		
		$rs = $this->apps->fetch($sql,1); 
		//pr($rs);exit;
		foreach($rs as $key => $val){
			$statusemail=$this->statusemail($val['username']);
			//pr($statusemail);exit;
			if($statusemail=='delivered'){					
				$statusemailmember = "update ss_member set status_email=1 where id='{$val['id']}'";
				$resnyastatus = $this->apps->query($statusemailmember); 					
			}
			else if($statusemail=='bounced' || $statusemail=='dropped'){					
				$statusemailmember = "update ss_member set status_email=3,n_status=3 where id='{$val['id']}'";
				$resnyastatus = $this->apps->query($statusemailmember); 					
			}
			
		}
		exit;
		
		
	}
	
	function cekemailchapter(){
		$sql = "select id,email
				FROM ss_chapter WHERE n_status=0 AND status_email=0";
		
		$rs = $this->apps->fetch($sql,1); 
		//pr($rs);exit;
		foreach($rs as $key => $val){
			$statusemail=$this->statusemail($val['email']);
			//pr($statusemail);exit;
			if($statusemail=='delivered'){					
				$statusemailmember = "update ss_chapter set status_email=1 where id='{$val['id']}'";
				$resnyastatus = $this->apps->query($statusemailmember); 					
			}
			else if($statusemail=='bounced' || $statusemail=='dropped'){					
				$statusemailmember = "update ss_chapter set status_email=3,n_status=3 where id='{$val['id']}'";
				$resnyastatus = $this->apps->query($statusemailmember); 					
			}
			
		}
		exit;
		
		
	}
	
	function chapterBlast(){
		
		$sql = "select *
				FROM ss_chapter WHERE n_status=0";
		
		$rs = $this->apps->fetch($sql,1); 
	
		//pr($rs);exit;
		foreach($rs as $key =>$val)
			{
				// KIRIM EMAIL NYA 
				$sqlGetChapter = "SELECT name FROM ss_chapter WHERE id='{$val['id']}'";
				//pr($sqlGetChapter);exit;
				$resGetChapter = $this->apps->fetch($sqlGetChapter); 
				$dataArray = array(
					'email'=>$emluser,
					'namechapter'=>$resGetChapter['name']
				);
				$link = urlencode64(serialize(array(
					'status'=>'1',
					'email'=>$emluser
				)));
				
				$this->send_addmemeber($dataArray,$link);
				
				
			}
		
		
		return true;
		
		
	}

	function memberblast(){
		$sql = "select *
				FROM ss_member WHERE n_status=0 AND status_email=0";
		
		$rs = $this->apps->fetch($sql,1); 
	
		//pr($rs);exit;
		foreach($rs as $key =>$val)
			{
				// KIRIM EMAIL NYA 
				$sqlGetChapter = "SELECT name_chapter FROM ss_chapter WHERE id='{$val['chapter_id']}'";
				//pr($sqlGetChapter);exit;
				$resGetChapter = $this->apps->fetch($sqlGetChapter); 
				$dataArray = array(
					'email'=>$val['email'],
					'name'=>$val['name'],
					'namechapter'=>$resGetChapter['name_chapter']
				);
				$link = urlencode64(serialize(array(
					'status'=>'1',
					'email'=>$val['email']
				)));
				
				$this->send_addmemeber($dataArray,$link);
				
				//CEK STATUS EMAIL
				//$statusemail=$this->statusemail($emluser);
				
				//UPDATE STATUS IF BOUNCED
				//if($statusemail=='bounced'){
					
				//	$statusemailmember = "update ss_member set n_status=3 where id='{$val['id']}'";
				//	$resnyastatus = $this->apps->query($statusemailmember); 
					
				//}
			}
		
		
		return true;
	}
	
	function send_addmemeber($dataArray=null,$link=null) {  
		global $LOCALE;
		
		if($dataArray){
			$results['msg']='';
			$results['status']='';
			$template = $LOCALE[1]['addmember'];
			$template = str_replace('!#name',$dataArray['name'],$template);
			$template = str_replace('!#chaptername',$dataArray['namechapter'],$template);
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
	
	

	
	
}
