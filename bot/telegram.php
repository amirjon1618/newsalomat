<?php

$body = file_get_contents('php://input'); 
$arr = json_decode($body, true); 

include_once ('tclass.php');   



$tg = new tg('1740798409:AAH5GuaKMB91yehhBvYC8eccrIDfwko92hA');



file_put_contents("text.txt", $body);
//print_r($arr)

$chat_id = $arr['message']['chat']['id'];
// $userTgId = $arr['message']['from']['id'];
$text = $arr['message']['text'];

$users_file = "users.json";

$text_to_send = "";

if($text === "/getoffer") {
    if(file_exists($users_file)) {
        //$chat_id = $arr['message']['chat']['id'];

        $text = file_get_contents($users_file);
        $p = json_decode($text, true);

        if(!isset($p[$chat_id])) {
            $p[$chat_id] = $arr['message']['chat']['username'];
            file_put_contents($users_file, json_encode($p));
            $text_to_send = 'Вы добавлены в список';
        } else {
            $text_to_send = 'Вы и так в этом списке';
        }
    } else {
        $p[$chat_id] = $arr['message']['chat']['username'];
        file_put_contents($users_file, json_encode($p));
        $text_to_send = 'Вы добавлены в список';
    }
} else {
    $text_to_send = "?";
}


$tg->send($chat_id, $text_to_send);

// https://api.telegram.org/bot1828143401:AAHuFihE_GuS3qad--r5FHEH6WzDBy6ZVgk/setWebhook?url=https://sorpizza.tj/bot/telegram.php