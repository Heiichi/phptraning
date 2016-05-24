<?php
class Event extends CI_Controller{

  const NUM_PER_PAGE = 5;

   public function index($page=''){
     $this->load->model("Event_model");
     $this->load->library('pagination');

		if(!is_numeric($page)){
			$page = 1;
		}
     $events = $this->Event_model->find_all($page, self::NUM_PER_PAGE);
     $data["events"] = $events;

     $data["events"] = $events;
     $config['base_url'] = base_url('event/index');
     $config['total_rows'] = $this->Event_model->get_count();
     $config['per_page'] = self::NUM_PER_PAGE;
     $config['use_page_numbers'] = TRUE;
     $config['prev_link'] = '前のページ';
     $config['next_link'] = '次のページ';
     $config['prev_tag_close'] = ' | ';
     $config['num_tag_close'] = ' | ';
     $config['cur_tag_close'] = '</strong> | ';
     $this->pagination->initialize($config);

     $header['title'] = 'イベント一覧';
     $this->load->view('header', $header);
     $this->load->view('event/index',$data);
   }

   public function event_today($page=''){
     $this->load->model("Event_model");
     $this->load->library('pagination');

		if(!is_numeric($page)){
			$page = 1;
		}
     $events = $this->Event_model->today_event($page, self::NUM_PER_PAGE);

     $data["events"] = $events;
     $config['base_url'] = base_url('event/event_today');
     $config['total_rows'] = $this->Event_model->today_get_count();
     $config['per_page'] = self::NUM_PER_PAGE;
     $config['use_page_numbers'] = TRUE;
     $config['prev_link'] = '前のページ';
     $config['next_link'] = '次のページ';
     $config['prev_tag_close'] = ' | ';
     $config['num_tag_close'] = ' | ';
     $config['cur_tag_close'] = '</strong> | ';
     $this->pagination->initialize($config);
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

        $this->form_validation->set_rules(
          'title','タイトル','required'
        );
        $this->form_validation->set_rules(
          'start','開始時間','required|callback_time_check'
        );
        $this->form_validation->set_rules(
          'end','終了時間','required|callback_time_check'
        );
        $this->form_validation->set_rules(
          'place','場所','required'
        );
        $this->form_validation->set_rules(
          'detail','詳細','required|callback_detail_check'
        );

        $this->form_validation->set_message(
          'required','{field}を入力してください。'
        );


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

          $event['registered_by'] = 2;

          if($this->input->post('detail') !== ''){
            $event['detail'] = $this->input->post('detail');
          }else {
            $event['detail'] = null;
          }

          $this->Event_model->insert($event);

          $header['title'] = 'グループ登録完了';
          $this->load->view('header',$header);
          $this->load->view('event/add_done');
          echo "aaa";

        }else{
          $header['title'] = 'イベント登録';

          $this->load->view('header', $header);
          $this->load->view('event/add',$data);
        }

      }
      if($cancel === "キャンセル"){

      }

    }else{
      $header['title'] = 'イベント登録';

      $this->load->view('header', $header);
      $this->load->view('event/add',$data);
    }

  }
  public function show($id){
    $this->load->model('Event_model');

    $event = $this->Event_model->show_find($id);
    $attends = $this->Event_model->get_attends($id);
    $data["event"] = $event;
    $data["attends"] = $attends;
    $header['title'] = 'イベント詳細';

    $this->load->view('header', $header);

    $this->load->view('event/show',$data);
  }




  public function time_check($str){
    if(!preg_match("/^\d{4}-\d{1,2}-\d{1,2} \d{2}:\d{2}:?\d{0}$/",$str)){
      $this->form_validation
        ->set_message('time_check','形式は0000-00-00 00:00:00で入力してください。');
      return false;
    }else{
      return true;
    }
  }

  public function detail_check($str){
    if(!preg_match("/^[\S\s]{0,100}$/",$str)){
      $this->form_validation
        ->set_message('detail_check','詳細は100字以内で入力してください。');
      return false;
    }
    return true;
  }

}
