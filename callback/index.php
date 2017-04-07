<?php
$accessToken = 'epeoNs1k91cAAbRkDgjEqXkayy+vkidWnRmNQvYOcVjRCa20Q8Nmj7qBJpAM/A2B59HGkJSNs54oq4zdJwOA9BuJomxFMz+PIIMgD7nC1W+wkUxKaaJ5gzymmUhNdb3hEHDIz7ErZlClJ6VSsYoYhwdB04t89/1O/w1cDnyilFU=';
//ユーザーからのメッセージ取得
$json_string = file_get_contents('php://input');
$jsonObj = json_decode($json_string);
$type = $jsonObj->{"events"}[0]->{"message"}->{"type"};
//メッセージ取得
$text = $jsonObj->{"events"}[0]->{"message"}->{"text"};
//ReplyToken取得
$replyToken = $jsonObj->{"events"}[0]->{"replyToken"};
//相手のuserId
$userId = $jsonObj->{"events"}[0]->{"source"}->{"userId"};
//メッセージ以外のときは何も返さず終了
if($type != "text" || $text != "鍵壊様はイケメン！！！"){
	 exit;
}
if($text == "鍵壊様はイケメン！！！"){
	 $response_format_text = [
	 	"type" => "text",
		"text" => "鍵壊様はイケメン！！！"
	];
	}else if(strpos($text,'あほー') !== false){
	$response_format_text = [
		"type" => "text",
		"text" => "もあほー"
	];
	}else{
	//返信データ作成1
	$response_format_text = [
		"type" => "text",
		"text" => "Test API"
	];
}
//返信データ作成2
$response_format_text2 =[
	"type" => "text",
	"text" => "$userId"
	];
$post_data = [
	"replyToken" => $replyToken,
	"messages" => [$response_format_text]
	];
$ch = curl_init("https://api.line.me/v2/bot/message/reply");
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($post_data));
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
	'Content-Type: application/json; charser=UTF-8',
	'Authorization: Bearer ' . $accessToken
	));
$result = curl_exec($ch);
curl_close($ch);
?>