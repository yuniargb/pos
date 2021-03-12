<aside class="main-sidebar">
  <section class="sidebar">
    <div class="user-panel">
      <div class="pull-left image">
        <img src="<?php echo prefix_url.$users[0]['photo_profile'];?>" class="img-circle" alt="User Image">
      </div>
      <div class="pull-left info">
        <p><?php echo $this->username;?></p>
        <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
      </div>
    </div>
    <form action="#" method="get" class="sidebar-form">
    </form>
    <ul class="sidebar-menu">
      <?php 
      $Access_page = $this->user_model->get_status_access($this->session->userdata('id'), 'Home'); 
      if(count($Access_page) > 0){
      if($Access_page[0]['status_access'] == "1")
        { ?>
          <li class="<?php echo is_menu('home','dashboard');?>"><a href="<?php echo site_url();?>"><i class="fa fa-dashboard" aria-hidden="true"></i> <span>Dashboard</span></a></li>
        <?php  } } ?>
        
        <?php 
        $Supplier = $this->user_model->get_status_access($this->session->userdata('id'), 'Supplier'); 
        if(count($Supplier) > 0){
          if($Supplier[0]['status_access'] == "1")
            { ?>
              <li class="treeview <?php echo is_menu('supplier');?>">
                <a href="#"><i class="fa fa-users"></i> <span>Supplier</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu"> 
                 <li class="<?php echo is_menu('supplier');?>"><a href="<?php echo site_url('supplier');?>"><i class="fa fa-users" aria-hidden="true"></i> <span>List Supplier</span></a></li>
                 <li class="<?php echo is_menu('supplier','create');?>"><a href="<?php echo site_url('supplier/create');?>"><i class="fa fa-plus-square-o" aria-hidden="true"></i> <span>Add Supplier</span></a></li>
               </ul>
             </li>
         <?php  } } ?>
            

         <?php 
         $Supplier = $this->user_model->get_status_access($this->session->userdata('id'), 'Pelanggan');
         if(count($Supplier) > 0){ 
         if($Supplier[0]['status_access'] == "1")
          { ?>
           <li class="treeview <?php echo is_menu('pelanggan');?>">
            <a href="#"><i class="fa fa-user"></i> <span>Pelanggan</span> <i class="fa fa-angle-left pull-right"></i></a>
            <ul class="treeview-menu">
              <li class="<?php echo is_menu('pelanggan');?>"><a href="<?php echo site_url('pelanggan');?>"><i class="fa fa-user" aria-hidden="true"></i> <span>List Pelanggan</span></a></li>
              <li class="<?php echo is_menu('pelanggan','create');?>"><a href="<?php echo site_url('pelanggan/create');?>"><i class="fa fa-plus-square-o" aria-hidden="true"></i> <span>Add Pelanggan</span></a></li>
            </ul>
          </li>
        <?php  } } ?>

        <?php 
        $Access_page = $this->user_model->get_status_access($this->session->userdata('id'), 'Kategori'); 
        if(count($Access_page) > 0){
        if($Access_page[0]['status_access'] == "1")
          { ?>
            <li class="treeview <?php echo is_menu('kategori');?>">
              <a href="#"><i class="fa fa-th-large"></i> <span>Kategori</span> <i class="fa fa-angle-left pull-right"></i></a>
              <ul class="treeview-menu">
                <li class="<?php echo is_menu('kategori');?>"><a href="<?php echo site_url('kategori');?>"><i class="fa fa-th-large" aria-hidden="true"></i> <span>List Kategori</span></a></li>
                <li class="<?php echo is_menu('kategori','create');?>"><a href="<?php echo site_url('kategori/create');?>"><i class="fa fa-plus-square-o" aria-hidden="true"></i> <span>Add Kategori</span></a></li>
              </ul>
            </li>
          <?php  } } ?>

          <?php 
          $Access_page = $this->user_model->get_status_access($this->session->userdata('id'), 'Produk'); 
          if(count($Access_page) > 0){
          if($Access_page[0]['status_access'] == "1")
            { ?>
              <li class="treeview <?php echo is_menu('produk');?>">
                <a href="#"><i class="fa fa-shopping-cart"></i> <span>Produk</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                  <li class="<?php echo is_menu('produk');?>"><a href="<?php echo site_url('produk');?>"><i class="fa fa-shopping-cart" aria-hidden="true"></i> <span>List Produk</span></a></li>
                  <li class="<?php echo is_menu('produk','create');?>"><a href="<?php echo site_url('produk/create');?>"><i class="fa fa-plus-square-o" aria-hidden="true"></i> <span>Add Produk</span></a></li>
                </ul>
              </li>
            <?php  } } ?>

            <?php 
            $Access_page = $this->user_model->get_status_access($this->session->userdata('id'), 'Transaksi Pembelian'); 
            if(count($Access_page) > 0){
            if($Access_page[0]['status_access'] == "1")
              { ?>
                <li class="treeview <?php echo is_menu('transaksi');?>">
                  <a href="#"><i class="fa fa-cart-plus"></i> <span>Transaksi Pembelian</span> <i class="fa fa-angle-left pull-right"></i></a>
                  <ul class="treeview-menu"> 
                   <li class="<?php echo is_menu('transaksi');?>"><a href="<?php echo site_url('transaksi');?>"><i class="fa fa-area-chart" aria-hidden="true"></i> <span>List Transaksi</span></a></li>
                   <li class="<?php echo is_menu('transaksi','create');?>"><a href="<?php echo site_url('transaksi/create');?>"><i class="fa fa-plus-square-o" aria-hidden="true"></i> <span>Add Transaction</span></a></li>
                 </ul>
               </li>
             <?php  } } ?>

             <?php 
             $Access_page = $this->user_model->get_status_access($this->session->userdata('id'), 'Transaksi Penjualan'); 
             if(count($Access_page) > 0){
             if($Access_page[0]['status_access'] == "1")
              { ?>
               <li class="treeview <?php echo is_menu('penjualan');?>">
                <a href="#"><i class="fa fa-cart-plus"></i> <span>Transaksi Penjualan</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                  <li class="<?php echo is_menu('penjualan');?>"><a href="<?php echo site_url('penjualan');?>"><i class="fa fa-area-chart" aria-hidden="true"></i> <span>List Penjualan</span></a></li>
                  <li class="<?php echo is_menu('penjualan','create');?>"><a href="<?php echo site_url('penjualan/create');?>"><i class="fa fa-plus-square-o" aria-hidden="true"></i> <span>Add Penjualan</span></a></li>
                </ul>
              </li>
            <?php  } } ?>

            <?php 
             $Access_page = $this->user_model->get_status_access($this->session->userdata('id'), 'Stok Konsumen'); 
             if(count($Access_page) > 0){
             if($Access_page[0]['status_access'] == "1")
              { ?>
               <li class="treeview <?php echo is_menu('stok_konsumen');?>">
                <a href="#"><i class="fa fa-cart-plus"></i> <span>Stok Konsumen</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                  <li class="<?php echo is_menu('stok_konsumen');?>"><a href="<?php echo site_url('stok_konsumen');?>"><i class="fa fa-area-chart" aria-hidden="true"></i> <span>List Stok Konsumen</span></a></li>
                  <li class="<?php echo is_menu('stok_konsumen','surat_jalan');?>"><a href="<?php echo site_url('stok_konsumen/surat_jalan');?>"><i class="fa fa-area-chart" aria-hidden="true"></i> <span>List Surat Jalan</span></a></li>
                  <li class="<?php echo is_menu('stok_konsumen','create');?>"><a href="<?php echo site_url('stok_konsumen/create');?>"><i class="fa fa-plus-square-o" aria-hidden="true"></i> <span>Add Surat Jalan</span></a></li>
                </ul>
              </li>
            <?php  } } ?>

            <?php 
            $Access_page = $this->user_model->get_status_access($this->session->userdata('id'), 'Tunggakan'); 
            if(count($Access_page) > 0){
            if($Access_page[0]['status_access'] == "1")
              { ?>
                <li class="<?php echo is_menu('tunggakan');?>"><a href="<?php echo site_url('tunggakan');?>"><i class="fa fa-money" aria-hidden="true"></i> <span>List Tunggakan</span></a></li>
              <?php  } } ?>

                <?php 
            $Access_page = $this->user_model->get_status_access($this->session->userdata('id'), 'Retur Penjualan'); 
            if(count($Access_page) > 0){
            if($Access_page[0]['status_access'] == "1")
              { ?>
                <li class="treeview <?php echo is_menu('retur_penjualan');?>">
                  <a href="#"><i class="fa fa-random"></i> <span>Retur Penjualan</span> <i class="fa fa-angle-left pull-right"></i></a>
                  <ul class="treeview-menu">
                    <li class="<?php echo is_menu('retur_penjualan');?>"><a href="<?php echo site_url('retur_penjualan');?>"><i class="fa fa-random" aria-hidden="true"></i> <span>List Retur Penjualan</span></a></li>
                    <li class="<?php echo is_menu('retur_penjualan','create');?>"><a href="<?php echo site_url('retur_penjualan/create');?>"><i class="fa fa-plus-square-o" aria-hidden="true"></i> <span>Add Retur Penjualan</span></a></li>
                  </ul>
                </li>
              <?php  } } ?>

              <?php 
              $Access_page = $this->user_model->get_status_access($this->session->userdata('id'), 'Retur Purhcase'); 
              if(count($Access_page) > 0){
              if($Access_page[0]['status_access'] == "1")
                { ?>
                  <li class="treeview <?php echo is_menu('retur_purchase');?>">
                    <a href="#"><i class="fa fa-share"></i> <span>Retur Purhcase</span> <i class="fa fa-angle-left pull-right"></i></a>
                    <ul class="treeview-menu">
                      <li class="<?php echo is_menu('retur_purchase');?>"><a href="<?php echo site_url('retur_purchase');?>"><i class="fa fa-share" aria-hidden="true"></i> <span>List Retur Purchase</span></a></li>
                      <li class="<?php echo is_menu('retur_purchase','create');?>"><a href="<?php echo site_url('retur_purchase/create');?>"><i class="fa fa-plus-square-o" aria-hidden="true"></i> <span>Add Retur Purchase</span></a></li>
                    </ul>
                  </li>
                <?php  } } ?>

                <?php 
                $Access_page = $this->user_model->get_status_access($this->session->userdata('id'), 'User Management'); 
                if(count($Access_page) > 0 || $this->session->userdata('username') == 'admin'){
                  if($this->session->userdata('username') == 'admin'){
                    $Access_page[0]['status_access'] = 1;
                  }
                if($Access_page[0]['status_access'] == "1")
                  { ?>
                    <li class="treeview <?php echo is_menu('user_management');?>">
                      <a href="#"><i class="fa fa-share"></i> <span>User Management</span> <i class="fa fa-angle-left pull-right"></i></a>
                      <ul class="treeview-menu">
                        <li class="<?php echo is_menu('user_management');?>"><a href="<?php echo site_url('user_management');?>"><i class="fa fa-share" aria-hidden="true"></i> <span>List User Management</span></a></li>
                        <li class="<?php echo is_menu('user_management','create');?>"><a href="<?php echo site_url('user_management/create');?>"><i class="fa fa-plus-square-o" aria-hidden="true"></i> <span>Add User Management</span></a></li>
                        <!-- <li class="<?php echo is_menu('user_management','access');?>"><a href="<?php echo site_url('user_management/access');?>"><i class="fa fa-plus-square-o" aria-hidden="true"></i> <span>Control Access User</span></a></li> -->
                      </ul>
                    </li>
                  <?php  } } ?>

                  <?php 
                  $Access_page = $this->user_model->get_status_access($this->session->userdata('id'), 'Master Biaya'); 
                  if(count($Access_page) > 0){
                  if($Access_page[0]['status_access'] == "1")
                  { ?>
                    <li class="treeview <?php echo is_menu('master_biaya');?>">
                      <a href="#"><i class="fa fa-share"></i> <span>Master Biaya</span> <i class="fa fa-angle-left pull-right"></i></a>
                      <ul class="treeview-menu">
                        <li class="treeview">
                          <a href="#"><i class="fa fa-share"></i> <span>Akun Biaya</span> <i class="fa fa-angle-left pull-right"></i></a>
                          <ul class="treeview-menu">
                            <li class="<?php echo is_menu('master_biaya');?>"><a href="<?php echo site_url('master_biaya');?>"><i class="fa fa-share" aria-hidden="true"></i> <span>List Akun Biaya</span></a></li>
                            <li class="<?php echo is_menu('master_biaya','create');?>"><a href="<?php echo site_url('master_biaya/create');?>"><i class="fa fa-plus-square-o" aria-hidden="true"></i> <span>Add Akun Biaya</span></a></li>
                          </ul>
                        </li>
                        <li class="treeview">
                          <a href="#"><i class="fa fa-share"></i> <span>Pengeluaran Biaya</span> <i class="fa fa-angle-left pull-right"></i></a>
                          <ul class="treeview-menu">
                            <li class="<?php echo is_menu('master_biaya', 'pengeluaran');?>"><a href="<?php echo site_url('master_biaya/pengeluaran');?>"><i class="fa fa-share" aria-hidden="true"></i> <span>List Pengeluaran Biaya</span></a></li>
                            <li class="<?php echo is_menu('master_biaya','create');?>"><a href="<?php echo site_url('master_biaya/create_pengeluaran');?>"><i class="fa fa-plus-square-o" aria-hidden="true"></i> <span>Add Pengeluaran Biaya</span></a></li>
                          </ul>
                        </li>
                      </ul>
                    </li>
                  <?php  } } ?>

                  <?php 
                  $Access_page = $this->user_model->get_status_access($this->session->userdata('id'), 'Stock Opname'); 
                  if(count($Access_page) > 0){
                  if($Access_page[0]['status_access'] == "1")
                    { ?>
                  <li class="treeview <?php echo is_menu('stock_opname');?>">
                      <a href="#"><i class="fa fa-share"></i> <span>Stock Opname</span> <i class="fa fa-angle-left pull-right"></i></a>
                      <ul class="treeview-menu">
                        <li class="<?php echo is_menu('stock_opname');?>"><a href="<?php echo site_url('stock_opname');?>"><i class="fa fa-share" aria-hidden="true"></i> <span>List Stock Opname</span></a></li>
                        <li class="<?php echo is_menu('stock_opname','create');?>"><a href="<?php echo site_url('stock_opname/create');?>"><i class="fa fa-plus-square-o" aria-hidden="true"></i> <span>Add Stock Opname</span></a></li>
                      </ul>
                    </li>
                    <?php  } } ?>

                    <?php 
                  $Access_page = $this->user_model->get_status_access($this->session->userdata('id'), 'Laporan'); 
                  if(count($Access_page) > 0){
                  if($Access_page[0]['status_access'] == "1")
                    { ?>
                    <li class="treeview <?php echo is_menu('report');?>">
                      <a href="#"><i class="fa fa-share"></i> <span>Laporan</span> <i class="fa fa-angle-left pull-right"></i></a>
                      <ul class="treeview-menu">
                        <li class="<?php echo is_menu('report', 'perincian_stok');?>"><a href="<?php echo site_url('report/stok');?>"><i class="fa fa-plus-square-o" aria-hidden="true"></i> <span>Laporan Perincian Stok</span></a></li>
                        <li class="<?php echo is_menu('report', 'pendapatan');?>"><a href="<?php echo site_url('report/pendapatan');?>"><i class="fa fa-plus-square-o" aria-hidden="true"></i> <span>Laporan Pendapatan</span></a></li>
                        <li class="<?php echo is_menu('report','detail penjualan');?>"><a href="<?php echo site_url('report/penjualan');?>"><i class="fa fa-plus-square-o" aria-hidden="true"></i> <span>Laporan Detail Penjualan</span></a></li>
                        <li class="<?php echo is_menu('report','pengeluaran');?>"><a href="<?php echo site_url('report/pengeluaran');?>"><i class="fa fa-plus-square-o" aria-hidden="true"></i> <span>Laporan Pengeluaran</span></a></li>
                        <li class="<?php echo is_menu('report','laba_rugi');?>"><a href="<?php echo site_url('report/laba_rugi');?>"><i class="fa fa-plus-square-o" aria-hidden="true"></i> <span>Proyeksi Laba dan Rugi</span></a></li>
                      </ul>
                    </li>
                    <?php  } } ?>
                </ul>
                <br />
                <br />
              </section>
            </aside>
