<?php ob_start(); 

ini_set('session.gc_maxlifetime',(1*60*60*24*2) );
ini_set('session.cookie_lifetime',(1*60*60*24*2) );

// session_set_cookie_params((1*60*60*24*2),"/","localhost",TRUE,TRUE);


include_once "common.php";

include_once $APP_PATH.ADMIN_APPS."/App.php";
include_once $ENGINE_PATH."Utility/Debugger.php";
$logger = new Debugger();
$logger->setAppName(ADMIN_APPS);
$logger->setDirectory($CONFIG['LOG_DIR']);
$app = new App();
$app->main();

print $app;
die();
?>
