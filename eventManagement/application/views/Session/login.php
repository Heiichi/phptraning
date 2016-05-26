<div class="container">
  <div class="panel panel-default">
    <div class="panel-heading">
      event Manager
    </div>

<!-- 入力フォーム-->
 <?php
 $options = array('data-toggle' => 'validator');
 echo form_open("session/login",$options);?>
 <div class="panel-body">
  <div class="row">
   <div class="col-md-12">
    <h4 class="loginCaution">
      <?php
       //認証失敗したときのエラーメッセージ
        if(isset($message)):echo $message;endif;
      ?>
    </h4>
   </div>
   <div class="form-group">
    <div class="col-md-12">
     <div class="error"><?php echo form_error('login_id','<p>','</p>')?></div>

<?php
//認証失敗時のログイン入力処理
   if(isset($id)){
          $login_id = array(
                 'name'        => 'login_id',
                 'class'       => 'form-control',
                 'placeholder' => 'ログインID',
                 'data-error'  => 'ログインIDを入力してください(半角英数記号)',
                 'maxlength'   => '50',
                 'required'    => 'required',
                 'pattern' => '^[a-zA-Z0-9!-/:-@¥[-`{-~]+$'
          		 );
          echo form_input($login_id,$id);
     }

//初回訪問時のログイン入力処理
     else{
          $login_id = array(
                 'name'        => 'login_id',
                 'class'       => 'form-control',
                 'placeholder' => 'ログインID',
                 'data-error'  => 'ログインIDを入力してください(半角英数記号)',
                 'maxlength'   => '50',
                 'required'    => 'required',
                 'pattern' => '^[a-zA-Z0-9!-/:-@¥[-`{-~]+$'
                 );
           echo form_input($login_id);
	}?>
       	<div class="help-block with-errors"></div>
       </div>
    </div>


   <div class="form-group">
    <div class="col-md-12">
     <div class="error"><?php echo form_error('login_pass','<p>','</p>')?></div>
<?php
//パスワード入力処理
      $login_pass = array(
           		'name'        => 'login_pass',
           		'class'       => 'form-control',
           		'placeholder' => 'パスワード',
                'data-error'  => 'パスワードを入力してください',
                'maxlength'   => '255',
                'required'    => 'required'
                );
      echo form_password($login_pass); ?>
       <div class="help-block with-errors"></div>
     </div>
    </div>
	<div class="col-md-12">
<?php
//ログインボタン
      $login = array(
                'name'        => 'login',
                'value'       => 'ログイン',
      			'class'		  => 'btn btn-default btn-primary'
      			);
       echo form_submit($login);?>
        </div>
      </div>
  </div>
<?php echo form_close();?>
</div>
<button id="forgetPassword" class="btn btn-default">パスワードを忘れた？</button>