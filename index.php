<?php
/*CW*/
/*21 Nov 2014 21:20*/
/*Main base class to obatin deployment keys from config and intialize the app*/


require_once 'google_calender_client.php';
require_once 'calender_processor.php';

$app_config = parse_ini_file("base_config.ini");

if (empty($app_config['CLIENT_ID']) == true || empty($app_config['CLIENT_SECRET']) == true
	|| empty($app_config['REDIRECT_URI']) == true)
{
	echo 'Error: Please make sure you base_config is configure correctly';
}
else
{
    session_start();
    $calender_client = get_calender_client($app_config['CLIENT_ID'], $app_config['CLIENT_SECRET'], $app_config['REDIRECT_URI']);
    $calender_data = calender_processor::process($calender_client);
   
    $_SESSION['CALENDER_DATA'] = $calender_data;
    
    include 'chart_drawer.html';

}


?>
