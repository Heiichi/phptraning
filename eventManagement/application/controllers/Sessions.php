<?php
class Sessions extends CI_Controller{

  public function index(){
    $this->login();
  }

  public function login(){
    $this->load->view('head');
    $this->load->view("sessions/login");
  }

  public function members(){
    $this->load->view('head');
    if($this->session->userdata("is_logged_in")){	//ログインしている場合の処理
    $this->load->view("sessions/members");
  }else{									//ログインしていない場合の処理
    redirect ("sessions/restricted");
  }
  }

  public function restricted(){
    $this->load->view('head');
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
      }
      $data = array(
    		"email" => $this->input->post("email"),
    		"is_logged_in" => 1,
        "login_pass" => $this->input->post('login_pass'),
        "name" => $user_name,
        "type_id" => $type_id,
        "group_id" => $group_id,
        "id" => $id
    	);
    	$this->session->set_userdata($data);
  	redirect('event/index');
  }else{//バリデーションエラーがあった場合の処理
  	$this->load->view("Sessions/login");
	}
  }

  public function logout(){
  	$this->session->sess_destroy();
    $this->load->view('head');
    $this->load->view('Sessions/logout');
  }

  public function validate_credentials(){		//Email情報がPOSTされたときに呼び出されるコールバック機能
  $this->load->model("Sessions_model");

  if($this->Sessions_model->canLogIn()){	//ユーザーがログインできたあとに実行する処理
    return true;
  }else{					//ユーザーがログインできなかったときに実行する処理
    $this->form_validation->set_message("validate_credentials", "ユーザー名かパスワードが異なります。");
    return false;
  }
}



















  public function login2(){

    //セッションのロード
    session_start();

    $header['title'] = 'ログイン';
    $this->load->view('head',$header);
    $this->load->model('Session_model');
    $this->load->helper('form');
    $this->load->library('form_validation');
    $this->form_validation->set_rules("login_pass", "パスワード", "required");
    $this->form_validation->set_rules("email", "メール", "required|trim|xss_clean|callback_validate_credentials");

	  //ログインボタンが押されたときの処理
      if($this->input->post('login') == TRUE){
    		$id = $this->input->post('login_id');
        $email = $this->input->post('email');
    		$pass = $this->input->post('login_pass');
    		$data = $this->Session_model->getUsers($id,$pass);
        $data2 = $this->Session_model->getUsers2($email,$pass);

    //ログインIDとパスが一致したとき
    	if($data2 == TRUE){

    		$_SESSION["login"]=TRUE;

    		foreach ($data2 as $list):
    			$_SESSION["id"]=$list->id;
    			$_SESSION['name']=$list->name;
          $_SESSION['email']    = $list->email;
          $_SESSION['login_pass'] = $list->login_pass;
    			$_SESSION['type_id']  = $list->type_id;
    			$_SESSION['group_id'] = $list->group_id;
    		endforeach;
			redirect('event/index');
    }else{
    //ログインIDとパスが一致しなかったとき
    			$re['id'] = $id;
          $re['email'] = $email;
    			$re['message']="ログインIDまたはパスワードが違います";
    			$this->load->view('Session/login',$re);
    		}
		}
	//初回訪問時

    		$this->load->view('Session/login');

  }

  public function logout2(){
  	//session_start();
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
