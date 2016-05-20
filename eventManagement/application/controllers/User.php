<?php
class User extends CI_Controller{

   public function index(){
    $header['title'] = 'ユーザー一覧';
    $this->load->view('header', $header);
    $this->load->model('admin/user_model');
    $data['users'] =$this->user_model->find_UserGroupIdEqualGroupsid();
    $this->load->view('user/index',$data);
   }

   public function show(){
    $header['title'] = 'ユーザ詳細';
    $this->load->view('header', $header);
    $this->load->view('user/show');
   }
   public function add(){
    $header['title'] = 'ユーザ登録';
    $this->load->model('admin/user_model');
    $user['name'] = $this->input->post('name');
    $user['login_id'] = $this->input->post('login_id');
    $user['login_pass'] = $this->input->post('login_pass');
    $user['group_id'] = $this->input->post('group_id');
    $this->load->view('header', $header);
    $this->load->view('user/add');
   }

   public function add_done(){
    $header['title'] = 'ユーザ登録の完了';
    $this->load->view('header', $header);
    $this->load->view('user/add_done');
   }
   public function edit(){
    $header['title'] = 'ユーザ編集';
    $this->load->view('header', $header);
    $this->load->view('user/edit');
   }

   public function edit_done(){
    $header['title'] = 'ユーザ編集の完了';
    $this->load->view('header', $header);
    $this->load->view('user/edit_done');
   }
   // public function delete(){
   //  $header['title'] = 'ユーザ削除';
   //  $this->load->view('header', $header);
   //  $this->load->view('user/delete');
   // }

   public function delete_done(){
    $header['title'] = 'ユーザ削除の完了';
    $this->load->view('header', $header);
    $this->load->view('user/delete_done');
   }


  public function login(){
    $header['title'] = 'ログイン';
    $this->load->view('header', $header);
    $this->load->view('event_login');
  }


}