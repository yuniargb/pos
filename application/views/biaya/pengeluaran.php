<?php $this->load->view('element/head');?>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Pengeluaran Biaya Index
                <small>List Pengeluaran Biaya</small>
            </h1>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <ul class="nav nav-tabs">
                        <li role="presentation"><a href="<?php echo site_url('master_biaya/create_pengeluaran');?>">Input Pengeluaran Biaya</a></li>
                        <li role="presentation" class="active"><a href="<?php echo site_url('master_biaya/pengeluaran');?>">List Pengeluaran Biaya</a></li>
                    </ul>
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">Data Table Pengeluaran Biaya</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <form action="<?php echo site_url('master_biaya/pengeluaran?search=true');?>" method="GET">
                                <input type="hidden" class="form-control" name="search" value="true"/>
                                <div class="box-body pad">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="submit">Filter by Tanggal</label><br>
                                            <label for="submit">From</label>
                                            <input type="date" value="<?php echo ($search == true) ? $from : ''; ?>" placeholder="from" name="txtFrom" id="txtFrom" class="form-control" autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group"><br>
                                            <label for="submit">To</label>
                                            <input type="date" value="<?php echo ($search == true) ? $to : ''; ?>" placeholder="to" name="txtTo" id="txtTo" class="form-control" autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group"><br>
                                            <label for="submit">&nbsp</label>
                                            <input type="submit" value="Cari Pengeluaran Biaya" class="form-control btn btn-primary">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group"><br>
                                            <label for="submit">&nbsp</label>
                                            <a href="<?php echo site_url('master_biaya/export_pengeluaran_csv').get_uri();?>" class="form-control btn btn-default"><i class="fa fa-file-excel-o"></i> Export Excel</a>
                                        </div>
                                    </div>
                                    <?php if ($search == true) { ?>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <label><b><h4>
                                                    Hasil Pencarian Pengeluaran Biaya Periode 
                                                    <span style="color: red;"><?php echo $from; ?></span> Sampai 
                                                    <span style="color: red;"><?php echo $to; ?></span>
                                                </h4></b>
                                            </label>
                                        </div>
                                    </div>
                                    <?php } ?>
                                </div>
                            </form>
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Tanggal</th>
                                    <th>Kode Akun</th>
                                    <th>Nama Akun</th>
                                    <th>Jumlah</th>
                                    <th>Keterangan</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php if(isset($users_list) && is_array($users_list)){ ?>
                                    <?php $no=0; foreach($users_list as $user){ ?>
                                        <tr>
                                            <td><?php echo $no+1;?></td>
                                            <td><?php echo $user->tanggal;?></td>
                                            <td><?php echo $user->code;?></td>
                                            <td><?php echo $user->name;?></td>
                                            <td><?php echo $user->jumlah; ?></td>
                                            <td><?php echo $user->keterangan; ?></td>
                                            <td>
                                                <a href="<?php echo site_url('master_biaya/edit_pengeluaran').'/'.$user->id;?>" class="btn btn-xs btn-primary">Edit</a>
                                                <a onclick="return confirm('Are you sure you want to delete this user?');" href="<?php echo site_url('master_biaya/delete_pengeluaran').'/'.$user->id;?>" class="btn btn-xs btn-danger">Delete</a>
                                            </td>
                                        </tr>
                                    <?php $no++; } ?>
                                <?php } ?>
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>No</th>
                                    <th>Tanggal</th>
                                    <th>Kode Akun</th>
                                    <th>Nama Akun</th>
                                    <th>Jumlah</th>
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