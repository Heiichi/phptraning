<div class="container">
  <div class="panel panel-default">
    <div class="panel-heading">event Manager</div>
    <!-- 入力フォーム-->
    <?php
      $options = array('data-toggle' => 'validator');
      echo form_open("sessions/login_validation",$options);
      echo validation_errors();
    ?>
     <div class="panel-body">
      <div class="row">
        <div class="form-group">
          <div class="col-md-12">
            <div class="error"><?php echo form_error('login_id','<p>','</p>')?></div>
            <?php
              $login_id = array(
                'name'        => 'login_id',
                'class'       => 'form-control',
                'placeholder' => 'ログインID',
                'data-error'  => 'ログインIDを入力してください(半角英数記号)',
                'maxlength'   => '50',
                'required'    => 'required',
                'pattern'     => '^[a-zA-Z0-9!-/:-@¥[-`{-~]+$'
              );
              echo "<p>ログインID:";
              echo form_input("login_id",$this->input->post("login_id"),$login_id);
              echo "</p>";
            ?>
            <div class="help-block with-errors"></div>
          </div>
        </div>
        <!-- email -->
        <!-- <div class="form-group">
          <div class="col-md-12">
            <div class="error"><?php echo form_error('login_id','<p>','</p>')?></div>
            <?php
              $email = array(
                'name'        => 'login_id',
                'class'       => 'form-control',
                'placeholder' => 'ログインID',
                'data-error'  => 'ログインIDを入力してください(半角英数記号)',
                'maxlength'   => '50',
                'required'    => 'required',
                'pattern'     => '^[a-zA-Z0-9!-/:-@¥[-`{-~]+$'
              );
              echo "<p>Email:";
              echo form_input("email",$this->input->post("email"),$email);
              echo "</p>";
            ?>
            <div class="help-block with-errors"></div>
          </div>
        </div> -->
        <!-- email終わり -->

        <div class="form-group">
          <div class="col-md-12">
            <div class="error"><?php echo form_error('login_pass','<p>','</p>')?></div>
            <?php
            //パスワード入力処理
              $login_pass = array(
              'name' => 'login_pass',
              'class'       => 'form-control',
              'placeholder' => 'パスワード',
              'data-error'  => 'パスワードを入力してください',
              'maxlength'   => '255',
              'required'    => 'required'
            );
              echo "<p>パスワード:";
              echo form_password($login_pass);
              echo "</p>";
            ?>
            <div class="help-block with-errors"></div>
          </div>
        </div>
        <div class="col-md-12">
          <?php
          //ログインボタン
            $login = array(
              'name'        => 'login',
              'value'       => 'ログイン',
              'class'       => 'btn btn-default btn-primary'
            );
            echo form_submit($login);
          ?>
        </div>
      </div>
    </div>
  <?php echo form_close();?>
</div>
            <button id="forgetPassword" class="btn btn-default">パスワードを忘れた？</button>
