<?php defined('BASEPATH') or exit('No direct script access allowed');

use Restserver\Libraries\REST_Controller;
// use helpers/PushNotifications.php;

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'helpers/PushNotifications.php';

class Users extends REST_Controller
{

    /**
     * Construction
     */
    public function __construct()
    {
        parent::__construct();

        $this->load->library('session');
        $this->load->helper('security');
        $this->load->model('user');
        $this->load->model('favorite');
        $this->load->model('sms');
        $this->load->library('form_validation');
        $this->load->database();
    }

    /**
     * Display a listing of the Users.
     *
     */
    public function index_get()
    {

        header("Access-Control-Allow-Origin: *");

        $headers = $this->input->request_headers();
        $platform = $headers['platform'] ?? 'android';

        if ($platform == 'IOS') {
            $data = json_decode(file_get_contents('php://input'), true);
            $_POST = $data;
        }
        // $this->load->model('driver_model');
        $this->response($this->user->get_users(), REST_Controller::HTTP_OK);
    }

    /**
     * Show the User.
     *
     * @param $id
     * @return void
     */
    public function show_get($id)
    {

        header("Access-Control-Allow-Origin: *");

        // Load Authorization token
        $this->load->library('Authorization_Token');

        // User Token Validation

        $is_valid_token = $this->authorization_token->validateToken();

        if (!empty($is_valid_token) && $is_valid_token['status'] === TRUE) {
            if (!empty($is_valid_token)) {
                $headers = $this->input->request_headers();
                $platform = $headers['platform'] ?? 'android';

                if ($platform == 'IOS') {
                    $data = json_decode(file_get_contents('php://input'), true);
                    $_POST = $data;
                }
                // $this->load->model('driver_model');
                $this->response($this->user->show_user($id), REST_Controller::HTTP_OK);
            } else {
                $message = [
                    'status' => FALSE,
                    'message' => $is_valid_token['message']
                ];
                $this->response($message, REST_Controller::HTTP_UNAUTHORIZED);
            }
        }
    }

    /**
     *
     * Hashing passwords.
     *
     * @param string  $str
     */

    public function hash_pass($str)
    {
        return md5("ffxKS&@)|_'a" . $str);
    }

    /**
     * Users register.
     *
     */
    public function register_post()
    {
        header("Access-Control-Allow-Origin: *");

        #Getting key from DB for hash
        $key = $this->user->get_keys();

        #Form Validation
        $this->form_validation->set_rules('phone', 'Телефон', 'xss_clean|trim|required');
        $this->form_validation->set_rules('password', 'Пароль', 'xss_clean|trim|required|max_length[100]');
        $this->form_validation->set_rules('name', 'Имя', 'xss_clean|trim|max_length[100]');

        $headers    = $this->input->request_headers();
        $platform   = $headers['platform'] ?? 'android';

        if ($platform == 'IOS') {
            $data   = json_decode(file_get_contents('php://input'), true);
            $_POST  = $data;
        }

        $phone = $this->input->post('phone');
        $password = $this->input->post('password');
        $name = $this->input->post('name');

        if ($this->form_validation->run() == false) {
            $message = array(
                'status'    => false,
                'error'     => $this->form_validation->error_array(),
                'message'   => validation_errors()
            );

            $this->response($message, REST_Controller::HTTP_BAD_REQUEST);
        } else {
            $this->db->where('login', $phone);
            $query = $this->db->get('users');
            $row = $query->num_rows();
            if ($row) {
                $message = array(
                    'status'    => false,
                    'message'   => 'Данный номер телефона был использован при регистрации. Пожалуйста, введите другой.'
                );
                $this->response($message, REST_Controller::HTTP_BAD_REQUEST);
            } else {
                $user_data = [
                    'login'     => $phone,
                    'password'  => $this->hash_pass($password),
                    'name'      => $name,
                    'type'      => 2
                ];

                /* Register driver*/

                $output = $this->user->register_user($user_data);

                if ($output > 0 && !empty($output)) {
                    //If registered successfully
                    $message = [
                        'status'    => true,
                        'message'   => "Вы успешно зарегистрированы"
                    ];
                    $this->response($message, REST_Controller::HTTP_OK);
                } else {

                    /* Error */

                    $message = [
                        'status'    => false,
                        'message'   => "Невозможно пройти регистрацию"
                    ];
                    $this->response($message, REST_Controller::HTTP_NOT_FOUND);
                }
            }
        }
    }

