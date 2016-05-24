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
    $header['title'] = 'イベント登録';
    $this->load->view('header', $header);
    $this->load->view('event/add');
  }
}
