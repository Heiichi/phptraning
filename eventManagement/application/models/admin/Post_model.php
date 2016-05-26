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

    public function get_message($id,$group_id,$page,$num_per_page){

      $offset = ($page-1) * $num_per_page;
      $sql = "SELECT u.name as u_name ,title,message,p.created FROM users as u inner join post as p on u.id = p.users_id
        inner join users as o on o.id = p.other_user_id or o.group_id = p.group_id
         where o.id = ? OR o.id = ? AND o.group_id = ? ORDER BY created DESC LIMIT ? , ? ";
      $query = $this->db->query($sql, array($id,$id,$group_id,$offset,$num_per_page));
      return $query->result('Post_model');
    }

    public function get_count($id,$group_id)
    {
      $this->db->where('other_user_id',$id);
      $this->db->or_where('group_id', $group_id);
      $this->db->from('post');
      return $this->db->count_all_results();

    }
  }
