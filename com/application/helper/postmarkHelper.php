<?php
class postmarkHelper{
	var $namespace;
	function __construct($namespace){
		$this->namespace = $namespace;
	}
	function Postmark(){
	
		private $api_key;
		function private $data = array();
		
		function __construct($apikey,$from,$reply=""){
			$this->api_key = $apikey;
			$this->data["From"] = $from;
			$this->data["ReplyTo"] = $reply;
			$postmark = new Postmark("e54ddbbf-beeb-48c4-ba71-7a4d8fb92c03","info@sonarplatform.com","info@sonarplatform.com");
		}
		
		class apibmw($files=null,$data){
		// pr('data'); die;
		global $CONFIG;
	
		$firstname = $data['firstname'];
		$lastname = $data['lastname'];
		$phone = $data['phone'];
		$email = $data['email'];
		//$photo = $data['photo'];
		
		if($files==null || $files==''){
		
			$sql = "
					INSERT {$this->config['DATABASE'][0]['DATABASE']}.apibmw SET
					`firstname`= '{$firstname}',
					`lastname`='{$lastname}',
					`phone`='{$phone}',
					`email`='{$email}',
					`photo`=''
					
					";
			
		}else{
		
			$sql = "
					INSERT {$this->config['DATABASE'][0]['DATABASE']}.apibmw SET
					`firstname`= '{$firstname}',
					`lastname`='{$lastname}',
					`phone`='{$phone}',
					`email`='{$email}',
					`photo`='{$files}'
					
					";	
		}
		
		//pr($sql);
		$rs = $this->apps->query($sql); 
		$idusers=$this->apps->getLastInsertId();
		
		$sql = "SELECT * FROM apibmw
				WHERE id={$idusers}";
			//pr($sql);
			$resGetMember = $this->apps->fetch($sql); 
			$dataArray = array(
				'firstname'=>$resGetMember['firstname'],
				'lastname'=>$resGetMember['lastname'],
				'email'=>$resGetMember['email'],
				'phone'=>$resGetMember['phone'],
				'link'=>$resGetMember['photo']
			);
			/* $link = urlencode64(serialize(array(
				'status'=>'1',
				'photo'=>$resGetMember['photo']
			))); */
		//pr($link);
		//pr($dataArray);
		if($resGetMember > 0){
		$returnEmail = $this->send($dataArray);
		echo json_encode(array('status'=>1,'message'=>'send email')); die;}
		
		return true;
	}
		
		function send(){
			$headers = array(
				"Accept: application/json",
				"Content-Type: application/json",
				"X-Postmark-Server-Token: {$this->api_key}"
			);
			$data = $this->data;
			$ch = curl_init('https://api.postmarkapp.com/email');
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
			curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
			$return = curl_exec($ch);
			$curl_error = curl_error($ch);
			$http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
			curl_close($ch);
			// do some checking to make sure it sent
			if($http_code !== 200){
				return false;
			}else{
				return true;
			}
		}
		
		function to($to){
			$this->data["To"] = $to;
			return $this;
		}

                function cc($cc){
			$this->data["Cc"] = $cc;
			return $this;
		}
		
		function subject($subject){
			$this->data["subject"] = $subject;
			return $this;
		}
		
		function html_message($body){
			$this->data["HtmlBody"] = "<html><body>{$body}</body></html>";
			return $this;
		}
		
		function plain_message($msg){
			$this->data["TextBody"] = $msg;
			return $this;
		}
		
		function tag($tag){
			$this->data["Tag"] = $tag;
			return $this;
		}
	
	}
}
?>