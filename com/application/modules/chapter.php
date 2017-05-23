<?php
class chapter extends App{
	
	function beforeFilter(){
 		
		global $LOCALE,$CONFIG;
		$this->chapterHelper = $this->useHelper('chapterHelper');
		$this->tantanganHelper = $this->useHelper('tantanganHelper');
		
		$this->memberHelper = $this->useHelper('memberHelper');
		$this->loginHelper = $this->useHelper('loginHelper');
		$this->uploadHelper = $this->useHelper('uploadHelper');
		$this->assign('basedomain',$CONFIG['BASE_DOMAIN']); 
		$this->user=$this->session->getSession($this->config['SESSION_NAME'],"WEB");
		$this->assign('user', $this->user);
	}
	
	function main(){
		// echo"ssss";die;
		if($this->user->role==1){
			
				sendRedirect("{$CONFIG['BASE_DOMAIN']}chapter/profile");
				return $this->out(TEMPLATE_DOMAIN_WEB . '/login_message.html');
				die();
		}
		
		if(strip_tags($this->_g('page'))=='home') $this->log('surf','home');
		return $this->View->toString(TEMPLATE_DOMAIN_WEB .'/home.html');		
	}
	function prosesRegistrasi(){
			global $LOCALE,$CONFIG;
		$validationData='';
		$valid='';
		// echo"ddd";die;
		$data['name']=$this->_p('name');
		$data['namechapter']=$this->_p('namechapter');
		//$data['emailhead']=$this->_p('emailhead');
		
		$data['ktp_sim']=$this->_p('ktp_sim');
		$data['email']=$this->_p('email');
		$data['password']= $this->encrypt($this->_p('password'));
		$data['kota']=$this->_p('kota');
		$data['club']=$this->_p('club');
		$data['alamat']=$this->_p('alamat');
		$data['telp']=$this->_p('telp');
		$data['facebook']=$this->_p('facebook');
		$data['twitter']=$this->_p('twitter');
		
		$result=$this->chapterHelper->addChapter($data);
		if($result)
		{
			$res = $this->loginHelper->loginSession();
			$sessionuser = @$this->session->getSession($CONFIG['SESSION_NAME'],"WEB");
			// pr($sessionuser);die;
			if($res['status']==1){
				sendRedirect("{$CONFIG['BASE_DOMAIN']}chapter/confirm");
				return $this->out(TEMPLATE_DOMAIN_WEB . '/login_message.html');
				die();
			}
			
			
		}
		
		
	}
	protected function confirm($string)
	{
		if($this->user)
		{
			//$result=$this->chapterHelper->addChapter($data);
			return $this->View->toString(TEMPLATE_DOMAIN_WEB .'/apps/confirmreg.html');
		}
		else
		{
				sendRedirect("{$CONFIG['BASE_DOMAIN']}home");
				return $this->out(TEMPLATE_DOMAIN_WEB . '/login_message.html');
				die();
		}
		
		
	}
	protected function member($string)
	{
		
		if($this->_request('deletemember') && $this->user){
			$data['param']=$this->_request('deletemember');
			//pr($data);exit;
			$result=$this->chapterHelper->deletemember($data);
			
		}
		
		
		if($this->user)
		{
			//pr($_REQUEST);exit;
			if($_REQUEST['search'])
			{
					$pagepoint = $this->_request('startpoint');
					$pagemember = $this->_request('startmember');
					$result=$this->chapterHelper->member($this->user->user_id,$pagemember,$rows=10);
					// pr($result);exit;
					$resultmemebr= $result;
					
					$this->assign('search',$this->_request('search')); 
					$this->assign('status',$_REQUEST['status']); 
					
					$this->assign('datamember',$result['data']); 
					$this->assign('totaldatamember',$resultmemebr['total']); 
					$result=$this->chapterHelper->memberpoint($this->user->user_id,$pagepoint,$rows=10);
					$resultpoint=$result;
					$this->assign('datamemberpoint',$result['data']); 
					$this->assign('totaldatamemberpoint',$resultpoint['total']); 
					return $this->View->toString(TEMPLATE_DOMAIN_WEB .'/apps/listmember.html');
			}
			$this->assign('search',$this->_request('search')); 
			$this->assign('status',$_REQUEST['status']); 
			$pagepoint = $this->_request('startpoint');
			$pagemember = $this->_request('startmember');
			$result=$this->chapterHelper->member($this->user->user_id,$pagemember,$rows=10);
			// pr($result);exit;
			
			$resultmemebr= $result;
			$this->assign('datamember',$result['data']); 
				$this->assign('totaldatamember',$resultmemebr['total']); 
			$result=$this->chapterHelper->memberpoint($this->user->user_id,$pagepoint,$rows=10);
			 
			$resultpoint=$result;
			$this->assign('datamemberpoint',$result['data']); 
				$this->assign('totaldatamemberpoint',$resultpoint['total']); 
			 if($this->_p('ajaxpoint'))
			 {
				 if($resultpoint)
					{
						print_r(json_encode(array('status'=>1,'msg'=>'sucsess','data'=>$resultpoint,'total'=> $resultpoint['total'])));die;
					}
					else
					{
						print_r(json_encode(array('status'=>0,'msg'=>'sucsess','data'=>false,'total'=> 0)));die;
					}
			 }
			 else if($this->_p('ajaxmember'))
			 {
				 if($resultmemebr)
					{
						print_r(json_encode(array('status'=>1,'msg'=>'sucsess','data'=>$resultmemebr,'total'=> $resultmemebr['total'])));die;
					}
					else
					{
						print_r(json_encode(array('status'=>0,'msg'=>'sucsess','data'=>false,'total'=> 0)));die;
					}
			 }
			 else
			 {
				 return $this->View->toString(TEMPLATE_DOMAIN_WEB .'/apps/listmember.html');
			 }
				
		}
		else
		{
				sendRedirect("{$CONFIG['BASE_DOMAIN']}home");
				return $this->out(TEMPLATE_DOMAIN_WEB . '/login_message.html');
				die();
		}
		
		
	}
	protected function detailMember($string)
	{
		if($this->user)
		{
			$idmember = $this->_g('member');
			$result=$this->chapterHelper->getMember($this->user->user_id,$idmember);
			// pr($result);
			$this->assign('datamember',$result); 
			return $this->View->toString(TEMPLATE_DOMAIN_WEB .'/apps/detailmember.html');
		}
		else
		{
				sendRedirect("{$CONFIG['BASE_DOMAIN']}home");
				return $this->out(TEMPLATE_DOMAIN_WEB . '/login_message.html');
				die();
		}
		
		
	}
	
