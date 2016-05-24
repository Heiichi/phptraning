<!-- javascriptとCIのフォーム仕様による設定-->
<script>
$(document).ready(function () {
	$('#form').submit(function(){
		$('<input>').attr({
		    type: 'submit',
		    name: 'save',
		}).appendTo('#form');
		$('h1').css('background-color','#ccc');
	})
	var formData = $('#form').serialize();
});
</script>

<!-- ヘッダー-->
			<!-- フォーム入力-->

<dziv class="col-md-9">
            	<!-- form custom style -->
      <h1><strong>イベント編集</strong></h1>

<?php echo form_open();?>
          		<div class="form-group">
                <label>タイトル(必須)</label>
                    <div class="error"><?php echo form_error('title','<p>','</p>')?></div>
                <?php
                    $title = array(
                    		'name'        => 'title',
                    		'class'       => 'form-control',
                    		'value'       => $events->title,
                    		'maxlength'   => '50',
                    		'placeholder' => '必須' );
                    echo form_input($title); ?>
                </div>

                <div class="form-group">
                    <label>開始日時(必須)</label>
                    <div class="error"><?php echo form_error('start','<p>','</p>')?></div>
                    <?php
                        $start = array(
                    		'name'        => 'start',
                    		'class'       => 'form-control',
                    		'value'       => $events->start,
                    		'maxlength'   => '19',
                    		'placeholder' => '0000-00-00 00:00:00 必須');
                    echo form_input($start); ?>
                </div>

                <div class="form-group">
                    <label>終了日時</label>
                    <div class="error"><?php echo form_error('end','<p>','</p>')?></div>
                    <?php
                    $end = array(
                    		'name'        => 'end',
                    		'class'       => 'form-control',
                    		'value'       => $events->end,
                    		'maxlength'   => '19',
                    		'placeholder' => '0000-00-00 00:00:00');
                    echo form_input($end); ?>
                </div>

                <div class="form-group">
                    <label>場所(必須)</label>
                    <div class="error"><?php echo form_error('place','<p>','</p>')?></div>
                    <?php
                    $place = array(
                    		'name'        => 'place',
                    		'class'       => 'form-control',
                    		'value'       => $events->place,
                    		'maxlength'   => '255',
                    		'placeholder' => '必須' );
                    echo form_input($place); ?>
                </div>

				<!-- guroupsテーブルから取得したものを使う-->
                <div class="form-group">
                    <label>対象グループ</label>
                    <select name="group_id" class="form-control">
                    <?php foreach ($groups as $list):?>
                        <option value="<?php echo $list->id;?>"
                        <?php echo set_select('group_id', $list->id); ?>
                        <?php $select=$list->id; $set=$events->group_id;
                        	if($select==$set):?>selected<?php endif;?>>
                        <?php echo $list->name;?>
                        </option>
                    <?php endforeach;?>
                    </select>
                </div>

                <div class="form-group">
                    <label>詳細</label>
                    <div class="error"><?php echo form_error('detail','<p>','</p>')?></div>
                    <?php
                    	$textarea = array(
                    		'name'        => 'detail',
                    		'class'		  => 'form-control',
                    		'value'       => $events->detail,
                    		'rows'   => '10',
                    		'cols'        => '20',
                    		'placeholder' => '必須' );
                    echo form_textarea($textarea); ?></div>

                    <p>
      				<?php
      				  $cancel = array(
                    		'name'        => 'cancel',
                    		'class'		  => 'btn btn-default',
                    		'value'       => 'キャンセル');
      				  echo form_submit($cancel);?>
      				<?php
      				  $save = array(
      				  		'name'        => 'save',
      				  		'class'		  => 'btn btn-primary',
      				  		'value'       => '保存');
      				  echo form_submit($save);?>
      				</p>

                </div>
<?php echo form_close();?>
</div>

</body>
</html>
