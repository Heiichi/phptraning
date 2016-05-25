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
        "SELECT e.id , title,place,g.name FROM `events` as e
          inner join `groups` as g on e.group_id = g.id ORDER BY start, end LIMIT ?,?";

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

  public function show_find($id){
    $sql =
      "select title, start, end, place, g.name as g_name , detail, u.name as u_name, e.group_id from events as e
      inner join groups as g on e.group_id = g.id inner join users as u ON e.registered_by = u.id where e.id =?";

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
    $query = $this->db->query('SELECT id , name FROM `groups`');
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
?>