	function pagingmember(){
//pr('ss');exit;
		
		$memberList = $this->chapterHelper->memberpaging($start=null,$limit=10);
		//pr($storyList);exit;
		if($memberList==true){
		print json_encode(array('status'=>true,'data'=>$memberList['result'],'total'=>$memberList['total']));
		}else{ 
			print json_encode(array('status'=>false));
		}
		
		exit;
		
	}
	
	protected function profile()
	{
			// pr($this->user);die;
		if($this->user)
		{
			// pr($this->user);die;
			$result=$this->chapterHelper->profile($this->user->id);
			$akumulasi=$this->chapterHelper->akumulasichapter($this->user->user_id);
			$totalMember=$this->chapterHelper->countMember($this->user->user_id);
			$totalEvent=$this->chapterHelper->countEvent($this->user->user_id);
			$totalTantangan=$this->chapterHelper->countTantangan($this->user->user_id);
			// pr($akumulasi);die;
			// $akumulasi
			$this->assign('akumulasi', $akumulasi['total']);
			$this->assign('userdata', $result);
			$this->assign('membertotal', $totalMember['total']);
			$this->assign('totalEvent', $totalEvent['total']);
			$this->assign('totalTantangan', $totalTantangan['total']);
			return $this->View->toString(TEMPLATE_DOMAIN_WEB .'/apps/profilechapter.html');
		}
		else
		{
				sendRedirect("{$CONFIG['BASE_DOMAIN']}home");
				return $this->out(TEMPLATE_DOMAIN_WEB . '/login_message.html');
				die();
		}
		
		
	}
	protected function addMember()
	{
		if($this->user)
		{
			
			return $this->View->toString(TEMPLATE_DOMAIN_WEB .'/apps/addmember.html');
		}
		else
		{
				sendRedirect("{$CONFIG['BASE_DOMAIN']}home");
				return $this->out(TEMPLATE_DOMAIN_WEB . '/login_message.html');
				die();
		}
		
		
	}
	protected function checkEmail()
	{
		if($this->user)
		{
			$data['email']=$this->_p('email');
			$result=$this->chapterHelper->checkEmail($data);
			//pr($result);exit;
			if($result)
			{
				// pr($result);
				// pr($data['email']);
				print_r(json_encode(array('status'=>1,'email'=>$data['email'])));die;
			}
			else
			{
				print_r(json_encode(array('status'=>0)));die;
				
			}
			return $this->View->toString(TEMPLATE_DOMAIN_WEB .'/apps/addmember.html');
		}
		else
		{
				sendRedirect("{$CONFIG['BASE_DOMAIN']}home");
				return $this->out(TEMPLATE_DOMAIN_WEB . '/login_message.html');
				die();
		}
	}
	protected function prosesaddMember()
	{
			global $LOCALE,$CONFIG;
		if($this->user)
		{
			$data['email']=$this->_p('email');
			$result=$this->chapterHelper->prosesaddMember($data,$this->user->user_id);
			if($result)
			{
				sendRedirect("{$CONFIG['BASE_DOMAIN']}chapter/member");
				return $this->out(TEMPLATE_DOMAIN_WEB . '/login_message.html');
				die();
			}
			die;
			// return $this->View->toString(TEMPLATE_DOMAIN_WEB .'/apps/addmember.html');
		}
		else
		{
				sendRedirect("{$CONFIG['BASE_DOMAIN']}home");
				return $this->out(TEMPLATE_DOMAIN_WEB . '/login_message.html');
				die();
		}
		
		
	}
	protected function testemail()
	{
		
		$result=$this->chapterHelper->send_simple_message();
		die;
	}
	protected function event()
	{
		if($this->user)
		{
			$result=$this->chapterHelper->event($this->user->user_id);
			$resultold=$this->chapterHelper->eventold($this->user->user_id);
			 //pr($resultold);exit;
			$this->assign('dataevent',$result); 
			$this->assign('dataeventold',$resultold); 
			return $this->View->toString(TEMPLATE_DOMAIN_WEB .'/apps/listevent.html');
		}
		else
		{
				sendRedirect("{$CONFIG['BASE_DOMAIN']}home");
				return $this->out(TEMPLATE_DOMAIN_WEB . '/login_message.html');
				die();
		}
		
		
	}
	protected function addEvent()
	{
		if($this->user)
		{
			
			return $this->View->toString(TEMPLATE_DOMAIN_WEB .'/apps/addevent.html');
		}
		else
		{
				sendRedirect("{$CONFIG['BASE_DOMAIN']}chapter/event");
				return $this->out(TEMPLATE_DOMAIN_WEB . '/login_message.html');
				die();
		}
		
		
	}
	
