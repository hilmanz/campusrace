<?php
class eventHelper {
	
	var $_mainLayout="";
	var $login = false;
	
	function __construct($apps=false){
		global $logger,$CONFIG;
		$this->logger = $logger;
		$this->apps = $apps;
		$this->config = $CONFIG;
	}
	
	function event($start=null,$limit=10){
		global $CONFIG;
		
		$rs['result'] = false;
		$rs['total'] = 0;	
		
		if($start==null)$start = intval($this->apps->_request('start'));
		
		//Seaching Berdasarkan tanggal dan Nama Cabang 
		
		$filter='';
		$search=$this->apps->_request('search');		
		$status=$this->apps->_request('status');
		$kota=$this->apps->_request('kota');
		$category=$this->apps->_request('category');
		$chapternya=$this->apps->_request('listchapter');
		$from=date("Y-m-d",strtotime($this->apps->_request('startdate')));
		$to=date("Y-m-d",strtotime($this->apps->_request('enddate')));
		
		if($search){
			$filter = $search=="Search..." ? "" : "AND (ss_event.name LIKE '%{$search}%' or name_chapter LIKE '%{$search}%' or ss_event.alamat LIKE '%{$search}%')";
		}
		
		if($from != '1970-01-01' && $to != '1970-01-01' ){
			$filter .= $from ? " AND ss_event.date_create between '{$from}' AND '{$to} 23:59:59' " : "";
		}
		if($chapternya){
				$filter .= $chapternya ? " AND `chapter_id`={$chapternya}": "";
		}
		
		$filter .= $kota ? " AND ss_chapter.kota={$kota}":"";

		$statusquery="";
		
		if($status==1){
			$statusquery= " AND ss_event.n_status='1'";
		}else if($status==2){
			$statusquery= " AND ss_event.n_status='0'";
		}else if($status==3){
                        $statusquery= " AND ss_event.n_status='3'";
		}else{
			$statusquery=" AND ss_event.n_status!='2'";
		}
		
		$categorys="";
		
		if($category){
			$categorys= " AND `type`='{$category}'";
		}
		
		//Count total
		$limit = intval($limit);
		$sql = "SELECT COUNT(*) total 
				FROM  {$CONFIG['DATABASE'][0]['DATABASE']}.ss_event where 1 {$statusquery} {$categorys} {$filter}"; 
		//pr($sql);exit;
		$total = $this->apps->fetch($sql);	
		
		
		if(intval($total['total'])<=$limit) $start = 0;
		
		 $sql="select *,ss_event.upload_foto upload_foto,ss_event.id as id,ss_event.alamat as alamat, ss_event.name as names, ss_event.n_status as stat, ss_event.point as poin from  {$CONFIG['DATABASE'][0]['DATABASE']}.ss_event
		 left join ss_type_event on ss_type_event.id=ss_event.type 
		 left join ss_chapter on ss_chapter.id=ss_event.chapter_id where 1 {$statusquery} {$categorys}  {$filter} order by ss_event.id DESC LIMIT {$start}, {$limit} ";
		
		// $sql="select *,ss_event.id as id from  {$CONFIG['DATABASE'][0]['DATABASE']}.ss_event, {$CONFIG['DATABASE'][0]['DATABASE']}.ss_chapter, {$CONFIG['DATABASE'][0]['DATABASE']}.ss_type_event
		// where 1 and ss_event.chapter_id=ss_chapter.id and ss_event.type=ss_type_event.id {$statusquery} {$categorys}  {$filter}  and ss_event.n_status!=2 order by ss_event.id DESC LIMIT {$start}, {$limit} ";
		//pr($sql);exit;
		$rsut=$this->apps->fetch($sql,1);
		
		if(!$rsut){ return false;} 
		$no = 1;
		
		if( $start>0){
			$no = $start+1;
		}
		//pr($rsut);exit;
		foreach ($rsut as $key => $val){
			//BUAT AMBIL FOTO 
			if($val['upload_foto']){
				$unserfoto=unserialize($val['upload_foto']);
				//pr($unserfoto);exit;
			/* 	foreach($unserfoto['file'] as $k =>$v){
					if($v['type']){
						$unser['upload_foto'][$k]['name']=$v['name'];
					} 
				}		 */		
				$rsut[$key]['upload_foto']=$unserfoto['file'];
			}
			
			$rsut[$key]['no'] = $no++;
			$sql = "SELECT name_chapter
				FROM  {$CONFIG['DATABASE'][0]['DATABASE']}.ss_chapter where 1 and id='{$val['chapter_id']}'"; 
			//pr($sql);exit;
			$chapter = $this->apps->fetch($sql);	
			$rsut[$key]['time_start']=date("d-m-Y H:i",strtotime(''.$val['time_start'].'' ));
			$rsut[$key]['time_end']=date("d-m-Y H:i",strtotime(''.$val['time_end'].'' ));
			$rsut[$key]['date_create']=date("d-m-Y H:i",strtotime(''.$val['date_create'].'' ));
			$rsut[$key]['name_chapter'] = $chapter['name_chapter'];			
			
			$sql = "SELECT COUNT(*) total 
				FROM  {$CONFIG['DATABASE'][0]['DATABASE']}.ss_list_pesertaevent where 1 and event_id='{$val['id']}'"; 
			//pr($sql);exit;
			$totalpes = $this->apps->fetch($sql);	
			
			$rsut[$key]['jumlahundangan'] = $totalpes['total'];
		}		
		
		//pr($rsut);exit;
		$rs['status'] = true;
		$rs['result'] = $rsut;
		$rs['total'] = intval($total['total']); 
		return $rs;
	}
	
	
	
