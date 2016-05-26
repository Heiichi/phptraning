<div class="container">
  <div class="panel panel-default">
    <div class="panel-heading">
      event Manager
    </div>
    <div class="panel-body">
      <div class="row">
        <div class="col-md-12">
          <h1>お知らせ</h1>
          <?php echo $this->pagination->create_links();?>

          <table class="table table-bordered" >
            <thead>
              <tr>
                <th>送信者</th>
                <th>お知らせ</th>
                <th>メッセージ</th>
                <th>送信時間</th>
              </tr>
            </thead>

            <tbody>
              <?php foreach($posts as $post): ?>
                <tr>
                  <td><?php echo $post->u_name; ?></td>
                  <td><?php echo $post->title; ?></td>
                  <td><?php echo $post->message; ?></td>
                  <td><?php echo $post->created; ?></td>

                </tr>
              <?php endforeach; ?>
              </tbody>
            </table>

          <p><a href="<?php echo base_url('event/'); ?>">イベント一覧に戻る</a></p>
        </div>
      </div>
  </div>
</div>
