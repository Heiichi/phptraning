<div class="container">
<h1>ユーザ詳細</h1>

<!-- ユーザー詳細テーブル-->
<table class="table">
  	<tr>
  		<th  class="col-md-2">ID</th>
  		<td>
  			<?php echo $user->id;?></td>
  	</tr>
  	<tr>
  		<th  class="col-md-2">氏名</th>
  		<td>
  			<?php echo $user->name;?></td>
  	</tr>
  	<tr>
  		<th class="col-md-2">所属</th>
  		<td>
  			<?php
  			$g_id=$user->group_id;
  			foreach ($groups as $group): $g_n_id=$group->id;
  			if($g_n_id==$g_id):  echo $group->name;  endif;
  			endforeach;?>
  			</td>
  	</tr>
</table>

<!--遷移ボタン-->
    <a class="btn btn-info" href="<?php echo base_url('user/index')?>">一覧に戻る</a>
    <a class="btn btn-default" href="<?php echo base_url('user/edit/'.$user->id);?>">編集</a>
            <a class="btn btn-danger" href="#" role="button" data-toggle="modal" data-target="#userModal">削除
            </a>
            <!-- モーダルウィンドウ -->
            <div class="modal fade" id="userModal">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-body">
                    本当に削除してよろしいですか?
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">
                      Cancel
                    </button>
                    <a href="<?php echo base_url('user/delete/' . $user->id); ?>"><button type="button" class="btn btn-success">OK</button></a>
                  </div>
                </div>
              </div>
            </div>
            <!-- モーダルウィンドウend -->
  </div>
</div>