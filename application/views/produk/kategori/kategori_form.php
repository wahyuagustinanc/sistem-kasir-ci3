<section class="content-header">
    <h1>
        Kategori
    </h1>
</section>

<!-- Main Content -->
<section class="content">
    <div class="box">
        <div class="box-header">
            <h3 class="box-title"><?=ucfirst($page)?> Kategori Barang</h3>
                <div class="pull-right">
                    <a href="<?=site_url('kategori')?>" class="btn btn-warning btn-flat">
                        <i class="fa fa-undo"></i> Kembali
                    </a>
                </div>
        </div>
        <div class="box-body">
            <div class="row">
                <div class="col-md-4 col-md-offset-4">
                    <form action="<?=site_url('kategori/proses')?>" method="post">
                        <div class="form-group">
                            <label>Nama kategori*</label>
                            <input type="hidden" name="id" value="<?=$row->kategori_id?>">
                            <input type="text" name="kategori_nama" value="<?=$row->nama?>" class="form-control" required>
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