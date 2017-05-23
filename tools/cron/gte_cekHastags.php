<?php 
//global $ENGINE_PATH;

include_once "/home/gte/campusrace/engines/Utility/Twitter/tmhOAuth.php";
include_once "/home/gte/campusrace/engines/Utility/Twitter/tmhUtilities.php";
include_once "db.php";
$DB = new db();
$tmhOAuth = new tmhOAuth(array(
							  'consumer_key'    => '74WToh3jtshQDesYINEcv81Za',
							  'consumer_secret' =>  'MUQXYeUCD8kSA2R4aXpfZ7FpuNsvfsiF0CbFtzxDuB1hd5tDDA'
							));

		$sqlcekhastag= $DB->fetch("SELECT * FROM ss_campus_race.ss_chalangge WHERE category='2' AND n_status=1 AND date(start_time)<=date(NOW()) AND (date(end_time)<=date(NOW()) OR date(end_time)>=date(NOW()))",true);
		
		if(sizeof($sqlcekhastag)>0){
			foreach($sqlcekhastag as $rowhastags)
			{
				$posts=urlencode('#'.$rowhastags->hastags);
				
				 $params = array('q' => $posts,'include_entities'=>true);
			
				$status = $tmhOAuth->request('GET', $tmhOAuth->url("1.1/search/tweets"),$params);
				
				if($status == 200){
					$rs = json_decode($tmhOAuth->response['response'],true);
					
					foreach($rs['statuses'] as $key=>$row)
					{
						$sqlcekusernya="SELECT * FROM ss_campus_race.ss_member WHERE twiiter_id='{$row['user']['screen_name']}'";
					
						$sqlcekuser = $DB->fetch($sqlcekusernya,true);
						
						if($sqlcekuser){
										foreach($sqlcekuser as $rowcekuser)
										{
											//type parameret di sesuaikan dengan point
											
											$sqlchecktwitter = "
																SELECT *
																FROM ss_campus_race.ss_twiter 
																WHERE twitter_text_id='{$row['id_str']}' AND user_id='{$rowcekuser->id}'";
																// echo"<pre>";print_r($sqlchecktwitter);
											$checktwitter = $DB->fetch($sqlchecktwitter);
											 
											// echo"<pre>";
											// print_r($sqlchecktwitter);
											if($checktwitter=='')
											{
													
													$sqlchecktwittertotal = "
																	SELECT count(*) as Total
																	FROM ss_campus_race.ss_twiter 
																	WHERE chalange_id='{$rowhastags->id}' AND user_id='{$rowcekuser->id}'";
													
													$checktwittertotal = $DB->fetch($sqlchecktwittertotal);
													
													// echo"<pre>";print_r($checktwittertotal);
												
													if($checktwittertotal->Total<=9)
													{
														
																$sql1 = "INSERT INTO ss_campus_race.ss_list_pesertatantangan SET
																							`tantangan_id`='{$rowhastags->id}',
																							`chapter_id`='{$rowcekuser->chapter_id}',
																							`member_id`='{$rowcekuser->id}',
																							`date_checkin`=NOW(),
																							`point`='5',
																							`n_status`=1
																							";
																	
															   $queue = $DB->query($sql1);
															
														
															$sql = "INSERT INTO ss_campus_race.ss_twiter SET
																	`twitter_text_id`='{$row['id_str']}',
																	`chalange_id`='{$rowhastags->id}',
																	`hastags`='".$posts."',
																	`user_id`='{$rowcekuser->id}',
																	`date`=NOW(),
																	`n_status`=1
																	";
															// echo $sql;
															
															$queue = $DB->query($sql);
															
															$sql = "INSERT INTO ss_campus_race.ss_activity_log SET
																`type_paremeter_point`='16',
																`chalangge_id`='{$rowhastags->id}',
																`user_id`='{$rowcekuser->id}',
																`chapter_id`='{$rowcekuser->chapter_id}',
																`point`='5',
																`date`=NOW(),
																`n_status`=1
																";
													
														$queue = $DB->query($sql);
														
														$sql = "
																UPDATE ss_campus_race.ss_member set `point`=point+5 where `id`='{$rowcekuser->id}'";
														
														$queue = $DB->query($sql);
													}
											}
											
										}
										
								
								}
					}
				}else{
					return array();
				}
			}
		}

?>
