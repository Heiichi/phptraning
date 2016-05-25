<h1>イベント詳細</h1>

<table class="table">

	<tbody>
		<?php foreach ($event as $value) :?>

		<tr>
			<th>タイトル</th>
			<td><?php echo $value->title; ?></td>
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
<input class="btn btn-primary" type="submit" name="cancel" value="一覧に戻る">

<?php if(!$participate): ?>
		<input class="btn btn-success" type="submit" name="save" value="参加する">
<?php else:?>
		<input class="btn btn-success" type="submit" value="参加を取り消す">
<?php endif; ?>

<?php foreach ($user as $u) :?>
	<?php if($u->name === "admin" || $u->registered_by === $value->registered_by ): ?>
		<input class="btn btn-default" type="submit" value="編集">
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
