<div class="container">
　　<h1>グループ登録</h1>
  <div class="row">
    <fiedlset class="form-group">
      <?php echo form_open(); ?>
        <?php echo form_label('グループ名<span>*</span>',"group"); ?>
        <?php echo form_input('name',set_value('name'),'class="form-control" placeholder="グループ名" ') ;?>
          <div class="help-block with-errors"><?php echo form_error('name','<p>','</p>');?></div>
    </fiedlset>
    <?php echo form_submit('cancel','キャンセル','class="btn btn-default"');?>
    <?php echo form_submit('add','登録','class="btn btn-success"');?>
    <?php echo form_close(); ?>
  </div>
</div>
