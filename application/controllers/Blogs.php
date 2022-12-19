<?php defined('BASEPATH') OR exit('No direct script access allowed');

use Restserver\Libraries\REST_Controller;

require APPPATH. 'libraries/REST_Controller.php';

class Blogs extends REST_Controller {

    /**
     * Construction
     */
    public function __construct()
    {
        parent::__construct();

        $this->load->model('tag');
        $this->load->model('blog');
        $this->load->library('session');
        $this->load->library('form_validation');
        $this->load->database();
    }

    /**
     * Get blog by id.
     *
    */
    public function blog_get()
    {
        $id = $this->input->get('blog_id');
        $blog = $this->blog->get($id);
        $data['blog'] = $blog;
        if (sizeof($blog) == '') {
            $this->response($data,REST_Controller::HTTP_NO_CONTENT);
            return;
        }
        $data['tags'] = $this->blog->get_blog_tags($id);
        $this->response($data,REST_Controller::HTTP_OK);
    }

    /**
     * Get blog by tag
     *
     */
    public function blog_tag_post()
    {
        $tag_id = $this->input->post('tag_id');
        $ttth= json_encode($tag_id);

        $page = $this->input->post('page');


            $blog = $this->blog->get_with_tag($page ,$ttth);

        $data['blogs'] = $blog;
        if (sizeof($blog) == '') {
            $this->response($data,REST_Controller::HTTP_NO_CONTENT);
            return;
        }
        $this->response($data,REST_Controller::HTTP_OK);
    }

    /**
     * Popular blogList.
     *
     */
    public function blog_popular_get()
    {
        $data = array('base_url' => base_url());
        $data['tags'] = $this->tag->get_all();
        $data['title'] = 'Полулярное';
        $data['content'] = $this->blog->get_all_mb($this->input->get('page'));

        $this->response($data,REST_Controller::HTTP_OK);
    }
    
    /**
     * Popular blogList.
     *
     */
    public function main_blog_get()
    {
        $data = array('base_url' => base_url());
        $data['tags'] = $this->tag->get_all();
        $data['title'] = 'Полулярное';
        $data['content'] = $this->blog->get_all();

        $this->response($data,REST_Controller::HTTP_OK);
    }
}
