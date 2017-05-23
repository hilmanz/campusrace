<?php
class puzzlemanagement extends App{

	function beforeFilter(){
		global $LOCALE,$CONFIG;
		
		$this->puzzleHelper = $this->useHelper('puzzleHelper');
		$this->memberHelper = $this->useHelper('memberHelper');
		$this->uploadHelper = $this->useHelper('uploadHelper');
		$this->assign('basedomain', $CONFIG['ADMIN_DOMAIN']);
		$this->assign('basedomainpath', $CONFIG['BASE_DOMAIN_PATH']);
		$this->assign('assets_domain', $CONFIG['ASSETS_DOMAIN_ADMIN']);
		$this->assign('locale', $LOCALE[1]);		
		$this->assign('pages', strip_tags($this->_g('page')));
		$this->assign('user',$this->user);
	}
	
	function main($start=null,$limit=10){
		global $LOCALE,$CONFIG;

		if($this->_request('paramactive')){
			$deactivatestatus = $this->puzzleHelper->deactivatestatus($id=$this->_request('paramactive'));
			$activestatus = $this->puzzleHelper->activestatus($id=$this->_request('paramactive'));
		}
		if($this->_request('paraminactive')){
		
			$inactivestatus = $this->puzzleHelper->inactivestatus($id=$this->_request('paraminactive'));
		}
		if($this->_request('paramcancel')){			
		
			$cancelstatus = $this->puzzleHelper->cancelstatus($id=$this->_request('paramcancel'));
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
				
			$editmember = $this->memberHelper->editmember($data);
			
			if($editmember)
			{
				sendredirect($CONFIG['ADMIN_DOMAIN'].'puzzlemanagement');
			}
		}
		
		if(strip_tags($this->_g('download'))=='report'){
		//pr($_GET);exit;
		
		
		
		$data['chapternya']=intval($this->_g('chapternya'));
		$data['status']=intval($this->_g('status'));
		$data['points']=$this->_g('points');
		$data['startdate']=$this->_g('startdate');
		$data['enddate']=$this->_g('enddate');
		$data['search']=$this->_g('search');		
		}
		
				
		$puzzleList = $this->puzzleHelper->puzzle($start=null,$limit=10);
		
		$time['time'] = '%H:%M:%S';
		
		$this->assign('total',$puzzleList['total']);
		$this->assign('list',$puzzleList['result']);
		
		return $this->View->toString(TEMPLATE_DOMAIN_ADMIN .'/apps/listpuzzle.html');
	}
	
	function pagingpuzzle(){
		//pr('ss');exit;
		global $LOCALE,$CONFIG;	
		
		$memberList = $this->puzzleHelper->puzzle($start=null,$limit=10);
		
		if($memberList==true){
		print json_encode(array('status'=>true,'data'=>$memberList['result'],'total'=>$memberList['total']));
		}else{ 
			print json_encode(array('status'=>false));
		}
		
		exit;		
	}
	
