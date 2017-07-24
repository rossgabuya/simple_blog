<?php
class Pages extends CI_Controller {
		public function __construct(){
            parent::__construct();
            $this->load->model('blog_model');
            
        }

        public function view($page = 'home'){
	        	if ( ! file_exists(APPPATH.'/views/pages/'.$page.'.php')){
	                // Whoops, we don't have a page for that!
	                show_404();
	        	}

	        $data['title'] = ucfirst($page); // Capitalize the first letter
	        $data['blog_categories'] = $this->blog_model->get_blog_categories();
	        $data['all_blog_posts'] = $this->blog_model->get_all_blog_posts();
	        $data['is_admin'] = false;


	        $this->load->view('templates/header', $data);
	        $this->load->view('pages/'.$page, $data);
	        if ($page == 'home') {
	        	$this->load->view('templates/sidebar', $data);
	        }
	        $this->load->view('templates/footer', $data);
        }

}