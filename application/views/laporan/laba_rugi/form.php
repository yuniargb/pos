<?php $this->load->view('element/head');?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" xmlns="http://www.w3.org/1999/html">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      <?php echo $title; ?>
      <small><?php echo $title; ?></small>
    </h1>
  </section>

  <section class="content">

    <div class="row">
      <div class="col-xs-12">
        <ul class="nav nav-tabs">
          <li role="presentation" class="active"><a href="<?php echo site_url('report/proyeksi_laba_rugi');?>"><?php echo $title; ?></a></li>
          <li role="presentation"><a href="<?php echo site_url('report/laba_rugi');?>"><?php echo $title2; ?></a></li>
        </ul>
        <div class="box box-info">
          <div class="box-header with-border">
            <h3 class="box-title"><?php echo $title; ?></h3>
            <?php if($this->session->flashdata('form_false')){?>
              <div class="alert alert-danger text-center">
                <strong><?php echo $this->session->flashdata('form_false');?></strong>
              </div>
            <?php } ?>
          </div>

            <form id="transaction-form" class="form-horizontal" method="POST" action="<?php echo site_url('report/save_laba_rugi');?>">
              <div class="box-body">
                <div class="col-md-2">
                  <div class="form-group">
                    <label class="col-sm-4 control-label" for="kode">Bulan</label>
                    <div class="col-sm-8">
                      <select name="txtBulan" id="txtBulan" class="form-control">
                        <option value="">Select Bulan</option>
                        <option value="1">Januari</option>
                        <option value="2">Februari</option>
                        <option value="3">Maret</option>
                        <option value="4">April</option>
                        <option value="5">May</option>
                        <option value="6">Juni</option>
                        <option value="7">Juli</option>
                        <option value="8">Agustus</option>
                        <option value="9">September</option>
                        <option value="10">Oktober</option>
                        <option value="11">November</option>
                        <option value="12">Desember</option>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="col-md-2">
                  <div class="form-group">
                    <label class="col-sm-4 control-label" for="kode">Tahun</label>
                    <div class="col-sm-8">
                      <select name="txtTahun" id="txtTahun" class="form-control">
                        <option value="">Select Tahun</option>
                        <?php
                          $now=date('Y');
                          for ($a=2015; $a<=$now; $a++)
                          {
                            echo "<option value='$a'>$a</option>";
                          }
                        ?>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="col-md-2">
                  <div class="form-group">
                    <a class="btn btn-info" href="#" onclick="proyeksi_laba_rugi()">Proyeksi Laba Rugi</a>
                  </div>
                </div>

                <div class="col-md-12" style="margin-top: 20px;">
                  <div class="col-md-12" style="background-color: black; color: orange; padding: 10px; font-size: 18px;">
                    1. Pendapatan
                  </div>
                  <div class="col-md-12" style="margin-top: 10px;">
                    <div class="form-group">
                      <label class="col-sm-8" for="kode">Pendapatan</label>
                      <div class="col-sm-4">
                        <input type="text" name="txtPendapatan_disabled" id="txtPendapatan_disabled" value="" class="form-control" disabled/>
                        <input type="hidden" name="txtPendapatan" id="txtPendapatan" value=""/>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="col-md-12">
                  <div class="col-md-12" style="background-color: black; color: orange; padding: 10px; font-size: 18px;">
                    2. Harga Pokok Penjualan
                  </div>
                  <div class="col-md-12" style="margin-top: 10px;">
                    <div class="form-group">
                      <label class="col-sm-8 " for="kode">HPP (Harga Pokok Penjualan)</label>
                      <div class="col-sm-4">
                        <input type="number" minlength="0" name="hpp" id="hpp" value="" disabled class="form-control form-price-format discount-trx" />
                        <input type="number" minlength="0" name="txtHPP" id="txtHPP" value="" class="form-control form-price-format discount-trx hidden"
                        onchange="myFunction(this.value)" />
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-8" for="kode">Laba / Rugi Kotor</label>
                      <div class="col-sm-4">
                        <input type="text" name="txtLabaRugiKotor_disabled" id="txtLabaRugiKotor_disabled" value="" class="form-control" disabled/>
                        <input type="hidden" name="txtLabaRugiKotor" id="txtLabaRugiKotor" value=""/>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="col-md-12">
                  <div class="col-md-12" style="background-color: black; color: orange; padding: 10px; font-size: 18px;">
                    2. Biaya - biaya
                  </div>
                  <div class="col-md-12" id="display_biaya" style="margin-top: 10px;">

                  </div>
                  <div class="col-md-12" style="margin-top: 10px;">
                    <div class="form-group">
                      <label class="col-sm-8" for="kode">Total Biaya</label>
                      <div class="col-sm-4">
                        <input type="text" name="txtTotalBiaya_disabled" id="txtTotalBiaya_disabled" value="" class="form-control" disabled/>
                        <input type="hidden" name="txtTotalBiaya" id="txtTotalBiaya" value=""/>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-8" for="kode">Laba / Rugi</label>
                      <div class="col-sm-4">
                        <input type="text" name="txtLabaRugi_disabled" id="txtLabaRugi_disabled" value="" class="form-control" disabled/>
                        <input type="hidden" name="txtLabaRugi" id="txtLabaRugi" value=""/>
                      </div>
                    </div>
                  </div>
                </div>

              </div>
            </div>

            <div class="box-footer">
              <div class="col-md-3 col-md-offset-4">
                <a class="btn btn-default" href="<?php echo site_url('master_biaya');?>">Cancel</a>
                <button class="btn btn-info" type="submit">Save</button>
              </div>
            </div>

          </form>
        </div>
      </div>

    </div>

  </section>

