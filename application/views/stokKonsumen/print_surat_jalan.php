


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
            display:inline;
            font-size:13px;
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
                display:inline;
                font-size:13px;
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
        <table style="display:inline;">
            <thead>
                <tr>
                    <td style="width:350px;">Kepada Yth:</td>
                    <td style="width:200px;">Kode Surat Jalan</td>
                    <td style="width:200px;">: <?php echo $details[0]->id;?></td>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><?php echo $details[0]->customer_name;?></td>
                    <td>Tgl Kirim</td>
                    <td>: <?php echo date("d-m-Y",strtotime($details[0]->tanggal_kirim));?></td>
                </tr>
                <tr>
                    <td><?php echo $details[0]->customer_address;?> </td>
                    <td valign="top">Nomor Plat</td>
                    <td valign="top">: <?php echo $details[0]->no_plot_truk ;?></td>
                </tr>
                <tr>
                    <td>Phone: <?php echo $details[0]->customer_phone;?></td>
                    <td valign="top"></td>
                    <td valign="top"></td>
                </tr>
            </tbody>
        </table>
        <br />
        <?php $line = "==================================================================================================================";?>
        <?php echo $line;?>
        <table>
            <thead>
            <tr>
                <th style="width: 5%;">No</th>
                <th style="width: 40%;">Name Product</th>
                <th style="width: 100%;">Satuan</th>
                <th style="width: 10%;">QTY</th>
            </tr>

            </thead>
        </table>
        <?php echo $line;?>
        <table>
            <thead  style="height:270px;">
            <?php if(isset($details) && is_array($details)){ ?>
                    <?php 
                    $no = 1;
                    $qty = 0;
                    foreach($details as $key => $transaksi){
                        $qty += $transaksi->qty;
                        ?>
                        <tr>
                            <td style="width:5%; text-align: center;"><?php echo $no;?></td>
                            <td style="width:40%; text-align: center;"><?php echo $transaksi->product_name;?></td>
                            <td style="width:100%; text-align: center;"><?php echo $transaksi->category_name;?></td>
                            <td style="width:10%; text-align: center;"><?php echo number_format($transaksi->qty);?></td>
                            </tr>
                    <?php $no++; } ?>
                <?php $total = 10 - ($key + 1);
                for($a =1; $a <= $total; $a++){ ?>
                    <tr style="height:10px;font-size:14px;">
                        <td style="width:5%;">&nbsp;</td>
                        <td style="width:40%;"></td>
                        <td style="width:100%;"></td>
                        <td style="width:10%;"></td>
                    </tr>
                <?php } ?>
            <?php } ?>
            </thead>
        </table>
        <?php echo $line;?>
        <table>
            <thead>
            <tr style="height:10px;font-size:14px;">
                <td style="width:5%;">&nbsp;</td>
                <td style="width:40%;"></td>
                <td style="width:100%;">Total</td>
                <td style="width:10%;"><?= $qty ?></td>
            </tr>
            
            </thead>
        </table>
        <?php echo $line;?>
        <br />
        <table>
            <thead>
            <tr>
                <td style="width:180px;text-align: center;">Pembeli</td>
                <td style="width:180px;text-align: center;">Pengantar</td>
                <td style="width:180px;text-align: center;">Hormat Kami</td>
                <!--<td style="width:350px;text-align: center;">**Terimakasih**</td>-->
            </tr>
            </thead>
            <tbody>
            <tr>
                <td></td>
                <td></td>
                <td style="width:150px;text-align: center;">&nbsp;</td>
                <td style="width:342px;text-align: center;">&nbsp;</td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td style="width:342px;text-align: center;">&nbsp; </td>
            </tr>
            <tr>
                <td style="width:100px;text-align: center;">(.............)</td>
                <td style="width:120px;text-align: center;">(.............)</td>
                <td style="width:150px;text-align: center;">(.............)</td>
                <!--<td style="width:342px;text-align: center;">dan elektronik</td>-->
            </tr>
            </tbody>
        </table>
    </div>
</body>
</html>