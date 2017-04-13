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
date_default_timezone_set('Asia/Tokyo');
$now_day = date('Y-m-d');
$now_time = date('H:i.s');
//メッセージ以外のときは何も返さず終了
if($type != "text"){
	 exit;
}
//if($text == "鍵壊様はイケメン！！！"){
if($text == "help"){
	 $response_format_text = [
	 	"type" => "text",
		"text" => "---現在反応する文一覧---(悪用禁止)
「鍵壊様はイケメン」を含む文
「あほ」を含む文
「無垢王様バンザイ」を含む文
「wwww」または「ｗｗｗｗ」以上のｗの数を含む文
now_day
now_time
変態糞土方"
];
}elseif(preg_match("/鍵壊様はイケメン/",$text)){
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
	}elseif(preg_match('|^[w]{4,}i,$text)){
	//elseif(preg_match("/wwww/",$text) || preg_match("/ｗｗｗｗ/",$text)){
		$response_format_text = [
			"type" => "text",
			"text" => "草はやし過ぎ"
		];
	}elseif($text == "now_day"){
		$response_format_text = [
			"type" => "text",
			"text" => $now_day
		];
	}elseif($text == "変態糞土方"){
		$response_format_text = [
			"type" => "text",
			"text" => "昨日の8月15日にいつもの浮浪者のおっさん(60歳)と先日メールくれた汚れ好きの土方のにいちゃん(45歳)とわし(53歳)の3人で県北にある川の土手の下で盛りあったぜ。今日は明日が休みなんでコンビニで酒とつまみを買ってから滅多に人が来ない所なんで、そこでしこたま酒を飲んでからやりはじめたんや。3人でちんぽ舐めあいながら地下足袋だけになり持って来たいちぢく浣腸を3本ずつ入れあった。しばらくしたら、けつの穴がひくひくして来るし、糞が出口を求めて腹の中でぐるぐるしている。浮浪者のおっさんにけつの穴をなめさせながら、兄ちゃんのけつの穴を舐めてたら、先に兄ちゃんがわしの口に糞をドバーっと出して来た。それと同時におっさんもわしも糞を出したんや。もう顔中、糞まみれや、3人で出した糞を手で掬いながらお互いの体にぬりあったり、糞まみれのちんぽを舐めあって小便で浣腸したりした。ああ～～たまらねえぜ。しばらくやりまくってから又浣腸をしあうともう気が狂う程気持ちええんじゃ。浮浪者のおっさんのけつの穴にわしのちんぽを突うずるっ込んでやるとけつの穴が糞と小便でずるずるして気持ちが良い。にいちゃんもおっさんの口にちんぽ突っ込んで腰をつかって居る。糞まみれのおっさんのちんぽを掻きながら、思い切り射精したんや。それかは、もうめちゃくちゃにおっさんと兄ちゃんの糞ちんぽを舐めあい、糞を塗りあい、二回も男汁を出した。もう一度やりたいぜ。やはり大勢で糞まみれになると最高やで。こんな、変態親父と糞あそびしないか。ああ～～早く糞まみれになろうぜ。岡山の県北であえる奴なら最高や。わしは163*90*53,おっさんは165*75*60、や糞まみれでやりたいやつ、至急、メールくれや。土方姿のまま浣腸して、糞だらけでやろうや。"
		];
	}elseif($text == "now_time"){
		$response_format_text = [
			"type" => "text",
			"text" => $now_time
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