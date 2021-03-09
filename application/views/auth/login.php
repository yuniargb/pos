<?php $this->load->view('element/head');?>
<body class="hold-transition login-page background-custom">
<div class="login-box rounded">
  <!-- /.login-logo -->
  <div class="login-logo ">
    <a href="../../index2.html" class="text-white"><b>Admin</b>POS</a>
  </div>
  <div class="login-box-body">
    <p class="login-box-msg">Sign in untuk memulai aplikasi Point of Sale</p>
	

    
	<form action="<?php echo site_url('auth/login_process');?>" method="post">
      <div class="form-group has-feedback">
        <input type="text" name="username" class="form-control" placeholder="Username">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" name="password" class="form-control" placeholder="Password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-8">
          <div class="checkbox icheck">
            <label>
            <!--  <input type="checkbox" name="remember_me"> Remember Me -->
            </label>
          </div>
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
        </div>
        <!-- /.col -->
      </div>
    </form>
    <marquee behavior="" direction="">selamat datang di aplikasi point of sales, silahkan login terlebih dahulu</marquee>

   <!-- <a href="#">I forgot my password</a><br>
    <a href="register.html" class="text-center">Register a new membership</a>-->

  </div>
  <!-- /.login-box-body -->
</div>
</body>
<?php if($this->session->flashdata('login_false')){?>
	
    <script>
    alertify.error('<?php echo $this->session->flashdata('login_false')?>');
    </script>
	<?php } ?>
  
<?php $this->load->view('element/footer');?>