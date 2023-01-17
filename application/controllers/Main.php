<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Main extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->helper('cookie');
        $this->load->helper('url');
        $this->load->model('user');
        $this->load->model('product');
        $this->load->model('category');
        $this->load->model('slider');
        $this->load->model('page');
        $this->load->model('rating');
        $this->load->model('indication');
        $this->load->model('advertisement');
        $this->load->model('ActiveSubstance');
        $this->load->model('blog');
        $this->load->model('tag');
        $this->load->model('sms');
        $this->load->model('delivery');
        // if (true) {
        // $this->techIssue();
        // } else {
        $this->checkAuth();
        // }
    }

    private $bUserInfoName = "bUserInfo";
    private $marketPlaceId = 48;
    private $marketPlaceToken =  "QA8CVC";
    private $merchantToken =  "vMelHp";
    private $deliveryB = 0;
    private $acquirerId = "B0000004";
    private $merchantId = 1682;


    private $isAuth = null;

    private function checkAuth()
    {
        if ($this->isAuth == null) {
            if ($this->input->cookie('auth_id')) {
                $this->user->GetUserData($this->input->cookie('auth_id'));
            }
            if ($this->user->myData == null) {
                $this->isAuth = false;
                return false;
            } else {
                $this->isAuth = true;
                // redirect(base_url("index.php/admin"),"refresh");                
                return true;
            }
        } else {
            return $this->isAuth;
        }
    }

    public function techIssue()
    {
        redirect(base_url("../../technical_issues/index.html"));
    }

    public function blog_pictures_upload()
    {
        $type = $this->input->get('type');
        if ($type == 'save') {
            $files = $_FILES['userfiles'];
            $file = $files['tmp_name'][0];
            $metaData = json_decode($_POST['metadata']);
            if (is_uploaded_file($file)) {
                move_uploaded_file($file, './upload_blog/' . $metaData->uploadUid . '' . $metaData->fileName);
            }
            echo json_encode(array('uploaded' => 'true', 'fileUid' => $metaData->uploadUid, 'file' => $file));
        } else if ($type == 'remove') {
            $fileNames = $this->input->post('fileNames');
            $uid = $this->input->post('uid');
            $newName = $uid . '' . $fileNames;
            @unlink("././upload_blog/" . $newName);
            echo json_encode($fileNames);
        }
        echo '';
        exit;
    }

    public function sm()
    {
        $type = $this->input->get('type');
        if ($type == 'save') {
            $files = $_FILES['user_files'];
            $file = $files['tmp_name'][0];
            $metaData = json_decode($_POST['metadata']);
            if (is_uploaded_file($file)) {
                move_uploaded_file($file, './upload_recipe/' . $metaData->uploadUid . '' . $metaData->fileName);
            }
            echo json_encode(array('uploaded' => 'true', 'fileUid' => $metaData->uploadUid, 'file' => $file));
        } else if ($type == 'remove') {
            $fileNames = $this->input->post('fileNames');
            $uid = $this->input->post('uid');
            $newName = $uid . '' . $fileNames;
            @unlink("././upload_recipe/" . $newName);
            echo json_encode($fileNames);
        }
        echo '';
        exit;
    }



    // public function addRecipe()
    // {
    //     $this->load->model('recipe');
    //     $metaData = json_decode($_POST['metadata']);
    //     $files = $_FILES['user_files'];

    //     $file = $files['tmp_name'][0];
    //     $recipe_id = '';
    //     if (is_uploaded_file($file)) {
    //         move_uploaded_file($file, './upload_recipe/'  . $metaData->uploadUid . '' . $metaData->fileName);
    //         $recipe_id = $this->recipe->add(array('recipe_pic' => $metaData->uploadUid . '' . $metaData->fileName));
    //     }
    //     echo json_encode(array('uploaded' => 'true', 'fileUid' => $metaData->uploadUid, 'recipe_id' => $recipe_id));
    // }

    public function index()
    {
        $type = $this->input->get('type');
        $data = array('base_url' => base_url(), 'alert' => '');
        $data['categories'] = $this->category->get_all();
        $data['main_slider'] = $this->slider->get_all('normal');
        $data['ad_mini'] = $this->advertisement->get_all('mini_pic');
        $user_id = $this->session->userdata('user_id');

        $data['prods_of_the_day'] = $this->product->get_prods_by_slider_type('product_of_the_day', isset($user_id) ? $user_id : 0);

        $isFromMyBabilon = $this->input->get('from');
        if ($isFromMyBabilon == 'babilon') {
            $babilonUser = $this->input->get('phone');
            $bUserInfo = array(
                'from' => $isFromMyBabilon,
                'phone' => $babilonUser
            );
            setcookie($this->bUserInfoName, json_encode($bUserInfo));
        }

        $categories = $this->category->get_all();
        $j = 0;
        $array = array();
        for ($i = 0; $i < sizeof($categories); $i++) {
            if ($categories[$i]['category_in_main'] == 1 && $j < 3) {
                $array[$j]['categ'] = $categories[$i];
                $array[$j]['categ_slider'] = $this->slider->get_by_slider_category($categories[$i]['id'],$type??1);
                $array[$j]['categ_prods'] = $this->product->get_prods_in_categ($categories[$i]['id'], $user_id ?? 0);
                $j++;
            }
        }
        $data['meta_social_image'] = base_url('salomat_apteka.jpg');
        $data['meta_social_url'] = base_url();
        $data['meta_social_title'] = 'Интернет аптека Salomat.tj, купить онлайн лекарственные препараты и товары для здоровья';
        $data['meta_social_desc'] = 'Удобный поиск лекарств, можно заказать любые препараты недорого по выгодным ценам. Удобный каталог лекарств, инструкций и советы врачей! ☎ 9990 Salomat.tj';
        $data['title'] = 'Интернет аптека Salomat.tj, купить онлайн лекарственные препараты и товары для здоровья';
        $data['categories_for_main_page'] = $array;
        $data['name'] =  $this->session->userdata('name');
        $data['content'] = $this->parser->parse('main', $data, TRUE);
        $this->load->library('session');
        $user = $this->getUser($this->session->userdata('user_id'));
        $data['name'] =  $user['name'] ?? null;
        $data['image'] =  $user['image'] ?? null;
        $data['email'] =  $user['email'] ?? null;


        $data['user_info'] =  $this->session->userdata('name');
        $data['auth'] =   $this->input->cookie('auth_id');
        $data['header'] = $this->parser->parse('parts/header', $data, TRUE);
        $data['footer'] = $this->parser->parse('parts/footer', $data, TRUE);
        $this->parser->parse('template', $data);
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
    public function categoryProducts($id)
    {
        $data = array('base_url' => base_url());
        $current_page = $this->input->get('page');
        $sort_by = $this->input->get('sort_by');

        if ($current_page == '' || $current_page < 0) {
            $current_page = 1;
        }
        if ($sort_by == '') {
            $sort_by = 'asc';
        } else if ($sort_by == 'pr') {
            $sort_by = 'product_rating';
        }

        $category_with_parents = $this->category->get_parent_categories($id);

        if (sizeof($category_with_parents) == 0) {
            redirect('errors/cli/error_404', TRUE);
            return;
        }
        $data['category_id'] = $id;
        $data['page'] = $current_page;
        $data['sort'] = $sort_by;
        $res = $this->product->get_products_by_category($id,  $sort_by, $current_page); //returns products with total count > 0
        $data['total_products'] = $res['total_products'];
        $data['category_with_parents'] = $category_with_parents;
        unset($res['total_products']);

        if (isset($category_with_parents['parent_cat']['parent_cat'])) {
            $data['category'] = $this->category->get_with_children($category_with_parents['parent_cat']['id']);
        } else {
            $data['category'] = $this->category->get_with_children($category_with_parents['id']);
        }
        $data['second_category_id'] = $data['category']['id'];
        $ad_slider = $this->advertisement->get_slider_by_category($id, 'slider');
        $data['ad_slider'] = sizeof($ad_slider) != 0 ? $ad_slider : [];

        $data['categories'] = $this->category->get_all();


        $data['categories_for_main_page'] = [];

        if (isset($res['prod_max_price'])) {
            $data['prod_max_price'] = $res['prod_max_price'];
        } else {
            $data['prod_max_price'] = 9999;
        }
        $data['title'] = $category_with_parents['category_name'] . ' на Salomat.tj';
        $data['category_products'] = $res;
        $data['isOnlySecondCategory'] = $res['isOnlySecondCategory'];
        $data['auth'] =   $this->input->cookie('auth_id');
        $this->load->library('session');
        $user = $this->getUser($this->session->userdata('user_id'));
        $data['name'] =  $user['name'] ?? null;
        $data['image'] =  $user['image'] ?? null;
        $data['email'] =  $user['email'] ?? null;

        $data['content'] = $this->parser->parse('products_by_category', $data, TRUE);
        $data['header'] = $this->parser->parse('parts/header', $data, TRUE);
        $data['footer'] = $this->parser->parse('parts/footer', $data, TRUE);
        $this->parser->parse('template', $data);
    }

    public function sales($id)
    {
        $data = array('base_url' => base_url());
        $sale = $this->indication->get($id);
        if (sizeof($sale) == 0) {
            redirect('errors/cli/error_404', TRUE);
            return;
        }
        $data['categories'] = $this->category->get_all();
        $data['ad_mini'] = $this->advertisement->get_all('mini_pic');
        $data['sales_tag_name'] = $sale['tag_name'];
        $data['sales_id'] = $id;
        $res = $this->indication->get_products($id, 1);
        $data['prod_max_price'] = '';
        if (isset($res['prod_max_price'])) {
            $data['prod_max_price'] = $res['prod_max_price'];
        } else {
            $data['prod_max_price'] = 9999;
        }
        $data['meta_social_title'] = 'Salomat.tj ' . $sale['tag_name'];
        $data['title'] = $data['meta_social_title'];
        $data['auth'] =   $this->input->cookie('auth_id');
        $this->load->library('session');
        $user = $this->getUser($this->session->userdata('user_id'));
        $data['name'] =  $user['name'] ?? null;
        $data['image'] =  $user['image'] ?? null;
        $data['email'] =  $user['email'] ?? null;

        $data['content'] = $this->parser->parse('sales', $data, TRUE);
        $data['header'] = $this->parser->parse('parts/header', $data, TRUE);
        $data['footer'] = $this->parser->parse('parts/footer', $data, TRUE);
        $this->parser->parse('template', $data);
    }

    public function get_sales_prods()
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

            $data['base_url'] = base_url();
            $data['total_products'] = $res;
            echo json_encode(array(
                'html' => $this->parser->parse("sales_products_list", $data, TRUE),
                'data' => $data
            ));
        }
    }

    public function product($id = '', $category_id = '')
    {
        $data = array('base_url' => base_url());
        if ($id == '') {
            redirect('errors/cli/error_404', TRUE);
            return;
        }
        $res = $this->product->get($id, 'main');
        if (!isset($res['product_name'])) {
            redirect('errors/cli/error_404', TRUE);
            return;
        }
        $data['is_second_categ'] = '';
        if ($category_id == '') {
            $category_prod = $this->product->get_product_category($id);
            if (sizeof($category_prod) > 0) {
                $category_id = $category_prod['category_id'];
            }
        }
        $category_with_parents = $this->category->get_parent_categories($category_id);
        if (sizeof($category_with_parents) == 0) {
            $category_with_parents = [];
        } else {
            if ($category_with_parents['parent_cat']['parent_id'] == 0) {
                $data['is_second_categ'] = true;
            }
        }

        $data['category_with_parents'] = $category_with_parents;

        $data['categories'] = $this->category->get_all();
        $ad_img = $this->advertisement->get_all('mini_pic');
        $data['ad_img'] = sizeof($ad_img) != 0 ? $ad_img : [];
        $data['categories_for_main_page'] = [];
        $data['category_products'] = $res;
        $data['product_avatar'] = $res['product_pic'];
        if ($res['product_pic']) {
            $data['meta_social_image'] = base_url('upload_product/' . $res['product_pic']);
        } else {
            $data['meta_social_image'] = base_url('qwerty.png');
        }

        $data['meta_social_title'] = 'Купить ' . $res['product_name'] . ' на Salomat.tj';
        $data['title'] = $data['meta_social_title'];


        $data['meta_social_desc'] = strip_tags($res['product_about']);
        $data['comments'] = $this->rating->get_rating_info($id);
        $data['category_id'] = $category_id;
        $data['similar_products'] = $this->product->get_similar_products($id);
        $data['prods_suggestions'] = $this->product->get_prods_by_slider_type('product_suggestions');

        $data['content'] = $this->parser->parse('product', $data, TRUE);
        $data['auth'] =   $this->input->cookie('auth_id');
        $this->load->library('session');
        $user = $this->getUser($this->session->userdata('user_id'));
        $data['name'] =  $user['name'] ?? null;
        $data['image'] =  $user['image'] ?? null;
        $data['email'] =  $user['email'] ?? null;

        $data['header'] = $this->parser->parse('parts/header', $data, TRUE);
        $data['footer'] = $this->parser->parse('parts/footer', $data, TRUE);

        $this->parser->parse('template', $data);
    }

    public function cart_shopping()
    {
        $data = array('base_url' => base_url());
        $data['categories'] = $this->category->get_all();
        $data['categories_for_main_page'] = [];
        $data['title'] = 'Корзина Salomat.tj';
        $data['auth'] =   $this->input->cookie('auth_id');
        $this->load->library('session');
        $user = $this->getUser($this->session->userdata('user_id'));
        $data['name'] =  $user['name'] ?? null;
        $data['image'] =  $user['image'] ?? null;
        $data['email'] =  $user['email'] ?? null;


        $data['content'] = $this->parser->parse('cart_shopping', $data, TRUE);
        $data['header'] = $this->parser->parse('parts/header', $data, TRUE);
        $data['footer'] = $this->parser->parse('parts/footer', $data, TRUE);

        $this->parser->parse('template', $data);
    }

    public function checkout()
    {
        $data = array('base_url' => base_url());
        $data['categories'] = $this->category->get_all();
        $data['categories_for_main_page'] = [];
        $data['bUser'] = false;
        $data['bUserInfo'] = 'null';
        if ($this->input->cookie($this->bUserInfoName)) {
            $data['bUser'] = true;
            $data['bUserInfo'] = $this->input->cookie($this->bUserInfoName);
        };
        $data['delivery'] = $this->delivery->get_all();
        $data['title'] = 'Оформление заказа на Salomat.tj';
        $data['auth'] =   $this->input->cookie('auth_id');
        $this->load->library('session');
        $user = $this->getUser($this->session->userdata('user_id'));
        $data['name'] =  $user['name'] ?? null;
        $data['phone'] =  $user['login'] ?? null;
        $data['birth_date'] =  $user['birth_date'] ?? null;
        $data['gender'] =  $user['gender'] ?? null;
        $data['address'] =  $user['address'] ?? null;
        $data['email'] =  $user['email'] ?? null;
        $data['image'] =  $user['image'] ?? null;


        $data['content'] = $this->parser->parse('checkout', $data, TRUE);
        $data['header'] = $this->parser->parse('parts/header', $data, TRUE);
        $data['footer'] = $this->parser->parse('parts/footer', $data, TRUE);

        $this->parser->parse('template', $data);
    }

    public function searchProductForBlog()
    {
        $data['srch_inp'] = $this->input->get("srch_pr_inp");
        $res = $this->product->search_for_prod(
            $this->input->get("srch_pr_inp")
        );

        echo json_encode($res);
    }

    public function searchProductResult()
    {
        $data = array('base_url' => base_url());
        $data['categories'] = $this->category->get_all();
        $data['ad_mini'] = $this->advertisement->get_all('mini_pic');

        $search_result = $this->replaceStr($this->input->get("srch_pr_inp"));
        $data['srch_inp'] = $search_result;
        $res = $this->product->search_for_prod($search_result);

        var_dump($res['srch_prod_max_pr']);
        if (isset($res['srch_prod_max_pr'])) {
            $data['srch_prod_max_price'] = $res['srch_prod_max_pr'];
        } else {
            $data['srch_prod_max_price'] = 9999;
        }

        $data['title'] = 'Поиск: ' . $search_result . ' на Salomat.tj';

        $data['content'] = $this->parser->parse('product_search_result', $data, TRUE);
        $data['auth'] = $this->input->cookie('auth_id');
        $this->load->library('session');
        $user = $this->getUser($this->session->userdata('user_id'));
        $data['name'] =  $user['name'] ?? null;
        $data['image'] =  $user['image'] ?? null;
        $data['email'] =  $user['email'] ?? null;

        $data['header'] = $this->parser->parse('parts/header', $data, TRUE);
        $data['footer'] = $this->parser->parse('parts/footer', $data, TRUE);
        $this->parser->parse('template', $data);
    }

    public function blog($id)
    {
        $data = array('base_url' => base_url());
        $blog = $this->blog->get($id);
        $data['blog'] = $blog;
        if (sizeof($blog) == '') {
            redirect('errors/cli/error_404', TRUE);
            return;
        }
        $data['categories'] = $this->category->get_all();
        $data['prods_of_the_day'] = $this->product->get_prods_by_slider_type('product_of_the_day');
        $data['auth'] =   $this->input->cookie('auth_id');
        $this->load->library('session');
        $user = $this->getUser($this->session->userdata('user_id'));
        $data['name'] =  $user['name'] ?? null;
        $data['image'] =  $user['image'] ?? null;
        $data['email'] =  $user['email'] ?? null;

        $data['content'] = $this->parser->parse('blog_list_item_inside', $data, TRUE);
        $data['header'] = $this->parser->parse('parts/header', $data, TRUE);
        $data['footer'] = $this->parser->parse('parts/footer', $data, TRUE);
        $this->parser->parse('template', $data);
    }

    public function blogList()
    {
        $data = array('base_url' => base_url());
        $data['tags'] = $this->tag->get_all();
        $data['categories'] = $this->category->get_all();
        $data['content'] = $this->parser->parse('blog_list', $data, TRUE);
        $data['auth'] =   $this->input->cookie('auth_id');
        $this->load->library('session');
        $user = $this->getUser($this->session->userdata('user_id'));
        $data['name'] =  $user['name'] ?? null;
        $data['image'] =  $user['image'] ?? null;
        $data['email'] =  $user['email'] ?? null;

        $data['header'] = $this->parser->parse('parts/header', $data, TRUE);
        $data['footer'] = $this->parser->parse('parts/footer', $data, TRUE);
        $this->parser->parse('template', $data);
    }

    public function blogInfo()
    {
        $user_id = $this->session->userdata('user_id');
        $blog_id = $this->input->get("blog_id");
        $data = array('base_url' => base_url());
        $data['tags'] = $this->tag->get_all();
        $data['categories'] = $this->category->get_all();
        if (!$blog_id){

            $data['prods_suggestions'] = $this->product->get_prods_by_slider_type('product_suggestions');
        }else{
            $data['prods_suggestions'] = $this->blog->blog_procucts($blog_id,$user_id??1);
        }
        $data['title'] = 'Семь основных причин, почему вакцинироваться должен каждый';
        $data['content'] = $this->parser->parse('blog_info', $data, TRUE);
        $data['auth'] =   $this->input->cookie('auth_id');
        $this->load->library('session');
        $user = $this->getUser($this->session->userdata('user_id'));
        $data['name'] =  $user['name'] ?? null;
        $data['image'] =  $user['image'] ?? null;
        $data['email'] =  $user['email'] ?? null;

        $data['header'] = $this->parser->parse('parts/header', $data, TRUE);
        $data['footer'] = $this->parser->parse('parts/footer', $data, TRUE);
        $this->parser->parse('template', $data);
    }

    public function blogPopular()
    {
        $data = array('base_url' => base_url());
        $data['tags'] = $this->tag->get_all();
        $data['categories'] = $this->category->get_all();
        $data['title'] = 'Полулярное';
        $data['content'] = $this->parser->parse('blog_popular', $data, TRUE);
        $data['auth'] =   $this->input->cookie('auth_id');
        $this->load->library('session');
        $user = $this->getUser($this->session->userdata('user_id'));
        $data['name'] =  $user['name'] ?? null;
        $data['image'] =  $user['image'] ?? null;
        $data['email'] =  $user['email'] ?? null;

        $data['header'] = $this->parser->parse('parts/header', $data, TRUE);
        $data['footer'] = $this->parser->parse('parts/footer', $data, TRUE);
        $this->parser->parse('template', $data);
    }

    public function user_info()
    {
        $data = array('base_url' => base_url());
        $data['categories'] = $this->category->get_all();
        $data['categories_for_main_page'] = [];
        $data['title'] = 'Личная страница Salomat.tj';
        $data['auth'] =   $this->input->cookie('auth_id');
        $this->load->library('session');
        $user = $this->getUser($this->session->userdata('user_id'));
        $data['name'] =  $user['name'] ?? null;
        $data['phone'] =  $user['login'] ?? null;
        $data['birth_date'] =  $user['birth_date'] ?? null;
        $data['gender'] =  $user['gender'] ?? null;
        $data['address'] =  $user['address'] ?? null;
        $data['email'] =  $user['email'] ?? null;
        $data['image'] =  $user['image'] ?? null;

        $this->db->select('*');
        $this->db->from('user_order');
        $this->db->order_by("order_id", "desc");
        $this->db->where('user_id', $this->session->userdata('user_id'));
        $this->db->join('order', 'user_order.order_id = order.id');
        $query = $this->db->get();
        $order = $query->result();
        foreach ($order as $item) {
            $this->db->select('*');
            $this->db->from('product_order');
            $this->db->where('order_id', $item->id);
            $this->db->join('product', 'product_order.product_id = product.id');
            $this->db->order_by('order_id ASC');
            $product = $this->db->get();
            if ($product) {
                $this->db->select('delivery_price');
                $this->db->from('delivery');
                $this->db->where('delivery_id', $item->delivery_type);
                $delivery = $this->db->get();
            }
            if ($product) {
                $this->db->select('status_text');
                $this->db->from('status');
                $this->db->where('id', $item->status_id);
                $status = $this->db->get();
            }
            $order_product[] = [
                'order' => $item,
                'status' => $status->result(),
                'delivery' => $delivery->result(),
                'products' => $product->result()
            ];
        }

        $data['orders'] = $order_product ?? null;
        $data['favorites'] = $this->user_favorite($this->session->userdata('user_id'));
        $data['content'] = $this->parser->parse('user_info', $data, TRUE);
        $data['header'] = $this->parser->parse('parts/header', $data, TRUE);
        $data['footer'] = $this->parser->parse('parts/footer', $data, TRUE);

        $this->parser->parse('template', $data);
    }

    public function get_srch_results()
    {
        $data['base_url'] = base_url();
        $res = $this->product->search_for_prod(
            $this->input->get("srch_pr_inp"),
            $this->input->get("min_price"),
            $this->input->get("max_price"),
            $user_id = $this->session->userdata('user_id')
        );
        unset($res['srch_prod_max_pr']);
        // print_r($res);

        $data['search_result'] = $res;
        echo json_encode(array(
            'html' => $this->parser->parse("products_search_result_list", $data, TRUE),
        ));
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

    public function search_product()
    {
        if ($this->input->get("q")) {
            $string = $this->replaceStr($this->input->get("q"));
            $res = $this->product->get_prod_by_name_main($string);

            echo json_encode($res);
        }
    }

    public function get_product_by_category_list()
    {
        if ($this->input->get("cat_id") && $this->input->get("page") && $this->input->get("sort")) {
            if ($this->input->get("min_price") == "" && $this->input->get("max_price") == "") {
                $res = $this->product->get_products_by_category($this->input->get("cat_id"), $this->input->get("sort"), $this->input->get("page"));
            } else {
                $res = $this->product
                    ->get_products_by_category(
                        $this->input->get("cat_id"),
                        $this->input->get("sort"),
                        $this->input->get("page"),
                        $this->input->get("min_price"),
                        $this->input->get("max_price")
                    );
            }
            $data['base_url'] = base_url();
            $cat = $this->category->get_parent_categories($this->input->get("cat_id"));
            $data['category_id'] = $this->input->get("cat_id");
            if ($cat['parent_cat']['parent_id'] != 0) {
                $data['category_id'] = $cat["id"];
            }
            $data['total_products'] = $res['total_products'];
            unset($res['total_products']);
            $data['category_products'] = $res;

            echo json_encode(array(
                'html' => $this->parser->parse("products_by_category_list", $data, TRUE),
                'total_prods' => $data['total_products'],
            ));
        }
    }

    public function get_blog_list_by_tag()
    {
        $page = $this->input->get("page");

        if ($page == '') {
            $page = 1;
        }

        $res = $this->blog->get_all_main(
            $page,
            $this->input->get("tag_id")
        );
        $data['base_url'] = base_url();
        $data['pages'] = $res['pages_info'];
        unset($res['pages_info']);
        $data['blog_list_items'] = $res;
        echo json_encode(array(
            'html' => $this->parser->parse("blog_list_items", $data, TRUE),
            'bbbbb' => $res
        ));
    }

    public function cartConfirm($id)
    {
        $this->load->model('order');
        $data = array('base_url' => base_url(), 'alert' => '');
        $data['order_id'] = $id;
        $post = $this->input->post();
        if (sizeof($post) != 0) {
            $data['order_phone'] = $post['order_phone'];
            $data['order_code'] = $post['order_code'];
        }
        $data['categories'] = $this->category->get_all();
        echo json_encode($data);
    }

    public function userOrderReceipt($hash = '')
    {
        if ($hash == '') {
            redirect('errors/cli/error_404', TRUE);
            return;
        }
        $data = array('base_url' => base_url(), 'alert' => '');
        $this->load->model('order');
        $answer = $this->order->get_order_prods_by_hash($hash);
        $data['order_date'] = '';
        if (isset($answer['order_date'])) {
            $data['delivery_info'] = $answer["delivery_info"];
            unset($answer["delivery_info"]);
        }
        if (isset($answer['order_date'])) {
            $date = new DateTime($answer['order_date']);
            $new_date = date_format($date, 'd.m.Y');
            $data['order_date'] = $new_date;
            unset($answer['order_date']);
        }
        $tot_sum = 0;
        $data['order_id'] = '';
        if (sizeof($answer) != 0) {
            $data['order_id'] = $answer[0]['order_id'];
            foreach ($answer as $item) {
                $tot_sum += ($item['total_count'] * $item['product_price']);
            }
            $tot_sum += $data["delivery_info"]["delivery_price"];
        } else {
            $data['not_found'] = true;
        }
        $data['total_sum'] = $tot_sum;
        $data['products'] = $answer;
        $data['categories'] = $this->category->get_all();
        $data['title'] = "Чек | Саломат-Аптека";


        $data['content'] = $this->parser->parse('user_order_receipt', $data, TRUE);
        $data['header'] = $this->parser->parse('parts/header', $data, TRUE);
        $data['footer'] = $this->parser->parse('parts/footer', $data, TRUE);
        $this->parser->parse('template', $data);
    }

    public function orderResendSms()
    {
        $this->load->model('order');
        if (
            $this->input->post("order_phone")
        ) {
            $array = $this->input->post();
            $rand_num = rand(1000, 9999);
            $array['order_code'] = $rand_num;
            $id = $array['order_id'];
            $sms_id = $this->sms->add(array('sms_mobile' => $array["order_phone"], 'sms_text' => $rand_num));
            $sms_resp = $this->create_url_f55($array["order_phone"], $rand_num, $sms_id);
            $this->update_sms($sms_id, $sms_resp, $id, 'order');
            $this->order->update_order_code($id, $rand_num);
            echo json_encode(1);
        } else {
            echo json_encode(-1);
        }
    }

    public function page($id)
    {
        $data = array('base_url' => base_url(), 'alert' => '');
        $this->load->model('page');

        $data['categories'] = $this->category->get_all();
        $page_info = $this->page->get($id);
        $data['page_title'] = $page_info['name'];
        $data['title'] = '';
        $data['text'] = '';
        if (sizeof($page_info) != 0) {
            $data['title'] = $page_info['name'];
            $data['text'] = $page_info['about'];
        }
        $data['content'] = $this->parser->parse('page', $data, TRUE);
        $data['auth'] =   $this->input->cookie('auth_id');
        $this->load->library('session');
        $user = $this->getUser($this->session->userdata('user_id'));
        $data['name'] =  $user['name'] ?? null;
        $data['image'] =  $user['image'] ?? null;
        $data['email'] =  $user['email'] ?? null;;
        $data['header'] = $this->parser->parse('parts/header', $data, TRUE);
        $data['footer'] = $this->parser->parse('parts/footer', $data, TRUE);
        $this->parser->parse('template', $data);
    }


    public function web_view($id)
    {
        $data = array('base_url' => base_url(), 'alert' => '');
        $this->load->model('page');

        $data['categories'] = $this->category->get_all();
        $page_info = $this->page->get($id);
        $data['page_title'] = $page_info['name'];
        $data['title'] = '';
        $data['text'] = '';
        if (sizeof($page_info) != 0) {
            $data['title'] = $page_info['name'];
            $data['text'] = $page_info['about'];
        }
        $data['content'] = $this->parser->parse('page', $data, TRUE);
        $data['auth'] =   $this->input->cookie('auth_id');
        $this->load->library('session');
        $user = $this->getUser($this->session->userdata('user_id'));
        $data['name'] =  $user['name'] ?? null;
        $data['image'] =  $user['image'] ?? null;
        $data['email'] =  $user['email'] ?? null;;
        $data['header'] = $this->parser->parse('parts/header', $data, TRUE);
        $data['footer'] = $this->parser->parse('parts/footer', $data, TRUE);

        $this->parser->parse('web_view', $data);
    }

    public function recipe()
    {
        $data = array('base_url' => base_url(), 'alert' => '');
        $this->load->model('order');
        $data['categories'] = $this->category->get_all();
        $data['title'] = 'Отправить рецепт | Саломат-Аптека';
        $data['auth'] =   $this->input->cookie('auth_id');
        $this->load->library('session');
        $user = $this->getUser($this->session->userdata('user_id'));
        $data['name'] =  $user['name'] ?? null;
        $data['image'] =  $user['image'] ?? null;
        $data['email'] =  $user['email'] ?? null;

        $data['content'] = $this->parser->parse('recipe', $data, TRUE);
        $data['header'] = $this->parser->parse('parts/header', $data, TRUE);
        $data['footer'] = $this->parser->parse('parts/footer', $data, TRUE);
        $this->parser->parse('template', $data);
    }

    public function recipeSendSms()
    {
        $this->load->model('recipe');
        $this->load->model('sms');
        if (
            $this->input->post("recipe_phone")
            && $this->input->post("recipe_pics")
        ) {
            $array = $this->input->post();
            $rand_num = rand(1000, 9999);
            $array['recipe_code'] = $rand_num;
            $answer = $this->recipe->add_recipe($array);

            $sms_id = $this->sms->add(array('sms_mobile' => $array["recipe_phone"], 'sms_text' => $rand_num));
            $sms_resp = $this->create_url_f55($array["recipe_phone"], $rand_num, $sms_id);

            if ($answer['stat'] == 1) {
                $this->update_sms($sms_id, $sms_resp, $answer['recipe_id'], 'recipe');
                foreach ($array['recipe_pics'] as $recipe_pic) {
                    $newName = $recipe_pic['uid'] . '' . $recipe_pic['name'];
                    $this->recipe->add_recipe_pic($answer['recipe_id'], $newName);
                }
                echo json_encode(array('stat' => 1, 'recipe_id' => $answer['recipe_id'], 'ret' => $sms_resp));
            } else {
                echo json_encode(-1);
            }
        } else {
            echo json_encode(-1);
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

    public function recipeResendSms()
    {
        $this->load->model('recipe');
        if (
            $this->input->post("recipe_phone")
        ) {
            $array = $this->input->post();
            $rand_num = rand(1000, 9999);
            $array['recipe_code'] = $rand_num;
            $id = $array['recipe_id'];
            $sms_id = $this->sms->add(array('sms_mobile' => $array["recipe_phone"], 'sms_text' => $rand_num));
            $sms_resp = $this->create_url_f55($array["recipe_phone"], $rand_num, $sms_id);
            $this->update_sms($sms_id, $sms_resp, $id, 'recipe');
            echo json_encode(array('stat' => 1));
        } else {
            echo json_encode(-1);
        }
    }

    public function confirmRecipeCode()
    {
        $this->load->model('recipe');
        if (
            $this->input->post("recipe_phone_code")
        ) {
            $array = $this->input->post();
            $answer = $this->recipe->check_recipe_phone_code($array);
            if ($answer == 1) {
                echo json_encode(1);
            } else {
                echo json_encode(-1);
            }
        } else {
            echo json_encode(-1);
        }
    }

    private function createAlert($text)
    {
        return $this->parser->parse('alert', array('alertText' => $text), true);
    }

    public function to_exit()
    {
        delete_cookie("auth_id");
        redirect(base_url('/index.php/main/'), 'refresh');
        die();
    }

    public function confirmOrder()
    {
        $this->load->model('order');
        $this->load->model('product');
        if (
            $this->input->post("name")
            && $this->input->post("phone_number")
            && $this->input->post("address")
            && $this->input->post("products")
        ) {
            $array = $this->input->post();
            if (!is_numeric($array["delivery_id"])) {
                $array["delivery_id"] = 1;
            }
            $rand_num = rand(1000, 9999);
            $array['code'] = $rand_num;
            $answer = $this->order->add($array);
            $this->load->library('session');
            $user = $this->getUser($this->session->userdata('user_id'));

            $this->order->save_user_order_status_change($user['user_id'], $answer['order_id'], 1, 1, $this->input->post("comment"));

            $sms_id = $this->sms->add(array('sms_mobile' => $array["phone_number"], 'sms_text' => $rand_num));
            $sms_resp = $this->create_url_f55($array["phone_number"], $rand_num, $sms_id);

            if ($answer['stat'] == 1) {
                $this->update_sms($sms_id, $sms_resp, $answer['order_id'], 'order');
                $array2 = array('answ' => 1, 'order_id' => $answer['order_id'], 'order_code' => $rand_num);
                echo json_encode($array2);
            } else {
                echo json_encode(array('answ' => -1));
            }
        } else {
            echo json_encode(array('answ' => -1));
        }
    }

    public function checkOrderCode()
    {
        $this->load->model('order');
        $this->load->model('sms');
        $obj = $this->input->get();
        $answer = $this->order->check_order($obj['order_id'], $obj['order_phone'], $obj['order_code']);
        if ($answer == 0) {
            echo json_encode(0);
        } else {
            $this->order->change_status($obj['order_id'], 1);
            $order = $this->order->get($obj['order_id']);

            //sendTelegram
            $text = "Пришел заказ #" . $obj['order_id'] . ' номер: ' . $obj['order_phone'] . ' https://salomat.tj/index.php/Admin/orderProducts/' . $obj['order_id'];
            $this->sendTelegramText($text);

            $sms_id = $this->sms->add(array('sms_mobile' => $obj['order_phone'], 'sms_text' => 'По данной ссылке вы можете проверить ваш заказ: ' . base_url() . 'index.php/main/userOrderReceipt/' . $order['hash']));
            $sms_resp = $this->create_url_f55($obj['order_phone'], 'По данной ссылке вы можете проверить ваш заказ: ' . base_url() . 'index.php/main/userOrderReceipt/' . $order['hash'], $sms_id);

            $this->update_sms($sms_id, $sms_resp, $obj['order_id'], 'order');

            $order_prods = $this->order->get_order_prods($obj['order_id']);
            $array = array('stat' => 1, 'order' => $order, 'products' => $order_prods);
            echo json_encode($array);
        }
    }

    private function sendTelegramText($text)
    {
        $text = urlencode($text);

        $arrContextOptions = array(
            "ssl" => array(
                "verify_peer" => false,
                "verify_peer_name" => false,
            ),
        );

        file_get_contents("https://salomat.tj/bot/tsend.php?text=" . $text, false, stream_context_create($arrContextOptions));
    }

    public function startTransMyBabilon()
    {
        $this->load->model("order");
        if ($this->input->post("products")) {
            $array = $this->input->post();
            $array['code'] = null;
            if (!is_numeric($array["delivery_id"])) {
                $array["delivery_id"] = 1;
            }
            $res = $this->order->add($array);
            $user = $this->getUser($this->session->userdata('user_id'));
            $this->order->save_user_order_status_change($user['user_id'], $res['order_id'], 1, 1, $this->input->post("comment"));
            $delivery_info = $this->delivery->get($array["delivery_id"]);
            $order_id = null;
            if ($res["stat"] == 1) {
                $order_id = $res["order_id"];
            }
            $sum = 0;
            $goods = [];
            $url = "https://my1.babilon-m.tj/qrapi/MarketPlace/CreateTxn.aspx";
            foreach ($array["products"] as $item) {
                $innerSum = 0;
                $innerSum +=  (floatval($item['product_count']) * floatval($item['product_price']));
                $goods[] = array(
                    "Name" => $item["product_name"],
                    "Count" => $item["product_count"],
                    "Sum" => $innerSum,
                    "VendorCode" => $item['prod_articule']
                );
                $innerSum = 0;
                $sum +=  (floatval($item['product_count']) * floatval($item['product_price']));
            }
            if (is_numeric($delivery_info["delivery_price"])) {
                intval($delivery_info["delivery_price"]);
            }
            $goods[] = array(
                "Name" => $delivery_info["delivery_name"],
                "Count" => 1,
                "Sum" => $delivery_info["delivery_price"],
                "VendorCode" => null
            );
            $sum += $delivery_info["delivery_price"];
            $marketPlaceHash = hash('sha1', $this->marketPlaceId . $this->marketPlaceToken . $sum . $order_id . $this->deliveryB);
            $merchantHash = hash('sha1', $this->acquirerId . $this->merchantId . $this->merchantToken . $sum . $order_id);
            $detailsArr[] = array(
                "Sign" => $merchantHash,
                "AcquirerId" =>  $this->acquirerId,
                "Merchantid" =>  $this->merchantId,
                "Sum" =>  $sum,
                "ReceiptId" =>  $order_id,
                "Goods" => $goods
            );
            $arr = array(
                "Sign" =>  $marketPlaceHash,
                "MarketPlaceId" => $this->marketPlaceId,
                "Sum" => $sum,
                "ReceiptId" => $order_id,
                "Delivery" => $this->deliveryB,
                "Details" => $detailsArr
            );
            $result = json_decode($this->postCURL($url, $arr));
            if ($result->result == 0) {
                $this->order->update_transaction_id($order_id, $result->TransactionId);
            }
            $returnArr = array('answ' => 1, 'info' => $result);
            if (isset($_COOKIE[$this->bUserInfoName])) {
                unset($_COOKIE[$this->bUserInfoName]);
                setcookie($this->bUserInfoName, null, -1, '/');
            }
            echo json_encode($returnArr);
        }
    }

    public function marketPlaceWebHook()
    {
        $this->load->model("order");
        $returnedArray = json_decode(file_get_contents('php://input'), false);
        print_r($returnedArray);
        if ($returnedArray->result == 3) {

            $date = new DateTime($returnedArray->PaidDate);
            $new_date = date_format($date, 'Y-m-d H:i:s');
            $array = array(
                "phone_number" => $returnedArray->ReceiverNumber,
                "full_name" => $returnedArray->CustomerName,
                "address" => $returnedArray->CustomerAddress,
                "comment" => $returnedArray->CustomerComment . " Ps. Номер покупателя:" . $returnedArray->CustomerNumber,
                "status_id" => 1,
                "paid_date" => $new_date,
            );
            $this->order->update($returnedArray->ReceiptId, $array);
        }
        return json_encode(array("result" => 1));
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
    // private function create_url_f55($to, $sms, $source)
    // {
    //     $login = 'alfatj@sms.tj';

    //     $to = '992' . $to;
    //     $sald = "c1903d62-c398-4371-aeac-5b18f2187a4b";
    //     $hh = md5($sald . $login . $to);

    //     if ($source == "hellotj")
    //         $source = "HELLO.TJ";
    //     else if ($source == "alfatj")
    //         $source = 'ALFA.TJ';
    //     else if ($source == "betatj")
    //         $source = "BETA.TJ";

    //     $url = 'https://sms.55soft.net/api/sendsms?user=' . $login . '&phone=' . $to . '&msg=' . urlencode($sms) . '&token=' . $hh . '&alpha_name=' . $source;
    //     $data = file_get_contents($url);
    //     return $data;
    // }

    public function user_favorite($user_id)
    {

        $this->db->select('product.*');
        $this->db->from('product');
        $this->db->join('favorites', 'product.id = favorites.favoriteable_id');
        $this->db->where('favorites.user_id', $user_id);
        $query = $this->db->get();
        $array = $query->result_array();
        $array = [];
        foreach ($query->result_array() as $row) {
            $rating = $this->get_rating($row['id']);
            if (sizeof($rating) != 0) {
                $row['prod_rating_average'] = $rating['prod_rating_average'];
                $row['review_count'] = $rating['review_count'];
            } else {
                $row['prod_rating_average'] = '';
                $row['review_count'] = 0;
            }
            //
            //            $favorite = $this->get_favorite($row['id'],$user_id?:0);
            //            if (sizeof($favorite) != 0) {
            //                $row['is_favorite'] = true;
            //            } else {
            //                $row['is_favorite'] = false;
            //            }
            $row['base_url'] = base_url();

            $array[] = $row;
        };
        //var_dump($array);
        return $array;
    }

    public function get_rating($id)
    {
        $array = array();
        $q_count = $this->db->query("SELECT COUNT(*) as count FROM `product_rating` WHERE `prod_id` = " . $id . " AND `status` = 1");
        $arr_count = $q_count->result_array();
        if ($arr_count[0]['count'] != 0) {
            $this->db->select('*');
            $this->db->from('product_rating');
            $this->db->where('prod_id', $id);
            $this->db->where('status', '1');
            $query = $this->db->get();
            $count = 0;
            $ones = 0;
            $twos = 0;
            $threes = 0;
            $fours = 0;
            $fives = 0;
            foreach ($query->result_array() as $pr) {
                $count += $pr['star_rating'];
                if ($pr['star_rating'] == 1) {
                    $ones += 1;
                } else if ($pr['star_rating'] == 2) {
                    $twos += 1;
                } else if ($pr['star_rating'] == 3) {
                    $threes += 1;
                } else if ($pr['star_rating'] == 4) {
                    $fours += 1;
                } else if ($pr['star_rating'] == 5) {
                    $fives += 1;
                }
            }
            $rating = round($count / $arr_count[0]['count']);
            $array['prod_rating_average'] = $rating;

            $array['prod_rating_each']['ones']['count'] = $ones;
            $array['prod_rating_each']['ones']['percentage'] = round(($ones / $arr_count[0]['count']) * 100);

            $array['prod_rating_each']['twos']['count'] = $twos;
            $array['prod_rating_each']['twos']['percentage'] = round(($twos / $arr_count[0]['count']) * 100);

            $array['prod_rating_each']['threes']['count'] = $threes;
            $array['prod_rating_each']['threes']['percentage'] = round(($threes / $arr_count[0]['count']) * 100);

            $array['prod_rating_each']['fours']['count'] = $fours;
            $array['prod_rating_each']['fours']['percentage'] = round(($fours / $arr_count[0]['count']) * 100);

            $array['prod_rating_each']['fives']['count'] = $fives;
            $array['prod_rating_each']['fives']['percentage'] = round(($fives / $arr_count[0]['count']) * 100);

            $array['review_count'] = $arr_count[0]['count'];
        }

        return $array;
    }

    public function get_favorite($id)
    {
        $array = array();
        $q_count = $this->db->query("SELECT COUNT(*) as count FROM `favorites` WHERE `favoriteable_id` = " . $id . " AND `user_id` = 61");
        $arr_count = $q_count->result_array();
        if ($arr_count[0]['count'] != 0) {
            $this->db->select('*');
            $this->db->from('favorites');
            $this->db->where('favoriteable_id', $id);
            $this->db->where('user_id', '61');
            $query = $this->db->get();
            $array['is_favorite'] = $query->result_array();
        }
        return $array;
    }

    public function createOrder()
    {
        $this->load->model("order");
        if ($this->input->post("products")) {
            $array = $this->input->post();
            $array['code'] = null;
            if (!is_numeric($array["delivery_id"])) {
                $array["delivery_id"] = 1;
            }
            $res = $this->order->add($array);
            $user = $this->getUser($this->session->userdata('user_id'));
            $this->order->save_user_order_status_change($user['user_id'], $res['order_id'], 1, 1, $this->input->post("comment"));

            echo $res['order_id'];
        }
    }

    /**
     * List PromoCode
     *
     * @return void
     */
    public function promo()
    {
        $this->load->model("PromoCode");

        if ($this->input->get("promo_code")) {

            $data = $this->PromoCode->get_promo_code($this->input->get("promo_code"));

            echo json_encode($data[0]);
        } else {
            return false;
        }
    }
}
