<?php $this->load->view('element/head');?>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                User Management Index
                <small>List User Management</small>
            </h1>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <ul class="nav nav-tabs">
                        <li role="presentation"><a href="<?php echo site_url('user_management/create');?>">Input User Management</a></li>
                        <li role="presentation" class="active"><a href="<?php echo site_url('user_management');?>">List User Management</a></li>
                    </ul>
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">Data Table User Management</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <form action="<?php echo site_url('user_management?search=true');?>" method="GET">
                                <input type="hidden" class="form-control" name="search" value="true"/>
                                <div class="box-body pad">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="submit">Username</label>
                                            <input type="text" value="" placeholder="Username" name="value" id="value" class="form-control" autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="submit">&nbsp</label>
                                            <input type="submit" value="Cari" class="form-control btn btn-primary">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="submit">&nbsp</label>
                                            <a href="<?php echo site_url('user_management/export_csv').get_uri();?>" class="form-control btn btn-default"><i class="fa fa-file-excel-o"></i> Export Excel</a>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Photo</th>
                                    <th>User Name</th>
                                    <th>Email</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php if(isset($users) && is_array($users)){ ?>
                                    <?php $no=0; foreach($users as $user){ ?>
                                        <tr>
                                            <td><?php echo $no+1;?></td>
                                            <td>
                                                <img src="<?php echo !empty($user->photo_profile) ? prefix_url.$user->photo_profile : prefix_url.'uploads/default/user.png'; ?>" height="100" width="100" alt="image" style="border-radius: 5%;">
                                            </td>
                                            <td><?php echo $user->username;?></td>
                                            <td><?php echo $user->email;?></td>
                                            <td>
                                                <a href="<?php echo site_url('user_management/edit').'/'.$user->id;?>" class="btn btn-xs btn-primary">Edit</a>
                                                <a onclick="return confirm('Are you sure you want to delete this user?');" href="<?php echo site_url('user_management/delete').'/'.$user->id;?>" class="btn btn-xs btn-danger">Delete</a>
                                                <a href="<?php echo site_url('user_management/access').'/'.$user->id;?>" class="btn btn-xs btn-info">Access</a>
                                            </td>
                                        </tr>
                                    <?php $no++; } ?>
                                <?php } ?>
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>No</th>
                                    <th>User Name</th>
                                    <th>Email</th>
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