	function inactivestatus($idnya){
		global $CONFIG;
		
		$sql="update  {$CONFIG['DATABASE'][0]['DATABASE']}.ss_event set n_status=0 where id={$idnya}";
		//pr($sql);exit;
		$fetch=$this->apps->query($sql);
		return true;	
	}
	
	function resetpoint($idnya){
		global $CONFIG;

		$sql="update  {$CONFIG['DATABASE'][0]['DATABASE']}.ss_event set point=0 where id={$idnya}";
		//pr($sql);exit;
		$fetch=$this->apps->query($sql);
		return true;	
	}

        function finishstatus($idnya){
                global $CONFIG;

                //pr('masukss');exit;
                $sql="select * from {$CONFIG['DATABASE'][0]['DATABASE']}.ss_event where id={$idnya} and n_status=1";
                //pr($sql);exit;
                $result=$this->apps->fetch($sql);
                //pr($fetch);exit;
                if($result){
                        //KALAU ADA DATANYA KEMBALIKAN 0 ATAU FALSE

                        $sql="insert into {$CONFIG['DATABASE'][0]['DATABASE']}.ss_activity_log set type_paremeter_point=12,
                        event_id={$result['id']},chapter_id='{$result['chapter_id']}',date=NOW(),point='50'";
                        //pr($sql);exit;
                        $fetch1=$this->apps->query($sql);

                        //INSERT KE SS CHAPTER
                        $sql="update {$CONFIG['DATABASE'][0]['DATABASE']}.ss_chapter set point=point+50 where id={$result['chapter_id']}";
                        $fetch2=$this->apps->query($sql);

                        $sql="update {$CONFIG['DATABASE'][0]['DATABASE']}.ss_event set n_status=3,point=50 where id={$result['id']} and n_status=1";
                        $fetch2=$this->apps->query($sql);


                        //pr($sql);exit;
                        return true;

                }else{
                        //pr($data);exit;
                        //INSERT KE ACTIVITY LOG
                        return false;
		}
        }
	
	function cancelstatus($idnya){
		global $CONFIG;

		$sql="update  {$CONFIG['DATABASE'][0]['DATABASE']}.ss_event set n_status=2 where id={$idnya}";
		//pr($sql);exit;
		$fetch=$this->apps->query($sql);
		return true;	
	}
	
	function rejectstatus($idnya){
		global $CONFIG;

		 $sql="update  {$CONFIG['DATABASE'][0]['DATABASE']}.ss_event set n_status=4 where id={$idnya}";
		//pr($sql);exit;
		 $fetch=$this->apps->query($sql);
		
			$sql1 = "select chapter_id from {$CONFIG['DATABASE'][0]['DATABASE']}.ss_event where id={$idnya}";
			$rs = $this->apps->fetch($sql1);
			//pr($sql1);exit;
			$rt = $rs['chapter_id'];
			//$rt=intval($rs['chapter_id']);
			//pr($rt);exit;
			if($rs){
				$chapter_id = $rs['chapter_id'];
				
				$qData = null;
				$sqlGetmember = "SELECT *,ss_chapter.email as email, ss_event.alamat as alamat, ss_event.time_start as time_start, ss_chapter.name_chapter as name, ss_event.name as placename FROM ss_chapter, ss_event WHERE ss_chapter.id=ss_event.chapter_id and ss_chapter.id={$rt} and ss_event.id={$idnya}";
				//pr($sqlGetmember);exit;
				$resGetmember= $this->apps->fetch($sqlGetmember,1); 
				//pr($resGetmember);exit;
				if($resGetmember){
					foreach($resGetmember as $keymember => $valmember){
						if($valmember['email'])
						{
						$dataArray = array(
								'email'=>$valmember['email'],
								'namemember'=>$valmember['name_chapter'],
								'tempat'=>$valmember['alamat'],
								'hari'=>$valmember['time_start'],
								'tlp'=>$valmember['no_tlp'],
								'eventname'=>$valmember['placename']
								
								
							);
							$link = urlencode64(serialize(array(
								'name'=>$valmember['name'],
								'chapterid'=>'46'
							)));
						$returnEmail = $this->send_rejectevent($dataArray,$link);
						}
					//pr($dataArray);exit;
					}
				}
				return true;
			}
		
		return true;	
	}

