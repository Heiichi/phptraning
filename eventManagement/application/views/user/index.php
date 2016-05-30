<div class="container">
  <div class="panel panel-default">
    <div class="panel-heading">ユーザ一覧</div>
  <div class="panel-body">
    <div class="row">
      <div class="col-md-12">
      <h2>ユーザ一覧</h2>
        <div class="table-responsive">
          <nav>
            <?php echo $this->pagination->create_links(); ?>
          </nav>
          <table class="table table-bordered">
            <thead>
              <tr>
                <th>ID</th>
                <th>氏名</th>
                <th>所属グループ</th>
                <th>詳細</th>
                <th>削除</th>
              </tr>
            </thead>
            <?php foreach ($users as $user): ?>
              <tr>
                <td><?php echo $user->id; ?></td>
                <td><?php echo $user->uname; ?></td>
                <td><?php echo $user->name; ?></td>
                <td><a class="btn btn-default" href="<?php echo base_url('user/show/'.$user->id); ?>">詳細</a></td>
                <td>
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
                </td>
              </tr>
            <?php endforeach; ?>
          </table>
          <a class="btn btn-primary" href="<?php echo base_url('user/add'); ?>">ユーザの登録</a>
        </div>
      </div>
    </div>
  </div>
</div>
