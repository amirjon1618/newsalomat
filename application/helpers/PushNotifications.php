<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class PushNotifications
{
    public static function send($oneSignalId, $message)
    {
        $content = array(
            "en" => $message
        );

        $fields = array(
            'app_id' => "a899a164-c198-4e81-9c93-076a69e81476",
            'include_player_ids' => array($oneSignalId),
            'data' => array("foo" => "bar"),
            'contents' => $content
        );

        $fields = json_encode($fields);
        print("\nJSON sent:\n");
        print($fields);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json; charset=utf-8', 'Authorization: Basic ZjNlYjFkMTktMDQyNi00NGU0LThiYWMtMWIwODcxM2ViZTg2'));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        curl_setopt($ch, CURLOPT_POST, TRUE);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

        $response = curl_exec($ch);
        curl_close($ch);

        return $response;
    }
}
