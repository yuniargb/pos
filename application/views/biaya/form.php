<?php $this->load->view('element/head');?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" xmlns="http://www.w3.org/1999/html">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Akun Biaya Form
      <small>List Akun Biaya</small>
    </h1>
  </section>

  <!-- Main content -->
  <section class="content">

    <div class="row">
      <div class="col-xs-12">
        <ul class="nav nav-tabs">
          <li role="presentation" class="active"><a href="<?php echo site_url('master_biaya/create');?>">Input Akun Biaya</a></li>
          <li role="presentation"><a href="<?php echo site_url('master_biaya');?>">List Akun Biaya</a></li>
        </ul>
        <div class="box box-info">
          <div class="box-header with-border">
            <h3 class="box-title">Akun Biaya</h3>
            <?php if($this->session->flashdata('form_false')){?>
              <div class="alert alert-danger text-center">
                <strong><?php echo $this->session->flashdata('form_false');?></strong>
              </div>
            <?php } ?>
          </div>
          <?php if(!empty($user)){?>
            <form class="form-horizontal" method="POST" action="<?php echo site_url('master_biaya/save_akun').'/'.$user['id'];?>" enctype="multipart/form-data">
            <?php }else{?>
              <form class="form-horizontal" method="POST" action="<?php echo site_url('master_biaya/save_akun');?>" enctype="multipart/form-data">
              <?php } ?>
              <div class="box-body">
                <div class="col-md-6">
                  <div class="form-group">
                    <label class="col-sm-4 control-label" for="kode">Kode Akun</label>
                    <div class="col-sm-8">
                      <input type="text" name="txtexpense_accountname" value="<?php echo !empty($user) ? $user['code'] : '';?>" id="txtexpense_accountname" class="form-control" autocomplete="off" required placeholder="Kode Akun" />
                      <span class="help-inline label label-danger" id="status_kode"></span>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-4 control-label" for="name">Nama Akun</label>
                    <div class="col-sm-8">
                      <input type="text" value="<?php echo !empty($user) ? $user['name'] : '';?>" name="txtEmail" placeholder="Nama Akun" id="txtEmail" class="form-control" required />
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-4 control-label" for="address">Status</label>
                    <div class="col-sm-8">
                      <select name="txtStatus" class="form-control">
                        <option value="0">Active</option>
                        <option value="1">None</option>
                      </select>
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <div class="col-md-4 col-md-offset-4">
                  <a class="btn btn-default" href="<?php echo site_url('master_biaya');?>">Cancel</a>
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

  <?php $this->load->view('element/footer');?>