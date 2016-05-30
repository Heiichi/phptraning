<script>
  $(
    function (){

      $('form').submit(
        function(){

          $.ajaxPrefilter(function( options, originalOptions, jqXHR ) {
            options.async = true;
          });

          var group = document.getElementById('group');
          var place = document.getElementById('place');

          var gName = group.name;
          var pName = place.name

          var gData ={};
          var pData ={};

          var gValue= group.value;
          var pValue = place.value;


          // var gName = $('#group').attr('name');
          // var pName = $('#place').attr('name');
          //
          // var gData[gName] = $('#group').val();
          // var pData[pName] = $('#place').val();

          var form = $(this);


          $('form').html('<button type="button" class="btn btn-success">送信中...</button>');

          $.ajax({
              type: form.attr('method'),
              url: form.attr('action'),
              dataType: 'html',
              data: {gName:gValue,pName:pValue},
              timeout: 5000,
            }).done(function(data){

              $('body').html(data);
            }).fail(function(){
              alert('エラーが発生しました。更新をしてください。');
            });


        }

      );

    }

  );
</script>


<?php foreach($registered_by as $r_user): ?>
  <?php $register = $r_user->registered_by;  ?>
<?php endforeach; ?>
<?php $check = []; ?>
<?php  foreach($participate as $value):?>
  <?php $check[] = $value->events_id; ?>
<?php endforeach;?>

<?php $g_options[0] = '全て'; ?>
  <?php foreach ($groups as $group): ?>
    <?php $g_options[$group->id] = $group->name; ?>
  <?php endforeach; ?>

  <?php $p_options['全て'] = '全て'; ?>
    <?php foreach ($places as $place): ?>
      <?php $p_options[$place->place] = $place->place; ?>
    <?php endforeach; ?>

<div class="container">
  <div class="panel panel-default">
    <div class="panel-heading">
      イベント一覧
    </div>
    <div class="panel-body">
      <div class="row">

       <div class="col-md-12">
        <h2 id="show-event">イベント一覧</h2>
        <div id="pages">
          <?php echo $this->pagination->create_links();?>
        </div>

        <?php echo form_open(); ?>
          <div class="form-group">
            <label>所属グループ</label>
              <?php echo form_dropdown('group',$g_options,$g_selected,'id="place" class="form-control"'); ?>
          </div>

          <div class="form-group">
            <label>場所</label>
              <?php echo form_dropdown('place',$p_options,$p_selected,'id="group" class="form-control"'); ?>
          </div>

          <p><?php echo form_submit('post','抽出','id="submit" class="btn btn-success"');?></p>
        <?php echo form_close(); ?>


        <table class="table table-bordered" >
          <thead>
            <tr>
              <th>タイトル</th>
              <th>開始日時</th>
              <th>場所</th>
              <th>対象グループ</th>
              <th>詳細</th>
            </tr>
          </thead>
          <tbody>

            <?php foreach($events as $event): ?>
              <?php $date_check = $event->end < date('Y-m-d H:i:s'); ?>
              <tr>
                <?php if( $date_check && in_array($event->id,$check,true) ||  $date_check && $event->registered_by === $register):?>
                  <td><?php echo $event->title; ?><span class="label label-success spanlabel">参加しました</span></td>
                <?php elseif(in_array($event->id,$check,true) || $event->registered_by === $register): ?>
                  <td><?php echo $event->title; ?><span class="label label-info spanlabel">参加</span></td>
                <?php  elseif($date_check) :?>
                  <td><?php echo $event->title; ?><span class="label label-danger spanlabel">終了</span></td>
                <?php else: ?>
                  <td><?php echo $event->title; ?></td>
                <?php endif; ?>
                <td><?php echo $event->start; ?></td>
                <td><?php echo $event->place; ?></td>
                <td><?php echo $event->name; ?></td>
                <td><a href="<?php echo base_url('event/show/'.$event->id); ?>"class="btn btn-default" href="#" role="button">詳細</a></td>
              </tr>
            <?php endforeach; ?>

          </tbody>
        </table>

        <a href=""><button id="add" class="btn btn-primary">イベント登録</button></a>
      </div>
    </div>
  </div>
</div>
