<?php defined('BASEPATH') OR exit('No direct script access allowed');

use Restserver\Libraries\REST_Controller;

require APPPATH. 'libraries/REST_Controller.php';
require APPPATH . 'helpers/PushNotifications.php';

class PushNotification extends REST_Controller
{
    /**
     * Construction
     */
    public function __construct(){

        parent::__construct();

        $this->load->database();
        $this->load->model('notification');
        $this->load->model('user');
    }

    /**
     * Send mailing list notification (СПИСОК РАССЫЛОК)
     *
     */
    public function sendPushNotification_post(int $id)
    {
        $data = $this->notification->get($id);
        $image = base_url()."img/icons/".$data['img'];
        $this->db->select("*");
        $this->db->from('users');
        $this->db->where("onesignal_id !=", NULL);
        $this->db->where("access =", "10");
        $query = $this->db->get();
        $users = $query->result_array();
        $tokens = [];
        foreach ($users as $user){
            $tokens[] = $user['onesignal_id'];
        }
        $result = PushNotifications::send($tokens,$data['name'],$data['description'],$image,$id);

        $this->response($result, REST_Controller::HTTP_OK);
    }

    /**
     * Show notification by id(РАССЫЛКА по id)
     *
     */
    public function show_get(int $id)
    {
        $data = $this->notification->get($id);
        $image = base_url()."img/icons/".$data['img'];

        $result = [
            'id'    => $data['id'],
            "title" => $data['name'],
            'body'  => $data['description'],
            "image" => $image,
        ];

        $this->response($result, REST_Controller::HTTP_OK);
    }

    /**
     *  СПИСОК РАССЫЛОК
     *
     */
    public function index_get()
    {
        $data = $this->notification->get_all();
        $result = array();
        foreach ($data as $item){
            $result []= [
                'id'    => $item['id'],
                "title" => $item['name'],
                'body'  => $item['description'],
                "image" => base_url()."img/icons/".$item['img'],
            ];
        }

        $this->response($result, REST_Controller::HTTP_OK);
    }
}