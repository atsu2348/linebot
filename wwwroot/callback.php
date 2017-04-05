<?php // callback.php
define("LINE_MESSAGING_API_CHANNEL_SECRET", 'your channel secret');
define("LINE_MESSAGING_API_CHANNEL_TOKEN", 'your channel token');
      
require __DIR__."/../vendor/autoload.php";

$bot = new \LINE\LINEBot(
    new \LINE\LINEBot\HTTPClient\CurlHTTPClient(LINE_MESSAGING_API_CHANNEL_TOKEN),
    ['channelSecret' => LINE_MESSAGING_API_CHANNEL_SECRET]
);

$signature = $_SERVER["HTTP_".\LINE\LINEBot\Constant\HTTPHeader::LINE_SIGNATURE];
$body = file_get_contents("php://input");

$events = $bot->parseEventRequest($body, $signature);

foreach ($events as $event) {
    if ($event instanceof \LINE\LINEBot\Event\MessageEvent\TextMessage) {
            $reply_token = $event->getReplyToken();
	    $text = $event->getText();
	    $bot->replyText($reply_token, $text);
	}
}

echo "OK";