<div class="container">
  <div class="panel panel-default">
      <div class="panel-heading">ユーザ詳細</div>
        <div class="panel-body">
          <div class="row">
             <div class="col-md-12">
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
                			<?php echo $user->name;?><?php if($user->status == 0): ?><span class="label label-danger spanlabel">停止中</span><?php endif; ?></td>
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
                <a class="btn btn-danger" href="#" role="button" data-toggle="modal" data-target="#userModal">削除</a>
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
                <?php if($user->status == 1): ?>
                <a class="btn btn-danger" href="#" role="button" data-toggle="modal" data-target="#userbanned">停止</a>

                  <!-- モーダルウィンドウ -->
                  <div class="modal fade" id="userbanned">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-body">
                          アカウントを停止させますか?
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-default" data-dismiss="modal">
                            Cancel
                          </button>
                          <a href="<?php echo base_url('user/ban/' . $user->id); ?>"><button type="button" class="btn btn-success">OK</button></a>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- モーダルウィンドウend -->

                <?php else: ?>
                <a class="btn btn-info" href="#" role="button" data-toggle="modal" data-target="#userreborn">停止解除</a>
                  <!-- モーダルウィンドウ -->
                  <div class="modal fade" id="userreborn">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-body">
                          アカウント停止を解除させますか?
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-default" data-dismiss="modal">
                            Cancel
                          </button>
                          <a href="<?php echo base_url('user/reborn/' . $user->id); ?>"><button type="button" class="btn btn-success">OK</button></a>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- モーダルウィンドウend -->
                <?php endif; ?>

              </div>
            </div>
          </div>
</div>
</div>