<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?php echo $title;?></title>
  <link href="<?php echo base_url('css/bootstrap.min.css'); ?>" rel="stylesheet" type="text/css">
  <link href="<?php echo base_url('css/style.css'); ?>" rel="stylesheet" type="text/css">
  <script src="<?php echo base_url('js/jquery-2.2.3.min.js'); ?>"></script>
  <script src="<?php echo base_url('js/bootstrap.min.js'); ?>"></script>
  <script src="<?php echo base_url('js/validator.js'); ?>"></script>
</head>
<body>
<div class="container">
  <header>
    <nav class="navbar navbar-default">
  	<div class="container-fluid">
  		<div class="navbar-header">
  			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbarEexample7">
  				<span class="sr-only">Toggle navigation</span>
  				<span class="icon-bar"></span>
  				<span class="icon-bar"></span>
  				<span class="icon-bar"></span>
  			</button>
  			<a class="navbar-brand" id="eventmanager">
  				Event Manager
  			</a>
  		</div>

  		<div class="collapse navbar-collapse" id="navbarEexample7">
  			<ul class="nav navbar-nav">
  				<li><a href="<?php echo base_url('event/event_today');  ?>">本日のイベント</a></li>
  				<li><a href="<?php echo base_url('event/index'); ?>">イベント管理</a></li>
          <li><a href="<?php echo base_url('group/index'); ?>">グループ管理</a></li>
          <?php if($_SESSION['type_id'] == 2): ?>
  				  <li><a href="<?php echo base_url('user/index'); ?>">ユーザ管理</a></li>
          <?php endif; ?>
  			</ul>
        <ul class="nav navbar-nav navbar-right">
  				<li class="dropdown">
  					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button">
              <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
              <?php echo $_SESSION['name']; ?><span class="caret"></span></a>
  					<ul class="dropdown-menu" role="menu">
            <?php if($_SESSION['type_id'] == 2): ?>
              <li><a href="<?php echo base_url('post/post'); ?>">連絡事項</a></li>
              <li><a href="<?php echo base_url('post/information'); ?>">お知らせ</a></li>
            <?php else: ?>
              <li><a href="<?php echo base_url('post/information'); ?>">お知らせ</a></li>
            <?php endif; ?>
  						<li><a href="<?php echo base_url('Sessions/logout'); ?>">ログアウト</a></li>
  					</ul>
  				</li>
  			</ul>
  		</div>
  	</div>
  </nav>
</header>
</div>
