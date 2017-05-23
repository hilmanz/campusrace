<?php
class membermanagement extends App{

	function beforeFilter(){
		global $LOCALE,$CONFIG;
		
		$this->memberHelper = $this->useHelper('memberHelper');
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
		
			$activestatus = $this->memberHelper->activestatus($id=$this->_request('paramactive'));
		}
		if($this->_request('paraminactive')){
		
			$inactivestatus = $this->memberHelper->inactivestatus($id=$this->_request('paraminactive'));
		}
		if($this->_request('paramcancel')){			
		
			$cancelstatus = $this->memberHelper->cancelstatus($id=$this->_request('paramcancel'));
		}

		if(isset($_GET['submit']))
		{
		$this->assign('kampus',@$this->_request('kampus'));
		$this->assign('status',@$this->_request('status'));
		$this->assign('points',@$this->_request('points'));
		$this->assign('startdate',@$this->_request('startdate'));
		$this->assign('enddate',@$this->_request('enddate'));
		$this->assign('search',@$this->_request('search'));
		$this->assign('chapternya',@$this->_request('chapternya'));
		
		

		$memberList = $this->memberHelper->member($start=null,$limit=10);				 
		}
		
		if(strip_tags($this->_g('download'))=='report'){				
		$downloadListmember = $this->memberHelper->downloadListmember();
		$data['data']=$downloadListmember;
		$this->callsheaderphpxls($data);
		}
		
		$chapter=$this->memberHelper->listchapter();
		$this->assign('chapter',$chapter);
		
		$listkampus=$this->memberHelper->listkampus();
        $this->assign('listkampus',$listkampus);

		$memberList = $this->memberHelper->member($start=null,$limit=10);

		$time['time'] = '%H:%M:%S';
		
		$this->assign('total',$memberList['total']);
		$this->assign('list',$memberList['result']);
		
