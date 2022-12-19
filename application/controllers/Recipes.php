<?php defined('BASEPATH') OR exit('No direct script access allowed');

use Restserver\Libraries\REST_Controller;

require APPPATH. 'libraries/REST_Controller.php';

class Recipes extends REST_Controller
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
        $this->load->model('recipe');
    }

    /**
     * Store recipe
     *
     * @return void
     */
    public function store_post()
    {
        $config['upload_path']          = './upload_recipe';
        $config['allowed_types']        = 'gif|jpg|png|jpeg';
        $config['max_size']             = 40011;
        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('recipe_pics')) {
            $error = array('error' => $this->upload->display_errors());
            $this->response($error, REST_Controller::HTTP_OK);

        } else {
            $data = array( $this->upload->data());
            $array = $this->input->post();
            $array['recipe_code'] = time();
            $array['status_id'] = 1;
            $recipe_pic = $this->input->post('recipe_pics');
            $answer = $this->recipe->add_recipe($array);
            if ($answer['stat'] == 1)
            {
                $newName = $data[0]['file_name'];
                $this->recipe->add_recipe_pic($answer['recipe_id'], $newName);
                $message = [
                    'status' => true,
                    'message' => 'Successful'
                ];
                $this->response($message, REST_Controller::HTTP_OK);

            } else {
                $message = [
                    'status' => false,
                ];
                $this->response($message, REST_Controller::HTTP_BAD_REQUEST);
            }
        }
    }
}