<?php
global $ENGINE_PATH;
include_once $ENGINE_PATH."Utility/facebook/facebook.php";
class FacebookHelper {
	var $fb;
	var $user_id;
	var $me;
	var $_access_token;
	var $logger;
	function __construct($apps=null){
		global $logger;
		$this->apps = $apps;
		$this->logger = $logger;
		$this->init();
		
	}
	
	function init($param){
		global $FB,$CONFIG,$thisMobile;
	
			$this->fb = new Facebook(array(
			  //'appId'  => '1644650075797391',
			  //'secret' => '447633a630e80373e59f1e0c8e0a1e32',
			  'appId' => '624056151070511',
			  'secret' => '5f49f169ddfec7e3147fe951ea512cf2',
			));
			
			
			// if($param)
			// {
				// if($param['modull']=='teslogin')
				// {
					// $category= serialize($param['category']);
					// $loginReqUri = {basedomain}."teslogin/result?flavorName={$param['flavor_name']}&category={$category}";
				// }
				// else if($param['modull']=='detailfinalist')
				// {
					// $loginReqUri = "http://{$_SERVER['HTTP_HOST']}/soursally-2014/public_html/gallery/finalis/{$param['userid']}/{$param['flavorid']}"; 
				
				// }
				// else
				// {
					// $loginReqUri = "http://{$_SERVER['HTTP_HOST']}/soursally-2014/public_html/finalists?flavorid={$param['flavorid']}"; 
				
				// }
			// }
			// else
			// {
				// $loginReqUri = {basedomain}."teslogin"; 
		
			// }
			
			//pr($this->fb->getUser());
			try{
			
				if($this->fb->getUser()){
					try{
						//pr($this->fb->getUser());die;
						//pr($data['userProfile']); die;
						$this->logger->log('[FACEBOOK] [LOGIN ] : Success login, got logout url ');
						
						// $this->fb->setExtendedAccessToken();
						
						$data['ac'] = $this->fb->getAccessToken();
						$data['user'] =$this->fb->getUser();
						
						$data['userProfile']['socimg']= "https://graph.facebook.com/{$this->fb->getUser()}/picture?type=square&return_ssl_resources=1";
						$data['userProfile']= $this->fb->api('/me?fields=name,email,id,picture');
						$img = "https://graph.facebook.com/{$this->fb->getUser()}/picture?type=square&return_ssl_resources=1";
						if(isset($thisMobile))$params['next'] = "{$CONFIG['MOBILE_SITE']}logout.php";
						else $params['next'] = $loginReqUri;
						
						if($this->fb->getUser()){
							$data['urlConnect'] =$this->fb->getLogoutUrl($params);
							
						}else{
							$params = array('scope' => 'user_mobile_phone,email,user_status,user_activities,publish_actions,user_likes,read_friendlists,user_about_me,user_location,publish_stream,user_relationships,read_stream','redirect_uri'=>"{$loginReqUri}");
							$data['urlConnect'] =$this->fb->getLoginUrl($params);
						}
						//$params = array('scope' => 'user_mobile_phone,email,user_status,user_activities,publish_actions,user_likes,read_friendlists,user_about_me,user_location,publish_stream,user_relationships,read_stream','redirect_uri'=>"{$loginReqUri}");
						//pr($img); die;
						//pr($data['userProfile']); die;
						$userid['id']=$data['user'];
						
						$this->apps->session->setSession('facebook_session','facebook',$data);
						
						//$this->apps->session->setSession($CONFIG['SESSION_NAME'],'WEB',$userid);
					}catch (Exception $e){
					
						$this->logger->log('[FACEBOOK] [LOGIN ] : failed to login , get url login ');
							
						$params = array('scope' => 'user_mobile_phone,email,user_status,user_activities,publish_actions,user_likes,read_friendlists,user_about_me,user_location,publish_stream,user_relationships,read_stream','redirect_uri'=>"{$loginReqUri}");
					
						$data['urlConnect'] =$this->fb->getLoginUrl($params);
						$this->apps->session->setSession('facebook_session','facebook',$data);
						
					}		
					
								
				}else {
					
					$this->logger->log('[FACEBOOK] : get login url ');
					
					$params = array('scope' => 'email,user_status,publish_actions,user_likes,user_about_me,user_location,user_relationships','redirect_uri'=>"http://www.supersoccer.co.id/campusleague/home/loginfb");
				
					$data['urlConnect'] =$this->fb->getLoginUrl($params);
			
					$this->apps->session->setSession('facebook_session','facebook',$data);
					
				}
				return $data;
			}catch (Exception $e){
			
					$this->logger->log('[FACEBOOK] : get login url , failed authorize ');
					
						$params = array('scope' => 'email,user_status,publish_actions,user_likes,user_about_me,user_location,user_relationships','redirect_uri'=>"http://www.supersoccer.co.id/campusleague/home/loginfb");
						
						$data['urlConnect'] =$this->fb->getLoginUrl($params);
						$this->apps->session->setSession('facebook_session','facebook',$data);
						return $data;
			}	
	}
	function checkUserLogin(){
		//pr($this->fb->getUser());
		
		if($this->fb->getUser()){
			$data['userProfile']= $this->fb->api('/me?fields=name,email,id,picture');
			//pr($data['userProfile']);die;
			return true;
		}
		return false;
	}
	function getUser()
	{
		if($this->fb->getUser()){
			$user = $this->fb->getUser();
			return $user;
		}
		return false;
	}
	
