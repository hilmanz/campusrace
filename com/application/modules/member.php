<?php
class member extends App{
	
	function beforeFilter(){
 		
		global $LOCALE,$CONFIG;

	
		$this->memberHelper = $this->useHelper('memberHelper');	
		$this->uploadHelper = $this->useHelper('uploadHelper');
		$this->loginHelper = $this->useHelper('loginHelper');
	
		$this->assign('basedomain',$CONFIG['BASE_DOMAIN']); 
		$this->user=$this->session->getSession($this->config['SESSION_NAME'],"WEB");
		$this->assign('user', $this->user);
		
	}
	
	function main(){
	global $LOCALE,$CONFIG;
	//pr($this->user);exit;
	//pr('s');exit;
	$this->memberHelper = $this->useHelper('memberHelper');	
		if($this->user && $this->user->role=='2')
		{
			
		$memberprofile=$this->memberHelper->memberprofile($this->user->user_id);
		//pr($memberprofile);exit;
		$chapter_member=$memberprofile['chapter_id'];
		//pr($chapter_member);exit;
		$listevent=$this->memberHelper->listevent($chapter_member);
		//pr($listevent);exit;
		$listantangan=$this->memberHelper->listtantangan($chapter_member);
		//pr($listevent);exit;
		$this->assign('listevent',$listevent);
		$this->assign('listantangan',$listantangan);
		$this->assign('memberprofile',$memberprofile);
		return $this->View->toString(TEMPLATE_DOMAIN_WEB .'apps/member-profile.html');		
		}
		else
		{
				sendRedirect("{$CONFIG['BASE_DOMAIN']}home");
				return $this->out(TEMPLATE_DOMAIN_WEB . '/login_message.html');
				die();
		}
	
	
		
		
	}
	function tantangan()
	{
			
			$this->tantanganHelper = $this->useHelper('tantanganHelper');
			$memberprofile=$this->memberHelper->memberprofile($this->user->user_id);
			//pr($memberprofile['chapter_id']);exit;
			$chapter_member=$memberprofile['chapter_id'];
			$result=$this->tantanganHelper->tantangan($chapter_member);
			$resultold=$this->tantanganHelper->tantanganold($chapter_member);
			// pr($resultold);
			$this->assign('datatantangan',$result); 
			$this->assign('datatantanganold',$resultold);
		
			
			return $this->View->toString(TEMPLATE_DOMAIN_WEB .'/apps/tantangan_list_member.html');
		
		
		
	}
	function statusemail(){
//pr('s');exit;
	
		$memberblast=$this->memberblastHelper->statusemail();
		//pr($getfmnya);exit;
		
	}
	function upload_foto(){
	global $CONFIG;
	
	if(isset($_FILES['myfile']))
		{
			 
				$file = $_FILES['myfile'];
				//pr($file);exit;
				if(isset($_FILES['myfile'])){
				$path = $CONFIG['LOCAL_PUBLIC_ASSET']."profile/";
				//pr($path);exit;
			
				// upload image dulu
				$uploadimage= $this->uploadHelper->uploadThisImage($file,$path);
				//pr($uploadimage);exit;

				$update_avatar = $this->memberHelper->updateimg($this->user->user_id,$uploadimage['arrImage']['filename']);
				
					if($uploadimage)
						{
						print json_encode(array('status'=>true,'file'=>$uploadimage['arrImage']['filename']));die; 
						}else{ 
						print json_encode(array('status'=>false));die;
						}
						
				
					}
			
		}
	
	}
		protected function eventDetail()
	{
		// echo"ssss";
		if($this->user && $this->user->role=='2' )
		{
			$idevent=$this->_g('event');
			// pr($idevent);
			$getchapterid=$this->memberHelper->memberprofile($this->user->user_id);
			// pr($getchapterid);die;
			$result=$this->memberHelper->getEvent($idevent,$getchapterid['chapter_id']);
			// $resultpeserta=$this->chapterHelper->getEventpeserta($idevent,$this->user->user_id);
			// pr($result);die;
			$this->assign('dataevent',$result); 
			// $this->assign('dataeventpeserta',$resultpeserta); 
			return $this->View->toString(TEMPLATE_DOMAIN_WEB .'/apps/eventmemberdetail.html');
		}
		else
		{
				sendRedirect("{$CONFIG['BASE_DOMAIN']}home");
				return $this->out(TEMPLATE_DOMAIN_WEB . '/login_message.html');
				die();
		}
		
		
	}
	function addPeserta()
	{
	global $CONFIG;
		// echo"ssss";
		if($this->user && $this->user->role=='2' )
		{
			$idevent=$this->_p('idevent');
			// pr($idevent);
			$getchapterid=$this->memberHelper->memberprofile($this->user->user_id);
			$getchapterid=$this->memberHelper->addPersertaevent($this->user->user_id,$idevent,$getchapterid['chapter_id']);
			print_r(json_encode(array('status'=>1,'msg'=>'sucsess')));die;
			//return $this->View->toString(TEMPLATE_DOMAIN_WEB .'/apps/eventmemberdetail.html');
		}
		else
		{
				sendRedirect("{$CONFIG['BASE_DOMAIN']}home");
				return $this->out(TEMPLATE_DOMAIN_WEB . '/login_message.html');
				die();
		}
		
		
	}
	
