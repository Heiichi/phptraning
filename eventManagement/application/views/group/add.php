<div class="container">
  <div class="row">
    <div class="col-md-9">
      <div class="panel panel-default">
        <div class="panel-heading">
          グループ一覧
        </div>

      <div class="panel-body ">
          <div class="container">
          　　<h1>グループ登録</h1>

            <fiedlset class="form-group">
              <?php echo form_open(); ?>
                <?php echo form_label('グループ名<span>*</span>',"group"); ?>
                <div class="row">
                  <div class="col-xs-6">
                  <?php echo form_input('name',set_value('name'),'class="form-control" placeholder="グループ名" ') ;?>
                    <div class="help-block with-errors"><?php echo form_error('name','<p>','</p>');?></div>
                  </div>
                </div>
            </fiedlset>
            <?php echo form_submit('cancel','キャンセル','class="btn btn-default"');?>
            <?php echo form_submit('add','登録','class="btn btn-success"');?>
            <?php echo form_close(); ?>
            </div>
        </div>
      </div>
    </div>
  </div>
</div>
