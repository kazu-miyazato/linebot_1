<?php

require_once __DIR__ . '/vendor/autoload.php';

$httpClient = new \LINE\LINEBot\HTTPClient\CurlHTTPClient(getenv('CHANNEL_ACCESS_TOKEN'));
$bot = new \LINE\LINEBot($httpClient, ['channelSecret' => getenv('CHANNEL_SECRET')]);

//userid定義
$userId = 'Uf5d4de7c0f268a6b4bbd936c69c32461';

//Pushメッセージ作成
$textMessageBuilder = new \LINE\LINEBot\MessageBuilder\TextMessageBuilder('hello');

//Pushメッセージ送信
$response = $bot->pushMessage($userId, $textMessageBuilder);

//ログ出力？
echo $response->getHTTPStatus() . ' ' . $response->getRawBody();

/*
$signature = $_SERVER["HTTP_" . \LINE\LINEBot\Constant\HTTPHeader::LINE_SIGNATURE];
try {
  $events = $bot->parseEventRequest(file_get_contents('php://input'), $signature);
} catch(\LINE\LINEBot\Exception\InvalidSignatureException $e) {
  error_log("parseEventRequest failed. InvalidSignatureException => ".var_export($e, true));
} catch(\LINE\LINEBot\Exception\UnknownEventTypeException $e) {
  error_log("parseEventRequest failed. UnknownEventTypeException => ".var_export($e, true));
} catch(\LINE\LINEBot\Exception\UnknownMessageTypeException $e) {
  error_log("parseEventRequest failed. UnknownMessageTypeException => ".var_export($e, true));
} catch(\LINE\LINEBot\Exception\InvalidEventRequestException $e) {
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

  if (strcmp($event->getText(), "かわいいね") == 0){
    $bot->replyText($event->getReplyToken(), "イエーーーーーーイ！");
  }
  else if (strcmp($event->getText(), "こんにちは") == 0){
    $bot->replyText($event->getReplyToken(), "コンニチワ");
  }
  else if (strcmp($event->getText(), "おはよう") == 0){
    $bot->replyText($event->getReplyToken(), "オハヨー");
  }
  else if (strcmp($event->getText(), "ありがとう") == 0){
    $bot->replyText($event->getReplyToken(), "アリガット");
  }
  else{
  $bot->replyText($event->getReplyToken(), $event->getText());

  //print "UserId:" . $event->getUserId();
  //fputs(STDOUT, "hello world to stdout\n");
  error_log("UserId" . $event->getUserId() . "\n");
  //file_put_contents("php://stderr", "hello, this is a test!\n");
}

}
*/

?>
