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
        <center><h1><b>LAPORAN PENGELUARAN <br>DARI <span style="color: red;"><?php echo $from; ?></span> SAMPAI <span style="color: red;"><?php echo $to; ?></span></b></h1></center><br>
        <table style="width: 100%;" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th style="width: 20%;">Tanggal Transaksi</th>
                    <th style="width: 20%;">Code Akun</th>
                    <th style="width: 20%;">Nama Akun</th>
                    <th style="width: 20%;">Keterangan</th>
                    <th style="width: 20%;">Jumlah</th>
                    <th style="width: 20%;">Price</th>
                </tr>
            </thead>
            <tbody>
                <?php if(isset($details) && is_array($details)){ ?>
                    <?php foreach($details as $pengeluaran){?>
                      <tr>
                        <td style="width: 20%;"><?php echo $pengeluaran->tanggal;?></td>
                        <td style="width: 20%;"><?php echo $pengeluaran->code;?></td>
                        <td style="width: 20%;"><?php echo $pengeluaran->name;?></td>
                        <td style="width: 20%;"><?php echo $pengeluaran->keterangan;?></td>
                        <td style="width: 20%;"><?php echo $pengeluaran->total;?></td>
                        <td style="width: 20%;">Rp. <?php echo number_format($pengeluaran->jumlah,2,',','.');?></td>
                      </tr>
                    <?php } ?>
                  <?php } ?>
            </tbody>
        </table>
    </div>
</body>
</html>
