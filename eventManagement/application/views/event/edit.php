<body>

<!-- ヘッダー-->



<!-- name値 value値 未設定-->
   <div class="col-md-9">
            <!-- form custom style -->
      <h1><strong>イベント編集</strong></h1>

      <form method="post" action="">
                <div class="form-group">
                    <label>タイトル(必須)</label>
                    <input type="text" name="" class="form-control" placeholder="必須">
                </div>

                <div class="form-group">
                    <label>開始日時(必須)</label>
                    <input type="text" name="" class="form-control" placeholder="必須">
                </div>

                <div class="form-group">
                    <label>終了日時</label>
                    <input type="text" name="" class="form-control" placeholder="">
                </div>

                <div class="form-group">
                    <label>場所(必須)</label>
                    <input type="text" name="" class="form-control" placeholder="必須">
                </div>

                <!-- value値未設定 -->
                <div class="form-group">
                    <label>対象グループ</label>
                    <select name="" class="form-control">
                        <option value="">技術部</option>
                        <option value="">総務部</option>
                        <option value="">営業部</option>
                        <option value="">技術部</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>詳細</label>
                    <textarea cols="20" rows="6" class="form-control" rows=3 placeholder="100文字まで。"></textarea>
                </div>

                <button type="submit" class="btn btn-default">キャンセル</button>
                <button type="submit" class="btn btn-primary">保存</button><br>
            </form>
        </div>

</body>
</html>
