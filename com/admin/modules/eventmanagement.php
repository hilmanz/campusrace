<?php
class eventmanagement extends App{

	function beforeFilter(){
		global $LOCALE,$CONFIG;
		
		$this->eventHelper = $this->useHelper('eventHelper');
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
		
			$activestatus = $this->eventHelper->activestatus($id=$this->_request('paramactive'));
		}
		if($this->_request('paraminactive')){
		
			$inactivestatus = $this->eventHelper->inactivestatus($id=$this->_request('paraminactive'));
		}
		if($this->_request('paramfinish')){

                        $inactivestatus = $this->eventHelper->finishstatus($id=$this->_request('paramfinish'));
                }
		if($this->_request('paramcancel')){
		
			$cancelstatus = $this->eventHelper->cancelstatus($id=$this->_request('paramcancel'));
		}
		
		
		$eventList = $this->eventHelper->event($start=null,$limit=10);
		//pr($eventList);exit;
		$time['time'] = '%H:%M:%S';
		
		$this->assign('total',$eventList['total']);
		$this->assign('list',$eventList['result']);
		
		return $this->View->toString(TEMPLATE_DOMAIN_ADMIN .'/apps/listevent.html');
	}
	
	function pagingevent(){
//pr('ss');exit;
		
		$eventList = $this->eventHelper->event($start=null,$limit=10);
		//pr($storyList);exit;
		if($eventList==true){
		print json_encode(array('status'=>true,'data'=>$eventList['result'],'total'=>$eventList['total']));
		}else{ 
			print json_encode(array('status'=>false));
		}
		
		exit;
		
	}
	function addevent(){
	global $LOCALE,$CONFIG;
	if(isset($_POST['submit']))
	{
	
	   $data['name']=strip_tags($this->_p('name'));
	   $data['abbr']=$this->_p('abbr');
	   $data['eventCode']=$this->_p('eventCode');
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
			
		$editevent = $this->eventHelper->addevent($data);
		
		if($editevent)
		{
			sendredirect($CONFIG['ADMIN_DOMAIN'].'event');
		}
	}
	
	return $this->View->toString(TEMPLATE_DOMAIN_ADMIN .'/apps/addevent.html');
	
	}
	function hapus(){

	//pr('ss');exit;
	$inisiasi=$this->_g('param');
	$deleteevent = $this->eventHelper->deleteevent($inisiasi);
	if($deleteevent==true)
			{
				sendredirect('event');
				die;
			}	
	
	}
		
	function checkit(){

		
		$storyList = $this->eventHelper->checkevent();
		//pr($storyList);exit;
		if($storyList==true){
		print json_encode(array('status'=>true));
		}else{ 
			print json_encode(array('status'=>false));
		}
		
		exit;
		
	}
	
	
	function incheckit(){

		
		$storyList = $this->eventHelper->checkinactives();
		//pr($storyList);exit;
		if($storyList==true){
		print json_encode(array('status'=>true));
		}else{ 
			print json_encode(array('status'=>false));
		}
		
		exit;
		
	}
	
	
	function editevent(){
	global $LOCALE,$CONFIG;
	//pr('ss');exit;
	//pr($_POST);exit;
	
	if(isset($_POST['submit']))
	{
	
	   $data['name']=strip_tags($this->_p('name'));
	   $data['abbr']=$this->_p('abbr');
	   $data['eventCode']=$this->_p('eventCode');
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
			
		$editevent = $this->eventHelper->editevent($data);
		
		if($editevent)
		{
			sendredirect($CONFIG['ADMIN_DOMAIN'].'event');
		}
	}
	$inisiasi=$this->_g('param');	
	$selectevent = $this->eventHelper->selectevent($inisiasi);
	//pr($selectevent);exit;
	
	$this->assign('listnya',$selectevent);
	
	return $this->View->toString(TEMPLATE_DOMAIN_ADMIN .'/apps/editevent.html');
	}
	
	
}
?>
