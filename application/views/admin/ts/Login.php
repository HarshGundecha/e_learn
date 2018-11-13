<?php  
  //include_once("../../controllers/adminControllers/indexCnt.php");
?>
<!DOCTYPE html>
<html>
<head>
  <title></title>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Login Form</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <?php
  include_once("topScripts.php");
  ?>

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body style="background-color:#00695C; margin-top:14em;">
  <section class="content">
    <div class="row">
      <!-- right column -->
      <div class="col-md-4 col-md-offset-4">
        <!-- Horizontal Form -->
        <h1 style="font-size: 2.7em;color: white;text-align: center;">e_learn | Admin Panel</h1>
        <div class="box box-info">
          <div class="box-header with-border">
            <h3 class="box-title">Login Form</h3>
          </div>
          <!-- /.box-header -->
          <!-- form start -->
          <?php
            $this->load->helper('form');
            echo form_open(base_url().'index.php/admin/Login/logme', array('class'=>'form-horizontal', 'id'=>'adminLoginForm'));
          ?>
            <div class="box-body">
              <div class="form-group">
                <label for="userName" class="col-sm-2 control-label">Email</label>

                <div class="col-sm-10">
                  <input name="sEmail" autofocus="" class="form-control" id="sEmail" placeholder="Email">
                </div>
              </div>
              <div class="form-group">
                <label for="password" class="col-sm-2 control-label">Password</label>

                <div class="col-sm-10">
                  <input name="sPassword" type="password" class="form-control" id="sPassword" placeholder="Password">
                </div>
              </div>
            <!-- /.box-body -->
            <div class="box-footer">
              <button name="login" type="submit" class="btn btn-info">Sign in</button>
              <button type="reset" class="btn btn-default pull-right">Reset</button>
            </div>
            <!-- /.box-footer -->
         <?=form_close();?>
        </div>
        <!-- /.box -->
        <!-- general form elements disabled -->

        <!-- /.box -->
      </div>
      <!--/.col (right) -->
    </div>
    <!-- /.row -->
  </section>
  <?php
  include_once("bottomScripts.php");
  ?>
</body>
</html>