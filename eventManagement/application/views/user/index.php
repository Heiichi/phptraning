　　<h1>ユーザ一覧</h1>
  <div class="table-responsive">
    <table class="table table-bordered">
    <nav>
  <ul class="pagination">
    <li class="page-item disabled">
      <a class="page-link" href="#" aria-label="Previous">
        <span aria-hidden="true">&laquo;</span>
        <span class="sr-only">Previous</span>
      </a>
    </li>
    <li class="page-item active">
      <a class="page-link" href="#">1 <span class="sr-only">(current)</span></a>
    </li>
    <li class="page-item"><?php echo $this->pagination->create_links(); ?></li>
    <li class="page-item">
      <a class="page-link" href="#" aria-label="Next">
        <span aria-hidden="true">&raquo;</span>
        <span class="sr-only">Next</span>
      </a>
    </li>
  </ul>
</nav>
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
          <th><a class="btn btn-default" href="<?php echo base_url('user/edit/'.$user->id); ?>">詳細</a></th>
          <th><a class="btn btn-default" href="<?php echo base_url('user/delete/'.$user->id); ?>">削除</a></th>
        </tr>
    <?php endforeach; ?>
    </table>
    <a class="btn btn-success" href="add">ユーザの登録</a>
  </div>
</div>