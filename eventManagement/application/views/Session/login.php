<script>
$(document).ready(function () {
	$('#form').submit(function(){
		$('<input>').attr({
		    type: 'submit',
		    name: 'login',
		}).appendTo('#form');
	var formData = $('#form').serialize();
});
</script>


<div class="container">
  <div class="panel panel-default">
    <div class="panel-heading">
      event Manager
    </div>
 <?php echo form_open();?>
    <div class="panel-body">
      <div class="row">
        <div class="form-group">
            <div class="col-md-12">
                            <div class="error"><?php echo form_error('login_id','<p>','</p>')?></div>
                    <?php
                        $login_id = array(
                    		'name'        => 'login_id',
                    		'class'       => 'form-control',
                        	'placeholder' => 'ログインID',
                    		'data-error'  => 'ログインIDを入力してください',
                    		'maxlength'   => '50','required');
                    echo form_input($login_id); ?>
              <div class="help-block with-errors"></div>
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-12">
              <div class="error"><?php echo form_error('login_pass','<p>','</p>')?></div>
                    <?php
                        $login_pass = array(
                    		'name'        => 'login_pass',
                    		'class'       => 'form-control',
                        	'placeholder' => 'パスワード',
                    		'data-error'  => 'パスワードを入力してください',
                    		'maxlength'   => '255','required');
                    echo form_password($login_pass); ?>
              <div class="help-block with-errors"></div>
            </div>
        </div>


        <div class="col-md-12">
          <?php
      			  $login = array(
                    		'name'        => 'login',
                    		'value'       => 'ログイン',
      			  			'class'		  => 'btn btn-default btn-primary');
      				  echo form_submit($login);?>
        </div>
      </div>
  </div>
<?php echo form_close();?>
</div>