    /**
     * Upload user image
     *
     */
    public function user_img_post()
    {
        $config['upload_path']          = './user_img';
        $config['allowed_types']        = 'gif|jpg|png';
        $config['max_size']             = 40011;
        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('img')) {
            $error = array('error' => $this->upload->display_errors());

            $this->response($error, REST_Controller::HTTP_OK);
        } else {
            $data = array($this->upload->data());
            $user_pic = $data[0]['file_name'];

            $user_id = $this->input->post('user_id');
            if (isset($user_id)) {
                if (!empty($user_pic))
                    $userData['image'] = $user_pic;
                $this->db->where("user_id", $user_id);
                $this->db->update("users", $userData);
            }

            $this->response($data, REST_Controller::HTTP_OK);
        }
    }

    /**
     * Users web logout.
     *
     */
    public function web_log_out_get()
    {
        delete_cookie("auth_id");
        $this->session->unset_userdata(array('user_id'));
        $this->session->sess_destroy();
        redirect(base_url("index.php/main"), "refresh");
        die();
    }

    /**
     * Users web register.
     *
     */
    public function web_register_post()
    {
        header("Access-Control-Allow-Origin: *");

        #Getting key from DB for hash
        $key = $this->user->get_keys();
        $key = $key[0]->key;

        #Form Validation
        $this->form_validation->set_rules('phone', 'Телефон', 'xss_clean|trim|required');
        $this->form_validation->set_rules('password', 'Пароль', 'xss_clean|trim|required|max_length[100]');
        $this->form_validation->set_rules('name', 'Имя', 'xss_clean|trim|max_length[100]');


        $phone = $this->input->post('phone');
        $password = $this->input->post('password');
        $name = $this->input->post('name');

        if ($this->form_validation->run() == false) {
            $message = array(
                'status'    => false,
                'error'     => $this->form_validation->error_array(),
                'message'   => validation_errors()
            );
            redirect(base_url('/index.php/main'), 'refresh');
        } else {
            $this->db->where('login', $phone);
            $query = $this->db->get('users');
            $row = $query->num_rows();
            if ($row) {
                $message = array(
                    'status'    => false,
                    'message'   => 'Данный номер телефона был использован при регистрации. Пожалуйста, введите другой.'
                );
                redirect(base_url('/index.php/main'), 'refresh');
            } else {
                $user_data = [
                    'login'     => $phone,
                    'password'  => $this->hash_pass($password),
                    'name'      => $name,
                    'type'      => 2
                ];

                $output = $this->user->register_user($user_data);
                if ($output > 0 && !empty($output)) {
                    $this->load->library('session');

                    $this->session->set_userdata(array("name" => $output['name'], "user_id" => $output['user_id'], 'auth_soft' => $this->input->user_agent(), 'auth_date' => time()));

                    $session = array("user_id" => $output['user_id'], 'auth_soft' => $this->input->user_agent(), 'auth_date' => time());
                    $auth_id = $this->user->CreateSession($session);
                    $this->isAuth = true;
                    $user = $output['user_id'];
                    setcookie("auth_id", $auth_id, time() + 3600 * 24 * 15, '/');

                    redirect(base_url('/index.php/main/user_info'), 'refresh');
                } else {

                    /* Error */
                    redirect(base_url('/index.php/main'), 'refresh');
                }
            }
        }
    }

    public function web_login_post()
    {
        $data = array('base_url' => base_url(), 'alert' => '');

        if ($this->input->post("login") && $this->input->post("password")) {
            $this->load->model("user");

            $array = $this->user->auth($this->input->post("login"), $this->input->post("password"));
            if ($array != null && $array['type'] == 2) {
                $this->load->library('session');

                $this->session->set_userdata(array("name" => $array['name'], "user_id" => $array['user_id'], 'auth_soft' => $this->input->user_agent(), 'auth_date' => time()));

                $session = array("user_id" => $array['user_id'], 'auth_soft' => $this->input->user_agent(), 'auth_date' => time());
                $auth_id = $this->user->CreateSession($session);
                $this->isAuth = true;
                $user = $array['user_id'];
                setcookie("auth_id", $auth_id, time() + 3600 * 24 * 15, '/');

                redirect(base_url('/index.php/main/user_info'), 'refresh');
            } else {
                redirect(base_url('/index.php/main/'), 'refresh');
                $data['alert'] = $this->createAlert('Ошибка Авторизации');
            }
        }

        $this->parser->parse('login', $data);
    }

    public function login_post()
    {
        header("Access-Control-Allow-Origin: *");

        $headers    = $this->input->request_headers();
        $platform   = $headers['platform'] ?? 'android';

        if ($platform == 'IOS') {
            $data = json_decode(file_get_contents('php://input'), true);
            $_POST = $data;
        }

        $this->form_validation->set_rules('phone', 'Телефон', 'xss_clean|trim|required|max_length[20]');
        $this->form_validation->set_rules('password', 'Пароль', 'xss_clean|trim|required|max_length[100]');

        if ($this->form_validation->run() == FALSE) {

            $message = array(
                'status'    => false,
                'error'     => $this->form_validation->error_array(),
                'message'   => validation_errors()
            );

            $this->response($message, 400);
        } else {

            $phone      = $this->input->post('phone');
            $password   = $this->input->post('password');
            $oneSignalId = $this->input->post('oneSignalId');
            $output     = $this->user->user_login($phone, $password);

            $this->response($output, REST_Controller::HTTP_OK);

            if ((!empty($output) && $output != FALSE)) {
                // Load Authorization Token Library
                $this->load->library('Authorization_Token');

                $token_data['id'] = $output->user_id;
                $token_data['login'] = $output->login;
                $token_data['time'] = time();
                $this->load->library('session');

                $this->session->set_userdata(array("name" =>  $token_data['login'], "user_id" => $token_data['id'], 'auth_soft' => $this->input->user_agent(), 'auth_date' => time()));

                $session = array("user_id" => $token_data['id'], 'auth_soft' => $this->input->user_agent(), 'auth_date' => time());
                $auth_id = $this->user->CreateSession($session);
                $this->isAuth = true;

                setcookie("auth_id", $auth_id, time() + 3600 * 24 * 15, '/');

                $user_token = $this->authorization_token->generateToken($token_data);
                $onesignal = $this->user->set_onesignal_id($phone, $oneSignalId);

                $return_data = [
                    'user_id'   => $output->user_id,
                    'login'     => $output->login,
                    'name'      => $output->name,
                    'token'     => $user_token,
                ];

                //If authorized successfully
                $message = [
                    'status'    => true,
                    'data'      => [$return_data],
                    'message'   => "Пользователь успешно авторизован"
                ];
                $this->response($message, REST_Controller::HTTP_OK);
            } else {
                //Error
                $message = [
                    'status'    =>     false,
                    'message'   => "Неправильный логин и(или) пароль"
                ];
                $this->response($message, 400);
            }
        }
    }

    public function update_user_web_post()
    {
        $this->load->library('session');
        $user = $this->getUser($this->session->userdata('user_id'));

        if (isset($user))
            $userData['name'] = $this->input->post('name') ?? $user['name'];
        $userData['email'] = $this->input->post('email') ?? $user['email'];
        $userData['login'] = $this->input->post('login') ?? $user['login'];
        $userData['birth_date'] = $this->input->post('birth_date') ?? $user['birth_date'];
        $userData['address'] = $this->input->post('address') ?? $user['address'];
        $userData['gender'] = $this->input->post('gender') ?? $user['gender'];
        $userData['password'] = $this->hash_pass($this->input->post('password')) ?? $user['password'];

        $this->db->where("user_id", $user['user_id']);
        $this->db->update("users", $userData);

        redirect(base_url('/index.php/main/user_info#user-info'), 'refresh');
    }

    public function update_user_post($id)
    {
        if (($this->input->post('confirm')) != 1) {
            $this->form_validation->set_rules('name', 'ФИО', 'xss_clean|trim|max_length[40]|min_length[3]');
            $this->form_validation->set_rules('email', 'Почта', 'xss_clean|trim|max_length[40]');
            $this->form_validation->set_rules('login', 'Телефон', 'xss_clean|trim|max_length[9]|min_length[9]');
            $this->form_validation->set_rules('address', 'Адрес', 'xss_clean|trim|max_length[20]');
            $this->form_validation->set_rules('gender', 'Пол', 'xss_clean|trim|max_length[20]');
            $this->form_validation->set_rules('birth_date', 'Дата рождения', 'xss_clean|trim|max_length[20]');
            $name       = $this->input->post('name');
            $email      = $this->input->post('email');
            $login      = $this->input->post('login');
            $birth_date = $this->input->post('birth_date');
            $address    = $this->input->post('address');
            $gender     = $this->input->post('gender');
            $password    = $this->input->post('password');
            if ($this->form_validation->run() == FALSE) {
                $message = array(
                    'status'    => false,
                    'error'     => $this->form_validation->error_array(),
                    'message'   => validation_errors()
                );

                $this->response($message, 400);
            } else {
                $this->load->library('session');
                $user = $this->getUser($id);

                if (isset($id)) {
                    if (!empty($name))
                        $userData['name'] = $name;
                    if (!empty($password))
                        $userData['password'] = $this->hash_pass($password);
                    if (!empty($email))
                        $userData['email'] = $email;
                    if (!empty($login))
                        $userData['login'] = $login;
                    if (!empty($birth_date))
                        $userData['birth_date'] = $birth_date;
                    if (!empty($address))
                        $userData['address'] = $address;
                    if (!empty($gender))
                        $userData['gender'] = $gender;
                    $this->db->where("user_id", $id);
                    $this->db->update("users", $userData);
                }
                $message = [
                    'status'   => true,
                    'message'  => 'Successful'
                ];
                $this->response($message, 200);

                redirect(base_url('/index.php/main/user_info'), 'refresh');
            }
        } else {
            $this->form_validation->set_rules('name', 'Телефон', 'xss_clean|trim|max_length[20]');
            $phone = $this->input->post('login');
            $this->resend_sms_post($phone);
        }
    }

    public function edit_user_post($id)
    {
        $name       = $this->input->post('name');
        $email      = $this->input->post('email');
        $login      = $this->input->post('phone');
        $birth_date = $this->input->post('birth_date');
        $address    = $this->input->post('address');
        $gender     = $this->input->post('gender');
        $password    = $this->input->post('password');
        if (isset($id)) {
            if (!empty($name))
                $userData['name'] = $name;
            if (!empty($password))
                $userData['password'] = $this->hash_pass($password);
            if (!empty($email))
                $userData['email'] = $email;
            if (!empty($login))
                $userData['login'] = $login;
            if (!empty($birth_date))
                $userData['birth_date'] = $birth_date;
            if (!empty($address))
                $userData['address'] = $address;
            if (!empty($gender))
                $userData['gender'] = $gender;
            $this->db->where("user_id", $id);
            $this->db->update("users", $userData);
        }

        $this->response($userData, REST_Controller::HTTP_OK);
    }

    public function deletePhoto_post()
    {
        $user_id = $this->input->post('id');
        $data['image'] = $this->input->post('image');
        $this->db->where('user_id', $user_id);
        $this->db->update('users', $data);
        $this->response(true, REST_Controller::HTTP_OK);
    }

    public function getUser($user_id)
    {
        $array = array();
        $this->db->select('*');
        $this->db->from('users');
        $this->db->where('user_id', $user_id);
        $query = $this->db->get();
        foreach ($query->result_array() as $row) {
            $array = $row;
        }
        return $array;
    }

    /***
     * Checking phone
     *
     * @return void
     *
     */
    public function check_phone_post()
    {
        $this->form_validation->set_rules('phone', 'Телефон', 'xss_clean|trim|required|max_length[20]');

        if ($this->form_validation->run() == FALSE) {
            $message = array(
                'status'    => false,
                'error'     => $this->form_validation->error_array(),
                'message'   => validation_errors()
            );

            $this->response($message, 400);
        } else {
            $phone = $this->input->post('phone');
            $this->db->select('*');
            $this->db->from('users');
            $this->db->where('login', $phone);
            $query = $this->db->get();
            $query = $query->result();

            if ((!empty($query) && $query != FALSE)) {
                $message = [
                    'status'    => true,
                    'user_name' => $query[0]->name,
                    'message'   => "Есть пользователь с таким номерам"
                ];
                $this->response($message, REST_Controller::HTTP_OK);
            } else {
                //Error
                $message = [
                    'status'    =>     false,
                    'message'   => "Нет пользователя с таким номерам"
                ];
                $this->response($message, 400);
            }
        }
    }

    /**
     * Send Sms for confirm
     *
     */
    public function resend_sms_post($phone = '')
    {
        if ($this->input->post("phone") || $phone) {
            $rand_num = rand(1000, 9999);
            $array['code'] = $rand_num;
            $now = date('Y-m-d H:i');
            $sms_id = $this->sms->add_phone(array('phone' => $this->input->post("phone") ?? $phone, 'confirm_code' => $rand_num, 'qty' => 1, 'created_at' => $now, 'updated_at' => $now));
            $this->create_url_f55($this->input->post("phone") ?? $phone, $rand_num, $sms_id);
            $this->response($array);
        } else {
            echo json_encode(-1);
        }
    }

    private function create_url_f55($to, $sms, $id)
    {
        $login = 'salomat';
        $salt = '83076e76adad3f1a19d91f7558c6e724';
        $source = "Salomat.tj";
        // $hh = hash("sha256", $id . ';' . $login . ';' . $source . ';' . $to . ';' . $salt);
        $server = 'http://api.osonsms.com/sendsms_v1.php';

        $dlm = ";";
        $phone_number = $to; //номер телефона
        $txn_id = $id; //ID сообщения в вашей базе данных, оно должно быть уникальным для каждого сообщения
        $str_hash = hash('sha256', $txn_id . $dlm . $login . $dlm . $source . $dlm . $phone_number . $dlm . $salt);
        $message = "Salomat.tj: " . $sms . " - Ваш код для подтверждения телефона";
        if (strlen($sms) > 4) {
            $message = $sms;
        }
        $params = array(
            "from" => $source,
            "phone_number" => $phone_number,
            "msg" => $message,
            "str_hash" => $str_hash,
            "txn_id" => $txn_id,
            "login" => $login,
        );
        $result = $this->call_api($server, "GET", $params);

        // $url = 'http://api.osonsms.com/sendsms_v1.php?login=' . $login . '&phone_number=' . $to . '&msg=' . urlencode($sms) . '&str_hash=' . $hh . '&from=' . $source . '&txn_id=' . $id;
        // $data = file_get_contents($url);
        return $result;
    }

    private function call_api($url, $method, $params)
    {
        $curl = curl_init();
        $data = http_build_query($params);
        if ($method == "GET") {
            curl_setopt($curl, CURLOPT_URL, "$url?$data");
        } else if ($method == "POST") {
            curl_setopt($curl, CURLOPT_URL, $url);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        } else if ($method == "PUT") {
            curl_setopt($curl, CURLOPT_URL, $url);
            curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded', 'Content-Length:' . strlen($data)));
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        } else if ($method == "DELETE") {
            curl_setopt($curl, CURLOPT_URL, "$url?$data");
            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "DELETE");
        } else {
            //dd("unkonwn method");
        }
        curl_setopt_array($curl, array(
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => $method
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
        $arr = array();
        if ($err) {
            $arr['error'] = 1;
            $arr['msg'] = $err;
        } else {
            $res = json_decode($response);
            if (isset($res->error)) {
                $arr['error'] = 1;
                $arr['msg'] = "Error Code: " . $res->error->code . " Message: " . $res->error->msg;
            } else {
                $arr['error'] = 0;
                $arr['msg'] = json_decode($response, true);
            }
        }
        return $arr;
    }

    /**
     * Check register code.
     *
     * @return mixed
     */
    public function check_register_code_post()
    {
        $this->form_validation->set_rules('phone', 'Телефон', 'xss_clean|trim|required|max_length[20]');
        $this->form_validation->set_rules('confirm_code', 'Код', 'xss_clean|trim|required|max_length[20]');

        if ($this->form_validation->run() == FALSE) {
            $message = array(
                'status'    => false,
                'error'     => $this->form_validation->error_array(),
                'message'   => validation_errors()
            );

            $this->response($message, 400);
        } else {
            //            $now = date('Y-m-d H:i:');
            //            var_dump($now);
            $phone = $this->input->post('phone');
            $confirm_code = $this->input->post('confirm_code');
            $this->db->select('*');
            $this->db->from('confirm_passwords');
            $this->db->where('phone', $phone);
            $this->db->where('confirm_code', $confirm_code);
            //            $this->db->where('created_at', $now);
            $query = $this->db->get();
            $query = $query->result();

            if ((!empty($query) && $query != FALSE)) {
                $message = [
                    'status'    => true,
                    'message'   => "код подтвержден"
                ];
                $this->response($message, REST_Controller::HTTP_OK);
            } else {
                //Error
                $message = [
                    'status'    =>     false,
                    'message'   => "Введен неправильный код."
                ];
                $this->response($message, 400);
            }
        }
    }

    public function forgot_password_post()
    {
        $this->form_validation->set_rules('phone', 'Телефон', 'xss_clean|trim|required|max_length[20]');
        $this->form_validation->set_rules('password', 'Пароль', 'xss_clean|trim|required|max_length[100]');

        if ($this->form_validation->run() == FALSE) {
            $message = array(
                'status'    => false,
                'error'     => $this->form_validation->error_array(),
                'message'   => validation_errors()
            );
            $this->response($message, 400);
        } else {
            $phone = $this->input->post('phone');
            $password = $this->input->post('password');

            $updated = $this->user->forgot_password($phone, $password);

            $this->response($updated, REST_Controller::HTTP_OK);
        }
    }
}
