<?php
class puzzle extends App{

	function beforeFilter(){
		global $LOCALE,$CONFIG;
		
		$this->puzzleHelper = $this->useHelper('puzzleHelper');
		$this->memberHelper = $this->useHelper('memberHelper');	
		$this->loginHelper = $this->useHelper('loginHelper');
		$this->assign('basedomain',$CONFIG['BASE_DOMAIN']); 
		$this->assign('basedomainpath', $CONFIG['BASE_DOMAIN_PATH']);
		$this->assign('assets_domain', $CONFIG['ASSETS_DOMAIN_ADMIN']);
		$this->assign('locale', $LOCALE[1]);		
		$this->assign('pages', strip_tags($this->_g('page')));
		$this->user=$this->session->getSession($this->config['SESSION_NAME'],"WEB");
		$this->assign('user',$this->user);
	}
	
	function main(){
		global $LOCALE,$CONFIG;
		$memberprofile=$this->memberHelper->memberprofile($this->user->user_id);

		$puzzle=$this->puzzleHelper->puzzle();
		if($puzzle){
			$status_puzzle='active';
		}
		$chapter_member=$memberprofile['chapter_id'];
		$this->assign('memberprofile',$memberprofile);
		$this->assign('status_puzzle',$status_puzzle);
		$this->assign('puzzle_id',$puzzle['id']);
		$this->assign('gbr_kecil',$puzzle['gbr_kecil']);	
		$this->assign('gbr_besar',$puzzle['gbr_besar']);
		
		if($memberprofile){
			return $this->View->toString(TEMPLATE_DOMAIN_WEB .'apps/puzzle.html');
		}else
		{
				sendRedirect("{$CONFIG['BASE_DOMAIN']}home");
		}
		
	}
	
	function savedata(){
		$ulangpuzzle=$this->puzzleHelper->ulangpuzzle($this->user->user_id);
		
		if($ulangpuzzle['total']<=10){
		$puzzleList = $this->puzzleHelper->savedata();
		}
		
		if($puzzleList==true){
		print json_encode(array('status'=>true));
		}else{ 
			print json_encode(array('status'=>false));
		}
		
		exit;
		
	}
	
			
}
?>
