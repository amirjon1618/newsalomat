<?php defined('BASEPATH') OR exit('No direct script access allowed');

use Restserver\Libraries\REST_Controller;

require APPPATH. 'libraries/REST_Controller.php';

class Categories extends REST_Controller
{
    /**
     * Construction
     */
    public function __construct(){

        parent::__construct();
        $this->load->helper('security');
        $this->load->model('product');
        $this->load->library('form_validation');
        $this->load->database();
        $this->load->helper('cookie');
        $this->load->helper('url');
        $this->load->model('user');
        $this->load->model('category');
        $this->load->model('advertisement');
    }

    /**
     * Get product by category.
     *
     * @param $id
     * @return void
     */
    public function products_get($id)
    {
        $max_price = $this->input->get('max_price');
        $min_price = $this->input->get('min_price');
        $user_id = $this->input->get('user_id');

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
        $res = $this->product->get_products_by_category($id,  $sort_by,$current_page, $min_price, $max_price, $user_id); //returns products with total count > 0
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

        $data['categories_for_main_page'] = [];

        if (isset($res['prod_max_price'])) {
            $data['prod_max_price'] = $res['prod_max_price'];
        } else {
            $data['prod_max_price'] = 9999;
        }
        $data['title'] = $category_with_parents['category_name'] . ' на Salomat.tj';
        $data['category_products'] = $res;
        $data['isOnlySecondCategory'] = $res['isOnlySecondCategory'];

        $this->response($data, REST_Controller::HTTP_OK);
    }

    public function sliders_get($id)
    {
        $ad_slider = $this->advertisement->get_slider_by_category($id, 'slider');
        $data['sliders'] = $ad_slider;

        $this->response($data, REST_Controller::HTTP_OK);
    }
}