</div>

<script type="text/javascript">
  function myFunction(val) {
    var pendapatan = document.getElementById("txtPendapatan").value;
    var total_biaya = document.getElementById("txtTotalBiaya").value;

    console.log(pendapatan);
    console.log(total_biaya);
    var count = parseInt(pendapatan) - parseInt(val);
    console.log(count);
    var laba_rugi = count - parseInt(total_biaya);

    console.log(laba_rugi);


    document.getElementById("txtLabaRugiKotor_disabled").value = 'Rp. ' + (parseInt(count)).formatMoney(2, ".", ",");
    document.getElementById("txtLabaRugiKotor").value = count;

    document.getElementById("txtLabaRugi_disabled").value = 'Rp. ' + (parseInt(laba_rugi)).formatMoney(2, ".", ",");
    document.getElementById("txtLabaRugi").value = laba_rugi;

  }

  function proyeksi_laba_rugi(){
    var bulan = document.getElementById("txtBulan").value;
    var tahun = document.getElementById("txtTahun").value;

    if(bulan != '' && tahun != ''){
      $.ajax({
        url: '<?php echo base_url()?>report/get_proyeksi',
        type : 'POST',
        data : {bulan : bulan, tahun : tahun},
        async : true,
        dataType : 'json',
        success: function(data)
        {
          console.log(data);
          if(data['info'] == 1){
            var message = "Data untuk Bulan "+bulan+" Dan Tahun "+tahun+" Sudah di lakukan perhitungan proyeksi Laba dan Rugi !";
            alert(message);
            location.reload();
          } else {
            document.getElementById("txtPendapatan").value = data['pendapatan'];
            document.getElementById("txtPendapatan_disabled").value = 'Rp. ' + (parseInt(data['pendapatan'])).formatMoney(2, ".", ",");
            document.getElementById("txtTotalBiaya").value = data['biaya'];
            document.getElementById("txtTotalBiaya_disabled").value = 'Rp. ' + (parseInt(data['biaya'])).formatMoney(2, ".", ",");

            var biaya = data['biaya_detail'].length;
            var html="";
            if(biaya > 0){
              for(var i=0; i < biaya; i++){
                html += "<div class='form-group'>";
                html += "<label class='col-sm-8 ' for='kode'>"+data['biaya_detail'][i]['keterangan']+"</label>";
                html += "<div class='col-sm-4'>";
                html += "<input type='text' name='txtHPP' id='txtHPP' value='Rp. "+(parseInt(data['biaya_detail'][i]['jumlah'])).formatMoney(2, ".", ",")+"' class='form-control' disabled/>";
                html += "</div>";
                html += "</div>";      
              }
              document.getElementById("display_biaya").innerHTML=html;
            } 

            document.getElementById("txtHPP").classList.remove("hidden");
            document.getElementById("hpp").classList.add("hidden");
          }
          
        }
      });
    } else {
      alert("Silahkan Pilih Bulan dan Tahun terlebih dahulu !");
    }
    
  }
</script>

<?php $this->load->view('element/footer');?>