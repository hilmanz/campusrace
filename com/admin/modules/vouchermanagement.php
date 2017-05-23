<?php
class vouchermanagement extends App{

	function beforeFilter(){
		global $LOCALE,$CONFIG;
		
		$this->voucherHelper = $this->useHelper('voucherHelper');
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
		
			$activestatus = $this->voucherHelper->activestatus($id=$this->_request('paramactive'));
		}
		if($this->_request('paraminactive')){
		
			$inactivestatus = $this->voucherHelper->inactivestatus($id=$this->_request('paraminactive'));
			pr($inactivestatus);exit;
		}
		if($this->_request('paramcancel')){			
		
			$cancelstatus = $this->voucherHelper->cancelstatus($id=$this->_request('paramcancel'));
		}
		
		if(isset($_POST['submit']))
		{
		
		   $data['name']=strip_tags($this->_p('name'));
		   $data['email']=$this->_p('email');
		   $data['no_tlp']=$this->_p('no_tlp');
		   $data['idktp']=$this->_p('idktp');
		   $data['facebook']=$this->_p('facebook');
		   $data['twitter'] =$this->_p('twitter');
		   //$data['password'] =$this->_p('password');
		   $data['password'] =strip_tags($this->_p('password'));
		   //$data['nama_chapter'] =$this->_p('nama_chapter');
		   $data['idnya']=$this->_p('idnya');
				
			//$editmember = $this->voucherHelper->editmember($data);
			/*
			if($editmember)
			{
				sendredirect($CONFIG['ADMIN_DOMAIN'].'membermanagement');
			}
			*/
		}
		
		if(strip_tags($this->_g('download'))=='report'){
		//pr($_GET);exit;
		
		
		
		$data['chapternya']=intval($this->_g('chapternya'));
		$data['status']=intval($this->_g('status'));
		$data['points']=$this->_g('points');
		$data['startdate']=$this->_g('startdate');
		$data['enddate']=$this->_g('enddate');
		$data['search']=$this->_g('search');
	
		$downloadListmember = $this->voucherHelper->downloadListmember($data);
		$data['data']=$downloadListmember;
		//pr($downloadListmember);exit;
		$this->callsheaderphpxls($data);
		}
		
		$this->assign('status',@$this->_request('status'));
		$this->assign('points',@$this->_request('points'));
		$this->assign('startdate',@$this->_request('startdate'));
		$this->assign('enddate',@$this->_request('enddate'));
		$this->assign('search',@$this->_request('search'));
		$this->assign('chapternya',@$this->_request('chapternya'));
		
		$chapter=$this->voucherHelper->listchapter();
		$this->assign('chapter',$chapter);
		
		$voucherList = $this->voucherHelper->voucher($start=null,$limit=10);
		//pr($voucherList);exit;
		$time['time'] = '%H:%M:%S';
		
		$this->assign('total',$voucherList['total']);
		$this->assign('list',$voucherList['result']);
		
