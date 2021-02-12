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
          <li role="presentation"><a href="<?php echo site_url('user_management/create');?>">Input User Management</a></li>
          <li role="presentation"><a href="<?php echo site_url('user_management');?>">List User Management</a></li>
        </ul>
        <div class="box box-info">
          <div class="box-header with-border">
            <h3 class="box-title">Control Access by <?php echo $username; ?></h3>
            <?php if($this->session->flashdata('form_false')){?>
              <div class="alert alert-danger text-center">
                <strong><?php echo $this->session->flashdata('form_false');?></strong>
              </div>
            <?php } ?>
          </div>
              <form class="form-horizontal" method="POST" action="<?php echo site_url('user_management/save_control/'.$id );?>" enctype="multipart/form-data">
              <div class="box-body">
                <div class="col-md-12">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>Page</th>
                        <th class="textCenter">Access</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php for($i=0; $i < count($Page); $i++){ ?>
                        <tr>
                          <td>
                            <div class="form-control">
                              <?php 
                                if($check_Access){
                                  echo $Page[$i]['page'];
                                } else {
                                  echo $Page[$i];
                                }
                              ?>
                             </div>
                            <input type="text" name="txtPage" class="form-control hidden" value="<?php 
                                if($check_Access){
                                  echo $Page[$i]['page'];
                                } else {
                                  echo $Page[$i];
                                }
                              ?>">
                          </td>
                          <td class="textCenter">
                            <input type="checkbox" id="chkAccess[]" name="chkAccess[]" value="<?php 
                                if($check_Access){
                                  echo $Page[$i]['page'];
                                } else {
                                  echo $Page[$i];
                                }
                              ?>" <?php 
                                if($check_Access){
                                  if($Page[$i]['status_access'] == 1){
                                    echo 'checked';
                                  } else {
                                    echo '';
                                  }
                                } else {
                                  echo '';
                                }
                              ?>>
                          </td>
                        </tr>
                     <?php } ?>
                    </tbody>
                  </table>
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
    .textCenter{
      text-align: center;
    }
    .hidden{display: none;}
    div.form-control{
      border: none !important;
      background: transparent !important;
    }
  </style>
  <!-- /.content-wrapper -->
  <?php $this->load->view('element/footer');?>