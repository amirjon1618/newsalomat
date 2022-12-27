<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
require APPPATH . 'helpers/PushNotifications.php';

class Admin extends CI_Controller
{

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();

        $this->load->helper('cookie');
        $this->load->helper('url');
        $this->load->model('sms');

        if (!$this->checkAuth()) {
            redirect(base_url("auth/login"), "refresh");
            die();
        }
    }

    private $bUserInfoName = "bUserInfo";
    private $marketPlaceId = 48;
    private $marketPlaceToken =  "QA8CVC";
    private $merchantToken =  "vMelHp";
    // private $delivery = 0;
    private $acquirerId = "B0000004";
    private $merchantId = 1682;

    public function test2()
    {
        $data = array('base_url' => base_url(), 'alert' => '');

        $data['content'] = $this->parser->parse("admin/test", array(), true);

        $this->template($data);
    }

    private function ff($p, $count)
    {
        $t = '';
        $c = $count;
        while ($count > 0) {
            $t .= '0';
            $count--;
        }
        $t .= $p;
        $t = substr($t, - ($c));
        return $t;
    }

    private $isAuth = null;

    private function checkAuth()
    {
        $this->load->model("user");
        if ($this->isAuth == null) {
            if ($this->input->cookie('auth_id')) {
                $this->user->GetUserData($this->input->cookie('auth_id'));
            }

            if ($this->user->myData == null || $this->user->myData['access'] < 20) {
                $this->isAuth = false;
                return false;
            } else {
                $this->isAuth = true;
                return true;
            }
        } else {
            return $this->isAuth;
        }
    }

    public function index()
    {
        $data = array('base_url' => base_url(), 'alert' => '');
        $this->load->model('product');
        $this->load->model('recipe');
        $this->load->model('order');


        $data['total_prods'] = ($this->product->get_all_count())[0]['total_products'];
        $data['total_users'] = count($this->user->getAllUser());
        ////        var_dump(count($data['total_users']));
        //        var_dump($this->recipe->get_all());

        $data['total_recipe'] = count($this->recipe->get_all());
        $data['total_orders'] = count($this->order->getForStatic());
        $data['content'] = $this->parser->parse('admin/main_content', $data, true);

        $this->template($data);
    }

    public function toexit()
    {
        // $this->sess->destroy();
        delete_cookie("auth_id");
        redirect(base_url("index.php/admin"), "refresh");
        die();
    }

    public function profile()
    {
        $alert = '';
        $this->load->model("user");
        if ($this->input->post("editBtn")) {
            $b = true;
            if (strlen($this->input->post("newpass1")) > 0) {
                if ($this->input->post("newpass1") == $this->input->post("newpass2")) {
                    $this->user->changePass($this->user->myData["user_id"], $this->input->post("newpass2"));
                    //Alert OK
                    $alert = $this->createAlertInfo('Пароль сохранен');
                } else {
                    $alert = $this->createAlert('Пароль не совподает');
                    //Alert Error
                }
            } else {
                $alert = $this->createAlert('Укажите пароль');
            }
        }

        $data = array("base_url" => base_url(), 'alert' => $alert);
        $data['content'] = $this->parser->parse('admin/profile', $data, true);

        $this->template($data);
    }

    public function pages()
    {
        $data = array("base_url" => base_url(), "alert" => "");
        $this->load->model('page');
        if ($this->input->get("do") == "updateok") {
            $data['alert'] = $this->createAlertInfo('Данные успешно обновлены');
        }

        $data['list'] = $this->page->get_all();
        $data['content'] = $this->parser->parse('admin/page/list', $data, true);
        $this->template($data);
    }

    public function editPage($id)
    {
        $this->load->model('page');

        if ($this->input->post("AddBtn")) {
            $page_name = $this->input->post('page_name');
            $page_about = $this->input->post('page_about');
            $array = array(
                'name' => $page_name,
                'about' => $page_about,
            );
            $this->page->update($id, $array);
            redirect(base_url('index.php/admin/pages?do=updateok'), 'refresh');
        }

        $data['page'] = $this->page->get($id);
        $data['base_url'] = base_url();
        $data['alert'] = '';

        $data['content'] = $this->parser->parse('admin/page/edit', $data, true);

        $this->template($data);
    }

    public function tags()
    {
        if ($this->user->myData['access'] != 100)
            die();
        $this->load->model("tag");

        $data = array("base_url" => base_url(), "alert" => "");

        if ($this->input->get("do") == "remove") {
            $this->tag->remove($this->input->get("tag_id"));
            $data['alert'] = $this->createAlertInfo('Данные успешно удалены');
        } else if ($this->input->get("do") == "addok") {
            $data['alert'] = $this->createAlertInfo('Данные успешно обновлены');
        }

        $tags = $this->tag->get_all();
        $data['list'] = $tags;

        $data['content'] = $this->parser->parse('admin/tag/list', $data, true);
        $this->template($data);
    }

    public function addTag()
    {
        if ($this->user->myData['access'] != 100)
            die();
        $this->load->model("tag");

        $data = array("base_url" => base_url(), "alert" => "");
        if ($this->input->post("AddBtn")) {
            $dd = array("tag_name" => $this->input->post("tag_name"));
            $this->tag->add($dd);
            redirect(base_url("index.php/admin/tags?do=addok"));
        }
    }

    public function editTag($id)
    {
        if ($this->user->myData['access'] != 100)
            die();
        $this->load->model("tag");

        $data = array("base_url" => base_url(), "alert" => "");

        $data['tag'] = $this->tag->get($id);

        if ($this->input->post("AddBtn")) {
            $dd = array("tag_name" => $this->input->post("tag_name"));
            $this->tag->update($id, $dd);
            redirect(base_url("index.php/admin/tags?do=addok"));
        }
    }

    /**
     * List Notification
     *
     * @return void
     */
    public function notification()
    {
        if ($this->user->myData['access'] != 100)
            die();

        $this->load->model("notification");

        $data = array("base_url" => base_url(), "alert" => "");

        if ($this->input->get("do") == "remove") {
            $this->notification->remove($this->input->get("id"));
            $data['alert'] = $this->createAlertInfo('Данные успешно удалены');
        } else if ($this->input->get("do") == "addok") {
            $data['alert'] = $this->createAlertInfo('Данные успешно обновлены');
        }

        $code = $this->notification->get_all();
        $data['list'] = $code;

        $data['content'] = $this->parser->parse('admin/notification/list', $data, true);
        $this->template($data);
    }

    /**
     * Added Notification
     *
     * @return void
     */
    public function addNotification()
    {
        if ($this->user->myData['access'] != 100)
            die();
        $this->load->model('notification');

        $data = array("base_url" => base_url(), "alert" => "");
        $now = date('Y-m-d H:i');
        if ($this->input->post("AddBtn")) {
            $config['upload_path'] = './img/icons/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg|svg';
            $config['encrypt_name'] = 'TRUE';
            $config['max_size'] = '4500';
            $config['max_width'] = '6000';
            $config['max_height'] = '4000';

            $this->load->library('upload', $config);

            $this->upload->do_upload("userfile");
            if ($this->upload->display_errors() != '') {
                $data['alert'] = $this->createAlert($this->upload->display_errors());
            }

            $img = $this->upload->data();
            $dd = array("name" => $this->input->post("name"), "description" => $this->input->post("description"), "img" => $img['file_name'], "created_at" => $now, 'updated_at' => $now);
            $this->notification->add($dd);
            redirect(base_url("index.php/admin/notification?do=addok"));

        }
        $data['content'] = $this->parser->parse('admin/notification/add', $data, true);
        $this->template($data);
    }

    /**
     * Updated Notification
     * @param Int $id
     * @return void
     */
    public function editNotification($id)
    {
        if ($this->user->myData['access'] != 100)
            die();
        $this->load->model("notification");
        $data = array("base_url" => base_url(), "alert" => "");
        $data['notification'] = $this->notification->get($id);
        $now = date('Y-m-d H:i');
        if ($this->input->post("AddBtn")) {
            $config['upload_path'] = './img/icons/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg|svg';
            $config['encrypt_name'] = 'TRUE';
            $config['max_size'] = '4500';
            $config['max_width'] = '6000';
            $config['max_height'] = '4000';

            $this->load->library('upload', $config);

            $this->upload->do_upload("userfile");
            if ($this->upload->display_errors() != '') {
                $data['alert'] = $this->createAlert($this->upload->display_errors());
            }

            $img = $this->upload->data();
            $dd = array("name" => $this->input->post("name"), "description" => $this->input->post("description"), "img" => $img['file_name'], "created_at" => $now, 'updated_at' => $now);
            $this->notification->update($id, $dd);
            redirect(base_url("index.php/admin/notification?do=addok"));
        }

        $data['content'] = $this->parser->parse('admin/notification/edit', $data, true);

        $this->template($data);
    }

    /**
     * Updated Notification
     * @param Int $id
     * @return void
     */
    public function sendNotification($id)
    {
        if ($this->user->myData['access'] != 100)
            die();
        $this->load->model("notification");
        $data = array("base_url" => base_url(), "alert" => "");
        $data['notification'] = $this->notification->get($id);
        $now = date('Y-m-d H:i');
        if ($this->input->post("AddBtn")) {
            $config['upload_path'] = './img/icons/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg|svg';
            $config['encrypt_name'] = 'TRUE';
            $config['max_size'] = '4500';
            $config['max_width'] = '6000';
            $config['max_height'] = '4000';

            $this->load->library('upload', $config);

            $this->upload->do_upload("userfile");
            if ($this->upload->display_errors() != '') {
                $data['alert'] = $this->createAlert($this->upload->display_errors());
            }

            $img = $this->upload->data();
            $dd = array("name" => $this->input->post("name"), "description" => $this->input->post("description"), "img" => $img['file_name'], "created_at" => $now, 'updated_at' => $now);
            $this->notification->update($id, $dd);
            redirect(base_url("index.php/admin/notification?do=addok"));
        }

        $data['content'] = $this->parser->parse('admin/notification/edit', $data, true);

        $this->template($data);
    }

    /**
     * List PromoCode
     *
     * @return void
     */
    public function promo_codes()
    {
        if ($this->user->myData['access'] != 100)
            die();
        $this->load->model("PromoCode");

        $data = array("base_url" => base_url(), "alert" => "");

        if ($this->input->get("do") == "remove") {
            $this->PromoCode->remove($this->input->get("id"));
            $data['alert'] = $this->createAlertInfo('Данные успешно удалены');
        } else if ($this->input->get("do") == "addok") {
            $data['alert'] = $this->createAlertInfo('Данные успешно обновлены');
        }

        $code = $this->PromoCode->get_all();
        $data['list'] = $code;

        $data['content'] = $this->parser->parse('admin/promo_code/list', $data, true);
        $this->template($data);
    }

    /**
     * Added Promo Code
     *
     * @return void
     */
    public function addPromoCode()
    {
        if ($this->user->myData['access'] != 100)
            die();
        $this->load->model("PromoCode");
        $now = date('Y-m-d H:i');
        $data = array("base_url" => base_url(), "alert" => "");
        if ($this->input->post("AddBtn")) {
            $dd = array("code" => $this->input->post("code"), "discount" => $this->input->post("discount"), "created_at" => $now, 'updated_at' => $now);
            $this->PromoCode->add($dd);
            redirect(base_url("index.php/admin/promo_codes?do=addok"));
        }
    }

    /**
     * Updated Promo Code
     *
     * @return void
     */
    public function editPromoCode($id)
    {
        if ($this->user->myData['access'] != 100)
            die();
        $this->load->model("PromoCode");
        $data['tag'] = $this->PromoCode->get($id);
        $now = date('Y-m-d H:i');
        if ($this->input->post("AddBtn")) {
            $dd = array("code" => $this->input->post("code"), "discount" => $this->input->post("discount"), "created_at" => $now, 'updated_at' => $now);
            $this->PromoCode->update($id, $dd);
            redirect(base_url("index.php/admin/promo_codes?do=addok"));
        }
    }

    public function blogs()
    {
        if ($this->user->myData['access'] != 100)
            die();
        $this->load->model("blog");

        $data = array("base_url" => base_url(), "alert" => "");

        if ($this->input->get("do") == "remove") {
            $this->blog->remove($this->input->get("blog_id"));
            $data['alert'] = $this->createAlertInfo('Данные успешно удалены');
        } else if ($this->input->get("do") == "addok") {
            $data['alert'] = $this->createAlertInfo('Данные успешно обновлены');
        }

        $current_page = $this->input->get('page');
        $tag_id = $this->input->get('tag_id');
        $search_inp = $this->input->get('search_inp');

        if ($current_page == '' || $current_page < 0) {
            $current_page = 1;
        }

        if ($tag_id == '' || $tag_id < 0) {
            $tag_id = 0;
        }

        $blog = $this->blog->get_all($current_page, $tag_id, $search_inp);
        $info['pages'] = $blog['pages'];
        unset($blog['pages']);
        if (isset($blog['prev_page'])) {
            $info['prev_page'] = $blog['prev_page'];
            unset($blog['prev_page']);
        }
        if (isset($blog['next_page'])) {
            $info['next_page'] = $blog['next_page'];
            unset($blog['next_page']);
        }
        $data['info'] = $info;
        $data['list'] = $blog;
        $data['content'] = $this->parser->parse('admin/blog/list', $data, true);
        $this->template($data);
    }

    public function addBlog()
    {
        if ($this->user->myData['access'] != 100)
            die();
        $this->load->model("blog");

        $data = array("base_url" => base_url(), "alert" => "");
        // date_default_timezone_set('Asia/Dushanbe');
        // $now_date = date('Y-m-d H:i:s');

        if ($this->input->post("AddBtn")) {
            $dd = array(
                "blog_title" => $this->input->post("blog_title"),
                "blog_about" => $this->input->post("blog_about"),
                "tags" => $this->input->post("tags"),
                "products" => $this->input->post("srch_pr_inp"),

                // "blog_created_at" => $now_date
            );
            $this->blog->add($dd);

            redirect(base_url("index.php/admin/blogs?do=addok"), "refresh");
        }
        $data['content'] = $this->parser->parse('admin/blog/add', $data, true);

        $this->template($data);
    }

    public function editBlog($id)
    {
        if ($this->user->myData['access'] != 100)
            die();
        $this->load->model("blog");

        $data = array("base_url" => base_url(), "alert" => "");

        $blog = $this->blog->get($id);
        $tags = $this->blog->get_blog_tags($id);
        $srch_pr_inp = $this->blog->get_blog_procucts($id);
        $data['tags'] = $tags;
        $data['srch_pr_inp'] = $srch_pr_inp;
        $data['blog_about'] = $blog['blog_about'];
        $data['blog_title'] = $blog['blog_title'];
        if ($this->input->post("AddBtn")) {
            $dd = array(
                "blog_title" => $this->input->post("blog_title"),
                "blog_about" => $this->input->post("blog_about"),
                "tags" => $this->input->post("tags"),
                "products" => $this->input->post("srch_pr_inp"),
            );
            $this->blog->update($id, $dd);
            redirect(base_url("index.php/admin/blogs?do=addok"));
        }
        $data['content'] = $this->parser->parse('admin/blog/edit', $data, true);
        $this->template($data);
    }

    public function blogImages($id)
    {
        if ($this->user->myData['access'] != 100)
            die();
        $this->load->model("blog");

        $data = array("base_url" => base_url(), "alert" => "");
        if ($this->input->get("do") == "remove") {
            $this->blog->remove_image($this->input->get("blog_image_id"));
            $data['alert'] = $this->createAlertInfo('Данные успешно удалены');
        } else if ($this->input->get("do") == "addok") {
            $data['alert'] = $this->createAlertInfo('Данные успешно обновлены');
        }

        $blog_images = $this->blog->get_blog_images($id);
        $data['total_avatar_in_blog'] = sizeof($this->blog->get_blog_avatars($id));

        $blog = $this->blog->get($id);
        $data['blog'] = $blog;
        $data['list'] = $blog_images;

        $data['content'] = $this->parser->parse('admin/blog/images', $data, true);
        $this->template($data);
    }

    public function addBlogImage($id)
    {
        $this->load->model('blog');
        if ($this->input->post("AddBtn")) {
            $dd = array(
                "blog_images" => $this->input->post("blog_images")
            );
            $this->blog->insert_images($id, $dd);
            echo json_encode(1);
        }
    }

    public function Admins()
    {
        if ($this->user->myData['access'] != 100)
            die();

        $data = array("base_url" => base_url(), "alert" => "");
        $this->load->model('user');

        if ($this->input->get("do") == "addok") {
            $data['alert'] = $this->createAlertInfo('Успешно добавлен');
        } else if ($this->input->get("do") == "updateok") {
            $data['alert'] = $this->createAlertInfo('Данные успешно обнавлены');
        } else if ($this->input->get("do") == "extendok") {
            $data['alert'] = $this->createAlertInfo('Данные успешно обнавлены');
        } else if ($this->input->get("do") == "remove") {
            $this->user->delete($this->input->get("user_id"));
            $data['alert'] = $this->createAlertInfo('Успешно удален');
        }

        $data['clientList'] = $this->user->getAllUser2();
        $data['content'] = $this->parser->parse('admin/admins', $data, true);
        $this->template($data);
    }

    public function addAdmin()
    {
        if ($this->user->myData['access'] != 100)
            die();

        $data = array("base_url" => base_url(), "alert" => "");
        $this->load->model("user");

        if ($this->input->post("AddBtn")) {
            $client = array();

            if ($this->input->post("password") && $this->input->post("login") && $this->input->post("name") && $this->input->post("access")) {
                $client['password'] = $this->input->post("password");
                $client['login'] = $this->input->post("login");
                $client['name'] = $this->input->post("name");
                $client['access'] = $this->input->post("access");

                $user_id = $this->user->newUser($client);

                if ($user_id != 0) {
                    redirect(base_url("index.php/admin/Admins?do=addok"));
                } else
                    $data['alert'] = $this->createAlert("Такой логин уже есть");
            }
        }

        $data['content'] = $this->parser->parse('admin/addAdmin', $data, true);
        $this->template($data);
    }

    public function editAdmin($user_id)
    {
        if ($this->user->myData['access'] != 100)
            die();

        $this->load->model("user");

        $data = array("base_url" => base_url(), "alert" => "");

        if ($this->input->post("AddBtn")) {
            // print_r($access);
            $user = array();
            if ($this->input->post("name") && $this->input->post("access")) {
                $user['name'] = $this->input->post("name");
                $user['access'] = $this->input->post("access");


                if ($this->input->post("npassword1"))
                    $user['password'] = $this->input->post("npassword1");

                $this->user->updateuser($user_id, $user);

                redirect(base_url("index.php/admin/Admins?do=updateok"));
            }
        }

        $user = $this->user->getUser($user_id);

        $data['login'] = $user['login'];
        $data['name'] = $user['name'];
        $data['access'] = $user['access'];

        $data['content'] = $this->parser->parse('admin/editAdmin', $data, true);
        $this->template($data);
    }

    private function check_dir($dir)
    {
        $dir = "upload_images/" . $dir;
        if (!is_dir($dir)) {
            mkdir($dir);
        }
    }

    public function uploadFile($content_id)
    {
        if (isset($_FILES["fileToUpload"])) {
            $fileToUpload = $_FILES["fileToUpload"]["tmp_name"];

            $dir = date('m-Y');
            $this->check_dir($dir);

            $fileToUpload_name = "upload_images/" . $dir . "/" . time() . "_" . $_FILES["fileToUpload"]["name"];
            $fileToUpload_size = $_FILES["fileToUpload"]["size"];
            $fileToUpload_type = $_FILES["fileToUpload"]["type"];
            $error_flag = $_FILES["fileToUpload"]["error"];


            if ($error_flag == 0) {
                if (move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $fileToUpload_name)) {
                    list($width, $height) = getimagesize($fileToUpload_name);
                    $this->load->model("img");
                    $id = $this->img->add(array("img_link" => $fileToUpload_name, "news_id" => $content_id, "w" => $width, "h" => $height));
                    echo $fileToUpload_name . "|" . $id . "|" . $width . "|" . $height;
                }
            } else {
                echo $error_flag . '|0';
            }
        } else {
        }
    }

    public function productUploadFile($img_id)
    {
        if (isset($_FILES["uploadfile1"])) {
            $fileToUpload = $_FILES["uploadfile1"]["tmp_name"];

            $dir = date('m-Y');
            $this->check_dir($dir);

            $fileToUpload_name = "upload_post_img/" . $dir . "/" . time() . "_" . $_FILES["uploadfile1"]["name"];
            $fileToUpload_size = $_FILES["uploadfile1"]["size"];
            $fileToUpload_type = $_FILES["uploadfile1"]["type"];
            $error_flag = $_FILES["uploadfile1"]["error"];

            if ($error_flag == 0) {
                if (move_uploaded_file($_FILES['uploadfile1']['tmp_name'], $fileToUpload_name)) {
                    list($width, $height) = getimagesize($fileToUpload_name);

                    $this->load->model("product");

                    $id = $this->product->add_product_img($fileToUpload_name);

                    echo $fileToUpload_name . "|" . $id . "|" . $width . "|" . $height;
                }
            } else {
                echo $error_flag . '|0';
            }
        } else {
        }
    }

    //Categorys
    public function Categories()
    {
        if ($this->user->myData['access'] != 100 && $this->user->myData['access'] != 60)
            die();

        $data = array("base_url" => base_url(), "alert" => "");
        $this->load->model("category");
        if ($this->input->get("do") == "addok") {
            $data['alert'] = $this->createAlertInfo('Успешно добавлен');
        } else if ($this->input->get("do") == "updateok") {
            $data['alert'] = $this->createAlertInfo('Данные успешно обнавлены');
        } else if ($this->input->get("do") == "extendok") {
            $data['alert'] = $this->createAlertInfo('Данные успешно обновлены');
        } else if ($this->input->get("do") == "remove") {
            $this->category->remove($this->input->get('cat_id'));
            $data['alert'] = $this->createAlertInfo('Данные успешно удалены');
        }

        $data['list'] = $this->category->get_all();

        $data['content'] = $this->parser->parse('admin/category/list', $data, true);
        $this->template($data);
    }

    public function categoryBanners($id)
    {
        if ($this->user->myData['access'] != 100)
            die();
        $this->load->model("slider");
        $this->load->model("category");

        $data = array("base_url" => base_url(), "alert" => "", "pages" => array());
        $data['category'] = $this->category->get($id);
        if (sizeof($data['category']) == 0) {
            redirect('errors/cli/error_404.php', TRUE);
            return;
        }
        if ($this->input->get("do") == "addok") {
            $data['alert'] = $this->createAlertInfo('Успешно добавлен');
        } else if ($this->input->get("do") == "updateok") {
            $data['alert'] = $this->createAlertInfo('Данные успешно обнoвлены');
        } else if ($this->input->get("do") == "remove") {
            $this->slider->remove($this->input->get("slider_id"));
            $data['alert'] = $this->createAlertInfo('Данные успешно удалены');
        }

        $list = $this->slider->get_all('', $id);
        $data['list'] = $list;

        $data['content'] = $this->parser->parse('admin/category/category_banners', $data, true);
        $this->template($data);
    }

    public function addCategoryToMain()
    {
        $this->load->model('category');
        if ($this->input->get("main") != '' && $this->input->get("id") != '') {
            $ans = $this->category->addToMain($this->input->get("id"), $this->input->get("main"));
            if ($ans == 1) {
                echo json_encode(1);
            } else if ($ans == 0) {
                echo json_encode('Максимум категорий уже добавлено');
            }
        }
    }

    public function subCategories($id)
    {
        if ($this->user->myData['access'] != 100 && $this->user->myData['access'] != 60)
            die();
        $data = array("base_url" => base_url(), "alert" => "");
        $this->load->model("category");
        if ($this->input->get("do") == "addok") {
            $data['alert'] = $this->createAlertInfo('Успешно добавлен');
        } else if ($this->input->get("do") == "updateok") {
            $data['alert'] = $this->createAlertInfo('Данные успешно обнавлены');
        } else if ($this->input->get("do") == "extendok") {
            $data['alert'] = $this->createAlertInfo('Данные успешно обновлены');
        } else if ($this->input->get("do") == "remove") {
            $this->category->remove($this->input->get('cat_id'));
            $data['alert'] = $this->createAlertInfo('Данные успешно удалены');
        }
        $data['parent_cat'] = $this->category->get_parent_categories($id);
        $data['list'] = $this->category->get_sub_categories($id);
        $data['category_id'] = $id;
        $data['content'] = $this->parser->parse('admin/category/sub_categories', $data, true);
        $this->template($data);
    }

    public function editCategory($id)
    {
        //        if ($this->user->myData['access'] != 100 || $this->user->myData['access'] != 60) {
        //            die();
        //        }
        // print_r('asdasdasd');

        $data = array("base_url" => base_url(), "alert" => "");
        $this->load->model("category");

        $category = $this->category->get($id);
        $data['category'] = $category;
        if ($category['parent_id'] != 0) {
            $data['parent_category'] = $this->category->get($category['parent_id']);
        }
        $data['cat_parent_id'] = $category['parent_id'];
        if ($this->input->post("AddBtn")) {
            $config['upload_path'] = './img/icons/';
            $config['allowed_types'] = 'svg|gif|jpg|png|jpeg|';
            $config['encrypt_name'] = 'TRUE';
            $config['max_size'] = '4500';
            $config['max_width'] = '6000';
            $config['max_height'] = '4000';

            $this->load->library('upload', $config);

            $this->upload->do_upload("userfile");
            if ($this->upload->display_errors() != '') {
                $data['alert'] = $this->createAlert($this->upload->display_errors());
            }

            $img = $this->upload->data();

            $dd = array(
                "category_name" => $this->input->post("category_name"),
            );

            if (!empty($img['file_name'])) {
                $dd['icon'] = $img['file_name'];
            }
            $this->category->update($id, $dd);
            if ($category['parent_id'] == 0) {
                redirect(base_url("index.php/admin/categories?do=addok"));
            } else {
                redirect(base_url("index.php/admin/subCategories/" . $category['parent_id'] . "?do=addok"));
            }
        }
        $data['content'] = $this->parser->parse('admin/category/edit', $data, true);
        $this->template($data);
    }

    public function addCategory($id)
    {
        if ($this->user->myData['access'] != 100 && $this->user->myData['access'] != 60)
            die();

        $data = array("base_url" => base_url(), "alert" => "");
        $this->load->model("category");
        if ($id != 0) {
            $cat = $this->category->get($id);
            $data['category'] = $cat;
            if ($cat['parent_id'] != 0) {
                $data['parent_category'] = $this->category->get($cat['parent_id']);
            }
        }
        $data['cat_parent_id'] = $id;
        if ($this->input->post("AddBtn")) {
            $config['upload_path'] = './img/icons/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg|svg';
            $config['encrypt_name'] = 'TRUE';
            $config['max_size'] = '4500';
            $config['max_width'] = '6000';
            $config['max_height'] = '4000';

            $this->load->library('upload', $config);

            $this->upload->do_upload("userfile");
            if ($this->upload->display_errors() != '') {
                $data['alert'] = $this->createAlert($this->upload->display_errors());
            }

            $img = $this->upload->data();
            $dd = array(
                "category_name" => $this->input->post("category_name"),
                "parent_id" => $id,
                "icon" => $img['file_name'],
            );
            $this->category->add($dd);
            if ($id == 0) {
                redirect(base_url("index.php/admin/categories?do=addok"));
            } else {
                redirect(base_url("index.php/admin/subCategories/" . $id . "?do=addok"));
            }
        }
        $data['content'] = $this->parser->parse('admin/category/add', $data, true);
        $this->template($data);
    }

    public function addBanner($cat_id = '')
    {
        if ($this->user->myData['access'] != 100)
            die();
        $this->load->model("slider");
        $this->load->model("category");

        $data = array("base_url" => base_url(), "alert" => "");
        if ($cat_id != '') {
            $data['category'] = $this->category->get($cat_id);
            if (sizeof($data['category']) == 0) {
                redirect('errors/cli/error_404.php', TRUE);
                return;
            }
        }
        if ($this->input->post("AddBtn")) {
            $config['upload_path'] = './upload_banner/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $config['encrypt_name'] = 'TRUE';
            $config['max_size'] = '4500';
            $config['max_width'] = '6000';
            $config['max_height'] = '4000';

            $this->load->library('upload', $config);

            $this->upload->do_upload("userfile");
            if ($this->upload->display_errors() != '') {
                $data['alert'] = $this->createAlert($this->upload->display_errors());
            }

            $img = $this->upload->data();
            $dd = array(
                "slider_name" => $this->input->post("slider_name"),
                "slider_link" => $this->input->post("slider_link"),
                "slider_pic" => $img['file_name'],
                "type" => $this->input->post("type"),
            );
            if ($cat_id != '') {
                $dd['slider_category_id'] =  $cat_id;
                $dd["slider_type"] = 'mini';
            } else {
                $dd["slider_type"] = 'normal';
            }
            if (strlen($data['alert']) == 0) {
                $this->slider->add($dd);
                if ($cat_id != '') {
                    redirect(base_url("index.php/admin/categoryBanners/" . $cat_id . "?do=addok"), "refresh");
                }
                redirect(base_url("index.php/admin/banners?do=addok"), "refresh");
            }
        }
        $data['content'] = $this->parser->parse('admin/banner/add', $data, true);
        $this->template($data);
    }

    public function editBanner($id)
    {
        if ($this->user->myData['access'] != 100)
            die();
        $this->load->model("category");
        $this->load->model("slider");

        $data = array("base_url" => base_url(), "alert" => "");

        $slider = $this->slider->get($id);

        if ($slider['slider_category_id'] != '')
            $data['category'] = $this->category->get($slider['slider_category_id']);

        foreach ($slider as $i => $v) {
            $data[$i] = $v;
        }
        if ($this->input->post("AddBtn")) {
            $img_link = null;
            $config['upload_path'] = './upload_banner/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $config['encrypt_name'] = 'TRUE';
            $config['max_size'] = '4500';
            $config['max_width'] = '6000';
            $config['max_height'] = '4000';

            $this->load->library('upload', $config);
            if ($_FILES and $_FILES["userfile"] and $_FILES["userfile"]["error"] != 4) {
                if ($this->upload->do_upload("userfile")) {
                    $img = $this->upload->data();
                    $img_link = $img['file_name'];
                }
                if ($this->upload->display_errors() != '') {
                    $data['alert'] = $this->createAlert($this->upload->display_errors());
                }
            }

            $dd = array(
                "slider_name" => $this->input->post("slider_name"),
                "slider_link" => $this->input->post("slider_link"),
                "type" => $this->input->post("type"),
            );
            if ($img_link != null)
                $dd["slider_pic"] = $img['file_name'];

            if (strlen($data['alert']) == 0) {
                $this->slider->update($id, $dd);
                if (isset($data['category'])) {
                    redirect(base_url("index.php/admin/categoryBanners/" . $data['category']['id'] . "?do=updateok"), "refresh");
                }
                redirect(base_url("index.php/admin/banners?do=addok"), "refresh");
            }
        }

        $data['content'] = $this->parser->parse('admin/banner/edit', $data, true);
        $this->template($data);
    }
    public function addBannerModal()
    {
        if ($this->user->myData['access'] != 100)
            die();
        $this->load->model("slider");
        $this->load->model("category");

        $data = array("base_url" => base_url(), "alert" => "");
        if ($this->input->post("AddBtn")) {
            $config['upload_path'] = './upload_banner/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $config['encrypt_name'] = 'TRUE';
            $config['max_size'] = '4500';
            $config['max_width'] = '6000';
            $config['max_height'] = '4000';

            $this->load->library('upload', $config);

            $this->upload->do_upload("userfile");
            if ($this->upload->display_errors() != '') {
                $data['alert'] = $this->createAlert($this->upload->display_errors());
            }

            $img = $this->upload->data();
            $dd = array(
                "slider_name" => $this->input->post("slider_name"),
                "slider_link" => $this->input->post("slider_link"),
                "slider_pic" => $img['file_name'],
            );
            $dd["slider_type"] = 'normal';
            if (strlen($data['alert']) == 0) {
                $this->slider->add($dd);
                redirect(base_url("index.php/admin/banners?do=addok"), "refresh");
            }
        }
    }

    public function editBannerModal($id)
    {
        if ($this->user->myData['access'] != 100)
            die();
        $this->load->model("category");
        $this->load->model("slider");

        $data = array("base_url" => base_url(), "alert" => "");

        $slider = $this->slider->get($id);

        foreach ($slider as $i => $v) {
            $data[$i] = $v;
        }
        if ($this->input->post("AddBtn")) {
            $img_link = null;
            $config['upload_path'] = './upload_banner/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $config['encrypt_name'] = 'TRUE';
            $config['max_size'] = '4500';
            $config['max_width'] = '6000';
            $config['max_height'] = '4000';

            $this->load->library('upload', $config);
            if ($_FILES and $_FILES["userfile"] and $_FILES["userfile"]["error"] != 4) {
                if ($this->upload->do_upload("userfile")) {
                    $img = $this->upload->data();
                    $img_link = $img['file_name'];
                }
                if ($this->upload->display_errors() != '') {
                    $data['alert'] = $this->createAlert($this->upload->display_errors());
                }
            }

            $dd = array(
                "slider_name" => $this->input->post("slider_name"),
                "slider_link" => $this->input->post("slider_link"),
            );
            if ($img_link != null)
                $dd["slider_pic"] = $img['file_name'];

            if (strlen($data['alert']) == 0) {
                $this->slider->update($id, $dd);
                redirect(base_url("index.php/admin/banners?do=addok"), "refresh");
            } else {
                echo json_encode($data['alert']);
            }
        }
    }

    public function banners()
    {
        if ($this->user->myData['access'] != 100)
            die();
        $this->load->model("slider");

        $data = array("base_url" => base_url(), "alert" => "", "pages" => array());

        if ($this->input->get("do") == "addok") {
            $data['alert'] = $this->createAlertInfo('Успешно добавлен');
        } else if ($this->input->get("do") == "updateok") {
            $data['alert'] = $this->createAlertInfo('Данные успешно обнавлены');
        } else if ($this->input->get("do") == "extendok") {
            $data['alert'] = $this->createAlertInfo('Данные успешно обнавлены');
        } else if ($this->input->get("do") == "remove") {
            $this->slider->remove($this->input->get("slider_id"));
            $data['alert'] = $this->createAlertInfo('Данные успешно удалены');
        }

        $list = $this->slider->get_all('normal');
        $data['list'] = $list;

        $data['content'] = $this->parser->parse('admin/banner/list', $data, true);
        $this->template($data);
    }

    public function advertisementBanners()
    {
        if ($this->user->myData['access'] != 100)
            die();
        $this->load->model("advertisement");

        $data = array("base_url" => base_url(), "alert" => "", "pages" => array());

        if ($this->input->get("do") == "addok") {
            $data['alert'] = $this->createAlertInfo('Успешно добавлен');
        } else if ($this->input->get("do") == "updateok") {
            $data['alert'] = $this->createAlertInfo('Данные успешно обнавлены');
        } else if ($this->input->get("do") == "extendok") {
            $data['alert'] = $this->createAlertInfo('Данные успешно обнавлены');
        } else if ($this->input->get("do") == "remove") {
            $this->advertisement->remove($this->input->get("ad_id"));
            $data['alert'] = $this->createAlertInfo('Данные успешно удалены');
        }

        $list = $this->advertisement->get_all();
        $data['list'] = $list;

        $data['content'] = $this->parser->parse('admin/advertisement_banner/list', $data, true);
        $this->template($data);
    }

    public function addAdvertisementBanner()
    {
        if ($this->user->myData['access'] != 100)
            die();
        $this->load->model("advertisement");

        $data = array("base_url" => base_url(), "alert" => "");

        if ($this->input->post("AddBtn")) {
            $config['upload_path'] = './upload_banner/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $config['encrypt_name'] = 'TRUE';
            $config['max_size'] = '4500';
            $config['max_width'] = '6000';
            $config['max_height'] = '4000';

            $this->load->library('upload', $config);

            $this->upload->do_upload("userfile");
            if ($this->upload->display_errors() != '') {
                $data['alert'] = $this->createAlert($this->upload->display_errors());
            }

            $img = $this->upload->data();

            $dd = array(
                "advertisement_name" => $this->input->post("ad_slider_name"),
                "advertisement_link" => $this->input->post("ad_slider_link"),
                "advertisement_type" => $this->input->post("ad_type"),
                "advertisement_category" => $this->input->post("ad_banner_category"),
                "advertisement_pic" => $img['file_name']
            );


            if (strlen($data['alert']) == 0) {
                $this->advertisement->add($dd);
                redirect(base_url("index.php/admin/advertisementBanners?do=addok"), "refresh");
            }
        }

        $data['content'] = $this->parser->parse('admin/advertisement_banner/add', $data, true);
        $this->template($data);
    }

    public function editAdvertisementBanner($id)
    {
        if ($this->user->myData['access'] != 100)
            die();
        $this->load->model("advertisement");
        $this->load->model("category");

        $data = array("base_url" => base_url(), "alert" => "");

        $advertisement = $this->advertisement->get($id);
        if (sizeof($advertisement) == 0) {
            redirect('errors/cli/error_404.php', TRUE);
            return;
        }
        $adv_category = $this->category->get($advertisement['advertisement_category']);
        $data['adv_category'] = $adv_category;
        foreach ($advertisement as $i => $v) {
            $data[$i] = $v;
        }

        if ($this->input->post("AddBtn")) {
            $img_link = null;
            $config['upload_path'] = './upload_banner/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $config['encrypt_name'] = 'TRUE';
            $config['max_size'] = '4500';
            $config['max_width'] = '6000';
            $config['max_height'] = '4000';

            $this->load->library('upload', $config);

            if ($this->upload->do_upload("userfile")) {
                $img = $this->upload->data();
                $img_link = $img['file_name'];
            }
            if ($this->upload->display_errors() != '' && $_FILES['userfile']['error'] != 4) {
                $data['alert'] = $this->createAlert($this->upload->display_errors());
            }

            $dd = array(
                "advertisement_name" => $this->input->post("ad_slider_name"),
                "advertisement_link" => $this->input->post("ad_slider_link"),
                "advertisement_type" => $this->input->post("ad_type"),
                "advertisement_category" => $this->input->post("ad_banner_category"),
            );


            if ($img_link != null)
                $dd["advertisement_pic"] = $img['file_name'];

            if (strlen($data['alert']) == 0) {
                $this->advertisement->update($id, $dd);
                redirect(base_url("index.php/admin/advertisementBanners?do=updateok"), "refresh");
            }
        }
        $data['content'] = $this->parser->parse('admin/advertisement_banner/edit', $data, true);
        $this->template($data);
    }

    public function reviews()
    {
        if ($this->user->myData['access'] != 100)
            die();
        $this->load->model("rating");

        $data = array("base_url" => base_url(), "alert" => "", "pages" => array());

        if ($this->input->get("do") == "addok") {
            $data['alert'] = $this->createAlertInfo('Успешно добавлен');
        } else if ($this->input->get("do") == "updateok") {
            $data['alert'] = $this->createAlertInfo('Данные успешно обнавлены');
        } else if ($this->input->get("do") == "extendok") {
            $data['alert'] = $this->createAlertInfo('Данные успешно обнавлены');
        } else if ($this->input->get("do") == "remove") {
            $this->rating->remove($this->input->get("review_id"));
            $data['alert'] = $this->createAlertInfo('Данные успешно удалены');
        }

        $list = $this->rating->get_all();
        $data['list'] = $list;
        // print_r('asd')

        $data['content'] = $this->parser->parse('admin/review/list', $data, true);
        $this->template($data);
    }

    public function changeReviewStatus()
    {
        $this->load->model('rating');
        $obj = $this->input->get();
        $this->rating->update_rev_status($obj['review_id'], $obj['stat']);

        echo json_encode(1);
    }

    public function changeProdOfTheDay()
    {
        $this->load->model('product');
        $obj = $this->input->get();
        $this->product->update_prod_of_the_day($obj['prod_id'], $obj['stat']);

        echo json_encode(1);
    }

    public function changeBlogAvatar()
    {
        $this->load->model('blog');
        $obj = $this->input->get();

        $this->blog->update_blog_avatar($obj['id'], $obj['stat']);

        echo json_encode(1);
    }

    public function changeProdInCategory()
    {
        $this->load->model('product');
        $obj = $this->input->get();
        $this->product->update_prod_in_category($obj['prod_id'], $obj['stat']);

        echo json_encode(1);
    }

    public function changeProdSuggestions()
    {
        $this->load->model('product');
        $obj = $this->input->get();
        $this->product->update_prod_suggestions($obj['prod_id'], $obj['stat']);

        echo json_encode(1);
    }

    public function addProduct()
    {
        if ($this->user->myData['access'] != 100)
            die();

        $this->load->model("product");
        $page = $this->input->get('from_page');
        $data = array("base_url" => base_url(), "alert" => "");
        if ($this->input->post("AddBtn")) {
            $dd = array(
                "product_articule" => $this->input->post("product_articule"),
                "product_name" => $this->input->post("product_name"),
                "product_about" => $this->input->post("product_about"),
                "categories" => $this->input->post("categories"),
                "product_type" => $this->input->post("product-type"),
                "product_form" => $this->input->post("product-form"),
                "product_brand" => $this->input->post("product-brand"),
                "active_substance" => $this->input->post("active-substances"),
                "indications" => $this->input->post("indications"),
                "product_old_price" => $this->input->post("product_old_price"),
                "product_price" => $this->input->post("product_price"),
                "total_count_in_store" => $this->input->post("total_count_in_store"),
                "product_status" => $this->input->post("product_status")
            );

            $config['upload_path'] = './upload_product/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $config['encrypt_name'] = 'TRUE';
            $config['max_size'] = '4500';
            $config['max_width'] = '4500';
            $config['max_height'] = '3000';
            $this->load->library('upload', $config);

            if ($_FILES and $_FILES["userfile1"] and $_FILES["userfile1"]["error"] != 4) {
                for ($i = 1; $i <= 3; $i++) {
                    if ($_FILES and $_FILES["userfile" . $i] and $_FILES["userfile" . $i]["error"] != 4) {
                        if ($this->upload->do_upload("userfile" . $i)) {
                            $img = $this->upload->data();
                            $dd['product_pic'][$i] = $img['file_name'];
                        } else {
                            $data['alert'] = $this->createAlert($this->upload->display_errors());
                        }
                    }
                }
            } else {
                $data['alert'] = $this->createAlert("Пожалуйста выберите фотографию для аватарки!");
            }
            if (strlen($data['alert']) == 0) {
                $p_id = $this->product->add($dd);
                if ($p_id == -1) {
                    $data['alert'] = $this->createAlert('Товар с этим артикулем уже существует!');
                } else {
                    redirect(base_url("index.php/Admin/products?do=addok&id=" . $p_id . "&page=" . $page), "refresh");
                }
            }
        }
        $data['page'] = $page;
        $data['content'] = $this->parser->parse('admin/product/add', $data, true);
        $this->template($data);
    }

    public function editProduct($product_id)
    {
        if ($this->user->myData['access'] != 100)
            die();

        $this->load->model("product");

        $data = array("base_url" => base_url(), "alert" => "");

        $page = $this->input->get('from_page');

        $product = $this->product->get($product_id);

        foreach ($product as $i => $p) {
            $data[$i] = $p;
        }

        $data['images'] = $this->product->get_img_by_id($product_id);
        if ($this->input->post("AddBtn")) {
            if ($this->input->post("active-substances") == '') {
                $as = array();
            } else {
                $as = $this->input->post("active-substances");
            }
            if ($this->input->post("indications") == '') {
                $ind = array();
            } else {
                $ind = $this->input->post("indications");
            }
            $dd = array(
                "product_articule" => $this->input->post("product_articule"),
                "product_name" => $this->input->post("product_name"),
                "product_about" => $this->input->post("product_about"),
                "categories" => $this->input->post("categories"),
                "product_type" => $this->input->post("product-type"),
                "product_form" => $this->input->post("product-form"),
                "product_brand" => $this->input->post("product-brand"),
                "active_substance" => $as,
                "indications" => $ind,
                "product_old_price" => $this->input->post("product_old_price"),
                "product_price" => $this->input->post("product_price"),
                "product_status" => $this->input->post("product_status")
            );

            $config['upload_path'] = './upload_product/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $config['encrypt_name'] = 'TRUE';
            $config['max_size'] = '4500';
            $config['max_width'] = '4500';
            $config['max_height'] = '3000';

            $this->load->library('upload', $config);

            // if ($_FILES AND $_FILES["userfile1"] AND $_FILES["userfile1"]["error"] != 4)
            // {
            //     if ($this->upload->do_upload("userfile1"))
            //     {
            //         $img = $this->upload->data();
            //         $dd['product_pic'] = $img['file_name'];
            //     } else {
            //         $data['alert'] = $this->upload->display_errors(
            //             '<p style="margin-left:20px;padding:3px;width:fit-content;background:red;color:white;font-size:16px">', '</p>'
            //         );
            //     }
            // }

            // $this->product->update($product_id, $dd);

            for ($i = 1; $i <= 3; $i++) {
                if ($_FILES and $_FILES["userfile" . $i] and $_FILES["userfile" . $i]["error"] != 4) {
                    if ($this->upload->do_upload("userfile" . $i)) {
                        $img = $this->upload->data();
                        $dd['product_pic'][$i] = $img['file_name'];
                        // print_r($dd['product_pic'])
                        //$this->product->add_image(array("product_id" => $product_id, "product_pic" => $img['file_name']));
                    }
                    $data['alert'] = $this->upload->display_errors(
                        '<p style="margin-left:20px;padding:3px;width:fit-content;background:red;color:white;font-size:16px">',
                        '</p>'
                    );
                }
            }
            $this->product->update($product_id, $dd);

            if (strlen($data['alert']) == 0)
                redirect(base_url("index.php/Admin/products?do=extendok&id=" . $product_id . "&page=" . $page), "refresh");
        }
        $data['page'] = $page;
        $data['content'] = $this->parser->parse('admin/product/edit', $data, true);
        $this->template($data);
    }

    public function imgRemove()
    {
        $this->load->model("product");

        $id = $this->input->get("id");
        $this->product->remove_image($id);
        echo 'ok';
    }

    public function import()
    {
        $this->load->model("product");
        $data = array("base_url" => base_url(), "alert" => "");
        if ($this->input->post("AddBtn")) {
            $to_add = array();
            $no_add = array();
            $count_add = 0;
            $array = str_getcsv($this->input->post("product_csv"), "\n");
            unset($array[0]);
            foreach ($array as $v) {
                $obj = str_getcsv($v, ';');
                if ($obj[0] != "") {
                    $count_add++;
                    $pp = array("product_name" => $obj[2], "product_old_price" => $obj[4], "product_price" => $obj[5], "product_articule" => $obj[1], "total_count_in_store" => $obj[3]);
                    if (!$this->product->check_by_artk($obj[1])) {
                        $to_add[] = $pp;
                    } else {
                        $no_add[] = $pp;
                    }
                }
            }
            foreach ($to_add as $obj) {
                $this->product->add_from_import($obj);
            }
            $data['alert'] = '     Найдено: ' . $count_add . ', добавлено: ' . count($to_add) . ' не добавлено: ' . count($no_add);
        }
        $data['content'] = $this->parser->parse('admin/product/import', $data, true);
        $this->template($data);
    }
    private function importJsonFile()
    {
        $this->load->model("product");
        $data = array("base_url" => base_url(), "alert" => "");
        if ($this->input->post("AddBtn")) {
            if ($_FILES and $_FILES["userfile"] and $_FILES["userfile"]["error"] != 4) {
                print_r(json_decode(file_get_contents($_FILES['userfile']['tmp_name']), true));
                $imported_array = json_decode(file_get_contents($_FILES['userfile']['tmp_name']), true);
                foreach ($imported_array as $imported_item) {
                    $this->product->import_from_json($imported_item);
                }
                redirect(base_url("index.php/Admin/products"), "refresh");
            } else {
                echo 'Error ocurred';
            }
        }
        $data['content'] = $this->parser->parse('admin/product/import', $data, true);
        $this->template($data);
    }

    public function products()
    {
        if ($this->user->myData['access'] != 100)
            die();
        $this->load->model("product");

        $data = array("base_url" => base_url(), "alert" => "", "pages" => array());

        if ($this->input->get("do") == "addok") {
            $data['alert'] = $this->createAlertInfo('Успешно добавлен');
        } else if ($this->input->get("do") == "updateok") {
            $data['alert'] = $this->createAlertInfo('Данные успешно обнавлены');
        } else if ($this->input->get("do") == "extendok") {
            $data['alert'] = $this->createAlertInfo('Данные успешно обновлены');
        } else if ($this->input->get("do") == "remove") {
            $this->product->remove($this->input->get("id"));
            $data['alert'] = $this->createAlertInfo('Данные успешно удалены');
        } else if ($this->input->get("do") == "removeprodpic") {
            $this->product->remove_prod_pic($this->input->get("prod_pic_id"));
            $data['alert'] = $this->createAlertInfo('Данные успешно удалены');
        }

        $current_page = $this->input->get('page');

        if ($current_page == '' || $current_page < 0) {
            $current_page = 1;
        }
        $list = $this->product->get_all(
            $current_page,
            $this->input->get('category_sort'),
            $this->input->get('brand_sort'),
            $this->input->get('price_sort'),
            $this->input->get('search_prod'),
            $this->input->get('export_status_sort')
        );
        $data['category_sort'] = $this->input->get('category_sort');
        $data['brand_sort'] = $this->input->get('brand_sort');
        $data['price_sort'] = $this->input->get('price_sort');
        $data['search_prod'] = $this->input->get('search_prod');
        $data['export_status_sort'] = $this->input->get('export_status_sort');

        $data['list'] = $list['products'];
        unset($list['products']);
        $data['info'] = $list;
        $data['current_page'] = $current_page;
        $data['content'] = $this->parser->parse('admin/product/list', $data, true);
        $this->template($data);
    }

    public function productsGoToPage()
    {
        $this->load->model('product');
        $page = $this->input->get('go_to_page');
        $category_sort = $this->input->get('category_sort');
        $brand_sort = $this->input->get('brand_sort');
        $price_sort = $this->input->get('price_sort');
        $search_prod = $this->input->get('search_prod');
        $export_status_sort = $this->input->get('export_status_sort');
        if (is_numeric($page) && $page > 0) {
            $products_info = $this->product->get_all($page);
            if (sizeof($products_info['products']) == 0) {
                if ($products_info['total_pages'] == 0) {
                    $page = 1;
                } else {
                    $page = $products_info['total_pages'];
                }
            }
            redirect(base_url("index.php/admin/products?search_prod=" . $search_prod . "&category_sort=" . $category_sort . "&brand_sort=" . $brand_sort . "&price_sort=" . $price_sort . '$export_status_sort=' . $export_status_sort . "&page=" . $page));
        } else {
            redirect(base_url("index.php/admin/products?search_prod=" . $search_prod . "&category_sort=" . $category_sort . "&brand_sort=" . $brand_sort . "&price_sort=" . $price_sort . '$export_status_sort=' . $export_status_sort . "&page=1"));
        }
    }

    public function productImages($id)
    {
        if ($this->user->myData['access'] != 100)
            die();
        $this->load->model("product");

        $data = array("base_url" => base_url(), "alert" => "", "pages" => array());

        if ($this->input->get("do") == "addok") {
            $data['alert'] = $this->createAlertInfo('Успешно добавлен');
        } else if ($this->input->get("do") == "updateok") {
            $data['alert'] = $this->createAlertInfo('Данные успешно обнавлены');
        } else if ($this->input->get("do") == "extendok") {
            $data['alert'] = $this->createAlertInfo('Данные успешно обновлены');
        } else if ($this->input->get("do") == "remove") {
            $this->product->remove_prod_pic($this->input->get("prod_pic_id"));
            $data['alert'] = $this->createAlertInfo('Данные успешно удалены');
        }


        $list = $this->product->get_product_images($id);
        $data['list'] = $list;
        $data['product'] = $this->product->get($id);
        $data['product_id'] = $id;

        $data['content'] = $this->parser->parse('admin/product/product_images', $data, true);
        $this->template($data);
    }

    public function orders()
    {
        if ($this->user->myData['access'] < 60)
            die();
        $this->load->model("order");
        $this->load->model("status");

        $data = array("base_url" => base_url(), "alert" => "");
        $current_page = $this->input->get('page');
        $status = $this->input->get('status_list_select');
        $order_inp = $this->input->get('order_inp');
        $order_date = $this->input->get('order_date');
        $order_date_sort = $this->input->get('order_date_sort');
        $data['sort_selected_status'] = $status;
        $data['sort_search_input'] = $order_inp;
        $data['sort_date'] = $order_date;
        $data['order_date_sort'] = $order_date_sort;

        if ($current_page == '' || $current_page < 0) {
            $current_page = 1;
        }
        $orders = $this->order->get_all($current_page, $order_inp, $status, $order_date, $order_date_sort);
        if ($this->input->get('status_list_select') != '') {
            $data['status_sort'] = $this->input->get('status_list_select');
        } else {
            $data['status_sort'] = '';
        }
        $data['list'] = [];
        if (isset($orders['orders']))
            $data['list'] = $orders['orders'];
        $data['info'] = $orders;
        $data['status'] = $this->status->get_all();

        $data['content'] = $this->parser->parse('admin/order/list', $data, true);
        $this->template($data);
    }

    public function orderExportExcel()
    {
        header('Content-Type: text/csv; charset=windows-1251');
        header("Content-Disposition: attachment;filename=file.csv");

        $this->load->model('order');
        $orders = $this->order->get_all_orders();
        $list = array();
        $isPrintHeader = false;
        foreach ($orders as $k => $row) {
            unset($row['code']);
            if (!$isPrintHeader) {
                $list[] = array_keys($row);
                $isPrintHeader = true;
            }
            $list[] = array_values($row);
        }
        $fp = fopen('php://output', 'w');
        foreach ($list as $fields) {
            $tt = array();
            foreach ($fields as $p => $titlesItem) {
                $tt[$p] = $this->toWindow($titlesItem);
            }
            fputcsv($fp, $tt, ";");
        }
        fclose($fp);
    }

    private function toWindow($ii)
    {
        return iconv("utf-8", "windows-1251", $ii);
    }

    public function addOrder()
    {
        if ($this->user->myData['access'] < 60)
            die();
        $this->load->model("order");
        $data = array("base_url" => base_url(), "alert" => "");
        $data['content'] = $this->parser->parse('admin/order/add', $data, true);
        $this->template($data);
    }

    public function addOrderConfirm()
    {
        if ($this->user->myData['access'] < 60)
            die();
        $this->load->model("order");
        $array = $this->input->post();

        $rand_num = rand(1000, 9999);
        $array['code'] = $rand_num;
        $answer = $this->order->add_order_admin($array);

        $sms_id = $this->sms->add(array('sms_mobile' => $array["phone_number"], 'sms_text' => $rand_num));
        $sms_resp = $this->create_url_f55($array["phone_number"], $rand_num, $sms_id);

        if ($answer['stat'] == 1) {
            $this->update_sms($sms_id, $sms_resp, $answer['order_id'], 'order');
            $array2 = array('answ' => 1, 'order_id' => $answer['order_id'], 'order_phone' => $this->input->post("phone_number"));
            echo json_encode($array2);
        } else {
            echo json_encode(array('answ' => -1));
        }
    }

    public function update_sms($sms_id, $array, $source_id, $source_name)
    {
        $date = new DateTime($array['msg']['timestamp']);
        $new_date = date_format($date, 'Y-m-d H:i:s');
        $new_arr = array(
            'sms_answer' => $array['msg']['smsc_msg_status'],
            'sms_date_send' => $new_date,
            'sms_from_type' => $source_name,
            'sms_from_type_id' => $source_id
        );
        if ($array['error'] == 1) {
            $new_arr['sms_status'] = -1;
        } else {
            $new_arr['sms_status'] = 1;
        }
        $this->sms->update($sms_id, $new_arr);
    }

    public function orderProducts($id)
    {
        if ($this->user->myData['access'] < 60)
            die();
        $this->load->model("order");
        $this->load->model("status");
        $this->load->helper('cookie');
        $data = array("base_url" => base_url(), "alert" => "");

        if ($this->input->get("do") == "updateok") {
            $data['alert'] = $this->createAlertInfo('Статус заказа обнoвлён');
        }
        if ($this->input->get("do") == "updateNotOk") {
            $data['alert'] = $this->createAlertInfo($this->input->post('status'));
        }
        if ($this->input->post('saveBtn')) {
            $auth_id = $this->input->cookie('auth_id', TRUE);
            $user = $this->user->GetUserData($auth_id);
            $order = $this->order->get($id);
            $order_user = $this->order->get_user($id);


//            PushNotifications::send($order_user[0]['onesignal_id'], $title, $description,'',$id);

            $prev_status_id = ($this->order->get($id))['status_id'];

            if ($order["wallet_name"] && $order["transaction_id"]) {
                $status_for_send = null;
                if ($this->input->post('status') == 3) {
                    $status_for_send = 2;
                } else if ($this->input->post('status') == 4) {
                    $status_for_send = 6;
                } else {
                    $this->save_user_or_sr_ch($user['user_id'], $id, $prev_status_id, $this->input->post('status'), $this->input->post('user_order_comment'));
                    $this->order->change_status($id, $this->input->post('status'));
                }
                if ($status_for_send != null && $status_for_send != -1) {
                    $url = "https://my1.babilon-m.tj/qrapi/MarketPlace/UpdateTxnOrder.aspx";
                    $marketPlaceHash = hash('sha1', $this->marketPlaceId . $this->marketPlaceToken . $order["transaction_id"] . $status_for_send);
                    $arr = array(
                        "Sign" =>  $marketPlaceHash,
                        "MarketPlaceId" => $this->marketPlaceId,
                        "TransactionId" => $order["transaction_id"],
                        "NewStatus" => $status_for_send,
                    );
                    $result = json_decode($this->postCURL($url, $arr));
                    //    print_r($result);
                    //    die();
                    if ($result->result == 4 || $result == 6) {
                        $this->order->change_status($id, $this->input->post('status'));
                        $this->save_user_or_sr_ch($user['user_id'], $id, $prev_status_id, $this->input->post('status'), $this->input->post('user_order_comment'));
                    } else {
                        $answ = $this->bOrderRes($result->result);
                        if (!$answ) $answ = "Произошла ошибка";
                        redirect(base_url("index.php/admin/orderProducts/" . $id . "?do=updateNotOk&comment=" . $answ));
                    }
                }
            } else {
                $answer = $this->order->change_status($id, $this->input->post('status'));
                if ($answer == 1) {
                    // date_default_timezone_set('Asia/Dushanbe');
                    // $now_date = date('Y-m-d H:i:s');
                    $this->save_user_or_sr_ch($user['user_id'], $id, $prev_status_id, $this->input->post('status'), $this->input->post('user_order_comment'));
                }
            }
            redirect(base_url("index.php/admin/orderProducts/" . $id . "?do=updateok"));
        }

        $user_changes = $this->order->get_all_user_changes($id);
        $user_info = $this->order->get_user($id);
        $data['user_changes'] = $user_changes;
        $data['user_info'] = $user_info;
        $order_prods = $this->order->get_order_prods($id);
        $current_order = $this->order->get($id);
        $data['order'] = $current_order;
        $data['order_id'] = $id;
        $data['list'] = $order_prods;
        $data['status'] = $this->status->get_all();
        $data['current_status_id'] = $current_order['status_id'];
        $data['current_status'] = $this->status->get($current_order['status_id']);
        $data['content'] = $this->parser->parse('admin/order/orderProducts', $data, true);
        $this->template($data);
    }

    private function save_user_or_sr_ch($user_id, $id, $prev_status_id, $status, $comment)
    {
        $this->order->save_user_order_status_change(
            $user_id,
            $id,
            $prev_status_id,
            $status,
            $comment
        );
    }

    public function activeSubstances()
    {
        if ($this->user->myData['access'] != 100)
            die();
        $this->load->model("ActiveSubstance");

        $data = array("base_url" => base_url(), "alert" => "");
        if ($this->input->get("do") == "addok") {
            $data['alert'] = $this->createAlertInfo('Успешно добавлен');
        } else if ($this->input->get("do") == "updateok") {
            $data['alert'] = $this->createAlertInfo('Данные успешно обнoвлены');
        } else if ($this->input->get("do") == "remove") {
            $this->ActiveSubstance->remove($this->input->get("id"));
            $data['alert'] = $this->createAlertInfo('Данные успешно удалены');
        }

        $active_substances = $this->ActiveSubstance->get_all();
        $data['list'] = $active_substances;

        $data['content'] = $this->parser->parse('admin/active_substance/list', $data, true);
        $this->template($data);
    }

    public function addActiveSubstance()
    {
        if ($this->user->myData['access'] != 100)
            die();
        $this->load->model("ActiveSubstance");

        $data = array("base_url" => base_url(), "alert" => "");
        if ($this->input->post("AddBtn")) {
            $dd = array("tag_name" => $this->input->post("active_substance_name"));
            $this->ActiveSubstance->add($dd);
            redirect(base_url("index.php/admin/activeSubstances?do=addok"));
        }
    }

    public function editActiveSubstance($id)
    {
        if ($this->user->myData['access'] != 100)
            die();
        $this->load->model("ActiveSubstance");

        $data = array("base_url" => base_url(), "alert" => "");

        $data['active_substance'] = $this->ActiveSubstance->get($id);
        if ($this->input->post("AddBtn")) {
            $dd = array("tag_name" => $this->input->post("active_substance_name"));
            $this->ActiveSubstance->update($id, $dd);
            redirect(base_url("index.php/admin/activeSubstances?do=addok"));
        }

        $data['content'] = $this->parser->parse('admin/active_substance/edit', $data, true);
        $this->template($data);
    }

    public function status()
    {
        if ($this->user->myData['access'] != 100)
            die();
        $this->load->model("status");

        $data = array("base_url" => base_url(), "alert" => "");

        if ($this->input->get("do") == "addok") {
            $data['alert'] = $this->createAlertInfo('Успешно добавлен');
        } else if ($this->input->get("do") == "updateok") {
            $data['alert'] = $this->createAlertInfo('Данные успешно обнoвлены');
        } else if ($this->input->get("do") == "remove") {
            $this->status->remove($this->input->get("id"));
            $data['alert'] = $this->createAlertInfo('Данные успешно удалены');
        }

        $status = $this->status->get_all();
        $data['list'] = $status;

        $data['content'] = $this->parser->parse('admin/status/list', $data, true);
        $this->template($data);
    }

    public function addStatus()
    {
        if ($this->user->myData['access'] != 100)
            die();
        $this->load->model("status");

        $data = array("base_url" => base_url(), "alert" => "");
        if ($this->input->post("AddBtn")) {
            $dd = array("id" => $this->input->post("status_number"), "status_text" => $this->input->post("status_text"));
            $this->status->add($dd);
            redirect(base_url("index.php/admin/status?do=addok"));
        }

        $data['content'] = $this->parser->parse('admin/status/add', $data, true);
        $this->template($data);
    }

    public function editStatus($id)
    {
        if ($this->user->myData['access'] != 100)
            die();
        $this->load->model("status");

        $data = array("base_url" => base_url(), "alert" => "");

        $data['status'] = $this->status->get($id);

        if ($this->input->post("AddBtn")) {
            $dd = array("status_text" => $this->input->post("status_text"));
            $this->status->update($id, $dd);
            redirect(base_url("index.php/admin/status?do=addok"));
        }

        $data['content'] = $this->parser->parse('admin/status/edit', $data, true);
        $this->template($data);
    }


    public function indications()
    {
        if ($this->user->myData['access'] != 100)
            die();
        $this->load->model("indication");

        $data = array("base_url" => base_url(), "alert" => "");

        if ($this->input->get("do") == "remove") {
            $this->indication->remove($this->input->get("id"));
            $data['alert'] = $this->createAlertInfo('Данные успешно удалены');
        }

        $active_substances = $this->indication->get_all();
        $data['list'] = $active_substances;

        $data['content'] = $this->parser->parse('admin/indications/list', $data, true);
        $this->template($data);
    }

    public function addIndication()
    {
        if ($this->user->myData['access'] != 100)
            die();
        $this->load->model("indication");

        $data = array("base_url" => base_url(), "alert" => "");
        if ($this->input->post("AddBtn")) {
            $dd = array("tag_name" => $this->input->post("indication_name"));
            $this->indication->add($dd);
            redirect(base_url("index.php/admin/indications?do=addok"));
        }
    }

    public function editIndication($id)
    {
        if ($this->user->myData['access'] != 100)
            die();
        $this->load->model("indication");

        $data = array("base_url" => base_url(), "alert" => "");

        $data['indication'] = $this->indication->get($id);
        if ($this->input->post("AddBtn")) {
            $dd = array("tag_name" => $this->input->post("indication_name"));
            $this->indication->update($id, $dd);
            redirect(base_url("index.php/admin/indications?do=addok"));
        }

        $data['content'] = $this->parser->parse('admin/indications/edit', $data, true);
        $this->template($data);
    }


    public function forms()
    {
        if ($this->user->myData['access'] != 100)
            die();
        $this->load->model("form");

        $data = array("base_url" => base_url(), "alert" => "");

        if ($this->input->get("do") == "remove") {
            $this->form->remove($this->input->get("id"));
            $data['alert'] = $this->createAlertInfo('Данные успешно удалены');
        } else if ($this->input->get("do") == "addok") {
            $data['alert'] = $this->createAlertInfo('Данные успешно обновлены');
        }

        $forms = $this->form->get_all();
        $data['list'] = $forms;

        $data['content'] = $this->parser->parse('admin/form/list', $data, true);
        $this->template($data);
    }

    public function addForm()
    {
        if ($this->user->myData['access'] != 100)
            die();
        $this->load->model("form");

        $data = array("base_url" => base_url(), "alert" => "");
        if ($this->input->post("AddBtn")) {
            $dd = array("form_name" => $this->input->post("form_name"));
            $this->form->add($dd);
            redirect(base_url("index.php/admin/forms?do=addok"));
        }
    }

    public function editForm($id)
    {
        if ($this->user->myData['access'] != 100)
            die();
        $this->load->model("form");

        $data = array("base_url" => base_url(), "alert" => "");

        $data['form'] = $this->form->get($id);

        if ($this->input->post("AddBtn")) {
            $dd = array("form_name" => $this->input->post("form_name"));
            $this->form->update($id, $dd);
            redirect(base_url("index.php/admin/forms?do=addok"));
        }
    }

    public function countries()
    {
        if ($this->user->myData['access'] != 100)
            die();
        $this->load->model("country");

        $data = array("base_url" => base_url(), "alert" => "");

        if ($this->input->get("do") == "remove") {
            $this->country->remove($this->input->get("id"));
            $data['alert'] = $this->createAlertInfo('Данные успешно удалены');
        }

        $countries = $this->country->get_all();
        $data['list'] = $countries;

        $data['content'] = $this->parser->parse('admin/country/list', $data, true);
        $this->template($data);
    }

    public function addCountry()
    {
        if ($this->user->myData['access'] != 100)
            die();
        $this->load->model("country");

        $data = array("base_url" => base_url(), "alert" => "");
        if ($this->input->post("AddBtn")) {
            $dd = array("country_name" => $this->input->post("country_name"));
            $this->country->add($dd);
            redirect(base_url("index.php/admin/countries?do=addok"));
        }

        $data['content'] = $this->parser->parse('admin/country/add', $data, true);
        $this->template($data);
    }

    public function editCountry($id)
    {
        if ($this->user->myData['access'] != 100)
            die();
        $this->load->model("country");

        $data = array("base_url" => base_url(), "alert" => "");

        $data['country'] = $this->country->get($id);
        if ($this->input->post("AddBtn")) {
            $dd = array("country_name" => $this->input->post("country_name"));
            $this->country->update($id, $dd);
            redirect(base_url("index.php/admin/countries?do=addok"));
        }

        $data['content'] = $this->parser->parse('admin/country/edit', $data, true);
        $this->template($data);
    }

    public function brands()
    {
        if ($this->user->myData['access'] != 100)
            die();
        $this->load->model("brand");

        $data = array("base_url" => base_url(), "alert" => "");

        if ($this->input->get("do") == "remove") {
            $this->brand->remove($this->input->get("id"));
            $data['alert'] = $this->createAlertInfo('Данные успешно удалены');
        } else if ($this->input->get("do") == "addok") {
            $data['alert'] = $this->createAlertInfo('Данные успешно обновлены');
        }

        $brands = $this->brand->get_all();
        $data['list'] = $brands;

        $data['content'] = $this->parser->parse('admin/brand/list', $data, true);
        $this->template($data);
    }

    public function addBrand()
    {
        if ($this->user->myData['access'] != 100)
            die();
        $this->load->model("brand");

        $data = array("base_url" => base_url(), "alert" => "");
        if ($this->input->post("AddBtn")) {
            $dd = array("brand_name" => $this->input->post("brand_name"));
            $this->brand->add($dd);
            redirect(base_url("index.php/admin/brands?do=addok"));
        }
    }

    public function editBrand($id)
    {
        if ($this->user->myData['access'] != 100)
            die();
        $this->load->model("brand");
        $data = array("base_url" => base_url(), "alert" => "");
        $data['brand'] = $this->brand->get($id);
        if ($this->input->post("AddBtn")) {
            $dd = array("brand_name" => $this->input->post("brand_name"));
            $this->brand->update($id, $dd);
            redirect(base_url("index.php/admin/brands?do=addok"));
        }
    }

    public function recipes()
    {
        if ($this->user->myData['access'] < 60)
            die();
        $this->load->model("recipe");
        $data = array("base_url" => base_url(), "alert" => "");
        if ($this->input->get("do") == "remove") {
            $this->recipe->remove($this->input->get("recipe_id"));
            $data['alert'] = $this->createAlertInfo('Данные успешно удалены');
        }
        $recipes = $this->recipe->get_all();
        $data['list'] = $recipes;
        $data['content'] = $this->parser->parse('admin/recipe/list', $data, true);
        $this->template($data);
    }

    public function recipePics($id)
    {
        if ($this->user->myData['access'] < 60)
            die();
        $this->load->model("recipe");
        $this->load->model("RecipeStatus");
        $this->load->helper('cookie');
        $data = array("base_url" => base_url(), "alert" => "");

        $recipe_pics = $this->recipe->get_recipe_pics($id);
        $data['list'] = $recipe_pics;


        if ($this->input->get("do") == "updateok") {
            $data['alert'] = $this->createAlertInfo('Статус успешно обнoвлён');
        }
        if ($this->input->post('saveBtn')) {
            $auth_id = $this->input->cookie('auth_id', TRUE);
            $user = $this->user->GetUserData($auth_id);
            $prev_status_id = ($this->recipe->get($id))['status_id'];
            $answer = $this->recipe->change_status($id, $this->input->post('status'));
            if ($answer == 1) {
                // date_default_timezone_set('Asia/Dushanbe');
                // $now_date = date('Y-m-d H:i:s');
                $this->recipe->save_user_recipe_status_change(
                    $user['user_id'],
                    $id,
                    $prev_status_id,
                    $this->input->post('status'),
                    $this->input->post('user_recipe_comment')
                    // $now_date
                );
            }
            redirect(base_url("index.php/admin/recipePics/" . $id . "?do=updateok"));
        }

        $user_changes = $this->recipe->get_all_user_changes($id);
        $data['user_changes'] = $user_changes;
        $current_recipe = $this->recipe->get($id);
        $data['recipe'] = $current_recipe;
        $data['recipe_id'] = $id;
        $data['list'] = $recipe_pics;
        $data['status'] = $this->RecipeStatus->get_all();
        $data['current_status_id'] = $current_recipe['status_id'];
        $data['current_status'] = $this->RecipeStatus->get($current_recipe['status_id']);


        $data['content'] = $this->parser->parse('admin/recipe/recipePics', $data, true);
        $this->template($data);
    }

    public function test()
    {
        $StaringDate = '2017-10-01';
        $newEndingDate = date("Y-m-d", strtotime(date("Y-m-d", strtotime($StaringDate)) . " + 365 day"));
        echo $StaringDate . ' ' . $newEndingDate;
    }

    public function array_to_string($array)
    {
        // $test = array("test" => "text", "test 2" => "text 2");

        $text = '';
        foreach ($array as $i => $v) {
            if ($text != '') {
                $text .= ', ' . $i . ': ' . $v;
            } else {
                $text = $i . ': ' . $v;
            }
        }
        // echo $text;
        return $text;
    }

    public function bOrderRes($id)
    {
        $arr = array(
            "-7" => "Данная транзакция не существует!",
            "-6" => "Срок действия купона истёк!",
            "-5" => "Сейчас невозможно использовать купон!",
            "-4" => "Сумма не правильная!",
            "-3" => "Маркетплейс не существует!",
            "-2" => "Сервер временно не доступен!",
            "-1" => "Ошибка, не правильный запрос!",
            "0" => "Транзакция успешно создана!",
            "1" => "С такими данными транзакция уже создана!",
            "2" => "Транзакция успешно удалена!",
            "3" => "Транзакция успешно оплачена!",
            "4" => "Статус заказа успешно изменен!",
            "5" => "Статус не изменен!",
            "6" => "Успешно отправлен статус заказа!"
        );
        if (isset($arr[$id])) {
            return $arr[$id];
        } else {
            return false;
        }
    }

    private function is_yes($d)
    {
        if ($d == "1")
            return 'Да';
        else
            return 'Нет';
    }

    private function is_checked($d)
    {
        if ($d == "1")
            return 'checked="checked"';
        else
            return '';
    }

    private function dateNow()
    {
        $date = new DateTime();
        $date->setTimeZone(new DateTimeZone('Asia/Dushanbe'));
        return $date->format('Y-m-d H:i:s');
    }

    private function template($data)
    {
        $this->load->model('recipe');
        $this->load->model('order');
        $data['name'] = $this->user->myData['name'];
        $data['waiting_recipe_count'] = sizeof($this->recipe->get_all_waiting());
        $data['waiting_order_count'] = sizeof($this->order->get_all_waiting());
        $this->parser->parse('admin/main', $data);
    }

    private function createAlert($text)
    {
        return $this->parser->parse('admin/alert', array('alertText' => $text), true);
    }

    private function createAlertInfo($text)
    {
        return $this->parser->parse('admin/alertInfo', array('alertText' => $text), true);
    }

    private function fromArray($array, $i, $id)
    {
        foreach ($array as $v) {
            if ($v[$i] == $id) {
                return $v;
            }
        }
        return array();
    }

    public function postCURL($_url, $data)
    {


        $postData = json_encode($data);

        $curl = curl_init($_url);

        curl_setopt($curl, CURLOPT_POSTFIELDS, $postData);

        /* Define content type */
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));

        /* Return json */
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        $output = curl_exec($curl);

        curl_close($curl);

        return $output;
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
        //$message = "Привет, это тестовое сообщение!";
        $params = array(
            "from" => $source,
            "phone_number" => $phone_number,
            "msg" => "Salomat.tj: " . $sms . " - Ваш код для подтверждения телефона",
            "str_hash" => $str_hash,
            "txn_id" => $txn_id,
            "login" => $login,
        );
        $result = $this->call_api($server, "GET", $params);

        // print_r($result);

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
}

/* End of file admin.php */