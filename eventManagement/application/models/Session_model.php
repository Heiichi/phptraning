<?php
class Session_model extends CI_Model{

	public function getUsers($id,$pass){
		$where=array('login_id'=>$id,'login_pass'=>$pass);
		$query=$this->db->get_where('users', $where);
		return $query->result("Session_model");
	}
}

