<?php $this->load->view('element/head');?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" xmlns="http://www.w3.org/1999/html">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Pengeluaran Biaya Form
      <small>List Pengeluaran Biaya</small>
    </h1>
  </section>

  <!-- Main content -->
  <section class="content">

    <div class="row">
      <div class="col-xs-12">
        <ul class="nav nav-tabs">
          <li role="presentation" class="active"><a href="<?php echo site_url('master_biaya/create_pengeluaran');?>">Input Pengeluaran Biaya</a></li>
          <li role="presentation"><a href="<?php echo site_url('master_biaya/pengeluaran');?>">List Pengeluaran Biaya</a></li>
        </ul>
        <div class="box box-info">
          <div class="box-header with-border">
            <h3 class="box-title">Pengeluaran Biaya</h3>
            <?php if($this->session->flashdata('form_false')){?>
              <div class="alert alert-danger text-center">
                <strong><?php echo $this->session->flashdata('form_false');?></strong>
              </div>
            <?php } ?>
          </div>
          <?php if(!empty($user)){?>
            <form class="form-horizontal" method="POST" action="<?php echo site_url('master_biaya/save_pengeluaran').'/'.$user['id'];?>" enctype="multipart/form-data">
            <?php }else{?>
              <form class="form-horizontal" method="POST" action="<?php echo site_url('master_biaya/save_pengeluaran');?>" enctype="multipart/form-data">
              <?php } ?>
              <div class="box-body">
                <div class="col-md-6">
                  <div class="form-group">
                    <label class="col-sm-4 control-label" for="kode">Tanggal Pengeluaran</label>
                    <div class="col-sm-8">
                      <input type="Date" name="txtTanggal" value="<?php echo !empty($user) ? $user['tanggal'] : '';?>" id="txtTanggal" class="form-control" autocomplete="off" required placeholder="Tanggal Pengeluaran" />
                      <span class="help-inline label label-danger" id="status_kode"></span>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-4 control-label" for="name">Nama Akun</label>
                    <div class="col-sm-8">
                      <select name="txtAkun" class="form-control">
                        <?php for ($i=0; $i < count($akun_biaya); $i++) { ?>
                            <option value="<?php echo $akun_biaya[$i]->id; ?>"><?php echo $akun_biaya[$i]->code .' - '. $akun_biaya[$i]->name; ?></option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-4 control-label" for="address">Jumlah</label>
                    <div class="col-sm-8">
                       <input type="number" minlength="0" name="txtJumlah" value="<?php echo !empty($user) ? $user['jumlah'] : '0';?>" id="txtJumlah" class="form-control" autocomplete="off" />
                    </div>
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group">
                    <label class="col-sm-2 control-label" for="address">Keterangan</label>
                    <div class="col-sm-10">
                       <textarea id="txtKeterangan" name="txtKeterangan" class="form-controll" rows="6" cols="100"></textarea>
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