	function send_rejectevent($dataArray=null,$link=null) {  
		global $LOCALE;

		if($dataArray){
			$results['msg']='';
			$results['status']='';
			$template = $LOCALE[1]['delete_event'];
			$template = str_replace('!#name',$dataArray['namemember'],$template);
			$template = str_replace('!#tempat',$dataArray['tempat'],$template);
			$template = str_replace('!#hari',$dataArray['hari'],$template);
			$template = str_replace('!#typeevent',$dataArray['eventname'],$template);
			$template = str_replace('!#tlp',$dataArray['tlp'],$template);
			
			//$template = str_replace('!#chaptername',$dataArray['namechapter'],$template);
			//$template = str_replace('!#link',$this->config['BASE_DOMAIN'].'memberreg/reservation?pram='.$link,$template);
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
			curl_setopt($ch, CURLOPT_USERPWD, 'api:key-031f6c645c2c27d331e152ba8a959e28');
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
			curl_setopt($ch, CURLOPT_URL, 
				'https://api.mailgun.net/v3/gte.supersoccer.co.id/messages');
			curl_setopt($ch, CURLOPT_POSTFIELDS, 
			array('from' => 'Supersoccer Community Race<sscr-admin@supersoccer.co.id>',
				'to' => $dataArray['email'],
				'subject' => "Undangan Event ".$dataArray['namemember']."",
				'html' => $template,
				'o:campaign' => 'fkdf5'));
			$result = curl_exec($ch);
			$info = curl_getinfo($ch);
			// pr($info);
			// pr($result);
			$res = json_decode($result,TRUE);
						  
			if($info['http_code']!='200'){
				$results['msg']=$res['message'];
				$results['status']='0';
			}
			else{
				$results['msg']=$res['message'];
				$results['status']='1';
			}
			curl_close($ch);
			return $results;
		}
		$results['status']='0';
		return $results;
	}
	
	function finishpoint($data){
		global $CONFIG;
		
		//pr('masukss');exit;
		$sql="select * from {$CONFIG['DATABASE'][0]['DATABASE']}.ss_event where id={$data['idevent']} and 
		chapter_id='{$data['chapterid']}' and n_status=1";
		//pr($sql);exit;
		$fetch=$this->apps->fetch($sql);
		//pr($fetch);exit;
		if($fetch){
			//KALAU ADA DATANYA KEMBALIKAN 0 ATAU FALSE
			
			$sql="insert into {$CONFIG['DATABASE'][0]['DATABASE']}.ss_activity_log set type_paremeter_point=12,
			event_id={$data['idevent']},chapter_id='{$data['chapterid']}',date=NOW(),point='50'";
			//pr($sql);exit;
			$fetch1=$this->apps->query($sql);
			
			//INSERT KE SS CHAPTER
			$sql="update {$CONFIG['DATABASE'][0]['DATABASE']}.ss_chapter set point=point+50 where id={$data['chapterid']}";
			$fetch2=$this->apps->query($sql);
			
			$sql="update {$CONFIG['DATABASE'][0]['DATABASE']}.ss_event set n_status=3,point=50 where id={$data['idevent']}";
			$fetch2=$this->apps->query($sql);
			
			
			//pr($sql);exit;
			return true;
				
		}else{
			//pr($data);exit;
			//INSERT KE ACTIVITY LOG
			return false;
		}
	}
	
