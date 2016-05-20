　　<h1>ユーザ一覧</h1>
  <div class="table-responsive">
    <table class="table table-bordered">
      <tr>
        <th>ID</th>
        <th>氏名</th>
        <th>所属グループ</th>
        <th>詳細</th>
      </tr>
      <?php foreach ($users as $user): ?>
        <tr>
          <th><?php echo $user->id; ?></th>
          <th><?php echo $user->uname; ?></th>
          <th><?php echo $user->name; ?></th>
          <th><a class="btn btn-default" href="#">詳細</a></th>
        </tr>
    <?php endforeach; ?>
    </table>
    <a class="btn btn-success" href="add">ユーザの登録</a>
  </div>
</div>