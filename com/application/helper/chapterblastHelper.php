<?php

class chapterblastHelper {
	
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


	function blastMail(){
		$sql = "select * FROM ss_invitation_chapter";
		$rs = $this->apps->fetch($sql,1); 
		
		//$counter=count($data['id']);
                //$i=1;	

		//pr($rs);exit;
		foreach($rs as $key =>$val)
			{
				// KIRIM EMAIL NYA 
				$sqlGetChapter = "SELECT * FROM ss_invitation_chapter WHERE id='{$val['id']}'";
				//pr($sqlGetChapter);exit;
				$resGetChapter = $this->apps->fetch($sqlGetChapter); 
                                $dataArray = array(
                                        'email'=>$resGetChapter['chapter_head_email'],
                                        'nameheadchapter'=>$resGetChapter['chapter_head_name'],
                                        'namechapter'=>$resGetChapter['chapter_name']
                                );

				//$link = urlencode64(serialize(array(
				//	'status'=>'1',
				//	'email'=>$emluser
				//)));
				
			$returnEmail = $this->send_addchapter($dataArray);

			}
		
		//}
		//return true;
		//if($i==$counter){

                        //return true;
                //}
	}
	
	function send_addchapter($dataArray=null,$link=null) {  
		global $LOCALE;
		
		if($dataArray){
			$results['msg']='';
			$results['status']='';
			$template = $LOCALE[1]['addchapter'];
			$template = str_replace('!#name',$dataArray['nameheadchapter'],$template);
			$template = str_replace('!#chaptername',$dataArray['namechapter'],$template);
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
								  'subject' => "Registrasi Chapter dan Member ".$dataArray['namechapter']."",
								  'html' => $template,
								  'attachment' => '/home/gte/region1/com/application/helper/Template_Registrasi_Member.xlsx',
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

?>
