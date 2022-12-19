<?php defined('BASEPATH') or exit('No direct script access allowed');

use Restserver\Libraries\REST_Controller;

require APPPATH . 'libraries/REST_Controller.php';

class Orders extends REST_Controller
{
    /**
     * Construction
     */
    public function __construct()
    {

        parent::__construct();

        $this->load->helper('security');
        $this->load->library('form_validation');
        $this->load->database();
        $this->load->model('order');
    }

    /**
     * Get orders list
     *
     * @return void
     */
    public function index_get()
    {
        header("Access-Control-Allow-Origin: *");

        $user_id = $this->input->get('user_id');
        $headers = $this->input->request_headers();
        $platform = $headers['platform'] ?? 'android';

        $this->load->library('Authorization_Token');
        $is_valid_token = $this->authorization_token->validateToken();

        if (!empty($is_valid_token) && $is_valid_token['status'] === TRUE) {

            if ($platform == 'IOS') {
                $data = json_decode(file_get_contents('php://input'), true);
                $_POST = $data;
            }

            $this->response($this->order->user_orders($user_id) ?? [], REST_Controller::HTTP_OK);
        } else {
            $message = [
                'status' => FALSE,
                'message' => $is_valid_token['message']
            ];

            $this->response($message, REST_Controller::HTTP_UNAUTHORIZED);
        }
    }

    /**
     * Store Order
     *
     * @return void
     */
    public function index_post()
    {
        header("Access-Control-Allow-Origin: *");

        $json = $this->input->raw_input_stream;
        $array = json_decode($json);

        $this->load->library('Authorization_Token');
        $is_valid_token = $this->authorization_token->validateToken();

        if (!empty($is_valid_token) && $is_valid_token['status'] === TRUE) {
            if ($array->products) {
                $array->code = null;
                if (!is_numeric($array->delivery_id)) {
                    $array->delivery_id = 1;
                }

                $res = $this->order->row_add($array);
                $this->order->save_user_order_status_change($array->user_id, $res['order_id'], 1, 1, $array->comment);

                $message = [
                    'status' => true,
                    'order_id' => $res['order_id']
                ];
                $this->response($message, REST_Controller::HTTP_OK);
            }
        } else {
            $message = [
                'status' => FALSE,
                'message' => $is_valid_token['message']
            ];

            $this->response($message, REST_Controller::HTTP_UNAUTHORIZED);
        }
    }
}
