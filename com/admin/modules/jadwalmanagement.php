<?php
class jadwalmanagement extends App{

	function beforeFilter(){
		global $LOCALE,$CONFIG;
		
		$this->skorHelper = $this->useHelper('skorHelper');
		$this->jadwalHelper = $this->useHelper('jadwalHelper');
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
			$deactivatestatus = $this->jadwalHelper->deactivatestatus($id=$this->_request('paramactive'));
			$activestatus = $this->jadwalHelper->activestatus($id=$this->_request('paramactive'));
		}
		if($this->_request('paraminactive')){
		
			$inactivestatus = $this->jadwalHelper->inactivestatus($id=$this->_request('paraminactive'));
		}
		/* if($this->_request('paramcancel')){			
		
			$cancelstatus = $this->memberHelper->cancelstatus($id=$this->_request('paramcancel'));
		} */
		
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
				sendredirect($CONFIG['ADMIN_DOMAIN'].'membermanagement');
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
	
		$downloadListmember = $this->memberHelper->downloadListmember($data);
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
		
		$chapter=$this->memberHelper->listchapter();
		$this->assign('chapter',$chapter);
		
		$jadwalList = $this->jadwalHelper->jadwal($start=null,$limit=10);

		$time['time'] = '%H:%M:%S';
		
		$this->assign('total',$jadwalList['total']);
		$this->assign('list',$jadwalList['result']);
		
