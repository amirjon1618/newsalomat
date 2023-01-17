<?php defined('BASEPATH') or exit('No direct script access allowed');

use Restserver\Libraries\REST_Controller;

require APPPATH . 'libraries/REST_Controller.php';

class Search extends REST_Controller
{
    /**
     * Construction
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('security');
        $this->load->model('product');
        $this->load->database();
    }

    /**
     *Search with param
     *
     */
    public function with_price_get()
    {
        $data['srch_inp'] = $this->input->get("srch_pr_inp");
        $res = $this->product->search_for_prod(
            $this->input->get("srch_pr_inp"),
            $this->input->get("min_price"),
            $this->input->get("max_price"),
            $this->input->get("user_id")

        );
//        var_dump($res);
        if ($res) {
            $newArray  = $res;
            if (sizeof($newArray) != 0) {
                array_multisort(array_column($newArray, 'product_price'), SORT_DESC);
                $res['srch_prod_max_pr'] = $newArray[0]['product_price'];
            }
        }

        if (isset($res['srch_prod_max_pr'])) {
            $data['srch_prod_max_price'] = $res['srch_prod_max_pr'];
        } else {
            $data['srch_prod_max_price'] = 9999;
        }


        $result = [
            'data' => $data,
            'products' => $newArray ?? []
        ];

        $this->response($result, REST_Controller::HTTP_OK);
    }

    /**
     * Search without param
     *
     */
    public function index_get()
    {
        $data['srch_inp'] = $this->input->get("srch_pr_inp");
        $res = $this->product->search_for_prod(
            $this->input->get("srch_pr_inp"),
            $min_price = '',
            $max_price = '',
            $this->input->get("user_id")
        );

        $blogs = array();
        foreach ($res as $key => $value)
            $blogs[$key] = $value;

        if ($res) {
            $newArray  = $res;
            if (sizeof($newArray) != 0) {
                array_multisort(array_column($newArray, 'product_price'), SORT_DESC);
                $res['srch_prod_max_pr'] = $newArray[0]['product_price'];
            }
        }

        if (isset($res['srch_prod_max_pr'])) {
            $data['srch_prod_max_price'] = $res['srch_prod_max_pr'];
        } else {
            $data['srch_prod_max_price'] = 9999;
        }

        $result = [
            'data' => $data,
            'products' => $blogs
        ];

        $this->response($result, REST_Controller::HTTP_OK);
    }
}
