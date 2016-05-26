<?php
class Session extends CI_Controller{

  public function login(){

    //セッションのロード
    session_start();

    $header['title'] = 'ログイン';
    $this->load->view('head',$header);
    $this->load->model('Session_model');
    $this->load->helper('form');
    $this->load->library('form_validation');

	//ログインボタンが押されたときの処理
    if ($this->input->post('login') ==TRUE){
    		$id=$this->input->post('login_id');
    		$pass=$this->input->post('login_pass');
    		$data=$this->Session_model->getUsers($id,$pass);
			//$this->output->enable_profiler(TRUE);

    //ログインIDとパスが一致したとき
    	if($data==TRUE){

    		$_SESSION["login"]=TRUE;

    		foreach ($data as $list):
    			$_SESSION["id"]=$list->id;
    			$_SESSION['name']=$list->name;
    			$_SESSION['type_id']=$list->type_id;
    			$_SESSION['group_id']=$list->group_id;
    		endforeach;

			redirect('event/index');
    	}
    //ログインIDとパスが一致しなかったとき
    	if($data==FALSE){
    			$re['id']=$this->input->post('login_id');
    			$re['message']="ログインIDまたはパスワードが違います";
    			$this->load->view('Session/login',$re);
    		}
		}
	//初回訪問時
     	else{
    		$this->load->view('Session/login');
    	}
  }

  public function logout(){
  	session_start();
  	$header['title'] = 'ログアウト';
  	//セッションを破壊後ログアウト画面に遷移
  	$_SESSION=array();
  	$params=session_get_cookie_params();
  	setcookie(session_name(),"",time()-36000,
  	$params["path"],$params["domain"],
  	$params["secure"],$params["httponly"]);
  	session_destroy();
    $this->load->view('head',$header);
    $this->load->view('Session/logout');
  }
}
