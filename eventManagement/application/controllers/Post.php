<?php
  class Post extends CI_Controller{
    const NUM_PER_PAGE = 5;

    public function __construct()
    {
        parent::__construct();
        if($this->session->userdata("status") == "0"){//ログインしている場合の処理
          redirect("sessions/userbanned");
        }elseif($this->session->userdata("is_logged_in")){
        }else{
          redirect ("sessions/restricted");
        }
        $this->load->model('Group_model');
        $this->load->library('form_validation');
    }

    public function post(){
      $this->load->model("Event_model");
      $this->load->model('admin/User_model');
      $this->load->model('admin/Post_model');
      $this->load->library('form_validation');

      $groups = $this->Event_model->get_groups();
      $data['groups'] = $groups;
      $data['g_selected'] = '';
      $user_id = $_SESSION["id"];
      $data['selected'] = '';
      $users = $this->User_model->find_all($user_id);
      $data["users"] = $users;

      if($this->input->method() == 'post'){
          if($this->input->post('post') === "送信"){

            $data['selected'] = $this->input->post('user');
            $data['g_selected'] = $this->input->post('group');


            $post['users_id'] = $_SESSION['id'];
            $post['other_user_id'] = $this->input->post('user');
            $post['created'] = date('Y-m-d H:i:s');
            $post['group_id'] =  $this->input->post('group');

            $this->form_validation->set_rules('user','送信相手','callback_select_check');
            $this->form_validation->set_rules('group','対象グループ','callback_select_check');
            $this->form_validation->set_rules('title','タイトル','required|callback_title_check');
            $this->form_validation->set_rules('message','詳細','required|callback_message_check');
            $this->form_validation->set_message('required','{field}を入力してください。');

            if($this->form_validation->run()){

                if($this->input->post('title') !== ''){
                  $post['title'] = $this->input->post('title');
                }else {
                  $post['title'] = null;
                }

                if($this->input->post('title') !== ''){
                  $post['message'] = $this->input->post('message');
                }else {
                  $post['message'] = null;
                }

                $this->Post_model->insert($post);

                $header['title'] = 'グループ登録完了';
                $this->load->view('header',$header);
                $this->load->view('post/post_done');

            } else{
              $header['title'] = '連絡事項';
              $this->load->view('header',$header);
              $this->load->view('post/post',$data);
            }

          }

          if($this->input->post('cancel') === "キャンセル"){
            redirect('event/');
          }

      }else{
        $header['title'] = '連絡事項';
        $this->load->view('header',$header);
        $this->load->view('post/post',$data);
      }
  }

  public function information($page = ''){
    $this->load->model('admin/user_model');
    $this->load->model('admin/Post_model');

    if(!is_numeric($page)){
      $page =1;
    }

    $other_user_id = $_SESSION['id'];
    $other_user_group_id = $_SESSION['group_id'];

    $posts = $this->Post_model->get_message($other_user_id,$other_user_group_id,$page,self::NUM_PER_PAGE);
    $config['base_url'] = base_url('post/information');
    $config['total_rows'] = $this->Post_model->get_count($other_user_id,$other_user_group_id);
    $config['per_page'] = self::NUM_PER_PAGE;
    $config['use_page_numbers'] = TRUE;
    $config['prev_link'] = '前のページ';
    $config['next_link'] = '次のページ';
    $config['prev_tag_close'] = ' | ';
    $config['num_tag_close'] = ' | ';
    $config['cur_tag_close'] = '</strong>  | ';
    $config['anchor_class'] = 'page-link';
    $this->pagination->initialize($config);

    $data["posts"] = $posts;


    $header['title'] = 'お知らせ';
    $this->load->view('header', $header);
    $this->load->view('post/information',$data);

  }

  public function select_check(){

    if($this->input->post('user') == 0  && $this->input->post('group') == 0){
      $this->form_validation
        ->set_message('select_check','送信相手か対象グループを選択してください。');
      return false;
    }else{
      return true;
    }

  }

  public function title_check($str){
    if(!preg_match("/^[\S | \s | あ-ん| ア-ン | ｱ-ﾝ]{0,50}+$/u",$str)){
      $this->form_validation
        ->set_message('title_check','タイトルは50字以内で入力してください。');
      return false;
    }
    return true;
  }

  public function message_check($str){
    if(!preg_match("/^[\S | \s | あ-ん| ア-ン | ｱ-ﾝ]{0,300}+$/u",$str)){
      $this->form_validation
        ->set_message('message_check','メッセージは300字以内で入力してください。');
      return false;
    }
    return true;
  }


}
