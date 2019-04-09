<?php
$access_token = 'EAACZAAV9bZAzwBAEDIyP7eavMrlV8F4jW3ykgMYQZAFDuiBAndmTz7kqoROKZCHmhK80FBPyw1bWfT1QJeFYWJXth5sUbNTPCoEld81wyNMvYJZBXZCDwzojcPaZCzMgZCSHl3IJSeRHxl6Sd9SExLzDM44su7FUYRiMKA4VSdsJVRZCmMJSlomTU';
$verify_token = 'verify_token_hatazu';
$hub_verify_token = null;
if(isset($_REQUEST['hub_mode'])&&($_REQUEST['hub_mode']=='subscribe')){
	$challenge = $_REQUEST['hub_challenge'];
	$hub_verify_token = $_REQUEST['hub_verify_token'];
	if($hub_verify_token === $verify_token){
		header('HTTP/1.1 200 OK');
		echo $challenge;
		die;
	}
}
$input = json_decode(file_get_contents('php://input'),true);
$sender = $input['entry'][0]['messaging'][0]['sender']['id'];
$message = isset($input['entry'][0]['messaging'][0]['message']['text'])	 ? $input['entry'][0]['messaging'][0]['message']['text'] : '';
if($message){
	if($message=='hi'){
		$message_to_repply = "Hello! how can i help you";
	}else {
		$message_to_repply = "this message is for repply";
	}
	
	$url = 'https://graph.facebook.com/v2.6/me/messages?access_token='.$access_token;
	//The JSON data.
	$jsonData = '{
	    "recipient":{
	        "id":"'.$sender.'"
	    },
	    "message":{
	        "text":"'.$message_to_reply.'"
	    }
	}';
	//Encode the array into JSON.
	$jsonDataEncoded = $jsonData;
	//Initiate cURL.
	$ch = curl_init($url);
	//Tell cURL that we want to send a POST request.
	curl_setopt($ch, CURLOPT_POST, 1);

	//Attach our encoded JSON string to the POST fields.
	curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonDataEncoded);

	//Set the content type to application/json
	curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
	//curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded'));
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	$result = curl_exec($ch);
	curl_close($ch);
}else{
	echo "no repply!";
}
?>