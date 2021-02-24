<html>
<head>
    <meta charset="ISO-8859-1">
    <style>

        html, body {
            width: 23cm; /* was 907px */
            height: 13.5cm; /* was 529px */
            display: block;
            font-family: "Consolas";
            margin:0;
            /*font-size: auto; NOT A VALID PROPERTY */
        }
        table{
            width:100%;
            font-size:13px;
            border: 1px solid #f4f4f4;
            border-spacing: 0;
            border-collapse: collapse;
        }
        table tr th{
            vertical-align: bottom;
            font-size: 18px;
            font-weight: bold;
        }
        table tr th,
        table tr td{
            padding: 5px;
            border: 1px solid #f4f4f4;
            border-bottom-width: 2px;
            font-size: 16px;
        }
        .box-body{
            padding:10px;
            font-size:13px;
        }
        @media print {
            html, body {
                width: 23cm; /* was 8.5in */
                height: 13.5cm; /* was 5.5in */
                display: block;
                font-family: "Consolas";
                padding:0 10px;
                margin:0;
                /*font-size: auto; NOT A VALID PROPERTY */
            }
            table{
                width:100%;
                font-size:13px;
                border: 1px solid #f4f4f4;
                border-spacing: 0;
                border-collapse: collapse;
            }
            table tr th{
                vertical-align: bottom;
                font-size: 18px;
                font-weight: bold;
            }
            table tr th,
            table tr td{
                padding: 5px;
                border: 1px solid #f4f4f4;
                border-bottom-width: 2px;
                font-size: 16px;
            }
            .box-body{
                padding:10px;
                font-size:13px;
            }

            @page {
                size: 24cm 14cm /* . Random dot? */;
            }
        }
    </style>
</head>
<body>
    <div class="box-body">
        <center><h1><b>LAPORAN PROYEKSI LABA RUGI 
        <?php if($search == true){ ?>
           <br>DARI <span style="color: red;"><?php echo ($Bulan_from.'-'.$Tahun_from); ?></span> SAMPAI 
           <span style="color: red;"><?php echo ($Bulan_to.'-'.$Tahun_to); ?></span> 
        <?php } ?>
        </b></h1></center><br>
        <table style="width: 100%;" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th style="width: 5%;">No</th>
                    <th style="width: 10%;">Bulan</th>
                    <th style="width: 10%;">Tahun</th>
                    <th style="width: 15%;">Pendapatan</th>
                    <th style="width: 10%;">HPP</th>
                    <th style="width: 10%;">Tot. Biaya</th>
                    <th style="width: 10%;">Tot. Laba Kotor</th>
                    <th style="width: 10%;">Tot. Laba Bersih</th>
                    <th style="width: 10%;">Ket.</th>
                </tr>
            </thead>
            <tbody>
                <?php if(isset($details) && is_array($details)){ ?>
                    <?php
                    $no =1; 
                    foreach($details as $penjualan){?>
                        <tr>
                            <td style="width: 5%;"><?php echo $no; ?></td>
                            <td style="width: 10%;">
                                <?php if($penjualan->month == 1) {
                                  echo "Januari";
                                } else if($penjualan->month == 2) {
                                  echo "Februari";
                                } else if($penjualan->month == 3) {
                                  echo "Maret";
                                } else if($penjualan->month == 4) {
                                  echo "April";
                                } else if($penjualan->month == 5) {
                                  echo "Mei";
                                } else if($penjualan->month == 6) {
                                  echo "Juni";
                                } else if($penjualan->month == 7) {
                                  echo "Juli";
                                } else if($penjualan->month == 8) {
                                  echo "Agustus";
                                } else if($penjualan->month == 9) {
                                  echo "September";
                                } else if($penjualan->month == 10) {
                                  echo "Oktober";
                                } else if($penjualan->month == 11) {
                                  echo "November";
                                } else if($penjualan->month == 12) {
                                  echo "Desember";
                                } ?>
                            </td>
                            <td style="width: 10%;"><?php echo $penjualan->year;?></td>
                            <td style="width: 15%;">Rp. <?php echo number_format($penjualan->tot_pendapatan,2,',','.'); ?></td>
                            <td style="width: 10%;">Rp. <?php echo number_format($penjualan->hpp,2,',','.'); ?></td>
                            <td style="width: 10%;">Rp. <?php echo number_format($penjualan->tot_biaya,2,',','.'); ?></td>
                            <td style="width: 10%;">Rp. <?php echo number_format($penjualan->tot_laba_rugi_kotor,2,',','.'); ?></td>
                            <td style="width: 10%;">Rp. <?php echo number_format($penjualan->tot_laba_rugi,2,',','.'); ?></td>
                            <td style="width: 10%; <?php echo ($penjualan->keterangan == 'Rugi') ? 'color: red;' : 'color:green;'; ?>"><?php echo $penjualan->keterangan; ?></td>
                      </tr>
                    <?php $no++; } ?>
                  <?php } ?>
            </tbody>
        </table>
    </div>
</body>
</html>
