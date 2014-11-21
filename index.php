<?php
/*Chido Warambwa*/
/*21 Nov 2014 21:20*/
/*Main base class to obatin deployment keys from config and intialize the app*/

//getting the google api
require_once 'google-api-php-client/autoload.php';

$app_config = parse_ini_file("base_config.ini");

if (empty($app_config['CLIENT_ID']) == true || empty($app_config['CLIENT_SECRET']) == true
	|| empty($app_config['REDIRECT_URI']) == true)
{
	echo 'Error: Please make sure you base_config is configure correctly';
}
else
{
	set_up_google_client($app_config['CLIENT_ID'], $app_config['CLIENT_SECRET'], $app_config['REDIRECT_URI']);
}

function set_up_google_client($client_id, $client_secret, $redirect_url)
{
	$client = new Google_Client();
	// OAuth2 client ID and secret can be found in the Google Developers Console.
	$client->setClientId($client_id);
	$client->setClientSecret($client_secret);
	//make sure your redirect uri match the place you are running this file from
	$client->setRedirectUri($redirect_url);
	$client->addScope('https://www.googleapis.com/auth/calendar');

	$service = new Google_Service_Calendar($client);
	
	$auth_code = isset($_GET["code"]) ? $_GET["code"] : '';
	
	if (empty($auth_code) == true)
	{
		$authUrl = $client->createAuthUrl();

		//Request authorization
		echo "<script type=\"text/javascript\">
				window.open('$authUrl', '_blank')
			  </script>";
		
	}
	else
	{
		// Exchange authorization code for access token
		$accessToken = $client->authenticate($auth_code);
		$client->setAccessToken($accessToken);
	}

}

?>