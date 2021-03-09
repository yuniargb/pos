<?php $this->load->view('element/head');?>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Transaksi Penjualan Detail
                <small>Detail Transaksi</small>
            </h1>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <ul class="nav nav-tabs">
                        <li role="presentation"><a href="<?php echo site_url('penjualan/create');?>">Input Penjualan</a></li>
                        <li role="presentation" class="active"><a href="<?php echo site_url('penjualan');?>">List Penjualan</a></li>
                    </ul>
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">Data Transaksi Detail <?php echo $details[0]->id;?></h3>
                            <div class="pull-right">
                                <span><a href="<?php echo site_url('penjualan');?>" class="btn btn-sm btn-default">Back</a></span>
                                <?php if($details[0]->status_product == 0) { ?>
                                    <!-- <a onclick="return confirm('do you want to change the status of this product to be taken ?');" href="<?php echo site_url('penjualan/update_status_product').'/'.$details[0]->id;?>" class="btn btn-sm btn-primary"><i class="fa fa-newspaper-o"></i>  Update Status Product</a> -->
                                    <!-- <span><a href="<?php echo site_url('penjualan/cetak_surat_jalan').'/'.$details[0]->id;?>" class="btn btn-sm btn-primary btnPrint"><i class="fa fa-newspaper-o"></i>  Cetak Surat Jalan</a></span> -->

                                <?php } ?>
                                <!-- <span><a href="<?php echo site_url('penjualan/print_now').'/'.$details[0]->id;?>" class="btn btn-sm btn-primary btnPrint"><i class="fa fa-print"></i> Print</a></span> -->
                            </div>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>Transaction ID</th>
                                    <th>Customer Name</th>
                                    <th>Total Item</th>
                                    <th>Total</th>
                                    <th>Metode</th>
                                    <th>Tgl Jatuh Tempo</th>
                                    <th>Date</th>
                                </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><?php echo $details[0]->id;?></td>
                                        <td><?php echo $details[0]->customer_name;?></td>
                                        <td><?php echo $details[0]->total_item;?></td>
                                        <td>Rp<?php echo number_format($details[0]->total_price);?></td>
                                        <td><?php echo $details[0]->is_cash == 1 ? "Cash" : "Credit";?></td>
                                        <td><span class="alert-warning"><?php echo $details[0]->is_cash == 1 ? "" : $details[0]->pay_deadline_date;?></span></td>
                                        <td><?php echo $details[0]->date;?></td>
                                    </tr>
                                </tbody>
                            </table>
                            <hr />
                            <h4>Transaction Data</h4>
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Product Name</th>
                                        <th>Category</th>
                                        <th>Quantity</th>
                                        <th>Price/item</th>
                                        <th>Subtotal</th>
                                        <!-- <th>Aksi</th> -->
                                    </tr>
                                </thead>
                                <tbody>
                                <?php if(isset($details) && is_array($details)){ ?>
                                    <?php foreach($details as $transaksi){?>
                                        <tr>
                                            <td><?php echo $transaksi->product_name;?></td>
                                            <td><?php echo $transaksi->category_name;?></td>
                                            <td><?php echo $transaksi->quantity;?></td>
                                            <td>Rp<?php echo number_format($transaksi->price_item);?></td>
                                            <td>Rp<?php echo number_format($transaksi->subtotal);?></td>
                                            <!-- <td>
                                                <?php if($transaksi->reserv > 0) :  ?>
                                                <button type="button" class="btn btn-primary btn-sm btn-update" data-id="<?= $transaksi->product_id ?>" data-quantity="<?= $transaksi->reserv ?>" data-toggle="modal" data-target="#exampleModal">
                                                Update
                                                </button></td>
                                                <?php endif; ?> -->
                                        </tr>
                                    <?php } ?>
                                <?php } ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th colspan="4" align="center">Total</th>
                                        <th>Rp<?php echo number_format($transaksi->total_price);?></th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <!-- /.box-body -->
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