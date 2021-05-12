<?php
	//Sample using the CMBase.php wrapper to call Subscriber.AddWithCustomFields from any version of PHP
	
	//Relative path to CMBase.php. This example assumes the file is in the same folder
	require_once('CMBase.php');
	
	//Your API Key. Go to http://www.campaignmonitor.com/api/required/ to see where to find this and other required keys
	
	$api_key = 'bafb8a9c669a47592624cdca320c5c1a';
	$client_id = null;
	$campaign_id = null;
	//$list_id = 'a8eebb9f1c9acc01266327fb10979e61';   // Sample List
	$list_id = '2b08490fc6928a01c7345aecc70cd572';   // AmziNews
	$cm = new CampaignMonitor( $api_key, $client_id, $campaign_id, $list_id );
	
	//Optional statement to include debugging information in the result
	//$cm->debug_level = 1;
	
	$email = 'fran@gg.com';
	$name = 'Fran Love';
	//This is the actual call to the method, passing email address, name.
	$result = $cm->subscriberAdd($email, $name);

	
	if($result['Result']['Code'] == 0)
		echo 'Success' . $name . ' ' . $email;
	else
		echo 'Error : ' . $result['Result']['Message'];
	
	//Print out the debugging info
	//print_r($cm);
?>