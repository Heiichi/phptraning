<?php
class Group_model extends CI_Model{
  public $id;
  public $name;

  public function find_all($page,$num_per_page){
    $offset = ($page - 1) * $num_per_page;

    $sql =
      "SELECT * FROM `groups` WHERE status = 1 LIMIT ?,?";

    $query = $this->db->query($sql,array($offset,$num_per_page));
    return $query->result("Group_model");
  }

  public function get_count(){
      return $this->db->count_all('groups');
 }

 public function insert($group){
   $this->db->insert('groups',$group);
 }
}
 ?>
