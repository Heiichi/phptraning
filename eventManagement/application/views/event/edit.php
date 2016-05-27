<div class="container">
  <div class="col-md-9">
    <!-- form custom style -->
      <h1><strong>イベント編集</strong></h1>

  <?php echo form_open(); ?>
  	<?php foreach ($event as $value ):?>
  <!-- タイトル入力 -->
         <div class="form-group">
            <?php echo form_label('タイトル(必須)','title'); ?>
              <?php echo form_input('title',set_value('title',$value->title),
              		'class="form-control" placeholder="必須"'); ?>
                <div class="help-block with-errors"><?php echo form_error('title','<p>','</p>');?></div>
         </div>

  <!-- 開始日時入力 -->
         <div class="form-group">
           <?php echo form_label('開始日時(必須)','start'); ?>
             <?php echo form_input('start',set_value('start',$value->start),
             		'class="form-control" placeholder="0000-00-00 00:00:00"');?>
                <div class="help-block with-errors"><?php echo form_error('start','<p>','</p>');?></div>
         </div>

  <!-- 終了日時入力 -->
          <div class="form-group">
            <?php echo form_label('終了日時(必須)','end'); ?>
              <?php echo form_input('end',set_value('end',$value->end),
              		'class="form-control" placeholder="0000-00-00 00:00:00"');?>
                 <div class="help-block with-errors"><?php echo form_error('end','<p>','</p>');?></div>
          </div>
  <!-- 場所入力 -->
           <div class="form-group">
             <?php echo form_label('場所(必須)','place'); ?>
               <?php echo form_input('place',set_value('place',$value->place),
               		'class="form-control" placeholder="必須"');?>
                  <div class="help-block with-errors"><?php echo form_error('place','<p>','</p>');?></div>
            </div>
  <!-- 対象グループ -->
            <?php foreach ($groups as $group): ?>
              <?php $options[$group->id] = $group->name; ?>
            <?php endforeach; ?>

            <div class="form-group">
              <label>対象グループ</label>
  				<?php echo form_dropdown('group',$options,
  						set_value('group',$value->group_id),'class="form-control"'); ?>
            </div>
  <!-- 詳細入力 -->
            <div class="form-group">
            <?php echo form_label('詳細','detail'); ?>
              <?php
              $detail = array(
              		'name'        => 'detail',
              		'value'       => $value->detail,
              		'cols'        => '20',
              		'rows'        => '6',
              		'class'		  => 'form-control',
              		'placeholder' => '必須'
              );
              echo form_textarea($detail);
             // echo form_textarea('detail',
                 // set_value('detail',$value->detail),'cols="20" rows="6" class="form-control" rows="3" placeholder="必須"');?>
               <div class="help-block with-errors"><?php echo form_error('detail','<p>','</p>');?></div>
          </div>
  <!-- 遷移ボタン -->
               <?php echo form_submit('cancel','キャンセル','class="btn btn-default"');?>
               <?php echo form_submit('edit','保存','class="btn btn-primary"');?>

  	<?php endforeach; ?>
   <?php echo form_close();?>
  </div>
</div>
</body>
</html>
