<?php
class tebakskor extends App{
	
	function beforeFilter(){
 		
		global $LOCALE,$CONFIG;
		$this->assign('basedomain',$CONFIG['BASE_DOMAIN']); 
		
		$this->memberHelper = $this->useHelper('memberHelper');	
		$this->skorHelper = $this->useHelper('skorHelper');	
		
	}
	
	function main(){
		global $LOCALE,$CONFIG;
		$memberprofile=$this->memberHelper->memberprofile($this->user->user_id);
		//pr($memberprofile);exit;
		$chapter_member=$memberprofile['chapter_id'];
		$this->assign('memberprofile',$memberprofile);
		
		$lispertandingannya=$this->memberHelper->lispertandingannya();		
		$this->assign('lispertandingannya',$lispertandingannya);
				
		$lispertandingan=$this->memberHelper->lispertandingan($this->user->user_id);		
		$this->assign('lispertandingan',$lispertandingan);
		
		$nonlispertandingan=$this->memberHelper->nonlispertandingan($this->user->user_id);		
		$this->assign('nonlispertandingan',$nonlispertandingan);
		
		if($memberprofile){
			
			return $this->View->toString(TEMPLATE_DOMAIN_WEB .'apps/tebak-skor.html');
		}else{
			sendRedirect("{$CONFIG['BASE_DOMAIN']}home");
		}	
	}
	
	function masukskor(){

		global $CONFIG;
		
		if($this->_p('submit')){
			
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
			}else{
				return $this->out(TEMPLATE_DOMAIN_WEB . '/login_message.html');
				die();
			}			
		}
		pr("ngakkkkkkk"); die;
	}
	
	function editskor(){
		global $CONFIG;
		$memberprofile=$this->memberHelper->memberprofile($this->user->user_id);
		//pr($memberprofile['chapter_id']);exit;
		$chapter_member=$memberprofile['chapter_id'];
		$this->assign('memberprofile',$memberprofile);
		
		$lispertandingannya=$this->memberHelper->lispertandingannya();		
		$this->assign('lispertandingannya',$lispertandingannya);
		//pr($lispertandingannya);die;
		$lispertandingan=$this->memberHelper->lispertandingan($this->user->user_id);		
		$this->assign('lispertandingan',$lispertandingan);
		
		
		$paramid=$this->_request('param');
		//pr($_POST);exit;
		
		/* if($this->user->user_id==$paramid)
		{
			$memberprofile=$this->memberHelper->memberprofile($this->user->user_id);
			$this->assign('editmember',$memberprofile); 
			$this->assign('password',$this->decrypt($memberprofile['password'])); 
			return $this->View->toString(TEMPLATE_DOMAIN_WEB .'/apps/tebak-skor-edit.html');
		}else{
				sendRedirect("{$CONFIG['BASE_DOMAIN']}home");
				return $this->out(TEMPLATE_DOMAIN_WEB . '/login_message.html');
				die();
		} */
		
		return $this->View->toString(TEMPLATE_DOMAIN_WEB .'/apps/tebak-skor-edit.html');
	}
	
	function proseseditskor(){
		
		global $CONFIG;
		
		if($this->_p('submit')){ 
		
			$data['skor1']=$this->_p('skor1');
			$data['skor2']=$this->_p('skor2');
			$data['skor3']=$this->_p('skor3');
			$data['skor4']=$this->_p('skor4');
			$data['skor5']=$this->_p('skor5');
			$data['skor6']=$this->_p('skor6');
			
			$data['id_member']=$this->_p('id_member');
			$data['weekid']=$this->_p('weekid');
			
			$datamasuk=$this->skorHelper->editskor($data);
			
			if($datamasuk){
				sendRedirect("{$CONFIG['BASE_DOMAIN']}tebakskor");				
			}else{
				return $this->out(TEMPLATE_DOMAIN_WEB . '/login_message.html');
				die();
			}			
		}

	}
	
	function testview(){
		return $this->View->toString(TEMPLATE_DOMAIN_WEB .'/apps/tebak-skor-view.html');
	}
	
}
?>
