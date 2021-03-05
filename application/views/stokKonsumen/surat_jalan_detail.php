<?php $this->load->view('element/head');?>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Surat Jalan Detail
                <small>Detail Transaksi</small>
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
                            <h3 class="box-title">Data Surat Jalan Detail <?php echo $details[0]->id;?></h3>
                            <div class="pull-right">
                                <span><a href="<?php echo site_url('stok_konsumen/surat_jalan');?>" class="btn btn-sm btn-default">Back</a></span>
                               </div>
                        </div>
                        <div class="container">
                            <dl class="row">
                                <dt class="col-sm-3">Customer Name</dt>
                                <dd class="col-sm-9"><?= $details[0]->customer_name;?></dd>

                            </dl>
                            <dl class="row">
                                <dt class="col-sm-3">Tanggal Kirim</dt>
                                <dd class="col-sm-9"><?= $details[0]->tanggal_kirim;?></dd>

                            </dl>
                            <dl class="row">
                                <dt class="col-sm-3">Customer Name</dt>
                                <dd class="col-sm-9"><?= $details[0]->no_plot_truk;?></dd>

                            </dl>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <h4>Transaction Data</h4>
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Product Name</th>
                                        <th>Quantity</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php if(isset($details) && is_array($details)){ ?>
                                    <?php foreach($details as $transaksi){?>
                                        <tr>
                                            <td><?php echo $transaksi->product_name;?></td>
                                            <td><?php echo $transaksi->qty;?></td>
                                        </tr>
                                    <?php } ?>
                                <?php } ?>
                                </tbody>
                            </table>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.col -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Update Jumlah Yang Dikirim</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form id="transaction-form" class="form-horizontal" method="POST" action="<?php echo site_url('penjualan/updatepesanan').'/'.$details[0]->id;?>">
            <div class="modal-body">
                <div class="container-fluid">
                <div class="form-group">
                    <label class="control-label" for="jumlah">Jumlah</label>
                    <input type="number" id="jumlah-quanty" class="form-control" name="jumlah" min="1" value="0"/>
                    <input type="hidden" name="item_id"  id="item_id" class="form-control"/>
                </div>
                </div>
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
        </form>
        </div>
    </div>
    </div>
<?php $this->load->view('element/footer');?>