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
          <div class="box">
            <div class="box-header">
              <h3 class="box-title"><?php echo $title; ?></h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <form action="<?php echo site_url('report/pendapatan?search=true');?>" method="GET">
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
                      <label for="submit">&nbsp</label>
                      <input type="submit" value="Cari" class="form-control btn btn-primary">
                    </div>
                  </div>
                  <?php if(isset($penjualans) && is_array($penjualans)){ ?>
                    <div class="col-md-2">
                      <div class="form-group">
                        <label for="submit">&nbsp</label>
                        <span><a href="<?php echo site_url('report/print_pendapatan/'.$from.'/'.$to);?>" class="form-control btn btn-primary btnPrint"><i class="fa fa-print"></i> Print</a></span>
                      </div>
                    </div>
                  <?php } ?>
                </div>
              </form>
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>Tanggal Transaksi</th>
                    <th>Total Transaksi</th>
                    <th>Total Piutang</th>
                    <th>Total Penerimaan Piutang</th>
                    <th>Total Hutang</th>
                    <th>Total Penerimaan Hutang</th>
                    <th>Keuntungan</th>
                    <th>Pengeluaran</th>
                  </tr>
                </thead>
                <tbody>
                  <?php if(isset($penjualans) && is_array($penjualans)){ 
                    $total = 0;
                  ?>
                    <?php 
                    foreach($penjualans as $penjualan){
                    $total += $penjualan->total_keuntungan - $penjualan->total_pengeluaran;
                    ?>
                      <tr>
                        <td><?php echo $penjualan->date;?></td>
                        <td><?php echo $penjualan->jumlah_transaksi;?></td>
                        <td><?php echo number_format($penjualan->total_piutang,2,',','.');?></td>
                        <td><?php echo number_format($penjualan->total_penerimaan_piutang,2,',','.');?></td>
                        <td><?php echo number_format($penjualan->total_hutang,2,',','.');?></td>
                        <td><?php echo number_format($penjualan->total_pembayaran_hutang,2,',','.');?></td>
                        <td><?php echo number_format($penjualan->total_keuntungan,2,',','.');?></td>
                        <td><?php echo number_format($penjualan->total_pengeluaran,2,',','.');?></td>
                      </tr>
                    <?php } ?>
                  <?php } ?>
                </tbody>
              </table>
            </div>
            <!-- /.box-body -->
            <div class="text-center">
              <?php if(isset($penjualans) && is_array($penjualans)){ 
                echo $paggination;
              } ?>
            </div>
            <br>
            <?php if(isset($penjualans) && is_array($penjualans)){ ?>
            <div class="row">
              <div class="col-md-8"></div>
              <div class="col-md-4">
                <div class="row">
                  <div class="col-md-6">
                    <b>Jumlah Pendapatan  :</b>
                  </div>
                  <div class="col-md-6">
                    Rp. <?php echo number_format($total,2,',','.'); ?>
                  </div>
                </div>
              </div>
            </div><br>
            <?php } ?>

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