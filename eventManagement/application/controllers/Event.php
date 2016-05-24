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
    $this->load->model('Event_model');
    $groups = $this->Event_model->get_groups();
    $data['groups'] = $groups;
    $this->load->view('header', $header);
    $this->load->view('event/add',$data);
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

//編集画面
  public function edit($id){
  	$header['title'] = 'ユーザー編集';
  	$this->load->view('header', $header);
  	$this->load->model('Event_model');
  	$this->load->helper('form');
  	$this->load->library('form_validation');

  	//キャンセル押されたときの処理
  		if (isset($_POST["cancel"])) {
  		redirect('event/index');
  		}

  	//ヴァリデーション
  		$this->form_validation->set_rules('title','タイトル','callback_title_check');
  		$this->form_validation->set_rules('start','開始日時','callback_start_check');
  		//$this->form_validation->set_rules('end','終了日時','required');
  		$this->form_validation->set_rules('place','場所','callback_place_check');
  		//$this->form_validation->set_rules('group_id','対象グループ','required');
  		$this->form_validation->set_rules('detail','詳細','callback_detail_check');

  	//ヴァリデーションが通ったときの処理
  		if ($this->form_validation->run()){
  				$update['title'] =$this->input->post('title');
  				$update['start']=$this->input->post('start');
  				$update['end'] =$this->input->post('end');
  				$update['place']=$this->input->post('place');
  				$update['group_id'] =$this->input->post('group_id');
  				$update['detail']=$this->input->post('detail');

  	//DBでアップデート処理後,edit_doneへ遷移
  				$this->Event_model->update($update,$id);
  				redirect('event/edit_done/');
  				}
  	//ヴァリデーションが通ってないとき→このページに訪れたとき
  		else{
  				$data['id']=$id;
  				$data['groups']=$this->Event_model->getGroup();
  				$data['events']=$this->Event_model->getrow($id);
  				$this->load->view('event/edit',$data);
  			}
  	//$this->output->enable_profiler(TRUE);
  }

  //ヴァリデーションチェック及びコメントのfunction
  //タイトルの空白チェック
  public function title_check($str){

  	if($str=="" or preg_match("/^[\s ]/", $str)){
  		$this->form_validation->
  		set_message('title_check','タイトルを入力してください');
  		return  FALSE;
  	}
	else{
  	return TRUE;
	}
  }
//開始日時のチェック
  	public function start_check($str){
  	  	if(!preg_match("/^\d{4}-\d{2}-\d{2}[\s ]\d{2}:\d{2}:\d{2}$/", $str)){
  				$this->form_validation->
  				set_message('start_check','開始日時を「0000-00-00 00:00:00」で入力してください');
  				return  FALSE;
  			}
		else{
  				return TRUE;
			}
 		 }
//場所の空白チェック
  	public function place_check($str){

  		if($str=="" or preg_match("/^[\s ]/", $str)){
  				$this->form_validation->
  				set_message('place_check','場所を入力してください');
  				return  FALSE;
  			}
  		else{
  				return TRUE;
  			}
  		}
 //詳細の空白チェック
  	public function detail_check($str){

  		if($str=="" or preg_match("/^[\s ]/", $str)){
  				$this->form_validation->
  				set_message('detail_check','詳細を入力してください');
  				return  FALSE;
  			}
  		else{
  				return TRUE;
  			}
  		}

//編集完了画面
  	public function edit_done(){
  			$header['title'] = '編集完了';
  			$this->load->view('header', $header);
  			$this->load->view('event/edit_done');
  		}
}
