

<!-- ヘッダー-->



<!-- name値 value値 未設定-->
   <div class="col-md-9">
            <!-- form custom style -->
      <h1><strong>イベント登録</strong></h1>
      <?php echo form_open(); ?>
      <form method="post" action="">
                <div class="form-group">
                    <?php echo form_label('タイトル(必須)','title'); ?>
                    <?php echo form_input('title',set_value('title'),'class="form-control" placeholder="必須"'); ?>
                </div>

                <div class="form-group">
                    <?php echo form_label('開始日時(必須)','start'); ?>
                    <?php echo form_input('start',set_value('start'),'class="form-control" placeholder="0000-00-00 00:00:00"');?>
                </div>

                <div class="form-group">
                   <?php echo form_label('終了日時','end'); ?>
                   <?php echo form_input('end',set_value('end'),'class="form-control" placeholder="0000-00-00 00:00:00"');?>

                </div>

                <div class="form-group">
                  <?php echo form_label('場所(必須)','place'); ?>
                  <?php echo form_input('place',set_value('place'),'class="form-control" placeholder="必須"');?>
                </div>

                <!-- value値未設定 -->
                <div class="form-group">
                    <label>対象グループ</label>
                    <select name="" class="form-control">
                      <?php foreach ($groups as $group):?>
                        <option value="<?php echo $group->id;?>"><?php echo $group->name;?></option>
                      <?php endforeach;?>            
                    </select>
                </div>

                <div class="form-group">
                    <label>詳細</label>
                    <textarea cols="20" rows="6" class="form-control" rows=3 placeholder="100文字まで。"></textarea>
                </div>

                <button type="submit" class="btn btn-default">キャンセル</button>
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