	function tambahpointevent($data){
		global $CONFIG;
		
		//SELECT DATANYA ADA ATAU TIDAK
		
		$sql="select * from {$CONFIG['DATABASE'][0]['DATABASE']}.ss_activity_log where type_paremeter_point=15 and 
		event_id={$data['idevent']} and 
		chapter_id='{$data['chapterid']}' and 
		point='{$data['pointnya']}'";
		
		//pr($sql);exit;
		$fetch=$this->apps->fetch($sql);
		
		if($fetch){
			//KALAU ADA DATANYA KEMBALIKAN 0 ATAU FALSE
			return false;

		}else{

			//KALAU TIDAK ADA

			//INSERT KE ACTIVITY LOG
			$sql="insert into {$CONFIG['DATABASE'][0]['DATABASE']}.ss_activity_log set type_paremeter_point=15,
			event_id={$data['idevent']},chapter_id='{$data['chapterid']}',point='{$data['pointnya']}' ";
			$fetch=$this->apps->query($sql);
			
			//INSERT KE SS EVENT
			$sql="update {$CONFIG['DATABASE'][0]['DATABASE']}.ss_event set point=point+{$data['pointnya']} ,n_status=3 where id={$data['idevent']}";
			//pr($sql);exit;
			$fetch=$this->apps->query($sql);
			//pr($sql);exit;
			//INSERT KE SS CHAPTER
			$sql="update {$CONFIG['DATABASE'][0]['DATABASE']}.ss_chapter set point=point+{$data['pointnya']} where id={$data['chapterid']}";
			$fetch=$this->apps->query($sql);
			return true;		
		}	
	}
	
	function activestatus($idnya){
		global $CONFIG;

		$sql="update  {$CONFIG['DATABASE'][0]['DATABASE']}.ss_event set n_status=1 where id={$idnya}";
		//pr($sql);exit;
		$fetch=$this->apps->query($sql);
		
		//$sql = "select *, ss_event.name as placename from {$CONFIG['DATABASE'][0]['DATABASE']}.ss_event where id={$idnya}";
		$sql = "select *, date_format(time_start,'%d/%m/%Y %h:%i %p') as tanggal, ss_event.name as placename from ss_event where id={$idnya}";
		$rs = $this->apps->fetch($sql);
		$rt = $rs['chapter_id'];
		
				//CHAPTERNYA 
				$sqlGetChapter = "SELECT * FROM ss_chapter WHERE id='{$rt}'";
				//pr($sqlGetChapter);exit;
				$resGetChapter = $this->apps->fetch($sqlGetChapter);
				//pr($resGetChapter['name']);exit;
			//pr($resGetChapter['email']);
					$dataArray = array(
						'email'=>$resGetChapter['email'],
						'namemember'=>$resGetChapter['name'],
						'tempat'=>$rs['alamat'],
						'hari'=>$rs['tanggal'],
						'tlp'=>$resGetChapter['no_tlp'],
						'eventname'=>$rs['placename'],
						//'typeevent'=>$cateventnya,
						'namechapter'=>$resGetChapter['name_chapter'],
						'idevent'=>$rs['id'],
						'chapterid'=>$rt
					);
					$link = urlencode64(serialize(array(
						'idevent'=>$rs['id'],
						'chapterid'=>$rt
					)));
					//pr($dataArray);exit;
					$returnEmail = $this->send_eventchap($dataArray,$link);
			

				//MEMBERNYA
				$sqlGetmember = "SELECT *, ss_member.name as names FROM ss_member WHERE chapter_id='{$rt}' and n_status='1'";
				//pr($sqlGetmember);exit;
				$resGetmember= $this->apps->fetch($sqlGetmember,1); 
				//pr($resGetmember);exit;
				
				if($resGetmember){
					foreach($resGetmember as $keymember => $valmember){
						if($valmember['username'])
						{
						$dataArray = array(
								'email'=>$valmember['username'],
								'namemember'=>$valmember['names'],
								'tempat'=>$rs['alamat'],
								'hari'=>$rs['tanggal'],
								'tlp'=>$resGetChapter['no_tlp'],
								'eventname'=>$rs['placename'],
								'namechapter'=>$resGetChapter['name_chapter'],
								//'typeevent'=>$cateventnya,
								'idevent'=>$rs['id'],
								'chapterid'=>$rt
							);
							$link = urlencode64(serialize(array(
								'idevent'=>$rs['id'],
								'chapterid'=>$rt
							)));
					//pr($dataArray);exit;
						$returnEmail = $this->send_appevent($dataArray,$link);
						}
					}
				}
		
		return true;	
	}
	
