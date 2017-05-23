<?php
class chaptermanagement extends App{

	function beforeFilter(){
		global $LOCALE,$CONFIG;
		
		$this->chapterHelper = $this->useHelper('chapterHelper');
		$this->uploadHelper = $this->useHelper('uploadHelper');
		$this->assign('basedomain', $CONFIG['ADMIN_DOMAIN']);
		$this->assign('basedomainpath', $CONFIG['BASE_DOMAIN_PATH']);
		$this->assign('assets_domain', $CONFIG['ASSETS_DOMAIN_ADMIN']);
		$this->assign('locale', $LOCALE[1]);		
		$this->assign('pages', strip_tags($this->_g('page')));
		$this->assign('user',$this->user);
	}
	
	function main($start=null,$limit=1){

		if($this->_request('paramactive')){
		
			$activestatus = $this->chapterHelper->activestatus($id=$this->_request('paramactive'));
		}
		if($this->_request('paraminactive')){
		
			$inactivestatus = $this->chapterHelper->inactivestatus($id=$this->_request('paraminactive'));
		}
		if($this->_request('paramcancel')){
		
			$cancelstatus = $this->chapterHelper->cancelstatus($id=$this->_request('paramcancel'));
		}
		
		
		$listcity=$this->chapterHelper->selectcity();
                $this->assign('listcity',$listcity);

                $listclub=$this->chapterHelper->selectclub();
                $this->assign('listclub',$listclub);

		$chapterList = $this->chapterHelper->chapter($start=null,$limit=10);
		//pr($chapterList);exit;
		$time['time'] = '%H:%M:%S';
		
		$this->assign('total',$chapterList['total']);
		$this->assign('list',$chapterList['result']);
		
		return $this->View->toString(TEMPLATE_DOMAIN_ADMIN .'/apps/listchapter.html');
	}
	
	function pagingchapter(){
//pr('ss');exit;
		
		$chapterList = $this->chapterHelper->chapter($start=null,$limit=10);
		//pr($storyList);exit;
		if($chapterList==true){
		print json_encode(array('status'=>true,'data'=>$chapterList['result'],'total'=>$chapterList['total']));
		}else{ 
			print json_encode(array('status'=>false));
		}
		
		exit;
		
	}
	function addchapter(){
	global $LOCALE,$CONFIG;
	if(isset($_POST['submit']))
	{
	
	   $data['name']=strip_tags($this->_p('name'));
	   $data['abbr']=$this->_p('abbr');
	   $data['chapterCode']=$this->_p('chapterCode');
	   $data['AddressLine1']=$this->_p('AddressLine1');
	   $data['AddressLine2'] =$this->_p('AddressLine2');
	   $data['District'] =$this->_p('District');
	   $data['SubDistrict'] =$this->_p('SubDistrict');
	   $data['City'] =$this->_p('City');
	   $data['Postcode'] =$this->_p('Postcode');
	   $data['Phone'] =$this->_p('Phone');
	   $data['Facs'] =$this->_p('Facs');
	   $data['Latitude']=$this->_p('Latitude');
	   $data['Longitude'] =$this->_p('Longitude');
	   $data['Information'] =$this->_p('Information');
	   $data['Day'] =$this->_p('Day');
	   $data['Opening']=$this->_p('Opening');
	   $data['Closing'] =$this->_p('Closing');
	   $data['TimeZone']=$this->_p('TimeZone');
	   $data['id']=$this->_p('id');
			
		$editchapter = $this->chapterHelper->addchapter($data);
		
		if($editchapter)
		{
			sendredirect($CONFIG['ADMIN_DOMAIN'].'chapter');
		}
	}
	
	return $this->View->toString(TEMPLATE_DOMAIN_ADMIN .'/apps/addchapter.html');
	
	}
	function hapus(){

	//pr('ss');exit;
	$inisiasi=$this->_g('param');
	$deletechapter = $this->chapterHelper->deletechapter($inisiasi);
	if($deletechapter==true)
			{
				sendredirect('chapter');
				die;
			}	
	
	}
		
	function checkit(){

		
		$storyList = $this->chapterHelper->checkchapter();
		//pr($storyList);exit;
		if($storyList==true){
		print json_encode(array('status'=>true));
		}else{ 
			print json_encode(array('status'=>false));
		}
		
		exit;
		
	}
	
	
	function incheckit(){

		
		$storyList = $this->chapterHelper->checkinactives();
		//pr($storyList);exit;
		if($storyList==true){
		print json_encode(array('status'=>true));
		}else{ 
			print json_encode(array('status'=>false));
		}
		
		exit;
		
	}
	
	
	function editchapter(){
	global $LOCALE,$CONFIG;
	//pr('ss');exit;
	//pr($_POST);exit;
	
	if(isset($_POST['submit']))
	{
	
	   $data['name']=strip_tags($this->_p('name'));
	   $data['abbr']=$this->_p('abbr');
	   $data['chapterCode']=$this->_p('chapterCode');
	   $data['AddressLine1']=$this->_p('AddressLine1');
	   $data['AddressLine2'] =$this->_p('AddressLine2');
	   $data['District'] =$this->_p('District');
	   $data['SubDistrict'] =$this->_p('SubDistrict');
	   $data['City'] =$this->_p('City');
	   $data['Postcode'] =$this->_p('Postcode');
	   $data['Phone'] =$this->_p('Phone');
	   $data['Facs'] =$this->_p('Facs');
	   $data['Latitude']=$this->_p('Latitude');
	   $data['Longitude'] =$this->_p('Longitude');
	   $data['Information'] =$this->_p('Information');
	   $data['Day'] =$this->_p('Day');
	   $data['Opening']=$this->_p('Opening');
	   $data['Closing'] =$this->_p('Closing');
	   $data['TimeZone']=$this->_p('TimeZone');
	   $data['id']=$this->_p('id');
			
		$editchapter = $this->chapterHelper->editchapter($data);
		
		if($editchapter)
		{
			sendredirect($CONFIG['ADMIN_DOMAIN'].'chapter');
		}
	}
	$inisiasi=$this->_g('param');	
	$selectchapter = $this->chapterHelper->selectchapter($inisiasi);
	//pr($selectchapter);exit;
	
	$this->assign('listnya',$selectchapter);
	
	return $this->View->toString(TEMPLATE_DOMAIN_ADMIN .'/apps/editchapter.html');
	}
	
	
}
?>
