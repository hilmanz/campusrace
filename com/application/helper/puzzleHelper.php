<?php

class puzzleHelper {
	
	var $_mainLayout="";
	
	var $login = false;
	
	function __construct($apps){
		global $logger,$CONFIG;
		$this->logger = $logger;
		$this->apps = $apps;
 
		
		$this->config = $CONFIG;
		if( $this->apps->session->getSession($this->config['SESSION_NAME'],"admin") ){
			
			$this->login = true;
		
		}
		 
	}
	
	function puzzle(){
		$sql="select *from {$this->config['DATABASE'][0]['DATABASE']}.ss_puzzle where n_status='1'";
	
		$result= $this->apps->fetch($sql);
		return $result;
	}
	
	function ulangpuzzle($id)
	{	
		$tglskrg=date('Y-m-d');
		$sql = "SELECT count(*)as total FROM  {$this->config['DATABASE'][0]['DATABASE']}.ss_skor_puzzle
					WHERE user_id='$id' and DATE_FORMAT(created,'%Y-%m-%d')='$tglskrg'";	
		$result = $this->apps->fetch($sql); 
		return $result;		
	}
	
	function savedata(){
		global $CONFIG;
			$user_id=$_POST['user_id'];
			$chapter_id=$_POST['chapter_id'];
			$timer=$_POST['timer'];
			$created=date("y-m-d h:i:s");
			$puzzle_id=$_POST['puzzle_id'];
			
		$sql = "INSERT INTO {$CONFIG['DATABASE'][0]['DATABASE']}.ss_skor_puzzle SET							
								`user_id`='".$user_id."',
								puzzle_id='".$puzzle_id."',
								chapter_id='".$chapter_id."',
								timer='".$timer."',
								point='5',
								created='".$created."'
								";
				
		$fetch= $this->apps->query($sql);			
				
		$sql="insert into {$CONFIG['DATABASE'][0]['DATABASE']}.ss_activity_log set type_paremeter_point=18,
					chapter_id='{$chapter_id}',chalangge_id='{$puzzle_id}',user_id='{$user_id}',date=NOW(),point='5',n_status='1'";
					
		$fetch1=$this->apps->query($sql);	

		
		$sql="update {$CONFIG['DATABASE'][0]['DATABASE']}.ss_member set point=point+5 where id={$user_id}";
					
		$fetch2=$this->apps->query($sql);
		
		return true;
	
	}
	
	
	
	
}