<?php

// $body = file_get_contents('php://input'); 
// $arr = json_decode($body, true); 

include_once ('tclass.php');   

$tg = new tg('1740798409:AAH5GuaKMB91yehhBvYC8eccrIDfwko92hA');

// $chat_id = $arr['message']['chat']['id'];
// $userTgId = $arr['message']['from']['id'];
// $text = $arr['message']['text'];

// $arr = [];
// $arr['chat_id'] = "@pulatov_farhod";
$users_file = "users.json";

$text_to_send = "";

$msg = $_GET['text'];

if(file_exists($users_file)) {
    $text = file_get_contents("users.json");

    $p = json_decode($text, true);

    foreach($p as $i => $x)
    {
        print_r($tg->send($i, $msg));
    }

}

// https://api.telegram.org/bot1740798409:AAH5GuaKMB91yehhBvYC8eccrIDfwko92hA/setWebhook?url=https://sorpizza.tj/bot/telegram.php