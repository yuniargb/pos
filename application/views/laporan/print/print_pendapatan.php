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
        <center><h1><b>LAPORAN PENDAPATAN <br>DARI <span style="color: red;"><?php echo $from; ?></span> SAMPAI <span style="color: red;"><?php echo $to; ?></span></b></h1></center><br>
        <table style="width: 100%;" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th style="width: 14%;">Tanggal Transaksi</th>
                    <th style="width: 14%;">Total Transaksi</th>
                    <th style="width: 14%;">Total Piutang</th>
                    <th style="width: 14%;">Total Penerimaan Piutang</th>
                    <th style="width: 14%;">Total Hutang</th>
                    <th style="width: 14%;">Total Penerimaan Hutang</th>
                    <th style="width: 14%;">Keuntungan</th>
                    <th style="width: 14%;">Pengeluaran</th>
                  </tr>
            </thead>
            <tbody>
                <?php if(isset($details) && is_array($details)){ 
                    $total = 0;
                    ?>
                    <?php foreach($details as $penjualan){
                        $total += $penjualan->total_keuntungan - $penjualan->total_pengeluaran;
                    ?>
                      <tr>
                        <td><?php echo $penjualan->date;?></td>
                        <td><?php echo $penjualan->jumlah_transaksi;?></td>
                        <td><?php echo number_format($penjualan->total_piutang,2,',','.');?></td>
                        <td><?php echo number_format($penjualan->total_penerimaan_piutang,2,',','.');?></td>
                        <td><?php echo number_format($penjualan->total_hutang,2,',','.');?></td>
                        <td><?php echo number_format($penjualan->total_pembayaran_hutang,2,',','.');?></td>
                        <td><?php echo number_format($penjualan->total_keuntungan,2,',','.');?></td>
                        <td><?php echo number_format($penjualan->total_pengeluaran,2,',','.');?></td>
                      </tr>
                    <?php } ?>
                  <?php } ?>
            </tbody>
        </table>

        <br>
        <div style="text-align: right; font-size: 20px;">
            <b>Jumlah Pendapatan  : <span style="margin-left: 50px;">Rp. <?php echo number_format($total,2,',','.'); ?></span></b>
        </div>
        <br>
    </div>
</body>
</html>
