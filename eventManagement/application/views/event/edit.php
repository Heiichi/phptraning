
<!-- name値 value値 未設定-->
   <div class="col-md-9">
            <!-- form custom style -->
      <h1><strong>イベント編集</strong></h1>

			<?php foreach ($event as $value ):?>
      <?php echo form_open(); ?>
      <form method="post" action="">
                <div class="form-group">
                    <?php echo form_label('タイトル(必須)','title'); ?>
                    <?php echo form_input('title',set_value('title',$value->title),'class="form-control" placeholder="必須"'); ?>
                    <div class="help-block with-errors"><?php echo form_error('title','<p>','</p>');?></div>
                </div>

                <div class="form-group">
                    <?php echo form_label('開始日時(必須)','start'); ?>
                    <?php echo form_input('start',set_value('start',$value->start),'class="form-control" placeholder="0000-00-00 00:00:00"');?>
                    <div class="help-block with-errors"><?php echo form_error('start','<p>','</p>');?></div>
                </div>

                <div class="form-group">
                   <?php echo form_label('終了日時','end'); ?>
                   <?php echo form_input('end',set_value('end',$value->end),'class="form-control" placeholder="0000-00-00 00:00:00"');?>
                   <div class="help-block with-errors"><?php echo form_error('end','<p>','</p>');?></div>
                </div>

                <div class="form-group">
                  <?php echo form_label('場所(必須)','place'); ?>
                  <?php echo form_input('place',set_value('place',$value->place),'class="form-control" placeholder="必須"');?>
                  <div class="help-block with-errors"><?php echo form_error('place','<p>','</p>');?></div>
                </div>



                <?php foreach ($groups as $group): ?>
                  <?php $options[$group->id] = $group->name; ?>
                <?php endforeach; ?>

                <!-- value値未設定 -->
                <div class="form-group">
                    <label>対象グループ</label>

                    <?php echo form_dropdown('group',$options,set_value('group',$value->group_id),'class="form-control"'); ?>

                 </div>






                <div class="form-group">
                  <?php echo form_label('詳細','detail'); ?>
                  <?php echo form_textarea('detail',set_value('detail',$value->detail),'cols="20" rows="6" class="form-control" rows="3" placeholder="100文字まで。"');?>
                  <div class="help-block with-errors"><?php echo form_error('detail','<p>','</p>');?></div>
                </div>

                <?php echo form_submit('cancel','キャンセル','class="btn btn-default"');?>
                <?php echo form_submit('edit','編集','class="btn btn-success"');?>
                <?php echo form_close(); ?>
							<?php endforeach; ?>
                <!-- モーダルウィンドウを呼び出すボタン -->
                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal">登録</button>

                <!-- モーダルウィンドウの中身 -->
                <div class="modal fade" id="myModal">
                  <div class="modal-dialog">
                    <div class="modal-content">

                      <div class="modal-body">本当に削除してよろしいですか?</div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-success">OK</button>
                       </div>
                    </div>
                  </div>
                </div>
            </form>
        </div>


</body>
</html>
