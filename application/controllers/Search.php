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
       $srch_pr_inp = $this->replaceStr($this->input->get("srch_pr_inp"));
        $data['srch_inp'] = $srch_pr_inp;

        $res = $this->product->search_for_prod(
            $srch_pr_inp,
            $this->input->get("min_price"),
            $this->input->get("max_price"),
            $this->input->get("user_id")

        );

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
            'productsd' => $newArray ?? []
        ];

        $this->response($result, REST_Controller::HTTP_OK);
    }

    /**
     * Search without param
     *
     */
    public function index_get()
    {
        $srch_pr_inp = $this->replaceStr($this->input->get("srch_pr_inp"));
        $res = $this->product->search_for_prod(
            $srch_pr_inp,
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

    private function replaceStr($searchText)
    {
        $cyr=array(
            "Щ", "Ш", "Ч","Ц", "Ю", "Я", "Ж","А","Б","В","Г","Д","Е","Ё","З","И","Й","К","Л","М","Н", "О","П","Р",
            "С","Т","У","Ф","Х","Ь","Ы","Ъ", "Э","Є", "Ї","І", "щ", "ш", "ч","ц", "ю", "я", "ж","а","б","в", "г","д",
            "е","ё","з","и","й","к","л","м","н", "о","п","р","с","т","у","ф","х","ь","ы","ъ", "э","є", "ї","і"
        );

        $lat=array(
            "Shch","Sh","Ch","C","Yu","Ya","J","A","B","V","G","D","E","E","Z","I","y","K","L","M","N", "O","P","R","S",
            "T","U","F","H","", "Y","","E","E","Yi","I","shch","sh","ch","c","Yu","Ya","j","a","b","v", "g","d","e","e",
            "z","i","y","k","l","m","n", "o","p","r","s","t","u","f","h", "", "y","" ,"e","e","yi","i"
        );

        $searchText = str_replace($lat,$cyr,$searchText);
        $searchText = str_replace("_"," ",$searchText);

        return $searchText;
    }
}
