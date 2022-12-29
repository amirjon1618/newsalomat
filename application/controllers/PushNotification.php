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
        $this->load->model('order');
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
        $result = PushNotifications::send($tokens,$data['name'],$data['description'],$image,$id,$data['name']);

        $this->response($result, REST_Controller::HTTP_OK);
    }

    /**
     * Send mailing list notification (СПИСОК РАССЫЛОК)
     *
     */
    public function orderPushNotification_post(int $id)
    {
        $order = $this->order->get($id);
        $order_user = $this->order->get_user($id);

            $status = '';
            if ($this->input->post('status_id') == -1){
                $status = 'Отменен';
            }if ($this->input->post('status_id') == 0){
                $status = 'Не подтвержён';
            }if ($this->input->post('status_id') == 1){
                $status = 'В ожидании';
            }if ($this->input->post('status_id') == 2){
                $status = 'На обработку';
            }if ($this->input->post('status_id') == 3){
                $status = 'Отправлен на сборку';
            }if ($this->input->post('status_id') == 4){
                $status = 'Доставлен';
            }

            $title = "Здавствуйте, ваш заказ под № $id сменил статус";
            $description = "Теперь он находится в статусе << $status >>";

        $token[] =$order_user[0]['onesignal_id'];

        $result = PushNotifications::send($token, $title, $description,'',$id,'orders');

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
            "type"  => $data['type'],
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
                "type"  => $item['type'],
            ];
        }

        $this->response($result, REST_Controller::HTTP_OK);
    }
}