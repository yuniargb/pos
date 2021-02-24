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
        <ul class="nav nav-tabs">
          <li role="presentation"><a href="<?php echo site_url('report/proyeksi_laba_rugi');?>">Proyeksi Laba Rugi</a></li>
          <li role="presentation" class="active"><a href="<?php echo site_url('report/laba_rugi');?>"><?php echo $title; ?></a></li>
        </ul>

        <div class="box">
          <div class="box-header">
            <h3 class="box-title"><?php echo $title; ?></h3>
          </div>

          <div class="box-body">
            <form action="<?php echo site_url('report/laba_rugi?search=true');?>" method="GET">
              <input type="hidden" class="form-control" name="search" value="true"/>
              <div class="box-body pad">
                <div class="col-md-4">
                  <div class="form-group">
                    <center><label>Dari</label></center>
                    <div class="input-group date">
                      <div class="row">
                        <div class="col-md-6">
                          <select name="txtBulan_from" id="txtBulan_from" class="form-control">
                            <option value="">Select Bulan</option>
                            <option value="1" <?php echo ($search==true) ? ($Bulan_from == 1) ? 'selected' : '' : ''; ?>>Januari</option>
                            <option value="2" <?php echo ($search==true) ? ($Bulan_from == 2) ? 'selected' : '' : ''; ?>>Februari</option>
                            <option value="3" <?php echo ($search==true) ? ($Bulan_from == 3) ? 'selected' : '' : ''; ?>>Maret</option>
                            <option value="4" <?php echo ($search==true) ? ($Bulan_from == 4) ? 'selected' : '' : ''; ?>>April</option>
                            <option value="5" <?php echo ($search==true) ? ($Bulan_from == 5) ? 'selected' : '' : ''; ?>>May</option>
                            <option value="6" <?php echo ($search==true) ? ($Bulan_from == 6) ? 'selected' : '' : ''; ?>>Juni</option>
                            <option value="7" <?php echo ($search==true) ? ($Bulan_from == 7) ? 'selected' : '' : ''; ?>>Juli</option>
                            <option value="8" <?php echo ($search==true) ? ($Bulan_from == 8) ? 'selected' : '' : ''; ?>>Agustus</option>
                            <option value="9" <?php echo ($search==true) ? ($Bulan_from == 9) ? 'selected' : '' : ''; ?>>September</option>
                            <option value="10" <?php echo ($search==true) ? ($Bulan_from == 10) ? 'selected' : '' : ''; ?>>Oktober</option>
                            <option value="11" <?php echo ($search==true) ? ($Bulan_from == 11) ? 'selected' : '' : ''; ?>>November</option>
                            <option value="12" <?php echo ($search==true) ? ($Bulan_from == 12) ? 'selected' : '' : ''; ?>>Desember</option>
                          </select>
                        </div>
                        <div class="col-md-6">
                          <select name="txtTahun_from" id="txtTahun_from" class="form-control">
                            <option value="">Select Tahun</option>
                            <?php
                            $now=date('Y');
                            for ($a=2015; $a<=$now; $a++)
                            { ?>
                              <option value="<?php echo $a; ?>" <?php echo ($search==true) ? ($Tahun_from == $a) ? 'selected' : '' : ''; ?>><?php echo $a; ?></option>
                            <?php }
                            ?>
                          </select>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <center><label>Sampai</label></center>
                    <div class="input-group date">
                      <div class="row">
                        <div class="col-md-6">
                          <select name="txtBulan_to" id="txtBulan_to" class="form-control">
                            <option value="">Select Bulan</option>
                            <option value="1" <?php echo ($search==true) ? ($Bulan_to == 1) ? 'selected' : '' : ''; ?>>Januari</option>
                            <option value="2" <?php echo ($search==true) ? ($Bulan_to == 2) ? 'selected' : '' : ''; ?>>Februari</option>
                            <option value="3" <?php echo ($search==true) ? ($Bulan_to == 3) ? 'selected' : '' : ''; ?>>Maret</option>
                            <option value="4" <?php echo ($search==true) ? ($Bulan_to == 4) ? 'selected' : '' : ''; ?>>April</option>
                            <option value="5" <?php echo ($search==true) ? ($Bulan_to == 5) ? 'selected' : '' : ''; ?>>May</option>
                            <option value="6" <?php echo ($search==true) ? ($Bulan_to == 6) ? 'selected' : '' : ''; ?>>Juni</option>
                            <option value="7" <?php echo ($search==true) ? ($Bulan_to == 7) ? 'selected' : '' : ''; ?>>Juli</option>
                            <option value="8" <?php echo ($search==true) ? ($Bulan_to == 8) ? 'selected' : '' : ''; ?>>Agustus</option>
                            <option value="9" <?php echo ($search==true) ? ($Bulan_to == 9) ? 'selected' : '' : ''; ?>>September</option>
                            <option value="10" <?php echo ($search==true) ? ($Bulan_to == 10) ? 'selected' : '' : ''; ?>>Oktober</option>
                            <option value="11" <?php echo ($search==true) ? ($Bulan_to == 11) ? 'selected' : '' : ''; ?>>November</option>
                            <option value="12" <?php echo ($search==true) ? ($Bulan_to == 12) ? 'selected' : '' : ''; ?>>Desember</option>
                          </select>
                        </div>
                        <div class="col-md-6">
                          <select name="txtTahun_to" id="txtTahun_to" class="form-control">
                            <option value="">Select Tahun</option>
                            <?php
                            $now=date('Y');
                            for ($a=2015; $a<=$now; $a++)
                            { ?>
                              <option value="<?php echo $a; ?>" <?php echo ($search==true) ? ($Tahun_to == $a) ? 'selected' : '' : ''; ?>><?php echo $a; ?></option>
                            <?php }
                            ?>
                          </select>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md-2">
                  <div class="form-group">
                    <label for="submit">&nbsp</label>
                    <input type="submit" value="Cari" class="form-control btn btn-primary">
                  </div>
                </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <label for="submit">&nbsp</label>
                      <?php if ($search==true) { ?>
                        <span><a href="<?php echo site_url('report/print_laporan_laba_rugi/'.$Bulan_from.'/'.$Tahun_from.'/'.$Bulan_to.'/'.$Tahun_to);?>" class="form-control btn btn-primary btnPrint"><i class="fa fa-print"></i> Print</a></span>
                      <?php } else { ?>
                        <span><a href="<?php echo site_url('report/print_laporan_laba_rugi');?>" class="form-control btn btn-primary btnPrint"><i class="fa fa-print"></i> Print</a></span>
                      <?php } ?>
                      
                    </div>
                  </div>
              </div>
            </form>
            <table id="example1" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Bulan</th>
                  <th>Tahun</th>
                  <th>Pendapatan</th>
                  <th>Harga Pokok Penjualan</th>
                  <th>Total Biaya</th>
                  <th>Total Laba Rugi Kotor</th>
                  <th>Total Laba Rugi</th>
                  <th>Keterangan</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php if(isset($labas) && is_array($labas)){ ?>
                  <?php 
                  $no = 1;
                  foreach($labas as $penjualan){?>
                    <tr>
                      <td><?php echo $no; ?></td>
                      <td>
                        <?php if($penjualan->month == 1) {
                          echo "Januari";
                        } else if($penjualan->month == 2) {
                          echo "Februari";
                        } else if($penjualan->month == 3) {
                          echo "Maret";
                        } else if($penjualan->month == 4) {
                          echo "April";
                        } else if($penjualan->month == 5) {
                          echo "Mei";
                        } else if($penjualan->month == 6) {
                          echo "Juni";
                        } else if($penjualan->month == 7) {
                          echo "Juli";
                        } else if($penjualan->month == 8) {
                          echo "Agustus";
                        } else if($penjualan->month == 9) {
                          echo "September";
                        } else if($penjualan->month == 10) {
                          echo "Oktober";
                        } else if($penjualan->month == 11) {
                          echo "November";
                        } else if($penjualan->month == 12) {
                          echo "Desember";
                        } ?>
                      </td>
                      <td><?php echo $penjualan->year;?></td>
                      <td>Rp. <?php echo number_format($penjualan->tot_pendapatan,2,',','.'); ?></td>
                      <td>Rp. <?php echo number_format($penjualan->hpp,2,',','.'); ?></td>
                      <td>Rp. <?php echo number_format($penjualan->tot_biaya,2,',','.'); ?></td>
                      <td>Rp. <?php echo number_format($penjualan->tot_laba_rugi_kotor,2,',','.'); ?></td>
                      <td>Rp. <?php echo number_format($penjualan->tot_laba_rugi,2,',','.'); ?></td>
                      <td style="<?php echo ($penjualan->keterangan == 'Rugi') ? 'color: red;' : 'color:green;'; ?>"><?php echo $penjualan->keterangan; ?></td>
                      <td>
                        <a href="<?php echo site_url('report/edit_proyeksi').'/'.$penjualan->id;?>" class="btn btn-xs btn-primary">Edit</a>
                        <a onclick="return confirm('Are you sure you want to delete this Proyeksi?');" href="<?php echo site_url('report/delete_proyeksi').'/'.$penjualan->id;?>" class="btn btn-xs btn-danger">Delete</a>
                      </td>
                    </tr>
                  <?php $no++; } ?>
                <?php } ?>
              </tbody>
            </table>
          </div>
          <!-- /.box-body -->
          <div class="text-center">
            <?php if(isset($labas) && is_array($labas)){ 
              echo $paggination;
            } ?>
          </div>
          <br>
        </div>

      </div>

    </div>

  </section>

</div>

<?php $this->load->view('element/footer');?>