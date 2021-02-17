<?php $this->load->view('element/head');?>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Stock Opname Index
                <small>List Stock Opname</small>
            </h1>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <ul class="nav nav-tabs">
                        <li role="presentation"><a href="<?php echo site_url('stock_opname/create');?>">Input Stock Opname</a></li>
                        <li role="presentation" class="active"><a href="<?php echo site_url('stock_opname');?>">List Stock Opname</a></li>
                    </ul>
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">Data Table Stock Opname</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <form action="<?php echo site_url('stock_opname?search=true');?>" method="GET">
                                <input type="hidden" class="form-control" name="search" value="true"/>
                                <div class="box-body pad">
        
                                    <!-- <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="submit">&nbsp</label>
                                            <input type="submit" value="Cari" class="form-control btn btn-primary">
                                        </div>
                                    </div> -->
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="submit">&nbsp</label>
                                            <a href="<?php echo site_url('stock_opname/export_csv').get_uri();?>" class="form-control btn btn-default"><i class="fa fa-file-excel-o"></i> Export Excel</a>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Product Name</th>
                                    <th>Category</th>
                                    <th>Product Desc.</th>
                                    <th>Product QTY (now)</th>
                                    <th>Product QTY (before)</th>
                                    <th>Tanggal Opname</th>
                                    <th>Selisih Stock</th>
                                    <th>Keterangan</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php if(isset($kategoris) && is_array($kategoris)){ ?>
                                    <?php for($i=0; $i < count($kategoris); $i++) { ?>
                                        <tr>
                                            <td><?php echo $i+1;?></td>
                                            <td><?php echo $kategoris[$i]->product_name;?></td>
                                            <td><?php echo $kategoris[$i]->category_name;?></td>
                                            <td><?php echo $kategoris[$i]->product_desc;?></td>
                                            <td><?php echo $kategoris[$i]->product_qty;?></td>
                                            <td><?php echo ($kategoris[$i]->product_qty + $kategoris[$i]->selisih_stock);?></td>
                                            <td><?php echo $kategoris[$i]->tanggal;?></td>
                                            <td><?php echo $kategoris[$i]->selisih_stock;?></td>
                                            <td><?php echo $kategoris[$i]->keterangan;?></td>
                                            <td>
                                                <a href="<?php echo site_url('stock_opname/edit').'/'.$kategoris[$i]->id;?>" class="btn btn-xs btn-primary">Edit</a>
                                                <a onclick="return confirm('Are you sure you want to delete this Stock Opname?');" href="<?php echo site_url('stock_opname/delete').'/'.$kategoris[$i]->id;?>" class="btn btn-xs btn-danger">Delete</a>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                <?php } ?>
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>No</th>
                                    <th>Product Name</th>
                                    <th>Category</th>
                                    <th>Product Desc.</th>
                                    <th>Product QTY</th>
                                    <th>Tanggal Opname</th>
                                    <th>Selisih Stock</th>
                                    <th>Keterangan</th>
                                    <th>Action</th>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                        <!-- /.box-body -->
                        <div class="text-center">
                            <?php echo $paggination;?>
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