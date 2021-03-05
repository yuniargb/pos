<?php $this->load->view('element/head');?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Transaksi Surat Jalan
        <small>List Transaksi</small>
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <ul class="nav nav-tabs">
            <li role="presentation"><a href="<?php echo site_url('stok_konsumen/create');?>">Input Surat Jalan</a></li>
            <li role="presentation"><a href="<?php echo site_url('stok_konsumen');?>">List Stok Konsumen</a></li>
            <li role="presentation" class="active"><a href="<?php echo site_url('stok_konsumen/surat_jalan');?>">List Surat Jalan</a></li>  
        </ul>
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Data Table Stok Konsumen</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <form action="<?php echo site_url('stok_konsumen/surat_jalan?search=true');?>" method="GET">
                <input type="hidden" class="form-control" name="search" value="true"/>
                <div class="box-body pad">
                    <div class="col-md-2">
                        <div class="form-group">
                        <label>Date From</label>
                        <div class="input-group date">
                            <input type="text" class="form-control datepicker-transaksi" name="date_from" value="<?php echo !empty($_GET['date_from']) ? $_GET['date_from'] : '';?>"/>
                        </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                        <label>Date End</label>
                        <div class="input-group date">
                            <input type="text" class="form-control datepicker-transaksi" name="date_end" value="<?php echo !empty($_GET['date_end']) ? $_GET['date_end'] : '';?>"/>
                        </div>
                        </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <label for="submit">&nbsp</label>
                      <input type="submit" value="Cari" class="form-control btn btn-primary">
                    </div>
                  </div>
                  <!-- <div class="col-md-2">
                    <div class="form-group">
                      <label for="submit">&nbsp</label>
                      <a href="<?php echo site_url('stok_konsumen/export_csv').get_uri();?>" class="form-control btn btn-default"><i class="fa fa-file-excel-o"></i> Export Excel</a>
                    </div>
                  </div> -->
                </div>
              </form>
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Surat Jalan ID</th>
                  <th>Customer Name</th>
                  <th>Tanggal Dikirim</th>
                  <th>Nomor Plat</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <?php if(isset($penjualans) && is_array($penjualans)){ ?>
                  <?php foreach($penjualans as $penjualan){?>
                    <tr>
                      <td><?php echo $penjualan->id;?></td>
                      <td><?php echo $penjualan->customer_name;?></td>
                      <td><?php echo $penjualan->tanggal_kirim;?></td>
                      <td><?php echo $penjualan->no_plot_truk;?></td>
                      <td>
                        <a href="<?php echo site_url('stok_konsumen/surat_jalan_detail/').'/'.$penjualan->id;?>" class="btn btn-xs btn-default">Detail</a>
                        <a href="<?php echo site_url('stok_konsumen/cetak_surat_jalan').'/'.$penjualan->id;?>" class="btn btn-xs btn-primary btnPrint">Print</a>
                        <a onclick="return confirm('Are you sure you want to delete this penjualan?');" href="<?php echo site_url('stok_konsumen/delete').'/'.$penjualan->id;?>" class="btn btn-xs btn-danger">Delete</a>
                      </td>
                    </tr>
                  <?php } ?>
                <?php } ?>
                </tbody>
              </table>
            </div>
            <!-- /.box-body -->
            <!-- <div class="text-center">
              <?php echo $paggination;?>
            </div> -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
<?php $this->load->view('element/footer');?>