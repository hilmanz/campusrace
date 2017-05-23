<?php
	class challangeHelper{
		function __construct($apps){
			global $logger,$CONFIG;
			$this->logger = $logger;
			$this->apps = $apps;
			$this->config = $CONFIG;
			
			if( $this->apps->session->getSession($this->config['SESSION_NAME'],"admin") ){
				$this->login = true;
			}
		}
		
		function challange($start=null,$limit=10){
			global $CONFIG;
			
			$filter='';
			$rs['result'] = false;
			$rs['total'] = 0;
			
			$status=$this->apps->_request('status');
			$from=date("Y-m-d",strtotime($this->apps->_request('startdate')));
			$to=date("Y-m-d",strtotime($this->apps->_request('enddate')));
			$search=$this->apps->_request('search');
			$category=$this->apps->_request('category');
			
			if($search){
				$filter = $search=="Search..." ? "" : "AND (ss_chalangge.name LIKE '%{$search}%' or ss_chalangge.description LIKE '%{$search}%')";
			}					
			
			if($from != '1970-01-01' && $to != '1970-01-01' ){
				$filter .= $from ? " AND `create_challange` between '{$from}' AND '{$to} 23:59:59' " : "";
			}
			
			$categorys="";
		
			if($category){
				$categorys= " AND `category`='{$category}'";
			}
			
			$statusquery="";
		
			if($status==1){
				$statusquery= " AND ss_chalangge.n_status='{$status}'";
			}else if($status==2){
				$statusquery= " AND ss_chalangge.n_status=0";
			}else{
				$statusquery = "AND ss_chalangge.n_status in (0,1,3)";
			}
			
			if($start==null)$start = intval($this->apps->_request('start'));
			$limit = intval($limit);
			$sql = "SELECT COUNT(*) total 
					FROM  {$CONFIG['DATABASE'][0]['DATABASE']}.ss_chalangge where 1 and n_status!=2 {$filter} {$categorys} {$statusquery}"; 
			//pr($sql);exit;
			$total = $this->apps->fetch($sql);
			
			if(intval($total['total'])<=$limit) $start = 0;						
			
			$sql="select ss_chalangge.*,ss_member.name, ss_chalangge.name as namess 
			from  {$CONFIG['DATABASE'][0]['DATABASE']}.ss_chalangge
			left join ss_challange_detail on ss_challange_detail.id_challange=ss_chalangge.id
			left join ss_member on ss_member.id=ss_challange_detail.id_member
			where 1 and ss_chalangge.n_status!=2  
			{$statusquery} {$categorys} {$filter} 
			group by ss_chalangge.name order by id DESC LIMIT {$start}, {$limit}";
			//pr($sql);exit;
			$rsut=$this->apps->fetch($sql,1);
			//pr($no);
			$no = 1;
			
			if( $start>0){
				$no = $start+1;
			}
			
			foreach ($rsut as $key => $val){
				$rsut[$key]['no'] = $no++;
				
			$sql2="select ss_member.name from  {$CONFIG['DATABASE'][0]['DATABASE']}.ss_chalangge
			left join ss_member on ss_member.id=ss_chalangge.member_id where 1  and ss_chalangge.name='{$val['namess']}'";
			
			//pr($sql2);exit;
			$rsut2=$this->apps->fetch($sql2,1);	
			
			$sql3="select ss_member.name 
			from  {$CONFIG['DATABASE'][0]['DATABASE']}.ss_chalangge
			left join ss_challange_detail on ss_challange_detail.id_challange=ss_chalangge.id
			left join ss_member on ss_member.id=ss_challange_detail.id_member
			where 1  and ss_chalangge.name='{$val['namess']}'   ";
			
			//pr($sql3);exit;
			$rsut3=$this->apps->fetch($sql3,1);	
			
			$arraysementara=array();
			foreach ($rsut3 as $key3 => $val3){
			$arraysementara[]= $val3['name'];
			
			}
			//pr(implode(",", $arraysementara));exit;
			$rsut[$key]['name'] = implode(",", $arraysementara);
			
			$sql = "SELECT name_category
				FROM  {$CONFIG['DATABASE'][0]['DATABASE']}.ss_category_tantangan where 1 and id='{$val['category']}'"; 
			//pr($sql);exit;
			$category = $this->apps->fetch($sql);
			
			$rsut[$key]['name_category'] = $category['name_category'];
			$rsut[$key]['create_challange'] = date('d-m-Y', strtotime ($val['create_challange']));
			$rsut[$key]['start_time'] = date('d-m-Y', strtotime ($val['start_time']));
			$rsut[$key]['end_time'] = date('d-m-Y', strtotime ($val['end_time']));
			}
			
			//pr($rsut);exit;
			$rs['status'] = true;
			$rs['result'] = $rsut;
			$rs['total'] = intval($total['total']); 
			return $rs;
		}
	
		function activestatus($idnya){
			global $CONFIG;

			$sql="update  {$CONFIG['DATABASE'][0]['DATABASE']}.ss_chalangge set n_status=1 where id={$idnya}";
			//pr($sql);exit;
			$fetch=$this->apps->query($sql);
			return true;
		}
		
		function inactivestatus($idnya){
			global $CONFIG;

			$sql="update  {$CONFIG['DATABASE'][0]['DATABASE']}.ss_chalangge set n_status=0 where id={$idnya}";
			//pr($sql);exit;
			$fetch=$this->apps->query($sql);
			return true;
		}
		
		function finishstatus($idnya){
			global $CONFIG;

			$sql="update  {$CONFIG['DATABASE'][0]['DATABASE']}.ss_chalangge set n_status=3 where id={$idnya}";
			//pr($sql);exit;
			$fetch=$this->apps->query($sql);
			return true;
		}
		
		function cancelstatus($idnya){
			global $CONFIG;

			$sql="update  {$CONFIG['DATABASE'][0]['DATABASE']}.ss_chalangge set n_status=2 where id={$idnya}";
			//pr($sql);exit;
			$fetch=$this->apps->query($sql);
			
			if($fetch){
				sendredirect($CONFIG['ADMIN_DOMAIN'].'challangemanagement');
			}
			return true;
		}
		
		function editchallange($data){
			global $CONFIG;
			//$iduser = $data['chapter_id'];
			//$counter=count($data['chapter_id']);
			//pr($data['chapter_id']);exit;
			
			$sql="update {$CONFIG['DATABASE'][0]['DATABASE']}.ss_chalangge set
			`name`='{$data['name']}',
			`description`='{$data['description']}',
			`start_time`='{$data['datestart']}',
			`end_time`='{$data['dateend']}',
			`hastags`='{$data['hastags']}',
			`url`='{$data['url']}'
			where `id`='{$data['idnya']}'";
		
			//pr($sql);exit;		
			$fetch = $this->apps->query($sql);

			
			$sql1 = "delete from ss_challange_detail where 1 and id_challange='{$data['idnya']}'";
			//pr($sql1);exit;
			$fetch=$this->apps->query($sql1);
			
			foreach($data['chapter_id'] as $keys){			
				$sql2 = "insert into ss_challange_detail SET id_challange='{$data['idnya']}', id_chapter='{$keys}'";
				//pr($sql2);exit;
				$fetch = $this->apps->query($sql2);
			}
			
			if($fetch){
				return true;
			}else{
				return false;
			}
		}
		
		function selectchallange($inisiasi){
			global $CONFIG;
			
			if ($inisiasi){
				$sql="select *,name as namess ,DATE_FORMAT(sm.create_challange,'%d-%m-%Y %H:%i') AS date_register from {$CONFIG['DATABASE'][0]['DATABASE']}.ss_chalangge sm where `id`='{$inisiasi}'";
				//pr($sql);exit;
				$fetch = $this->apps->fetch($sql,1);
				//pr($fetch);exit;
				foreach ($fetch as $key => $val){
				$sql2="select ss_chapter.id as chapid from  {$CONFIG['DATABASE'][0]['DATABASE']}.ss_chalangge
				left join ss_challange_detail on ss_challange_detail.id_challange=ss_chalangge.id
				left join ss_chapter on ss_chapter.id=ss_challange_detail.id_chapter 
				where 1  and ss_chalangge.name='{$val['namess']}'";
				//pr($sql2);exit;
				$rsut2=$this->apps->fetch($sql2,1);	
				$arraysementara=array();
				foreach ($rsut2 as $key2 => $val2){
				$arraysementara[]= $val2['chapid'];
				
				}
				//$fetch[$key]['chapter_id'] = $arraysementara;
				
				//pr($arraysementara);exit;		
				//	$sql = "SELECT *
				//		FROM  {$CONFIG['DATABASE'][0]['DATABASE']}.ss_chapter where 1 and id='{$val['chapter_id']}'"; 
					//pr($sql);exit;
				//	$chapter = $this->apps->fetch($sql);
					//pr($chapter);exit;
					
				//	$fetch[$key]['name_chapter'] = $chapter['name_chapter'];
				}
				
				//pr($fetch);exit;
				return $fetch;
			}
		}
		
		function addchallange($data){
			global $CONFIG;
		
			$name = $data['name'];
			$description = $data['description'];
			$start_time = $data['start_time'];
			$end_time = $data['end_time'];
			$datestart = $data['datestart'];
			$dateend = $data['dateend'];			
			$hastags = $data['hastags'];
			$url = $data['url'];
			$category = $data['category'];
			
			//pr($chapter_id);exit;
			// pr($dataemail);

			$sql = "INSERT INTO `ss_chalangge` SET
							`member_id`='',
							`name`='".$name."',
							`description`='{$description}',
							`start_time`='{$datestart}',								
							`hastags`='#{$hastags}',
							`url`='{$url}',
							`category`='{$category}',
							`end_time`='".$dateend."',
							`create_challange`=NOW(),
							`n_status`=0
							";
			//pr($sql);exit;
			$fetch= $this->apps->query($sql);
			$idchallange=$this->apps->getLastInsertId();
				
			/* foreach($data['member_id'] as $keys){
				$sql2 = "insert into ss_challange_detail set id_challange='{$idchallange}',
						id_member='{$keys}'";
				//pr($sql2);exit;
				$fetch = $this->apps->query($sql2);
			} */	
			// die;
			return true;
		}

		function listmember(){
			$sql = "
					SELECT *
					FROM {$this->config['DATABASE'][0]['DATABASE']}.ss_member WHERE n_status=1";
			
				// pr($sql);die;
			$rs = $this->apps->fetch($sql,1); 
			return $rs;
		}
		
		function selectchap(){
			$sql = "
					SELECT *
					FROM {$this->config['DATABASE'][0]['DATABASE']}.ss_chapter WHERE n_status=1 ORDER BY name_chapter ASC";
			
			$rs = $this->apps->fetch($sql,1); 
				 //pr($sql);die;
			return $rs;
		}
		
		function selectcat(){
			$sql = "
					SELECT *
					FROM {$this->config['DATABASE'][0]['DATABASE']}.ss_category_tantangan";
			
			$rs = $this->apps->fetch($sql,1); 
				 //pr($sql);die;
			return $rs;
		}
	}
?>
