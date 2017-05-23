<?php
class apibmw extends App{

	function beforeFilter(){
		global $LOCALE,$CONFIG;
		$this->memberHelper = $this->useHelper('memberHelper');
		$this->uploadHelper = $this->useHelper('uploadHelper');
		$this->postmarkHelper = $this->useHelper('postmarkHelper');
		$this->assign('basedomain',$CONFIG['BASE_DOMAIN']); 
		$this->assign('basedomainpath', $CONFIG['BASE_DOMAIN_PATH']);
		$this->assign('assets_domain', $CONFIG['ASSETS_DOMAIN_ADMIN']);
		$this->assign('locale', $LOCALE[1]);		
		$this->assign('pages', strip_tags($this->_g('page')));
		$this->assign('user',$this->user);
	}
	
	function main($start=null,$limit=1){
	
				
			return $this->View->toString(TEMPLATE_DOMAIN_WEB .'apps/puzzle.html');
	}
	
	function apibmw(){
		//pr("abcd"); die;
		global $CONFIG;
		error_reporting(E_ALL);
		ini_set('display_error',1);
		$this->memberHelper = $this->useHelper('memberHelper');
		$this->uploadHelper = $this->useHelper('uploadHelper');
		//if($this->_p('submit')){
			//pr('masuk sini'); die;
			
			$data['firstname']=@$_POST['firstname'];
			$data['lastname']=$_POST['lastname'];
			$data['phone']=$_POST['phone'];
			$data['email']=$_POST['email'];
			//$data['photo']=$_POST['photo'];
			//pr($data); 
			//$datamasuk=$this->memberHelper->apibmw($data);
			
			
		$file = $_FILES['myfile'];
		if($file){
		//pr('ss');exit;
		$path = $CONFIG['LOCAL_PUBLIC_ASSET']."apibmw/";
		$uploadimage= $this->uploadHelper->uploadThisImage($file,$path);
		$filenya=$uploadimage['arrImage']['filename'];
		}else{
		$filenya='';
		}
		
		//pr($filenya);exit;		
		$result=$this->memberHelper->apibmw($filenya,$data);
			
		echo json_encode(array('status'=>1,'message'=>'berhasil')); die;
	}
	
	
	
	function apibmw2(){
		//pr("asasa"); die;
	global $CONFIG;
		error_reporting(E_ALL);
		ini_set('display_error',1);
		$this->postmarkHelper = $this->useHelper('postmarkHelper');
		
		$data['firstname']=@$_POST['firstname'];
			$data['lastname']=$_POST['lastname'];
			$data['phone']=$_POST['phone'];
			$data['email']=$_POST['email'];
			//$data['photo']=$_POST['photo'];
			//pr($data); 
			//$datamasuk=$this->memberHelper->apibmw($data);
			
			
		$file = $_FILES['myfile'];
		if($file){
		//pr('ss');exit;
		$path = $CONFIG['LOCAL_PUBLIC_ASSET']."apibmw/";
		$uploadimage= $this->uploadHelper->uploadThisImage($file,$path);
		$filenya=$uploadimage['arrImage']['filename'];
		}else{
		$filenya='';
		}
		
		//pr($filenya);exit;		
		$result=$this->postmarkHelper->apibmw($filenya,$data);
		
		
	$email_to = "zulfikar.iskandar@kana.co.id";	
	$subject = "ABCD";
	
		$message = "
		<h1>EMAIL CONTACT KANA DIGITAL</h1>
		<table width='400' border='0' cellspacing='0' cellpadding='0'>
		  <tr>
			<td width='100' valign='top'>Name</td>
			<td width='10' valign='top'>:</td>
			<td width='92' valign='top'>".$_POST['firstname']."</td>
		  </tr>
		  <tr>
			<td valign='top'>Email</td>
			<td valign='top'>:</td>
			<td valign='top'>".$_POST['firstname']."</td>
		  </tr>
		  <tr>
			<td valign='top'>Phone</td>
			<td valign='top'>:</td>
			<td valign='top'>".$_POST['firstname']."</td>
		  </tr>
		  <tr>
			<td valign='top'>Country</td>
			<td valign='top'>:</td>
			<td valign='top'>".$_POST['firstname']."</td>
		  </tr>
		  <tr>
			<td valign='top'>Best time to contact</td>
			<td valign='top'>:</td>
			<td valign='top'>".$_POST['firstname']."</td>
		  </tr>
		  <tr>
			<td valign='top'>Notes or Request</td>
			<td valign='top'>:</td>
			<td valign='top'>".$_POST['firstname']."</td>
		  </tr>
		</table>
		";
	
		// Always set content-type when sending HTML email
		$headers = "MIME-Version: 1.0" . "\r\n";
		$headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";
		
		// More headers
		$headers .= 'From: <'.$_POST['email'].'>' . "\r\n";
		
			$postmark = new Postmark("e54ddbbf-beeb-48c4-ba71-7a4d8fb92c03","info@sonarplatform.com","info@sonarplatform.com");
			
			if($postmark->to($email_to)->subject($subject)->html_message($message)->send()){
				 echo json_encode(array('status'=>1,'message'=>'berhasil')); die;
			}else{
				echo json_encode(array('status'=>1,'message'=>'gagal')); die;
			} 
		
		
		// if(mail($email_to, $subject, $message, $headers)){
			// echo "<div class='overlays'><div class='messagebox'><h3>Thank you for the Request. We will contact you shortly.</h3></div></div>";
		// }else{
			// echo "<div class='overlays'><div class='messagebox'>Sorry, don't know what happened. Try later</div></div>";
		// }
	}

	
	
}
?>
