<?php
class Event extends CI_Controller{

   public function index(){
     $header['title'] = 'イベント一覧';
     $this->load->view('header', $header);
     $this->load->view('event/index');
   }

   public function event_today(){
     $header['title'] = '本日のイベント';
     $this->load->view('header', $header);
     $this->load->view('event/event_today');

   }



  public function login(){
    $header['title'] = 'ログイン';
    $this->load->view('header', $header);
    $this->load->view('event_login');
  }
  public function add(){
    $header['title'] = 'イベント登録';
    $this->load->model('Event_model');
    $groups = $this->Event_model->get_groups();
    $data['groups'] = $groups;
    $this->load->view('header', $header);
    $this->load->view('event/add',$data);
  }
  public function show($id){
    $this->load->model('Event_model');

    $event = $this->Event_model->show_find($id);
    $attends = $this->Event_model->get_attends($id);
    $data["event"] = $event;
    $data["attends"] = $attends;
    $header['title'] = 'イベント詳細';

    $this->load->view('header', $header);

    $this->load->view('event/show',$data);
  }



}
