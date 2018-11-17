<?php

require_once __DIR__ . '/vendor/autoload.php';

$httpClient = new \LINE\LINEBot\HTTPClient\CurlHTTPClient(getenv('CHANNEL_ACCESS_TOKEN'));
$bot = new \LINE\LINEBot($httpClient, ['channelSecret' => getenv('CHANNEL_SECRET')]);

$signature = $_SERVER["HTTP_" . \LINE\LINEBot\Constant\HTTPHeader::LINE_SIGNATURE];
try {
  $events = $bot->parseEventRequest(file_get_contents('php://input'), $signature);
} catch(¥LINE¥LINEBot¥Exception¥InvalidSignatureException $e){
  error_log("parseEventRequest failed. InvalidSignatureException => ".var_export($e, true));
} catch(¥LINE¥LINEBot¥Exception¥UnknownEventTypeException $e){
  error_log("parseEventRequest failed. UnknownEventTypeException => ".var_export($e, true));
} catch(¥LINE¥LINEBot¥Exception¥UnknownMessageTypeException $e){
  error_log("parseEventRequest failed. UnknownMessageTypeException => ".var_export($e, true));
} catch(¥LINE¥LINEBot¥Exception¥InvalidEventRequestException $e){
  error_log("parseEventRequest failed. InvalidEventRequestException => ".var_export($e, true));
}

foreach ($events as $event) {
  if (!($event instanceof \LINE\LINEBot\Event\MessageEvent)) {
    error_log('Non message event has come');
    continue;
  }
  if (!($event instanceof \LINE\LINEBot\Event\MessageEvent\TextMessage)) {
    error_log('Non text message has come');
    continue;
  }

  if (strcmp($event->getText(), "おはよう") == 0){
    $bot->replyText($event->getReplyToken(), "それそれ！やっぱり挨拶は基本だよね");
  }
  else if (strcmp($event->getText(), "こんにちは") == 0){
    $bot->replyText($event->getReplyToken(), "はい、こんにちは。よくできました");
  }
  else if (strcmp($event->getText(), "こんばんは") == 0){
    $bot->replyText($event->getReplyToken(), "こんばんは、今日もお疲れさま！");
  }
  else if (strcmp($event->getText(), "バイバイ") == 0){
    $bot->replyText($event->getReplyToken(), "またね〜〜");
  }
  else{
    $bot->replyText($event->getReplyToken(), "ちがう！！挨拶をしなさい");
  }
}

 ?>
