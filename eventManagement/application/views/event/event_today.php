<?php foreach($registered_by as $r_user): ?>
  <?php $register = $r_user->registered_by;  ?>
<?php endforeach; ?>

<?php $check = []; ?>
<?php  foreach($participate as $value):?>
  <?php $check[] = $value->events_id; ?>
<?php endforeach;?>



<div class="container">

  <div class="panel panel-default">
    <div class="panel-heading">
      本日のイベント
    </div>
    <div class="panel-body">
      <div class="row">

       <div class="col-md-12">
          <h1 id="show-event">本日のイベント</h1>

          <div id="pages">
              <?php echo $this->pagination->create_links();?>
          </div>



          <table class="table table-bordered" >
            <thead>
              <tr>
                <th>タイトル</th>
                <th>開始日時</th>
                <th>場所</th>
                <th>対象グループ</th>
                <th>詳細</th>
              <tr>
            <thead>
            <tbody>
              <?php if(!$events): ?>

              <?php else: ?>
                <?php foreach($events as $event): ?>
                  <?php $date_check = $event->end < date('Y-m-d H:i:s');  ?>
                  <tr>

                    <?php if($date_check && in_array($event->id,$check,true) || $date_check && $event->registered_by === $register):?>
                      <th><?php echo $event->title; ?><span class="label label-success spanlabel">参加しました</span></th>
                    <?php elseif(in_array($event->id,$check,true) || $event->registered_by === $register): ?>
                      <th><?php echo $event->title; ?><span class="label label-info spanlabel">参加</span></th>
                    <?php  elseif($date_check) :?>
                      <th><?php echo $event->title; ?><span class="label label-danger spanlabel">終了</span></th>
                    <?php else: ?>
                      <th><?php echo $event->title; ?></th>
                    <?php endif; ?>
                    <td><?php echo $event->start; ?></td>
                    <td><?php echo $event->place; ?></td>
                    <td><?php echo $event->name; ?></td>
                    <td><a href="<?php echo base_url('event/show/'.$event->id); ?>"class="btn btn-default" href="#" role="button">詳細</a></td>
                  </tr>
                <?php endforeach; ?>
              <?php endif;?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
</div>
