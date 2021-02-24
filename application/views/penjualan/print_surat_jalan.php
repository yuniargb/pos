<html>
<head>
    <meta charset="ISO-8859-1">
    <style>

        html, body {
            width: 23cm; /* was 907px */
            display: block;
            font-family: "Consolas";
            margin:0;
            /*font-size: auto; NOT A VALID PROPERTY */
        }
        table.table-bordered{
            width:100%;
            font-size:13px;
            border: 1px solid #ddd;
            border-spacing: 0;
            border-collapse: collapse;
        }
        table.table-bordered tr th{
            vertical-align: bottom;
            font-size: 18px;
            font-weight: bold;
        }
        table.table-bordered tr th,
        table.table-bordered tr td{
            padding: 5px;
            border: 1px solid #ddd;
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
                display: block;
                font-family: "Consolas";
                padding:0 10px;
                margin:0;
                /*font-size: auto; NOT A VALID PROPERTY */
            }
            table.table-bordered{
                width:100%;
                font-size:13px;
                border: 1px solid #ddd;
                border-spacing: 0;
                border-collapse: collapse;
            }
            table.table-bordered tr th{
                vertical-align: bottom;
                font-size: 18px;
                font-weight: bold;
            }
            table.table-bordered tr th,
            table.table-bordered tr td{
                padding: 5px;
                border: 1px solid #ddd;
                border-bottom-width: 2px;
                font-size: 16px;
            }
            .box-body{
                padding:10px;
                font-size:13px;
            }
            ol li,
            h3{
                font-size: 16px;
            }

        }
    </style>
</head>
<body>
    <div class="box-body" style="margin-top: 40px;">
        <table style="display:inline;">
            <tr>
                <td style="width: 40%; font-size: 18px;"><b>PT. BUNGASARI</b></td>
                <td style="width: 10%;">&nbsp;&nbsp;&nbsp;</td>
                <td style="width: 10%;">&nbsp;&nbsp;&nbsp;</td>
                <td style="width: 10%;">&nbsp;&nbsp;&nbsp;</td>
                <td style="width: 5%;">&nbsp;&nbsp;&nbsp;</td>
                <td style="width: 40%; font-size: 20px;" rowspan="3"><b>SURAT JALAN</b></td>
            </tr>
            <tr>
                <td style="width: 50%;"><b>Kawasan Industri Medan 4</b></td>
            </tr>
            <tr>
                <td style="width: 50%;"><b>Telp. 081373636464</b></td>
            </tr>
        </table>
        <hr style="border: 3px solid; width: 100%;"><br><br>
        <table style="display:inline;">
            <thead>
                <tr>
                    <td style="width:350px;">Kepada Yth:</td>
                    <td style="width:200px;">Kode Transaksi</td>
                    <td style="width:200px;">: <?php echo $details[0]->id;?></td>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><?php echo $details[0]->customer_name;?></td>
                    <td>Tgl Pembelian</td>
                    <td>: <?php echo date("d-m-Y H:i:s",strtotime($details[0]->date));?></td>
                </tr>
                <tr>
                    <td><?php echo $details[0]->customer_address;?> </td>
                    <td valign="top">Pembayaran</td>
                    <td valign="top">: <?php echo $details[0]->is_cash == 1 ? "Cash" : "Credit";?></td>
                </tr>
                <tr>
                    <td>Phone: <?php echo $details[0]->customer_phone;?></td>
                    <td valign="top">Jatuh Tempo</td>
                    <td valign="top">: <?php echo $details[0]->is_cash == 1 ? "-" : $details[0]->pay_deadline_date;?></td>
                </tr>
            </tbody>
        </table>
        <br><br>
        <table style="width: 100%;" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th style="width: 5%;">No</th>
                    <th style="width: 40%;">Name Product</th>
                    <th style="width: 10%;">QTY</th>
                </tr>
            </thead>
            <tbody>
                <?php if(isset($details) && is_array($details)){ ?>
                    <?php 
                    $no = 1;
                    foreach($details as $key => $transaksi){?>
                        <tr>
                            <td style="width:5%; text-align: center;"><?php echo $no;?></td>
                            <td style="width:40%; text-align: left;"><?php echo $transaksi->product_name;?></td>
                            <td style="width:10%; text-align: left;"><?php echo number_format($transaksi->quantity);?></td>
                        </tr>
                    <?php $no++; } ?>
                <?php } ?>
            </tbody>
        </table>
        <br />
        <h3>Keterangan : </h3>
        <ol>
            <li> Surat Jalan ini Bukti Resmi penerimaan Barang</li>
            <li> Surat Jalan ini bukan Bukti Penjualan</li>
        </ol>
        <br><br>
        <br><br><br>
        <table>
            <thead>
            <tr>
                <td style="width:25%;text-align: center;">&nbsp;&nbsp;&nbsp;</td>
                <td style="width:25%;text-align: center;">&nbsp;&nbsp;&nbsp;</td>
                <td style="width:180px;text-align: center;">Penerima</td>
                <td style="width:180px;text-align: center;">Hormat Kami</td>
                <!--<td style="width:350px;text-align: center;">**Terimakasih**</td>-->
            </tr>
            </thead>
            <tbody>
            <tr>
                <td></td>
                <td style="width:25%;text-align: center;">&nbsp;&nbsp;&nbsp;</td>
                <td style="width:25%;text-align: center;">&nbsp;&nbsp;&nbsp;</td>
                <td style="width:342px;text-align: center;">&nbsp;</td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td style="width:25%;text-align: center;">&nbsp;&nbsp;&nbsp;</td>
                <td style="width:342px;text-align: center;">&nbsp; </td>
            </tr>
            <tr>
                <td style="width:25%;text-align: center;">&nbsp;&nbsp;&nbsp;</td>
                <td style="width:25%;text-align: center;">&nbsp;&nbsp;&nbsp;</td>
                <td style="width:100px;text-align: center;">(.............)</td>
                <td style="width:150px;text-align: center;">(.............)</td>
                <!--<td style="width:342px;text-align: center;">dan elektronik</td>-->
            </tr>
            </tbody>
        </table>
    </div>
</body>
</html>