<?php
class Session extends CI_Controller{

  public function login(){
    $header['title'] = 'ログイン';

    //セッションのロード
    session_start();
    //$this->load->library('session');

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

    		$_SESSION["login"]=TRUE;

    		foreach ($data as $list):
    		$_SESSION["id"]=$list->id;
    		$_SESSION['name']=$list->name;
    		$_SESSION['type_id']=$list->type_id;
    		$_SESSION['group_id']=$list->group_id;
    		endforeach;

    		//var_dump($_SESSION);
    		//var_dump($data);
			 redirect('event/index');
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
  	session_start();

  	$_SESSION=array();
  	$params=session_get_cookie_params();
  	setcookie(session_name(),"",time()-36000,
  	$params["path"],$params["domain"],
  	$params["secure"],$params["httponly"]);
  	session_destroy();
    $header['title'] = 'ログアウト';
    $this->load->view('header', $header);
    $this->load->view('Session/logout');
  }

}
