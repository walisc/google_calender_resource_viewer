<?php

//getting the google api
require_once 'google-api-php-client/autoload.php';

function get_calender_client($client_id, $client_secret, $redirect_url)
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
	$initialized = false;
	
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
		$initialized = true;
		// Exchange authorization code for access token
		$accessToken = $client->authenticate($auth_code);
		$client->setAccessToken($accessToken);

	}

	return $initialized ? $service : null;
}
?>