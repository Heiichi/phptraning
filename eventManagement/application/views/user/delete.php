<div class="container">
　　<h1>ユーザ一覧</h1>
  <div class="row">
    <?php
    $options = array('data-toggle' => 'validator');
     echo form_open("User/delete",$options); ?>
      <fieldset class="form-group">
        <?php echo $user->name; ?>
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
        'name' => 'delete',
        );
      echo form_submit($options,'削除'); ?>
      <?php echo form_hidden("id",$id); ?>
      <?php echo form_close(); ?>
  </div>
</div>