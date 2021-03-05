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
        <center><h1><b>LAPORAN STOK <br>DARI <span style="color: red;"><?php echo $from; ?></span> SAMPAI <span style="color: red;"><?php echo $to; ?></span></b></h1></center><br>
        <table style="width: 100%;" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th style="width: 14%;">Transaksi ID</th>
                    <th style="width: 14%;">Cust/Supl</th>
                    <th style="width: 14%;">Tanggal Transaksi</th>
                    <th style="width: 14%;">Keterangan</th>
                    <th style="width: 14%;">Nama Produk</th>
                    <th style="width: 14%;">Masuk</th>
                    <th style="width: 14%;">Keluar</th>
                    <th style="width: 14%;">Sisa</th>
                  </tr>
            </thead>
            <tbody>
                <?php if(isset($details) && is_array($details)){  $sisa = 0;?>
                    <?php foreach($details as $s){ $sisa = $sisa + $s->stok_masuk + $s->stok_keluar;?>
                      <tr>
                        <td style="width: 14%;"><?php echo $s->transaksi_id;?></td>
                        <td style="width: 14%;"><?php echo $s->customer;?></td>
                        <td style="width: 14%;"><?php echo $s->tgl_transaksi;?></td>
                        <td style="width: 14%;"><?php echo $s->keterangan;?></td>
                        <td style="width: 14%;"><?php echo $s->nama_product;?></td>
                        <td style="width: 14%;"><?php echo $s->stok_masuk;?></td>
                        <td style="width: 14%;"><?php echo $s->stok_keluar;?></td>
                        <td style="width: 14%;"><?php echo $sisa;?></td>
                      </tr>
                    <?php } ?>
                  <?php } ?>
            </tbody>
        </table>
    </div>
</body>
</html>