	function send_appevent($dataArray=null,$link=null) {  
		global $LOCALE;

		if($dataArray){
			$results['msg']='';
			$results['status']='';
			$template = $LOCALE[1]['event'];
			$template = str_replace('!#name',$dataArray['namemember'],$template);
			$template = str_replace('!#tempat',$dataArray['tempat'],$template);
			$template = str_replace('!#hari',$dataArray['hari'],$template);
			$template = str_replace('!#typeevent',$dataArray['eventname'],$template);
			$template = str_replace('!#tlp',$dataArray['tlp'],$template);
			//$template = str_replace('!#chaptername',$dataArray['namechapter'],$template);
			//$template = str_replace('!#link',$this->config['BASE_DOMAIN'].'memberreg/reservation?pram='.$link,$template);
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
			curl_setopt($ch, CURLOPT_USERPWD, 'api:key-031f6c645c2c27d331e152ba8a959e28');
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
			curl_setopt($ch, CURLOPT_URL, 
				'https://api.mailgun.net/v3/gte.supersoccer.co.id/messages');
			curl_setopt($ch, CURLOPT_POSTFIELDS, 
			array('from' => 'Supersoccer Community Race<sscr-admin@supersoccer.co.id>',
				'to' => $dataArray['email'],
				'subject' => "Undangan Event ".$dataArray['eventname']."",
				'html' => $template,
				'o:campaign' => 'fkdf5'));
			$result = curl_exec($ch);
			$info = curl_getinfo($ch);
			// pr($info);
			// pr($result);
			$res = json_decode($result,TRUE);
						  
			if($info['http_code']!='200'){
				$results['msg']=$res['message'];
				$results['status']='0';
			}
			else{
				$results['msg']=$res['message'];
				$results['status']='1';
			}
			curl_close($ch);
			return $results;
		}
		$results['status']='0';
		return $results;
	}
	
	function send_eventchap($dataArray=null,$link=null) {  
		global $LOCALE;

		if($dataArray){
			$results['msg']='';
			$results['status']='';
			$template = $LOCALE[1]['eventchap'];
			$template = str_replace('!#name',$dataArray['namemember'],$template);
			$template = str_replace('!#tempat',$dataArray['tempat'],$template);
			$template = str_replace('!#hari',$dataArray['hari'],$template);
			$template = str_replace('!#typeevent',$dataArray['eventname'],$template);
			$template = str_replace('!#tlp',$dataArray['tlp'],$template);
			//$template = str_replace('!#chaptername',$dataArray['namechapter'],$template);
			//$template = str_replace('!#link',$this->config['BASE_DOMAIN'].'memberreg/reservation?pram='.$link,$template);
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
			curl_setopt($ch, CURLOPT_USERPWD, 'api:key-031f6c645c2c27d331e152ba8a959e28');
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
			curl_setopt($ch, CURLOPT_URL, 
				'https://api.mailgun.net/v3/gte.supersoccer.co.id/messages');
			curl_setopt($ch, CURLOPT_POSTFIELDS, 
			array('from' => 'Supersoccer Community Race<sscr-admin@supersoccer.co.id>',
				'to' => $dataArray['email'],
				'subject' => "Undangan Event ".$dataArray['eventname']."",
				'html' => $template,
				'o:campaign' => 'fkdf5'));
			$result = curl_exec($ch);
			$info = curl_getinfo($ch);
			// pr($info);
			// pr($result);
			$res = json_decode($result,TRUE);
						  
			if($info['http_code']!='200'){
				$results['msg']=$res['message'];
				$results['status']='0';
			}
			else{
				$results['msg']=$res['message'];
				$results['status']='1';
			}
			curl_close($ch);
			return $results;
		}
		$results['status']='0';
		return $results;
	}
	
