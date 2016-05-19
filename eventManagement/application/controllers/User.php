<?php
class User extends CI_Controller{

   public function index(){
    echo 'Hello, world';
    $header['title'] = 'ユーザー一覧';
    $this->load->view('header', $header);
    $this->load->view('user/user_index');
   }


  public function login(){
    $header['title'] = 'ログイン';
    $this->load->view('header', $header);
    $this->load->view('event_login');
  }
}