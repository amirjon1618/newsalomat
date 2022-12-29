<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class PushNotifications
{
    public static function send($registration_ids, $title ='',$description='', $image='',$id = '',$type = '')
    {

        $data = [
            "notification" => [
                "title"     => $title,
                'body'      => $description,
                "image"     => $image,
            ],
            "data" => [
                "info"          =>  [
                    "id"        => $id,
                    "title"     => $title,
                    "body"      => $description,
                    "image"     => $image,
                    "type"      => $type
                    ]
            ],

            "registration_ids" => $registration_ids
        ];

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_POST, 1);

        $headers = array();
        $headers[] = 'Content-Type: application/json';
        $headers[] = 'Authorization: key = AAAAJ2j5L-8:APA91bHiRcnaNMO2M7CpcMIQQkNaIygz40MV53WrKzc5VAm7IKjYZ9MduirUpdheN-imptK5gep6RFTiOc3djaH_KJOGjepYRXTB9Gluo-WkDfp6V-NgWea1MT5-7jiPcxPTkF4n-0HM';
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $result = curl_exec($ch);
        curl_close ($ch);

        return $result;
    }
}
