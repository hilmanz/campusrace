<?php
	class challangemanagement extends App{
		function beforeFilter(){
			global $LOCALE,$CONFIG;
			
			$this->challangeHelper = $this->useHelper('challangeHelper');
			$this->uploadHelper = $this->useHelper('uploadHelper');
			$this->assign('basedomain', $CONFIG['ADMIN_DOMAIN']);
			$this->assign('basedomainpath', $CONFIG['BASE_DOMAIN_PATH']);
			$this->assign('assets_domain', $CONFIG['ASSETS_DOMAIN_ADMIN']);
			$this->assign('locale', $LOCALE[1]);		
			$this->assign('pages', strip_tags($this->_g('page')));
			$this->assign('user',$this->user);
		}
		
		function main($start=null,$limit=1){
			global $LOCALE,$CONFIG;
			
			if($this->_request('paramactive')){		
				$activestatus = $this->challangeHelper->activestatus($id=$this->_request('paramactive'));
			}
			
			if($this->_request('paraminactive')){		
				$inactivestatus = $this->challangeHelper->inactivestatus($id=$this->_request('paraminactive'));
			}
			
			if($this->_request('paramfinish')){		
				$finishstatus = $this->challangeHelper->finishstatus($id=$this->_request('paramfinish'));
			}
			
			if($this->_request('paramcancel')){		
				$cancelstatus = $this->challangeHelper->cancelstatus($id=$this->_request('paramcancel'));
			}
			
			if(isset($_POST['submit']))
			{
			
			   //$data['chapter_id']=strip_tags($this->_p('chapter_id'));
			   $data['name']=strip_tags($this->_p('name'));
			   $data['description']=$this->_p('description');
			   $data['datestart']=date('Y-m-d 23:59:59',strtotime($this->_p('start_time')));
			   $data['dateend']=date('Y-m-d 23:59:59',strtotime($this->_p('end_time')));
			   $data['category'] =$this->_p('category');
			   $data['hastags'] =$this->_p('hastags');
			   $data['url'] =$this->_p('url');
			   $data['idnya']=$this->_p('idnya');
			   //$data['chapter_id']=$_POST['chapter_id'];
			   //pr($data);exit;
					
				$editchallange = $this->challangeHelper->editchallange($data);
				
				if($editchallange)
				{
					sendredirect($CONFIG['ADMIN_DOMAIN'].'challangemanagement');
				}
			}
			
			$this->assign('status',@$this->_request('status'));
			$this->assign('category',@$this->_request('category'));
			$this->assign('startdate',@$this->_request('startdate'));
			$this->assign('enddate',@$this->_request('enddate'));
			$this->assign('search',@$this->_request('search'));
			
			$listmember=$this->challangeHelper->listmember();		
			$this->assign("listmember",$listmember);
			
			$challangelist = $this->challangeHelper->challange($start=null,$limit=10);
			$time['time'] = '%H:%M:%S';
			
			$this->assign('total',$challangelist['total']);
			$this->assign('list',$challangelist['result']);
			
			return $this->View->toString(TEMPLATE_DOMAIN_ADMIN .'/apps/listchalange.html');
		}
		
		function editchallange(){
			global $LOCALE,$CONFIG;
			//pr('ss');exit;
			//pr($_POST);exit;
			
			if(isset($_POST['submit']))
			{
			
			   //$data['chapter_id']=strip_tags($this->_p('chapter_id'));
			   $data['name']=strip_tags($this->_p('name'));
			   $data['description']=$this->_p('description');
			   $data['datestart']=date('Y-m-d 23:59:59',strtotime($this->_p('start_time')));
			   $data['dateend']=date('Y-m-d 23:59:59',strtotime($this->_p('end_time')));
			   $data['category'] =$this->_p('category');
			   $data['hastags'] =$this->_p('hastags');
			   $data['url'] =$this->_p('url');
			   $data['idnya']=$this->_p('idnya');
			   $data['chapter_id']=$_POST['chapter_id'];
			   //pr($data);exit;
					
				$editchallange = $this->challangeHelper->editchallange($data);
				
				if($editchallange)
				{
					sendredirect($CONFIG['ADMIN_DOMAIN'].'challangemanagement');
				}
			}
			
			$inisiasi=$this->_g('param');	
			$selectmember = $this->challangeHelper->selectchallange($inisiasi);
			$selectchap = $this->challangeHelper->selectchap();
			$selectcat = $this->challangeHelper->selectcat();
			//pr($inisiasi);exit;
			
			$this->assign('listnya',$selectmember);
			$this->assign('listchap',$selectchap);
			$this->assign('listcat',$selectcat);
			
			return $this->View->toString(TEMPLATE_DOMAIN_ADMIN .'/apps/editchallange.html');
		}
		
		function pagingchallange(){
//pr('ss');exit;
		
		$challangeList = $this->challangeHelper->challange($start=null,$limit=10);
		//pr($storyList);exit;
		if($challangeList==true){
		print json_encode(array('status'=>true,'data'=>$challangeList['result'],'total'=>$challangeList['total']));
		}else{ 
			print json_encode(array('status'=>false));
		}
		
		exit;
		
	}
		
		function addchallange(){
			global $LOCALE,$CONFIG;
			
			
			if(isset($_POST['submit']))
			{			
			   
				//$data['member_id'] =$_POST['member_id'];
				$data['name']=$this->_p('name');		
				$data['description']=$this->_p('description');		
				$data['start_time'] =$this->_p('start_time');
				$data['hastags'] =$this->_p('hastags');
				$data['category'] =$this->_p('category');
				$data['end_time'] =$this->_p('end_time');
				$data['url'] =$this->_p('url');
				$data['datestart']=date('Y-m-d 00:00:00',strtotime($this->_p('start_time')));
				$data['dateend']=date('Y-m-d 23:59:59',strtotime($this->_p('end_time')));
						
				$addmember = $this->challangeHelper->addchallange($data);
				//pr($data);exit;
				if($addmember)
				{
					sendredirect($CONFIG['ADMIN_DOMAIN'].'challangemanagement');
				}
			}
			//pr($data);exit;
				$listmember=$this->challangeHelper->listmember();		
				$this->assign("listmember",$listmember);
				//$selectchap = $this->challangeHelper->selectchap();
				//pr($selectchap);exit;
				//$this->assign('listchap',$selectchap);
			
			return $this->View->toString(TEMPLATE_DOMAIN_ADMIN .'/apps/addchallange.html');
		
		}
	}

?>
