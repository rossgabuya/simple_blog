<?php
class Blog_model extends CI_Model {

        public function __construct()
        {
                $this->load->database();
        }

        public function get_blog_categories($cat_slug = FALSE)
        {
                if ($cat_slug === FALSE)
                {
                        $this->db->select('*');
                        $this->db->from('categories');
                        $this->db->where(array('visible' => 1 ));
                        $query = $this->db->get();
                        
                        return $query->result_array();
                }
                $fields = array('categories.menu_name',
                                'categories.cat_slug',
                                'posts.post_name',
                                'posts.post_slug',
                                'posts.content',
                                'posts.created_at',
                                'posts.updated_at'
                                );

                $this->db->select($fields);
                $this->db->from('categories');
                $this->db->join('posts', 'posts.cat_id = categories.id');
                $this->db->where(array('cat_slug' => $cat_slug, 'categories.visible' => 1 ));

                $query = $this->db->get();
                return $query->result_array();
        }

        public function get_all_blog_posts($post_limit = 3){
                $fields = array('categories.menu_name',
                                'categories.cat_slug',
                                'posts.post_name',
                                'posts.post_slug',
                                'posts.content',
                                'posts.created_at',
                                'posts.updated_at'
                                );

                $this->db->select($fields);
                $this->db->from('categories');
                $this->db->join('posts', 'posts.cat_id = categories.id');
                $this->db->where(array('posts.visible' => 1 ));

                $this->db->limit($post_limit);
               
                $query = $this->db->get();
                return $query->result_array();
        }

        public function get_blog_post($cat_slug = FALSE,$post_slug = FALSE,$visible = FALSE){
                $fields = array('categories.menu_name',
                                'categories.cat_slug',
                                'posts.post_name',
                                'posts.post_slug',
                                'posts.content',
                                'posts.created_at',
                                'posts.updated_at'
                                );

                $this->db->select($fields);
                $this->db->from('categories');
                $this->db->join('posts', 'posts.cat_id = categories.id');
                $this->db->where(array('cat_slug' => $cat_slug ,'post_slug' => $post_slug));
                    
                
                $query = $this->db->get();
                return $query->result_array();
        }

        public function set_blog_post(){
            $this->load->helper('url');

            $slug = url_title($this->input->post('title'), 'dash', TRUE);

            $data = array(
                'title' => $this->input->post('title'),
                'slug' => $slug,
                'text' => $this->input->post('text')
            );

            return $this->db->insert('posts', $data);
        }
}