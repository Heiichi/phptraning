<div class="container">
  <div class="panel panel-default">
      <div class="panel-heading">ユーザ編集</div>
        <div class="panel-body">
          <div class="row">
             <div class="col-md-12">
              <?php
              $options = array('data-toggle' => 'validator');
               echo form_open("User/edit",$options); ?>
                <fieldset class="form-group has-feedback">
                  <label for="name" class="control-label">氏名<span>*</span></label>
                  <?php $data = array(
                    'name' => 'name',
                    'id' => 'login',
                    'class' => 'form-control',
                    'size' => '40',
                    'placeholder' => '氏名',
                    'value' => $user->name,
                    'data-error' =>'入力してください',
                    'required' => 'required'
                    );
                   echo form_input($data); ?>
                  <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                  <div class="help-block with-errors"></div>
                </fieldset>
                <fieldset class="form-group has-feedback">
                  <label for="login_id" class="control-label">ログインID<span>*</span></label>
                  <?php $data = array(
                    'name' => 'login_id',
                    'type' => 'text',
                    'pattern' => '^[_A-z0-9]{1,}$',
                    'id' => 'login',
                    'class' => 'form-control',
                    'size' => '40',
                    'placeholder' => 'ログインID',
                    'value' => $user->login_id,
                    'required' => 'required'
                    );
                   echo form_input($data); ?>
                    <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                    <div class="help-block with-errors"></div>
                </fieldset>
                <fieldset class="form-group has-feedback">
                  <label for="login_pass" class="control-label">パスワード<span>*</span></label>
                    <?php $data = array(
                    'name' => 'login_pass',
                    'type' => 'password',
                    'pattern' => '^[a-zA-Z0-9!-/:-@¥[-`{-~]+$',
                    'id' => 'login_pass',
                    'data-minlength' =>'6',
                    'class' => 'form-control',
                    'size' => '40',
                    'placeholder' => 'パスワード',
                    'value' => $user->login_pass,
                    'required' =>'required'
                    );
                   echo form_password($data); ?>
                    <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                    <div class="help-block">6文字以上の半角英数字で入力してください。</div>
                </fieldset>
                <fieldset class="form-group">
                  <label for="group">所属グループ<span>*</span></label>
                  <select name="group_id" class="form-control">
                    <?php foreach($groups as $list): ?>
                      <option value="<?php echo $list->id; ?>">
                      <?php echo $list->name; ?>
                      </option>
                    <?php endforeach; ?>
                  </select>
                      <div class="help-block with-errors"></div>
                </fieldset>
                <?php echo form_hidden("id",$id); ?>
                <?php
                 $options = array(
                  'class' => 'btn btn-default',
                  'name' => 'cancel');
                echo form_submit($options,'キャンセル'); ?>
                <?php
                $options = array(
                  'class' => 'btn btn-success',
                  'name' => 'save');
                echo form_submit($options,'登録'); ?>
                <?php echo form_close(); ?>
          </div>
        </div>
      </div>
    </div>
</div>