<?php
  class Event_model extends CI_Model{

    public $id;
    public $title;
    public $start;
    public $end;
    public $place;
    public $detail;
    public $group_id;
    public $created;
    public $registered_by;

    public function find_all($page,$num_per_page){
      $offset = ($page - 1) * $num_per_page;

      $sql =
        "SELECT * FROM `events` inner join `groups` on events.group_id = groups.id LIMIT ?,?";

      $query = $this->db->query($sql,array($offset,$num_per_page));
      return $query->result("Event_model");
    }

    public function today_event($page,$num_per_page){
      $offset = ($page - 1) * $num_per_page;

      $sql =
        "SELECT * FROM `events` inner join `groups` on events.group_id = groups.id where start = NOW() LIMIT ?,?";
      $query = $this->db->query($sql,array($offset,$num_per_page));
      return $query->result("Event_model");
    }

    public function get_count(){
		    return $this->db->count_all('events');
	 }

   public function today_get_count(){
     $this->db->where('start','NOW()');
     $this->db->from('events');
     return $this->db->count_all_results();
   }

  }
?>
