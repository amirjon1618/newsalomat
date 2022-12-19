<?php defined('BASEPATH') OR exit('No direct script access allowed');

use Restserver\Libraries\REST_Controller;

require APPPATH. 'libraries/REST_Controller.php';

class Sales extends REST_Controller
{
    /**
     * Construction
     */
    public function __construct(){

        parent::__construct();

        $this->load->database();
        $this->load->model('indication');
        $this->load->model('category');
        $this->load->model('advertisement');
    }

    /**
     * Sales list
     *
     * @return void
     */
    public function index_get()
    {
        if ($this->input->get("sales_id")) {
            $info = $this->input->get();
            if ($info["min_price"] == "" && $info["max_price"] == "") {
                $res = $this->indication->get_products($info["sales_id"], $info["page"]);
            } else {
                $res = $this->indication
                    ->get_products(
                        $info["sales_id"],
                        $info["page"],
                        $info["min_price"],
                        $info["max_price"]
                    );
            }
            $data['total_products'] = $res;
        }

        $this->response($data, REST_Controller::HTTP_OK);
    }

    /**
     * Sales for header
     *
     * @return void
     */
    public function header_get()
    {
        $res = $this->indication->get_all();


        $this->response($res, REST_Controller::HTTP_OK);
    }
}