<h1>イベント詳細</h1>

<table class="table">

	<tbody>
		<?php foreach ($event as $value) :?>

		<tr>
			<th>タイトル</th>
			<td><?php echo $value->title; ?><?php if($participate): ?><span  class="btn btn-primary">参加</span><?php endif; ?></td>
		</tr>
		<tr>
			<th>開始時間</th>
			<td><?php echo $value->start;?></td>
		</tr>
		<tr>
			<th>終了時間</th>
			<td><?php echo $value->end;?></td>
		</tr>
		<tr>
			<th>場所</th>
			<td><?php echo $value->place;?></td>
		</tr>
		<tr>
			<th>対象グループ</th>
			<td><?php echo $value->g_name;?></td>
		</tr>
    <tr>
      <th>詳細</th>
      <td><?php echo $value->detail;?></td>
    </tr>
    <tr>
      <th>登録者</th>
      <td><?php echo $value->u_name;?></td>
    </tr>
    <tr>
      <th>参加者</th>
      <td>
				<?php foreach ($attends as $san):?>
					<?php echo $san->name;?>
				<?php endforeach; ?>
			</td>
    </tr>


	</tbody>
</table>
<a href="<?php echo base_url('event/'); ?>"><button type="button" class="btn btn-primary" data-dismiss="modal">一覧に戻る</button></a>

<?php echo form_open(); ?>
<?php if(!$participate): ?>
	<span><?php echo form_submit('save','参加する','class="btn btn-success"');?></span>
<?php else:?>
	<span><?php echo form_submit('cancel','参加を取り消す','class="btn btn-success"');?></span>

<?php endif; ?>
<?php echo form_close(); ?>
<?php foreach ($user as $u) :?>
	<?php if($u->name === "admin" || $u->registered_by === $value->registered_by ): ?>
		<a href="<?php echo base_url('event/edit/'. $value->id); ?>"><input class="btn btn-default" type="submit" value="編集"></a>
		<a class="btn btn-default" href="#" role="button" data-toggle="modal" data-target="#myModal">
				削除
		</a>
	<?php endif; ?>

<?php endforeach; ?>



<!-- モーダルウィンドウの中身 -->
<div class="modal fade" id="myModal">
	<div class="modal-dialog">
		<div class="modal-content">

			<div class="modal-body">本当に削除してよろしいですか?</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
				<a href="<?php echo base_url('event/delete/'. $value->id); ?>"><button type="button" class="btn btn-success">OK</button></a>
			 </div>
		</div>
	</div>
</div>
<?php endforeach; ?>
