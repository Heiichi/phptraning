<?php
class User extends CI_Controller{

    // 1ページあたりの表示件数
    const NUM_PER_PAGE = 5;

    public function __construct()
    {
        parent::__construct();
        session_start();
        if($_SESSION['login'] != TRUE){
          redirect('session/login');
        }elseif($_SESSION['type_id'] == '1'){
          redirect('/event');
        }
        $this->load->model('admin/user_model');
        $this->load->view('head');
        $this->load->library('form_validation');
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

    //キャンセルされたときの処理
    if(isset($_POST["cancel"])){
      redirect('user/');
    }

    //validationの設定
    // $this->form_validation->set_rules('name','氏名','callback_name_check');
    // $this->form_validation->set_rules('login_id','ログインID','callback_login_id_check');
    // $this->form_validation->set_rules('login_pass','パスワード','callback_login_pass_check');


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
   public function delete($id){
        $header['title'] = 'ユーザ削除';
        $this->load->view('header', $header);
        // 削除ボタンが押された場合はお知らせを削除する
        if ($this->input->post('delete') != null)
        {
          $this->user_model->delete($this->input->post('id'));
          redirect('user/delete_done');
        }
        // お知らせデータの取得
        $user = $this->user_model->find_by_id($id);
        $data['id'] = $id;
        $data['user'] = $user;
        $this->load->view('user/delete',$data);

        // if ($user == null)
        // {
        //     redirect('user/');
        // }
        if ($this->input->post('cancel') != null)
        {
            redirect('user/');
        }
   }

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