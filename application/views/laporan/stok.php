<?php $this->load->view('element/head');?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      <?php echo $title; ?>
      <small><?php echo $title; ?></small>
    </h1>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
          <!-- <ul class="nav nav-tabs">
            <li role="presentation" class="active"><a href="#">Laporan Penjualan</a></li>
          </ul> -->
          <div class="box">
            <div class="box-header">
              <h3 class="box-title"><?php echo $title; ?></h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <form action="<?php echo site_url('report/stok?search=true');?>" method="GET">
                <input type="hidden" class="form-control" name="search" value="true"/>
                <div class="box-body pad">
                  <div class="col-md-2">
                    <div class="form-group">
                      <label>Date From</label>
                      <div class="input-group date">
                        <input type="text" class="form-control datepicker-transaksi" name="date_from" value="<?php echo !empty($_GET['date_from']) ? $_GET['date_from'] : date('Y-m-d');?>" autocomplete="off"  />
                      </div>
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <label>Date End</label>
                      <div class="input-group date">
                        <input type="text" class="form-control datepicker-transaksi" name="date_end" value="<?php echo !empty($_GET['date_end']) ? $_GET['date_end'] : date('Y-m-d');?>" autocomplete="off" />
                      </div>
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <label>Product</label>
                      
                      <div class="input-group date">
                        <select class="form-control" id="item" name="item">
                          <?php foreach($produk as $item){?>
                              <option value="<?php echo $item->id;?>" <?php if(!empty($_GET['item']) && $item->id == $_GET['item']) echo 'selected="selected"';?>>
                                <?php echo $item->product_name;?>
                              </option>
                            <?php }?>
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <label for="submit">&nbsp</label>
                      <input type="submit" value="Cari" class="form-control btn btn-primary">
                    </div>
                  </div>
                  <?php if(isset($stok) && is_array($stok)){ ?>
                    <div class="col-md-2">
                      <div class="form-group">
                        <label for="submit">&nbsp</label>
                        <span><a href="<?php echo site_url('report/print_stok/'.$from.'/'.$to.'/'.$items);?>" class="form-control btn btn-primary btnPrint"><i class="fa fa-print"></i> Print</a></span>
                      </div>
                    </div>
                  <?php } ?>
                </div>
              </form>
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>Transaksi ID</th>
                    <th>Cust/Supl</th>
                    <th>Tanggal Transaksi</th>
                    <th>Keterangan</th>
                    <th>Nama Produk</th>
                    <th>Masuk</th>
                    <th>Keluar</th>
                    <th>Sisa</th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                    if(isset($stok) && is_array($stok)){ 
                      $sisa = 0;
                  ?>
                    <?php 
                      foreach($stok as $s){
                      $sisa = $sisa + $s->stok_masuk + $s->stok_keluar;
                    ?>
                      <tr>
                        <td><?php echo $s->transaksi_id;?></td>
                        <td><?php echo $s->customer;?></td>
                        <td><?php echo $s->tgl_transaksi;?></td>
                        <td><?php echo $s->keterangan;?></td>
                        <td><?php echo $s->nama_product;?></td>
                        <td><?php echo $s->stok_masuk;?></td>
                        <td><?php echo $s->stok_keluar;?></td>
                        <td><?php echo $sisa;?></td>
                      </tr>
                    <?php } ?>
                  <?php } ?>
                </tbody>
              </table>
            </div>
            <!-- /.box-body -->
            <div class="text-center">
              <!-- <?php if(isset($stok) && is_array($stok)){ 
                echo $paggination;
              } ?> -->
            </div>
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