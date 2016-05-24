<div class="container">
　　<h1>ユーザ登録</h1>
  <div class="row">
    <?php
    $options = array('data-toggle' => 'validator');
     echo form_open("User/add",$options); ?>
      <fieldset class="form-group">
        <label for="name">氏名<span>*</span></label>
        <?php $data = array(
          'name' => 'name',
          'id' => 'login',
          'class' => 'form-control',
          'size' => '40',
          'placeholder' => '氏名',
          'data-error' =>'入力してください',
          'required' => 'required'
          );
         echo form_input($data); ?>
          <div class="help-block with-errors"></div>
      </fieldset>
      <fieldset class="form-group">
        <label for="login_id">ログインID<span>*</span></label>
        <?php $data = array(
          'name' => 'login_id',
          'type' => 'text',
          'pattern' => '^[_A-z0-9]{1,}$',
          'id' => 'login',
          'class' => 'form-control',
          'size' => '40',
          'placeholder' => 'ログインID',
          'data-error' =>'入力してください',
          'required' => 'required'
          );
         echo form_input($data); ?>
            <div class="help-block with-errors"></div>
      </fieldset>
      <fieldset class="form-group">
        <label for="login_pass">パスワード<span>*</span></label>
          <?php $data = array(
          'name' => 'login_pass',
          'type' => 'password',
          'id' => 'login_pass',
          'data-minlength' =>'6',
          'class' => 'form-control',
          'size' => '40',
          'placeholder' => 'パスワード',
          'data-error' =>'6文字以上入力してください',
          'required' =>'required'
          );
         echo form_password($data); ?>
            <div class="help-block with-errors"></div>
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