	function addevent($data){
		global $CONFIG;
	
		//pr($data);exit;
		$placename = $data['placename'];
		$events = $data['events'];
		$catevent = $data['catevent'];
		$jumlahpeserta = '50';
		//$lang = $data['lang'];
		$iduser = $data['chapter_id'];
		//$lat = $data['lat'];
		$alamat = '<p>'.$data['alamat'].'</p>';
		$datestart = $data['datestart'];
		$datefinish = $data['datefinish'];
		
		$sql = "SELECT * FROM ss_type_event WHERE id='{$catevent}'";
		$cateventnya = $this->apps->fetch($sql);
		$cateventnya=$cateventnya['name_type'];
		/*$sql = "INSERT INTO `ss_event` SET
						`chapter_id`='{$iduser}',
						`type`='{$catevent}',
						`name`='".$placename."',
						`alamat`='{$alamat}',
						`lat`={$lat},
						`long`='".$lang."',
						`description`='{$events}',
						`target_peserta`='{$jumlahpeserta}',
						`time_start`='{$datestart}',
						`time_end`='{$datefinish}',
						`date_create`=NOW(),
						`n_status`=1
						";*/
		$counter=count($data['chapter_id']);
		
			foreach($data['chapter_id'] as $keys){
				
				$sql = "INSERT INTO `ss_event` SET
						`chapter_id`='{$keys}',
						`type`='{$catevent}',
						`name`='".$placename."',
						`alamat`='{$alamat}',
						
						`description`='{$events}',
						`target_peserta`='{$jumlahpeserta}',
						`time_start`='{$datestart}',
						`time_end`='{$datefinish}',
						`date_create`=NOW(),
						`n_status`=1
						";
				//pr($sql);exit;
				$fetch= $this->apps->query($sql);
				$idevents=$this->apps->getLastInsertId();
						
				//CHAPTERNYA 
				$sqlGetChapter = "select * from ss_chapter, ss_event, ss_type_event 
								where ss_chapter.id=ss_event.chapter_id
								and ss_event.`type`=ss_type_event.id
								and ss_event.n_status='1'
								and ss_chapter.id='{$keys}' order by ss_event.id desc limit 1";
				
				//pr($sqlGetChapter);exit;
				$resGetChapter = $this->apps->fetch($sqlGetChapter);
				//pr($resGetChapter['name']);exit;
				//pr($resGetChapter['email']);
					$dataArray = array(
						'email'=>$resGetChapter['email'],
						//'namechapter'=>$resGetChapter['names'],
						'tempat'=>$alamat,
						'hari'=>$datestart,
						'tlp'=>$resGetChapter['no_tlp'],
						'eventname'=>$placename,
						'typeevent'=>$cateventnya,
						'namemember'=>$resGetChapter['name_chapter'],
						'idevent'=>$idevents,
						'chapterid'=>$keys
					);
					$link = urlencode64(serialize(array(
						'idevent'=>$idevents,
						'chapterid'=>$keys
					)));
					//pr($dataArray);exit;
					$returnEmail = $this->send_addevent($dataArray,$link);
			

				//MEMBERNYA
				$sqlGetmember = "select *, ss_member.name as names from ss_chapter, ss_event, ss_type_event, ss_member
								where ss_chapter.id=ss_event.chapter_id
								and ss_event.`type`=ss_type_event.id
								and ss_chapter.id=ss_member.chapter_id
								and ss_event.n_status='1'
								and ss_chapter.id='{$keys}' order by ss_event.id desc limit 1";
				//pr($sqlGetmember);exit;
				$resGetmember= $this->apps->fetch($sqlGetmember,1); 
				//pr($resGetmember);exit;
				
				if($resGetmember){
					foreach($resGetmember as $keymember => $valmember){
						if($valmember['username'])
						{
						$dataArray = array(
								'email'=>$valmember['username'],
								'namemember'=>$valmember['names'],
								'tempat'=>$alamat,
								'hari'=>$datestart,
								'tlp'=>$resGetChapter['no_tlp'],
								'eventname'=>$placename,
								'namechapter'=>$resGetChapter['name_chapter'],
								'typeevent'=>$cateventnya,
								'idevent'=>$idevents,
								'chapterid'=>$keys
							);
							$link = urlencode64(serialize(array(
								'idevent'=>$idevents,
								'chapterid'=>$keys
							)));
						//pr($dataArray);exit;
						$returnEmail = $this->send_addevent($dataArray,$link);
						}
					}
				}
			}
		
			return true;
		
		
	}

	function send_addevent($dataArray=null,$link=null) {  
		global $LOCALE;

		if($dataArray){
			$results['msg']='';
			$results['status']='';
			$template = $LOCALE[1]['event'];
			$template = str_replace('!#name',$dataArray['namemember'],$template);
			$template = str_replace('!#tempat',$dataArray['tempat'],$template);
			$template = str_replace('!#hari',$dataArray['hari'],$template);
			$template = str_replace('!#typeevent',$dataArray['eventname'],$template);
			$template = str_replace('!#tlp',$dataArray['tlp'],$template);
			//$template = str_replace('!#chaptername',$dataArray['namechapter'],$template);
			//$template = str_replace('!#link',$this->config['BASE_DOMAIN'].'memberreg/reservation?pram='.$link,$template);
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
			curl_setopt($ch, CURLOPT_USERPWD, 'api:key-031f6c645c2c27d331e152ba8a959e28');
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
			curl_setopt($ch, CURLOPT_URL, 
				'https://api.mailgun.net/v3/gte.supersoccer.co.id/messages');
			curl_setopt($ch, CURLOPT_POSTFIELDS, 
			array('from' => 'Supersoccer Community Race<sscr-admin@supersoccer.co.id>',
				'to' => $dataArray['email'],
				'subject' => "Undangan Event ".$dataArray['eventname']."",
				'html' => $template,
				'o:campaign' => 'fkdf5'));
			$result = curl_exec($ch);
			$info = curl_getinfo($ch);
			// pr($info);
			// pr($result);
			$res = json_decode($result,TRUE);
						  
			if($info['http_code']!='200'){
				$results['msg']=$res['message'];
				$results['status']='0';
			}
			else{
				$results['msg']=$res['message'];
				$results['status']='1';
			}
			curl_close($ch);
			return $results;
		}
		$results['status']='0';
		return $results;
	}
	
