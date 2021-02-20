<?php $this->load->view('element/head');?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" xmlns="http://www.w3.org/1999/html">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Stock Opname Form
        <small>List Stock Opname</small>
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
	
      <div class="row">
        <div class="col-xs-12">
          <ul class="nav nav-tabs">
            <li role="presentation" class="active"><a href="<?php echo site_url('stock_opname/create');?>">Input Stock Opname</a></li>
            <li role="presentation"><a href="<?php echo site_url('stock_opname');?>">List Stock Opname</a></li>
          </ul>
		  <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Stock Opname</h3>
              <?php if($this->session->flashdata('form_false')){?>
                <div class="alert alert-danger text-center">
                  <strong><?php echo $this->session->flashdata('form_false');?></strong>
                </div>
              <?php } ?>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <?php if(!empty($kategori)){ ?>
            <form class="form-horizontal" method="POST" action="<?php echo site_url('stock_opname/save').'/'.$kategori[0]->id;?>">
            <?php }else{?>
            <form class="form-horizontal" method="POST" action="<?php echo site_url('stock_opname/save');?>">
            <?php } ?>
              <div class="box-body">
                <div class="col-md-6">
                  <div class="form-group">
                    <label class="col-sm-4 control-label" for="kode">Tanggal Stock Opname</label>
                    <div class="col-sm-8">
                      <input type="Date" name="txtTanggal" value="<?php echo !empty($kategori) ? $kategori[0]->tanggal : date('Y-m-d'); ?>" id="txtTanggal" class="form-control" autocomplete="off" required placeholder="Tanggal Pengeluaran" />
                      <span class="help-inline label label-danger" id="status_kode"></span>
                    </div>
                  </div>
                  <div class="form-group">
                    <center><a class="btn btn-info" href="#" data-target="#myModal" data-toggle="modal" data-backdrop="static" data-keyboard="false">Get Product</a></center>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-4 control-label" for="name">Product Name</label>
                    <div class="col-sm-8">
                      <input type="text" name="txtProductName" placeholder="Product Name" id="txtProductName" class="form-control" value="<?php echo !empty($kategori) ? $kategori[0]->product_name : ''; ?>" disabled />
                      <input type="text" name="txtProductID" id="txtProductID" class="form-control hidden"
                      value="<?php echo !empty($kategori) ? $kategori[0]->product_id : ''; ?>" />
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-4 control-label" for="name">Category</label>
                    <div class="col-sm-8">
                      <input type="text" value="<?php echo !empty($kategori) ? $kategori[0]->category_name : ''; ?>" name="txtCategory" placeholder="Category Name" id="txtCategory" class="form-control" disabled />
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-4 control-label" for="name">Product Desc.</label>
                    <div class="col-sm-8">
                      <input type="text" value="<?php echo !empty($kategori) ? $kategori[0]->product_desc : ''; ?>" name="txtProductDesc" placeholder="Product Desc." id="txtProductDesc" class="form-control" disabled />
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-4 control-label" for="name">Product QTY</label>
                    <div class="col-sm-8">
                      <input type="text" value="<?php echo !empty($kategori) ? $kategori[0]->product_qty : ''; ?>" name="txtProductQty" placeholder="Product QTY" id="txtProductQty" class="form-control" disabled />
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <?php if(!empty($kategori)){ ?>
                    <div class="form-group">
                      <label class="col-sm-4 control-label" for="name">Stock sebelumnya</label>
                      <div class="col-sm-8">
                         <input type="text" value="<?php echo ($kategori[0]->stock_fisik + $kategori[0]->selisih_stock); ?>" name="txtStockBefore_disable" placeholder="Stock Fisik" id="txtStockBefore_disable" class="form-control" disabled/>
                        <input type="text" value="<?php echo ($kategori[0]->stock_fisik + $kategori[0]->selisih_stock); ?>" name="txtStockBefore" placeholder="Stock Fisik" id="txtStockBefore" class="form-control hidden"/>
                      </div>
                    </div>
                  <?php } ?>

                  <div class="form-group">
                    <label class="col-sm-4 control-label" for="name">Stock Fisik</label>
                    <div class="col-sm-8">
                      <input type="number" value="<?php echo !empty($kategori) ? $kategori[0]->stock_fisik : ''; ?>" name="txtStockFisik" placeholder="Stock Fisik" id="txtStockFisik" class="form-control" onchange="myFunction(this.value)" autocomplete="off" required />
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-4 control-label" for="name">Selisih</label>
                    <div class="col-sm-8">
                      <input type="text" value="<?php echo !empty($kategori) ? $kategori[0]->selisih_stock : ''; ?>" name="txtSelisih_disable" placeholder="Selisih" id="txtSelisih_disable" class="form-control" disabled />
                      <input type="text" value="<?php echo !empty($kategori) ? $kategori[0]->selisih_stock : ''; ?>" name="txtSelisih" placeholder="Selisih" id="txtSelisih" class="form-control hidden" />
                      <p style="font-size: 10px;"><i>Note : minus (-) bearti barang di gudang melebihi inputan system.</i></p>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-4 control-label" for="address">Keterangan</label>
                    <div class="col-sm-8">
                      <textarea name="category_desc" placeholder="Description" id="desc" class="form-control"/><?php echo !empty($kategori) ? $kategori[0]->keterangan : ''; ?></textarea>
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <div class="col-md-3 col-md-offset-4">
                  <a class="btn btn-default" href="<?php echo site_url('kategori');?>">Cancel</a>
                  <button class="btn btn-info pull-right" type="submit">Save</button>
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

  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <center><h4 class="modal-title">Choose Product</h4></center>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-md-12">
              <table id="productID" class="display" cellspacing="0" width="100%">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Product Name</th>
                    <th>Category</th>
                    <th>Product Desc.</th>
                    <th>Product QTY</th>
                  </tr>
                </thead>
                <tfoot>
                  <tr>
                    <th>No</th>
                    <th>Product Name</th>
                    <th>Category</th>
                    <th>Product Desc.</th>
                    <th>Product QTY</th>
                  </tr>
                </tfoot>
                <tbody>
                  <?php for($i=0; $i < count($products); $i++) { ?>
                    <tr id="<?php echo $products[$i]->id; ?>">
                      <th><?php echo $i+1; ?></th>
                      <th><?php echo $products[$i]->product_name; ?></th>
                      <th><?php echo $products[$i]->category_name; ?></th>
                      <th><?php echo $products[$i]->product_desc; ?></th>
                      <th><?php echo $products[$i]->product_qty; ?></th>
                    </tr>
                  <?php } ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-info" data-dismiss="modal">OK</button>
        </div>
      </div>
      
    </div>
  </div>

  <link rel="stylesheet" href="http://cdn.datatables.net/1.10.23/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"/>
 
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src = "http://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
  <style type="text/css">.hidden{display: none;}</style>
  <script type="text/javascript">
    function myFunction(val) {
      var check="<?php if(!empty($kategori)){ echo 'ada'; } else {echo '';} ?>";
      var qty = document.getElementById("txtProductQty").value;
      if(check == 'ada'){
        qty = document.getElementById("txtStockBefore").value;
      }

      console.log(qty);

      if(qty == 0){
        alert("Silahkan pilih Produk yang akan di Opname terlebih dahulu !");
        document.getElementById("txtStockFisik").value="";
      } else {
        var hasil = qty - val;
        document.getElementById("txtSelisih").value=hasil;
        document.getElementById("txtSelisih_disable").value=hasil;
      }
    }
    $(document).ready(function () {
      jQuery.noConflict();
      var table = $('#productID').DataTable();

      $('#productID tbody').on('click', 'tr', function () {
        var id = table.row( this ).id();
          if ( $(this).hasClass('selected') ) {
            $(this).removeClass('selected');
          } else {
            table.$('tr.selected').removeClass('selected');
            $(this).addClass('selected');

            var data = $('#productID').DataTable().row('.selected').data();
            document.getElementById("txtProductName").value=data[1];
            document.getElementById("txtCategory").value=data[2];
            document.getElementById("txtProductDesc").value=data[3];
            document.getElementById("txtProductQty").value=data[4];
            document.getElementById("txtProductID").value=id;
          }
    
      });
    });
  </script>
  <!-- /.content-wrapper -->
<?php $this->load->view('element/footer');?>