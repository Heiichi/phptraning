<?php
/**
 *
 */
class Event_model extends CI_Model
{
  public $id;
  public $title;
  public $start;
  public $end;
  public $place;
  public $detail;
  public $group_id;
  public $registered_by;

  // function __construct(argument)
  // {
  //   # code...
  // }
  public function show_find($id){
    $sql =
      "select title, start, end, place, g.name as g_name , detail, u.name as u_name from events as e
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
}
 ?>
