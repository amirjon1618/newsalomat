<?php defined('BASEPATH') or exit('No direct script access allowed');

use Restserver\Libraries\REST_Controller;

require APPPATH . 'libraries/REST_Controller.php';

class Favorites extends REST_Controller
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
        $this->load->library('form_validation');
        $this->load->database();
    }

    /**
     * Favorites list.
     *
     * @return void
     */
    public function index_get()
    {
        $user_id = $this->input->get('user_id');

        if ($user_id) {
            $favorites = $this->favorite->get($user_id);

            $this->response($favorites, REST_Controller::HTTP_OK);
        } else {
            $message = [
                'status'    =>     false,
            ];
            $this->response($message, 400);
        }
    }

    /**
     * Add Favorite.
     *
     * @return mixed
     */
    public function index_post()
    {
        $user_id = $this->input->post('user_id');
        $favoriteable_id = $this->input->post('product_id');

        if ($user_id) {
            $now = date('Y-m-d H:i');
            $this->favorite->add(array('user_id' => $user_id, 'favoriteable_id' => $favoriteable_id, 'created_at' => $now, 'updated_at' => $now));

            $message = [
                'status'    => true,
                'message'   => "Добавлено в избранное"
            ];
            $this->response($message, REST_Controller::HTTP_OK);
        } else {
            $message = [
                'status'    =>     false,
            ];
            $this->response($message, 400);
        }
    }

    /**
     * Favorite destroy.
     *
     * @return mixed
     */
    public function delete_post()
    {
        $user_id = $this->input->post('user_id');
        $favoriteable_id = $this->input->post('product_id');
        if ($user_id) {
            $this->favorite->delete($user_id, $favoriteable_id);
            $message = [
                'status'    => true,
            ];
            $this->response($message, REST_Controller::HTTP_OK);
        } else {
            $message = [
                'status'    =>     false,
            ];
            $this->response($message, 400);
        }
    }
}
