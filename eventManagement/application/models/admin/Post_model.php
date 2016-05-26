<?php
  class Post_model extends CI_Model{
    public $id;
    public $user_id;
    public $other_user_id;
    public $title;
    public $message;

    public function insert($post){
      $this->db->insert('post',$post);
    }

    public function get_message($id,$page,$num_per_page){
      $offset = ($page-1) * $num_per_page;
      $sql = "select u.name as u_name , title, message, p.created from users as u
        inner join post as p on u.id = p.users_id
        inner join users as o on o.id = p.other_user_id where o.id = ? ORDER BY created DESC LIMIT ? , ? ";
      $query = $this->db->query($sql, array($id,$page,$num_per_page));
      return $query->result('Post_model');
    }

    public function get_count()
    {
      $query = $this->db->query('SELECT * FROM post');
      return $query->num_rows();
    }
  }
