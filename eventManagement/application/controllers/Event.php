<?php
class Event extends CI_Controller{

   public function index(){
    echo 'Hello, world';
   }


  public function login(){
    $header['title'] = 'ログイン';
    $this->load->view('header', $header);
    $this->load->view('event_login');
  }
}