		return $this->View->toString(TEMPLATE_DOMAIN_ADMIN .'/apps/listmember.html');
	}
	
	function pagingmember(){
		global $LOCALE,$CONFIG;
		
		$this->assign('status',@$this->_request('status'));
		$this->assign('points',@$this->_request('points'));
		$this->assign('startdate',@$this->_request('startdate'));
		$this->assign('enddate',@$this->_request('enddate'));
		$this->assign('search',@$this->_request('search'));
		$this->assign('chapternya',@$this->_request('chapternya'));

		$memberList = $this->memberHelper->member($start=null,$limit=10);
		//pr($memberList);exit;
		if($memberList==true){
		print json_encode(array('status'=>true,'data'=>$memberList['result'],'total'=>$memberList['total']));
		}else{ 
			print json_encode(array('status'=>false));
		}
		
		exit;
		
	}
	function addmember(){
	global $LOCALE,$CONFIG;
	
		$listchap=$this->memberHelper->selectchap();
		
		$this->assign("listchap",$listchap);
	if(isset($_POST['submit']))
	{
	
	   /**$data['name']=strip_tags($this->_p('name'));
	   $data['abbr']=$this->_p('abbr');
	   $data['memberCode']=$this->_p('memberCode');
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
	   $data['id']=$this->_p('id');**/
	   
		$data['chapter_id'] =$this->_p('chapter_id');
		$data['name']=$this->_p('name');		
		$data['email']=$this->_p('email');		
		$data['ktp_sim'] =$this->_p('ktp_sim');
		$data['alamat'] =$this->_p('alamat');
		$data['fb_id'] =$this->_p('fb_id');
		$data['twitter_id'] =$this->_p('twitter_id');
		$data['date_register'] =$this->_p('date_register');
		$data['no_tlp'] =$this->_p('no_tlp');
				
		//pr($data);exit;
		$addmember = $this->memberHelper->addmember($data);
		//pr($data);exit;
		if($addmember)
		{
			sendredirect($CONFIG['ADMIN_DOMAIN'].'membermanagement');
		}
	}
	
	return $this->View->toString(TEMPLATE_DOMAIN_ADMIN .'/apps/addmember.html');
	
	}
	function hapus(){

	//pr('ss');exit;
	$inisiasi=$this->_g('param');
	$deletemember = $this->memberHelper->deletemember($inisiasi);
	if($deletemember==true)
			{
				sendredirect('member');
				die;
			}	
	
	}
		
	function checkit(){

		
		$storyList = $this->memberHelper->checkmember();
		//pr($storyList);exit;
		if($storyList==true){
		print json_encode(array('status'=>true));
		}else{ 
			print json_encode(array('status'=>false));
		}
		
		exit;
		
	}
	
	
	function incheckit(){

		
		$storyList = $this->memberHelper->checkinactives();
		//pr($storyList);exit;
		if($storyList==true){
		print json_encode(array('status'=>true));
		}else{ 
			print json_encode(array('status'=>false));
		}
		
		exit;
		
	}
	
	
	function editmember(){
	global $LOCALE,$CONFIG;
	//pr('ss');exit;
	//pr($_POST);exit;
	
	if(isset($_POST['submit']))
	{
	
	   $data['name']=strip_tags($this->_p('name'));
	   $data['email']=$this->_p('email');
	   $data['no_tlp']=$this->_p('no_tlp');
	   $data['idktp']=$this->_p('idktp');
	   $data['facebook']=$this->_p('facebook');
	   $data['twitter'] =$this->_p('twitter');
	   $data['password'] =$this->_p('password');
	   //$data['nama_chapter'] =$this->_p('nama_chapter');
	   $data['idnya']=$this->_p('idnya');
			
		$editmember = $this->memberHelper->editmember($data);
		
		if($editmember)
		{
			sendredirect($CONFIG['ADMIN_DOMAIN'].'membermanagement');
		}
	}
	$inisiasi=$this->_g('param');	
	$selectmember = $this->memberHelper->selectmember($inisiasi);
	//pr($selectmember);exit;
	
	$this->assign('listnya',$selectmember);
	
	return $this->View->toString(TEMPLATE_DOMAIN_ADMIN .'/apps/editmember.html');
	}
	
	function checkEmail()
	{
		
			$data['email']=$this->_p('email');
			$result=$this->memberHelper->checkEmail($data);
			
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
	
	function callsheaderphpxls($data=null,$file='download-data'){
		GLOBAL $ENGINE_PATH, $CONFIG, $LOCALE;
		//pr($ENGINE_PATH."Utility/PHPExcel.php");die;
		 
			
			require_once $ENGINE_PATH."Utility/PHPExcel.php";
			$styleArray = array(
				  'borders' => array(
					'allborders' => array(
					  'style' => PHPExcel_Style_Border::BORDER_THIN
					 
					)
				  )
				);
		
			$objPHPExcel = new PHPExcel();
			$objPHPExcel->setActiveSheetIndex(0);
			$objPHPExcel->getActiveSheet()->SetCellValue('A2','No');
			//$objPHPExcel->getActiveSheet()->SetCellValue('E1','DETAIL INFORMATION OWNER');
			// costumer_id
			$objPHPExcel->getActiveSheet()->SetCellValue('B2','NAMA MEMBER');
			$objPHPExcel->getActiveSheet()->SetCellValue('C2','EMAIL');
			$objPHPExcel->getActiveSheet()->SetCellValue('D2','TYPE LOGIN');
			$objPHPExcel->getActiveSheet()->SetCellValue('E2','NO TELP');
			$objPHPExcel->getActiveSheet()->SetCellValue('F2','KAMPUS');
			$objPHPExcel->getActiveSheet()->SetCellValue('G2','ID KTP/SIM');
			$objPHPExcel->getActiveSheet()->SetCellValue('H2','AKUN FACEBOOK');
			$objPHPExcel->getActiveSheet()->SetCellValue('I2','AKUN TWITTER');
			$objPHPExcel->getActiveSheet()->SetCellValue('J2','REGISTER DATE');
			$objPHPExcel->getActiveSheet()->SetCellValue('K2','INFO POINT');
			$objPHPExcel->getActiveSheet()->SetCellValue('L2','STATUS');
			$jumlahdata=count($data['data'])+2;
			//pr($jumlahdata);exit;
			$objPHPExcel->getActiveSheet()->getStyle('A2:L2')->getFont()->setBold(true);
			$objPHPExcel->getActiveSheet()->getStyle('A2:L'.$jumlahdata.'')->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->getStyle('A2:L2')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FF808080');
			
			/* $objPHPExcel->getActiveSheet()->getStyle('E1:O'.$jumlahdata.'')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('#CCFFCC');  */
			//pr($data);exit;
			
			$rowCount = 3;
			$no=1;
			foreach($data['data'] as $each){
				
				$objPHPExcel->getActiveSheet()->SetCellValue('A'.$rowCount,$no);
				$objPHPExcel->getActiveSheet()->SetCellValue('B'.$rowCount,$each['name']);
				//$objPHPExcel->getActiveSheet()->SetCellValue('C'.$rowCount,$each['date_register']);
				$objPHPExcel->getActiveSheet()->SetCellValue('C'.$rowCount,$each['username']);
				$objPHPExcel->getActiveSheet()->SetCellValue('D'.$rowCount,$each['typenya']);
				$objPHPExcel->getActiveSheet()->SetCellValue('E'.$rowCount,$each['no_tlp']);
				$objPHPExcel->getActiveSheet()->SetCellValue('F'.$rowCount,$each['kampus']);
				$objPHPExcel->getActiveSheet()->SetCellValue('G'.$rowCount,$each['ktp_sim']);
				$objPHPExcel->getActiveSheet()->SetCellValue('H'.$rowCount,$each['fb_id']);
				$objPHPExcel->getActiveSheet()->SetCellValue('I'.$rowCount,$each['twiiter_id']);
				$objPHPExcel->getActiveSheet()->SetCellValue('J'.$rowCount,$each['date_register']);
				$objPHPExcel->getActiveSheet()->SetCellValue('K'.$rowCount,$each['point_total']);
				$objPHPExcel->getActiveSheet()->SetCellValue('L'.$rowCount,$each['statusnya']);
				

				

				$rowCount++;
				$no++;
				
			}
			$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
			$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
			$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
			$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
			$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
			
				// pr($objPHPExcel);die;
			$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
			ob_end_clean();
			header('Content-Type: application/vnd.ms-excel');
			header('Content-Disposition: attachment;filename="Memberuser.xls"');
			header('Cache-Control: max-age=0');
			$objWriter->save('php://output');

			die;
	
	}
	
	
}
?>
