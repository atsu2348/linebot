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
$now_day = date('Y-m-d');
//メッセージ以外のときは何も返さず終了
if($type != "text"){
	 exit;
}
//if($text == "鍵壊様はイケメン！！！"){
if(preg_match("/鍵壊様はイケメン/",$text)){
	 $response_format_text = [
	 	"type" => "text",
		"text" => "鍵壊様はイケメン！！！"
	];
	}elseif(preg_match("/あほ/",$text)){
		$response_format_text = [
			"type" => "text",
			"text" => "もあほー"
		];
	}elseif(preg_match("/無垢王様バンザイ/",$text)){
		$response_format_text = [
			"type" => "text",
			"text" => "無垢王様バンザイ！！！"
		];
	}elseif(preg_match("/wwww/",$text) || preg_match("/ｗｗｗｗ/",$text)){
		$response_format_text = [
			"type" => "text",
			"text" => "草はやし過ぎ"
		];
	}elseif($text == "今日の日付"){
		$response_format_text = [
			"type" => "text",
			"text" => $now_day
		];
	}elseif($text != "鍵壊様はイケメン！！！"){
	//}else{
	exit;
}
//返信データ作成1
$response_format_text1 = [
	"type" => "text",
	"text" => "Test API"
	];
//返信データ作成2
$response_format_text2 =[
	"type" => "text",
	"text" => "$userId"
	];
$post_data = [
	"replyToken" => $replyToken ,
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