		return $this->View->toString(TEMPLATE_DOMAIN_ADMIN .'/apps/listjadwal.html');
	}
	
	function pagingmember(){
		//pr('ss');exit;
		global $LOCALE,$CONFIG;
		
		$this->assign('status',@$this->_request('status'));
		$this->assign('points',@$this->_request('points'));
		$this->assign('startdate',@$this->_request('startdate'));
		$this->assign('enddate',@$this->_request('enddate'));
		$this->assign('search',@$this->_request('search'));
		$this->assign('chapternya',@$this->_request('chapternya'));

		$memberList = $this->jadwalHelper->jadwal($start=null,$limit=10);
		//pr($memberList);exit;
		if($memberList==true){
		print json_encode(array('status'=>true,'data'=>$memberList['result'],'total'=>$memberList['total']));
		}else{ 
			print json_encode(array('status'=>false));
		}
		
		exit;
		
	}
	function addjadwal(){
	global $LOCALE,$CONFIG;
	$listchap=$this->jadwalHelper->selectclub();		
	$this->assign("listclub",$listchap);
	
		
	if(isset($_POST['submit']))
	{
		$data['weekid'] =$this->_p('weekid');
		$data['club1'] =$this->_p('club1');
		$data['club2'] =$this->_p('club2');
		$data['club3'] =$this->_p('club3');
		$data['club4'] =$this->_p('club4');
		$data['club5'] =$this->_p('club5');
		$data['club6'] =$this->_p('club6');
		$data['last_submit'] =$this->_p('last_submit');
		$data['last_submit_time'] = date('Y-m-d H:i:s',strtotime($data['last_submit']));

		$tambah_tanggal = mktime(0,0,0,date('m'),date('d')+1,date('Y'));
		$tambah = date('Y-m-d',$tambah_tanggal);
		$tgl_skrg=date('Y-m-d');
		$valid='';
		if($tambah > $data['last_submit_time']){
			$valid='ada';
			$last_submit_time_no="Maaf, input waktu tidak valid";
			$this->assign("last_submit_time_no",$last_submit_time_no);
		}
		if($data['club1']==$data['club2']){
			$valid='ada';
			$club12_no="Pilih Club harus berbeda";
			$this->assign("club12_no",$club12_no);
		}
		if($data['club3']==$data['club4']){
			$valid='ada';
			$club34_no="Pilih Club harus berbeda";
			$this->assign("club34_no",$club34_no);
		}
		if($data['club5']==$data['club6']){
			$valid='ada';
			$club56_no="Pilih Club harus berbeda";
			$this->assign("club56_no",$club56_no);
		}
		if($data['weekid']==''){
			$valid='ada';
			$weekno="Kolom ini harus diisi";
			$this->assign("week_no",$weekno);
		}else{
			$cekweekid=$this->jadwalHelper->selectweekid($data['weekid']);
		}
				
		if($valid==''){
			if($cekweekid){
				$weekno="Pertandingan minggu yang anda isi sudah ada";
				$this->assign("week_no",$weekno);
				$this->assign("club1_no",$data['club1']);
				$this->assign("club2_no",$data['club2']);
				$this->assign("club3_no",$data['club3']);
				$this->assign("club4_no",$data['club4']);
				$this->assign("club5_no",$data['club5']);
				$this->assign("club6_no",$data['club6']);
				$this->assign("last_submit_no",$data['last_submit']);
			}else{
				$addmember = $this->jadwalHelper->addjadwal($data);
				if($addmember)
				{
					sendredirect($CONFIG['ADMIN_DOMAIN'].'jadwalmanagement');
				}
			}
		}else{		
			$this->assign("club1_no",$data['club1']);
			$this->assign("club2_no",$data['club2']);
			$this->assign("club3_no",$data['club3']);
			$this->assign("club4_no",$data['club4']);
			$this->assign("club5_no",$data['club5']);
			$this->assign("club6_no",$data['club6']);
			$this->assign("last_submit_no",$data['last_submit']);
		}
		
	}
	$week=date('W');
	$weeks=intval($week);
	$this->assign("week",$weeks);
	return $this->View->toString(TEMPLATE_DOMAIN_ADMIN .'/apps/addjadwal.html');	
	}
	
	function hapus(){

	//pr('ss');exit;
	$inisiasi=$this->_g('param');
	$deletemember = $this->jadwalHelper->deletemember($inisiasi);
	if($deletemember==true)
			{
				sendredirect('member');
				die;
			}	
	
	}
		
	function checkit(){

		
		$storyList = $this->jadwalHelper->checkmember();
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
	
	
	function editjadwal(){
	global $LOCALE,$CONFIG;
	$id=$this->_g('id');
	$listchap=$this->jadwalHelper->selectclub();		
	$this->assign("listclub",$listchap);
	$listevent=$this->jadwalHelper->selectpertandingan($id);		
	$this->assign("listevent",$listevent);

		if(isset($_POST['submit']))
		{
			$data['id'] =$this->_p('id');
			$data['weekid'] =$this->_p('weekid');
			$data['club1'] =$this->_p('club1');
			$data['club2'] =$this->_p('club2');
			$data['club3'] =$this->_p('club3');
			$data['club4'] =$this->_p('club4');
			$data['club5'] =$this->_p('club5');
			$data['club6'] =$this->_p('club6');	
			$data['last_submit'] =$this->_p('last_submit');
			$data['last_submit_time'] = date('Y-m-d H:i:s',strtotime($data['last_submit']));
			
			$tgl_skrg=date('Y-m-d H:i');
			
			$valid='';
			if($tgl_skrg > $data['last_submit_time']){
				$valid='ada';
				$last_submit_time_no="Maaf, input waktu tidak valid";
				$this->assign("last_submit_time_no",$last_submit_time_no);
			}
			if($data['club1']==$data['club2']){
				$valid='ada';
				$club12_no="Pilih Club harus berbeda";
				$this->assign("club12_no",$club12_no);
			}
			if($data['club3']==$data['club4']){
				$valid='ada';
				$club34_no="Pilih Club harus berbeda";
				$this->assign("club34_no",$club34_no);
			}
			if($data['club5']==$data['club6']){
				$valid='ada';
				$club56_no="Pilih Club harus berbeda";
				$this->assign("club56_no",$club56_no);
			}
			
			
			if($valid==''){			
				$editmember = $this->jadwalHelper->editjadwal($data);			
				if($editmember){
					sendredirect($CONFIG['ADMIN_DOMAIN'].'jadwalmanagement');
				}
			}else{
				$this->assign("id_no",$data['id']);
				$this->assign("week",$data['weekid']);
				$this->assign("club1_no",$data['club1']);
				$this->assign("club2_no",$data['club2']);
				$this->assign("club3_no",$data['club3']);
				$this->assign("club4_no",$data['club4']);
				$this->assign("club5_no",$data['club5']);
				$this->assign("club6_no",$data['club6']);
				$this->assign("last_submit_no",$data['last_submit']);							
			}
		}
	
	return $this->View->toString(TEMPLATE_DOMAIN_ADMIN .'/apps/editjadwal.html');
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
