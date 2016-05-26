<div class="container">
<h1>ユーザ詳細</h1>
  <div class="table-responsive">
    <table class="table table-bordered">
      <div class="row">
        <tr>
          <th>ID</th>
          <th>氏名</th>
          <th>所属グループ</th>
        </tr>
        <tr>
          <td><?php echo$user->id;?></td>
          <td><?php echo$user->name;?></td>
          <td><?php echo$user->group_id;?></td>
        </tr>
      </div>
    </table>

    <a class="btn btn-info" href="<?php echo base_url('user/index')?>">一覧に戻る</a>
    <a class="btn btn-default" href="<?php echo base_url('user/edit/'.$user->id);?>">編集</a>
    <a class="btn btn-danger" href="<?php echo base_url('user/delete/'.$user->id);?>">削除</a>

  </div>
</div>