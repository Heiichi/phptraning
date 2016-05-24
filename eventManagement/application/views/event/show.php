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

	<?php endforeach; ?>
	</tbody>
</table>
<input class="btn btn-primary" type="submit" name="cancel" value="一覧に戻る">
<input class="btn btn-success" type="submit" name="save" value="参加する">
<input class="btn btn-success" type="submit" value="参加を取り消す">
<input class="btn btn-default" type="submit" value="編集">
<input class="btn btn-danger" type="submit" value="削除">
