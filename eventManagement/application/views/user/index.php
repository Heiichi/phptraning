<div class="container">　　
<h1>ユーザ一覧</h1>
  <div class="table-responsive">
    <table class="table table-bordered">
<?php echo $this->pagination->create_links(); ?>
      <tr>
        <th>ID</th>
        <th>氏名</th>
        <th>所属グループ</th>
        <th>詳細</th>
        <th>削除</th>
      </tr>
      <?php foreach ($users as $user): ?>
        <tr>
          <th><?php echo $user->id; ?></th>
          <th><?php echo $user->uname; ?></th>
          <th><?php echo $user->name; ?></th>
          <th><a class="btn btn-primary" href="<?php echo base_url('user/edit/'.$user->id); ?>">詳細</a></th>
          <th><a class="btn btn-danger" href="<?php echo base_url('user/delete/'.$user->id); ?>">削除</a></th>
          </div>
          </th>
        </tr>
    <?php endforeach; ?>
    </table>
    <a class="btn btn-success" href="<?php echo base_url('user/add'); ?>">ユーザの登録</a>
  </div>
</div>