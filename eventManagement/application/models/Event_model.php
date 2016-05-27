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
        "SELECT e.id , title,place,start,end,g.name,registered_by FROM `events` as e

          inner join `groups` as g on e.group_id = g.id where e.status = 1 ORDER BY start, end LIMIT ?,?";
      $query = $this->db->query($sql,array($offset,$num_per_page));
      return $query->result("Event_model");
    }

    public function today_event($page,$num_per_page){
      $offset = ($page - 1) * $num_per_page;
      $today = date('Y-m-d');
      $sql =
        "SELECT e.id,title,start,end,place,g.name,registered_by FROM `events` as e inner join `groups` as g  on e.group_id = g.id where start like '%".$today."%' LIMIT ?,?";
      $query = $this->db->query($sql,array($offset,$num_per_page));
      return $query->result("Event_model");

    }

    public function get_count(){

      $this->db->where('status',1);
      $this->db->from('events');
      return $this->db->count_all_results();
   }

   public function today_get_count(){
     $today = date('Y-m-d');
     $this->db->like('start',$today);
     $this->db->from('events');
     return $this->db->count_all_results();
   }

  public function show_find($id){
    $sql =
      "select title, start, end, place, g.name as g_name ,
      detail, u.name as u_name, e.group_id,e.id ,registered_by from events as e
      inner join groups as g on e.group_id = g.id
      inner join users as u ON e.registered_by = u.id
       where e.id =?";

    $query = $this->db->query($sql,array($id));
    return $query->result('Event_model');
  }
  public function get_attends($id){
    $sql =
    "select name from events as e inner join attends as a ON e.id = a.events_id
    inner join users as u on a.users_id = u.id where e.id = ?";
    $query = $this->db->query($sql,array($id));
    return $query->result('Event_model');
  }

  public function get_groups()
  {
    $query = $this->db->query('SELECT id , name FROM `groups` WHERE status = 1');
    return $query->result('Event_model');
  }

  public function insert($event)
  {
    $this->db->insert('events',$event);
  }

  //eventsテーブルからid指定で1件取得
  public function getrow($id){
    return $this->db->get_where('events', array('id' => $id))->row();
  }

  //eventsテーブルを編集
  public function update($update,$id){
    $this->db->where('id', $id);
    $this->db->update('events', $update);
  }

  public function delete($id){
    $sql = "UPDATE events SET status = 0 WHERE id=?";

 		$query = $this->db->query($sql,array($id));
  }


  public function registered_by($id,$user_name){
    $sql =
    "select u.name from users as u inner join events as e on e.registered_by = u.id where e.id = ? and u.name = ? ";

    $query = $this->db->query($sql,array($id,$user_name));
    return $query->result('Event_model');
      //  return $query = $this->db->simple_query($sql,array($id,$user_name));
  }

  public function user_attend($user_id,$id){
    $sql = "
      select events_id from attends as a
        inner join users as u on a.users_id = u.id
        inner join events as e on a.events_id = e.id
        where u.id = ? and a.events_id = ?";
  	$query = $this->db->query($sql,array($user_id,$id));
    return $query->result('Event_model');
  }

  public function participate($id){
    $sql =
      "SELECT events_id FROM attends AS a INNER JOIN users AS u on a.users_id = u.id where u.id = ?";
    $query = $this->db->query($sql,array($id));
    return $query->result('Event_model');
  }

  public function get_registered_by($id){
    $sql = "
      select registered_by from users as u inner join events as e on e.registered_by = u.id
      where u.id = ? group by registered_by";
    $query = $this->db->query($sql,array($id));
    return $query->result('Event_model');
  }
}
?>
