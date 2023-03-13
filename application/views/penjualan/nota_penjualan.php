<html moznomarginboxes mozdisallowselectionprint>
    <head>
        <title>Toko Plastik BUMDES</title>
        <style type="text/css">
            html {
                font-family:"Verdana, Arial";
            }
            .content {
                width: 80mm;
                font-size: 12px;
                padding: 5px;
            }
            .title {
                text-align: center;
                font-size: 13px;
                padding-bottom: 5px;
                border-bottom: 1px dashed;
            }
            .head{
                margin-top: 5px;
                margin-bottom: 10px;
                padding-bottom: 10px;
                border-bottom: 1px solid;
            }
            table {
                width: 100%;
                font-size: 12px;
            }
            .terimakasih {
                margin-top: 10px;
                padding-top: 10px;
                text-align: center;
                border-top: 1px dashed;
            }
            @media print {
                @page {
                    width: 80mm;
                    margin: 0mm;
                }
            }
        </style>
    </head>
    <body onload="window.print()">
        <div class="content">
            <div class="title">
                <b>TOKO PLASTIK</b>
                <br>
                Komplek Pasar Ngarum, Desa Ngarum, Kec.Ngrampal, Kab.Sragen
            </div>

            <div class="head">
                <table cellspacing="0" cellpadding="0">
                    <tr>
                        <td style="width:200px">
                        <?php
                        echo Date("d/m/y", strtotime($penjualan->tanggal))." ".Date("H:i", strtotime($penjualan->jual_created));
                        ?>
                        </td>
                        <td>Kasir</td>
                        <td style="text-align:center; width: 10px">:</td>
                        <td style="text-align:right">
                            <?=ucfirst($penjualan->user_name)?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <?=$penjualan->invoice?>
                        </td>
                    </tr>
                </table>
            </div> 

            <div class="transaction">
                <table class="transaction-table" cellspacing="0" cellpadding="0">
                    <?php
                    $arr_diskon = array();
                    foreach ($penjualan_detail as $key => $value) { ?>
                        <tr>
                            <td><?=$value->nama?><td>
                            <td><?=$value->jumlah?><td>
                            <td><?=indo_currency($value->harga)?><td>
                            <td><?=indo_currency(($value->harga - $value->potongan_item) * $value->jumlah)?><td>
                        </tr>

                        <?php
                        if ($value->potongan_item > 0) {
                            $arr_diskon[] = $value->potongan_item;
                        }
                    }

                    foreach ($arr_diskon as $key => $value) { ?>
                        <tr>
                            <td><td>
                            <td>Pot.Item <?=($key+1)?><td>
                            <td><?=indo_currency($value)?><td>
                        </tr>
                    <?php
                    } ?>

                    <tr>
                        <td colspan="10" style="border-bottom:1px dashed; padding-top:5px"></td>
                    </tr>

                    <tr>
                        <td><td>
                        <td>Sub Total<td>
                        <td><?=indo_currency($penjualan->total_harga)?><td>
                    </tr>

                    <tr>
                        <td colspan="10" style="border-bottom:1px dashed; padding-top:5px"></td>
                    </tr>

                    <?php if($penjualan->diskon > 0) { ?>
                        <tr>
                           <td><td>
                           <td>Pot. Harga<td>
                           <td><?=indo_currency($penjualan->diskon)?><td>
                        </tr>

                    <?php
                    } ?>
                    <tr>
                        <td><td>
                        <td>Harga Jadi<td>
                        <td><?=indo_currency($penjualan->final_harga)?><td>
                    </tr>

                    <tr>
                        <td colspan="10" style="border-bottom:1px dashed; padding-top:5px"></td>
                    </tr>

                    <tr>
                        <td><td>
                        <td>Bayar<td>
                        <td><?=indo_currency($penjualan->pembayaran)?><td>
                    </tr>

                    <tr>
                        <td><td>
                        <td>Kembalian<td>
                        <td><?=indo_currency($penjualan->kembalian)?><td>
                    </tr>
                </table>
            </div>

            <div class="terimakasih">
                --- Terimakasih ---
                <br>
                Semoga harimu menyenangkan
            </div>
        </div>
    </body>
</html>