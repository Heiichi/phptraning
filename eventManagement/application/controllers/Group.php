<?php
  class Group extends CI_Controller{
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

    public function index($page=''){
      $this->load->library('pagination');

      if(!is_numeric($page)){
        $page = 1;
      }

      $groups = $this->Group_model->find_all($page,self::NUM_PER_PAGE);
      $data['groups'] = $groups;

      $config['base_url'] = base_url('group/index');
      $config['total_rows'] = $this->Group_model->get_count();
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
      $this->pagination->initialize($config);

      $header['title'] = 'グループ一覧';
      $this->load->view('header',$header);
      $this->load->view('group/index',$data);
    }

    public function add(){
      $this->load->helper('form');

      $add = $this->input->post("add");
		  $cancel = $this->input->post("cancel");

      if($this->input->method() == 'post'){

        if($add === '登録'){
          $this->form_validation->set_rules('name','グループ名','required|callback_name_check');
          $this->form_validation->set_message('required','{field}を入力してください。');

          if($this->form_validation->run()){

            if($this->input->post('name') !== ''){
              $group['name'] = $this->input->post('name');
            }else{
              $group['name'] = null;
            }

            $this->Group_model->insert($group);
            $header['title'] = 'グループ登録完了';
            $this->load->view('header',$header);
            $this->load->view('group/add_done');
          }else{
            $header['title'] = 'グループ登録';
            $this->load->view('header',$header);
            $this->load->view('group/add');
          }
        }

        if($cancel === 'キャンセル'){
            redirect('group/');
        }
      }else{
        $header['title'] = 'グループ登録';
        $this->load->view('header', $header);
        $this->load->view('group/add');
      }
    }

    public function delete($id){

      $this->Group_model->update($id);

      $header['title'] = 'グループ削除完了';
      $this->load->view('header', $header);
      $this->load->view('group/delete_done');
    }

    public function name_check($str){
      if(!preg_match("/^[\S | \s | あ-ん| ア-ン | ｱ-ﾝ]{0,20}+$/u",$str)){
        $this->form_validation
          ->set_message('name_check','グループ名は20字以内で入力してください。');
        return false;
      }
      return true;
    }
  }
?>
