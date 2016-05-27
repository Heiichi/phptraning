<?php
class User_model extends CI_Model{

  public function find_all($id){
    $sql = "SELECT * FROM users  WHERE NOT id = ?";
    $query = $this->db->query($sql, array($id));
    return $query->result('User_model');
  }

  public function find_UserGroupIdEqualGroupsid(){
    $query = $this->db->query('SELECT users.name as uname,users.id,groups.name as name FROM users inner join groups on users.group_id = groups.id' );
    return $query->result('User_model');
  }

  public function get_count()
  {
    $query = $this->db->query('SELECT * FROM users');
    return $query->num_rows();
  }

  public function total_count(){
    return $this->db->count_all('users');
  }

  public function find_by_page($page,$num_per_page){
    $offset = ($page-1) * $num_per_page;
    $sql = "SELECT users.name as uname,users.id,groups.name as name FROM users inner join  groups on users.group_id = groups.id order by id desc LIMIT ?,?";
    $query = $this->db->query($sql, array($offset, $num_per_page));
    return $query->result('User_model');
  }


  // グループを全件取得
  public function findAllGroups(){
    $query = $this->db->query('SELECT * from groups');
    return $query->result('User_model');
    $test = $query->result('User_model');
  }

  public function insert($user){
    $this->db->insert('users', $user);
  }

  public function find_by_id($id)
  {

    // var_dump($this->db->get_where('users', array("id" => intval($id))));

    return $this->db->get_where('users', array('id' => $id))->row();
  }

  public function update($user,$id)
  {
    //$this->db->where('id', $user->id);
    $this->db->where('id', $id);
    $this->db->update('users', $user);
  }

  public function banned($user,$id)
  {
    $this->db->where('id',$id);
    $this->db->update('users',$user);
  }

  public function reborn($user,$id)
  {
    $this->db->where('id',$id);
    $this->db->update('users',$user);
  }

  public function delete($id){
    $this->db->delete('users', array('id' => $id));
  }


}
 ?>
