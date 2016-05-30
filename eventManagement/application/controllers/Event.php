<?php
class Event extends CI_Controller{

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
        $this->load->model('Event_model');
        $this->load->library('form_validation');
    }


   public function index($page=''){
     $this->load->model('Group_model');
     $this->load->library('pagination');
     $id = $_SESSION['id'];
    if(!is_numeric($page)){
      $page = 1;
    }
      $participate = $this->Event_model->participate($id);
      $data['participate']  =  $participate;
      $registered_by = $this->Event_model->get_registered_by($id);
      $data["registered_by"] = $registered_by;

      $groups = $this->Group_model->get_all_groups();
      $data['groups'] = $groups;
      $data['g_selected'] = '';

      $places = $this->Event_model->get_all_places();
      $data['places'] = $places;
      $data['p_selected'] = '';

      if($_SERVER["REQUEST_METHOD"] === 'POST'){
        $g_id = $this->input->post('group');
        $p_name = $this->input->post('place');

        $data['g_selected'] = $this->input->post('group');
        $data['p_selected'] = $this->input->post('place');

        if($g_id !== "0" && $p_name !== "全て" ){

          $events = $this->Event_model->find_group_place($g_id,$p_name,$page, self::NUM_PER_PAGE);
          $data["events"] = $events;
          $count = $this->Event_model->get_group_place_count($g_id,$p_name);


        }elseif($g_id !== "0"){

          $events = $this->Event_model->find_group($g_id,$page, self::NUM_PER_PAGE);
          $data["events"] = $events;
          $count = $this->Event_model->get_group_count($g_id);

        }elseif($p_name !== "全て"){
          $events = $this->Event_model->find_place($p_name,$page, self::NUM_PER_PAGE);
          $data["events"] = $events;
          $count = $this->Event_model->get_place_count($p_name);

        }elseif($g_id === "0" && $p_name === "全て" ){
          $events = $this->Event_model->find_all($page, self::NUM_PER_PAGE);
          $data["events"] = $events;
          $count = $this->Event_model->get_count();
        }

      }else{
        $events = $this->Event_model->find_all($page, self::NUM_PER_PAGE);
        $data["events"] = $events;
        $count = $this->Event_model->get_count();
      }


      $url = base_url('event/index');
      $this->config_set($url,$count);
     $header['title'] = 'イベント一覧';
     $this->load->view('header', $header);
     $this->load->view('event/index',$data);
   }


   public function event_today($page=''){
     $this->load->model("Event_model");
     $this->load->library('pagination');

     $id = $_SESSION['id'];

    if(!is_numeric($page)){
      $page = 1;
    }
     $events = $this->Event_model->today_event($page, self::NUM_PER_PAGE);

     $participate = $this->Event_model->participate($id);
     $registered_by = $this->Event_model->get_registered_by($id);

     $data["registered_by"] = $registered_by;
     $data['participate']  =  $participate;

     $data["events"] = $events;

     $url = base_url('event/event_today');

     $count = $this->Event_model->today_get_count();

     $config = $this->config_set($url,$count);



     $header['title'] = '本日のイベント';
     $this->load->view('header', $header);
     $this->load->view('event/event_today',$data);

   }

  public function login(){
    $header['title'] = 'ログイン';
    $this->load->view('header', $header);
    $this->load->view('event_login');
  }
  public function add(){
    $this->load->model('Event_model');
    $this->load->library('form_validation');
    $groups = $this->Event_model->get_groups();
    $data['groups'] = $groups;
    $add = $this->input->post('add');
    $cancel = $this->input->post('cancel');
    $data['selected'] = '';

    if($this->input->method() == 'post'){
      if($add === "登録"){

        $data['selected'] = $this->input->post('group');


        $event = $this->validation();

        if($event != false){
          $this->Event_model->insert($event);

          $header['title'] = 'グループ登録完了';
          $this->load->view('header',$header);
          $this->load->view('event/add_done');
        }else{
          $header['title'] = 'イベント登録';
          $this->load->view('header', $header);
          $this->load->view('event/add',$data);
        }
      }
      if($cancel === "キャンセル"){

        redirect('event/');

      }

    }else{
      $header['title'] = 'イベント登録';
      $this->load->view('header', $header);
      $this->load->view('event/add',$data);
    }
  }


  public function show($id){

    $this->load->model('Event_model');
    $this->load->model('Attend_model');

    $event = $this->Event_model->show_find($id);
    $attends = $this->Event_model->get_attends($id);
    $user_name = $_SESSION["name"];
    $registered_by = $this->Event_model->registered_by($id,$user_name);


    $data['registered_by'] = $registered_by;
    $user_id = $_SESSION['id'];


    $current_user = $_SESSION["type_id"];

    $current_user_attends_event = $this->Event_model->user_attend($user_id,$id);
    if($current_user_attends_event ){
      $data["participate"] = true;
    }else{
      $data["participate"] = false;
    }

    $data["user"] = $current_user;
    $data["event"] = $event;
    $data["attends"] = $attends;


    $header['title'] = 'イベント詳細';

    $this->load->view('header', $header);





    $this->load->view('event/show',$data);

    if($this->input->post('save') === "参加する"){

      $attend["users_id"] = $_SESSION["id"];

      $attend ['events_id'] = $id;
      $this->Attend_model->insert($attend);



    }



    if($this->input->post('cancel') === "参加を取り消す")
    {
      $user_id =  $_SESSION["id"];
      $this->Attend_model->delete($user_id,$id);

    }
  }