	protected function editEvent()
	{//pr('ss');exit;
		if($this->user)
		{
			$idevent=$this->_g('event');
			// pr($idevent);
			
			$result=$this->chapterHelper->getEvent($idevent,$this->user->user_id);
			$resulttyprevent=$this->chapterHelper->gettypeEvent();
			// pr($result);die;
			$this->assign('dataevent',$result); 
			$this->assign('typrevent',$resulttyprevent); 
			return $this->View->toString(TEMPLATE_DOMAIN_WEB .'/apps/editevent.html');
		}
		else
		{
				sendRedirect("{$CONFIG['BASE_DOMAIN']}home");
				return $this->out(TEMPLATE_DOMAIN_WEB . '/login_message.html');
				die();
		}
		
		
	}
	protected function prosesadEvent()
	{
			global $LOCALE,$CONFIG;
			// pr($this->user);die;
		if($this->user)
		{
			$data['placename']=$this->_p('placename');
			$data['events']=$this->_p('events');
			$data['catevent']=$this->_p('catevent');
			$data['jumlahpeserta']=$this->_p('jumlahpeserta');
			$data['lang']=$this->_p('lang');
			$data['lat']=$this->_p('lat');
			$data['alamat']=$this->_p('alamat');
			$data['datestart']=date('Y-m-d H:i:s',strtotime($this->_p('tgl1').' '.$this->_p('jam1')));
			$data['datefinish']=date('Y-m-d H:i:s',strtotime($this->_p('tgl2').' '.$this->_p('jam2')));
			// pr($data);die;
			$result=$this->chapterHelper->prosesadEvent($data,$this->user->user_id);
			if($result)
			{
				sendRedirect("{$CONFIG['BASE_DOMAIN']}chapter/event");
				return $this->out(TEMPLATE_DOMAIN_WEB . '/login_message.html');
				die();
			}
			die;
			// return $this->View->toString(TEMPLATE_DOMAIN_WEB .'/apps/addmember.html');
		}
		else
		{
				sendRedirect("{$CONFIG['BASE_DOMAIN']}home");
				return $this->out(TEMPLATE_DOMAIN_WEB . '/login_message.html');
				die();
		}
		
		
	}
	function proseseditchapter(){
		//pr('abc'); die;
		global $CONFIG;
		
		if($this->_p('submit')=='1'){
		//pr($_FILES);
		//pr($_POST);exit;
		//pr($filenya);exit;
		$data['name_chapter']=$this->_p('name_chapter');
		$data['email']=$this->_p('email');
		$data['telp']=$this->_p('telp');
		
		if($this->_p('password')==$this->_p('repass'))
		{
		$data['password']=$this->encrypt($this->_p('password'));
		}else{
		$data['password']='';
		}
		
		$data['repass']=$this->_p('repass');
		$data['alamat']=$this->_p('alamat');
		
		
		
		$file = $_FILES['myfile'];
		if($file){
		//pr('ss');exit;
		$path = $CONFIG['LOCAL_PUBLIC_ASSET']."profile/";
		$uploadimage= $this->uploadHelper->uploadThisImage($file,$path);
		$filenya=$uploadimage['arrImage']['filename'];
		}else{
		$filenya='';
		}
		
		//pr($filenya);exit;		
		$result=$this->chapterHelper->editprofile($filenya,$data,$this->user->user_id);
	
		if($result){
		sendRedirect("{$CONFIG['BASE_DOMAIN']}chapter/profile");
				return $this->out(TEMPLATE_DOMAIN_WEB . '/login_message.html');
				die();
		}
	
	}
		
	}
	
