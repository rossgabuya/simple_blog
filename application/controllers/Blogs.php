<?php

class Blogs extends CI_Controller {
                public function __construct(){
                        parent::__construct();
                        $this->load->model('blog_model');
                }

                 public function index(){
                        
                        $data['all_blog_posts'] = $this->blog_model-> get_all_blog_posts(10);
                        $data['title'] = 'Blog Posts';
                        $data['curr_url'] = $data['title'];
                        $data['is_admin'] = false;

                        $this->load->view('templates/header', $data);
                        $this->load->view('blogs/index', $data);
                        $this->load->view('templates/footer');
                }

                public function view($cat_slug = NULL){
                        $data['curr_url'] = $this->uri->ruri_to_assoc(3);
                        $data['is_admin'] = false;
                        $data['blog_categories'] = $this->blog_model->get_blog_categories();

                            $data['blog_posts'] = $this->blog_model->get_blog_categories($cat_slug);
                            if (empty($data['blog_posts'])){
                                show_404();

                            }
                            foreach ($data['blog_posts'] as $data_fields) {
                                    $data['title'] = $data_fields['menu_name'];
                                    $data['menu_name'] = $data_fields['menu_name'];
                                    $data['cat_slug'] = $data_fields['cat_slug'];
                            }

                            $this->load->view('templates/header', $data);
                            $this->load->view('blogs/view', $data);
                            $this->load->view('templates/sidebar');
                            $this->load->view('templates/footer');
                        
                }

                public function post($cat_slug = NULL,$post_slug = NULL){
                    $data['curr_url'] = $this->uri->ruri_to_assoc(3);
                    $data['blog_categories'] = $this->blog_model->get_blog_categories();
                    $data['is_admin'] = false;

                         $data['blog_post_contents'] = $this->blog_model->get_blog_post($cat_slug,$post_slug);
                            if (empty($data['blog_post_contents'])){
                                show_404();
                            }
                            foreach ($data['blog_post_contents'] as $data_fields) {
                                    $data['title'] = $data_fields['menu_name'];
                                    $data['menu_name'] = $data_fields['menu_name'];
                                    $data['cat_slug'] = $data_fields['cat_slug'];
                            }

                            $this->load->view('templates/header', $data);
                            $this->load->view('blogs/post', $data);
                            $this->load->view('templates/sidebar');
                            $this->load->view('templates/footer');
                }
}

?>