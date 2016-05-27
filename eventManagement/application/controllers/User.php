<?php
class User extends CI_Controller{

    // 1ページあたりの表示件数
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
        $this->load->model('admin/user_model');
        $this->load->library('form_validation');
    }

  public function members(){
    $this->load->view("members");
  }

   public function index($page=''){
    $header['title'] = 'ユーザー一覧';
    $header['name'] = $_SESSION['name'];
    $this->load->view('header', $header);
    $data['users'] =$this->user_model->find_UserGroupIdEqualGroupsid();

    //データの取得
    if(!is_numeric($page)){
      $page =1;
    }
    $users = $this->user_model->find_by_page($page, self::NUM_PER_PAGE);
    $data['users'] = $users;
    // Paginationの設定
        $config['base_url'] = base_url('user/index');
        $config['total_rows'] = $this->user_model->get_count();
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
    $this->load->view('user/index',$data);
   }

   public function add(){

    //キャンセルされたときの処理
    if(isset($_POST["cancel"])){
      redirect('user/');
    }
    $header['title'] = 'ユーザ登録';
    $this->load->helper('form');
    $this->load->view('header',$header);
    $this->load->model('admin/user_model');
    $groups['groups'] =$this->user_model->findAllGroups();



    if($this->input->post('add')){
      $user['name'] = $this->input->post('name');
      $user['login_id'] = $this->input->post('login_id');
      $user['login_pass'] = $this->input->post('login_pass');
      $user['group_id'] = $this->input->post('group_id');

      //DBへ流す
      $this->user_model->insert($user);
      redirect('user/add_done');
    }
    else{
        $this->load->view('user/add',$groups);
    }
   }

   public function add_done(){
    $header['title'] = 'ユーザ登録の完了';
    $this->load->view('header', $header);
    $this->load->view('user/add_done');
   }
   public function edit($id){
    $header['title'] = 'ユーザ編集';
    $this->load->view('header', $header);
    $data['groups'] =$this->user_model->findAllGroups();
    if ($this->input->post('cancel') === "キャンセル")
      {
         redirect('user/');
      };
    $user = $this->user_model->find_by_id($id);
    $data['id'] = $id;
    $data['user'] = $user;
    $this->load->view('user/edit',$data);
    if($user == null){
    }
    $data['user'] = $user;

    if($this->input->post('save')){
      $user['id'] = $this->input->post('id');
      $user['name'] = $this->input->post('name');
      $user['login_id'] = $this->input->post('login_id');
      $user['login_pass'] = $this->input->post('login_pass');
      $user['group_id'] = $this->input->post('group_id');
      $this->user_model->update($user, $user['id']);
      redirect('user/edit_done');
    }
  }

   public function edit_done(){
    $header['title'] = 'ユーザ編集の完了';
    $this->load->view('header', $header);
    $this->load->view('user/edit_done');
   }
   public function delete($id){
      $this->user_model->delete($id);
      $header['title'] = 'ユーザー削除完了';
      $this->load->view('header', $header);
      $this->load->view('user/delete_done');
   }

   public function ban($id){
      $user['status'] = 0;
      $this->user_model->banned($user, $id);
      redirect('user/show/'.$id);
   }

    public function reborn($id){
      $user['status'] = 1;
      $this->user_model->banned($user, $id);
      redirect('user/show/' .$id);
   }
   public function show($id){

   	$header['title'] = 'ユーザ詳細';
   	$this->load->view('header', $header);
   	//前ページで受け取ったIDでDB接続
   	$data['groups'] =$this->user_model->findAllGroups();
    $user = $this->user_model->find_by_id($id);

    $data['id'] = $id;
    $data['user'] = $user;
    $this->load->view('user/show',$data);
   }


}
