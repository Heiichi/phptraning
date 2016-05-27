<?php
class Sessions extends CI_Controller{

  public function index(){
    $this->login();
  }

  public function login(){
    $header['title'] = 'ログイン';
    $this->load->view('head',$header);
    $this->load->view("sessions/login");
  }

  public function members(){
    $this->load->view('head');
    if($this->session->userdata("is_logged_in")){	//ログインしている場合の処理
    $this->load->view("sessions/members");
  }else{//ログインしていない場合の処理
    redirect ("sessions/restricted");
  }
  }

  public function restricted(){
    $header['title'] = 'restricted';
    $this->load->view('head',$header);
  	$this->load->view("sessions/restricted");
  }


  public function login_validation(){
    $this->load->view('head');
    //$this->form_validation->set_rules("email", "メール", "required|callback_validate_credentials");
    $this->form_validation->set_rules("login_id", "ログインID", "required|callback_validate_credentials");
	  $this->form_validation->set_rules("login_pass", "パスワード", "required");

    if($this->form_validation->run()){	//バリデーションエラーがなかった場合の処理
      $name = $this->Sessions_model->getUsers($this->input->post("login_id"),$this->input->post('login_pass'));
      foreach ($name as $list){
        $user_name = $list->name;
        $type_id = $list->type_id;
        $id = $list->id;
        $group_id = $list->group_id;
        $status = $list->status;
      }
      $data = array(
    		"email" => $this->input->post("email"),
    		"is_logged_in" => 1,
        "login_pass" => $this->input->post('login_pass'),
        "name" => $user_name,
        "type_id" => $type_id,
        "group_id" => $group_id,
        "id" => $id,
        "status" => $status
    	);
    	$this->session->set_userdata($data);
  	redirect('event/index');
  }else{//バリデーションエラーがあった場合の処理
  	$this->load->view("Sessions/login");
	}
  }

  public function logout(){
  	$this->session->sess_destroy();
    $header['title'] = 'ログアウト';
    $this->load->view('head',$header);
    $this->load->view('Sessions/logout');
  }

  public function validate_credentials(){		//Email情報がPOSTされたときに呼び出されるコールバック機能
  $this->load->model("Sessions_model");

  if($this->Sessions_model->canLogIn()){	//ユーザーがログインできたあとに実行する処理
    return true;
  }else{					//ユーザーがログインできなかったときに実行する処理
    $this->form_validation->set_message("validate_credentials", "ログインIDかパスワードが異なります。");
    return false;
  }
}
}