	function addpuzzle(){
	global $LOCALE,$CONFIG;
	
	if($this->_p('submit'))
		{
			$check = getimagesize($_FILES["big_img"]["tmp_name"]);
			$big_img_Width = $check[0];
			$big_img_Heigth = $check[1];
			$check2 = getimagesize($_FILES["small_img"]["tmp_name"]);
			$small_img_Width = $check2[0];
			$small_img_Heigth = $check2[1];
			$valid='';
			if($check !== false) {
				// Check file height & width
				if ($big_img_Width != 500 || $big_img_Heigth != 333) {
					$this->assign('big_img_no','Maaf, Mohon Ukuran panjang & tinggi gambar tidak sesuai');
					$valid='ada';
				}else if ($_FILES['big_img']['size'] > 108324) { // Check file size
					$this->assign('big_img_no','Maaf, Mohon ukuran Upload file tidak sesuai');				
					$valid='ada';
				}else if($_FILES['big_img']['name']){						
						$path = $CONFIG['LOCAL_PUBLIC_ASSET']."puzzle/";
						$img1['name']=@$_FILES['big_img']['name'];
						$img1['type']=@$_FILES['big_img']['type'];
						$img1['tmp_name']=@$_FILES['big_img']['tmp_name'];
						$img1['error']=@$_FILES['big_img']['error'];
						$img1['size']=@$_FILES['big_img']['size'];
					
						$uploadfiles = $this->uploadHelper->uploadThisImage($img1,$path,1000,false,false);
						$data['bigimg']=$uploadfiles['arrImage']['filename'];
						$upload1='oke';						
					}
				
			} else if($check == false){
				$this->assign('big_img_no','Maaf, Mohon Upload file gambar');				
				$valid='ada';
			}
			
			
			if($check2 !== false) {
				// Check file height & width
				if ($small_img_Width != 285 || $small_img_Heigth != 190) {
					$this->assign('small_img_no','Maaf, Ukuran panjang & tinggi gambar tidak sesuai');
					$valid='ada';
				}else if ($_FILES['small_img']['size'] > 31354) {		 // Check file size		
					$this->assign('small_img_no','Maaf, Ukuran Upload file tidak sesuai');
					$valid=='ada';
				}else if(($_FILES['small_img']['name'])&&($_FILES['big_img']['name']) ){						
						$path = $CONFIG['LOCAL_PUBLIC_ASSET']."puzzle/";
						$img2['name']=@$_FILES['small_img']['name'];
						$img2['type']=@$_FILES['small_img']['type'];
						$img2['tmp_name']=@$_FILES['small_img']['tmp_name'];
						$img2['error']=@$_FILES['small_img']['error'];
						$img2['size']=@$_FILES['small_img']['size'];
						
						$uploadfiles = $this->uploadHelper->uploadThisImage($img2,$path,1000,false,false);
						$data['smallimg']=$uploadfiles['arrImage']['filename'];	
						$upload2='oke';
						
					}
				
			} else if($check2 == false){				
				$this->assign('small_img_no','Maaf, Mohon Upload file gambar');
				$valid='ada';
			}		
						
			
			if($valid=='ada'){
				return $this->View->toString(TEMPLATE_DOMAIN_ADMIN .'/apps/addpuzzle.html');
			}else if($upload1=='oke' && $upload2=='oke'){
				$addstory = $this->puzzleHelper->addpuzzle($data);
				sendRedirect('puzzle');
				die;			
			} 
		}
		
	

	return $this->View->toString(TEMPLATE_DOMAIN_ADMIN .'/apps/addpuzzle.html');	
	}
	
	function hapus(){

	//pr('ss');exit;
	$inisiasi=$this->_g('param');
	$deletemember = $this->puzzleHelper->deletemember($inisiasi);
	if($deletemember==true)
			{
				sendredirect('member');
				die;
			}	
	
	}
		
