<?php
class Event_model extends CI_Model{


	//eventsテーブルからid指定で1件取得
	public function getrow($id){
		return $this->db->get_where('events', array('id' => $id))->row();
	}
	//groupsテーブルを全件取得
	public function getGroup(){
				$query=$this->db->query("SELECT * FROM groups");
				return $query->result("Event_model");
	}
	//eventsテーブルを編集
	public function update($update,$id){
		$this->db->where('id', $id);
		$this->db->update('events', $update);
	}
}