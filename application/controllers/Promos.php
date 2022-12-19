<?php defined('BASEPATH') OR exit('No direct script access allowed');

use Restserver\Libraries\REST_Controller;

require APPPATH. 'libraries/REST_Controller.php';

class Promos extends REST_Controller
{
    /**
     * Construction
     */
    public function __construct(){

        parent::__construct();

        $this->load->database();
        $this->load->model('PromoCode');
    }

    /**
     * List PromoCode
     *
     * @return void
     */
    public function index_get()
    {
        if ($this->input->get("promo_code")) {

            $data = $this->PromoCode->get_promo_code($this->input->get("promo_code"));
            $message = [
                'status'    => !empty($data[0]) ? true : false,
                'data'      => $data[0] ?? null
            ];
            $this->response($message, REST_Controller::HTTP_OK);
        } else {

            $message = [
                'status' => false
            ];
            $this->response($message, REST_Controller::HTTP_BAD_REQUEST);
        }
    }
}