	function listchap(){
		global $CONFIG;
		
		$sql="select * from {$CONFIG['DATABASE'][0]['DATABASE']}.ss_chapter WHERE n_status=1";
		//pr($sql);exit;
		$fetch=$this->apps->fetch($sql,1);
		//pr($fetch);exit;
		return $fetch;	
	}

        function listcity(){
                global $CONFIG;

                $sql="select * from {$CONFIG['DATABASE'][0]['DATABASE']}.cities ORDER BY city ASC";
                //pr($sql);exit;
                $fetch=$this->apps->fetch($sql,1);
                //pr($fetch);exit;
                return $fetch;
        }
	
	function listeventt(){
		global $CONFIG;

		$sql="select * from {$CONFIG['DATABASE'][0]['DATABASE']}.ss_type_event";
		//pr($sql);exit;
		$fetch=$this->apps->fetch($sql,1);
		//pr($fetch);exit;
		return $fetch;
	}
	
	function selectchap(){
		$sql = "
				SELECT *
				FROM {$this->config['DATABASE'][0]['DATABASE']}.ss_chapter WHERE n_status=1";
		
			$rs = $this->apps->fetch($sql,1); 
			// pr($sql);die;
		return $rs;
	}
	
	function downloadListevent(){
		global $CONFIG;
		$filter='';
		$search=$this->apps->_request('search');
		$status=$this->apps->_g('status');
		$category=$this->apps->_g('category');
		$from=date("Y-m-d",strtotime($this->apps->_request('startdate')));
		$to=date("Y-m-d",strtotime($this->apps->_request('enddate')));
		
		if($search){
			$filter = $search=="Search..." ? "" : "AND (Name LIKE '%{$search}%')";
		}
		
		if($from != '1970-01-01' && $to != '1970-01-01' ){
			$filter .= $from ? " AND `LastUpdate` between '{$from}' AND '{$to}' " : "";
		}
		
		$statusquery="";
		
		if($status==1){
			$statusquery= " AND `n_status`='{$status}'";
		}else if($status==2){
			$statusquery= " AND `n_status`=0";
		}
		
		$categorys="";
		
		if($category){
			$categorys= " AND `type`='{$category}'";
		}
		$sql="select *,ss_event.id as id from  {$CONFIG['DATABASE'][0]['DATABASE']}.ss_event
		left join ss_type_event on ss_type_event.id=ss_event.type where 1   {$statusquery} {$categorys}  {$filter}  and ss_event.n_status!=2 order by ss_event.id ";
		//pr($sql);exit;
		$fetch=$this->apps->fetch($sql,1);
		//pr($fetch);exit;
		return $fetch;
	}
	
	function prosesaddEvent($data){
	
		$placename = $data['placename'];
		$events = $data['events'];
		$catevent = $data['catevent'];
		$jumlahpeserta = '50';
		$lang = $data['lang'];
		$lat = $data['lat'];
		$alamat = $data['alamat'];
		$datestart = $data['datestart'];
		$datefinish = $data['datefinish'];
		// pr($placename);exit;
		// pr($dataemail);exit;

		$sql = "INSERT INTO `ss_event` SET
						`chapter_id`='{$iduser}',
						`type`='{$catevent}',
						`name`='".$placename."',
						`alamat`='{$alamat}',
						`lat`={$lat},
						`long`='".$lang."',
						`description`='{$events}',
						`target_peserta`='{$jumlahpeserta}',
						`time_start`='{$datestart}',
						`time_end`='{$datefinish}',
						`date_create`=NOW(),
						`n_status`=0
						";

		$result= $this->apps->query($sql);
		$idevents=$this->apps->getLastInsertId();
		$sqlmember ="SELECT * FROM ss_member WHERE `chapter_id`='{$iduser}' AND n_status=1";
		$rsmember = $this->apps->fetch($sqlmember,1);
		// pr($rsmember);

		foreach($rsmember as $keymember=>$valuemember){
			if($catevent=='1')
			{
				$typeEvenya ='Nonton Bareng';
			}
			else if($catevent=='2')
			{
				$typeEvenya ='Futsal';
			}
			else
			{
				$typeEvenya ='Gathering';
			}
			$dataArray= array(
				'idevent' => $idevents,
				'userid' => $valuemember['id'],
				'membename' => $valuemember['name'],
				'chapterid' => $iduser,
				'email'=>$valuemember['username'],
				'tempat'=>$alamat,
				'tanggal'=>date('d/m/Y - g:i a',strtotime($datestart)),
				'phone' => $valuemember['no_tlp'],
				'typeevent'=>$typeEvenya
			);

			$link = urlencode64(serialize(array(
				'idevent'=>$idevents,
				'userid'=>$valuemember['id'],
				'chapterid'=>$iduser
			)));
			// pr();
			$this->send_addeventtomemeber($dataArray,$link);
		}
		// pr($sql);die;

		return true;
	}
	