//編集画面
  public function edit($id){

  	$header['title'] = 'イベント編集';
    $this->load->model('Event_model');
    $this->load->library('form_validation');
    $groups = $this->Event_model->get_groups();
    $data['groups'] = $groups;
    $event = $this->Event_model->show_find($id);
    $data["event"] = $event;

    $edit = $this->input->post('edit');
    $cancel = $this->input->post('cancel');

    //編集ボタンが押されたとき
    if($this->input->method() == 'post'){
      if($edit === "編集"){
        $data['selected'] = $this->input->post('group');

        $event = $this->validation();
     //ヴァリデーションが通ったとき
        if($event ==TRUE){
          $this->Event_model->update($event,$id);
		  $this->load->view('header',$header);
          $this->load->view('event/edit_done');
        }
    //ヴァリデーションが通らなかったとき
        else{
          $this->load->view('header', $header);
          $this->load->view('event/edit',$data);
        }
      }
   //キャンセルボタンが押されたとき
      if($cancel === "キャンセル"){

        redirect('event/');
      }
    }
    //初回訪問時
    else{
      $this->load->view('header', $header);
      $this->load->view('event/edit',$data);
    }
  }

//編集完了画面
  public function edit_done(){
      $header['title'] = 'イベント編集完了';
      $this->load->view('header', $header);
      $this->load->view('event/edit_done');
  }

  public function delete($id){
    $this->load->model('Event_model');


    $this->Event_model->delete($id);

    $header['title'] = 'イベントの削除完了';
    $this->load->view('header', $header);
    $this->load->view('event/delete_done');
  }



  public function validation(){


    $this->form_validation->set_rules('title','タイトル','required');
    $this->form_validation->set_rules('start','開始日時','required|callback_time_check');
    $this->form_validation->set_rules('end','終了日時','required|callback_time_check|callback_date_check');
    $this->form_validation->set_rules('place','場所','required');
    $this->form_validation->set_rules('detail','詳細','required|callback_detail_check');
    $this->form_validation->set_message('required','{field}を入力してください。');

    if($this->form_validation->run()){

      if($this->input->post('title') !== ''){
        $event['title'] = $this->input->post('title');
      }else {
        $event['title'] = null;
      }

      if($this->input->post('start') !== ''){
        $event['start'] = $this->input->post('start');
      }else {
        $event['start'] = null;
      }

      if($this->input->post('end') !== ''){
        $event['end'] = $this->input->post('end');
      }else {
        $event['end'] = null;
      }

      if($this->input->post('place') !== ''){
        $event['place'] = $this->input->post('place');
      }else {
        $event['place'] = null;
      }

      $event['group_id'] = $this->input->post('group');

      $event['registered_by'] = $_SESSION["id"];

      if($this->input->post('detail') !== ''){
        $event['detail'] = $this->input->post('detail');
      }else {
        $event['detail'] = null;
      }
      return $event;
    }else{
      return false;
    }
  }

    public function time_check($str){

      if(!preg_match("/^\d{4}-\d{0,2}-\d{0,2}[\s ]\d{0,2}:\d{0,2}:?\d{0,2}$/",$str)){
        $this->form_validation
          ->set_message('time_check','形式は西暦-月-日 時:分:秒で入力してください。');
        return false;
      }else{
        return true;
      }
    }

    public function date_check(){
      $s = $this->input->post('start');
      $e = $this->input->post('end');

      if($s > $e){
        $this->form_validation
          ->set_message('date_check','終了日時は、開始日時よりも後にしてください。');
        return false;
      }else{
        return true;
      }

    }


    public function detail_check($str){
      if(!preg_match("/^[\S | \s | あ-ん| ア-ン | ｱ-ﾝ]{0,100}+$/u",$str)){
        $this->form_validation
          ->set_message('detail_check','グループ名は100字以内で入力してください。');
        return false;
      }
      return true;
    }

    public function config_set($url,$count){

      $config['base_url'] = $url;
      $config['total_rows'] = $count;
      $config['per_page'] = self::NUM_PER_PAGE;
      $config['full_tag_open'] = '<ul class="pagination">';
      $config['full_tag_close'] = '</ul>';
      $config['first_link'] = FALSE;
      $config['last_link'] = FALSE;
      $config['use_page_numbers'] = TRUE;
      $config['prev_link'] = '<<';
      $config['prev_tag_open'] = '<li>';
      $config['prev_tag_close'] = '</li>';
      $config['next_link'] = '>>';
      $config['next_tag_open'] = '<li>';
      $config['next_tag_close'] = '</li>';
      $config['cur_tag_open'] = '<li class="active"><a href="">';
      $config['cur_tag_close'] = '</a></li>';
      $config['num_tag_open'] = '<li>';
      $config['num_tag_close'] = '</li>';

      return $this->pagination->initialize($config);
    }
}