		return $this->View->toString(TEMPLATE_DOMAIN_ADMIN .'/apps/listvoucher.html');
	}
	
	function pagingvoucher1(){
		//pr('ss');exit;
		GLOBAL $ENGINE_PATH, $CONFIG, $LOCALE;
		
	
		//pr($ENGINE_PATH."Utility/PHPExcel.php");die;
		// require_once $ENGINE_PATH."Classes/PHPExcel.php";
		 // require_once $ENGINE_PATH."Classes/PHPExcel/IOFactory.php";
			require_once $ENGINE_PATH."Utility/PHPExcel.php";
			PHPExcel_Settings::setZipClass(PHPExcel_Settings::PCLZIP);
			require_once $ENGINE_PATH."Utility/PHPExcel/IOFactory.php";
			
			//exit;
		
		//$voucherList = $this->voucherHelper->voucher($start=null,$limit=10);
		//pr($voucherList);exit;
		$inputFileType = 'CSV';
		$inputFileName = $ENGINE_PATH.'uploadxls.csv'; 

		if (file_exists($inputFileName)){
			pr("ada");
		}else{
			pr("ga ada");
		}
		//exit;
		
			try {
				$inputFileType = PHPExcel_IOFactory::identify($inputFileName);
                $objReader = PHPExcel_IOFactory::createReader($inputFileType);
				$objPHPExcel = $objReader->load($inputFileName);
				//$objPHPExcel = PHPExcel_IOFactory::load($inputFileName);
			} catch(Exception $e) {
				die('Error loading file "'.pathinfo($inputFileName,PATHINFO_BASENAME).'": '.$e->getMessage());
			}
		
			//$objPHPExcel = PHPExcel_IOFactory::load($inputFileName);


			$allDataInSheet = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);
			
			$arrayCount = count($allDataInSheet);  // Here get total count of row in that Excel sheet

			$jml=$arrayCount - 1;

			
			for($i=2;$i<=$arrayCount;$i++){
			$userName = trim($allDataInSheet[$i]["A"]);
			$userMobile = trim($allDataInSheet[$i]["B"]);
			pr("satu");
			//pr($userMobile);
		//	exit;
			}
	
		
	}
	
	function pagingvoucher(){
		//pr('ss');exit;
		global $LOCALE,$CONFIG;
		
		$this->assign('status',@$this->_request('status'));
		$this->assign('points',@$this->_request('points'));
		$this->assign('startdate',@$this->_request('startdate'));
		$this->assign('enddate',@$this->_request('enddate'));
		$this->assign('search',@$this->_request('search'));
		$this->assign('chapternya',@$this->_request('chapternya'));

		$voucherList = $this->voucherHelper->voucher($start=null,$limit=10);
		//pr($voucherList);exit;
		if($voucherList==true){
		print json_encode(array('status'=>true,'data'=>$voucherList['result'],'total'=>$voucherList['total']));
		}else{ 
			print json_encode(array('status'=>false));
		}
		
		exit;
		
	}
	function addvoucher(){
	GLOBAL $ENGINE_PATH, $CONFIG, $LOCALE;
	
		/* $listchap=$this->voucherHelper->selectchap();
		
		$this->assign("listchap",$listchap); */
	if(isset($_POST['submit']))
	{
	
	  
	   if ( isset($_FILES['voucher']['tmp_name'])) {
	   $storagename = $ENGINE_PATH.'uploadxls.csv';
	  //pr($_FILES['voucher']['tmp_name'],$storagename);exit;
		if(move_uploaded_file($_FILES['voucher']['tmp_name'],$storagename)){
				//$arrCsvData['filename'] = $filename;
				$uploadedStatus = 1;
				
			}
			
	   }		
		//pr($_FILES);exit;
		
		if($uploadedStatus)
		{
			sendredirect($CONFIG['ADMIN_DOMAIN'].'vouchermanagement');
		}
	}
	
	return $this->View->toString(TEMPLATE_DOMAIN_ADMIN .'/apps/addvoucher.html');
	
	}
	
	
	function uploadvoucer(){		
		if ( isset($_FILES["voucher"])) {
			//if there was an error uploading the file
			if ($_FILES["voucher"]["error"] > 0) {
			echo "Return Code: " . $_FILES["voucher"]["error"] . "<br />";
			}
			else {

			$test = file_get_contents($_FILES['voucher']['tmp_name']);
					$lines = explode(PHP_EOL, $test);
					$array = array();
					foreach ($lines as $line) {
						$array[] = str_getcsv($line);
					}	
					
					foreach($array as $val){
						if(isset($val[0])){							
							$data=$val[0];
							$date = date('Y-m-d',strtotime($val[0]));			
							//$insertTable= mysql_query("insert into peserta (no_peserta, nama, gender, alamat, hp) values('".$nonya."', '".$val[0]."','".$val[1]."', '".$val[2]."', '".$val[3]."')");
							$voucherList = $this->voucherHelper->uploadvoucer($data);

						}
					}
					
			}
			} else {
			echo "No file selected <br />";
			}
	return $this->View->toString(TEMPLATE_DOMAIN_ADMIN .'/apps/addvoucher.html');
	}
	
	function hapus(){

	//pr('ss');exit;
	$inisiasi=$this->_g('param');
	$deletemember = $this->voucherHelper->deletemember($inisiasi);
	if($deletemember==true)
			{
				sendredirect('member');
				die;
			}	
	
	}
		
	function checkit(){

		
		$storyList = $this->voucherHelper->checkmember();
		//pr($storyList);exit;
		if($storyList==true){
		print json_encode(array('status'=>true));
		}else{ 
			print json_encode(array('status'=>false));
		}
		
		exit;
		
	}
	
	
	function incheckit(){

		
		$storyList = $this->voucherHelper->checkinactives();
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
			
		$editmember = $this->voucherHelper->editmember($data);
		
		if($editmember)
		{
			sendredirect($CONFIG['ADMIN_DOMAIN'].'membermanagement');
		}
	}
	$inisiasi=$this->_g('param');	
	$selectmember = $this->voucherHelper->selectmember($inisiasi);
	//pr($selectmember);exit;
	
	$this->assign('listnya',$selectmember);
	
	return $this->View->toString(TEMPLATE_DOMAIN_ADMIN .'/apps/editmember.html');
	}
	
	function checkEmail()
	{
		
			$data['email']=$this->_p('email');
			$result=$this->voucherHelper->checkEmail($data);
			
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
			$objPHPExcel->getActiveSheet()->SetCellValue('F2','ID KTP/SIM');
			$objPHPExcel->getActiveSheet()->SetCellValue('G2','AKUN FACEBOOK');
			$objPHPExcel->getActiveSheet()->SetCellValue('H2','AKUN TWITTER');
			$objPHPExcel->getActiveSheet()->SetCellValue('I2','REGISTER DATE');
			$objPHPExcel->getActiveSheet()->SetCellValue('J2','INFO POINT');
			$objPHPExcel->getActiveSheet()->SetCellValue('K2','STATUS');
			$jumlahdata=count($data['data'])+2;
			//pr($jumlahdata);exit;
			$objPHPExcel->getActiveSheet()->getStyle('A2:K2')->getFont()->setBold(true);
			$objPHPExcel->getActiveSheet()->getStyle('A2:K'.$jumlahdata.'')->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->getStyle('A2:K2')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FF808080');
			
			/* $objPHPExcel->getActiveSheet()->getStyle('E1:O'.$jumlahdata.'')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('#CCFFCC');  */
			//pr($data);exit;
			
			$rowCount = 3;
			$no=1;
			foreach($data['data'] as $each){
				
				$objPHPExcel->getActiveSheet()->SetCellValue('A'.$rowCount,$no);
				$objPHPExcel->getActiveSheet()->SetCellValue('B'.$rowCount,$each['name']);
				//$objPHPExcel->getActiveSheet()->SetCellValue('C'.$rowCount,$each['date_register']);
				$objPHPExcel->getActiveSheet()->SetCellValue('C'.$rowCount,$each['username']);
				$objPHPExcel->getActiveSheet()->SetCellValue('D'.$rowCount,$each['nama_login']);
				$objPHPExcel->getActiveSheet()->SetCellValue('E'.$rowCount,$each['no_tlp']);
				$objPHPExcel->getActiveSheet()->SetCellValue('F'.$rowCount,$each['ktp_sim']);
				$objPHPExcel->getActiveSheet()->SetCellValue('G'.$rowCount,$each['fb_id']);
				$objPHPExcel->getActiveSheet()->SetCellValue('H'.$rowCount,$each['twiiter_id']);
				$objPHPExcel->getActiveSheet()->SetCellValue('I'.$rowCount,$each['date_register']);
				$objPHPExcel->getActiveSheet()->SetCellValue('J'.$rowCount,$each['post']);
				$objPHPExcel->getActiveSheet()->SetCellValue('K'.$rowCount,$each['statusnya']);
				

				

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
	
	
	function uploadxls($data=null){
		GLOBAL $ENGINE_PATH, $CONFIG, $LOCALE;
		//pr($ENGINE_PATH."Utility/PHPExcel.php");die;
		 
			
			require_once $ENGINE_PATH."Utility/PHPExcel/IOFactory.php";
			$styleArray = array(
				  'borders' => array(
					'allborders' => array(
					  'style' => PHPExcel_Style_Border::BORDER_THIN
					 
					)
				  )
				);
		
			$objPHPExcel = new PHPExcel();
	////////////////
		$inputFileName = $ENGINE_PATH.'uploadxls.xlsx'; 

			try {
				$objPHPExcel = PHPExcel_IOFactory::load($inputFileName);
			} catch(Exception $e) {
				die('Error loading file "'.pathinfo($inputFileName,PATHINFO_BASENAME).'": '.$e->getMessage());
			}


			$allDataInSheet = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);
			$arrayCount = count($allDataInSheet);  // Here get total count of row in that Excel sheet

			$jml=$arrayCount - 1;

			
			for($i=2;$i<=$arrayCount;$i++){
			$userName = trim($allDataInSheet[$i]["A"]);
			$userMobile = trim($allDataInSheet[$i]["B"]);
			pr($userName);
			pr($userMobile);
			exit;
			}
			
	//////////////////		
	}
	
	
}
?>
