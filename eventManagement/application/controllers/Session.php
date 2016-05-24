<?php
class Session extends CI_Controller{

  public function login(){
    $header['title'] = 'ログイン';

    //セッションを使う全てのページで宣言する必要がある
    $this->load->library('session');

    $this->load->view('header', $header);
    $this->load->model('Session_model');
    $this->load->helper('form');
    $this->load->library('form_validation');

	$this->form_validation->set_rules('login_id','ログインID','required');
	$this->form_validation->set_rules('login_pass','パスワード','required');

	if($this->form_validation->run()){
    	$id=$this->input->post('login_id');
    	$pass=$this->input->post('login_pass');
    	$data=$this->Session_model->getUsers($id,$pass);
		//$this->output->enable_profiler(TRUE);

    	if($data==TRUE){
    		$session=$data;
    		var_dump($session);
    		$this->session->set_userdata($session);
			// redirect('event/index');
    	}

    	if($data==FALSE){
    		redirect('Session/login');
    	}

		}
     else{
     		//$re['id']="";
     		//$re['pass']="";
    		$this->load->view('Session/login');
    }
  }

  public function logout(){
    $header['title'] = 'ログアウト';
    $this->load->view('header', $header);
    $this->load->view('Session/logout');
  }

}