	function editevent($data){
		global $CONFIG;
		//pr($data['startdate']);exit;

		$sql="update {$CONFIG['DATABASE'][0]['DATABASE']}.ss_event set 

		`name`='{$data['name']}',
		
		`alamat`='{$data['alamat']}',
		`time_start`='{$data['startdate']}',
		`time_end`='{$data['enddate']}',
		`lat`='{$data['lat']}',
		`long`='{$data['long']}',
		`description`='{$data['eventdesc']}'

		where `id`='{$data['idnya']}'";

		//pr($sql);exit;

		$fetch = $this->apps->query($sql);
		if($fetch)
		{
			return true;
		}else{
			return false;
		}
	}	

	function checkevent(){
		global $CONFIG;

		$idnya=$this->apps->_p('idnya');

		if($idnya){
			$sql="update  {$CONFIG['DATABASE'][0]['DATABASE']}.ss_event set n_status=1 where id={$idnya}";
			$fetch=$this->apps->query($sql);
			return true;
			}else{
			return false;
		}	
	}

	function checkinactives(){
		global $CONFIG;

		$idnya=intval($_POST['idnya']);
		//	pr($idnya);exit;
		if($idnya){
			$sql="update  {$CONFIG['DATABASE'][0]['DATABASE']}.ss_event set n_status=0 where id={$idnya}";
			$fetch=$this->apps->query($sql);
			return true;
		}else{
			return false;
		}

	}
	
	function deleteevent($inisiasi){
		global $CONFIG;

		if ($inisiasi){
			$sql="delete from {$CONFIG['DATABASE'][0]['DATABASE']}.ss_event where `id`='{$inisiasi}'";
			//pr($sql);exit;
			$fetch = $this->apps->query($sql);
			if($fetch)
			{
				return true;
			}else{
				return false;
			}			
		}		
	}

	function selectevent($inisiasi){
		global $CONFIG;

		if ($inisiasi){
			$sql="select *, ss_event.id as ids, ss_event.alamat as alamatt from {$CONFIG['DATABASE'][0]['DATABASE']}.ss_event, ss_type_event where ss_event.id='{$inisiasi}' and ss_event.type=ss_type_event.id";
			//pr($sql);exit;
			$fetch = $this->apps->fetch($sql,1);
			//pr($fetch);exit;
			//$alamat = $rs['alamatt'];
			
			//$from = substr($alamat,0,2)."-".substr($alamat,0,-2);
			//pr($from);exit;
			//$id=$fetch['ids'];
			//pr($fetch);exit;

			foreach ($fetch as $key => $val){
				$sql = "SELECT name_chapter
					FROM  {$CONFIG['DATABASE'][0]['DATABASE']}.ss_chapter where 1 and id='{$val['chapter_id']}'"; 
				//pr($sql);exit;
				$chapter = $this->apps->fetch($sql);
				//pr($sql);exit;
				$fetch[$key]['time_start']=date("d-m-Y",strtotime($val['time_start']));
				$fetch[$key]['time_startnya']=date("h:i A",strtotime($val['time_start']));
				$fetch[$key]['time_end']=date("d-m-Y",strtotime($val['time_end']));
				$fetch[$key]['time_endnya']=date("h:i A",strtotime($val['time_end']));
				$fetch[$key]['name_chapter'] = $chapter['name_chapter'];
				$fetch[$key]['alamat'] = strip_tags($val['alamat']);
			}
			return $fetch;
		}
	}
}
?>
