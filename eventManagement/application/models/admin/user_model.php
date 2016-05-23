<?php
class User_model extends CI_Model{

  public function find_UserGroupIdEqualGroupsid(){
    $query = $this->db->query('SELECT users.name as uname,users.id,groups.name as name FROM users inner join  groups on users.group_id = groups.id');
    return $query->result('User_model');
  }


  // グループを全件取得
  public function findAllGroups(){
    $query = $this->db->query('SELECT * from groups');
    return $query->result('User_model');
    $test = $query->result('User_model');
    var_dump($test);
  }

  public function insert($user){
    $this->db->insert('users', $user);
  }

}
 ?>
