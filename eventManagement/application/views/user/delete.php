<div class="container">
　　<h1>ユーザ一削除</h1>
  <div class="row">
    <?php
    $options = array('data-toggle' => 'validator');
     echo form_open("User/delete",$options); ?>
      　　<p>ユーザ名：<?php echo $user->name; ?></p>
      <p>本当に削除しますか？</p>
      <?php
       $options = array(
        'class' => 'btn btn-default',
        'name' => 'cancel');
      echo form_submit($options,'キャンセル'); ?>
      <?php
      $options = array(
        'class' => 'btn btn-danger',
        'name' => 'delete',
        );
      echo form_submit($options,'削除'); ?>
      <?php echo form_hidden("id",$id); ?>
      <?php echo form_close(); ?>
  </div>
</div>