	function proseseditmember(){
		//pr('abc'); die;
		global $CONFIG;
		
		if($this->_p('submit')=='1'){
			//pr($_FILES);
			//pr($_POST);exit;
			//pr($filenya);exit;
			
			$data['name_member']=$this->_p('name_member');
			$data['no_tlp']=$this->_p('no_telp');		
			$data['kampus']=$this->_p('kampus');		
			$data['fb_id']=$this->_p('fbanggota');
			$data['twitter_id']=$this->_p('twitteranggota');
			//$data['password']=$this->_p('password');
			//$data['repassword']=$this->_p('repassword');
			
			
			if($this->_p('password')==$this->_p('repassword')){
				$data['password']=$this->_p('password');
			}else{
				$data['password']='';
			}
			
			$data['repassword']=$this->_p('repassword');
			$data['alamat']=$this->_p('alamat');
			
			$file = $_FILES['myfile'];
			if($file){
				//pr('ss');exit;
				$path = $CONFIG['LOCAL_PUBLIC_ASSET']."profile/";
				$uploadimage= $this->uploadHelper->uploadThisImage($file,$path);
				$filenya=$uploadimage['arrImage']['filename'];
			}else{
				$filenya='';
			}
			
			//pr($filenya);exit;		
			//$result=$this->chapterHelper->editprofile($filenya,$data,$this->user->user_id);
			$editprofile=$this->memberHelper->editprofile($filenya,$data,$this->user->user_id);
			if($editprofile){
				sendRedirect("{$CONFIG['BASE_DOMAIN']}member");
				return $this->out(TEMPLATE_DOMAIN_WEB . '/login_message.html');
				die();
			}
		}
		
	}
	function editchapter()
	{
	global $CONFIG;

	
	$paramid=$this->_request('param');
	if($this->user->user_id==$paramid)
		{
			$result=$this->chapterHelper->selecteprofileedit($this->user->id);
			//pr($result);exit;
			//decrypt($result['password']);
			$this->assign('profile',$result);
			$this->assign('password',$this->decrypt($result['password']));
			return $this->View->toString(TEMPLATE_DOMAIN_WEB .'/apps/editchapter.html');
		}else{
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
 function deleteevent()
	{

	pr('ss');exit;
	
	
	}
	
	function hapusevent(){
		if($this->user)
		{
		//pr('ss');exit;
		$idevent=$this->_g('event');
		//pr($idevent);exit;
		$result=$this->chapterHelper->hapusevent($idevent,$this->user->user_id);
		if($result){
			
				sendRedirect("{$CONFIG['BASE_DOMAIN']}event");				
		}
		
		}
	}
	
	
	
	protected function proseseditEvent()
	{
			global $LOCALE,$CONFIG;
			// pr($this->user);die;
		if($this->user)
		{
			$data['placename']=$this->_p('placename');
			$data['events']=$this->_p('events');
			$data['catevent']=$this->_p('catevent');
			$data['jumlahpeserta']=$this->_p('jumlahpeserta');
			$data['lang']=$this->_p('lang');
			$data['lat']=$this->_p('lat');
			$data['alamat']=$this->_p('alamat');
			$data['idevent']=$this->_p('idevent');
			$data['datestart']=date('Y-m-d H:i:s',strtotime($this->_p('tgl1').' '.$this->_p('jam1')));
			$data['datefinish']=date('Y-m-d H:i:s',strtotime($this->_p('tgl2').' '.$this->_p('jam2')));
			// pr($data);die;
			$result=$this->chapterHelper->proseseditEvent($data,$this->user->user_id);
			if($result)
			{
				sendRedirect("{$CONFIG['BASE_DOMAIN']}chapter/profile");
				return $this->out(TEMPLATE_DOMAIN_WEB . '/login_message.html');
				die();
			}
			die;
			// return $this->View->toString(TEMPLATE_DOMAIN_WEB .'/apps/addmember.html');
		}
		else
		{
				sendRedirect("{$CONFIG['BASE_DOMAIN']}home");
				return $this->out(TEMPLATE_DOMAIN_WEB . '/login_message.html');
				die();
		}
		
		
	}
	function eventDetail()
	{
		global $LOCALE,$CONFIG;
	//pr($_REQUEST);exit;	
	
		
			//pr($_FILES['myfile']);
			$myfile = $_FILES['myfile'];
			$datafile='';
			if($myfile['name'][0])
			{	
					$jumlahHalaman = count($myfile['name']);
					$datafile=array();
					if($userlize)
					{
						$datafile=$userlize;
					
					}
					
					for($i=0;$i<=$jumlahHalaman-1;$i++)
					{
						$img['name']=@$myfile['name'][$i];
						$img['type']=@$myfile['type'][$i];
						$img['tmp_name']=@$myfile['tmp_name'][$i];
						$img['error']=@$myfile['error'][$i];
						$img['size']=@$myfile['size'][$i];
						
						if(@$img['name'] != ''||@$img['type'] != '')
						{
							//pr($myfile);exit;
							$path = $CONFIG['LOCAL_PUBLIC_ASSET']."uploadfoto/";
							$uploadnews = $this->uploadHelper->uploadThisFile($img,$path);
							
							$filenamenya=$uploadnews['arrFile']['filename'];
							$datafile['file'][$i+$jumlahserliaze]['name']=$filenamenya;
							$datafile['file'][$i+$jumlahserliaze]['type']=$img['type'];
						}
						
					}
					
					if(isset($_POST['imagessementara'][0]))
					{
						$counttemp=count($_POST['imagessementara']);
						for($j=0;$j<=$counttemp-1;$j++)
						{
							$i++;
							$datafile['file'][$i+$jumlahserliaze]['name']=@$_POST['imagessementara'][$j];
							$datafile['file'][$i+$jumlahserliaze]['type']=$_POST['typeimagessementara'][$j];
						}
					}
					
					
					$filenamenya=serialize($datafile);
					$idevent=$this->_p('idevent');
					$result=$this->chapterHelper->Addfoto($idevent,$filenamenya);
			}else{
				
				if(isset($_POST['imagessementara'][0]))
					{
						$counttemp=count($_POST['imagessementara']);
						for($j=0;$j<=$counttemp-1;$j++)
						{
							
							$datafile['file'][$j]['name']=@$_POST['imagessementara'][$j];
							$datafile['file'][$j]['type']=$_POST['typeimagessementara'][$j];
						}
					}
				
				$filenamenya=serialize($datafile);
				$idevent=$this->_p('idevent');
				$result=$this->chapterHelper->Addfoto($idevent,$filenamenya);
			}
		
		//pr('ss');exit;	
				
		if($this->user)
		{
			$idevent=$this->_g('event');
			// pr($idevent);
			
			$result=$this->chapterHelper->getEvent($idevent,$this->user->user_id);
			//pr($result);exit;
			$resultpeserta=$this->chapterHelper->getEventpeserta($idevent,$this->user->user_id);
			// pr($result);die;
			$this->assign('dataevent',$result[0]); 
			$this->assign('upload_foto',$result[0]['upload_foto']); 
			$this->assign('idevent',$idevent); 
			$this->assign('dataeventpeserta',$resultpeserta); 
			return $this->View->toString(TEMPLATE_DOMAIN_WEB .'/apps/eventdetail.html');
		}
		else
		{
				sendRedirect("{$CONFIG['BASE_DOMAIN']}home");
				return $this->out(TEMPLATE_DOMAIN_WEB . '/login_message.html');
				die();
		}
		
		
	}
	protected function tantangan()
	{
		if($this->user)
		{
			$result=$this->tantanganHelper->tantangan($this->user->user_id);
			$resultold=$this->tantanganHelper->tantanganold($this->user->user_id);
			// pr($resultold);
			$this->assign('datatantangan',$result); 
			$this->assign('datatantanganold',$resultold);
		
			
			return $this->View->toString(TEMPLATE_DOMAIN_WEB .'/apps/tantangan.html');
		}
		else
		{
				sendRedirect("{$CONFIG['BASE_DOMAIN']}home");
				return $this->out(TEMPLATE_DOMAIN_WEB . '/login_message.html');
				die();
		}
		
		
	}
	protected function detailtantangan()
	{
		if($this->user)
		{
			$idTantangan=$this->_g('id');
			$result=$this->tantanganHelper->getTantangan($idTantangan,$this->user->user_id);
			$resultpeserta=$this->tantanganHelper->getTantanganpeserta($idTantangan,$this->user->user_id);
			// pr($result);die;
			$this->assign('datatantangan',$result); 
			$this->assign('datatantanganpeserta',$resultpeserta);
			return $this->View->toString(TEMPLATE_DOMAIN_WEB .'/apps/detailtantangan.html');
		}
		else
		{
				sendRedirect("{$CONFIG['BASE_DOMAIN']}home");
				return $this->out(TEMPLATE_DOMAIN_WEB . '/login_message.html');
				die();
		}
		
		
	}
	protected function addtantangan()
	{
		if($this->user)
		{
			
			return $this->View->toString(TEMPLATE_DOMAIN_WEB .'/apps/addtantangan.html');
		}
		else
		{
				sendRedirect("{$CONFIG['BASE_DOMAIN']}home");
				return $this->out(TEMPLATE_DOMAIN_WEB . '/login_message.html');
				die();
		}
		
		
	}
	protected function prosesaddtantangan()
	{
		if($this->user)
		{
			
			$data['name']=$this->_p('name');
			$data['keterangan']=$this->_p('keterangan');
			$data['kat']=$this->_p('kat');
			$data['subcat']=$this->_p('subcat');
			
			$data['jmlhpoint']=$this->_p('jmlhpoint');
			$data['jmlcoint']=$this->_p('jmlcoint');
			$data['mediasocial']=$this->_p('mediasocial');
			$data['datestart']=date('Y-m-d H:i:s',strtotime($this->_p('tgl1').' '.$this->_p('jam1')));
			$data['datefinish']=date('Y-m-d H:i:s',strtotime($this->_p('tgl2').' '.$this->_p('jam2')));
			// pr($data);die;
			$result=$this->tantanganHelper->prosesadTantangan($data,$this->user->user_id);
			if($result)
			{
				sendRedirect("{$CONFIG['BASE_DOMAIN']}profile");
				return $this->out(TEMPLATE_DOMAIN_WEB . '/login_message.html');
				die();
			}
			die;
			
			// return $this->View->toString(TEMPLATE_DOMAIN_WEB .'/apps/addtantangan.html');
		}
		else
		{
				sendRedirect("{$CONFIG['BASE_DOMAIN']}home");
				return $this->out(TEMPLATE_DOMAIN_WEB . '/login_message.html');
				die();
		}
		
		
	}
	protected function encrypt($string)
	{	
		// $ENC_KEY='youknowwho2014';
		$ENC_KEY='123456';
		return base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5($ENC_KEY), $string, MCRYPT_MODE_CBC, md5(md5($ENC_KEY))));
	}
	protected function decrypt($encrypted)
	{
		$ENC_KEY='123456';
		return rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, md5($ENC_KEY), base64_decode($encrypted), MCRYPT_MODE_CBC, md5(md5($ENC_KEY))), "\0");
	}
}
?>
