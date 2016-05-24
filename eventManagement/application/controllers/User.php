<?php
class User extends CI_Controller{

    // 1ページあたりの表示件数
    const NUM_PER_PAGE = 5;

    public function __construct()
    {
        parent::__construct();
        $this->load->model('admin/user_model');
        $this->load->library('form_validation');
    }

   public function index($page=''){
    $header['title'] = 'ユーザー一覧';
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
        $config['use_page_numbers'] = TRUE;
        $config['prev_link'] = '前のページ';
        $config['next_link'] = '次のページ';
        $config['prev_tag_close'] = ' | ';
        $config['num_tag_close'] = ' | ';
        $config['cur_tag_close'] = '</strong>  | ';
        $config['anchor_class'] = 'page-link';
        $this->pagination->initialize($config);

        // お知らせの取得
        // $data['users'] = $this->user_model->find_by_page($page, self::NUM_PER_PAGE);
    $this->load->view('user/index',$data);
   }

   public function show(){
    $header['title'] = 'ユーザ詳細';
    $this->load->view('header', $header);
    $this->load->view('user/show');
   }
   public function add(){
    $this->load->library('form_validation');
    $header['title'] = 'ユーザ登録';
    $this->load->model('admin/user_model');
    $groups['groups'] =$this->user_model->findAllGroups();
    $this->form_validation->set_rules('name', '氏名', 'required');
    $this->form_validation->set_rules('login_id', 'ログインID', 'required');
    $this->form_validation->set_rules('password', 'パスワード', 'required');
    $this->load->view('header', $header);
    $this->load->view('user/add',$groups);

    // キャンセルボタンが押された場合は一覧画面へ移動する
    if ($this->input->post('cancel') != null)
    {
        redirect('user/');
    }

    //登録が押された場合
    if($this->input->post('add')){
      $user['name'] = $this->input->post('name');
      $user['login_id'] = $this->input->post('login_id');
      $user['login_pass'] = $this->input->post('login_pass');
      $user['group_id'] = $this->input->post('group_id');

      $this->user_model->insert($user);
      redirect('user/add_done');
    }
   }

   public function add_done(){
    $header['title'] = 'ユーザ登録の完了';
    $this->load->view('header', $header);
    $this->load->view('user/add_done');
   }
   public function edit($id){
 //   var_dump($_POST);
//    exit;
    $header['title'] = 'ユーザ編集';
    $this->load->view('header', $header);
    $data['groups'] =$this->user_model->findAllGroups();
    // $this->load->view('user/add',$groups);
    // $this->output->enable_profiler(TRUE);
    if ($this->input->post('cancel') === "キャンセル")
      {
         redirect('user/');
      };
    $user = $this->user_model->find_by_id($id);
    $data['id'] = $id;
    $data['user'] = $user;
    $this->load->view('user/edit',$data);
    if($user == null){
      // redirect('user/');
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
   // public function delete(){
   //  $header['title'] = 'ユーザ削除';
   //  $this->load->view('header', $header);
   //  $this->load->view('user/delete');
   // }

   public function delete_done(){
    $header['title'] = 'ユーザ削除の完了';
    $this->load->view('header', $header);
    $this->load->view('user/delete_done');
   }


  public function login(){
    $header['title'] = 'ログイン';
    $this->load->view('header', $header);
    $this->load->view('event_login');
  }


}