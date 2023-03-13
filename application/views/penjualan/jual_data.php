<?php $no = 1;
if($jual->num_rows() > 0) {
    foreach ($jual->result() as $c => $data) { ?>
        <tr>
            <td><?=$no++?>.</td>
            <td class="kodebarang"><?=$data->kodebarang?></td>
            <td><?=$data->item_nama?></td>
            <td class="text-right"><?=$data->jual_harga?></td>
            <td class="text-right"><?=$data->jumlah_bar?></td>
            <td class="text-right"><?=$data->potongan_item?></td>
            <td class="text-right" id="total"><?=$data->total?></td>
            <td class="text-right" width="160px">
                <button id="update_jual" data-toggle="modal" data-target="#modal-item-edit"
                data-jualid="<?=$data->jual_id?>"
                data-kodebarang="<?=$data->kodebarang?>"
                data-produk="<?=$data->item_nama?>"
                data-stok="<?=$data->stok?>"
                data-harga="<?=$data->jual_harga?>"
                data-jumlah_bar="<?=$data->jumlah_bar?>"
                data-potongan="<?=$data->potongan_item?>"
                data-total="<?=$data->total?>"
                class="btn btn-xs btn-primary">
                    <i class="fa fa-pencil"></i> Ubah
                </button>
                <button id="hapus_jual" data-jualid="<?=$data->jual_id?>" class="btn btn-xs btn-danger">
                    <i class="fa fa-trash"></i> Hapus
                </button>
            </td>
        </tr>
    <?php
    }
} else {
    echo'<tr>
        <td colspan="8" class="text-center">Tidak ada item</td>
    </tr>';
} ?>