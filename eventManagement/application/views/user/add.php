<div class="container">
  <div class="panel panel-default">
      <div class="panel-heading">ユーザ追加</div>
        <div class="panel-body">
          <div class="row">
             <div class="col-md-12">
                <?php
                $options = array('data-toggle' => 'validator');
                 echo form_open("User/add",$options); ?>
                  <fieldset class="form-group has-feedback">
                    <label for="name" class="control-label">氏名<span>*</span></label>
                    <?php $data = array(
                      'name' => 'name',
                      'id' => 'login',
                      'class' => 'form-control',
                      'size' => '40',
                      'placeholder' => '氏名',
                      'required' => 'required'
                      );
                     echo form_input($data); ?>
                     <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                     <div class="help-block with-errors"></div>
                  </fieldset>
                  <fieldset class="form-group has-feedback">
                    <label for="login_id" class="control-label">ログインID(半角英数字のみ)<span>*</span></label>
                    <?php $data = array(
                      'name' => 'login_id',
                      'type' => 'text',
                      'id' => 'login',
                      'class' => 'form-control',
                      'size' => '40',
                      'pattern' => '^[a-zA-Z0-9!-/:-@¥[-`{-~]+$',
                      'maxlength' => '15',
                      'placeholder' => 'ログインID',
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
                  <?php echo form_hidden("type_id",'1'); ?>
                  <?php
                   $options = array(
                    'class' => 'btn btn-default',
                    'name' => 'cancel');
                  echo form_submit($options,'キャンセル'); ?>
                  <?php
                  $options = array(
                    'class' => 'btn btn-success',
                    'name' => 'add');
                  echo form_submit($options,'登録'); ?>
            <!--       <a class="btn btn-default"href="index" name="cancel">キャンセル</a>
                  <a class="btn btn-success"href="index" name="add">登録</a> -->
                  <?php echo form_close(); ?>
                  </div>
                </div>
            </div>
  </div>
</div>