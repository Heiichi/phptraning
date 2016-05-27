

<!-- ヘッダー-->


<div class="container">
  <div class="panel panel-default">
    <div class="panel-heading">
      連絡事項
    </div>
    <div class="panel-body">
      <div class="row">
<!-- name値 value値 未設定-->
       <div class="col-md-9">
                <!-- form custom style -->
          <h1><strong>連絡事項</strong></h1>

          <?php echo form_open(); ?>

          <?php $options[0] = ''; ?>
            <?php foreach ($users as $user): ?>
              <?php $options[$user->id] = $user->name; ?>
            <?php endforeach; ?>

            <div class="form-group">
                <label>送信相手</label>
                <?php echo form_dropdown('user',$options,$selected,'class="form-control"'); ?>
                <div class="help-block with-errors"><?php echo form_error('user','<p>','</p>');?></div>
            </div>

            <?php $g_options[0] = ''; ?>
            <?php foreach ($groups as $group): ?>
              <?php $g_options[$group->id] = $group->name; ?>
            <?php endforeach; ?>

            <!-- value値未設定 -->
            <div class="form-group">
                <label>対象グループ</label>
                <?php echo form_dropdown('group',$g_options,$g_selected,'class="form-control"'); ?>
                <div class="help-block with-errors"><?php echo form_error('group','<p>','</p>');?></div>

             </div>

             <div class="form-group">
               <?php echo form_label('タイトル','title'); ?>
               <?php echo form_input('title',set_value('title'),'class="form-control" placeholder="50文字まで。"');?>
               <div class="help-block with-errors"><?php echo form_error('title','<p>','</p>');?></div>
             </div>

              <div class="form-group">
                <?php echo form_label('お知らせ','message'); ?>
                <?php echo form_textarea('message',set_value('message'),'cols="20" rows="6" class="form-control" rows="3" placeholder="300文字まで。"');?>
                <div class="help-block with-errors"><?php echo form_error('message','<p>','</p>');?></div>
              </div>

              <?php echo form_submit('cancel','キャンセル','class="btn btn-default"');?>
              <?php echo form_submit('post','送信','class="btn btn-success"');?>
              <?php echo form_close(); ?>
            </div>
          </div>
        </div>
      </div>
  </div>

</body>
</html>
</div>