	 function event()
	{
	global $CONFIG;
	
		$getchapterid=$this->memberHelper->memberprofile($this->user->user_id);
		//pr('ss');exit;
		if($getchapterid['chapter_id'])
		{//pr('ss');exit;
			$result=$this->memberHelper->event($getchapterid['chapter_id']);
			$resultold=$this->memberHelper->eventold($getchapterid['chapter_id']);
			// pr($resultold);
			$this->assign('dataevent',$result); 
			$this->assign('dataeventold',$resultold); 
			return $this->View->toString(TEMPLATE_DOMAIN_WEB .'/apps/listeventmember.html');
		}
		else
		{
				sendRedirect("{$CONFIG['BASE_DOMAIN']}home");
				return $this->out(TEMPLATE_DOMAIN_WEB . '/login_message.html');
				die();
		}
		
		
	}
	
	function reservation()
	{
		$decrypt=urldecode64($this->_request('pram'));
		$unserialize=unserialize($decrypt);
		$result=$this->memberHelper->getEvent($unserialize['idevent'],$unserialize['chapterid']);
		$this->assign('dataevent',$result); 
		$this->assign('iduser',$unserialize['userid']);
		$this->assign('chapterid',$unserialize['chapterid']);		
		return $this->View->toString(TEMPLATE_DOMAIN_WEB .'/apps/reservation.html');
		// pr($result);die;
	}
	function prosesreservation()
	{
		// pr($_POST);die;
		$idevent=$this->_p('event');
		$userid=$this->_p('user');
		$chapter_id=$this->_p('chapter');
		$getchapterid=$this->memberHelper->addPersertaeventreservation($userid,$idevent,$chapter_id);
		sendRedirect("{$CONFIG['BASE_DOMAIN']}member");
		return $this->out(TEMPLATE_DOMAIN_WEB . '/login_message.html');
		die();
	}
	protected function encrypt($string)
	{	
		$ENC_KEY='123456';
		return base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5($ENC_KEY), $string, MCRYPT_MODE_CBC, md5(md5($ENC_KEY))));
	}
	protected function decrypt($encrypted)
	{
		$ENC_KEY='123456';
		return rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, md5($ENC_KEY), base64_decode($encrypted), MCRYPT_MODE_CBC, md5(md5($ENC_KEY))), "\0");
	}
	protected function detailtantangan()
	{
		if($this->user)
		{
			$idTantangan=$this->_g('id');
			$memberprofile=$this->memberHelper->memberprofile($this->user->user_id);
			//pr($memberprofile['chapter_id']);exit;
			$chapter_member=$memberprofile['chapter_id'];
			$result=$this->memberHelper->getTantangan($idTantangan,$chapter_member);
			$this->assign('datatantangan',$result); 
			
			return $this->View->toString(TEMPLATE_DOMAIN_WEB .'/apps/tantanganmember.html');
		}
		else
		{
				sendRedirect("{$CONFIG['BASE_DOMAIN']}home");
				return $this->out(TEMPLATE_DOMAIN_WEB . '/login_message.html');
				die();
		}
		
		
	}
	
	function leaderboard(){
		global $LOCALE,$CONFIG;
		
		$this->homeHelper = $this->useHelper('homeHelper');
		$pagechapter = $this->_request('startchapter');
		$pagemember = $this->_request('startmember');
		$leaderChapter = $this->homeHelper->chapter($pagechapter,$rows=10);
		$leaderMember = $this->homeHelper->member($pagemember,$rows=10);
		$this->assign("msg",'');
		$this->assign("leaderChapter",$leaderChapter['data']);
		// pr($leaderMember);die;
		$this->assign("totalleaderChapter",$leaderChapter['total']);
		$this->assign("leaderMember",$leaderMember['data']);
		$this->assign("totalleaderMember",$leaderMember['total']);
			return $this->View->toString(TEMPLATE_DOMAIN_WEB .'/apps/leaaderboard.html');
	}
	function proseseditmember(){
		global $CONFIG;
		
		if($this->_p('submit')==1)
		{ 
		pr($_FILES['myfile']);
		$data['name_member']=$this->_p('name_member');
		$data['no_tlp']=$this->_p('no_telp');
		$data['alamat']=$this->_p('alamat');
		$data['kampus']=$this->_p('kampus');
		$data['fb_id']=$this->_p('fbanggota');
		$data['twitter_id']=$this->_p('twitteranggota');
		$data['password']=$this->_p('password');
		$data['repassword']=$this->_p('repassword');
		//$_FILES['myfile']=$this->_p('myfile');
		//pr('ss');exit;
		
		$file = $_FILES['myfile'];
		//pr($data['myfile']); die;
		 if($file){
			pr('ss');exit;
			$path = $CONFIG['LOCAL_PUBLIC_ASSET']."profile/";
			$uploadimage= $this->uploadHelper->uploadThisImage($file,$path);
			$filenya=$uploadimage['arrImage']['filename'];
		}
		else{
			$filenya='ss';
		} 
		pr($file); die;
		$editprofile=$this->memberHelper->editprofile($filenya,$data,$this->user->user_id);
		
		if($editprofile){
			sendRedirect("{$CONFIG['BASE_DOMAIN']}member");
			return $this->out(TEMPLATE_DOMAIN_WEB . '/login_message.html');
			die();
		}
			
			
		}
		
		
	}
	function editmember()
	{
	global $CONFIG;
		$paramid=$this->_request('param');
		//pr($_POST);exit;
		
		if($this->user->user_id==$paramid)
		{
			$memberprofile=$this->memberHelper->memberprofile($this->user->user_id);
			//$c=$memberprofile['password'];
			$this->assign('editmember',$memberprofile);
			
			$this->assign('password',$this->decrypt($memberprofile['password'])); 
			//$a = $this->decrypt($memberprofile['password']);
			//$b = $this->encrypt('admin');
			//pr($b); exit;
			return $this->View->toString(TEMPLATE_DOMAIN_WEB .'/apps/editmember2.html');
		}else{
				sendRedirect("{$CONFIG['BASE_DOMAIN']}home");
				return $this->out(TEMPLATE_DOMAIN_WEB . '/login_message.html');
				die();
		}
		
		
	}
	
	function addkodevoucer(){
		//pr("masuk sini dulu"); exit;
		global $CONFIG;
		$id=$this->_request('id');
		
			$addvoucer=$this->memberHelper->addvoucer($id);
			if($addvoucer){
				sendRedirect("{$CONFIG['BASE_DOMAIN']}home");
				return $this->out(TEMPLATE_DOMAIN_WEB . '/login_message.html');
				die();
		}
		
		//return $this->View->toString(TEMPLATE_DOMAIN_WEB .'/apps/editmember.html');
	}
	
	function masukskor(){
		//pr("abcd"); die;
		global $CONFIG;
		
		//if($this->_p('submit')){
			//pr('masuk sini'); die;
			$data['weekid']=$this->_p('weekid');
			$data['skor1']=$this->_p('skor1');
			$data['skor2']=$this->_p('skor2');
			$data['skor3']=$this->_p('skor3');
			$data['skor4']=$this->_p('skor4');
			$data['skor5']=$this->_p('skor5');
			$data['skor6']=$this->_p('skor6');
			$data['pertandingan1']=$this->_p('pertandingan1');
			$data['pertandingan3']=$this->_p('pertandingan3');
			$data['pertandingan5']=$this->_p('pertandingan5');
			$data['id_member']=$this->_p('id_member');
			
			$datamasuk=$this->memberHelper->skormasuk($data);
			
			if($datamasuk){
				sendRedirect("{$CONFIG['BASE_DOMAIN']}member");
				return $this->out(TEMPLATE_DOMAIN_WEB . '/login_message.html');
				die();
			}			
		//}
	
	}
	
}
?>
