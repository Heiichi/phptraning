<?php
class Session extends CI_Controller{

  public function login(){
    $header['title'] = 'ログイン';
    $this->load->view('header', $header);
    $this->load->view('Session/login');
  }

  public function logout(){
    $header['title'] = 'ログアウト';
    $this->load->view('header', $header);
    $this->load->view('Session\logout');
  }

}