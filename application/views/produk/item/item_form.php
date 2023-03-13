<section class="content-header">
<h1>
    Item
</h1>
</section>

<!-- Main Content -->
<section class="content">
    <!-- <?php $this->view('pesan')?> -->
    <div class="box">
        <div class="box-header">
            <h3 class="box-title"><?=ucfirst($page)?> Data Produk Item</h3>
            <div class="pull-right">
                <a href="<?=site_url('item')?>" class="btn btn-warning btn-flat">
                    <i class="fa fa-undo"></i> Kembali
                </a>
            </div>
        </div>
        <div class="box-body">
            <div class="row">
                <div class="col-md-4 col-md-offset-4">
                    <form action="<?=site_url('item/proses')?>" method="post">
                    <!-- <div class="form-group">
                            <label>Barcode*</label>
                            <input type="hidden" name="id" value="<?=$row->item_id?>">
                            <input type="text" name="barcode" value="<?=$row->barcode?>" class="form-control" required>
                        </div> -->
                        <div class="form-group">
                            <label>Kode Barang*</label>
                            <input type="hidden" name="id" value="<?=$row->item_id?>">
                            <input type="text" name="kodebarang" value="<?=$row->kodebarang?>" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Nama Barang*</label>
                            <input type="text" name="nama_barang" value="<?=$row->nama?>" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Kategori*</label>
                            <select name="kategori" class="form-control" required>
                                <option value="">- Pilih -</option>
                                <?php foreach($kategori->result() as $key => $data) { ?>
                                    <option value="<?=$data->kategori_id?>" <?=$data->kategori_id == $row->kategori_id ? "selected" : null?>><?=$data->nama?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Satuan*</label>
                            <select name="unit" class="form-control" required>
                                <option value="">- Pilih -</option>
                                <?php foreach($unit->result() as $key => $data) { ?>
                                    <option value="<?=$data->unit_id?>" <?=$data->unit_id == $row->unit_id ? "selected" : null?>><?=$data->nama?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Harga*</label>
                            <input type="number" name="harga" value="<?=$row->harga?>" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <button type="submit" name="<?=$page?>" class="btn btn-success btn-flat">Simpan</button>
                            <button type="Reset" class="btn btn-flat">Ulangi</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>