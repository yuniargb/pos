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

            <form id="transaction-form" class="form-horizontal" method="POST" action="<?php echo site_url('report/save_laba_rugi').'/'.$labas[0]->id;?>">
              <div class="box-body">
                <div class="col-md-3">
                  <div class="form-group">
                    <label class="col-sm-4 control-label" for="kode">Bulan</label>
                    <div class="col-sm-8">
                      <select name="txtBulan" id="txtBulan" class="form-control">
                        <option value="">Select Bulan</option>
                        <option value="1" <?php echo ($labas[0]->month == 1) ? 'selected' : ''; ?>>Januari</option>
                        <option value="2" <?php echo ($labas[0]->month == 2) ? 'selected' : ''; ?>>Februari</option>
                        <option value="3" <?php echo ($labas[0]->month == 3) ? 'selected' : ''; ?>>Maret</option>
                        <option value="4" <?php echo ($labas[0]->month == 4) ? 'selected' : ''; ?>>April</option>
                        <option value="5" <?php echo ($labas[0]->month == 5) ? 'selected' : ''; ?>>May</option>
                        <option value="6" <?php echo ($labas[0]->month == 6) ? 'selected' : ''; ?>>Juni</option>
                        <option value="7" <?php echo ($labas[0]->month == 7) ? 'selected' : ''; ?>>Juli</option>
                        <option value="8" <?php echo ($labas[0]->month == 8) ? 'selected' : ''; ?>>Agustus</option>
                        <option value="9" <?php echo ($labas[0]->month == 9) ? 'selected' : ''; ?>>September</option>
                        <option value="10" <?php echo ($labas[0]->month == 10) ? 'selected' : ''; ?>>Oktober</option>
                        <option value="11" <?php echo ($labas[0]->month == 11) ? 'selected' : ''; ?>>November</option>
                        <option value="12" <?php echo ($labas[0]->month == 12) ? 'selected' : ''; ?>>Desember</option>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <label class="col-sm-4 control-label" for="kode">Tahun</label>
                    <div class="col-sm-8">
                      <select name="txtTahun" id="txtTahun" class="form-control">
                        <option value="">Select Tahun</option>
                        <?php
                          $now=date('Y');
                          for ($a=2015; $a<=$now; $a++)
                          { ?>
                            <option value="<?php echo $a ?>" <?php echo ($labas[0]->year == $a) ? 'selected' : ''; ?>><?php echo $a ?></option>
                          <?php }
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
                        <input type="text" name="txtPendapatan_disabled" id="txtPendapatan_disabled" class="form-control" value="<?php echo $labas[0]->tot_pendapatan; ?>" disabled/>
                        <input type="hidden" name="txtPendapatan" id="txtPendapatan" value="<?php echo $labas[0]->tot_pendapatan; ?>"/>
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
                        <input type="number" minlength="0" name="hpp" id="hpp" value="<?php echo $labas[0]->hpp; ?>" disabled class="form-control hidden" />
                        <input type="number" minlength="0" name="txtHPP" id="txtHPP" value="<?php echo $labas[0]->hpp; ?>" class="form-control"
                        onchange="myFunction(this.value)" />
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-8" for="kode">Laba / Rugi Kotor</label>
                      <div class="col-sm-4">
                        <input type="text" name="txtLabaRugiKotor_disabled" id="txtLabaRugiKotor_disabled" value="<?php echo $labas[0]->tot_laba_rugi_kotor; ?>" class="form-control" disabled/>
                        <input type="hidden" name="txtLabaRugiKotor" id="txtLabaRugiKotor" value="<?php echo $labas[0]->tot_laba_rugi_kotor; ?>"/>
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
                    <?php
                      if(count($detail_biaya) > 0) {
                        for ($i=0; $i < count($detail_biaya); $i++)
                        { ?>
                          <div class="form-group">
                            <label class="col-sm-8" for="kode"><?php echo $detail_biaya[$i]->keterangan; ?></label>
                            <div class="col-sm-4">
                              <input type="text" name="txtBiayabiaya" id="txtBiayabiaya" value="<?php echo $detail_biaya[$i]->jumlah; ?>" class="form-control" disabled/>
                              <input type="hidden" name="txtTotalBiaya" id="txtTotalBiaya" value="<?php echo $detail_biaya[$i]->jumlah; ?>"/>
                            </div>
                          </div>
                        <?php }
                      }
                    ?>
                  </div>
                  <div class="col-md-12" id="edit_display_biaya" style="margin-top: 10px;">
                    <div class="form-group">
                      <label class="col-sm-8" for="kode">Total Biaya</label>
                      <div class="col-sm-4">
                        <input type="text" name="txtTotalBiaya_disabled" id="txtTotalBiaya_disabled" value="<?php echo $labas[0]->tot_biaya; ?>" class="form-control" disabled/>
                        <input type="hidden" name="txtTotalBiaya" id="txtTotalBiaya" value="<?php echo $labas[0]->tot_biaya; ?>"/>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-8" for="kode">Laba / Rugi</label>
                      <div class="col-sm-4">
                        <input type="text" name="txtLabaRugi_disabled" id="txtLabaRugi_disabled" value="<?php echo $labas[0]->tot_laba_rugi; ?>" class="form-control" disabled/>
                        <input type="hidden" name="txtLabaRugi" id="txtLabaRugi" value="<?php echo $labas[0]->tot_laba_rugi; ?>"/>
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
      });
    } else {
      alert("Silahkan Pilih Bulan dan Tahun terlebih dahulu !");
    }
    
  }
</script>

<?php $this->load->view('element/footer');?>