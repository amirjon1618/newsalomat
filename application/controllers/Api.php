<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Api extends CI_Controller
{


    public function __construct()
    {
        header('Access-Control-Allow-Origin: *');
        parent::__construct();
        $this->load->helper('cookie');
        $this->load->model('product');
    }

    public function SmsTest()
    {
        $this->load->model("sms");
        $this->sms->send("988066463", "test text");
        echo 'finish';
    }

    public function GetMinSubCategory()
    {
        $this->load->model("category");
        $term = $this->input->get("term");

        $categories = array();
        $categories = $this->category->get_min_sub_category($term);

        echo json_encode($categories);
    }

    public function GetSubCategory()
    {
        $this->load->model("category");
        $term = $this->input->get("term");
        $categories = array();
        $categories = $this->category->get_sub_category($term);

        echo json_encode($categories);
    }

    public function GetIndication()
    {
        $this->load->model("indication");
        $term = $this->input->get("term");

        $indications = array();
        $indications = $this->indication->get_indication($term);


        echo json_encode($indications);
    }

    public function GetActiveSubstance()
    {
        $this->load->model("ActiveSubstance");
        $term = $this->input->get("term");

        //		$active_substance = array();
        $active_substance = $this->ActiveSubstance->get_active_substance($term);

        echo json_encode($active_substance);
    }

    public function GetForm()
    {
        $this->load->model("form");
        $term = $this->input->get("term");

        //		$forms = array();
        $forms = $this->form->get_form($term);
        echo json_encode($forms);
    }

    public function GetBrand()
    {
        $this->load->model("brand");
        $term = $this->input->get("term");

        //		$brands = array();
        $brands = $this->brand->get_brand($term);
        echo json_encode($brands);
    }

    public function GetCountry()
    {
        $this->load->model("country");
        $term = $this->input->get("term");

        //		$countries = array();
        $countries = $this->country->get_country($term);

        echo json_encode($countries);
    }

    public function GetTag()
    {
        $this->load->model("tag");
        $term = $this->input->get("term");

        $tags = $this->tag->get_tag($term);

        echo json_encode($tags);
    }

    public function GetAdBannerInfo($id)
    {
        $this->load->model("advertisement");
        $this->load->model("category");
        $data = $this->advertisement->get($id);
        if ($data['advertisement_category'] != null) {
            $category = $this->category->get($data['advertisement_category']);
            $data['advertisement_category_name'] = $category['category_name'];
        }

        echo json_encode($data);
    }

    public function GetBannerInfo($id)
    {
        $this->load->model("slider");
        $data = $this->slider->get($id);

        echo json_encode($data);
    }

    public function GetBrandInfo($id)
    {
        $this->load->model("brand");
        $data = $this->brand->get($id);
        echo json_encode($data);
    }

    public function GetTagInfo($id)
    {
        $this->load->model("tag");
        $data = $this->tag->get($id);
        echo json_encode($data);
    }

    public function GetPromoCodeInfo($id)
    {
        $this->load->model("PromoCode");
        $data = $this->PromoCode->get($id);
        echo json_encode($data);
    }

    public function GetRecipePics($id)
    {
        $this->load->model("recipe");
        $data = $this->recipe->get_recipe_pics($id);
        $recipe = $this->recipe->get($id);

        echo json_encode(array('pics' => $data, 'recipe_phone' => $recipe['recipe_phone']));
    }

    public function GetActiveSubstanceInfo($id)
    {
        $this->load->model("ActiveSubstance");
        $data = $this->ActiveSubstance->get($id);

        echo json_encode($data);
    }

    public function checkEmailForRating()
    {
        $email = $this->input->post('review_email');
        $prod_id = $this->input->post('product_id');
        $this->load->model('rating');
        $isFound = $this->rating->find($prod_id, $email);

        echo json_encode($isFound);
    }

    public function sendReview()
    {
        $this->load->model('rating');
        if (
            $this->input->post("prod_id")
            && $this->input->post("review_rating")
            && $this->input->post("review_name")
            && $this->input->post("review_comment")
        ) {
            $array = $this->input->post();
            $answer = $this->rating->add($array);
            if ($answer == 1) {
                echo json_encode(1);
            } else {
                echo json_encode(-1);
            }
        } else {
            echo json_encode(-1);
        }
    }


    public function update_sms($sms_id, $array, $source_id, $source_name)
    {
        $this->load->model('sms');
        $date = new DateTime($array['msg']['timestamp']);
        $new_date = date_format($date, 'Y-m-d H:i:s');
        $new_arr = array(
            'sms_answer' => $array['smsc_msg_status'],
            'sms_date_send' => $new_date,
            'sms_from_type' => $source_name,
            'sms_from_type_id' => $source_id
        );
        if ($array['status'] == 'ok') {
            $new_arr['sms_status'] = 1;
        } else if ($array['status'] == 'error') {
            $new_arr['sms_status'] = -1;
        }
        $this->sms->update($sms_id, $new_arr);
    }
    public function checkAuth()
    {
        $answ['result'] = '-1';
        $this->load->model("user");
        if ($this->input->get("login") && $this->input->get("password")) {
            $userObj = $this->user->auth($this->input->get('login'), $this->input->get("password"));
            if ($userObj != null) {
                $answ['result'] = "1";
                $answ['user'] = array("name" => $userObj['name'], "access" => $userObj['access']);
            }
        }
        echo json_encode($answ);
    }

    private function auth()
    {
        $userObj = null;
        $this->load->model("user");
        if ($this->input->get("login") && $this->input->get("password")) {
            $userObj = $this->user->auth($this->input->get('login'), $this->input->get("password"));
        }
        return $userObj;
    }




    public function checkId()
    {
        $answ['result'] = '-1';

        if ($this->input->get("check_id") && $this->input->get("kiosk_id")) {
            $this->load->model("cart");
            $cart = $this->cart->get_by_check_id($this->input->get("check_id"));
            if ($cart != null) {
                $answ['cart'] = $cart;
                $answ['result'] = '1';
            }
        }
        echo json_encode($answ);
    }


    public function testMail()
    {
        $toEmail = 'pulatov@ehdos.tj';
        $title = 'test Title';
        $body = 'Empty!';
        $this->sendMail($toEmail, $title, $body);
    }

    private function sendMail($toEmail, $title, $body)
    {
        $config = array(
            'protocol' => 'smtp',
            'smtp_host' => 'ssl://smtp.yandex.ru',
            'smtp_port' => 465,
            'smtp_user' => 'bot@ehdos.tj',
            'smtp_pass' => '12341234A',
            'mailtype'  => 'html',
            'charset'   => 'utf-8'
        );
        $this->load->library('email', $config);
        $this->email->set_newline("\r\n");

        $this->email->from('bot@ehdos.tj', 'EHDOS.TJ');
        $this->email->to($toEmail);

        $this->email->subject($title);

        $this->email->message($body);

        $result = $this->email->send();
    }

    private function create_url_f55($to, $sms, $id)
    {
        $login = 'salomat';
        $salt = '83076e76adad3f1a19d91f7558c6e724';
        $source = "Salomat.tj";
        $hh = hash("sha256", $id . ';' . $login . ';' . $source . ';' . $to . ';' . $salt);
        $url = 'http://api.osonsms.com/sendsms_v1.php?login=' . $login . '&phone_number=' . $to . '&msg=' . urlencode($sms) . '&str_hash=' . $hh . '&from=' . $source . '&txn_id=' . $id;
        $data = file_get_contents($url);
        return $data;
    }

    private function log_error($text)
    {
        //log error to db
    }
}