	function getEmail()
	{
		if($this->fb->getEmail()){
			$user = $this->fb->getEmail();
			return $user;
		}
		return false;
	}
	function share($data){

			
			$sessionFacebook = $this->apps->session->getSession('facebook_session','facebook');
			$params = array(
				
				  "access_token" =>  $sessionFacebook->ac,// see:   "message" => $message,
				  "link" =>  'http://preview.kanadigital.com/',
				  "picture" =>  $data['flavor_img'],
				  "name" =>  'name',
				  "caption" =>  'caption',
				  "description" =>  'description'
				);
	
			try {
				  $ret = $this->fb->api('/100002512401757/feed', 'POST', $params);
				  
					$result['status']=1;
					$result['messages']='sucsess';
					return $result;
				} catch(Exception $e) {
					$result['status']=3;
					$result['messages']=$e->getMessage();
					return $result;
				
				}
	}
	function destroy()
	{
		$this->fb = new Facebook(array(
			  'appId'  => $FB['appID'],
			  'secret' => $FB['appSecret'],
			));
		$this->fb->destroySession();
	
	}
	function getUserLike()
	{
			$sql = "SELECT id,userid FROM user_flavors ";
			$qData = $this->apps->fetch($sql,1);
			
			foreach (	$qData as $datasql)
			{
				$url = 'http://www.whoisyoggy.com/gallery/detail/'.$datasql['userid'].'/'.$datasql['id'];
			
				 

				 $params = 'select comment_count, share_count, like_count,comments_fbid from link_stat where url = "'.$url.'"';
				 $component = urlencode( $params );
					
				 $url = 'http://graph.facebook.com/fql?q='.$component;
				
				 $fbLIkeAndSahre = json_decode(file_get_contents($url)); 
				
				if($fbLIkeAndSahre->data['0']->comments_fbid)
				{
					 $datacount = $this->fb->api('/'.$fbLIkeAndSahre->data['0']->comments_fbid.'/likes');
					
					 foreach ($datacount['data'] as $userdata)
					 {
						$user = $this->fb->api('/'.$userdata['id']);
						$sql ="SELECT count(*) as total,id FROM social_member where   fbid ='{$user['id']}' LIMIT 1 ";
						 
						$qData = $this->apps->fetch($sql);
						$userid['id']=$qData['id'];
						if($qData['total'] == 0 ) 
							{
								//pr($user );
								$sql = " INSERT INTO social_member 
									(fbid,username,nickname,name,last_name,email,city,sex,last_login,login_count,n_status) 
									VALUES ('{$user['id']}','{$user['first_name']}','{$user['first_name']}','{$user['first_name']}','{$user['last_name']}','','','{$user['gender']}',NOW(),'1','1')";
								
								$query = $this->apps->query($sql);
								$userid['id']=$this->apps->getLastInsertId();
							}
							
						if(	$userid['id'])
						{
								$sql ="SELECT userid FROM user_likes where   userid ='{$userid['id']}' and usr_flavor_id ='{$datasql['id']}'LIMIT 1 ";
								$qData = $this->apps->fetch($sql);
								   
								if(!$qData)
								{
									$sql = " INSERT INTO user_likes 
										(usr_flavor_id,userid,voted_date,n_status) 
										VALUES ('{$datasql['id']}','{$userid['id']}',NOW(),'1')";
									
									$query = $this->apps->query($sql);
								}
						}
					 }
				 }
			}
			
			 //return $getFbStatus->like_count;
	}  
	function getLikecount()
	{
		
		$sql = "SELECT id,userid FROM user_flavors "; 
			$qData = $this->apps->fetch($sql,1);
			 pr($qData);
			foreach ($qData as $datasql)
			{
				
				$url = 'http://www.whoisyoggy.com/gallery/detail/'.$datasql['userid'].'/'.$datasql['id'];
			
				pr($datasql['id']);

				 $params = 'select comment_count, share_count, like_count,comments_fbid from link_stat where url = "'.$url.'"';
				 $component = urlencode( $params );
					
				 $url = 'http://graph.facebook.com/fql?q='.$component;
		
				 $fbLIkeAndSahre = json_decode(file_get_contents($url)); 
				if( $fbLIkeAndSahre)
				{
					$likefb = $fbLIkeAndSahre->data['0']->like_count + $fbLIkeAndSahre->data['0']->share_count + $fbLIkeAndSahre->data['0']->comment_count;
					$sql = " UPDATE user_flavors  SET like_fb='{$likefb}' where   id ='{$datasql['id']}'";
			
					$query = $this->apps->query($sql);
					//$datacount = $this->fb->api('/'.$fbLIkeAndSahre->data['0']->comments_fbid.'/likes?limit=500');
				} 
			}
		return true;
	}
}
?>
