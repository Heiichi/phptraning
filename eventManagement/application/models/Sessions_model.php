<?php
class Sessions_model extends CI_Model{

	public function getUsers($id,$pass){
		$where=array('login_id'=>$id,'login_pass'=>$pass);
		$query=$this->db->get_where('users', $where);
		return $query->result("Sessions_model");
	}

	public function getUsers2($email,$pass){
		$where=array('email'=>$email,'login_pass'=>$pass);
		$query=$this->db->get_where('users', $where);
		return $query->result("Sessions_model");
	}

	public function canLogIn2(){
		$where = array('email'=>$this->input->post("email"),'login_pass'=>$this->input->post("login_pass"));
		$query=$this->db->get_where('users', $where);

		if($query->num_rows() == 1){	//ユーザーが存在した場合の処理
					return true;
				}else{					//ユーザーが存在しなかった場合の処理
					return false;
				}

		//return $query->result("Session_model");
	}

	public function canLogIn(){
		$where = array('login_id'=>$this->input->post("login_id"),'login_pass'=>$this->input->post("login_pass"));
		$query=$this->db->get_where('users', $where);

		if($query->num_rows() == 1){	//ユーザーが存在した場合の処理
					return true;
				}else{					//ユーザーが存在しなかった場合の処理
					return false;
				}
	}
}
