<?php
class cekvoucer extends ServiceAPI{
	
	function beforeFilter(){
				
		global $LOCALE,$CONFIG;
		$this->assign('basedomain', $CONFIG['BASE_DOMAIN']);
		$this->assign('assets_domain', $CONFIG['ASSETS_DOMAIN_WEB']);
		$this->assign('locale', $LOCALE[1]);		
		$this->assign('pages', strip_tags($this->_g('page')));		
	}
	function voucer()
	{
		global $LOCALE,$CONFIG;
		//$contents=file_get_contents('/home/gte/campusrace/tools/cron/gte_broadcast-voucer-info.sh');
		$contents=file_get_contents("'".$CONFIG['BASE_DOMAIN']."'../tools/cron/gte_broadcast-voucer-info.sh");
		shell_exect($contents);
	}
}
?>