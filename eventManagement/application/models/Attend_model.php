<?php
  class Attend_model extends CI_Model{

    public $id;
    public  $users_id;
    public $events_id;

    public function insert($attend){
         $this->db->insert('attends',$attend);
    }

    public function delete($user_id,$id){
      $sql = "DELETE FROM attends WHERE users_id=? and events_id = ?";

      	$query = $this->db->query($sql,array($user_id,$id));
    }
}
?>
