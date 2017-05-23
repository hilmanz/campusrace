<?php
class chalangemanagement extends App{

	function beforeFilter(){
		global $LOCALE,$CONFIG;
		
		$this->chalangeHelper = $this->useHelper('chalangeHelper');
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
		
			$activestatus = $this->chalangeHelper->activestatus($id=$this->_request('paramactive'));
		}
		if($this->_request('paraminactive')){
		
			$inactivestatus = $this->chalangeHelper->inactivestatus($id=$this->_request('paraminactive'));
		}
			if($this->_request('paramcancel')){
		
			$cancelstatus = $this->chalangeHelper->cancelstatus($id=$this->_request('paramcancel'));
		}
		
		
		$chalangeList = $this->chalangeHelper->chalange($start=null,$limit=10);
		pr($chalangeList);exit;
		$time['time'] = '%H:%M:%S';
		
		$this->assign('total',$chalangeList['total']);
		$this->assign('list',$chalangeList['result']);
		
		return $this->View->toString(TEMPLATE_DOMAIN_ADMIN .'/apps/listchalange.html');
	}
	
	function pagingchalange(){
//pr('ss');exit;
		
		$chalangeList = $this->chalangeHelper->chalange($start=null,$limit=10);
		//pr($storyList);exit;
		if($chalangeList==true){
		print json_encode(array('status'=>true,'data'=>$chalangeList['result'],'total'=>$chalangeList['total']));
		}else{ 
			print json_encode(array('status'=>false));
		}
		
		exit;
		
	}
	function addchalange(){
	global $LOCALE,$CONFIG;
	if(isset($_POST['submit']))
	{
	
	   $data['name']=strip_tags($this->_p('name'));
	   $data['abbr']=$this->_p('abbr');
	   $data['chalangeCode']=$this->_p('chalangeCode');
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
			
		$editchalange = $this->chalangeHelper->addchalange($data);
		
		if($editchalange)
		{
			sendredirect($CONFIG['ADMIN_DOMAIN'].'chalange');
		}
	}
	
	return $this->View->toString(TEMPLATE_DOMAIN_ADMIN .'/apps/addchalange.html');
	
	}
	function hapus(){

	//pr('ss');exit;
	$inisiasi=$this->_g('param');
	$deletechalange = $this->chalangeHelper->deletechalange($inisiasi);
	if($deletechalange==true)
			{
				sendredirect('chalange');
				die;
			}	
	
	}
		
	function checkit(){

		
		$storyList = $this->chalangeHelper->checkchalange();
		//pr($storyList);exit;
		if($storyList==true){
		print json_encode(array('status'=>true));
		}else{ 
			print json_encode(array('status'=>false));
		}
		
		exit;
		
	}
	
	
	function incheckit(){

		
		$storyList = $this->chalangeHelper->checkinactives();
		//pr($storyList);exit;
		if($storyList==true){
		print json_encode(array('status'=>true));
		}else{ 
			print json_encode(array('status'=>false));
		}
		
		exit;
		
	}
	
	
	function editchalange(){
	global $LOCALE,$CONFIG;
	//pr('ss');exit;
	//pr($_POST);exit;
	
	if(isset($_POST['submit']))
	{
	
	   $data['name']=strip_tags($this->_p('name'));
	   $data['abbr']=$this->_p('abbr');
	   $data['chalangeCode']=$this->_p('chalangeCode');
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
			
		$editchalange = $this->chalangeHelper->editchalange($data);
		
		if($editchalange)
		{
			sendredirect($CONFIG['ADMIN_DOMAIN'].'chalange');
		}
	}
	$inisiasi=$this->_g('param');	
	$selectchalange = $this->chalangeHelper->selectchalange($inisiasi);
	//pr($selectchalange);exit;
	
	$this->assign('listnya',$selectchalange);
	
	return $this->View->toString(TEMPLATE_DOMAIN_ADMIN .'/apps/editchalange.html');
	}
	
	
}
?>