<?php $this->load->view('element/head');?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" xmlns="http://www.w3.org/1999/html">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Transaksi Surat Jalan Form
        <small>List Surat Jalan</small>
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
	
      <div class="row">
        <div class="col-xs-12">
          <ul class="nav nav-tabs">
            <li role="presentation" class="active"><a href="<?php echo site_url('stok_konsumen/create');?>">Input Surat Jalan</a></li>
            <li role="presentation"><a href="<?php echo site_url('stok_konsumen');?>">List Stok Konsumen</a></li>
            <li role="presentation" ><a href="<?php echo site_url('stok_konsumen/surat_jalan');?>">List Surat Jalan</a></li>
          </ul>
		  <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Stok Konsumen</h3>
              <?php if($this->session->flashdata('form_false')){?>
                <div class="alert alert-danger text-center">
                  <strong><?php echo $this->session->flashdata('form_false');?></strong>
                </div>
              <?php } ?>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <?php if(!empty($penjualan)){?>
            <form id="transaction-form" class="form-horizontal" method="POST" action="<?php echo site_url('stok_konsumen/update').'/'.$penjualan[0]->id;?>">
            <?php }else{?>
            <form id="transaction-form" class="form-horizontal" method="POST" action="<?php echo site_url('stok_konsumen/add_process');?>">
            <?php } ?>
              <div class="box-body">
                <div class="col-md-6">
                  <div class="form-group">
                    <label class="col-sm-4 control-label" for="kode">Kode Surat Jalan</label>
                    <div class="col-sm-8">
                      <input type="text" name="id" value="<?php echo !empty($code_penjualan) ? $code_penjualan : '';?>" class="form-control" disabled/>
                      <input type="hidden" name="pengiriman_id" id="pengiriman_id" value="<?php echo !empty($code_penjualan) ? $code_penjualan : '';?>"/>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-4 control-label" for="category_id">Customer</label>
                    <div class="col-sm-8">
                      <select class="form-control" id="customer_id" name="customer_id">
                        <?php if(isset($customers) && is_array($customers)){?>
                          <?php foreach($customers as $item){?>
                            <option value="<?php echo $item->id;?>" <?php if(!empty($penjualan) && $item->id == $penjualan[0]->custumer_id) echo 'selected="selected"';?>>
                              <?php echo $item->customer_name;?>
                            </option>
                          <?php }?>
                        <?php }?>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label class="col-sm-4 control-label" for="date">Tanggal Kirim</label>
                    <div class="col-sm-8">
                      <input type="date"  id="tanggal_kirim" class="form-control" name="tanggal_kirim"/>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-4 control-label" for="date">Nomor Polisi / Plat</label>
                    <div class="col-sm-8">
                      <input type="text"  id="plat" class="form-control" name="plat"/>
                    </div>
                  </div>
                </div>
                <div class="col-md-11 col-md-offset-1">
                  <h3 class="content-title">Informasi Barang</h3>
                  <div class="content-process">
                    <table class="table">
                      <thead>
                        <tr>
                          <td>Satuan</td>
                          <td>Nama Barang</td>
                          <td>Qty</td>
                          <td>Jumlah</td>
                          <td>Input Barang</td>
                        </tr>
                      </thead>
                      <tbody id="transaksi-item">
                        <tr>
                          <td>
                            <select class="form-control" id="transaksi_category_id" name="category_id">
                              <option value="0">
                                Please select one
                              </option>
                              <?php if(isset($kategoris) && is_array($kategoris)){?>
                                <?php foreach($kategoris as $item){?>
                                  <option value="<?php echo $item->id;?>">
                                    <?php echo $item->category_name;?>
                                  </option>
                                <?php }?>
                              <?php }?>
                            </select>
                          </td>
                          <!--  -->
                          <td>
                            <select class="form-control" id="sj_product_id" name="product_id"></select>
                          </td>
                          <td>
                            <input type="number" id="qty" class="form-control" name="qty" min="0" value="0" readonly/>
                          </td>
                          <td>
                            <input type="number" id="jumlah_kirim" class="form-control" name="jumlah" min="1" value="0"/>
                          </td>
                          <td>
                            <a href="#" class="btn btn-primary" id="tambah-barang-sj">Input Barang</a>
                          </td>
                        </tr>
                        <?php if(!empty($carts) && is_array($carts)){?>
                            <?php foreach($carts['data'] as $k => $cart){?>
                              <tr id="<?php echo $k;?>" class="cart-value">
                                <td><?php echo $cart['category_name'];?></td>
                                <td><?php echo $cart['name'];?></td>
                                <td><?php echo $cart['qty'];?></td>
                                <td>Rp<?php echo number_format($cart['price']);?></td>
                                <td><span class="btn btn-danger btn-sm transaksi-delete-item" data-cart="<?php echo $k;?>">x</span></td>
                              </tr>
                            <?php }?>
                        <?php }?>
                      </tbody>
                      <tfoot>
                        <tr>
                          <td>Total Dikirim</td>
                          <td id="total-pembelian"><?php echo !empty($carts) ? $carts['total_price'] : '';?></td>
                        </tr>
                      </tfoot>
                    </table>
                  </div>
                </div>
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <div class="col-md-3 col-md-offset-4">
                  <a class="btn btn-default" href="<?php echo site_url('penjualan');?>">Cancel</a>
                  <a class="btn btn-info pull-right" href="#" id="submit-transaksi">Submit</a>
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
  <!-- /.content-wrapper -->
<?php $this->load->view('element/footer');?>