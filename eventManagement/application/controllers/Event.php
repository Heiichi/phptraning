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
    $this->load->view('header', $header);
    $this->load->view('event/add');
  }
}
