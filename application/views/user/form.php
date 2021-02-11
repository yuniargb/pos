<?php $this->load->view('element/head');?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" xmlns="http://www.w3.org/1999/html">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      User Management Form
      <small>List User Management</small>
    </h1>
  </section>

  <!-- Main content -->
  <section class="content">

    <div class="row">
      <div class="col-xs-12">
        <ul class="nav nav-tabs">
          <li role="presentation" class="active"><a href="<?php echo site_url('user_management/create');?>">Input User Management</a></li>
          <li role="presentation"><a href="<?php echo site_url('user_management');?>">List User Management</a></li>
        </ul>
        <div class="box box-info">
          <div class="box-header with-border">
            <h3 class="box-title">User Management</h3>
            <?php if($this->session->flashdata('form_false')){?>
              <div class="alert alert-danger text-center">
                <strong><?php echo $this->session->flashdata('form_false');?></strong>
              </div>
            <?php } ?>
          </div>
          <?php if(!empty($user)){?>
            <form class="form-horizontal" method="POST" action="<?php echo site_url('user_management/save').'/'.$user['id'];?>" enctype="multipart/form-data">
            <?php }else{?>
              <form class="form-horizontal" method="POST" action="<?php echo site_url('user_management/save');?>" enctype="multipart/form-data">
              <?php } ?>
              <div class="box-body">
                <div class="col-md-6">
                  <div class="form-group">
                    <label class="col-sm-4 control-label" for="kode">Username</label>
                    <div class="col-sm-8">
                      <input type="text" name="txtUsername" value="<?php echo !empty($user) ? $user['username'] : '';?>" id="txtUsername" class="form-control" autocomplete="off" required placeholder="Username" />
                      <span class="help-inline label label-danger" id="status_kode"></span>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-4 control-label" for="name">Email</label>
                    <div class="col-sm-8">
                      <input type="email" value="<?php echo !empty($user) ? $user['email'] : '';?>" name="txtEmail" placeholder="Your Email" id="txtEmail" class="form-control" required/>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-4 control-label" for="address">Password</label>
                    <div class="col-sm-8">
                      <input type="password" minlength="6" value="" name="txtPassword" placeholder="Your Password" id="txtPassword" class="form-control" required/>
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label class="col-sm-4 control-label" for="date">Photo</label>
                    <div class="col-sm-8">
                      <input type="file" name="file" id="file" class="form-control">
                      <div id="img-display"></div>
                      <?php if(!empty($user) && $user['photo_profile'] != '') { ?>
                        <div id="photoEdit" class="col-md-5" style="padding-left: 0px !important; margin-top: 10px; ">
                          <img id="PhotoID" src="<?php echo prefix_url.$user['photo_profile']; ?>" height="100" width="100%" alt="image" style="border-radius: 5%;">
                        </div>
                      <?php } ?>
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <div class="col-md-4 col-md-offset-4">
                  <a class="btn btn-default" href="<?php echo site_url('user_management');?>">Cancel</a>
                  <button class="btn btn-info" type="submit">Save</button>
                </div>
              </div>
              <!-- /.box-footer -->
            </form>
          </div>
        </div>
        <!-- /.col -->
      </div>
      <!-- row -->
    </section>
    <!-- /.content -->
  </div>

  <style type="text/css">
    .hidden{
      display: none;
    }
  </style>

  <script type="text/javascript">
    window.addEventListener('load', function() {
          document.querySelector('input[type="file"]').addEventListener('change', function() {
              var html='<div class="col-md-5" style="padding-left: 0px !important; margin-top: 10px; "><img id="PhotoID" src="'+URL.createObjectURL(this.files[0])+'" height="100" width="100%" alt="image" style="border-radius: 5%;"></div>';
              $('#img-display').html(html);

              var check = '<?php echo !empty($user) ? $user['photo_profile'] : '';?> ';
              if(check != '')
              {
                var myElement = document.getElementById("photoEdit");
                myElement.classList.add("hidden");
              }
          });
        });
  </script>
  <!-- /.content-wrapper -->
  <?php $this->load->view('element/footer');?>