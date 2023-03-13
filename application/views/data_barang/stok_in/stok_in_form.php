<section class="content-header">
  <h1>
    Data Barang
  </h1>
</section>

<!-- Main Content -->
<section class="content">
    <div class="box">
        <div class="box-header">
           <h3 class="box-title">Tambah Data Barang Masuk</h3>
            <div class="pull-right">
                <a href="<?=site_url('stok/in')?>" class="btn btn-warning btn-flat">
                   <i class="fa fa-undo"></i> Kembali
                </a>
            </div>
        </div>
        <div class="box-body">
            <div class="row">
                <div class="col-md-4 col-md-offset-4">
                    <?php?>
                    <form action="<?=site_url('stok/process')?>" method="post">
                        <div class="form-group">
                            <label>Tanggal*</label>
                            <input type="date" name="tanggal" value="<?=date('Y-m-d')?>" class="form-control" required>
                        </div>
                        <div>
                            <label>Kode Barang*</label>
                        </div>
                        <div class="form-group input-group">
                            <input type="hidden" name="item_id" id="item_id">
                            <input type="text" name="kodebarang" id="kodebarang" class="form-control" required autofocus>
                            <span class="input-group-btn">
                                <button type="button" class="btn btn-info btn-flat" data-toggle="modal" data-target="#modal-item">
                                    <i class="fa fa-search"></i>
                                </button>
                            </span>
                        </div>
                        <div class="form-group">
                            <label>Nama Barang*</label>
                            <input type="text" name="nama_barang" id="item_nama" class="form-control" readonly>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-8">
                                    <label>Satuan</label>
                                    <input type="text" name="unit_nama" id="unit_nama" value="-" class="form-control" readonly>
                                </div>
                                <div class="col-md-4">
                                    <label>Stok Awal</label>
                                    <input type="text" name="stok" id="stok" value="-" class="form-control" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Detail*</label>
                            <input type="text" name="detail" class="form-control" placeholder="Pemasok Barang" required>
                        </div>
                        <div class="form-group">
                            <label>Pemasok</label>
                            <select name="suplayer" class="form-control">
                                <option value="">- Pilih -</option>
                                <?php foreach($suplayer as $i => $data) {
                                    echo '<option value="'.$data->suplayer_id.'">'.$data->nama.'</option>';
                                } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Jumlah*</label>
                            <input type="number" name="jumlah" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <button type="submit" name="in_add" class="btn btn-success btn-flat">Simpan</button>
                            <button type="Reset" class="btn btn-flat">Ulangi</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="modal fade" id="modal-item">
    <div class="modal-dialog">
        <div class="modal-content">
           <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
               <h4 class="modal-title">Pencarian Data Kode Barang</h4>
           </div>
           <div class="modal-body table-responsive">
               <table class="table table-bordered table-striped" id="table1">
                   <thead>
                       <tr>
                           <th>Kode Barang</th>
                           <th>Nama</th>
                           <th>Unit</th>
                           <th>Harga</th>
                           <th>Stok</th>
                           <th>Actions</th>
                       </tr>
                   </thead>
                   <tbody>
                       <?php foreach($item as $i => $data) { ?>
                       <tr>
                           <td><?=$data->kodebarang?></td>
                           <td><?=$data->nama?></td>
                           <td><?=$data->unit_nama?></td>
                           <td class="text-right"><?=indo_currency($data->harga)?></td>
                           <td class="text-right"><?=$data->stok?></td>
                           <td class="text-right">
                               <button class="btn btn-xs btn-info" id="select"
                                   data-id="<?=$data->item_id?>"
                                   data-kodebarang="<?=$data->kodebarang?>"
                                   data-nama="<?=$data->nama?>"
                                   data-unit="<?=$data->unit_nama?>"
                                   data-stok="<?=$data->stok?>">
                                   <i class="fa fa-check"></i> Pilih
                               </button>
                           </td>
                       </tr>
                       <?php } ?>
                   </tbody>
               </table>
           </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    $(document).on('click', '#select', function() {
        var item_id = $(this).data('id');
        var kodebarang = $(this).data('kodebarang');
        var nama = $(this).data('nama');
        var unit_nama = $(this).data('unit');
        var stok = $(this).data('stok');
        $('#item_id').val(item_id);
        $('#kodebarang').val(kodebarang);
        $('#item_nama').val(nama);
        $('#unit_nama').val(unit_nama);
        $('#stok').val(stok);
        $('#modal-item').modal('hide');
    })
})
</script>