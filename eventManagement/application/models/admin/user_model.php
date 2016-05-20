<?php
class User_model extends CI_Model{

  public function find_UserGroupIdEqualGroupsid(){
    $query = $this->db->query('SELECT users.name as uname,users.id,groups.name as name FROM users inner join  groups on users.group_id = groups.id');
    return $query->result('User_model');
  }

  public function insert($user){
    $this->db->insert('$user', $user);
  }

}
 ?>