	function checkit(){

		
		$storyList = $this->puzzleHelper->checkmember();
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
	
	
	function editpuzzle(){
	global $LOCALE,$CONFIG;
	$id=$this->_g('id');
	
	$listpuzzle=$this->puzzleHelper->selectgambar($id);		
	$this->assign("listpuzzle",$listpuzzle);
	//pr($listpuzzle);die;
		if(isset($_POST['submit']))
		{
			$data['id']=$this->_p('id');

			$check = getimagesize($_FILES["big_img"]["tmp_name"]);
			$big_img_Width = $check[0];
			$big_img_Heigth = $check[1];
			$check2 = getimagesize($_FILES["small_img"]["tmp_name"]);
			$small_img_Width = $check2[0];
			$small_img_Heigth = $check2[1];
			$valid='';
			
				if($check !== false) {
					// Check file height & width
					if ($big_img_Width != 500 || $big_img_Heigth != 333) {
						$this->assign('big_img_no','Maaf, Ukuran panjang & tinggi gambar tidak sesuai');
						$valid='ada';
					}else if ($_FILES['big_img']['size'] > 78324) { // Check file size
						$this->assign('big_img_no','Maaf, Ukuran Upload file tidak sesuai');				
						$valid='ada';
					}else if($_FILES['big_img']['name']){						
							$path = $CONFIG['LOCAL_PUBLIC_ASSET']."puzzle/";
							$img1['name']=@$_FILES['big_img']['name'];
							$img1['type']=@$_FILES['big_img']['type'];
							$img1['tmp_name']=@$_FILES['big_img']['tmp_name'];
							$img1['error']=@$_FILES['big_img']['error'];
							$img1['size']=@$_FILES['big_img']['size'];
						
							$uploadfiles = $this->uploadHelper->uploadThisImage($img1,$path,1000,false,false);
							$data['bigimg']=$uploadfiles['arrImage']['filename'];							
							$upload1='oke';						
						}
					
				} else if($check1 == false){
					$this->assign('big_img_no','Maaf, Mohon Upload file gambar');				
					$valid='ada';
				}
			
			
				if($check2 !== false) {
					// Check file height & width
					if ($small_img_Width != 285 || $small_img_Heigth != 190) {
						$this->assign('small_img_no','Maaf, Mohon Ukuran panjang & tinggi gambar tidak sesuai');
						$valid='ada';
					}else if ($_FILES['small_img']['size'] > 31354) {		 // Check file size		
						$this->assign('small_img_no','Maaf, Mohon ukuran Upload file tidak sesuai');
						$valid=='ada';
					}else if($_FILES['small_img']['name'] && $_FILES['big_img']['name']){						
							$path = $CONFIG['LOCAL_PUBLIC_ASSET']."puzzle/";
							$img2['name']=@$_FILES['small_img']['name'];
							$img2['type']=@$_FILES['small_img']['type'];
							$img2['tmp_name']=@$_FILES['small_img']['tmp_name'];
							$img2['error']=@$_FILES['small_img']['error'];
							$img2['size']=@$_FILES['small_img']['size'];
							
							$uploadfiles = $this->uploadHelper->uploadThisImage($img2,$path,1000,false,false);
							$data['smallimg']=$uploadfiles['arrImage']['filename'];								
							$upload2='oke';						
						}
					
				} else if($check2 == false){				
					$this->assign('small_img_no','Maaf, Mohon Upload file gambar');
					$valid='ada';
				}		
			
			
						
			if($valid=='ada'){
				$listpuzzle=$this->puzzleHelper->selectgambar($data['id']);		
				$this->assign("listpuzzle",$listpuzzle);
				return $this->View->toString(TEMPLATE_DOMAIN_ADMIN .'/apps/editpuzzle.html');
			}else if($upload1=='oke' && $upload2=='oke'){				
				$editstory = $this->puzzleHelper->editpuzzle($data);
				sendRedirect('puzzle');
				die;			
			} else{
				sendRedirect('puzzle');
			} 
		}
	
	return $this->View->toString(TEMPLATE_DOMAIN_ADMIN .'/apps/editpuzzle.html');
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
			$objPHPExcel->getActiveSheet()->SetCellValue('B2','NAMA CHAPTER');
			$objPHPExcel->getActiveSheet()->SetCellValue('C2','NAMA MEMBER');
			$objPHPExcel->getActiveSheet()->SetCellValue('D2','REGISTER DATE');
			$objPHPExcel->getActiveSheet()->SetCellValue('E2','email');
			$objPHPExcel->getActiveSheet()->SetCellValue('F2','KTP / SIM');
			$objPHPExcel->getActiveSheet()->SetCellValue('G2','STATUS');
			$jumlahdata=count($data['data'])+2;
			//pr($jumlahdata);exit;
			$objPHPExcel->getActiveSheet()->getStyle('A2:G2')->getFont()->setBold(true);
			$objPHPExcel->getActiveSheet()->getStyle('A2:G'.$jumlahdata.'')->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->getStyle('A2:G2')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FF808080');
			
			/* $objPHPExcel->getActiveSheet()->getStyle('E1:O'.$jumlahdata.'')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('#CCFFCC');  */
			//pr($data);exit;
			
			$rowCount = 3;
			$no=1;
			foreach($data['data'] as $each){
				
				$objPHPExcel->getActiveSheet()->SetCellValue('A'.$rowCount,$no);
				$objPHPExcel->getActiveSheet()->SetCellValue('B'.$rowCount,$each['namachapter']);
				$objPHPExcel->getActiveSheet()->SetCellValue('C'.$rowCount,$each['name']);
				$objPHPExcel->getActiveSheet()->SetCellValue('D'.$rowCount,$each['date_register']);
				$objPHPExcel->getActiveSheet()->SetCellValue('E'.$rowCount,$each['username']);
				$objPHPExcel->getActiveSheet()->SetCellValue('F'.$rowCount,$each['ktp_sim']);
				$objPHPExcel->getActiveSheet()->SetCellValue('G'.$rowCount,$each['statusnya']);
				

				

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
